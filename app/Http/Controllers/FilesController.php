<?php

namespace App\Http\Controllers;

use App\File;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PlayerController;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Object  $file_data
     * @return \Illuminate\Http\Response
     */
    public static function storeFromPlayerController($file_data)
    {
        //$file->store('public/' . $speler_id);
        $file = $file_data['file'];
        $ext = $file->guessClientExtension();
        // Get original file name
        $orig_name = $file->getClientOriginalName();
        // Turn original name into array
        $nameparts = explode('.', $orig_name);
        // Get file extension
        $ext = end($nameparts);
        // Set random string for file name
        $random_str = Str::random(36);
        // Build filename
        $file_name = "{$random_str}.{$ext}";

        // Set foldername
        $folder_name = $file_data['player_id'];

        // Store file on disk
        $file->storeAs('public/' . $folder_name, $file_name);
        // Create File entity
        $new_file = new File;
        // Set all File attributes
        $new_file->file_name = $file_name;
        $new_file->folder_name = $folder_name;
        $new_file->player_id = $file_data['player_id'];
        $new_file->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}