<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('music_campaigns', function($table) {
             $table->dropColumn('country');
             $table->dropColumn('state');
             $table->dropColumn('genre');
          });

         Schema::table('clubs', function($table) {
             $table->dropColumn('country');
             $table->dropColumn('state');
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
         Schema::table('music_campaigns', function($table) {
             $table->integer('country');
             $table->integer('state');
             $table->integer('genre');
          });

         Schema::table('music_campaigns', function($table) {
             $table->integer('country');
             $table->integer('state');
          });
    }
}
