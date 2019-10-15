<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Http\Controllers\FilesController;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();

        $array = [ 
            'players' => $players,
        ]; 

        return view('players.players')->with($array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $player = new Player();
        $player->name = request('name');
        $player->save();

        if($request->avatar) {
            $file_data = [
                'player_id' => $player->id,
                'file' => $request->avatar,
            ];
    
            FilesController::storeFromPlayerController($file_data);
        }
  
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player::find($id);

        return view('players.edit', compact('player'));
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
        $player = Player::find($id);

        $player->name = request('name');

        $player->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Player::where('id', $id)->firstOrFail();
        $player->delete();
        return redirect('/'); 
    }

    public function getAllPlayers() {
        // Retrieve 
        $players = Player::orderBy('name')->get();
        // Get view
        $view = view('players.get-all', compact('players'));
        // Return view
        return $view->render();
    }

    public function checkInPlayer(Request $request) {
        $player = Player::find($request->id);
        if($player->checked){ 
            $player->checked = 0;
          } else {
            $player->checked = 1; 
            }
            $player->save();

        $array = [
            'message' => 'Player check-in status changed'
        ];
        // return response
        return response()->json($array);
    }
}
