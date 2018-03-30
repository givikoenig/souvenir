<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Brand extends Model
{
    //
	use Sortable;

	public $sortable = ['id',
                        'name',
                        'alias',
                        'created_at',
                        'updated_at'];

    protected $fillable = ['name','alias','images','keywords','meta_desc'];

    public function subbrands() {
    	return $this->hasMany('App\Subbrand');
    }
    public function sliders() {
        return $this->hasMany('App\Slider');
    }

}
