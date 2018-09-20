<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Auth
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('details', 'UserController@details');
    });

    //Events
    Route::prefix('event')->group(function () {
        Route::group(['middleware' => 'auth:api'], function(){
            Route::post('create', 'EventController@store');
            Route::post('join', 'EventController@join');
            Route::post('leave', 'EventController@leave');
        });
    });
});