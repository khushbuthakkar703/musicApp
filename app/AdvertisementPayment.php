<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementPayment extends Model
{
    //
    protected $fillable = [
        'advertisement_id',
        'transaction_id',
        'currency_code',
        'per_day_amount',
        'amount',
        'payment_status'
    ];
}
