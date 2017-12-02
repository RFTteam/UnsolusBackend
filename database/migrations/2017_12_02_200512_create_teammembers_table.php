<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeammembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teammembers', function (Blueprint $table) {
            $table->increments('TeammmemberID');
            $table->integer('TeamID')->unsigned()->nullable(false);
            $table->integer('GamerID')->unsigned()->nullable(false);
            $table->timestamps();
        });
        Schema::table('teammembers', function($table) {
            $table->foreign('TeamID')->references('TeamID')->on('teams')->onDelete('cascade');
            $table->foreign('GamerID')->references('GamerID')->on('gamerinfo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teammembers');
    }
}
