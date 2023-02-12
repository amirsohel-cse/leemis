<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Model\ChildCategory;
use App\Model\SubCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    public function index()
    {
        $childcategories = ChildCategory::all();
        $subcategories = SubCategory::all();
        return view('admin.child-category.child-category-view',compact('childcategories','subcategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:child_categories',
            'slug' => 'required',
            'sub_category_id' => 'required'
        ]);

        $data = ChildCategory::create($request->all());
        $subcategory = isset($data->sub_category->name) ? $data->sub_category->name : '';
        return response()->json([
            'data' => $data,
            'subcategory' => $subcategory
        ],200);
    }

    public function edit(ChildCategory $childCategory)
    {
        return response()->json($childCategory);
    }

    public function update(Request $request, ChildCategory $childCategory)
    {
        $this->validate($request,[
            'name' => 'required|unique:child_categories,name,'.$childCategory->id,
            'slug' => 'required',
            'sub_category_id' => 'required'
        ]);

        $subCategory = $childCategory->sub_category->name;
        $childCategory->name = $request->name;
        $childCategory->sub_category_id = $request->sub_category_id;
        $childCategory->slug = $request->slug;
        $childCategory->save();
        return response()->json([
            'childcategory' => $childCategory,
            'subcategory' => $subCategory
        ],200);
    }

    //Status update
    public function statusUpdate(Request $request, ChildCategory $childCategory)
    {
        $childCategory->status = $request->status;
        $childCategory->save();
        return response()->json('Status Successfully Updated!!!',200);
    }

    public function delete(ChildCategory $childCategory)
    {
        $childCategory->delete();
        return response()->json('Child Category Successfully Deleted!!!',200);
    }
}
