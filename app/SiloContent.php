<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiloContent extends Model
{
	public $guarded = ['id'];

    public function silo(){
    	return $this->belongsTo('App\Silo');
    }
}
