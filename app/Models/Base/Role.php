<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $role
 * @property string $display_name
 * 
 * @property Collection|User[] $users_role
 *
 * @package App\Models\Base
 */
class Role extends Model
{
	protected $table = 'roles';
	public $timestamps = false;

	public function users_role()
	{
		return $this->hasMany(User::class);
	}
}
