<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index($id, Request $request)
    {



        $product = Product::find($id);


        $price = $product->price;
        $name = $product->name;
        $stock = $product->stock;
        $photo = $product->photo;
        $vendor_id = $product->vendor_id;


        return response()->json([
            'name' => $name,
            'price' => $price,
            'attributes' => $product->product_specification,
            'id' => $id,
            'photo' => $photo,
            'vendor_id' => $vendor_id,
            'stock' => $stock,
            'slug' => $product->slug
        ], 200);
    }

    public function getCartData($userId)
    {
        $cartData = Cart::whereHas('product')->where('user_id', $userId)->get();

        return view('frontend.cart_ajax', compact('cartData'));
    }

    public function getCartCounter($userId)
    {
        $cartData = Cart::whereHas('product')->where('user_id', $userId)->count();
        
        return $cartData;
    }

    public function saveCartData(Request $request)
    {
        $cart = Cart::whereHas('product')->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)->first();

        if ($cart) {
            $cart->price = $cart->product->price;
            $cart->additional_price = $request->has('additional_price') ? $request->additional_price : 0;
            $cart->qty = $cart->qty + $request->qty;
            $cart->subtotal = ($cart->product->price + $cart->additional_price) * $cart->qty;
            $cart->attributes = isset($request['attributes']) ? $request['attributes'] : null;


            $cart->save();
        }

        if (!isset($cart)) {
            $cart1 = new Cart();

            $product = Product::find($request->product_id);

            $cart1->price = $product->price;
            $cart1->additional_price = $request->has('additional_price') ? $request->additional_price : 0;
            $cart1->qty = $request->qty;
            $cart1->user_id = $request->user_id;
            $cart1->product_id = $request->product_id;
            $cart1->subtotal = ($product->price + $cart1->additional_price) * $cart1->qty;
            $cart1->attributes = isset($request['attributes']) ? $request['attributes'] : null;

            $cart1->save();
        }

        return response()->json($cart);
    }

    public function deleteCartItem(Request $request)
    {
        $item = Cart::whereHas('product')->where('user_id', $request->user_id)->find($request->cart)->delete();

        return response()->json('Data Successfully Deleted');
    }

    public function deleteAllCartItem(Request $request)
    {
        Cart::whereHas('product')->where('user_id', $request->user_id)->delete();
        return response()->json('Cart successfully Cleared!!!');
    }

    public function getProductQuantity($cart_id)
    {
        //        dd($cart_id);
        if (Auth::user()) {
            $cart = Cart::find($cart_id);
            $product = Product::find($cart->product_id);
        } else {
            $product = Product::find($cart_id);
        }

        return response()->json($product->stock);
    }

    public function getGrandTotalPrice($userId)
    {
        $cart = Cart::whereHas('product')->whereUserId($userId)->sum('subtotal');

        return response()->json($cart);
    }

    public function storeProductQuantity(Request $request, $userId, $cartId)
    {
        $cart = Cart::find($cartId);
        $product = Product::find($cart->product_id);

        $cart->qty = $request->quantity;
        $cart->subtotal = ($request->quantity) * ($product->price);
        $cart->save();

        return response()->json('success');
    }



    public function cartUpdate(Request $request)
    {
        $cart = Cart::find($request->cart);

        $cart->price = $cart->product->price;
        $cart->qty = $request->qty;
        $cart->subtotal = $request->qty * ($cart->product->price + $cart->additional_price);
        $cart->save();


        $grandTotal = Cart::whereUserId($request->user_id)->sum('subtotal');


        return response()->json([$cart, $grandTotal]);
    }
}
