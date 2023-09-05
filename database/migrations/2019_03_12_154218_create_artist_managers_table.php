<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->Integer('points_earned')->unsigned()->default(0);
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->integer('city_id')->nullable();
            $table->json('campaign_ids');
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
        Schema::dropIfExists('artist_managers');
    }
}
