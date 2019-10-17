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
            $player->total_points = $player->total_points;
          }

        //Sorteer aantal spelers op de behaalde punten
        $players = collect($players->toArray())->sortByDesc('total_points');
        //Pak de bovenste drie uit de collectie
        $collection = collect($players->toArray())->sortByDesc('total_points')->take(3);
        //De bovenste drie worden geplaatst in een variabele genaamd podium
        $topOfTable = $collection->collect();

        //Plaats alle data in een array
        $array = [ 
            'players' => $players,
            'topOfTable' => $topOfTable,
        ]; 

        return view('pages.index')->with($array); 
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
            if($i < 2) {
            $player->start_position = 0;
            } else {
            $player->start_position = $i - 1;
            }        
            $i++;
        }

        //Verzamel data
        $checked_in_players = [ 
        'players' => $players,
        'checkedin' => $checkedin,
        'count_before' => $countArray     
        ]; 

        //Verzamelen info uit sessie in een array
        $game_info = [
        'checkedin' => $checked_in_players['checkedin'],
        'count_before' => $checked_in_players['count_before'],
        ];

        // $session = Session::put('game_info')['countArray'];

        //Stuur checked in players mee
        return view('pages.check-in', compact('players'));
        }

        
    /**
     * Display the specified resource.
     *
     * @param  int  
     * @return \Illuminate\Http\Response
     */
    public function sessionBuilder()
    {
        $checkedin = Player::where('checked', '1')->get();
        //Tel de inhoud van de count array
        $countArray = count($checkedin);

        // $points = [];
        // foreach($checkedin as $player) {
        //     $points[] = $player->name . ' heeft ' . $player->total_points . ' punten.';
        // }
        // Set counter
        $i = 0;
        // Set start position
        foreach($checkedin as $player) {
            if($i < 2) {
              $player->start_position = 0;
            } else {
              $player->start_position = $i - 1;
            }        
            $i++;
          }

        //Verzamelen info uit sessie in een array
        $game_info = [
            'checkedin' => $checkedin,
            'count_before' => $countArray,
            // 'points' => $points
        ];


        //Hiermee plaats hij de uitkomsten van de 'gameinfo' shuffle in een sessie
        Session::put('game_info', $game_info);
        return redirect()->route("knock-out");
    }

    public function knockOut()
    {
        $session = Session::get('game_info');

        $dataSession = PointsController::knockOutFromPlayerController($session);

        $checkedin = Session::get('game_info')['checkedin'];

        $data = [
            'checkedin' => $checkedin,
            'active_players_count' => $dataSession['active_players_count'],
            'points' => $dataSession['points'],
        ];

        return view('pages.knock-out', with($data));
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
           'checkedin' => $updated_peoples,
           'count_before' => $start_checked_in,
         ];
      //Gooi de sessie leeg en plaats de nieuwe game info erin
      Session::flush('game_info');
      Session::put('game_info', $new_game_info);
      // Return $return
      return back(); 
    }
}
