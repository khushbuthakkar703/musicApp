<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFpStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('music_campaign_audios', function($table)
        {
            $table->string('fp_status')->default("MUSIC_ADDED");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('music_campaign_audios', function($table)
        {
            $table->dropColumn('fp_status');
        });
    }
}
