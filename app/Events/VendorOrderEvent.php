<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VendorOrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $order_id;
    public $order_code;
    public $created_at;
    public $type;
    public $vendors = array();

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $order_id, $order_code, $created_at, $type, $vendors)
    {
        $this->name=$name;
        $this->order_id=$order_id;
        $this->order_code=$order_code;
        $this->created_at = $created_at;
        $this->type = $type;
        $this->vendors = $vendors;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
