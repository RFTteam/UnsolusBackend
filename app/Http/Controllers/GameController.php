<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    //Gets all games from database containing all info.
    public function getGames()
    {
        $games=Game::all();

        $response=[
            'games'=>$games,
            //'years'=>$years
        ];
        return response()->json($response,200);
    }

    //Gets all games from database containing just the name.
    public function getGameNames()
    {
        $games=Game::all();
        $gamenames=$games->values('GameName');

        $response=[
            'games'=>$gamenames,
            //'years'=>$years
        ];
        return response()->json($response,200);
    }

}
