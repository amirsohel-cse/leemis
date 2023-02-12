<?php

namespace App\Http\Controllers\Frontend\Wishlist;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index($userId){
        $wishlist = Wishlist::where('user_id',$userId)->get();
        //dd($wishlist);
        return view('frontend.wishlist.wishlist',compact('wishlist'));
    }

    public function saveWishList(Request $request, Product $product)
    {
        $wishlist = Wishlist::where('user_id',$request->user_id)
                    ->where('product_id',$product->id)->first();
        if (!$wishlist){
            Wishlist::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $product->photo,
                'stock_status' => ($product->stock > 0) ? 1 : 0,
                'price' => $product->price,
                'user_id' => $request->user_id,
                'slug' => $product->slug
            ]);
            return response()->json([
                'message' => 'Wishlist Added Successfully',
                'newWishList' => 1,
                'product' => $product
            ]);
        }else{
            return response()->json([
                'message' => 'Already added to your wishlist!',
                'newWishList' => 0
            ]);
        }

    }

    public function delete(Wishlist $wishlist)
    {
        $wishlist->delete();
        return response()->json('Wishlist Successfully Deleted');
    }
}
