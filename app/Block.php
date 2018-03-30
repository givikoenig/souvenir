<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
	// protected $table = 'block_page';
	protected $fillable = ['id','name'];
    //
    public function pages() {
    	return $this->belongsToMany('App\Page','block_page')->withPivot('block_id','page_id');
    }
}
