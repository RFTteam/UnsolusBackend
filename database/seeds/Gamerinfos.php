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
        
        foreach (range(1,10) as $index) {
            DB::table('gamerinfo')->insert([
                'UserId' => $faker->randomElement($usersIDs),
                'GameId' => $faker->randomElement($gamesIDs),
                'GamerName'=>$faker->username
            ]);
        }
    }
}
