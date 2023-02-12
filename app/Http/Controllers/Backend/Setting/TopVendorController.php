<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Model\Other;
use Illuminate\Http\Request;

class TopVendorController extends Controller
{
    public function topVendor(Request $request)
    {
        $others = Other::all();
        return view('admin.setting.top_vendor_min_amount',['others'=>$others]);
    }

    public function topVendorDetails()
    {
        $data = Other::first();
        return response()->json($data);
    }

    public function storeTopVendor(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|gte:0',
        ]);

        $other = Other::latest()->first();
        if($other){
            $other->top_vendor_amount = $request->amount;
            $other->save();
        } else{
            $other = new Other();
            $other->top_vendor_amount = $request->amount;
            $other->save();
        }

        $data = Other::first();
        return response()->json($data, 200);
    }
    public function editTopVendor(Other $other)
    {
        return response()->json($other,200);
    }
    public function updateTopVendor(Request $request, Other $other)
    {
        $other->top_vendor_amount = $request->amount;
        $other->save();
        return response()->json($other,200);
    }
    public function deleteTopVendor(Other $other)
    {
        $other->top_vendor_amount = null;
        $other->save();
        return response()->json('Successfully Deleted!!!',200);
    }
}
