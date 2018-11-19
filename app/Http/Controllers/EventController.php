<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request) {
    
        $user = Auth::user(); 
        $events = Event::where('admin_id', $user->id)->get();

            $response = [
                'events' => $events
            ];
            return response()->json($events, 200);
    }

    public function search(Request $request)
    {
        $title = $request->title;
        $events = Event::where('title', 'LIKE', '%'.$title.'%')->get();
        
        $response = [
            'events' => $events
        ];
        return response()->json($events, 200);
    }

    public function index($id)
    {
        $event = Event::find($id);

        return response()->json($event, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user(); 
        $event = new Event;

        $event->title = $request->title;
        $event->length = $request->length;
        $event->admin_id = $user->id;

        if ($event->save()) {
            $response = [
                'event' => $event
            ];
            return response()->json($event, 201);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
