<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRankRoleRegionColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('gamerinfo', function (Blueprint $table) {
            $table->string('Rank',20)->nullable();
            $table->string('Role',20)->nullable();
            $table->string('Region',20)->nullable();
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
            $table->dropColumn(['Rank', 'Role', 'Region']);
        });
    }
}
