<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMotivationServerColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gamerinfo', function (Blueprint $table) {
            $table->string('Server',20)->nullable();
            $table->string('Motivation',40)->nullable();
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
        Schema::table('gamerinfo', function (Blueprint $table) {
            $table->dropColumn(['Server', 'Motivation']);
        });
    }
}
