<?php

namespace App\Http\Controllers;

use App\Player;
use App\File;
use App\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use App\Traits\UploadTrait;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();

        foreach($players as $player) {
            $player->avatar_url = $player->avatar_url;
          }
        
        return view('pages.index')->withPlayers($players);
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

    /**
     * Show check-in page
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIn() {
        // Retrieve players
        // $players = Player::orderBy('name')->get();
        

        //Stuur checked in players mee
        return view('pages.check-in');
        }

        public function knockOut()
    {   
        $count_before = Session::get('game_info')['count_before']; 
        $sessie = Session::get('game_info')['checkedin'];

        $checkedin = $sessie;
        //Tel de inhoud van de count array
        $countArray = count($checkedin);

        $points = [];
        foreach($checkedin as $player) {
            $points[] = $player->name . ' heeft ' . $player->total_points . ' punten.';
        }

        //Verzamelen info uit sessie in een array
        $game_info = [
        'checkedin' => $checkedin,
        'countArray' => $countArray,
        'points' => $points,
        'count_before' => $count_before
        ];

        $points = PointsController::knockOutFromPlayerController($game_info);

        $data = [
            'checkedin' => $checkedin,
            'countArray' => $countArray,
            'points' => $points,
        ];
        return view('pages.knock-out', with($data));


        // If Session exists, flush it
        $checkedin = Player::where('checked', '1')->get();

        

        // if(Session::has('game_info')) {
        //     $players = Session::get('game_info')['checkedin'];
        //     Session::flush('game_info');
        // } else {
        //     // Retrieve Players
        //     $players = Player::where('checked', 1)->get()->shuffle();
        // }
        // dd($players);
        //

        // Set Session
        // Session::put('game_info', $game_info);
    }

    public function updateKnockout(Request $request, Player $player, $id)
    {   
        // Retrieve player
        $player = Player::find($id);
        //Pak de 'peoples' uit de sessie en het count element vanuit de sessie
        $sessie  = Session::get('game_info')['checkedin'];
        $start_checked_in = Session::get('game_info')['count_before'];

        //Maak alvast een array aan voor de geupdate peoples
        $updated_peoples = [];
        //Start de functie aanwezig
        if(request('checked')){
          $player->checked = 1;
        } else {
          $player->checked = 0; 
          // Create new PlayerPoint
        //   dd($request->all(), $player);
          $point = new Point;
          // Set PlayerPoint attributes
          $point->points = $request->points;
          $point->player_id = $player->id;
          $point->save();
          }
       $player->save();

       

        // Wanneer de oude players id niet overeenkomt met de nieuwe players id update dan de peoples array
        foreach($sessie as $player_old) {
           if($player_old->id != $player->id) 
           {
              $updated_peoples[] = $player_old;
            }
         }
         $new_game_info = [
           'peoples' => $updated_peoples,
           'count_before' => $start_checked_in,
         ];
      //Gooi de sessie leeg en plaats de nieuwe game info erin
      Session::flush('game_info');
      Session::put('game_info', $new_game_info);
      // Return $return
      return back(); 
    }
}
