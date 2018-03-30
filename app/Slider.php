<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $fillable = ['price_text','h1_text','h2_text','text','button_text','images','brand_id'];

    public function brand() {
    	return $this->belongsTo('App\Brand');
    }
}
