<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockType extends Model
{
	public $guarded = ['id'];

    public function stock(){
    	return $this->belongsTo('App\Stock');
    }
}
