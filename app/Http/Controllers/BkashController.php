<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use DB;
use App\Events\OrderCompleteEvent;
use App\Events\VendorOrderEvent;
use App\Model\VendorNotification;
use Illuminate\Support\Collection;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\ChildCategory;
use App\Model\Brand;
use App\Model\Product;
use App\Model\Vendor;
use App\Model\Cart;
use App\Model\Shipping;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Slider;
use App\Notifications\VendorOrderNotification;
use App\Rating;
use App\Model\Advertise;
use App\Model\Admin;
use App\Notifications\OrderNotification;
use App\Model\Service;
use App\Model\Gallery;
use App\Model\Campaign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Vendor\Banner;
use App\User;


class BkashController extends Controller
{
    private $base_url;
    private $app_key;
    private $app_secret;
    private $username;
    private $password;

    public function __construct()
    {
        // bKash Merchant API Information

        // You can import it from your Database
        $bkash_app_key = 'Ea8FT4FHrUDl9tiIi68aVQgGch'; // bKash Merchant API APP KEY
        $bkash_app_secret = 'V2p9rUtQhkabPRTpWC1pQw8bgyXr8M3cF9cU0dJjRB1ybK3oIUII'; // bKash Merchant API APP SECRET
        $bkash_username = '01911740672'; // bKash Merchant API USERNAME
        $bkash_password = 'rZo_c5Kd5Q]'; // bKash Merchant API PASSWORD
        $bkash_base_url = 'https://checkout.pay.bka.sh/v1.2.0-beta'; // For Live Production URL: https://checkout.pay.bka.sh/v1.2.0-beta

        $this->app_key = $bkash_app_key;
        $this->app_secret = $bkash_app_secret;
        $this->username = $bkash_username;
        $this->password = $bkash_password;
        $this->base_url = $bkash_base_url;
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

    public function checkout(Request $request)
    {
       session()->put('request1', $request->all());
       
    }

    public function getToken()
    {
        session()->forget('bkash_token');

        $post_token = array(
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret,
        );

        $url = curl_init("$this->base_url/checkout/token/grant");
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            "password:$this->password",
            "username:$this->username",
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);

        $response = json_decode($resultdata, true);

        if (array_key_exists('msg', $response)) {
            return $response;
        }

        session()->put('bkash_token', $response['id_token']);
    }

    public function createPayment(Request $request)
    {
        
        $this->getToken();
       
        $token = session()->get('bkash_token');

        $request['intent'] = 'sale';
        $request['currency'] = 'BDT';
        $request['merchantInvoiceNumber'] = rand();
        
        
        

        $url = curl_init("$this->base_url/checkout/payment/create");
        $request_data_json = json_encode($request->all());
        $header = array(
            'Content-Type:application/json',
            "authorization: $token",
            "x-app-key: $this->app_key",
        );
        

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        
        
        return json_decode($resultdata, true);
    }

    public function executePayment(Request $request)
    {
        $token = session()->get('bkash_token');

        $paymentID = $request->paymentID;
        $url = curl_init("$this->base_url/checkout/payment/execute/" . $paymentID);
        $header = array(
            'Content-Type:application/json',
            "authorization:$token",
            "x-app-key:$this->app_key",
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        
        return json_decode($resultdata, true);
    }

    public function queryPayment(Request $request)
    {
        $token = session()->get('bkash_token');
        $paymentID = $request->payment_info['payment_id'];

        $url = curl_init("$this->base_url/checkout/payment/query/" . $paymentID);
        $header = array(
            'Content-Type:application/json',
            "authorization:$token",
            "x-app-key:$this->app_key",
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        // return json_decode($resultdata, true);
    }

    public function bkashSuccess(Request $request)
    {

        
        // IF PAYMENT SUCCESS THEN YOU CAN APPLY YOUR CONDITION HERE
        if ($request['payment_info']['transactionStatus'] == 'Completed') {
            
            $request = session()->get('request1');
        
            $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request['name']??'',
            'address' => $request['address'] ?? '',
            'city' => $request['city'] ?? '',
            'zip' => $request['zip'] ?? '',
            'phone' => $request['phone'] ?? '',
            'email' => $request['email'] ?? '',
            'note' => $request['note'] ?? '',
            'payment_method' => $request['payment'] ?? '',
            'subtotal' => $request['subtotal'] ?? '',
            'shipping_method' => $request['ship'] ?? '',
            'total' => $request['total'] ?? '',
            'status' => 'pending',
            'order_id' =>$this->generateRandomString(6),

        ]);

            // $order = Order::where('user_id', auth()->id())->latest()->first();

            $vendors = array();
            $order_product_id = array();
            if (Auth::user()) {
                $idauth = Auth::id();
                $cartShop = Cart::where('user_id', $idauth)->get();
                // $cartShopx=Cart::where('user_id',$idauth)->get('product_id');

                // $collection = collect($cartShop['product_id']->toArray());

                // return $collection;
                foreach ($cartShop as $confirmOrder) {
                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $confirmOrder->product_id,
                        'qty' => $confirmOrder->qty,
                        'size' => $confirmOrder->size,
                        'color' => $confirmOrder->color,
                        'vendor_id' => $confirmOrder->vendor_id,
                        'vendor_status' => 'Pending',
                    ]);
                    array_push($vendors, $confirmOrder->vendor_id);
                    array_push($order_product_id, $orderProduct->id);
                    VendorNotification::create([
                        'order_code' => $order->order_id,
                        'order_id' => $order->id,
                        'order_product_id' => $orderProduct->id,
                        'name' => Auth::user()->name,
                        'type' => 'order',
                        'vendor_id' => $confirmOrder->vendor_id,
                    ]);

                    $product = Product::find($confirmOrder->product_id);
                    $product->decrement('stock', $confirmOrder->qty);

                }

            }

            $admins = Admin::all();

            //Notification::send( $admins, new OrderNotification( Auth::user()->name, $order->id, $order->order_id));

            if (count($cartShop) < 1) {
                return Redirect()->route('view.cart')->with('success', 'Shopping cart is Empty Please Add Some product');
            }

            // send notification to all admins
            $admins = Admin::all();
            //        $vendors = Vendor::all();
            Notification::send($admins, new OrderNotification(Auth::user()->name, $order->id, $order->order_id, $vendors, $order_product_id));
            //Notification::send($vendors,new VendorOrderNotification(Auth::user()->name, $order->id, $order->order_id,$vendors));
            //Real time notification by pusher
            $a = date("Y/m/d h:i:sa");
            $name = Auth::user()->name;
            $order_id = $order->id;
            $order_code = $order->order_id;
            $created_at = $a;
            $text = 'has placed an order.';
            $type = 'order';
            event(new OrderCompleteEvent($name, $order_id, $order_code, $created_at, $text, $type, $vendors, $order_product_id));
            //        event(new VendorOrderEvent($name,$order_id,$order_code,$created_at,'vendorOrder', $vendors));
            //Real time notification by pusher ends
            Cart::where('user_id', Auth::id())->delete();
            $f = $order->id;
            $orders = OrderProduct::where('order_id', $f)->with('product', 'order')->get();

            Session::forget('order_id');

            session()->put('orders', $orders);
            
            $path = resource_path()."/lang/".$request['code']."json";

            if(file_exists($path)){
                @unlink($path);
            }

            return response()->json(['status' => true]);
        }

        Session::flash('error', 'Noman Error Message');

        return response()->json(['status' => false]);
    }
    
    public function bkashSuccessMobile(Request $request){
        
        if ($request['payment_info']['transactionStatus'] == 'Completed') {
            
            $request = session()->get('request1');
        
            $order = Order::create([
            'user_id' => session('request1')['user_id'],
            'name' => $request['name']??'',
            'address' => $request['address'] ?? '',
            'city' => $request['city'] ?? '',
            'zip' => $request['zip'] ?? '',
            'phone' => $request['phone'] ?? '',
            'email' => $request['email'] ?? '',
            'note' => $request['note'] ?? '',
            'payment_method' => $request['payment'] ?? '',
            'subtotal' => $request['subtotal'] ?? '',
            'shipping_method' => $request['ship'] ?? '',
            'total' => $request['total'] ?? '',
            'status' => 'pending',
            'order_id' =>$this->generateRandomString(6),

        ]);
           $vendors = array();
            $order_product_id = array();
        
        $cartShop = json_decode(session('request1')['product_cart']);
        $user = User::find(session('request1')['user_id']);
        
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
                    $product->decrement('stock',$confirmOrder->qty);

            }
        
        
        

            // $order = Order::where('user_id', auth()->id())->latest()->first();

         

            $admins = Admin::all();

            Notification::send($admins, new OrderNotification($user->name, $order->id, $order->order_id, $vendors, $order_product_id));
            //Notification::send($vendors,new VendorOrderNotification(Auth::user()->name, $order->id, $order->order_id,$vendors));
            //Real time notification by pusher
            $a = date("Y/m/d h:i:sa");
            $name = $user->name;
            $order_id = $order->id;
            $order_code = $order->order_id;
            $created_at = $a;
            $text = 'has placed an order.';
            $type = 'order';
            event(new OrderCompleteEvent($name, $order_id, $order_code, $created_at, $text, $type, $vendors, $order_product_id));
            //        event(new VendorOrderEvent($name,$order_id,$order_code,$created_at,'vendorOrder', $vendors));
            //Real time notification by pusher ends
    
            $f = $order->id;
            $orders = OrderProduct::where('order_id', $f)->with('product', 'order')->get();

            Session::forget('order_id');

            session()->put('orders', $orders);
            
            $path = resource_path()."/lang/".$request['code'].".json";

            if(file_exists($path)){
                @unlink($path);
            }

            return response()->json(['status' => true]);
        }

        Session::flash('error', 'Noman Error Message');

        return response()->json(['status' => false]);
    }


    public function orderComplete()
    {
        $orders = session('orders');

        return view('frontend.order_complete', compact('orders'));
    }

    public function chk($id)
    {
        return $id;
    }
}
