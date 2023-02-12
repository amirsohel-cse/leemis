<?php

namespace App\Http\Controllers\Backend\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailSettingContrller extends Controller
{
    public function viewMailSettingPage()
    {
        return view('admin.email.email-setting');
    }
}
