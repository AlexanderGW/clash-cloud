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

Route::get('/clan/{tag}', 'ClanController@index')->name('clan')->where('tag', '[0-9A-Z]+');
Route::get('/player/{tag}', 'PlayerController@index')->name('player')->where('tag', '[0-9A-Z]+');

Route::get('/clan/{tag}/{date}', 'ClanController@index')->name('clan')->where('tag', '[0-9A-Z]+');
Route::get('/player/{tag}/{date}', 'PlayerController@index')->name('player')->where('tag', '[0-9A-Z]+');

Route::get('/top/{iso}/clans', 'TopController@clans')->name('top.clans')->where('iso', '[a-z]+');
Route::get('/top/{iso}/players', 'TopController@players')->name('top.players')->where('iso', '[a-z]+');