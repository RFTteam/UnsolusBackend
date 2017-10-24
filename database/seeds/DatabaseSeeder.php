<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(); 
        DB::table('users')->delete();
        DB::table('games')->delete();
        foreach (range(1,10) as $index) {
            
            DB::table('users')->insert([
                'Username' => $faker->name,
                'Email' =>$faker->unique()->email,
                'Passwd' =>$faker->password,
                'Country'=>$faker->country,
                'Lang'=>$faker->languageCode,
                'DateOfBirth'=>$faker->dateTime($max = 'now')
                //'created_at' => $faker->dateTime($max = 'now'),
                //'updated_at' => $faker->dateTime($max = 'now'),
            ]);
            
            DB::table('games')->insert([
                'GameName' =>$faker->name,
                'Shortname' =>$faker->name
                //'created_at' => $faker->dateTime($max = 'now'),
                //'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
        $usersIDs = DB::table('users')->pluck('UserId')->all();
        $gamesIDs= DB::table('games')->pluck('GameId')->all();
        
        foreach (range(1,10) as $index) {
            DB::table('gamerinfo')->insert([
                'UserId' => $faker->randomElement($usersIDs),
                'GameId' => $faker->randomElement($gamesIDs),
                //'UserId' => array_rand($usersIDs),
                //'GameId' => array_rand($gamesIDs),
                'GamerName'=>$faker->username
            ]);
        }
        // $this->call(UsersTableSeeder::class);
    }
}