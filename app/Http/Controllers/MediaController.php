<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
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
    public function index()
    {
        $media = Media::all();
        return response()->json($media, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$video = $ffmpeg->open('video.mpg');
       
    }

        /**
     * Download the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        //
    }

    public function feed($id) {
    
        $user = Auth::user(); 
        $media = Media::where('event_id', $id)->get();

        return response()->json($media, 200);
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
        
        
        $attachment = $request->file('attachment');

        if ($attachment) {
            $mime = $attachment->getMimeType();
            // If it's an image..
            if (strpos($mime, 'image') !== false) {
                $path = $request->file('attachment')->store('/');
            } 
        }
        
        $media = new Media;

        $media->user_id = $user->id;
        $media->username = $user->name;
        $media->event_id = 1;
        $media->attachment_url = $path;

        $event_id = $media->event_id;
        
        $m = Media::where('event_id', $event_id)->first();

        if ($media->save()) {
            if ($m == null) {
                $event = Event::find($event_id);
                $event->attachment_url = $path;
                if ($event->save()){
                    return response()->json($media, 201);
                }
            }
            return response()->json($media, 201);
        }
/*
        $vp_1 = "http://koalie.test/storage/app/public/IMG_0546.MOV";
        $vp_2 = "http://koalie.test/storage/app/public/IMG_0548.MOV";
        $vp_3 = "http://koalie.test/storage/app/public/IMG_0550.MOV";
        $vp_4 = "http://koalie.test/storage/app/public/IMG_0552.MOV";
        */

       /* $ffmpeg = FFMpeg\FFMpeg::create();

        return $ffmpeg;
        
        $video = $ffmpeg->open( $vp_1 );

        $format = new FFMpeg\Format\Video\X264();
        $format->setAudioCodec("libmp3lame");

        $video
        ->concat(array($vp_1, $vp_2))
        ->saveFromDifferentCodecs($format, '/Users/mariasaavedra/Documents');*/
        /*
        $video = $ffmpeg->open( '/path/to/video' );

        $format = new FFMpeg\Format\Video\X264();
        $format->setAudioCodec("libmp3lame");

        $video
        ->concat(array('/path/to/video1', '/path/to/video2'))
        ->saveFromDifferentCodecs($format, '/path/to/new_file');
        */

       //return "OK";
/*
        $media = new Media;

        $media->user_id = $user->id;
        $media->username = $user->name;
        $media->event_id = 1;
        $media->attachment_url = $path;

        

        if ($media->save()) {

            $media->toArray();
            $media["username"] = $user->name;

            return response()->json($media, 201);
        };
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
