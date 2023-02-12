<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\Admin;
use App\Model\Product;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VendorOrderNotification;
use App\Notifications\OrderNotification;
use App\Events\OrderCompleteEvent;
use App\Events\VendorOrderEvent;
use App\Model\VendorNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function profileUpdate(Request $request)
    {
        $user = auth('sanctum')->user();
        
       
        $rules = [
            'name' => 'required|max:100',
            'gender' => 'nullable',
            'city' => 'max:100',
            'address' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 400);
        }

        $user->name = $request->name;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->city = $request->city;

        //  if there is image
        if ($request->hasFile('image')) {

            $this->removeImage($user);
            $file = $request->file('image');
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $user->image = $filename;
        }

        $user->save();
        return response()->json($user, 200);
    }

    private function removeImage($user)
    {
        if($user->image != "" && \File::exists('uploads/users/' . $user->image)) {
            @unlink(public_path('uploads/users/' . $user->image));
        }
    }
    
    public function generateRandomString($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    
    public function placeOrder(Request $request){
         //----------- unique order code -------------
        
        
       
       
         $order_code = $this->generateRandomString(6);
         
        
       
         $user = auth('sanctum')->user();
       


        $original_order_code = $order_code;
        $count = 0;
        
        
        $same_code = Order::where('order_id', $order_code)->first();
        
        
       
        if($same_code){
            $order_code = $original_order_code.mt_rand(0,9).(++$count);
        }
        
        

           

        $order=Order::create([
            'user_id'=>$user->id,
            'name'=>$request->name,
            'address'=>$request->address,
            'city'=>$request->city,
            'country'=>$request->country ?? '',
            'zip'=>$request->zip,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'note'=>$request->note,
            'payment_method'=>$request->payment_method,
            'subtotal'=>$request->subtotal,
            'shipping_method'=>$request->shipping_method,
            'total'=>$request->total,
            'status'=>'pending',
            'order_id' => $order_code

           ]);
        
        
       
      
        $vendors = array();
        $order_product_id = array();
           if($user){
            $idauth=$user->id;
            if($request->product_cart){
                $cartShop = json_decode($request->product_cart);
                
            }else{
                $cartShop=Cart::where('user_id',$idauth)->get();
            }
            
          

                foreach($cartShop as $confirmOrder){
                    
                    $orderProduct=OrderProduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$confirmOrder->product_id,
                    'qty'=>$confirmOrder->qty,
                    'vendor_id'=>$confirmOrder->vendor_id,
                    'vendor_status' =>'Pending',
                ]);
                    array_push($vendors,$confirmOrder->vendor_id);
                    array_push($order_product_id, $orderProduct->id);
                    VendorNotification::create([
                       'order_code' => $order->order_id,
                        'order_id' => $order->id,
                        'order_product_id' => $orderProduct->id,
                        'name' => $user->name,
                        'type' => 'order',
                        'vendor_id' => $confirmOrder->vendor_id
                    ]);

                    $product = Product::find($confirmOrder->product_id);
                // $product->decrement('stock',$confirmOrder->qty);

            }

        }


        // return $cartShop->product_id;

        $admins = Admin::all();

        //Notification::send( $admins, new OrderNotification( Auth::user()->name, $order->id, $order->order_id));
        if(count( $cartShop)<1){
            return response()->json('Shopping cart is Empty Please Add Some product',401);
        }

        // send notification to all admins
        $admins = Admin::all();
//        $vendors = Vendor::all();
        Notification::send( $admins,new OrderNotification( Auth::user()->name, $order->id, $order->order_id,$vendors, $order_product_id));
        //Notification::send($vendors,new VendorOrderNotification(Auth::user()->name, $order->id, $order->order_id,$vendors));
        //Real time notification by pusher
        $a = date("Y/m/d h:i:sa");
        $name = $user->name;
        $order_id = $order->id;
        $order_code = $order->order_id;
        $created_at = $a;
        $text = 'has placed an order.';
        $type = 'order';
        $response = null;

        event(new OrderCompleteEvent($name,$order_id,$order_code,$created_at,$text,$type,$vendors, $order_product_id));
//        event(new VendorOrderEvent($name,$order_id,$order_code,$created_at,'vendorOrder', $vendors));
        //Real time notification by pusher ends
        
            Cart::where('user_id',$user->id)->delete();
        

        $f=$order->id;
        $orders=OrderProduct::where('order_id',$f)->with('product','order')->get();
        return response()->json(['order' => $order, 'url' => route('mobile-checkout', $order->id)],200);
    }
    
    public function preOrder(Request $request){
        
        if($request->payment_method == 'cash on'){
            
            
            $order_code = $this->generateRandomString(6);
         
        
       
         $user = auth('sanctum')->user();
       


        $original_order_code = $order_code;
        $count = 0;
        
        
        $same_code = Order::where('order_id', $order_code)->first();
        
        
       
        if($same_code){
            $order_code = $original_order_code.mt_rand(0,9).(++$count);
        }
        
        

           

        $order=Order::create([
            'user_id'=>$user->id,
            'name'=>$request->name,
            'address'=>$request->address,
            'city'=>$request->city,
            'country'=>$request->country ?? '',
            'zip'=>$request->zip,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'note'=>$request->note,
            'payment_method'=>$request->payment_method,
            'subtotal'=>$request->subtotal,
            'shipping_method'=>$request->shipping_method,
            'total'=>$request->total,
            'status'=>'pending',
            'order_id' => $order_code

           ]);
        
        
       
      
        $vendors = array();
        $order_product_id = array();
           if($user){
            $idauth=$user->id;
            if($request->product_cart){
                $cartShop = json_decode($request->product_cart);
                
            }else{
                $cartShop=Cart::where('user_id',$idauth)->get();
            }
            
          

                foreach($cartShop as $confirmOrder){
                    
                    $orderProduct=OrderProduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$confirmOrder->product_id,
                    'qty'=>$confirmOrder->qty,
                    'vendor_id'=>$confirmOrder->vendor_id,
                    'vendor_status' =>'Pending',
                ]);
                    array_push($vendors,$confirmOrder->vendor_id);
                    array_push($order_product_id, $orderProduct->id);
                    VendorNotification::create([
                       'order_code' => $order->order_id,
                        'order_id' => $order->id,
                        'order_product_id' => $orderProduct->id,
                        'name' => $user->name,
                        'type' => 'order',
                        'vendor_id' => $confirmOrder->vendor_id
                    ]);

                    $product = Product::find($confirmOrder->product_id);
                // $product->decrement('stock',$confirmOrder->qty);

            }

        }


        // return $cartShop->product_id;

        $admins = Admin::all();

       
        if(count( $cartShop)<1){
            return response()->json('Shopping cart is Empty Please Add Some product',401);
        }

        // send notification to all admins
        $admins = Admin::all();

        Notification::send( $admins,new OrderNotification( Auth::user()->name, $order->id, $order->order_id,$vendors, $order_product_id));
       
        $a = date("Y/m/d h:i:sa");
        $name = $user->name;
        $order_id = $order->id;
        $order_code = $order->order_id;
        $created_at = $a;
        $text = 'has placed an order.';
        $type = 'order';
        $response = null;

        event(new OrderCompleteEvent($name,$order_id,$order_code,$created_at,$text,$type,$vendors, $order_product_id));

        $f=$order->id;
        
        $orders=OrderProduct::where('order_id',$f)->with('product','order')->get();
        
        return response()->json(['order' => $order],200);
        
        
        }
        
         $data = $request->all();
         
         $code = $this->generateRandomString(20);
         
         $data['url'] = route('mobile-checkout', $code);
         
         $data['code'] = $code;
         $data['user_id'] = auth('sanctum')->user()->id;
         
         
         $path = resource_path('lang/');

        fopen($path."$code.json", "w");

        file_put_contents($path."$code.json", json_encode($data));
        
        
        return response()->json($data['url'],200);
        
        
    }
    
}
