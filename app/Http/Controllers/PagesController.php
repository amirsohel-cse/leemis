<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        

        $data['pages'] = Page::when($request->search, function($query) use($request){
            $query->where('name','LIKE','%'.$request->search.'%');
        })->paginate();

        return view('admin.pages.pages')->with($data);
    }

    public function pageCreate()
    {
        $pageTitle = 'Create Page';

        return view('admin.pages.pages_create');
    }

    public function pageInsert(Request $request)
    {
        
        $request->validate([
            'page' => 'required|unique:pages,name',
            'custom_section' => 'required',
            'status' => 'required|in:0,1'
        ]);

        Page::create([
            'name' => $request->page,
            'slug' => Str::slug($request->page),
            'status' => $request->status,
            'custom_section_data' => $request->custom_section,
        ]);

        $notify[] = ['success' ,'Page Created Successfully'];

        return redirect()->route('frontend.pages')->withNotify($notify);
    }

    public function pageEdit(Request $request, Page $page)
    {

        return view('admin.pages.page_edit',compact('page'));
    }

    public function pageUpdate(Request $request, Page $page)
    {

        
        $request->validate([
            'page' => 'required|unique:pages,name,'. $page->id,
            'custom_section' => 'required',
            'status' => 'required|in:0,1'
        ]);


        $page->update([
            'name' => $request->page,
            'slug' => Str::slug($request->page),
            'status' => $request->status,
            'custom_section_data' => $request->custom_section,
        ]);

        $notify[] = ['success' ,'Page Updated Successfully'];

        return redirect()->route('frontend.pages')->withNotify($notify);
    }

    public function pageDelete (Request $request,Page $page)
    {
        if($page->name == 'home'){

            $notify[] = ['error' ,'At least One page is Required'];

            return back()->withNotify($notify);
        }
        $page->delete();

        $notify[] = ['success' ,'Page Deleted Successfully'];

        return back()->withNotify($notify);
    }
}
