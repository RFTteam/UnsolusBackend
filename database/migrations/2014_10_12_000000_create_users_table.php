<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('UserID');
            $table->string('Username',50)->unique()->nullable(false);
            $table->string('Email',50)->unique()->nullable(false);
            //$table->string('Country',40);
            //$table->string('Lang',20);
            $table->integer('CountryID')->unsigned()->nullable();
            $table->integer('LanguageID')->unsigned()->nullable();
            $table->date('DateOfBirth')->nullable();
            $table->string('Password',80)->nullable(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
