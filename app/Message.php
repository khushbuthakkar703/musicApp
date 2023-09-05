<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [ 'message', 'sender_id', 'receiver_id' ];
    public function sender() {

        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getText(){
        return $this->value('message');
    }

}
