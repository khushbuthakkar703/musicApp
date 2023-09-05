<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('identified_music_alls', function (Blueprint $table) {
            //
            $table->integer('club_id');
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('timezone_offset');

        });

        Schema::table('identified_musics', function (Blueprint $table) {
            //
            $table->integer('identified_music_alls_id');
            $table->boolean('paid')->default(0);
            $table->integer('club_id');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('identified_music_alls', function (Blueprint $table) {
            $table->dropColumn('club_id');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('timezone_offset');
            
        });

        Schema::table('identified_musics', function (Blueprint $table) {
            $table->dropColumn('identified_music_alls_id');
            $table->dropColumn('paid');
            $table->dropColumn('club_id');
        });
    }
}
