<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'fio', 'email', 'phone', 'address', 'password', 'confirmed', 'avatar', 'token'
    ];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                ->orWhere("fio", "LIKE", "%$keyword%")
                ->orWhere("address", "LIKE", "%$keyword%")
                ->orWhere("email", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

}
