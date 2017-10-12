<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiloType extends Model
{
    //
    protected $fillable = [
        'id', 'type', 'silo_id'
    ];

    public function silo(){
    	return $this->belongsTo('App\Silo');
    }
}
