<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TempSpinRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('music_campaigns', function (Blueprint $table) {
            //
            $table->String('temp_spin_rate')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('music_campaigns', function (Blueprint $table) {
            //
            $table->dropColumn('temp_spin_rate');

        });
        //
    }
}
