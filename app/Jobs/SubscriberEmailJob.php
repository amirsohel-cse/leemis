<?php

namespace App\Jobs;

use App\Mail\Email;
use App\Model\Subscriber;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SubscriberEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new Email($this->details);
        try{
            $subscribes = Subscriber::all()->pluck('email');
            foreach ($subscribes as $subscribe) {
                Mail::to($subscribe)->send($email);
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
