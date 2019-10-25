<?php

namespace App\Http\Controllers;

use App\Player;
use App\File;
use App\Point;
use Carbon\Carbon;
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
        $collection = $players->take(3);
        //De bovenste drie worden geplaatst in een variabele genaamd podium
        $topOfTable = $collection->collect();

        //Plaats alle data in een array
        $array = [ 
            'players' => $players,
            'topOfTable' => $topOfTable,
        ]; 

        return view('templates.sideranking')->with($array); 
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function competitionFilter(Request $request, $weeks = null)
    {
        //Get all players
        $players = Player::all();

        //Hiermee controlleert hij of er een startdatum is opgegeven wanneer dat niet het geval is plaats de datum van vandaag
        if(!isset($end_date) && empty($end_date)) {
            $end_date = Carbon::now();
        }

        $start_date_carbon = Carbon::now()->startOfWeek()->subDays(2);
        $now = Carbon::now();
        $end_date = (new Carbon($start_date_carbon))->addWeek();

        //Kijk of de waarde van weeks meegegeven is
        if(!isset($weeks)) {
            $weeks = 0;
        }

        if($weeks == 0) {
            //
        } elseif($weeks == 1) {
            $start_date_carbon->subWeek();
            $end_date->subWeek();
        } else {
            $start_date_carbon->subWeeks($weeks);
            $end_date->subWeeks($weeks);
        }

        $dates = [
            'start_date' => $start_date_carbon,
            'end_date' => $end_date,
        ];


        foreach($players as $player) {
            $player->points_in_period = $player->pointsInPeriod($dates);
        }
        //Haal voor elke individuele player uit de andere dataset de total_points en avatar_url
        foreach($players as $player) {
          $player->avatar_url = $player->avatar_url;
        } 
        //Sorteer aantal spelers op de behaalde punten
        $players = collect($players->toArray())->sortByDesc('points_in_period');

        //Pak de bovenste drie uit de table
        $topOfTable = $players->take(3)->sortByDesc('points_in_period');

        //Zet hier de filters voor de dropdown
        $week_selectors = [
            ['url' => route('filter.new', ['weeks' => 0]), 'name' => 'Huidige week', 'week_nr' => 0],
            ['url' => route('filter.new', ['weeks' => 1]), 'name' => 'Vorige week', 'week_nr' => 1],
            ['url' => route('filter.new', ['weeks' => 2]), 'name' => 'Twee weken geleden', 'week_nr' => 2],
            ['url' => route('filter.new', ['weeks' => 3]), 'name' => 'Drie weken geleden', 'week_nr' => 3],
            ['url' => route('filter.new', ['weeks' => 4]), 'name' => 'Vier weken geleden', 'week_nr' => 4],
        ];

        $players_all_time = Player::all();

        foreach($players_all_time as $player) {
            $player->avatar_url = $player->avatar_url;
            $player->total_points = $player->total_points;
          }

        //Sorteer aantal spelers op de behaalde punten
        $players_all_time = collect($players_all_time->toArray())->sortByDesc('total_points');
        //Pak de bovenste drie uit de collectie
        $collection = $players_all_time->take(3);
        //De bovenste drie worden geplaatst in een variabele genaamd topOfTable_all_time
        $topOfTable_all_time = $collection->collect();

        // dd($players_all_time);

         //Plaats alle data in een array
         $array = [ 
            'players' => $players,
            'dates' => $dates,
            'weeks' => $weeks,
            'topOfTable' => $topOfTable,
            'week_selectors' => $week_selectors,
            'players_all_time' => $players_all_time,
            'topOfTable_all_time' => $topOfTable_all_time,
          ]; 

       
        return view('pages.competition')->with($array);
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
        $checkedin = Player::where('checked', '1')->get()->shuffle();
        //Tel de inhoud van de count array
        $countArray = count($checkedin);

        // Set counter
        $i = 0;
        // Set start position
        foreach($checkedin as $player) {
            if($i < 2) {
              $player->start_position = $countArray;
            } else {
              $player->start_position = $countArray - ($i - 1);
            }        
            $i++;
        }

        //Verzamelen info uit sessie in een array
        $game_info = [
            'checkedin' => $checkedin,
            'count_before' => $countArray,
        ];

        //Hiermee plaats hij de uitkomsten van de 'gameinfo' shuffle in een sessie
        Session::put('game_info', $game_info);
        return redirect()->route("knock-out");
    }

    public function knockOut()
    {
        $session = Session::get('game_info');

        // active_player_count && players
        $dataSession = PointsController::knockOutFromPlayerController($session);

        if(is_array($dataSession['players'])) {
            if(empty($dataSession['players'])) {
                return redirect()->route('home');
            }
        } else {
            if(empty($dataSession['players']->toArray())) {
                return redirect()->route('home');
            }
        }

        $checkedin = $dataSession['players'];

        $data = [
            'checkedin' => $checkedin,
            'active_players_count' => $dataSession['active_players_count'],
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
