<?php

namespace App\Http\Controllers;

use App\Gamerinfo;
use Illuminate\Http\Request;
use App\Teammember;
use JWTAuth;
use DB;

class TeammemberController extends Controller
{
    //
    public function joinTeam($id)
    {
        $userid=JWTAuth::user()->UserID;
        $teammember=new Teammember();
        $teamid=DB::table('teams')->where('TeamID',$id)->value('TeamID');
        $gameid=DB::table('teams')->where('TeamID',$id)->value('GameID');
        $teammember->TeamID=$teamid;
        $playerid=DB::table('Gamerinfo')->where([['GameID','=',$gameid],['UserID','=',$userid]])->value('GamerID');
        $teammember->GamerID =$playerid;
        $teammember->save();

        $teamname=DB::table('teams')->where('TeamID',$id)->value('Teamname');
        $teammember->setTeam($teamname);
        $playername=DB::table('gamerinfo')->where('GamerID',$playerid)->value('Gamername');
        $teammember->setGamerinfo($playername);
        return response()->json($teammember,201);
    }
    public function leaveTeam($id)
    {
        $userid=JWTAuth::user()->UserID;
        $teamid=DB::table('teams')->where('TeamID',$id)->value('TeamID');
        $gameid=DB::table('teams')->where('TeamID',$id)->value('GameID');
        $playerid=DB::table('Gamerinfo')->where([['GameID','=',$gameid],['UserID','=',$userid]])->value('GamerID');
        $teammemberid=DB::table('teammembers')->where([['TeamID','=',$teamid],['GamerID','=',$playerid]])->value('TeammmemberID');
        $teammember=Teammember::find($teammemberid);
        $teammember->delete();

        $teamname=DB::table('teams')->where('TeamID',$id)->value('Teamname');
        $teammember->setTeam($teamname);
        $playername=DB::table('gamerinfo')->where('GamerID',$playerid)->value('Gamername');
        $teammember->setGamerinfo($playername);
        return response()->json($teammember,201);

    }
    public function getPlayersPerTeam($id)
    {
        $teammemberids=DB::table('teammembers')->where('TeamID',$id)->pluck('GamerID');
        $players=Gamerinfo::findMany($teammemberids);
        return response()->json($players,201);
    }
    public function getAllTeammembers()
    {
        $teammembers=Teammember::all();
        return response()->json($teammembers,201);
    }
}
