<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGamerinfoUniqueColumns extends Migration
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
            $table->unique(array('GameId','UserId'),'unique_gamerinfo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gamerinfo', function ($table) {
            $table->dropForeign('gamerinfo_gameid_foreign');
            $table->dropForeign('gamerinfo_userid_foreign');
            $table->dropUnique('unique_gamerinfo');
            $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('GameID')->references('GameID')->on('games')->onDelete('cascade');
        });
    }
}
