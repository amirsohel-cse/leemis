<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OnlinePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {

    
     $user = auth('sanctum')->user();
     
     return response()->json(Order::with('orderProduct.product','orderProduct.vendor')->where('user_id', $user->id)->get());
        
    }
    
    
    public function pay(Request $request){
       

       
        // $onlinePayment = OnlinePayment::create([
        //     'order_id'=>$request->order_id,
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'phone'=>$request->phone,
        //     'amount'=>$request->amount,
        //     'address'=>$request->address,
        //     'status'=>$request->status
            
        // ]);
        
        
        if($request->status =='confirm'){
            
            $orderUpdate=Order::where('order_id',$request->order_id)->first();
            
            $orderUpdate->status='completed';
            
            $orderUpdate->save();
            
        }
        
        if($request->status =='cancel'){
             $orderUpdate=Order::where('order_id',$request->order_id)->first();
            
            $orderUpdate->status='Failed';
            
            $orderUpdate->save();
        }
        
        if($request->status =='fail'){
            $orderUpdate=Order::where('order_id',$request->order_id)->first();
            
            $orderUpdate->status='Failed';
            
            $orderUpdate->save();
        }
        
         return response()->json('OK',200);
        
    }
}
