<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', Event::class);

        return view('events.index', [
            'events' => Event::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Event::class);

        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $this->authorize('create', Event::class);

        Event::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'end_participation_date' => $request->input('end_participation_date'),
            'start_date' => $request->input('start_date'),
            'max_invitations' => $request->has('max_invitations_enabled') ? $request->input('max_invitations') : NULL,
            'is_public' => $request->boolean('is_public'),
            'place' => $request->input('place')
        ]);

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $event_slug)
    {
        // $this->authorize('view', $event);

        return view('events.show', [
            'event' => Event::where('slug', $event_slug)->firstOrFail(),
            'events' => Event::all()
        ]);
    }

    public function scanner(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);
        
        $this->authorize('scan', $event);

        return view('events.scanner', [
            'event' => $event
        ]);
    }

    public function scan(Request $request, $event_id, $invitation_key)
    {
        $event = Event::findOrFail($event_id);
        
        $this->authorize('scan', $event);

        $invitation = Invitation::firstWhere('key', $invitation_key);


        if(!$invitation) {
            // flash method is defined, not an error
            $request->session()->flash('error', 'Invitation introuvable');
            return redirect()->route('events.scanner', $event->id);
        }

        if($invitation->event->id != $event->id) {
            // flash method is defined, not an error
            $request->session()->flash('error', "L'invitation est pour un autre évènement ({$invitation->event->title})");
            return redirect()->route('events.scanner', $event->id);
        }

        if($invitation->scanned()) {
            // flash method is defined, not an error
            $request->session()->flash('error', 'Invitation déjà scannée');
        } else {
            // flash method is defined, not an error
            $request->session()->flash('status', 'Scanné avec succès');
            $invitation->scanned_by_user_id = Auth::user()->id;
            $invitation->save();
        }      

        return redirect()->route('invitations.show', $invitation);
    }

    /**
     * Show the form for create an invitation.
     *
     * @return \Illuminate\Http\Response
     */
    public function invite(Request $request, $event_slug)
    {
        $event = Event::where('slug', $event_slug)->firstOrFail();

        return view('events.invite', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('events.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $event->title = $request->input('title');
        $event->slug = $request->input('slug');
        $event->description = $request->input('description');
        $event->place = $request->input('place');
        $event->end_participation_date = $request->input('end_participation_date');
        $event->start_date = $request->input('start_date');
        $event->max_invitations = $request->has('max_invitations_enabled') ? $request->input('max_invitations') : NULL;
        $event->is_public = $request->boolean('is_public');
        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();
        return redirect()->route('events.index');
    }
}
