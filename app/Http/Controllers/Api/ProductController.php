<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends controller{

   public function filterProduct(Request $request)
    {
        return Product::with('ratings')->whereHas('vendor',function($q){$q->where('s_status',1);})->where($request->filter_type , 1)->where('stock','>',0)->where('status',1)->latest()->get();
    }
    
    public function allProduct(Request $request)
    {
        return Product::with('ratings')->whereHas('vendor',function($q){$q->where('s_status',1);})->where('stock','>',0)->where('status',1)->latest()->paginate();
    }
    
    
    
    
}
