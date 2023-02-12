<?php

namespace App\Http\Controllers\Backend\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Other;

class MinimumWithdrawController extends Controller
{
    public function index()
    {
        $others = Other::select('id','min_withdraw_amount')->get();
        return view('admin.setting.minimum-withdraw',['others'=>$others]);
    }


    public function storeMinimumWithdraw(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|gte:0',
        ]);

        $other = Other::latest()->first();
        if($other){
            $other->min_withdraw_amount = $request->amount;
            $other->save();
        } else{
            $other = new Other();
            $other->min_withdraw_amount = $request->amount;
            $other->save();
        }

        $data = Other::latest()->first();
        return response()->json($data, 200);
    }
    public function editMinimumWithdraw()
    {
        $data = Other::first();
        return response()->json($data,200);
    }

}
