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
        // Take al players
        $players = Player::all();
        // Players in Array
        $array = [ 
            'players' => $players,
        ]; 
        // Return view with Array
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
        //Make new model called Player
        $player = new Player();
        $player->name = request('name');
        $player->save();
        // When request has a Player Id and a File start Function in Files Controller
        if($request->avatar) {
            $file_data = [
                'player_id' => $player->id,
                'file' => $request->avatar,
            ];
    
            FilesController::storeFromPlayerController($file_data);
        }
  
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find player by id
        $player = Player::find($id);
        //Return view and send $player 
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
        // Find Player by ID
        $player = Player::find($id);
        // Edit Player Name to the request name
        $player->name = request('name');
        // Save Player
        $player->save();
        // When request has a Player Id and a File start Function in Files Controller
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find player by ID
        $player = Player::where('id', $id)->firstOrFail();
        // Delete Player
        $player->Delete();
        // Redirect to home
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
        // Find Player bij request ID
        $player = Player::find($request->id);
        // When player is checked send 0 else 1
        if($player->checked){ 
            $player->checked = 0;
        } else {
            $player->checked = 1; 
        }
        $player->save();
        // Set message for console Json
        $array = [
            'message' => 'Player check-in status changed'
        ];
        // Return response
        return response()->json($array);  
    }
}
