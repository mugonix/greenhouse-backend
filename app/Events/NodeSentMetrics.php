<?php

namespace App\Events;

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
     * Create a new event instance.
     *
     * @param $greenhouse_metrics
     */
    public function __construct(GreenhouseMetric $greenhouse_metrics)
    {
        $this->greenhouse_metrics = $greenhouse_metrics;
        $this->post_time = $greenhouse_metrics->created_at->format("H:i");
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
