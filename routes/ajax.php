<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ajax routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'players'], function() {
    Route::post('/get-all', 'PlayersController@getAllPlayers');
    Route::post('/check-in', 'PlayersController@checkInPlayer');
});
