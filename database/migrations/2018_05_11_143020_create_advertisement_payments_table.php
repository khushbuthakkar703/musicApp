<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertisement_id');
            $table->string('transaction_id');
            $table->string('currency_code');
            $table->integer('per_day_amount');
            $table->integer('amount');
            $table->string('payment_status');
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
        Schema::dropIfExists('advertisement_payments');
    }
}
