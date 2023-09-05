<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferalPay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('deposits', function (Blueprint $table) {
            //
            $table->double('referral_amount_paid')->nullable();

        });

        Schema::table('advertisers', function (Blueprint $table) {
            //
            $table->double('total_earned')->nullable();

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
        Schema::table('deposits', function (Blueprint $table) {
            //
            $table->dropColumn('referral_amount_paid');

        });

        Schema::table('advertisers', function (Blueprint $table) {
            //
            //$table->dropColumn('total_earned');

        });
    }
}
