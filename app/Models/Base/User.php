<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Greenhouse;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as UserAlias;

/**
 * Class User
 *
 * @property int $id
 * @property int $role_id
 * @property string $first_names
 * @property string $surname
 * @property string $email
 * @property string $username
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property int $is_approved
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Role $role
 * @property Collection|Greenhouse[] $greenhouses_owner
 *
 * @package App\Models\Base
 */
class User extends UserAlias
{
    protected $table = 'users';

    protected $casts = [
        'role_id' => 'int',
        'is_approved' => 'int'
    ];

    protected $dates = [
        'email_verified_at'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function greenhouses_owner()
    {
        return $this->hasMany(Greenhouse::class, 'owner_id');
    }
}
