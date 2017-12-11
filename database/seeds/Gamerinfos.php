<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class Gamerinfos extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $usersIDs = DB::table('users')->pluck('UserId')->all();
        $gamesIDs= DB::table('games')->pluck('GameId')->all();
        $lolroles=["ADC","Support","Top","Jungle","Mid","Fill"];
        $lolranks=["Bronze V","Bronze IV","Bronze III","Bronze II","Bronze I",
        "Silver V","Silver IV","Silver III","Silver II","Silver I",
        "Gold V","Gold IV","Gold III","Gold II","Gold I",
        "Platinum V","Platinum IV","Platinum III","Platinum II","Platinum I",
        "Diamond V","Diamond IV","Diamond III","Diamond II","Diamond I",
        "Master I","Challenger"];
        $lolservers=["BR","EUNE","EUW","LAN","LAS","NA","OCE","RU",
            "TR","JP","SEA","SG/MY","PH","ID","TH","VN","TW","KR","PBE","CN"];
        $lolstyles=["Aggressive","Passive","Roamer","Ganker","Invader","Farmer"];
        $lolmotivations=["Become professional","Play for fun","Play in amateur leagues"];
        $fnitestyles = ["Offensive", "Defensive"];
        $fniteservers = ["america", "europe"];
        $fniteroles = ["Soldier", "Constructor", "Ninja", "Outlander"];


        foreach (range(1,20) as $index) {
            $gameid=$faker->randomElement($gamesIDs);
            if($gameid==1)
            {
                DB::table('gamerinfo')->insert([
                    'UserId' => $faker->unique()->randomElement($usersIDs),
                    'GameId' => $gameid,
                    'GamerName'=>$faker->username,
                    'Role'=> $faker->randomElement($fniteroles),
                    'Server'=>$faker->randomElement($fniteservers),
                    'Style'=>$faker->randomElement($fnitestyles),
                    'created_at'=>\Illuminate\Support\Carbon::now(),
                    'updated_at'=> \Illuminate\Support\Carbon::now()
                ]);
            }
            else{
            DB::table('gamerinfo')->insert([
                'UserId' => $faker->unique()->randomElement($usersIDs),
                'GameId' => $gameid,
                'GamerName'=>$faker->username,
                'Role'=> $faker->randomElement($lolroles),
                'Rank'=>$faker->randomElement($lolranks),
                'Server'=>$faker->randomElement($lolservers),
                'Style'=>$faker->randomElement($lolstyles),
                'Motivation'=>$faker->randomElement($lolmotivations),
                'created_at'=>\Illuminate\Support\Carbon::now(),
                'updated_at'=> \Illuminate\Support\Carbon::now()
            ]);
            }
        }
    }
}
