<?php


namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\ChildCategory;
use App\Model\Product;
use App\Model\SubCategory;
use App\Model\Brand;
use App\Model\CategoryAttribute;
use App\Vendor\Banner;
use App\Model\Gallery;
use App\ProductCategoryAttribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ProductImage;
use Attribute;
use Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function addProduct()
    {
        $vendor = Auth::user();
        $banner = Banner::where('vendor_id', $vendor->id)->first();
        if (empty($banner->file) || empty($vendor->shop_image)) {
            return redirect('/vendor/dashboard')->with('error', 'You have to upload your Shop Image And Shop Banner Before Add Product');
        }

        $categories = Category::all();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();
        $brand = Brand::all();
        return view('vendor.product.addProduct', compact('categories', 'subcategories', 'childcategories', 'brand'));
    }


    public function fetchCategory(Request $req)
    {
        $category = Category::with('attributes.options')->find($req->category_id);

        $attributes = $category->attributes;


        return response([
            'attributes' => $attributes
        ], 200);
    }

    public function createProduct(Request $request)
    {
        
        
       
        
        $request->validate([
            'name'             => 'required',
            'sku'              => 'required|unique:products,sku',
            'category_id'      => 'required',
            'photo'            => 'required|mimes:jpeg,jpg,png',
            'previous_price' => 'required|gt:price',
            'price'            => 'required|gte:0|lt:previous_price',
            'details'          => 'required|max:16777215',
            'tags'             => 'required',
            'specification.*.title' => 'required',
            'specification.*.details' => 'required',
            'stock' => 'nullable|gte:0'
        ], [
            'price.lt' => 'Offered Price Must Be less than Actual Price',
            'specification.*.title.required' => 'Specification Title Required',
            'specification.*.title.details' => 'Specification Details Required',
        ]);


      
        $product_detail = $request->details;

        $product = new Product;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $input['imagename'] = rand(10000, 99999) . time() . '.' . $image->extension();

            $filePath = public_path('uploads/product-images/');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
        }
        $filePath = "uploads/product-images/" . $input['imagename'];


         $specification = [];

        if ($request->product_specification != null) {

        $specification = array_values(array_filter($request->product_specification, function ($var) {
            return isset($var['attribute']);
        }));
        
        }

        $product->name             = $request->name;
        $product->sku              = $request->sku;
        $product->category_id      = $request->category_id;
        $product->subcategory_id   = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->brand_id         = $request->brand_id;
        $product->photo            = $filePath;
        $product->ship             = $request->ship;
        $product->product_specification = $specification;
        $product->specification = array_values($request->specification);

        $product->previous_price   = $request->previous_price;
        $product->price   = $request->price;
        $product->slug             = Str::slug($request->name . " " . $request->sku, "-");
        $product->stock            = $request->stock;
        $product->details          = $product_detail;

        //$product->youtube          = $request->youtube;
        $youtubeId = $this->YoutubeID($request->youtube);
        $product->youtube = $youtubeId;

        $product->tags             = $request->tags;
        $product->status         = 1;
        $product->featured         = 0;

        if ($request->online_payment) {
            $product->online_payment   = $request->online_payment;
        }
        $product->vendor_id          = Auth::id();

        $product->save();

        $count = 1;
        if ($request->hasfile('image_file')) {
            foreach ($request->file('image_file') as $file) {


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

        return redirect()->route('vendor.allProducts')->with('success', 'Product Added Successfully');
    }


    public function showProducts()
    {
        $products = Product::where('vendor_id', Auth::id())->latest()->get();

        $categories = Category::all();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();
        return view('vendor.product.allProducts', compact('products', 'categories', 'subcategories', 'childcategories'));
    }

    public function deActivatedProducts()
    {
        $deactivatedProducts = Product::where('status', 0)->where('vendor_id', Auth::id())->get();
        return view('vendor.product.deactivatedProducts', compact('deactivatedProducts'));
    }

    public function productCatalogs()
    {
        $products = Product::all();
        return view('vendor.product.productCatalogs', compact('products'));
    }

    public function statusUpdate(Request $request, Product $product)
    {
        $product->status = $request->status;
        // dd($product->status);
        $product->save();
        return response()->json('Status Successfully Updated!!!');
    }


    public function productEdit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();
        $brand = Brand::all();
        $gallery = Gallery::where('product_id', '=', $id)->get();

        $attributes = CategoryAttribute::where('category_id', $product->category_id)->with('options')->whereHas('options')->latest()->get();

        return view('vendor.product.editProduct', compact('product', 'categories', 'subcategories', 'childcategories', 'brand', 'gallery','attributes'));
    }


    public function productUpdate(Request $request, $id)
    {

       
        

        $product = Product::find($id);

        $request->validate([
            'name'             => 'required',
            'sku'              => 'required|unique:products,sku,' . $product->id,
            'category_id'      => 'required',
            'photo'            => 'sometimes|mimes:jpeg,jpg,png',
            'previous_price' => 'required|numeric|gt:price',
            'price'            => 'required|gte:0|lt:previous_price',
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



        //   ]);
        $product_detail = $request->details;
       


        $specification = [];

        if ($request->product_specification != null) {
            
        $specification = array_values(array_filter($request->product_specification, function ($var) {
            return isset($var['attribute']);
        }));
        }




        


      
        $product->name             = $request->name;
        $product->sku              = $request->sku;
        $product->category_id      = $request->category_id;
        $product->subcategory_id   = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->brand_id         = $request->brand_id;
        $product->ship             = $request->ship;
        $product->product_specification = $specification;
        $product->color            = $request->color;
        $product->price            = $request->price;
        $product->previous_price   = $request->previous_price;
        // $product->offer_product            = $request->offer;
        $product->details          = $product_detail;
        
        $product->specification = array_values($request->specification);

        //$product->youtube          = $request->youtube;

        $product->youtube = $request->youtube;

        $product->tags             = $request->tags;


        $product->vendor_id = Auth::user()->id;
        $photo     =  $product->photo;
        $delete_path = public_path() . '/' . $photo;

        if ($request->online_payment) {
            $product->online_payment   = $request->online_payment;
        }







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


        




        return redirect()->back()->with('success', 'Product Edited Successfully');
    }

    public function productDelete($id)
    {

        $product = Product::find($id);
        
        dd($product);

        $product->delete();

        return redirect()->back();
    }
    public function productView($id)
    {
        $product = Product::find($id);
        $gallery = Gallery::where('product_id', '=', $id)->get();
        return view('vendor.product.viewProduct', compact('product', 'gallery'));
    }

    public function edit(Category $category)
    {
        return response()->json($category, 200);
    }

    public function findsub($id, Request $req)
    {

        $category = SubCategory::where('category_id', '=', $id)->get();
        return response()->json($category, 200);
    }

    public function findchild($id, Request $req)
    {

        $category = ChildCategory::where('sub_category_id', '=', $id)->get();
        return response()->json($category, 200);
    }

    //Generating the youtube video Key:
    public function YoutubeID($url)
    {
        if (strlen($url) > 11) {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                return $match[1];
            } else
                return false;
        }

        return $url;
    }
}
