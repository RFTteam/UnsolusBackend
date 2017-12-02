<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('TeamID');
            $table->string('Teamname',40)->nullable(false);
            $table->string('Teamgoal',40)->nullable(false);
            $table->integer('CountryID')->unsigned()->nullable(false);
            $table->integer('LanguageID')->unsigned()->nullable(false);
            $table->string('Server')->nullable(false);
            $table->timestamps();
        });
        Schema::table('teams', function($table) {
            $table->foreign('CountryID')->references('CountryID')->on('countries')->onDelete('cascade');
            $table->foreign('LanguageID')->references('LanguageID')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
