<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subcategories = SubCategory::orderBy('id', 'DESC')->get();
        $brands = Brand::whereStatus(true)->get(['id','name']);
        return view('admin.sub-category.sub-category-view',compact('subcategories','categories','brands'));
    }

    public function store(Request $request)
    {
       
        $data = $this->validate($request,[
            'name' => 'required|unique:sub_categories',
            'slug' => 'required',
            'category_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'top_brand' => 'required'
        ]);

        if($request->has('photo')){
            $data['photo'] = uploadImage($request->photo, 'uploads/category-images');
        }

        $data = SubCategory::create($data);
        $category = isset($data->category->name) ? $data->category->name : '';
        return response()->json([
            'data' => $data,
            'category' => $category
        ],200);
    }

    public function edit(SubCategory $subCategory)
    {
        return response()->json($subCategory);
    }

    public function update(SubCategory $subCategory, Request $request)
    {

        $this->validate($request,[
            'name' => 'required|unique:sub_categories,name,'.$subCategory->id,
            'slug' => 'required',
            'category_id' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->has('photo')){
            $filename = uploadImage($request->photo, 'uploads/category-images','',$subCategory->photo);
        }


        $category = $subCategory->category->name;
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->slug = $request->slug;
        $subCategory->top_brand = $request->top_brand;
        $subCategory->photo = $filename ?? $subCategory->photo ;
        $subCategory->save();

        return redirect()->back();
    }

    //Status update
    public function statusUpdate(Request $request, SubCategory $subCategory)
    {
        $subCategory->status = $request->status;
        $subCategory->save();
        return response()->json('Status Successfully Updated!!!',200);
    }

    public function delete(SubCategory $subCategory)
    {
        $subCategory->child_categories()->delete();
        $subCategory->delete();
        return response()->json('SubCategory Successfully Deleted!!!',200);
    }
}
