<?php

namespace App\Http\Controllers;

use App\CheckoutInfo;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
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


class SslCommerzPaymentController extends Controller
{


    public function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function index(Request $request)
    {

        $data = $request->validate([
            "name" => "required",
            "address" => "required",
            "city" => "nullable",
            "phone" => "required",
            "email" => "required|email",
            "note" => 'nullable',
            "subtotal" => "required|numeric",
            "ship" => "required",
            "total" => "required|numeric",
            "payment" => "required",
            "accept" => "required"
        ]);


        CheckoutInfo::create([
            'info' => $data,
            'user_id' => auth()->id(),
        ]);
        



        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $request->total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $this->generateRandomString(10); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['order_id'] =  $post_data['tran_id'];
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = 'ref001';
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        // #Before  going to initiate the payment order status need to insert or update as Pending.
        // $update_product = DB::table('online_payment')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'order_id' => $post_data['order_id'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }



    public function success(Request $request)
    {


        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        // #Check order status in order tabel against the transaction id or order id.
        // $order_detials = DB::table('online_payment')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();


        $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);



        if ($validation == TRUE) {
            /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */


            $infos = CheckoutInfo::where('user_id',auth()->id())->first()->info;
            $destroy = CheckoutInfo::where('user_id',auth()->id())->first();
            
           

            $original_order_code = $tran_id;
            $count = 0;
            while (true) {
                $same_code = Order::where('order_id', $tran_id)->first();
                if ($same_code) {
                    $order_code = $original_order_code . mt_rand(0, 9) . (++$count);
                } else {
                    break;
                }
            }
         
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $infos->name,
                'address' => $infos->address,
                'city' => $infos->city,
                'country' => $infos->country ?? '',
                'zip' => $infos->zip ?? '',
                'phone' => $infos->phone,
                'email' => $infos->email,
                'note' => $infos->note,
                'payment_method' => $infos->payment,
                'subtotal' => $infos->subtotal,
                'shipping_method' => $infos->ship,
                'total' => $infos->total,
                'status' => 'pending',
                'order_id' => $tran_id,


            ]);
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
                        'vendor_id' => $confirmOrder->vendor_id
                    ]);

                    $product = Product::find($confirmOrder->product_id);
                    // $product->decrement('stock', $confirmOrder->qty);
                }
            }
            // return $cartShop->product_id;

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


            $destroy->delete();



            return view('frontend.order_complete', compact('orders'));
        } else {
            /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
            $update_product = DB::table('online_payment')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "validation Fail";
        }
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

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_detials = DB::table('online_payment')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'order_id')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('id', $order_detials->order_id)
                ->update(['status' => 'Canceled']);
            echo "Your Transaction is Cancelled";
            return redirect('/');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('online_payment')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('online_payment')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('online_payment')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }


    public function ddd()
    {
        // $order_code = generateRandomString(6);

        // // if order code is same, add extra 2 digits to make it unique
        // $original_order_code = $order_code;
        // $count = 0;
        // while (true) {
        //     $same_code = Order::where('order_id', $order_code)->first();
        //     if ($same_code) {
        //         $order_code = $original_order_code . mt_rand(0, 9) . (++$count);
        //     } else {
        //         break;
        //     }
        // }

        // $order = Order::create([
        //     'user_id' => Auth::id(),
        //     'name' => $request->name,
        //     'address' => $request->address,
        //     'city' => $request->city,
        //     'country' => $request->country,
        //     'zip' => $request->zip ?? '',
        //     'phone' => $request->phone,
        //     'email' => $request->email,
        //     'note' => $request->note,
        //     'payment_method' => $request->payment,
        //     'subtotal' => $request->subtotal,
        //     'shipping_method' => $request->ship,
        //     'total' => $request->total,
        //     'status' => 'pending',
        //     'order_id' => $order_code,


        // ]);
        // $vendors = array();
        // $order_product_id = array();
        // if (Auth::user()) {
        //     $idauth = Auth::id();
        //     $cartShop = Cart::where('user_id', $idauth)->get();
        //     // $cartShopx=Cart::where('user_id',$idauth)->get('product_id');

        //     // $collection = collect($cartShop['product_id']->toArray());

        //     // return $collection;
        //     foreach ($cartShop as $confirmOrder) {
        //         $orderProduct = OrderProduct::create([
        //             'order_id' => $order->id,
        //             'product_id' => $confirmOrder->product_id,
        //             'qty' => $confirmOrder->qty,
        //             'size' => $confirmOrder->size,
        //             'color' => $confirmOrder->color,
        //             'vendor_id' => $confirmOrder->vendor_id,
        //             'vendor_status' => 'Pending',
        //         ]);
        //         array_push($vendors, $confirmOrder->vendor_id);
        //         array_push($order_product_id, $orderProduct->id);
        //         VendorNotification::create([
        //             'order_code' => $order->order_id,
        //             'order_id' => $order->id,
        //             'order_product_id' => $orderProduct->id,
        //             'name' => Auth::user()->name,
        //             'type' => 'order',
        //             'vendor_id' => $confirmOrder->vendor_id
        //         ]);

        //         $product = Product::find($confirmOrder->product_id);
        //         // $product->decrement('stock', $confirmOrder->qty);
        //     }
        // }
        // // return $cartShop->product_id;

        // $admins = Admin::all();

        // //Notification::send( $admins, new OrderNotification( Auth::user()->name, $order->id, $order->order_id));


        // if (count($cartShop) < 1) {
        //     return Redirect()->route('view.cart')->with('success', 'Shopping cart is Empty Please Add Some product');
        // }

        // // send notification to all admins
        // $admins = Admin::all();
        // //        $vendors = Vendor::all();
        // Notification::send($admins, new OrderNotification(Auth::user()->name, $order->id, $order->order_id, $vendors, $order_product_id));
        // //Notification::send($vendors,new VendorOrderNotification(Auth::user()->name, $order->id, $order->order_id,$vendors));
        // //Real time notification by pusher
        // $a = date("Y/m/d h:i:sa");
        // $name = Auth::user()->name;
        // $order_id = $order->id;
        // $order_code = $order->order_id;
        // $created_at = $a;
        // $text = 'has placed an order.';
        // $type = 'order';
        // event(new OrderCompleteEvent($name, $order_id, $order_code, $created_at, $text, $type, $vendors, $order_product_id));
        // //        event(new VendorOrderEvent($name,$order_id,$order_code,$created_at,'vendorOrder', $vendors));
        // //Real time notification by pusher ends
        // Cart::where('user_id', Auth::id())->delete();
        // $f = $order->id;
        // $orders = OrderProduct::where('order_id', $f)->with('product', 'order')->get();
    }
}
