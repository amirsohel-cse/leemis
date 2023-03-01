<?php

namespace App\Http\Controllers\Frontend;

use App\CheckoutInfo;
use App\Events\OrderCompleteEvent;
use App\Events\VendorOrderEvent;
use App\Model\VendorNotification;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Other;
use App\Model\SubCategory;
use App\Model\ChildCategory;
use App\Model\Brand;
use App\Http\Controllers\Backend\SocialShare;
use App\Model\SubCategorySlider;
use App\Model\Product;
use App\Model\Vendor;
use App\Model\Cart;
use App\Model\Shipping;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Slider;
use App\Model\HeaderText;
use App\Notifications\VendorOrderNotification;
use App\Rating;
use App\User;
use App\Model\Advertise;
use App\Model\Admin;
use App\Notifications\OrderNotification;
use App\Model\Service;
use App\Model\Gallery;
use App\Model\Campaign;
use App\Model\Term;
use App\Page;
use App\ProductSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Vendor\Banner;
use App\HelpCategory;
use App\Model\Wishlist;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function index()
    {

        $pop = Campaign::select('file', 'link')->where('type', '=', 'popup')->first();

        $product = Product::where('featured', 1)->where('status', 1)->where('stock', '>', 0)
            ->leftJoin('ratings', 'products.id', '=', 'ratings.product_id')
            ->select('products.id', 'products.name', 'products.photo', 'products.stock', 'products.price', 'products.previous_price', 'products.avg_rating', DB::raw('count(ratings.rating) as ratings_count'))
            ->groupBy('products.id')
            ->limit(12)
            ->get();

        $offer_product = Product::select('id', 'name', 'photo', 'stock', 'price', 'previous_price', 'avg_rating')->whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('offer_product', '=', 1)->where('stock', '>', 0)->where('status', 1)->limit(12)->latest()->withCount('ratings')->get();

        $shop = Vendor::whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('s_status', '=', 1)->where('feature', 1)->limit(12)->cursor();


        $slider = Slider::select('link', 'image_file')->cursor();


        $top_selling = Product::select('id', 'name', 'photo', 'stock', 'price', 'previous_price', 'avg_rating')->where('featured', 1)->where('status', 1)->where('top', 1)->where('stock', '>', 0)->latest()->withCount('ratings')->limit(12)->cursor();



        $trendings = Product::select('id', 'name', 'photo', 'stock', 'price', 'previous_price', 'avg_rating')->where('featured', 1)->where('status', 1)->where('trending', 1)->where('stock', '>', 0)->latest()->withCount('ratings')->limit(12)->cursor();

        $latest = Product::select('id', 'name', 'photo', 'stock', 'price', 'previous_price', 'avg_rating')->where('featured', 1)->where('status', 1)->where('stock', '>', 0)->withCount('ratings')->latest()->limit(12)->cursor();



        $orderProducts = OrderProduct::select('created_at','vendor_id')->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])->get();
        $vendorIds = OrderProduct::select('created_at','vendor_id')->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])->pluck('vendor_id')->toArray();

        $vendorData = [];

        $key = -1;

        foreach ($vendorIds as $vendorId) {

            if (count($vendorData) > 0) {
                $key = array_search($vendorId, array_column($vendorData, 'vendor_id'));

                if ($key == 0) {
                    continue;
                }
            }

            $orders =  clone $orderProducts;
            $orders = $orders->where('vendor_id', '=', $vendorId)->all();
            $vendor = [];
            $vendor['vendor_id'] = $vendorId;
            $total = 0;
            foreach ($orders as $order) {
                $total += ($order->qty * ($order->product->price ?? 0));
            }
            $vendor['total_sell'] = $total;

            $vendorData[] = $vendor;
        }
        $tShops = [];

        $minimumAmountTopVEndor = Other::select('min_withdraw_amount','top_vendor_amount')->first();

        foreach ($vendorData as $top) {
            if ($top['total_sell'] >= @$minimumAmountTopVEndor->top_vendor_amount ?? 0) {
                $tShops[] = Vendor::where('id', '=', $top['vendor_id'])->limit(8)->first();
            }
        }


        $categories = Category::select('name', 'id', 'photo')->whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('status', 1)->where('is_featured', 1)->latest()->with('sub_categories.child_categories')->limit(15)->get();

        $subCategories =  SubCategory::select('name', 'id', 'photo')->where('status', 1)->with(['child_categories' => function($query){
            $query->select('sub_category_id','id','name','slug','status')->limit(15);
        }])->limit(10)->get();

        return view('frontend.main', compact('product', 'offer_product', 'shop', 'slider','categories', 'tShops', 'pop', 'top_selling', 'trendings', 'latest', 'subCategories'));
    }

    public function moreBrand()
    {
        $brand = Brand::whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('status', '=', 1)->paginate(6);
        return view('frontend.brand.more_brand', compact('brand'));
    }

    public function productByBrand($id)
    {

        $productByBrand = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('brand_id', $id)->where('status', 1)->paginate(6);
        return view('frontend.brand.brand_product', compact('productByBrand'));
    }

    public function brandProductSearchAjax(Request $request, $brandId)
    {
        $products = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('brand_id', $brandId)
            ->where('name', 'LIKE', '%' . $request->searchText . '%')->orderBy('name')->get();
        return response()->json($products, 200);
    }

    public function brandSearchAjax(Request $request)
    {
        $brands = Brand::where('name', 'LIKE', '%' . $request->searchText . '%')->where('status', 1)->orderBy('name')->get();
        return response()->json($brands, 200);
    }


    public function productDetails($id)
    {

        $product = Product::where('status', 1)->findOrFail($id);

        $vendor = Vendor::where('s_status', 1)->find($product->vendor_id);

        if (!$vendor) {
            abort(404);
        }

        $productDetails = Product::where('id', $id)->get();


        $url = url()->current();



        $socials = [
            'facebook' => '<li><a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" class="social-button text-dark" style="font-size:30px;margin-right:20px"><span class="fab fa-facebook-square" style="color:#f1cd15"></span></a></li>',
            'twitter' => '<li><a href="https://twitter.com/intent/tweet?text=share&url' . $url . '" class="social-button text-dark " style="font-size:30px;margin-right:20px"><span class="fab fa-twitter" style="color:#f1cd15"></span></a></li>',
            'linkedin' => '<li><a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url=' . $url . '&title=share&summery=" class="social-button text-dark " style="font-size:30px;margin-right:20px"><span class="fab fa-linkedin" style="color:#f1cd15"></span></a></li>',
            'whatsapp' => '<li><a target="_blank" href="https://wa.me/?text=' . $url . '" class="social-button text-dark" style="font-size:30px;margin-right:20px"><span class="fab fa-whatsapp" style="color:#f1cd15"></span></a></li>',
            'pinterest' => '<li><a href="https://pinterest.com/pin/create/button/?url=' . $url . '" class="social-button text-dark" style="font-size:30px;margin-right:20px"><span class="fab fa-pinterest" style="color:#f1cd15"></span></a></li>',
            'reddit' => '<li><a target="_blank" href="https://www.reddit.com/submit?url=' . $url . '&text=share" class="social-button text-dark" style="font-size:30px;margin-right:20px"><span class="fab fa-reddit" style="color:#f1cd15"></span></a></li>',
            'telegram' => '<li><a target="_blank" href="https://telegram.me/share/url?url=' . $url . '&text=share" class="social-button text-dark" style="font-size:30px;margin-right:20px"><span class="fab fa-telegram" style="color:#f1cd15"></span></a></li>',
        ];



        $star1 = Rating::where('product_id', $productDetails[0]->id)->where('rating', 1)->get();
        $star2 = Rating::where('product_id', $productDetails[0]->id)->where('rating', 2)->get();
        $star3 = Rating::where('product_id', $productDetails[0]->id)->where('rating', 3)->get();
        $star4 = Rating::where('product_id', $productDetails[0]->id)->where('rating', 4)->get();
        $star5 = Rating::where('product_id', $productDetails[0]->id)->where('rating', 5)->get();
        $rating = Rating::where('product_id', $productDetails[0]->id)->get();

        $productGallery = Gallery::where('product_id', $productDetails[0]->id)->get();
        $categoryProducts = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('category_id', $productDetails[0]->category_id)->limit(5)->get();
        $services = Service::all();
        $banner = Advertise::limit(4)->get();
        return view(
            'frontend.product.product_details',
            compact(
                'product',
                'productDetails',
                'productGallery',
                'rating',
                'star1',
                'star2',
                'star3',
                'star4',
                'star5',
                'categoryProducts',
                'services',
                'banner',
                'socials'
            )
        );
    }


    public function searchajax(Request $req)
    {

        $products = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('name', 'LIKE', '%' . $req->search . '%')->where('status', 1)->get();

        $brands = Brand::whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('name', 'LIKE', '%' . $req->search . '%')->where('status', 1)->get();
        $vendors = Vendor::whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('shop_name', 'LIKE', '%' . $req->search . '%')->where('s_status', 1)->get();
        return response()->json([$products, $brands, $vendors], 200);
    }

    public function productAll(Request $request)
    {

        $product = Product::query();

        if($request->status == 'top_selling'){

            $product->where('featured', 1)->where('status', 1)->where('top', 1)->where('stock', '>', 0);

        }elseif($request->status == 'feature'){

            $product->where('featured', 1)->where('status', 1)->where('stock', '>', 0);

        }elseif($request->status == 'trending'){
            $product->where('trending', 1)->where('status', 1)->where('stock', '>', 0);
        }elseif($request->status ==  'latest'){
            $product->where('status', 1)->where('stock', '>', 0);
        }


        $product = $product->whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->latest()->paginate();

        $categories = Category::select('name', 'id', 'photo')->whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('status', 1)->where('is_featured', 1)->latest()->with('sub_categories.child_categories')->latest()->get();

        return view('frontend.product.all_product', compact('product', 'categories'));
    }

    public function offerProduct()
    {
        $offer_product = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('offer_product', '=', 1)->where('status', 1)->limit(8)->latest()->paginate(8);
        $categories = Category::all();
        return view('frontend.product.offer-product', compact('offer_product', 'categories'));
    }

    public function filterBytime(Request $req)
    {
        $date = now()->subDays($req->duration);

        $products = Product::whereBetween('created_at', [$date, now()])->whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->with('sub_categories', 'ratings')
            ->where('offer_product', '=', 1)
            ->where('status', 1)->orderBy('name')
            ->get();

        return response()->json($products, 200);
    }

    public function cartView()
    {
        $id = Auth::id();
        $carts = Cart::whereHas('product')->where('user_id', $id)->get();
        $sum = Cart::whereHas('product')->where('user_id', $id)->sum('subtotal');
        return view('frontend.viewcart', compact('carts', 'sum'));
    }

    public function checkOut()
    {
        $id = Auth::id();

        $info = CheckoutInfo::where('user_id', $id)->first();

        if($info){

            $info->delete();
        }


        $carts = Cart::whereHas('product')->where('user_id', $id)->get();
        $ship = Shipping::where('status', '=', 1)->get();
        $sum = Cart::whereHas('product')->where('user_id', $id)->sum('subtotal');
        $isOnlinePayment = 0;
        foreach ($carts as $row) {

            if ($row->product->online_payment == 1) {
                $isOnlinePayment = 1;
            }
        }
        if (count($carts) < 1) {
            return Redirect()->route('view.cart')->with('success', 'Shopping cart is Empty Please Add Some product');
        }
        $users = Auth::user();

        return view('frontend.checkout', compact('users', 'carts', 'ship', 'sum', 'isOnlinePayment'));
    }

    public function directcheckout(Request $request, $qty, $productId)
    {

        $id = Auth::id();
        $product = Product::where('id', $productId)->firstOrFail();

        $attribute = collect();

        $additional_price = collect();

        if ($request->attribute && $request->option) {

            $specification = array_combine(explode(',', $request->attribute), explode(',', $request->option));

            foreach ($specification as $key => $value) {
                $attribute->push([
                    'attribute' => $key,
                    'option' => $value
                ]);
                $additional_price->push(collect($product->product_specification)->where('attribute', $value)->first()['price_attr']);
            }
        }



        $price = $product->price;

        $subtotal = ((float)$price + $additional_price->sum()) * (float)$qty;
        $cart = new Cart();
        $cart->product_id = $product->id;
        $cart->attributes = $attribute->toArray();
        $cart->qty = $qty;
        $cart->price = $price;
        $cart->additional_price = $additional_price->sum();
        $cart->subtotal = floatval($subtotal);
        $cart->user_id = $id;

        $cart->save();


        $carts = Cart::where('id', $cart->id)->get();
        session()->put('cart', $carts);

        $ship = Shipping::where('status', '=', 1)->get();
        $sum = $subtotal;
        $isOnlinePayment = 0;
        if ($product->online_payment == 1) {
            $isOnlinePayment = 1;
        }
        $users = Auth::user();

        return view(
            'frontend.checkout',
            compact('users', 'carts', 'ship', 'sum', 'isOnlinePayment')
        );
    }


    public function orderComplete(Request $request)
    {


        //----------- unique order code -------------
        function generateRandomString($length = 10)
        {
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
        while (true) {
            $same_code = Order::where('order_id', $order_code)->first();
            if ($same_code) {
                $order_code = $original_order_code . mt_rand(0, 9) . (++$count);
            } else {
                break;
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'zip' => $request->zip ?? '',
            'phone' => $request->phone,
            'email' => $request->email,
            'note' => $request->note,
            'payment_method' => $request->payment,
            'subtotal' => $request->subtotal,
            'shipping_method' => $request->ship,
            'total' => $request->total,
            'status' => 'pending',
            'order_id' => $order_code



        ]);
        $vendors = array();
        $order_product_id = array();
        if (Auth::user()) {
            $idauth = Auth::id();

            if (session()->has('cart')) {
                $cartShop = session('cart');
            } else {

                $cartShop = Cart::where('user_id', $idauth)->get();
            }

            foreach ($cartShop as $confirmOrder) {


                $orderProduct = OrderProduct::create([
                    'order_id' => $order->id,
                    'attributes' => $confirmOrder->attributes,
                    'additional_price' => $confirmOrder->additional_price,
                    'product_id' => $confirmOrder->product_id,
                    'qty' => $confirmOrder->qty,
                    'size' => $confirmOrder->size,
                    'color' => $confirmOrder->color,
                    'vendor_id' => $confirmOrder->product->vendor->id,
                    'vendor_status' => 'Pending',
                ]);
                array_push($vendors, $confirmOrder->product->vendor->id);
                array_push($order_product_id, $orderProduct->id);




                VendorNotification::create([
                    'order_code' => $order->order_id,
                    'order_id' => $order->id,
                    'order_product_id' => $orderProduct->id,
                    'name' => Auth::user()->name,
                    'type' => 'order',
                    'vendor_id' => $confirmOrder->product->vendor->id
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
        $response = null;

        event(new OrderCompleteEvent($name, $order_id, $order_code, $created_at, $text, $type, $vendors, $order_product_id));
        //        event(new VendorOrderEvent($name,$order_id,$order_code,$created_at,'vendorOrder', $vendors));
        //Real time notification by pusher ends
        if (session()->has('cart')) {
            session()->forget('cart');
        } else {
            Cart::where('user_id', Auth::id())->delete();
        }

        $f = $order->id;
        $orders = OrderProduct::where('order_id', $f)->with('product', 'order')->get();

        $cartShop->map(function ($item) {
            $item->delete();
        });
        return view('frontend.order_complete', compact('orders'));
    }

    public function profile()
    {
        // $customer = Auth::user();
        $orders = Order::where('user_id', Auth::id())->with('orderProduct')->latest()->get();

        $wishlist = Wishlist::where('user_id',Auth::id())->get();

        return view('frontend.profile.customer-profile', compact('orders','wishlist'));
    }

    public function orderDetails($id)
    {

        // $order = Order::find($id)->with('orderProduct')->first();
        $orders = OrderProduct::where('order_id', $id)->with('product', 'order')->first();


        return view('frontend.profile.order-details', compact('orders'));
    }


    //shopbystore

    public function shopProduct($id)
    {

        $vendor = Vendor::where('id', $id)->firstOrFail();

        $shopProduct = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('vendor_id', $id)->where('status', 1)->paginate(6);

        $banner = Banner::where('vendor_id', '=', $id)->first();

        $categories = Category::where('status', 1)->get();
        return view('frontend.product.shop_product', compact('shopProduct', 'vendor', 'categories', 'banner'));
    }

    //Shop category product ajax
    public function shopCategoryProduct($catId, $vendorId)
    {
        $products = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->with('sub_categories', 'ratings')->where('vendor_id', $vendorId)
            ->where('category_id', $catId)->where('status', 1)->orderBy('name')->get();
        return response()->json($products, 200);
    }

    //Shop price filter ajax
    public function shopPriceFilterProducts(Request $request, $vendorId)
    {
        if (!isset($request->second)) {
            $products = Product::with('sub_categories', 'ratings')
                ->where('vendor_id', $vendorId)
                ->where('status', 1)
                ->where('price', '>=', (int)$request->first)->orderBy('name')->get();
        } else {
            $products = Product::with('sub_categories', 'ratings')
                ->where('vendor_id', $vendorId)
                ->where('status', 1)
                ->where('price', '>=', (int)$request->first)
                ->where('price', '<=', (int)$request->second)->orderBy('name')->get();
        }
        return response()->json($products, 200);
    }

    public function Shop()
    {
        $shop = Vendor::whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('s_status', '=', 1)->paginate(6);
        return view('frontend.product.shop', compact('shop'));
    }

    //Shop search result by ajax
    public function shopSearchAjax(Request $request)
    {

        $vendors = Vendor::whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('shop_name', 'LIKE', '%' . $request->searchText . '%')
            ->where('s_status', 1)->get();
        return response()->json($vendors, 200);
    }

    public function categorizeProducts($c_id)
    {
        $products = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('category_id', '=', $c_id)->where('status', 1)->paginate(8);
        $category = Category::where('id', '=', $c_id)->first();
        $sliders = ProductSlider::where('category_id', $category->id)->latest()->get();
        $categories = Category::select('name', 'id', 'photo')->whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('status', 1)->where('is_featured', 1)->latest()->with('sub_categories.child_categories')->latest()->get();

        return view('frontend.category.categorizeProducts', ['products' => $products, 'category' => $category, 'sliders' => $sliders,'categories'=>$categories]);
    }
    public function childCategorizeProducts($c_id)
    {
        $products = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('subcategory_id', '=', $c_id)->where('status', 1)->paginate(6);


        $ChildCategory = ChildCategory::find($c_id);

        return view('frontend.category.childCategorizeProducts', ['products' => $products, 'ChildCategory' => $ChildCategory]);
    }
    public function subCategorizeProducts($s_id)
    {

        $products = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->where('subcategory_id', '=', $s_id)->where('status', 1)->paginate(6);

        $SubCategory = SubCategory::find($s_id);
        $sliders = SubCategorySlider::where('subcategory_id', $SubCategory->id)->latest()->get();

        $categories = Category::select('name', 'id', 'photo')->whereHas('products', function ($q) {
            $q->where('status', 1);
        })->where('status', 1)->where('is_featured', 1)->latest()->with('sub_categories.child_categories')->latest()->get();

        return view('frontend.category.subCategorizeProducts', ['products' => $products, 'SubCategory' => $SubCategory, 'sliders' => $sliders, 'categories' => $categories]);
    }

    //ALl categories
    public function allCategories()
    {
        $categories = Category::where('status', '=', 1)->orderBy('name')->paginate(18);
        return view('frontend.category.allCategories', compact('categories'));
    }

    //Category Products filter by ajax
    public function categoryProducts($catID)
    {
        $products = Product::select('id', 'name', 'photo', 'stock', 'price', 'previous_price', 'avg_rating')->whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->with('sub_categories', 'ratings')
            ->where('category_id', $catID)->where('status', 1)->orderBy('name')
            ->get();

        return response()->json($products, 200);
    }

    //offer category product filter by ajax
    public function offerCategoryProducts($catID)
    {
        $products = Product::whereHas('vendor', function ($q) {
            $q->where('s_status', 1);
        })->with('sub_categories', 'ratings')
            ->where('offer_product', '=', 1)
            ->where('category_id', $catID)->where('status', 1)->orderBy('name')
            ->get();
        return response()->json($products, 200);
    }

    //Products by price filter
    public function priceFilter(Request $request)
    {
        if (!isset($request->second)) {
            $products = Product::whereHas('vendor', function ($q) {
                $q->where('s_status', 1);
            })->with('sub_categories', 'ratings')
                ->where('status', 1)->where('price', '>=', (int)$request->first)->orderBy('name')->get();
        } else {
            $products = Product::whereHas('vendor', function ($q) {
                $q->where('s_status', 1);
            })->with('sub_categories', 'ratings')
                ->where('price', '>=', (int)$request->first)
                ->where('status', 1)->where('price', '<=', (int)$request->second)->orderBy('name')->get();
        }
        return response()->json($products, 200);
    }

    //offer product price filter
    public function offerPriceFilter(Request $request)
    {
        if (!isset($request->second)) {
            $products = Product::whereHas('vendor', function ($q) {
                $q->where('s_status', 1);
            })->with('sub_categories', 'ratings')
                ->where('offer_product', '=', 1)
                ->where('status', 1)->where('previous_price', '>=', (int)$request->first)->orderBy('name')->get();
        } else {
            $products = Product::whereHas('vendor', function ($q) {
                $q->where('s_status', 1);
            })->with('sub_categories', 'ratings')
                ->where('offer_product', '=', 1)
                ->where('previous_price', '>=', (int)$request->first)
                ->where('status', 1)->where('previous_price', '<=', (int)$request->second)->orderBy('name')->get();
        }

        dd($products);
        return response()->json($products, 200);
    }

    //update slugs
    public function updateSlug()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $slug = Str::slug($product->name . " " . $product->sku, '-');
            $product->update(['slug' => $slug]);
        }
    }

    public function terms()
    {
        $terms = Term::first();

        return view('frontend.terms', compact('terms'));
    }


    public function lang(Request $request)
    {
        session()->put('lang', $request->lang);

        return back();
    }

    public function helpCenter()
    {
        return view('frontend.help_center', ['categories' => HelpCategory::whereStatus(true)->latest()->get()]);
    }

    public function helpCenterArticles($id)
    {
        $category = HelpCategory::with('articals')->findOrFail($id);

        return view('frontend.articles', compact('category'));
    }

    public function helpCenterAjax(Request $req)
    {
        $categories = HelpCategory::where('name', 'LIKE', '%' . $req->search . '%')->whereStatus(true)->get();

        return view('frontend.ajax', compact('categories'));
    }

    public function saveMyPlace(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('customer.login');
        }



        $user->my_place = $request->address;

        $user->save();


        return redirect()->back();
    }


    public function deleteMyPlace($user)
    {
        $user = User::findOrFail($user);

        $user->my_place = '';
        $user->save();

        return redirect()->back();
    }


    public function page($page)
    {
        $page = Page::where('status', 1)->where('slug', $page)->firstOrFail();

        return view('frontend.page_details', compact('page'));
    }


    public function mobilecheckout($code)
    {
        $path = resource_path() . "/lang/$code.json";

        $data = [];

        if (file_exists($path)) {
            $data  = json_decode(file_get_contents(resource_path() . "/lang/$code.json"), true);
        }


        return view('mobile-payment', compact('data'));
    }
}
