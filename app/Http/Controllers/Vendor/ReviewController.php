<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Model\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $data['ratings'] = Rating::whereVendorId(Auth::user()->id)->get();
        return view('vendor.review.list')->with($data);
    }

    public function reviewView($id)
    {
        $data['rating'] = Rating::find($id);
        $data['rating']->read_status = 1;
        $data['rating']->save();
        return view('vendor.review.view')->with($data);
    }

    public function reviewMarkedALl()
    {
        $ratings = Rating::where('read_status', 0)->whereVendorId(Auth::user()->id)->get();
        if (count($ratings) > 0){
            foreach (@$ratings as $item)
            {
                $rating = Rating::find($item->id);
                $rating->read_status = 1;
                $rating->save();
            }
        }
        return redirect()->back();
    }
}
