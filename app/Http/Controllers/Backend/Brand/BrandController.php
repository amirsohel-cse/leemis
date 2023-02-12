<?php

namespace App\Http\Controllers\Backend\Brand;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.brand-view',compact('brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands',
            'slug' => 'required|unique:brands',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug;


        if ($request->hasFile('photo')){
            $extension = $request->photo->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->photo->move('uploads/brand-images/',$filename);
            $brand->photo = $filename;
        }

        if ($request->hasFile('image')){
            $extension = $request->image->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->image->move('uploads/brand-images/featured/',$filename);
            $brand->image = $filename;
            $brand->is_featured = 1;
        }
        $brand->save();
        $data = Brand::latest()->first();
        return response()->json($data, 200);
    }

    public function edit(Brand $brand)
    {
        return response()->json($brand,200);
    }

    public function update(Request $request, Brand $brand)
    {
          $this->validate($request, [
            'name' => 'required|unique:brands,name,'.$brand->id,
            'slug' => 'required|unique:brands,slug,'.$brand->id,
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        
        $brand->name = $request->name;
        $brand->slug = $request->slug;

        if ($request->hasFile('photo')){
            unlink('uploads/brand-images/'.$brand->photo);
            $extension = $request->photo->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->photo->move('uploads/brand-images/',$filename);
            $brand->photo = $filename;
        }

        if ($request->hasFile('image')){
            if ($brand->image != null){
                unlink('uploads/brand-images/featured/'.$brand->image);
            }
            $extension = $request->image->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->image->move('uploads/brand-images/featured/',$filename);
            $brand->image = $filename;
            $brand->is_featured = 1;
        }
        $brand->save();
        return response()->json($brand,200);
    }

    public function delete(Brand $brand)
    {
        unlink('uploads/brand-images/'.$brand->photo);
        if ($brand->image != null){
            unlink('uploads/brand-images/featured/'.$brand->image);
        }
        $brand->delete();
        return response()->json('Successfully Deleted!!!',200);
    }

    public function statusUpdate(Request $request, Brand $brand)
    {
        $brand->status = $request->status;
        $brand->save();
        return response()->json('Status Successfully Updated!!!');
    }
    
    public function featuredUpdate(Request $request, Brand $brand)
    {
        $brand->is_featured = $request->status;
        $brand->save();
        return response()->json('This brand is featured now!!!');
    }
}
