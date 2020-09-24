<?php

namespace App\Models;

use App\Models\Base\GreenhouseEnvironmentLimit as BaseGreenhouseEnvironmentLimit;

class GreenhouseEnvironmentLimit extends BaseGreenhouseEnvironmentLimit
{
    protected $fillable = [
        'greenhouse_actuator_id',
        'sensor',
        'lower_limit',
        'upper_limit',
        'new_state'
    ];
}
