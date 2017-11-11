<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Game;


class Games extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('games')->delete();
        $games=array('Fortnite'=>'Fortnite','LoL'=>'LeagueofLegends');
        foreach($games as $key => $value){
            DB::table('games')->insert([
                'GameName' =>$value,
                'Shortname' =>$key
            //'created_at' => $faker->dateTime($max = 'now'),
            //'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
