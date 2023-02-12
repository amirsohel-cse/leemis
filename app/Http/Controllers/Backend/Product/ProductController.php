<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\ChildCategory;
use App\Model\Product;
use App\Model\SubCategory;
use App\Model\Brand;
use App\Model\CategoryAttribute;
use App\Model\Gallery;
use App\ProductCategoryAttribute;
use Illuminate\Http\Request;
use App\Traits\ProductImage;
use Auth;
use Image;



class ProductController extends Controller
{
   
    public function Product()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();
        $brand = Brand::all();
        return view('admin.product.addProduct', compact('categories', 'subcategories', 'childcategories', 'brand'));
    }

    public function createProduct(Request $request)
    {
        

        $request->validate([
            'name'             => 'required',
            'sku'              => 'required',
            'category_id'      => 'required',
            'subcategory_id'   => 'required',
            'childcategory_id' => 'required',
            'photo'            => 'required',
            'price'            => 'required',
            'tax'              => 'required',
            'details'          => 'required',
            'tags'             => 'required',
        ]);



        $product_detail = $request->details;
        $dom = new \DomDocument();
        $dom->loadHtml($product_detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $product_detail   = $dom->saveHTML();

        $size       = '';
        $size_qty   = '';
        $size_price = '';

        for ($i = 0; $i < count($request->size); $i++) {
            $size       .= $request->size[$i] . ',';
            $size_qty   .= $request->size_qty[$i] . ',';
            $size_price .= $request->size_price[$i] . ',';
        };



        $color       = '';

        for ($i = 0; $i < count($request->color); $i++) {
            $color     .= $request->color[$i] . ',';
        };


        if ($request->hasFile('photo')) {
            $filePath = $this->productImageUpload($request->photo);
        }


        $product = new Product;

        $product->name             = $request->name;
        $product->sku              = $request->sku;
        $product->category_id      = $request->category_id;
        $product->subcategory_id   = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->brand_id         = $request->brand_id;
        $product->photo            = $filePath;
        $product->ship             = $request->ship;
        $product->size             = $size;
        $product->size_qty         = $size_qty;
        $product->size_price       = $size_price;
        $product->color            = $color;
        $product->price            = $request->price;
        $product->previous_price   = $request->previous_price;
        $product->cash_back        = $request->cash_back;
        $product->tax              = $request->tax;
        $product->stock            = $request->stock;
        $product->details          = $product_detail;
        $product->vat              = $request->vat;
        $product->youtube          = $request->youtube;
        $product->tags             = $request->tags;
        $product->featured         = $request->feature;
        $product->offer_product    = $request->offerproduct;
        
        if ($request->online_payment) {
            $product->online_payment   = $request->online_payment;
        }


        $product->vendor_id        = Auth::user()->id;

        $product->save();

        $count = 1;
        if ($request->hasfile('image_file')) {

            foreach ($request->file('image_file') as $file) {

                $name = time() . '.' . $count . $file->extension();
                $file->move(public_path() . '/uploads/product-gallery', $name);
                $file = new Gallery;
                $file->image_file = $name;
                $file->product_id = $product->id;

                $file->save();
                $count++;
            }
        }


        return redirect()->back()->with('success', 'Product Added Successfully');
    }




    public function showProducts()
    {
        $products = Product::select('id','name','sku','code','vendor_id','stock','price','status','featured')->where('status',1)->with('vendor')->latest()->get();
        
        return view('admin.product.allProducts', compact('products'));
    }

    public function deActivatedProducts()
    {
        $deactivatedProducts = Product::where('status', 0)->get();
        return view('admin.product.deactivatedProducts', compact('deactivatedProducts'));
    }

    public function productCatalogs()
    {
        $products = Product::all();
        return view('admin.product.productCatalogs', compact('products'));
    }

    public function statusUpdate(Request $request, Product $product)
    {
        $product->status = $request->status;
        
        $product->save();


        return response()->json('Status Successfully Updated!!!');
    }

    public function productEdit($id)
    {
        $product = Product::find($id);
        $categories = Category::select('id','name')->where('status',1)->get();
        $subcategories = SubCategory::select('id','name')->where('status',1)->get();
        $childcategories = ChildCategory::select('id','name')->where('status',1)->get();
        $brand = Brand::select('id','name')->where('status',1)->get();
        $gallery = Gallery::where('product_id', '=', $id)->get();

        $attributes = CategoryAttribute::where('category_id', $product->category_id)->with('options')->whereHas('options')->latest()->get();

        return view('admin.product.editProduct', compact('product', 'categories', 'subcategories', 'childcategories', 'brand', 'gallery','attributes'));
    }

    public function productUpdate(Request $request, $id)
    {
        
$request->validate([
            'name'             => 'required',
            'sku'              => 'required',
            'category_id'      => 'required',
            'photo'            => 'sometimes|mimes:jpeg,jpg,png',
            'previous_price' => 'nullable|gt:0|gt:price',
            'price'            => 'required|gt:0|lt:previous_price',
            'details'          => 'required',
            'tags'             => 'required',
            'stock' => 'nullable|gte:0',
            'specification.*.title' => 'required',
            'specification.*.details' => 'required'
        ], [
            'price.lt' => 'Offered Price Must Be less than Actual Price',
             'specification.*.title.required' => 'Specification Title Required',
            'specification.*.title.details' => 'Specification Details Required',
        ]);




        $product_detail = $request->details;
        $dom = new \DomDocument();


        $internalErrors = libxml_use_internal_errors(true);

        $dom->loadHTML('<?xml encoding="UTF-8">' . $product_detail);
        $product_detail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $product_detail .= $dom->saveHTML($dom->documentElement);


        $product = Product::find($id);

        $specification = [];
        
        if($request->product_specification != null){
            
        $product_sepc = array_values($request->product_specification);
        if($product_sepc != null){
           
            $specification = array_filter($product_sepc, function ($var) {
                return isset($var['attribute']);
            });
            
            
        }
        }
        



        $product->name             = $request->name;
        $product->sku              = $request->sku;
        $product->category_id      = $request->category_id;
        $product->subcategory_id   = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->brand_id         = $request->brand_id;
        $product->ship             = $request->ship;
        $product->product_specification = $specification;
        $product->specification = array_values($request->specification);
        $product->color            = $request->color;
        $product->price            = $request->price;
        $product->previous_price   = $request->previous_price;
        $product->stock            = $request->stock;
        $product->offer_product    = $request->offer;
        $product->online_payment   = $request->online_payment;
        $product->details          = $product_detail;
        $product->youtube          = $request->youtube;
        $product->tags             = $request->tags;
        $product->trending             = $request->tranding;
        $product->top             = $request->top;
        
        if($product->code == 0){
            
        $product->code             = random_int(100000, 999999);
        }

        $photo     =  $product->photo;
        $delete_path = public_path() . '/' . $photo;






        if ($request->hasFile('photo')) {
            // $filePath = $this->productImageUpload($request->photo);
            //  $product->photo = $filePath;
            //  $product->save();

            if (!empty($photo)) {

                if (file_exists($delete_path)) {
                    unlink($delete_path);
                }
            }

            $image = $request->file('photo');
            $input['imagename'] = rand(10000, 99999) . time() . '.' . $image->extension();

            $filePath = public_path('uploads/product-images/');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $filepath = "uploads/product-images/" . $input['imagename'];
            $product->photo = $filepath;
            $product->save();
        }
        //$product->photo            = $filePath;



        $delete_path = "";
        if ($request->file('image_file')) {
            $gallery = Gallery::where('product_id', '=', $id)->get();

            foreach ($gallery as $data) {
                $gallery_image = $data->image_file;
                $delete_path = public_path() . '/uploads/product-gallery/' . $gallery_image;

                if (!empty($gallery_image)) {

                    if (file_exists($delete_path)) {
                        unlink($delete_path);
                    }
                }
            }
            $delete = Gallery::where('product_id', '=', $id)->delete();
        }


        $count = 1;
        if ($request->hasfile('image_file')) {
            foreach ($request->file('image_file') as $file) {

                // $name = time().'.'.$count.$file->extension();
                // $file->move(public_path().'/uploads/product-gallery', $name);


                // $file= new Gallery;
                // $file->image_file=$name;
                // $file->product_id=$product->id;
                // $file->save();
                // $count++;
                if ($file->extension() == 'jpg' || $file->extension() == 'png' || $file->extension() == 'jpeg') {
                    $input['imagename'] = rand(10000, 99999) . time() . '.' . $file->extension();

                    $filePath = public_path('/uploads/product-gallery');

                    $img = Image::make($file->path());
                    $img->resize(1000, 1000, function ($const) {
                        $const->aspectRatio();
                    })->save($filePath . '/' . $input['imagename']);


                    $file = new Gallery;
                    $file->image_file = $input['imagename'];
                    $file->product_id = $product->id;
                    $file->save();
                    $count++;
                }
            }
        }



        $product->save();




        if ($request->attribute != null) {


            ProductCategoryAttribute::where('product_id', $product->id)->get()->map(function ($item) {
                $item->delete();
            });

            foreach ($request->attribute as $key => $attr) {
                $attribute = CategoryAttribute::find($key);


                if ($attribute) {

                    $attributeOption = array_values(array_intersect($attribute->options->pluck('id')->toArray(), $attr));


                    foreach ($attributeOption as $option) {

                        ProductCategoryAttribute::create([
                            'product_id' => $product->id,
                            'category_id' => $request->category_id,
                            'category_attribute_id' => $attribute->id,
                            'attribute_option_id' => $option
                        ]);
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Product Edited Successfully');
    }


    public function productDelete($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('delete', 'Product Successfully Deleted');
    }
    public function productView($id)
    {
        $product = Product::find($id);
        $gallery = Gallery::where('product_id', '=', $id)->get();

        return view('admin.product.viewProduct', compact('product', 'gallery'));
    }

    public function edit(Category $category)
    {
        return response()->json($category, 200);
    }

    //featured update
    public function featuredUpdate(Request $request, Product $product)
    {
        $product->featured = $request->featured;
        $product->save();
        return response()->json('This product is Featured Now!!!');
    }
    
   
}
