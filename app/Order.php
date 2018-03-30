<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
	protected $fillable = ['order_num', 'user_id', 'delivery_id', 'prim', 'status', 'shipping', 'order_total','delivery_address'];

    public function delivery() {
    	return $this->belongsTo('App\Delivery');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function zakaz_tovar() {
        return $this->hasMany('App\ZakazTovar');
    }
}
