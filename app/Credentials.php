<?php

namespace App;

use App\Traits\UsesCustomStringId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Credentials extends Model
{
    use UsesCustomStringId;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'password'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function resetPassword() {
        $plainTextPassword = Str::random();
        $this->password = Hash::make($plainTextPassword);
        $this->save();
        return $plainTextPassword;
    }
}
