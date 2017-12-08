<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Teammember;
use Validator;
use Illuminate\Support\Facades\Input;
use JWTAuth;
use DB;

class TeamController extends Controller
{
    //
    public function newTeam(Request $request)
    {
        $rules = array(
            'Teamname'  => 'required|unique:Teams',
            'Teamgoal'  => 'required',
            'Server'    => 'required',
            'Country'   => 'required',
            'Language'  => 'required',
            'Gamename'  => 'required'
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

            $team = new Team();
            $teammember = new Teammember();
            $userid=JWTAuth::user()->UserID;
            $team->Teamname = Input::get('Teamname');
            $team->Teamgoal = Input::get('Teamgoal');
            $team->Server = Input::get('Server');
            $countryid=DB::table('Countries')->where('CountryName',$request->input('Country'))->value('CountryID');
            $languageid=DB::table('Languages')->where('LanguageName',$request->input('Language'))->value('LanguageID');
            $team->CountryID = $countryid;
            $team->LanguageID = $languageid;
            $gameid=DB::table('Games')->where('GameName',$request->input('Gamename'))->value('GameID');
            $playerid=DB::table('Gamerinfo')->where([['GameID','=',$gameid],['UserID','=',$userid]])->value('GamerID');
            if($playerid==null)
            {
                $returnData = array(
                    'status' => 401,
                    'message' => 'Player account does not exist to that game.'
                );
                return response()->json($returnData, 500);
            }
            $team->GameID = $gameid;
            $team->save();$teammember->TeamID=$team->TeamID;
            $teammember->GamerID =$playerid;

            $teammember->save();



            $game= DB::table('Games')->where('GameID',$team->GameID)->value('Gamename');
            $country= DB::table('Countries')->where('CountryID',$team->CountryID)->value('Countryname');
            $language=DB::table('Languages')->where('LanguageID',$team->LanguageID)->value('Languagename');
            $team->setCountry($country);
            $team->setLanguage($language);
            $team->setGame($game);
            return response()->json($team,201);
        }
    }
    public function deleteTeam(Request $request,$id)
    {

        $team=Team::find($id);
        if ($team == null) {
            $returnData = array(
                'status' => 401,
                'message' => 'Team does not exist.'
            );
            return response()->json($returnData, 500);
        }
        $team->delete();
        return response()->json($team,201);
        //Gamerinfo::destroy($id);
    }
    public function getTeams()
    {
        $teams=Team::all();
        foreach ($teams as $team){
            $game= DB::table('Games')->where('GameID',$team->GameID)->value('Gamename');
            $country= DB::table('Countries')->where('CountryID',$team->CountryID)->value('Countryname');
            $language=DB::table('Languages')->where('LanguageID',$team->LanguageID)->value('Languagename');
            $team->setCountry($country);
            $team->setLanguage($language);
            $team->setGame($game);
        }
        $response=$teams;
        return response()->json($response,200);
    }

    public function getTeamsPerGame(Request $request,$game)
    {
        $gameids=DB::table('games')->where('GameName',$game)->pluck('GameID');
        $teams=Team::whereIn('GameID',$gameids)->get();
        if(count($gameids)<1)
        {
            $returnData = array(
                'status' => 401,
                'message' => $game.' game does not exist.'
            );
            return response()->json($returnData, 500);
        }

        foreach($teams as $team)
        {
            $team->setGame($game);
            $country= DB::table('Countries')->where('CountryID',$team->CountryID)->value('Countryname');
            $language=DB::table('Languages')->where('LanguageID',$team->LanguageID)->value('Languagename');
            $team->setCountry($country);
            $team->setLanguage($language);
        }
        $response= $teams;
        return response()->json($response,200);
    }

    public function getTeam($id)
    {
        $team=Team::find($id);
        if ($team == null) {
            $returnData = array(
                'status' => 401,
                'message' => 'Team does not exist.'
            );
            return response()->json($returnData, 500);
        }
        $game= DB::table('Games')->where('GameID',$team->GameID)->value('Gamename');
        $team->setGame($game);
        $country= DB::table('Countries')->where('CountryID',$team->CountryID)->value('Countryname');
        $team->setCountry($country);
        $language=DB::table('Languages')->where('LanguageID',$team->LanguageID)->value('Languagename');
        $team->setLanguage($language);
        $response=$team;
        return response()->json($response,200);
    }

    public function updateTeam(Request $request,$id)
    {
            $team=DB::table('Teams')->where('TeamID',$id)->first();
            //$userid=JWTAuth::user()->UserID;

            if(Input::get('Teamname') != null){
                $team->Teamname = Input::get('Teamname');
            }

            if(Input::get('Teamgoal') != null){
                $team->Teamgoal = Input::get('Teamgoal');
            }
            if(Input::get('Server') != null){
                $team->Server = Input::get('Server');
            }
            if(Input::get('Country') != null){
                $countryid=DB::table('Countries')->where('CountryName',$request->input('Country'))->value('CountryID');
                $team->CountryID = $countryid;
            }
            if(Input::get('Language') != null){
                $languageid=DB::table('Languages')->where('LanguageName',$request->input('Language'))->value('LanguageID');
                $team->LanguageID = $languageid;
            }
            if(Input::get('Gamename') != null){
                $gameid=DB::table('Games')->where('GameName',$request->input('Gamename'))->value('GameID');
                $team->GameID = $gameid;
            }
            $team->save();



            $game= DB::table('Games')->where('GameID',$team->GameID)->value('Gamename');
            $country= DB::table('Countries')->where('CountryID',$team->CountryID)->value('Countryname');
            $language=DB::table('Languages')->where('LanguageID',$team->LanguageID)->value('Languagename');
            $team->setCountry($country);
            $team->setLanguage($language);
            $team->setGame($game);
            return response()->json($team,201);
    }

}
