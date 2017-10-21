<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamerinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamerinfo', function (Blueprint $table) {
            $table->increments('GamerId');
            $table->integer('UserId')->unsigned()->nullable(false);
            $table->integer('GameId')->unsigned()->nullable(false);
            $table->string('GamerName',20)->nullable(false);
            $table->timestamps();
        });
         Schema::table('gamerinfo', function($table) {
             $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
             $table->foreign('GameId')->references('GameId')->on('games')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gamerinfo');
    }
}
