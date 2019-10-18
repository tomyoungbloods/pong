<?php

namespace App\Http\Controllers;

use App\Point;
use App\Player;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class PointsController extends Controller
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
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        //
    }

    /**
     * Make the bonus points
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public static function knockOutFromPlayerController($session){


        $players =  $session['checkedin'];

        $active_players_count = count($session['checkedin']); 

        if($active_players_count == 3) {
          // 3rd place bonus
          $bonus = 1;
        }
        elseif($active_players_count == 2) {
          // 2nd place bonus
          $bonus = 2;
        }
        elseif($active_players_count == 1) {
          // 1st place bonus
          $bonus = 3;
        }
        else { $bonus = 0; }

        foreach($players as $player) {
            $player->point_count = $player->start_position - $active_players_count + $bonus;      
        }
          $dataSession = [
            'active_players_count' => $active_players_count,
            'players' => $players,
          ];

          return $dataSession;

    }
}
