<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

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
        // $this->authorize('create', Event::class);

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
            'description' => $request->input('description'),
            'max_invitations' => $request->has('max_invitations_enabled') ? $request->input('max_invitations') : NULL,
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        // $this->authorize('view', $event);

        return view('events.show', [
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
        $event->description = $request->input('description');
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
