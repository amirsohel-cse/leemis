<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderStatusEmail;
use Mail;


class OrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //$email = new OrderStatusEmail($this->data['email']);
       // Mail::to($this->data['email'])->send($email);

         Mail::to($this->data['email'])->send(new OrderStatusEmail($this->data));
    }
}
