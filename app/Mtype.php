<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mtype extends Model
{
    //
	protected $table = 'mtypes';

	public function mitems() {
    	return $this->hasMany('App\Mitem');
    }

}
