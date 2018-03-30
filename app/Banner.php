<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
	protected $fillable = ['position','text','product_id','images'];
    //
    public function product() {
    	return $this->belongsTo('App\Product');
    }
}
