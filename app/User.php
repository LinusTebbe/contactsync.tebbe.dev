<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'avatar',
        'access_token',
        'refresh_token',
        'expires_in',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token',
        'refresh_token',
        'expires_in'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->access_token;
    }

    public function credentials()
    {
        return $this->hasMany('App\Credentials');
    }
}
