<?php

namespace App\Http\Controllers;

use App\Player;
use App\File;
use App\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

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

        //Hiermee plaats hij de uitkomsten van de 'peoples' shuffle in een sessie
        Session::put('game_info', $game_info);
        //Stuur checked in players mee
        return view('pages.check-in', compact('players'));
        }

        public function knockOut()
    {       
        $checkedin = Player::where('checked', '1')->get();
        //Tel de inhoud van de count array
        $countArray = count($checkedin);
    
        //Verzamelen info uit sessie in een array
        $game_info = [
        'checkedin' => $checkedin->shuffle(),
        'count_before' => $countArray,
        ];

        //Hiermee plaats hij de uitkomsten van de 'peoples' shuffle in een sessie
        Session::put('game_info', $game_info);

        dd($game_info);
        return view('pages.knock-out');
    }
}
