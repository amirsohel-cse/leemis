<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Model\FacebookPixel;
use Illuminate\Http\Request;

class PixelController extends Controller
{
    public function index()
    {
        $pixel = FacebookPixel::first();
        return view('admin.pixel.pixel-view',compact('pixel'));
    }

    public function details()
    {
        $pixel = FacebookPixel::first();
        return response()->json($pixel,200);
    }

    public function store(Request $request)
    {
        $pixel = FacebookPixel::first();
        if ($pixel){
            $pixel->facebook_account_name = $request->facebook_account_name;
            $pixel->pixel_name = $request->pixel_name;
            $pixel->pixel_id = $request->pixel_id;
            $pixel->save();
            return response()->json('Facebook Pixel Setup Updated Successfully!!!');
        }else{
            $pixel1 = new FacebookPixel();
            $pixel1->facebook_account_name = $request->facebook_account_name;
            $pixel1->pixel_name = $request->pixel_name;
            $pixel1->pixel_id = $request->pixel_id;
            $pixel1->save();
            return response()->json('Facebook Pixel Setup Completed!!!');
        }

    }
}
