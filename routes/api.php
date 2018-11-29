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

    Route::post('callback/facebook', 'FacebookController@callback');


    //Events
    Route::prefix('event')->group(function () {
        Route::get('/', 'EventController@all');
        Route::get('/{id}', 'EventController@index');
        Route::post('/search', 'EventController@search');
        Route::group(['middleware' => 'auth:api'], function(){
            Route::post('create', 'EventController@store');
            Route::post('join/{id}', 'EventController@join');
            Route::post('leave', 'EventController@leave');
        });
    });

    //Media
    Route::prefix('media')->group(function () {
        Route::post('create', 'MediaController@store');
        Route::post('/{id}/upvote', 'MediaController@upvote');
        Route::get('/{id}', 'MediaController@feed');
        Route::get('/', 'MediaController@index');
    });
});