<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGamerinfoUniqueGameGamername extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('gamerinfo', function($table) {
            $table->unique(array('GameId','Gamername'),'unique_gamerinfo_game_gamername');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('gamerinfo', function ($table) {
            $table->dropForeign('gamerinfo_gameid_foreign');
            $table->dropUnique('unique_gamerinfo_game_gamername');
            $table->foreign('GameID')->references('GameID')->on('games')->onDelete('cascade');
        });
    }
}
