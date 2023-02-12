<?php

namespace App\Jobs;

use App\Mail\Email;
use App\Model\Customer;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CustomerEmailJob implements ShouldQueue
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
        $this->details;
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
            $customers = Customer::all()->pluck('email');
            foreach ($customers as $customer) {
                Mail::to($customer)->send($email);
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
