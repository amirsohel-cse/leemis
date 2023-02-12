<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $name;
    public $order_id;
    public $order_code;
    public $vendors = array();
    public $order_product_id = array();
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $order_id, $order_code,$vendors, $order_product_id)
    {
        $this->name=$name;
        $this->order_id=$order_id;
        $this->order_code=$order_code;
        $this->vendors = $vendors;
        $this->order_product_id = $order_product_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name'=>$this->name,
            'order_id'=>$this->order_id,
            'order_code'=>$this->order_code,
            'vendors' => $this->vendors,
            'text'=>'has placed an order.',
            'type' => 'order',
            'order_product_id' => $this->order_product_id
        ];
    }


}
