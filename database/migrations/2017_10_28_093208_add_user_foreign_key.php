<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
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
        /*$table->dropForeign('CountryID');
        $table->dropForeign('LanguageID');*/
    }
}
