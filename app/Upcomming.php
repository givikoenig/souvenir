<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upcomming extends Model
{
    //
	protected $dates = ['until_date'];
	protected $fillable = ['until_date', 'img_362x350','title', 'text', 'link', 'banner_text', 'banner_image', 'product_id'];

    public function product() {
    	return $this->belongsTo('App\Product');
    }
}
