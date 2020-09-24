<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WebsocketsStatisticsEntry
 * 
 * @property int $id
 * @property string $app_id
 * @property int $peak_connection_count
 * @property int $websocket_message_count
 * @property int $api_message_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models\Base
 */
class WebsocketsStatisticsEntry extends Model
{
	protected $table = 'websockets_statistics_entries';

	protected $casts = [
		'peak_connection_count' => 'int',
		'websocket_message_count' => 'int',
		'api_message_count' => 'int'
	];
}
