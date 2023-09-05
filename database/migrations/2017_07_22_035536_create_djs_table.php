<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('djs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dj_name');
            //$table->string('club_name');
            $table->Integer('user_id');
            $table->Integer('invited_by'); //manager
            $table->Integer('points_earned')->unsigned()->default(0);
            $table->Integer('total_spin')->unsigned()->default(0);
            $table->string('phone_number')->nullable();
            $table->integer('city_id');
            $table->string('zipcode')->nullable();
            $table->longText('description')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('software');


            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('soundcloud')->nullable();
            $table->string('youtube')->nullable();


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
        Schema::dropIfExists('djs');
    }
}
