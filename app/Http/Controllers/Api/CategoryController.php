<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products'=>function($pro){$pro->limit(16);}])->where('status',1)->where('is_featured',1)->with(['sub_categories' => function($item){$item->with(['products'=>function($pro){ $pro->limit(16);}])->with(['sub_categories'=> function($item){$item->where('status',1);}])->with('sliders')->where('status',1);}])->get();

        return response()->json($categories, 200);
    }
    
    public function allCategory(){
            $categories = Category::whereHas('products', function ($q) {
            $q->where('status', 1);
            })->where('status', 1)->where('is_featured', 1)->with('sub_categories.child_categories')->get();
            
            return response()->json($categories, 200);
    }
}
