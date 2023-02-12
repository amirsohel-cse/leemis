<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // return $this->view('emails.orders.status');
        return $this->markdown('emails.orders.status')
        ->subject("Order Status")
        ->with([
            'data'=>$this->data
        ]);


    }
}
