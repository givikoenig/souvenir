<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
	protected $table = 'pages';
	protected $fillable = ['name', 'title', 'permanent', 'text', 'desc', 'excerption', 'img', 'alias','mitem_id', 'keywords', 'meta_desc'];

    public function blocks() {
    	return $this->belongsToMany('App\Block','block_page')->withPivot('block_id','page_id');
    }

    public function mitem() {
    	return $this->belongsTo('App\Mitem');
    }

}
