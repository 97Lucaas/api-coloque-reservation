<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Event;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Da\QrCode\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Mail\InvitationCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
class InvitationsController extends Controller
{

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Invitation::class);

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
        return view('invitations.create', [
            'events' => Event::all()->pluck('id', 'title')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvitationRequest $request)
    {
        $event = Event::findOrFail($request->input('event_id'));

        $this->authorize('participate', $event);
        
        $invitation = Invitation::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'event_id' => $event->id,
            'key' => Str::orderedUuid()
        ]);

        Mail::to($invitation->email)->send(new InvitationCreated($invitation));

        $request->session()->flash('status', __('invitation.sent'));

        return redirect()->route('invitations.sent', $invitation->key);
    }

    

    public function sendmail(Request $request, $invitation_key)
    {
        $invitation = Invitation::where('key', $invitation_key)->firstOrFail();
        

        Mail::to($invitation->email)->send(new InvitationCreated($invitation));

        $request->session()->flash('status', __('invitation.sent'));

        return redirect()->route('invitations.sent', $invitation->key);
    }


    
    public function sent(Request $request, $invitation_key) 
    {
        $invitation = Invitation::where('key', $invitation_key)->firstOrFail();


        return view('invitations.sent')->with([
            'invitation' => $invitation
        ]);
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
            return response()->file(public_path('assets/qrcode-expired.png'));
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
        $this->authorize('view', $invitation);

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
            $request->session()->flash('error', __('invitation.not_found'));
            return redirect()->route('globalscanner');
        }

        $this->authorize('scan', $invitation->event);

        if($invitation->scanned()) {
            // now method is defined, not an error
            $request->session()->flash('error', __('invitation.already_scanned'));
        } else {
            // now method is defined, not an error
            $request->session()->flash('status', __('invitation.successfully_scanned'));
        }
        $invitation->scanned_by_user_id = Auth::user()->id;
        $invitation->save();

        return redirect()->route('invitations.show', $invitation);
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
            $request->session()->flash('error', __('invitation.not_found'));
            return redirect()->route('globalscanner');
        }

        $this->authorize('scan', $invitation->event);


        if($invitation->scanned()) {
            // now method is defined, not an error
            $request->session()->flash('status', __('invitation.unscanned_successfully'));
        } else {
            // now method is defined, not an error
            $request->session()->flash('error', __('invitation.not_yet_scanned'));
        }
        $invitation->scanned_by_user_id = NULL;
        $invitation->save();


        return redirect()->route('invitations.show', $invitation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        $this->authorize('update', $invitation);

        return view('invitations.edit', [
            'invitation' => $invitation,
            'events' => Event::all()->pluck('id', 'title')
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
        $this->authorize('update', $invitation);


        $invitation->first_name = $request->input('first_name');
        $invitation->last_name = $request->input('last_name');
        $invitation->email = $request->input('email');
        // $invitation->event_id = $request->input('event_id');
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
        $this->authorize('delete', $invitation);

        $invitation->delete();
        return redirect()->route('invitations.index');
    }
}
