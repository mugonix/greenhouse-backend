<?php

namespace App\Models;

use App\Models\Base\User as BaseUser;

class User extends BaseUser
{
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'role_id',
        'first_names',
        'surname',
        'email',
        'username',
        'email_verified_at',
        'password',
        'remember_token',
        'is_approved'
    ];

    public function getNameAttribute()
    {
        return $this->surname." ".$this->first_names;
    }
}
