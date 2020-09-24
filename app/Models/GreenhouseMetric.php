<?php

namespace App\Models;

use App\Models\Base\GreenhouseMetric as BaseGreenhouseMetric;

class GreenhouseMetric extends BaseGreenhouseMetric
{
	protected $fillable = [
		'greenhouse_id',
		'temperature',
		'humidity',
		'temperature_outdoor',
		'humidity_outdoor',
		'air_quality',
		'soil_moisture',
		'water_volume',
		'energy_unit'
	];


}
