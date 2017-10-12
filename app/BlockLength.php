<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockLength extends Model
{
    //
	public $guarded = ['id'];

    public function block(){
    	return $this->belongsTo('App\Block');
    }
}
