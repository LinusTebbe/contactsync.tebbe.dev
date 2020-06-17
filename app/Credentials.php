<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credentials extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'password'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
