<?php

namespace App\Events;

use App\Models\GreenhouseActuator;
use App\Models\GreenhouseMetric;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NodeSentMetrics implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $greenhouse_metrics;
    public $post_time;
    /**
     * @var GreenhouseActuator
     */
    public $greenhouse_actuator;

    public $month_utilisation;

    /**
     * Create a new event instance.
     *
     * @param GreenhouseMetric $greenhouse_metrics
     * @param  $greenhouse_actuator
     */
    public function __construct(GreenhouseMetric $greenhouse_metrics, $greenhouse_actuator)
    {
        $this->greenhouse_metrics = $greenhouse_metrics;
        $this->post_time = $greenhouse_metrics->created_at->format("H:i");
        $this->greenhouse_actuator = $greenhouse_actuator;

        $this->month_utilisation = GreenhouseMetric::selectRaw("IFNULL(ROUND(SUM(`water_volume`)/1000,3),0)  as 'total_water_volume',
        IFNULL(ROUND(SUM(`energy_unit`)*(COUNT(id)/60/60),2),0)  as 'total_energy_unit'")
            ->where("greenhouse_id", $greenhouse->id)
            ->whereRaw("DATE(created_at) >= DATE(DATE_SUB(NOW(), INTERVAL 1 MONTH))")
            ->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new PrivateChannel("App.Greenhouse.{$this->greenhouse_metrics->greenhouse->code}");
    }
}
