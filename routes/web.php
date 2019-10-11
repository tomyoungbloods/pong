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

Route::get('/', 'PagesController@index')->name('home'); // Go to home

Route::group(['prefix' => 'players'], function() {
    Route::get('/', 'PlayersController@index')->name('players.index'); // Show all Player 
    Route::get('/new', 'PlayersController@create')->name('players.new'); // Create Player
    Route::post('/new', 'PlayersController@store'); // Store Player
    Route::get('/edit/{id}', 'PlayersController@edit')->name('players.edit'); // Show edit Player form example: route('players.edit', ['id' => $player->id])
    Route::patch('/edit/{id}', 'PlayersController@update'); // Sla het bewerkte project opl
    Route::delete('/edit/{id}', 'PlayersController@destroy')->name('players.destroy');;
});

Route::post('/new/files/avatars', 'FilesController@create'); //Create avatar