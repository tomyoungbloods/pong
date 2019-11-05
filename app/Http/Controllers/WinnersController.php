<?php

namespace App\Http\Controllers;

use App\Winner;
use App\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class WinnersController extends Controller
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
     * Display the specified resource.
     *
     * @param  \App\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function show(Winner $winner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function edit(Winner $winner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Winner $winner)
    {
        //
    }

     /**
     * SelectWinners listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function selectWinners()
    {
        //Get all players
        $players = Player::all();
 
        $start_date = Carbon::now('Europe/Zurich')->subMinutes(15);
        $end_date = Carbon::now('Europe/Zurich')->addMinutes(1);

        $dates = [
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];

        foreach($players as $player) {
            $player->points_in_period = $player->pointsInPeriod($dates);
        }
        //Haal voor elke individuele player uit de andere dataset de total_points en avatar_url
        foreach($players as $player) {
          $player->avatar_url = $player->avatar_url;
          
          $player->last_four_games = $player->last_four_games;
        } 
        //Sorteer aantal spelers op de behaalde punten
        $players = collect($players->toArray())->sortByDesc('points_in_period');
        //Pak de speler die eerste is geeindigd
        $firstPlayer = $players->take(1)->first();
        //Hoogste punten aantal
        $highestNumber = $firstPlayer['points_in_period'];

        foreach($players as $player) {

            if($player['points_in_period'] == $highestNumber) {
                Winner::create([
                    'winner_category_id' => 1,
                    'player_id' => $player['id'],
                    'position' => 9999,
                ]);
            }
        }


        //$highestScore =  $firstPlayer['points_in_period'];
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Winner $winner)
    {
        //
    }
}
