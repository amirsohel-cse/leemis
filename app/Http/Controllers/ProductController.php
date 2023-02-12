<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use Barcode;
use PDF;

class ProductController extends Controller
{
    
    public function printBarcode()
    {
        $products = Product::whereStatus(true)->get();

        return view('admin.product.print_barcode', compact('products'));
    }


    public function limsProductSearch(Request $request)
    {
        
        $product_code = explode("(", $request['data']);
        $product_code[0] = rtrim($product_code[0], " ");

        $lims_product_data = Product::whereStatus(true)->where('code', $product_code[0])->first();

        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->previous_price;
        $product[] = Barcode::getBarcodePNG($lims_product_data->code,'C128');
        $product[] = $lims_product_data->price;
        $product[] = $lims_product_data->promo_price;
        $product[] = $lims_product_data->code;
        $product[] = 'BDT';
        $product[] = 'prefix';
        $product[] = $lims_product_data->code;
        return $product;
    }
    
    public function printBarcodePDF(Request $request){
        $customPaper = array(0,0,360,144);
        $pdf = PDF::loadView('admin.product.barcode', compact('request'))->setPaper($customPaper, 'landscape');
        return $pdf->download('barcode.pdf');
    }
    
     public function search(Request $request){
        $res = Product::where("name","LIKE","%{$request->searchText}%")
                ->orWhere('code','LIKE',"%{$request->searchText}%")
                ->get();
   
        return response()->json($res);
    }


}
