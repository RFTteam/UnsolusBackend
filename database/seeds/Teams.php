<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;
class Teams extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker\Factory::create();
        $countryIDs = DB::table('countries')->pluck('CountryId')->all();
        $languageIDs= DB::table('languages')->pluck('LanguageId')->all();
        $gamerIDs=DB::table('gamerinfo')->pluck('GamerId')->all();
        $motivations=["Become professional","Play for fun","Play in amateur leagues"];
        DB::table('teams')->insert([
            'Teamname' => 'Randomteam',
            'Teamgoal' =>$faker->randomElement($motivations),
            'CountryID'=>$faker->randomElement($countryIDs),
            'LanguageID'=>$faker->randomElement($languageIDs),
            'Server'=>'EUNE',
            'GameID'=>2,
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teams')->insert([
            'Teamname' => 'Best_team',
            'Teamgoal' =>$faker->randomElement($motivations),
            'CountryID'=>$faker->randomElement($countryIDs),
            'LanguageID'=>$faker->randomElement($languageIDs),
            'Server'=>'europe',
            'GameID'=>1,
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teams')->insert([
            'Teamname' => 'AAA',
            'Teamgoal' =>$faker->randomElement($motivations),
            'CountryID'=>$faker->randomElement($countryIDs),
            'LanguageID'=>$faker->randomElement($languageIDs),
            'Server'=>'LAN',
            'GameID'=>2,
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teams')->insert([
            'Teamname' => 'BB_team',
            'Teamgoal' =>$faker->randomElement($motivations),
            'CountryID'=>$faker->randomElement($countryIDs),
            'LanguageID'=>$faker->randomElement($languageIDs),
            'Server'=>'america',
            'GameID'=>1,
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teams')->insert([
            'Teamname' => 'RFT',
            'Teamgoal' =>$faker->randomElement($motivations),
            'CountryID'=>$faker->randomElement($countryIDs),
            'LanguageID'=>$faker->randomElement($languageIDs),
            'Server'=>'PBE',
            'GameID'=>2,
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);


        DB::table('teammembers')->insert([
            'TeamID'=>1,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
            ]);
        DB::table('teammembers')->insert([
            'TeamID'=>1,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
            ]);
        DB::table('teammembers')->insert([
            'TeamID'=>1,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teammembers')->insert([
            'TeamID'=>2,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
            ]);
        DB::table('teammembers')->insert([
            'TeamID'=>2,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teammembers')->insert([
        'TeamID'=>3,
        'GamerID'=>$faker->unique()->randomElement($gamerIDs),
        'created_at'=>\Illuminate\Support\Carbon::now(),
        'updated_at'=> \Illuminate\Support\Carbon::now(),
            ]);
        DB::table('teammembers')->insert([
            'TeamID'=>3,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teammembers')->insert([
            'TeamID'=>3,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teammembers')->insert([
            'TeamID'=>3,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teammembers')->insert([
        'TeamID'=>4,
        'GamerID'=>$faker->unique()->randomElement($gamerIDs),
        'created_at'=>\Illuminate\Support\Carbon::now(),
        'updated_at'=> \Illuminate\Support\Carbon::now(),
            ]);
        DB::table('teammembers')->insert([
            'TeamID'=>4,
            'GamerID'=>$faker->unique()->randomElement($gamerIDs),
            'created_at'=>\Illuminate\Support\Carbon::now(),
            'updated_at'=> \Illuminate\Support\Carbon::now(),
        ]);
        DB::table('teammembers')->insert([
        'TeamID'=>5,
        'GamerID'=>$faker->unique()->randomElement($gamerIDs),
        'created_at'=>\Illuminate\Support\Carbon::now(),
        'updated_at'=> \Illuminate\Support\Carbon::now(),
            ]);
    }
}
