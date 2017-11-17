<?php

namespace App\Http\Controllers;

use App\Gamerinfo;
use Illuminate\Http\Request;
use DB;
use App\Game;
use App\User;
use JWTAuth;
use Illuminate\Support\Facades\Input;

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

    public function newPlayer(Request $request)
    {
        $user=JWTAuth::user();
        $userid=$user->UserID;
        $gameid=DB::table('Games')->where('GameName',$request->input('Gamename'))->value('GameID');
        $player= new Gamerinfo();
        $player->Gamername = Input::get('Gamername');
        $player->Rank=Input::get('Rank');
        $player->Role=Input::get('Role');
        $player->Region=Input::get('Region');
        $player->GameID=$gameid;
        $player->UserID=$userid;
        //$player->user()->associate($user);
        //$player->game()->associate($game);
        $player->save();

        $response=[
            'player'=>$player
        ];
        return response()->json($response,200);
    }

}
