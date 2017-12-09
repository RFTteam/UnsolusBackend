<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameGamerinfoColumn extends Migration
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
            $table->renameColumn('Region', 'Style');
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
            $table->renameColumn('Style', 'Region');
        });
    }
}
