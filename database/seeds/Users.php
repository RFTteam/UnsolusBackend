<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\User;

class Users extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        $faker = Faker\Factory::create();
        $countryIDs = DB::table('countries')->pluck('CountryId')->all();
        $languageIDs= DB::table('languages')->pluck('LanguageId')->all();
        foreach (range(1,10) as $index) {
            
            DB::table('users')->insert([
                'Username' => $faker->name,
                'Email' =>$faker->unique()->email,
                'Password' =>$faker->password,
                'CountryID'=>$faker->randomElement($countryIDs),
                'LanguageID'=>$faker->randomElement($languageIDs),
                'DateOfBirth'=>$faker->dateTime($max = 'now')
                //'created_at' => $faker->dateTime($max = 'now'),
                //'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}