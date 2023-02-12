<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WithdrawEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $vendor_id;
    public $amount;
    public $text;
    public $type;
    public $created_at;
    public $note_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $vendor_id, $amount, $text, $type, $created_at, $note_id)
    {
        $this->name = $name;
        $this->vendor_id = $vendor_id;
        $this->amount = $amount;
        $this->text = $text;
        $this->type = $type;
        $this->created_at = $created_at;
        $this->note_id = $note_id;
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
