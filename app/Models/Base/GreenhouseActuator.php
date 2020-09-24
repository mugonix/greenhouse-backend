<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Greenhouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GreenhouseActuator
 * 
 * @property int $id
 * @property int $greenhouse_id
 * @property string $actuator
 * @property string $state
 * @property int $control_level
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Greenhouse $greenhouse
 *
 * @package App\Models\Base
 */
class GreenhouseActuator extends Model
{
	protected $table = 'greenhouse_actuators';

	protected $casts = [
		'greenhouse_id' => 'int',
		'control_level' => 'int'
	];

	public function greenhouse()
	{
		return $this->belongsTo(Greenhouse::class);
	}
}
