<?php

namespace App\Http\Controllers;

use App\Gamerinfo;
use Illuminate\Http\Request;
use DB;
use App\Game;
use App\User;
use JWTAuth;
use Illuminate\Support\Facades\Input;

/**
 * Class GamerinfoController
 * @package App\Http\Controllers
 */
class GamerinfoController extends Controller
{
    /**
     * Gets all players linked to a game.
     * @param $game
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPlayerPerGame($game)
    {
        $gameids=DB::table('games')->where('GameName',$game)->pluck('GameID');
        //$players=DB::table('Gamerinfo')->whereIn('GameID',$gameids)->get();
        $players=Gamerinfo::whereIn('GameID',$gameids)->get();
        foreach($players as $player)
        {
            $player->setGame($game);
        }
        $response=[
            'players'=>$players
        ];
        return response()->json($response,200);
    }

    /**
     * Adding a new player.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
        $player->save();
        $game= DB::table('Games')->where('GameID',$player->GameID)->value('Gamename');
        $player->setGame($game);

        $response=[
            'player'=>$player
        ];
        return response()->json($response,200);
    }

    /**
     * Gets the current user's all player accounts.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyPlayers()
    {
        $userid=JWTAuth::user()->UserID;
        //$players=DB::table('Gamerinfo')->where('UserID',$userid)->get();
        $players=Gamerinfo::where('UserID',$userid)->get();
        foreach ($players as $player)
        {
            $game= DB::table('Games')->where('GameID',$player->GameID)->value('Gamename');
            $player->setGame($game);
        }
        $response=[
            'players'=>$players
        ];
        return response()->json($response,200);
    }

}
