<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameColumnToTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('GameID')->unsigned()->nullable(false);
        });
        Schema::table('teams', function($table) {
            $table->foreign('GameID')->references('GameID')->on('games')->onDelete('cascade');
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
        Schema::table('teams', function($table)
        {
            $table->dropForeign('teams_GameID_foreign');
            $table->dropColumn('GameID');
        });
    }
}
