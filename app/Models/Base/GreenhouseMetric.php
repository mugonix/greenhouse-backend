<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Greenhouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GreenhouseMetric
 * 
 * @property int $id
 * @property int $greenhouse_id
 * @property float $temperature
 * @property float $temperature_outdoor
 * @property float $humidity
 * @property float $humidity_outdoor
 * @property float $air_quality
 * @property float $soil_moisture
 * @property float $water_volume
 * @property float $energy_unit
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Greenhouse $greenhouse
 *
 * @package App\Models\Base
 */
class GreenhouseMetric extends Model
{
	protected $table = 'greenhouse_metrics';

	protected $casts = [
		'greenhouse_id' => 'int',
		'temperature' => 'float',
		'temperature_outdoor' => 'float',
		'humidity' => 'float',
		'humidity_outdoor' => 'float',
		'air_quality' => 'float',
		'soil_moisture' => 'float',
		'water_volume' => 'float',
		'energy_unit' => 'float'
	];

	public function greenhouse()
	{
		return $this->belongsTo(Greenhouse::class);
	}
}
