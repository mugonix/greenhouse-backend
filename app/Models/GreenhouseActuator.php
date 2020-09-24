<?php

namespace App\Models;

use App\Models\Base\GreenhouseActuator as BaseGreenhouseActuator;

class GreenhouseActuator extends BaseGreenhouseActuator
{
	protected $fillable = [
		'greenhouse_id',
		'actuator',
		'state',
		'control_level'
	];

	const DEFAULT_LEVEL = 0;
	const CONDITION_LEVEL = 1;
	const OVERRIDE_LEVEL = 2;
}
