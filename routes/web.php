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

Route::get('/', 'PagesController@index'); // Go to home

Route::get('/new/player', 'PlayerController@create'); // Create Player

Route::post('/new/files/avatars', 'FilesController@create'); //Create avatar