<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'players'], function() {
        Route::get('/', 'PlayersController@index')->name('players.index'); // Show all Player 
        Route::get('/edit/{id}', 'PlayersController@edit')->name('players.edit'); // Show edit Player form example: route('players.edit', ['id' => $player->id])
        Route::patch('/edit/{id}', 'PlayersController@update'); // Save update
        Route::delete('/edit/{id}', 'PlayersController@destroy')->name('players.destroy'); // Destroy edit
    });

});

Route::group([], function() {
    Route::get('/', 'PagesController@index')->name('home'); // Go to home
    Route::get('/check-in', 'PagesController@checkIn')->name('check-in'); // Check in for the knock out round
    Route::get('/knock-out', 'PagesController@knockOut')->name('knock-out'); // Start Knock out
    Route::get('/session-builder', 'PagesController@sessionBuilder')->name('sessionBuilder'); //Build session and redirect to Knock out view
    Route::patch('/knock-out/{id}', 'PagesController@updateKnockout'); // Update speler in de game
});

Route::group(['prefix' => 'players'], function() {
    Route::get('/new', 'PlayersController@create')->name('players.new'); // Create Player
    Route::post('/new', 'PlayersController@store'); // Store Player
});

Route::group(['prefix' => 'files'], function() {
    Route::get('/new', 'FilesController@create')->name('files.new'); //Create avatar
    Route::post('/new', 'FilesController@store'); //Store avatar
});

Route::group(['prefix' => 'points'], function() {
    Route::get('/new', 'PointsController@create')->name('points.new'); //Create points
    Route::post('/new', 'PointsController@store'); //Store points
});