<?php

namespace App\Http\Controllers\backend;

use App\Model\Category;
use Illuminate\Http\Request;
use App\model\CategoryTranslation;
use App\Http\Controllers\Controller;
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
}
