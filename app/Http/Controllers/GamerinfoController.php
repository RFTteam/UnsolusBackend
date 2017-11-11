<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GamerinfoController extends Controller
{
    public function getPlayerPerGame($game)
    {
        $gameids=DB::table('games')->where('GameName',$game)->pluck('GameID');
        $players=DB::table('Gamerinfo')->whereIn('GameID',$gameids)->get();
        $response=[
            'users'=>$players
        ];
        return response()->json($response,200);
    }


}
