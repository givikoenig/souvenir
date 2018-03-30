<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['id','title','text','desc','alias','img','keywords','meta_desc','category_id','excerption','post','user_id'];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%")
                    ->orWhere("text", "LIKE", "%$keyword%")
                    ->orWhere("desc", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function comments() {
    	return $this->hasMany('App\Comment');
    }
    public function likes() {
        return $this->hasMany('App\Like');
    }

}
