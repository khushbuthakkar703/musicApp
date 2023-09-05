<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('djmanager')->default(0);
            $table->Integer('accepted')->default(0);
            $table->Integer('campaign_balance')->default(0);
            $table->Integer('user_id');
            $table->string('campaign_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('company_name');
            $table->string('country');
            $table->string('state');
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('phone');
            $table->enum('spin_rate',[0, 5, 10, 15, 20, 25])->default(0);
            $table->Integer('likes')->unsigned()->default(0);
            $table->Integer('dislikes')->unsigned()->default(0);
            $table->Integer('genre')->nullable();
            $table->Integer('bpm')->nullable();
            $table->Integer('featured_music')->nullable();
            $table->date('start_date')->nullable();
            $table->Integer('total_spin')->default(0);
            $table->boolean('enabled')->default(false);
            $table->string('last_deposit')->default(0);
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
        Schema::dropIfExists('music_campaigns');
    }
}
