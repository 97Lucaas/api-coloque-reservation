<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Da\QrCode\QrCode;
use Illuminate\Support\Facades\Storage;

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
        Storage::disk('local')->put("qrcodes/$cle.png", $qrCode->writeString());

        // display directly to the browser 
        //header('Content-Type: '.$qrCode->getContentType());
        //echo $qrCode->writeString();



        Mail::to($invitation->email)->send(new InvitationCreated($invitation));

        return redirect()->route('invitations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        //
    }


    /**
     * Show the specified resource and set is_scanned to true
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function scan(Request $request, Invitation $invitation)
    {
        if($invitation->is_scanned) {
            // now method is defined, not an error
            $request->session()->now('error', 'Invitation déjà scannée');
        } else {
            // now method is defined, not an error
            $request->session()->now('status', 'Scanné avec succès');
        }
        $invitation->is_scanned = true;
        $invitation->save();

        return view('invitations.show', [
            'invitation' => $invitation
        ]);
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
        $invitation->is_scanned = $request->input('is_scanned') ? true : false;
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
        //
    }
}
