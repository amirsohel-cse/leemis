<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\MenuBrand;
use App\MenuCategory;
use App\Model\Brand;
use App\Model\SubCategory;
use App\Model\TopMenu;
use Illuminate\Http\Request;

class TopMenuController extends Controller
{
    public function index()
    {
        $topmenus = TopMenu::latest()->get();
        $subcategories = SubCategory::whereStatus(true)->get(['id','name']);
        $brands = Brand::whereStatus(true)->get(['id','name']);
        return view('admin.setting.top-menu-view',compact('topmenus','subcategories','brands'));
    }

    public function store(Request $request)
    {

        $filename = collect([]);

        if($request->has('images')){
            foreach($request->images as $key => $image){
                $filename->push(uploadImage($image, 'uploads/top_menu_images'));
            }
        }
   
        $data = TopMenu::create([
            'images' => $filename->toArray(),
            'name' => $request->name,
            'url' => $request->url
        ]);

        foreach($request->category as $category){
            MenuCategory::create([
                'menu_id' => $data->id,
                'category_id' => $category
            ]);
        }

        foreach($request->brand as $brand){
            MenuBrand::create([
                'menu_id' => $data->id,
                'brand_id' => $brand
            ]);
        }
        
        return response()->json($data,200);
    }

    public function edit(TopMenu $topmenu)
    {
        return response()->json($topmenu,200);
    }

    public function update(Request $request, TopMenu $topmenu)
    {
        
        $filename = collect([]);
        
        $topmenu->name = $request->name;
        $topmenu->url = $request->url;
        
        
         if($request->has('images')){
            foreach($request->images as $key => $image){
                $filename->push(uploadImage($image, 'uploads/top_menu_images'));
            }
        }
        
        $topmenu->images = $filename->toArray();
        $topmenu->save();
        
        
        $topmenu->menuCategories->map(function($item){
            $item->delete();
        });
        
         $topmenu->menuBrands->map(function($item){
            $item->delete();
        });
        
        
         foreach($request->category as $category){
            MenuCategory::create([
                'menu_id' => $topmenu->id,
                'category_id' => $category
            ]);
        }

        foreach($request->brand as $brand){
            MenuBrand::create([
                'menu_id' => $topmenu->id,
                'brand_id' => $brand
            ]);
        }
        
        
        return response()->json($topmenu,200);
    }

    public function statusUpdate(Request $request, TopMenu $topmenu)
    {
        $topmenu->status = $request->status;
        $topmenu->save();
        return response()->json('Status Successfully Updated!!!',200);
    }

    public function delete(TopMenu $topmenu)
    {
        $topmenu->delete();
        return response()->json('Top menu successfully Deleted!!!');
    }
}
