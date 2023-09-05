<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{

    const STATUS_PENDING = "PENDING";
    const STATUS_APPROVE = "APPROVE";
    const STATUS_CANCEL = "CANCEL";
    const STATUS_HOLD = "HOLD";
    const STATUS_UNHOLD = "UNHOLD";

    protected $fillable = [
        'user_id',
        'title',
        'start_date',
        'end_date',
        'image',
        'video_url',
        'total_days',
        'status'
    ];
}
