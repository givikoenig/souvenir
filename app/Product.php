<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    //
    use Sortable;

    protected $fillable = ['name','subbrand_id','articul', 'images','img_slide','price','old_price','anons','content','visible','available','hits','new','sale','spec','techs','keywords','meta_desc'];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("articul", "LIKE", "%$keyword%")
                    ->orWhere("price", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    public $sortable = ['id',
                        'name',
                        'price',
                        'created_at',
                        'updated_at'];

    public function subbrand() {
    	return $this->belongsTo('App\Subbrand');
    }

    public function banner() {
    	return $this->hasOne('App\Banner');
    }

    public function upcomming() {
    	return $this->hasOne('App\Upcomming');
    }
}
