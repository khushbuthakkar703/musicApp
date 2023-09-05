<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeatureYoutubeAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('music_campaign_audios', function (Blueprint $table) {
            $table->string('youtube_feature')->nullable();
            $table->string('music_feature')->nullable();
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
        Schema::table('music_campaign_audios', function (Blueprint $table) {
            //
            $table->dropColumn('youtube_feature');
            $table->dropColumn('music_feature');

        });
    }
}
