<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Game;


class Games extends Seeder
{
    public function run()
    {
        /*Game::create([
            'GameName' => $faker->GameName,
            'Shortname' =>$faker->Shortname,
        ]);*/
        // TestDummy::times(20)->create('App\Post');
    }
}
