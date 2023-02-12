<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Rating;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $data['ratings'] = Rating::all();
        return view('admin.review.list')->with($data);
    }

    public function reviewView($id)
    {
        $data['rating'] = Rating::find($id);
        $data['rating']->read_status = 1;
        $data['rating']->save();
        return view('admin.review.view')->with($data);
    }

    public function reviewMarkedALl()
    {
        $ratings = Rating::where('read_status', 0)->get();
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
