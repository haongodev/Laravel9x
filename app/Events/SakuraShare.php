<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use App\Services\SakurasetService;
use Illuminate\Queue\SerializesModels;

class SakuraShare implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sakura;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        $sakura
    ){
        $this->sakura = $sakura;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('sakura.'.getSakuraSetRoom());
    }

    public function broadcastWith()
    {
        return [
            'sakura' => $this->sakura,
        ];
    }
}