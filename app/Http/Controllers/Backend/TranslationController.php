<?php

namespace App\Http\Controllers\backend;

use App\Model\Category;
use Illuminate\Http\Request;
use App\model\CategoryTranslation;
use App\Http\Controllers\Controller;
use App\Model\ChildCategory;
use App\model\ChildCategoryTranslation;
use App\Model\SubCategory;
use App\model\SubCategoryTranslation;
use Illuminate\Support\Facades\Validator;

class TranslationController extends Controller
{
    public function categoryTranslation(Request $request)
    {
        $category = Category::find($request->id);
        $translations = CategoryTranslation::where('category_id', $request->id)->get();

        return view('admin.category.category-translation', compact('category', 'translations'));
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

        $getTranslation = CategoryTranslation::where('category_id', $request->category_id)->where('lang', $request->lang)->first();
        if (!$getTranslation) {
            $trans = new CategoryTranslation();
            $trans->category_id = $request->get('category_id');
            $trans->name = $request->get('name');
            $trans->lang = $request->get('lang');
            $trans->save();

            return response()->json(['success' => 'Translation added successfully.']);
        } else{
            return response()->json([
                'error' => ["Translation already exists"],
            ]);
        }


    }

    public function editTranslation(Request $request)
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

        $getTranslation = CategoryTranslation::where('category_id', $request->category_id)->where('id', '!=', $request->translation_id)->where('lang', $request->lang)->first();
        if (!$getTranslation) {
            $trans = CategoryTranslation::where('id', $request->translation_id)->first();
            $trans->category_id = $request->get('category_id');
            $trans->name = $request->get('name');
            $trans->lang = $request->get('lang');
            $trans->save();

            return response()->json(['success' => 'Translation updated successfully.']);
        } else{
            return response()->json([
                'error' => ["Translation already exists"],
            ]);
        }


    }

    public function deleteCategoryTranslation(Request $request)
    {
        $category = CategoryTranslation::find($request->translation_id);
        $category->delete();

        return response()->json(['success' => 'Translation deleted successfully.']);
    }

    //sub Category
    public function subCategoryTranslation(Request $request)
    {
        $category = SubCategory::find($request->id);
        $translations = SubCategoryTranslation::where('category_id', $request->id)->get();

        return view('admin.sub-category.sub-category-translation', compact('category', 'translations'));
    }

    public function addSubCategoryTranslation(Request $request)
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

        $getTranslation = SubCategoryTranslation::where('category_id', $request->category_id)->where('lang', $request->lang)->first();
        if (!$getTranslation) {
            $trans = new SubCategoryTranslation();
            $trans->category_id = $request->get('category_id');
            $trans->name = $request->get('name');
            $trans->lang = $request->get('lang');
            $trans->save();

            return response()->json(['success' => 'Translation added successfully.']);
        } else{
            return response()->json([
                'error' => ["Translation already exists"],
            ]);
        }


    }

    public function editSubCategoryTranslation(Request $request)
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

        $getTranslation = SubCategoryTranslation::where('category_id', $request->category_id)->where('id', '!=', $request->translation_id)->where('lang', $request->lang)->first();
        if (!$getTranslation) {
            $trans = SubCategoryTranslation::where('id', $request->translation_id)->first();
            $trans->category_id = $request->get('category_id');
            $trans->name = $request->get('name');
            $trans->lang = $request->get('lang');
            $trans->save();

            return response()->json(['success' => 'Translation updated successfully.']);
        } else{
            return response()->json([
                'error' => ["Translation already exists"],
            ]);
        }


    }

    public function deleteSubCategoryTranslation(Request $request)
    {
        $category = SubCategoryTranslation::find($request->translation_id);
        $category->delete();

        return response()->json(['success' => 'Translation deleted successfully.']);
    }

    //Child Category
    public function childCategoryTranslation(Request $request)
    {
        $category = ChildCategory::find($request->id);
        $translations = ChildCategoryTranslation::where('category_id', $request->id)->get();

        return view('admin.child-category.child-category-translation', compact('category', 'translations'));
    }

    public function addChildCategoryTranslation(Request $request)
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

        $getTranslation = ChildCategoryTranslation::where('category_id', $request->category_id)->where('lang', $request->lang)->first();
        if (!$getTranslation) {
            $trans = new ChildCategoryTranslation();
            $trans->category_id = $request->get('category_id');
            $trans->name = $request->get('name');
            $trans->lang = $request->get('lang');
            $trans->save();

            return response()->json(['success' => 'Translation added successfully.']);
        } else{
            return response()->json([
                'error' => ["Translation already exists"],
            ]);
        }


    }

    public function editChildCategoryTranslation(Request $request)
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

        $getTranslation = ChildCategoryTranslation::where('category_id', $request->category_id)->where('id', '!=', $request->translation_id)->where('lang', $request->lang)->first();
        if (!$getTranslation) {
            $trans = ChildCategoryTranslation::where('id', $request->translation_id)->first();
            $trans->category_id = $request->get('category_id');
            $trans->name = $request->get('name');
            $trans->lang = $request->get('lang');
            $trans->save();

            return response()->json(['success' => 'Translation updated successfully.']);
        } else{
            return response()->json([
                'error' => ["Translation already exists"],
            ]);
        }


    }

    public function deleteChildCategoryTranslation(Request $request)
    {
        $category = ChildCategoryTranslation::find($request->translation_id);
        $category->delete();

        return response()->json(['success' => 'Translation deleted successfully.']);
    }
}
