<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Model\AttributeOption;
use App\Model\Category;
use App\Model\CategoryAttribute;
use App\model\CategoryTranslation;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.category-view', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'slug' => 'required',
            'commision' => 'required|gte:0',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->commision = $request->commision;

        if ($request->hasFile('photo')) {
            $extension = $request->photo->getClientOriginalExtension();
            $filename = rand(10000, 99999) . time() . '.' . $extension;
            $request->photo->move('uploads/category-images/', $filename);
            $category->photo = $filename;
        }

        // if ($request->hasFile('image')){
        //     $extension = $request->image->getClientOriginalExtension();
        //     $filename = rand(10000,99999).time().'.'.$extension;
        //     $request->image->move('uploads/category-images/featured/',$filename);
        //     $category->image = $filename;
        //     $category->is_featured = 1;
        // }
        $category->save();
        $data = Category::latest()->first();
        return response()->json($data, 200);
    }

    public function edit(Category $category)
    {
        return response()->json($category, 200);
    }

    public function update(Request $request, Category $category)
    {

        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required',
            'commision' => 'required|gte:0',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->commision = $request->commision;

        if ($request->hasFile('photo')) {
            unlink('uploads/category-images/' . $category->photo);
            $extension = $request->photo->getClientOriginalExtension();
            $filename = rand(10000, 99999) . time() . '.' . $extension;
            $request->photo->move('uploads/category-images/', $filename);
            $category->photo = $filename;
        }

        // if ($request->hasFile('image')){
        //     if ($category->image != null){
        //         unlink('uploads/category-images/featured/'.$category->image);
        //     }
        //     $extension = $request->image->getClientOriginalExtension();
        //     $filename = rand(10000,99999).time().'.'.$extension;
        //     $request->image->move('uploads/category-images/featured/',$filename);
        //     $category->image = $filename;
        //     $category->is_featured = 1;
        // }
        $category->save();
        return response()->json($category, 200);
    }

    public function delete(Category $category)
    {
        unlink('uploads/category-images/' . $category->photo);
        // if ($category->image != null){
        //     unlink('uploads/category-images/featured/'.$category->image);
        // }
        //        $category->sub_categories->child_categories->delete();
        //        $category->sub_categories->delete();
        foreach ($category->sub_categories as $child) {
            foreach ($child->child_categories as $grandchild) {
                $grandchild->delete();
            }
            $child->delete();
        }
        $category->delete();
        return response()->json('Successfully Deleted!!!', 200);
    }

    public function statusUpdate(Request $request, Category $category)
    {
        $category->status = $request->status;
        $category->save();
        return response()->json('Status Successfully Updated!!!');
    }

    public function featureUpdate(Request $request, Category $category)
    {
        $category->is_featured = $request->status;
        $category->save();
        return response()->json('This Category is featured now');
    }

    public function category(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', Rule::unique('category_attributes')->where(fn($query) => $query->where('category_id', $id))],
            'options' => 'required',
        ]);

        $categoryAttribute = CategoryAttribute::create([
            'category_id' => $id,
            'name' => $request->name,
        ]);

        foreach ($request->options as $option) {
            AttributeOption::create([
                'category_attribute_id' => $categoryAttribute->id,
                'option' => $option,
            ]);
        }

        return redirect()->back()->with('success', " Category Attribute Added successfully");
    }

    public function categoryAttributeShow($id)
    {
        $category = Category::findOrFail($id);

        $pageTitle = 'Category Attributes';

        return view('admin.category.attribute', compact('category', 'pageTitle'));

    }

    public function categoryAttributeEdit(Request $request)
    {

        $request->validate([
            'options' => 'required',
        ]);

        $categoryAttribute = CategoryAttribute::findOrFail($request->attribute_id);

        $categoryAttribute->update([
            'name' => $request->name,
        ]);

        foreach ($categoryAttribute->options as $key => $item) {

            if (isset($request->options[$key])) {

                $item->update([
                    'category_attribute_id' => $categoryAttribute->id,
                    'option' => $request->options[$key],
                ]);
            } else {
                $item->delete();
            }

            $last = $key + 1;
        }

        if (isset($request->options[$last])) {
            AttributeOption::create([
                'category_attribute_id' => $categoryAttribute->id,
                'option' => $request->options[$last],
            ]);
        }

        return redirect()->back()->with('success', " Category Attribute Updated successfully");
    }

    public function categoryAttributeDelete(Request $request)
    {
        $categoryAttribute = CategoryAttribute::findOrFail($request->id);

        $categoryAttribute->options->map(function ($item) {
            $item->delete();
        });

        $categoryAttribute->delete();

        return redirect()->back()->with('success', " Category Attribute Deleted successfully");

    }

    public function categoryAttributeFetch(Request $request)
    {
        $category = Category::with('attributes.options')->find($request->category_id);

        $product = Product::find($request->product_id);

        $attributes = $category->attributes;

        $optionId = $product->attributeOptions->pluck('attribute_option_id')->toArray();

        return response([
            'attributes' => $attributes,
            'optionId' => $optionId,
        ], 200);

    }

    public function addTranslation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $trans = new CategoryTranslation();
        $trans->category_id = $request->get('category_id');
        $trans->name = $request->get('name');
        $trans->lang = $request->get('lang');
        $trans->save();

        return response()->json(['success' => 'Translation added successfully.']);

    }
}
