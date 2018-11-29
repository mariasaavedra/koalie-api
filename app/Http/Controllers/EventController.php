<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        //$events = Event::where('admin_id', $user->id)->orWhere()->get();
        $events = $user->events()->get();


        foreach ($events as $e) {
            $now = Carbon::now();
            $diff = $now->diffInHours($e->date_end, false);

            if($diff <= 0){
                $diff = 0;
                $e->active = 0;
                $e->save();
            }

            $count = DB::table('event_user')
                ->where('event_id', $e->id)
                ->count();
            $e['people_count'] = $count;
            $e['hours_left'] = $diff;
        }

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
        $event->public = $request->public;
        $event->date_start = $request->date_start;
        $event->date_end = $request->date_end;
        $event->attachment_url = "default";
        $event->slot_num = 5;

        $event->save();

        if ($event->users()->save($user)) {
            $response = [
                'event' => $event
            ];
            return response()->json($event, 201);
        };
    }

    public function join($id)
    {
        $user = Auth::user(); 
        $event = Event::find($id);
        
        $joined = DB::table('event_user')->where([
            ['user_id', '=', $user->id],
            ['event_id', '=', $event->id],
        ])->exists();

        if (!($joined)){
            if ( $user->events()->save($event)) {
                $response = [
                    'event' => $event
                ];
                return response()->json($event, 201);
            };
        }

        return response()->json($event, 200);
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
