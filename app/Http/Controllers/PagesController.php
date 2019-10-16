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
        $players = Player::orderBy('name')->get();
        //Alle spelers waarvan de aanwezig waarde op 1 staat wordt verpakt in een variabele genaamd aanwezig
        $checkedin = Player::where('checked', '1')->get();
        // Shuffle de spelers
        $checkedin = $checkedin->shuffle();
        //Tel de inhoud van de count array
        $countArray = count($checkedin);
        $i = 0;
        //Hier komt startpositie berekening
        foreach($checkedin as $player) {
            if($i < 4) {
            $player->start_position = 0;
            } else {
            $player->start_position = $i - 3;
            }        
            $i++;
        }

        //Verzamel data
        $checked_in_players = [ 
        'players' => $players,
        'checkedin' => $checkedin->shuffle(),
        'count_before' => $countArray     
        ]; 

        //Verzamelen info uit sessie in een array
        $game_info = [
        'checkedin' => $checked_in_players['checkedin'],
        'count_before' => $checked_in_players['count_before'],
        ];

        //Stuur checked in players mee
        return view('pages.check-in', compact('players'));
        }

        public function knockOut()
    {       
        $checkedin = Player::where('checked', '1')->get();
        //Tel de inhoud van de count array
        $countArray = count($checkedin);

        $points = [];
        foreach($checkedin as $player) {
            $points[] = $player->name . ' heeft ' . $player->total_points . ' punten.';
        }

        //Verzamelen info uit sessie in een array
        $game_info = [
        'checkedin' => $checkedin->shuffle(),
        'countArray' => $countArray,
        'points' => $points
        ];

        //Hiermee plaats hij de uitkomsten van de 'peoples' shuffle in een sessie
        Session::put('game_info', $game_info);
        $sessie  = Session::get('game_info');


        $points = PointsController::knockOutFromPlayerController($game_info);

        $data = [
            'checkedin' => $checkedin->shuffle(),
            'countArray' => $countArray,
            'points' => $points,
        ];
        return view('pages.knock-out', with($data));
    }

    public function updateKnockout(Request $request, Player $player, $id)
    {    
        // Retrieve player
        $player = Player::find($id);
        //Pak de 'peoples' uit de sessie en het count element vanuit de sessie
        $sessie  = Session::get('game_info')['checkedin'];
        $start_checked_in = Session::get('game_info')['countArray'];
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
