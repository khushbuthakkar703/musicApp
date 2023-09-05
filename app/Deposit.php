<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public $fillable = ['item_number','transaction_id','currency_code','payment_status','transaction'];
}