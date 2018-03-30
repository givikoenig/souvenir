<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subbrand extends Model
{
    //
    protected $fillable = ['name','alias','images','brand_id','keywords','meta_desc'];

    public function brand() {

    	return $this->belongsTo('App\Brand');

    }
    public function products() {
    	return $this->hasMany('App\Product');
    }
}
