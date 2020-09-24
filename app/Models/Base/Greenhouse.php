<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\GreenhouseActuator;
use App\Models\GreenhouseEnvironmentLimit;
use App\Models\GreenhouseMetric;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as UserAlias;


/**
 * Class Greenhouse
 *
 * @property int $id
 * @property int $owner_id
 * @property string $code
 * @property string $name
 * @property string $api_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $owner
 * @property Collection|GreenhouseActuator[] $greenhouse_actuators_greenhouse
 * @property Collection|GreenhouseEnvironmentLimit[] $greenhouse_environment_limits_greenhouse
 * @property Collection|GreenhouseMetric[] $greenhouse_metrics_greenhouse
 *
 * @package App\Models\Base
 */
class Greenhouse extends UserAlias
{
	protected $table = 'greenhouses';

	protected $casts = [
		'owner_id' => 'int'
	];

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function greenhouse_actuators_greenhouse()
	{
		return $this->hasMany(GreenhouseActuator::class);
	}

	public function greenhouse_environment_limits_greenhouse()
	{
		return $this->hasMany(GreenhouseEnvironmentLimit::class);
	}

	public function greenhouse_metrics_greenhouse()
	{
		return $this->hasMany(GreenhouseMetric::class);
	}
}
