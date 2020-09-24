<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Greenhouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GreenhouseEnvironmentLimit
 *
 * @property int $id
 * @property int $greenhouse_id
 * @property string $sensor
 * @property float $lower_limit
 * @property float $upper_llimit
 * @property string $new_state
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Greenhouse $greenhouse
 *
 * @package App\Models\Base
 */
class GreenhouseEnvironmentLimit extends Model
{
	protected $table = 'greenhouse_environment_limits';

	protected $casts = [
		'greenhouse_id' => 'int',
		'lower_limit' => 'float',
		'upper_limit' => 'float'
	];

	public function greenhouse()
	{
		return $this->belongsTo(Greenhouse::class);
	}
}
