<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VendorSignupEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $phone;
    public $created_at;
    public $text;
    public $type;
    public $note_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name,$phone,$created_at,$text,$type,$note_id)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->created_at = $created_at;
        $this->text = $text;
        $this->type = $type;
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
