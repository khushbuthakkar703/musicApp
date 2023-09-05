<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDjEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     t I need 
     */
    public function up()
    {
        Schema::create('dj_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dj_id');
            $table->string('name');
            $table->integer('city_id');
            $table->string('address');
            $table->integer('estimated_attendance');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('website_url');
            $table->string('status')->default('pending');
            $table->string('message')->nullable();
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
        Schema::dropIfExists('dj_events');
    }
}
