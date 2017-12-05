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
            $team->save();
            $teammember->TeamID=$team->TeamID;
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

        $team=Team::findorfail($id);
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
}
