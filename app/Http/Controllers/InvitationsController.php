<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Da\QrCode\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Mail\InvitationCreated;
use Illuminate\Support\Facades\Mail;
class InvitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invitations.index', [
            'invitations' => Invitation::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invitations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvitationRequest $request)
    {
        $invitation = Invitation::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'key' => Str::orderedUuid()
        ]);

        $cle = $invitation->key;



        $qrCode = (new QrCode($cle))
            ->setSize(250)
            ->setMargin(20)
            ->useForegroundColor(0,0,0);

        // now we can display the qrcode in many ways
        // saving the result to a file:

        //$qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified
        Storage::disk('local')->put("public/qrcodes/$cle.png", $qrCode->writeString());

        // display directly to the browser 
        //header('Content-Type: '.$qrCode->getContentType());
        //echo $qrCode->writeString();



        Mail::to($invitation->email)->send(new InvitationCreated($invitation));

        return redirect()->route('invitations.index');
    }

    /**
     * Return the qrcode of the invitation
     *
     * @param  UUID  $invitation_key
     * @return \Illuminate\Http\Response
     */
    public function qrcode(Request $request, $invitation_key)
    {
        $invitation = Invitation::firstWhere('key', $invitation_key);
        if(!$invitation) {
            $request->session()->flash('error', 'Invitation introuvable');
            return redirect()->route('home');
        }
        $qrCode = (new QrCode($invitation->key))
            ->setSize(250)
            ->setMargin(20)
            ->useForegroundColor(0,0,0);

        return response($qrCode->writeString())
            ->header('Content-Type', $qrCode->getContentType());
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        return view('invitations.show', [
            'invitation' => $invitation
        ]);
    }


    /**
     * Show the specified resource and set scanned_by_user_id to the actual user id
     *
     * @param  UUID  $invitation_key
     * @return \Illuminate\Http\Response
     */
    public function scan(Request $request, $invitation_key)
    {
        $invitation = Invitation::firstWhere('key', $invitation_key);
        if(!$invitation) {
            $request->session()->flash('error', 'Invitation introuvable');
            return redirect()->route('scanner');
        }

        if($invitation->scanned()) {
            // now method is defined, not an error
            $request->session()->flash('error', 'Invitation déjà scannée');
        } else {
            // now method is defined, not an error
            $request->session()->flash('status', 'Scanné avec succès');
        }
        $invitation->scanned_by_user_id = Auth::user()->id;
        $invitation->save();

        return redirect()->route('invitations.show', $invitation);
        // return view('invitations.show', [
        //     'invitation' => $invitation
        // ]);
    }

    /**
     * Show the specified resource and set scanned_by_user_id to NULL
     *
     * @param  UUID  $invitation_key
     * @return \Illuminate\Http\Response
     */
    public function unscan(Request $request, $invitation_key)
    {
        $invitation = Invitation::firstWhere('key', $invitation_key);
        if(!$invitation) {
            $request->session()->flash('error', 'Invitation introuvable');
            return redirect()->route('scanner');
        }

        if($invitation->scanned()) {
            // now method is defined, not an error
            $request->session()->flash('status', 'Dé-Scanné avec succès');
        } else {
            // now method is defined, not an error
            $request->session()->flash('error', 'Invitation pas encore scannée');
        }
        $invitation->scanned_by_user_id = NULL;
        $invitation->save();


        return redirect()->route('invitations.show', $invitation);
        // return view('invitations.show', [
        //     'invitation' => $invitation
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        return view('invitations.edit', [
            'invitation' => $invitation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvitationRequest  $request
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvitationRequest $request, Invitation $invitation)
    {        
        // $invitation->is_scanned = $request->input('is_scanned') ? true : false;
        $invitation->save();

        return redirect()->route('invitations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return redirect()->route('invitations.index');
    }
}
