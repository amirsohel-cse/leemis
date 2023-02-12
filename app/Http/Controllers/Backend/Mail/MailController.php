<?php

namespace App\Http\Controllers\Backend\Mail;

use App\Http\Controllers\Controller;
use App\Jobs\CustomerEmailJob;
use App\Jobs\SubscriberEmailJob;
use App\Jobs\VendorEmailJob;
use App\Model\Customer;
use App\Model\Vendor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MailController extends Controller
{
    
    public function sendEmail(Request $request) {
        $this->validate($request,[
            'emailGroup' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);

        $details = [
            'emailGroup' => $request->emailGroup,
            'subject' => $request->subject,
            'body' => $request->body,
        ];


        if ($request->emailGroup == 1) {
            $emailJob = (new VendorEmailJob($details))->delay(Carbon::now()->addSecond(1));
            
        } else if ($request->emailGroup == 2) {
            $emailJob = (new CustomerEmailJob($details))->delay(Carbon::now()->addSecond(1));
            
        }else if ($request->emailGroup == 3) {
            $emailJob = (new SubscriberEmailJob($details))->delay(Carbon::now()->addSecond(1));
            
        }
        dispatch($emailJob);   
        return redirect()->back();
    }

}
