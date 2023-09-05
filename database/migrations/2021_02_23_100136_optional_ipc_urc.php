<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OptionalIpcUrc extends Migration
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
            $table->string('isrc', 20)->nullable()->change();
            $table->string('upc', 20)->nullable()->change();
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
        Schema::table('music_campaign_audios', function($table)
        {
            $table->string('isrc', 20)->change();
            $table->string('upc', 20)->change();
        });
    }
}
