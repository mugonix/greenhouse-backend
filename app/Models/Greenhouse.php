<?php

namespace App\Models;

use App\Models\Base\Greenhouse as BaseGreenhouse;

class Greenhouse extends BaseGreenhouse
{
	protected $fillable = [
		'owner_id',
		'code',
		'name',
		'api_token'
	];

    protected $hidden = [
        'api_token'
    ];

    public function greenhouse_actuators()
    {
        return $this->hasMany(GreenhouseActuator::class);
    }

    public function greenhouse_metrics()
    {
        return $this->hasMany(GreenhouseMetric::class);
    }

    public function greenhouse_environment_limits()
    {
        return $this->hasMany(GreenhouseEnvironmentLimit::class);
    }

}
