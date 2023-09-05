<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentifiedMusicAllsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identified_music_alls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('music_id');
            $table->integer('dj_id');
            $table->string('message')->default('--');
            $table->timestamp('played_timestamp');
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
        Schema::dropIfExists('identified_music_alls');
    }
}
