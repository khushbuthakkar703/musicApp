<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Social extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('music_campaign_audios', function(Blueprint $table){
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
        });

        Schema::table('music_campaigns', function(Blueprint $table){
            $table->string('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('music_campaign_audios', function(Blueprint $table){
            $table->dropColumn('instagram');
            $table->dropColumn('facebook');
        });

        Schema::table('music_campaigns', function(Blueprint $table){
            $table->dropColumn('bio');
        });
        //
    }
}
