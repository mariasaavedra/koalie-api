<?php

namespace App\Http\Controllers;

use App\Media;
use App\User;
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
        //
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
                //$path = Storage::putFile('public', $request->file('attachment'));
                //$path = Storage::putFile($request->file('attachment'));
                $path = $request->file('attachment')->store('public');
               // $path = Storage::putFile('public/media', $request->file('attachment'));
            } 
        }

        $media = new Media;

        $media->user_id = $user->id;
        $media->event_id = 1;
        $media->attachment_url = $path;

        if ($media->save()) {
            return response()->json($media, 201);
        };
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
