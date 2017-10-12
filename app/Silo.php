<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Silo extends Model
{
    //
    protected $fillable = [
        'number', 'volume', 'content', 'type', 'silo_id', 'id'
    ];

    public function type(){
    	return $this->hasOne('App\SiloType');
    }

    public function content(){
    	return $this->hasOne('App\SiloContent');
    }
}
