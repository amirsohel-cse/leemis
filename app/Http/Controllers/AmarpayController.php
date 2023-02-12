<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Events\OrderCompleteEvent;
use App\Events\VendorOrderEvent;
use App\Model\VendorNotification;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie;



class AmarpayController extends Controller
{
    private $r;

     public function index(Request $request){

         Session::forget('request1');
          Session::forget('ordercode');





          function generateRandomString($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $order_code = generateRandomString(6);

                // if order code is same, add extra 2 digits to make it unique
        $original_order_code = $order_code;
        $count = 0;
        while(true){
            $same_code = Order::where('order_id', $order_code)->first();
            if($same_code){
                $order_code = $original_order_code.mt_rand(0,9).(++$count);
            }
            else{
                break;
            }
        }

            Session::put('ordercode',$order_code);









        // 'user_id'=>Auth::id(),
        // 'name'=>$request->name,
        // 'address'=>$request->address,
        // 'city'=>$request->city,
        // 'country'=>$request->country,
        // 'zip'=>$request->zip,
        // 'phone'=>$request->phone,
        // 'email'=>$request->email,
        // 'note'=>$request->note,
        // 'payment_method'=>$request->payment,
        // 'subtotal'=>$request->subtotal,
        // 'shipping_method'=>$request->ship,
        // 'total'=>$request->total,
        // 'status'=>'pending',
        // 'order_id' => $order_code,


        //session()->put('request1',$request->all());

        Session::put('request1',$request->all());
        Session::save();
       //$this->r = $request->all();
       //dd($this->r);

        //cookie('request', 'badhon', 120);
        //dd($cookie);




















        $url = 'https://secure.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
            $fields = array(
                'store_id' => 'aayan', //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                 'amount' => $request->total, //transaction amount
                'payment_type' => 'VISA', //no need to change
                'currency' => 'BDT',  //currenct will be USD/BDT
                'tran_id' => $order_code, //transaction id must be unique from your end
                'cus_name' => $request->name,  //customer name
                'cus_email' => $request->email, //customer email address
                'cus_add1' => $request->address,  //customer address
                'cus_add2' => '', //customer address
                'cus_city' => '',  //customer city
                'cus_state' => '',  //state
                'cus_postcode' => '', //postcode or zipcode
                'cus_country' => 'Bangladesh',  //country
                'cus_phone' => $request->phone, //customer phone number
                'cus_fax' => 'Not¬Applicable',  //fax
                'ship_name' => $request->ship, //ship name
                'ship_add1' => '',  //ship address
                'ship_add2' => 'Mohakhali',
                'ship_city' => 'Dhaka',
                'ship_state' => 'Dhaka',
                'ship_postcode' => '1212',
                'ship_country' => 'Bangladesh',
                'desc' => 'payment description',
                'success_url' => route('success'), //your success route
                'fail_url' => route('fail'), //your fail route
                'cancel_url' => 'http://localhost/foldername/cancel.php', //your cancel url
                'opt_a' => 'Reshad',  //optional paramter
                'opt_b' => 'Akil',
                'opt_c' => 'Liza',
                'opt_d' => 'Sohel',
                'signature_key' => '62d57e1a216295a549476b9c562d8ab9'); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

                $fields_string = http_build_query($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
            curl_close($ch);


            $this->redirect_to_merchant($url_forward);
    }















    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); }
          </script></head>
          <body onLoad="closethisasap();">

            <form name="redirectpost" method="post" action="<?php echo 'https://secure.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php
        exit;
    }


    public function success(Request $req)
    {







        $request = Session::get('request1');

        //dd($req->name);
        //$a=$req->cookie('request');
       // dd($request);


        $order=Order::create([
            'user_id'=>Auth::id(),
            'name'=>$request['name'],
            'address'=>$request['address'],
            'city'=>$request['city'],

            'zip'=>$request['zip'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
            'note'=>$request['note'],
            'payment_method'=>$request['payment'],
            'subtotal'=>$request['subtotal'],
            'shipping_method'=>$request['ship'],
            'total'=>$request['total'],
            'status'=>'pending',
            'order_id' => Session::get('ordercode'),


        ]);

        $vendors = array();
        $order_product_id = array();
           if(Auth::user()){
            $idauth=Auth::id();
            $cartShop=Cart::where('user_id',$idauth)->get();
            // $cartShopx=Cart::where('user_id',$idauth)->get('product_id');

            // $collection = collect($cartShop['product_id']->toArray());

            // return $collection;
                foreach($cartShop as $confirmOrder){
                    $orderProduct=OrderProduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$confirmOrder->product_id,
                    'qty'=>$confirmOrder->qty,
                    'size'=>$confirmOrder->size,
                    'color'=>$confirmOrder->color,
                    'vendor_id'=>$confirmOrder->vendor_id,
                    'vendor_status' =>'Pending',
                ]);
                    array_push($vendors,$confirmOrder->vendor_id);
                    array_push($order_product_id, $orderProduct->id);
                    VendorNotification::create([
                       'order_code' => $order->order_id,
                        'order_id' => $order->id,
                        'order_product_id' => $orderProduct->id,
                        'name' => Auth::user()->name,
                        'type' => 'order',
                        'vendor_id' => $confirmOrder->vendor_id
                    ]);

                    $product = Product::find($confirmOrder->product_id);
                $product->decrement('stock',$confirmOrder->qty);

            }

        }

        $admins = Admin::all();

        //Notification::send( $admins, new OrderNotification( Auth::user()->name, $order->id, $order->order_id));


        if(count( $cartShop)<1){
            return Redirect()->route('view.cart')->with('success', 'Shopping cart is Empty Please Add Some product');
        }

        // send notification to all admins
        $admins = Admin::all();
   //        $vendors = Vendor::all();
        Notification::send( $admins,new OrderNotification( Auth::user()->name, $order->id, $order->order_id,$vendors, $order_product_id));
        //Notification::send($vendors,new VendorOrderNotification(Auth::user()->name, $order->id, $order->order_id,$vendors));
        //Real time notification by pusher
        $a = date("Y/m/d h:i:sa");
        $name = Auth::user()->name;
        $order_id = $order->id;
        $order_code = $order->order_id;
        $created_at = $a;
        $text = 'has placed an order.';
        $type = 'order';
        event(new OrderCompleteEvent($name,$order_id,$order_code,$created_at,$text,$type,$vendors, $order_product_id));
   //        event(new VendorOrderEvent($name,$order_id,$order_code,$created_at,'vendorOrder', $vendors));
        //Real time notification by pusher ends
        Cart::where('user_id',Auth::id())->delete();
        $f=$order->id;
        $orders=OrderProduct::where('order_id',$f)->with('product','order')->get();

        Session::forget('request1');

        // $r=Order::latest()->first();
        // $orders=OrderProduct::where('order_id',$r->id)->with('product','order')->get();
        return view('frontend.order_complete',compact('orders'));
    }


    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('online_payment')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('online_payment')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }
}
