<?php

namespace App\Http\Controllers;

use App\Model\Rating;
use Illuminate\Support\Facades\View;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
     public function __construct()
    {
        $ratings_all = Rating::select('id','user_id','vendor_id','product_id','rating','review','name','read_status')->where('read_status', 0)->limit(15)->latest()->get();

        //Vendor Only
        $vendor_rating_count = Rating::select('id','user_id','vendor_id','product_id','rating','review','name','read_status')->where('read_status', 0)->count();

        View::share(compact('ratings_all','vendor_rating_count'));
    }
}
