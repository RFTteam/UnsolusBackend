<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\User;

class Users extends Seeder
{
    public function run()
    {
        /*User::create([
            'Username' => $faker->Username,
            'Email' =>$faker->Email,
            'Passwd' =>'valami',
            'Country'=>'Hungary',
            'Lang'=>'hungarian',
            'DateOfBirth'=>$faker->DateOfBirth
        ]);*/
        // TestDummy::times(20)->create('App\Post');
    }
}
