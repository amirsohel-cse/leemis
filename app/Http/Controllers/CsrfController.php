<?php

namespace App\Http\Controllers;

use App\Rating;

class CsrfController extends Controller
{
    function csrfToken(){
        $token = csrf_token();
        return response()->json(['token' => $token], 200);
    }
}
