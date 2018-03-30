<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use \Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

class Comment extends Model
{
    //
	protected $fillable = ['text','user_id','article_id','parent_id'];

	public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("text", "LIKE","%$keyword%");
            });
        }
        return $query;
    }

    public function article() {
    	return $this->belongsTo('App\Article');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
   
}
