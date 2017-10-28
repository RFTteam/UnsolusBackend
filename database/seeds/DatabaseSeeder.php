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
        $this->call(Countries::class);
        $this->call(Languages::class);
        $this->call(Users::class);
        $this->call(Games::class);
        $this->call(Gamerinfos::class);
    }
}