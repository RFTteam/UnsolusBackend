<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeammemberUniqueColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('teammembers', function($table) {
            $table->unique(array('TeamId','GamerId'),'unique_teammembers');
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
        Schema::table('teammembers', function ($table) {
            $table->dropForeign('teammembers_teamid_foreign');
            $table->dropForeign('teammembers_gamerid_foreign');
            $table->dropUnique('unique_teammembers');
            $table->foreign('TeamID')->references('TeamID')->on('teams')->onDelete('cascade');
            $table->foreign('GamerID')->references('GamerID')->on('gamerinfo')->onDelete('cascade');
        });
    }
}
