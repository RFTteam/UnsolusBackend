<?php

namespace App\Http\Controllers;

use App\Gamerinfo;
use Illuminate\Http\Request;
use DB;
use App\Game;
use App\User;
use JWTAuth;
use Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

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
        if(count($gameids)<1)
        {
            $returnData = array(
                'status' => 401,
                'message' => $game.' game does not exist.'
            );
            return response()->json($returnData, 500);
        }

        foreach($players as $player)
        {
            $player->setGame($game);
        }
        $response= $players;
        return response()->json($response,200);
    }

    /**
     * Adding a new player.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function newPlayer(Request $request)
    {
        /*Validator::extend('uniqueUserAndGame', function ($attribute, $value, $parameters, $validator) {
            $count = DB::table('Gamerinfo')->where('Gamename', $value)
                ->where('GamerName', $parameters[0])
                ->count();

            return $count === 0;
        });*/

        $rules = array(
            'Gamename'      => 'required',
            'Gamername' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $returnData = array(
                'status' => 401,
                'message' => $messages
            );
            return response()->json($returnData, 500);
        } else {

        $user=JWTAuth::user();
        $userid=$user->UserID;
        $gameid=DB::table('Games')->where('GameName',$request->input('Gamename'))->value('GameID');
        $player= new Gamerinfo();
        $player->GamerName = Input::get('Gamername');
        $player->Rank=Input::get('Rank');
        $player->Role=Input::get('Role');
        $player->Style=Input::get('Style');
        $player->Server=Input::get('Server');
        $player->Motivation=Input::get('Motivation');
        $player->GameID=$gameid;
        $player->UserID=$userid;
        $player->save();
        $game= DB::table('Games')->where('GameID',$player->GameID)->value('Gamename');
        $player->setGame($game);

        $response= $player;
        return response()->json($response,200);
        }
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
        $response= $players;
        return response()->json($response,200);
    }

    /**
     * Update the authenticated user's player info.
     */
    public function updatePlayer(Request $request,$id)
    {
        $player=Gamerinfo::find($id);
        $user=JWTAuth::user();
        if($user->UserID != $player->UserID)
        {
            $returnData = array(
                'status' => 401,
                'message' => 'You don not have rights to update.'
            );
            return response()->json($returnData, 500);
        }

        if ($player == null) {
            $returnData = array(
                'status' => 401,
                'message' => 'Player account does not exist.'
            );
            return response()->json($returnData, 500);
        }

        $userid=$user->UserID;
        $gameid=DB::table('Games')->where('GameName',$request->input('Gamename'))->value('GameID');
        $player->GamerName = Input::get('Gamername');
        $player->Rank=Input::get('Rank');
        $player->Role=Input::get('Role');
        $player->Style=Input::get('Style');
        $player->Server=Input::get('Server');
        $player->Motivation=Input::get('Motivation');
        $player->GameID=$gameid;
        $player->UserID=$userid;
        $player->save();
        $game= DB::table('Games')->where('GameID',$player->GameID)->value('Gamename');
        $player->setGame($game);

        $response= $player;
        return response()->json($response,200);
    }


    public function deletePlayer($id)
    {
        $player=Gamerinfo::findorfail($id);
        $user=JWTAuth::user();
        if ($player == null) {
            $returnData = array(
                'status' => 401,
                'message' => 'Player account does not exist.'
            );
            return response()->json($returnData, 500);
        }

        if($user->UserID != $player->UserID)
        {
            $returnData = array(
                'status' => 401,
                'message' => 'You don not have rights to delete.'
            );
            return response()->json($returnData, 500);
        }


        $player->delete();
        return response()->json($player,201);
        //Gamerinfo::destroy($id);
    }
    public function getAllPlayers(Request $request)
    {
        $players=Gamerinfo::all();
        foreach ($players as $player){
            $game= DB::table('Games')->where('GameID',$player->GameID)->value('Gamename');
            $player->setGame($game);
        }
        $response=$players;
        return response()->json($response,200);
    }
    public function getPlayer(Request $request,$id)
    {
        $player=Gamerinfo::findorfail($id);
        if ($player == null) {
            $returnData = array(
                'status' => 401,
                'message' => 'Player account does not exist.'
            );
            return response()->json($returnData, 500);
        }
        $game= DB::table('Games')->where('GameID',$player->GameID)->value('Gamename');
        $player->setGame($game);
        $response=$player;
        return response()->json($response,200);
    }
    public function getLanguage(Request $request,$id)
    {
        $userid=DB::table('gamerinfo')->where('GamerID',$id)->value('UserID');
        $user=User::find($userid);
        $country= DB::table('Countries')->where('CountryID',$user->CountryID)->value('Countryname');
        $language=DB::table('Languages')->where('LanguageID',$user->LanguageID)->value('Languagename');
        $user->setCountry($country);
        $user->setLanguage($language);
        return response()->json($user->language,200);
    }
    public function getCountry(Request $request,$id)
    {
        $userid=DB::table('gamerinfo')->where('GamerID',$id)->value('UserID');
        $user=User::find($userid);
        $country= DB::table('Countries')->where('CountryID',$user->CountryID)->value('Countryname');
        $language=DB::table('Languages')->where('LanguageID',$user->LanguageID)->value('Languagename');
        $user->setCountry($country);
        $user->setLanguage($language);
        return response()->json($user->country,200);
    }
    public function getEmail(Request $request,$id)
    {
        $userid=DB::table('gamerinfo')->where('GamerID',$id)->value('UserID');
        $user=User::find($userid);
        $country= DB::table('Countries')->where('CountryID',$user->CountryID)->value('Countryname');
        $language=DB::table('Languages')->where('LanguageID',$user->LanguageID)->value('Languagename');
        $user->setCountry($country);
        $user->setLanguage($language);
        return response()->json($user->Email,200);
    }


}
