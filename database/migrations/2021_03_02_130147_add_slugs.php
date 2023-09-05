<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('music_campaigns', function($table)
        {
            $table->string('slug')->nullable();
        });

        Schema::table('djs', function($table)
        {
            $table->string('slug')->nullable();
        });

        DB::raw("update djs set djs.slug= concat(LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(dj_name), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-')), '-', id) where id>0");
        DB::raw("update music_campaigns inner join music_campaign_audios on music_campaign_audios.campaign_id = music_campaigns.id set music_campaigns.slug = concat(LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(music_campaign_audios.song_title), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-')), '-', music_campaigns.id) where music_campaigns.id > 0");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('music_campaigns', function($table)
        {
            $table->dropColumn('slug');
        });

        Schema::table('djs', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
