<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    function dateBy(Request $request)
    {
        if ($request->ajax()) {

            if ($request->from_date != '' && $request->to_date != '') {

                $data = Order::join('users', 'orders.user_id', 'users.id')
                    ->join('order_products', 'order_products.order_id', 'orders.id')
                    ->select('orders.*', 'users.name', 'users.email', 'order_products.qty')
                    ->whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereIn('orders.status', [1, 2])
                    ->get();
            } else {
                $data = Order::join('users', 'orders.user_id', 'users.id')
                    ->join('order_products', 'order_products.order_id', 'orders.id')
                    ->select('orders.*', 'users.name', 'users.email', 'order_products.qty')
                    ->whereIn('orders.status', [1, 2])
                    ->get();
            }

            return response($data);
        }
    }



    public function index(Request $request)
    {


        $orders = Order::query();



        if ($request->ajax()) {

            if ($request->date === 'today') {

                $orders->where(function ($item) {
                    $item->whereDate('created_at', now());
                });

                $data['product_sold'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', now());
                })->where('status', 'Completed')->sum('qty');

                $data['total_profit'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', now());
                })->where('status', 'Completed')->sum('profit');

                $data['total_sell'] = Order::where(function ($item) {
                    $item->whereDate('created_at', now());
                })->where('status', 'Completed')->sum('subtotal');
            }

            if ($request->date === 'week') {

                $orders->where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(7));
                });

                $data['product_sold'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(7));
                })->where('status', 'Completed')->sum('qty');

                $data['total_profit'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(7));
                })->where('status', 'Completed')->sum('profit');

                $data['total_sell'] = Order::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(7));
                })->where('status', 'Completed')->sum('subtotal');
            }

            if ($request->date === 'month') {
                $orders->where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(30));
                });
                $data['product_sold'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(30));
                })->where('status', 'Completed')->sum('qty');

                $data['total_profit'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(30));
                })->where('status', 'Completed')->sum('profit');

                $data['total_sell'] = Order::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subDays(30));
                })->where('status', 'Completed')->sum('subtotal');
            }

            if ($request->date === 'year') {
                $orders->where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subYear());
                });

                $data['product_sold'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subYear());
                })->where('status', 'Completed')->sum('qty');

                $data['total_profit'] = OrderProduct::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subYear());
                })->where('status', 'Completed')->sum('profit');
                $data['total_sell'] = Order::where(function ($item) {
                    $item->whereDate('created_at', '<=', now())->orWhereDate('created_at', '>=', now()->subYear());
                })->where('status', 'Completed')->sum('subtotal');
            }

            $data['all_oders'] = $orders->where('status', 'Completed')->latest()->get();

            return view('admin.report.report_ajax')->with($data);
        }

        $data['product_sold'] = OrderProduct::where('status', 'Completed')->sum('qty');
        $data['total_profit'] = OrderProduct::where('status', 'Completed')->sum('profit');
        $data['total_sell'] = Order::where('status', 'Completed')->sum('subtotal');

        $data['all_oders'] = $orders->where('status', 'Completed')->latest()->paginate();

        return view('admin.report.report')->with($data);
    }
}
