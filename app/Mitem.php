<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mitem extends Model
{
    //
    protected $table = 'mitems';
    protected $fillable = ['title','mtype_id','alias'];

    public function mtype() {
    	return $this->belongsTo('App\Mtype');
    }

    public function pages() {
    	return $this->hasMany('App\Page');
    }
}
