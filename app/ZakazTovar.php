<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZakazTovar extends Model
{
    //
	protected $fillable = ['name', 'price', 'order_id', 'product_id'];

    protected $table = 'zakaz_tovar';

    public function order() {
    	return $this->belongsTo('App\Order');
    }
}
