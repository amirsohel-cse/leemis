<?php

namespace App\Http\Controllers\Frontend\QuickView;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class QuickViewController extends Controller
{
    public function index($product)
    {
        $product = Product::with('categories','brand','sub_categories','galleries')->where('id',$product)->first();
        return response()->json($product);
    }

    public function getSizePrice(Request $request, $id)
    {
        $data = Product::select('size_price','size')->find($id);
        $price = explode(",",$data->size_price);
        $size = explode(",", $data->size);
        $sizePrice = '';
        for ($i = 0; $i < sizeof($size); $i++){
            if ($request->size == $size[$i]){
                $sizePrice = $price[$i];
            }
        }
        return response()->json($sizePrice);
    }
}
