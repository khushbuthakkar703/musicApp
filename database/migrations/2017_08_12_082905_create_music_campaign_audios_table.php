<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicCampaignAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_campaign_audios', function (Blueprint $table) {
          $table->increments('id');
          $table->Integer('campaign_id')->unique();
          $table->string('audio')->nullable();
          $table->string('company_name');
          $table->string('artist_website');
          $table->string('song_title');
          $table->date('release_date');
          $table->string('isrc');
          $table->string('upc');
          $table->string('genre')->nullable();
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
        Schema::dropIfExists('music_campaign_audios');
    }
}
