<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderProduct;
use App\Model\Vendor;
use App\User;
use App\Model\Admin;
use App\Model\Order;
use App\Model\Product;
use App\Model\Withdraw;
use App\Model\Brand;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {


        $dateToday = Carbon::today()->toDateString();
        $date7days = Carbon::today()->subDay(7)->toDateString();

        $profit=OrderProduct::with('order')->get();
        $order_o=Order::all();
        $vendor=Vendor::count();
        $user=User::count();
        $admin=Admin::count();
        $product = Product::count();
        $brand=Brand::count();

        $data['order_pending'] = Order::where('status', 'Pending')->count();
        $data['order_processing'] = Order::where('status', 'Processing')->count();
        $data['order_completed'] = Order::where('status', 'Completed')->count();
        $data['order_onDelivery'] = Order::where('status', 'On Delivery')->count();
        $data['order_declined'] = Order::where('status', 'Declined')->count();
        $data['order_all'] = Order::count();

        $data['recent_orders'] = Order::orderBy('id','desc')->take(5)->get();
        $data['new_customers'] = User::orderBy('id','desc')->take(5)->get();

        $prod = DB::table('order_products')->whereDate('created_at','<=',$dateToday)
        ->whereDate('created_at','>=',$date7days)->select('product_id', DB::raw('SUM(qty) as total_sales'))->groupBy('product_id')->orderByRaw('total_sales DESC')->limit(10)->get();

        $prod_id = array();
        foreach( $prod as $row){
            array_push( $prod_id , $row->product_id);
        }
        $data['tsp'] = Product::with('brand', 'categories','vendor')->find($prod_id);

        $vend = DB::table('order_products')->whereDate('created_at','<=',$dateToday)
        ->whereDate('created_at','>=',$date7days)->select('vendor_id', DB::raw('SUM(qty) as total_sales'))->groupBy('vendor_id')->orderByRaw('total_sales DESC')->limit(10)->get();

        $vendor_id = array();
        foreach( $vend as $row){
            array_push( $vendor_id , $row->vendor_id);
        }
        $data['top_vendor'] = Vendor::find($vendor_id);

        $data['withdraw']= Withdraw::all();
        // dd($vendor);
        //Barchart
        $chart=OrderProduct::select(DB::raw("SUM(profit) as sum"))->where('status','Completed')->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))
        ->pluck('sum');
        $months=OrderProduct::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');
      
        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index=>$month){
            if (isset($chart[$index])){
                $datas[$month]=$chart[$index];
            }
        }

        $chartsell=Order::select(DB::raw("SUM(subtotal) as sum"))->where('status','Completed')->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))
        ->pluck('sum');
        $monthss=Order::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');
    
        $sell=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($monthss as $indexsell=>$months){
            if(isset($chartsell[$indexsell])){
                $sell[$months]=$chartsell[$indexsell];
            }
        }

        $chartwithdraw=Withdraw::select(DB::raw("SUM(amount) as sum"))->where('status','Completed')->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))
        ->pluck('sum');

        $monthsss=Order::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');
    
        $withdraw=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($monthsss as $index=>$monthss){
            if (isset($chartwithdraw[$index])){
                $withdraw[$monthss]= $chartwithdraw[$index];
            }
        }
//user
        $userCC=User::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');
        $month=User::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');

        $userC=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($month as $index=>$months){
            $userC[$months]=$userCC[$index];
        }


        $vendorGG=Vendor::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');
        $month=Vendor::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');

        $vendorG=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($month as $index=>$months){
            $vendorG[$months]=$vendorGG[$index];
        }

        return view('admin.dashboard.dashboard',compact('order_o','profit','vendor','user','admin','brand','product', 'data','datas','sell','withdraw','userC','vendorG'));
    }
}
