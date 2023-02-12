<?php

namespace App\Http\Controllers;

use App\Artical;
use App\HelpCategory;
use Illuminate\Http\Request;


class HelpController extends Controller
{
    public function index()
    {
        $helps = HelpCategory::latest()->get();

        return view('admin.help.index',compact('helps'));
    }

    public function store(Request $request)
    {
        HelpCategory::create(
            $request->validate([
                'name' => 'required|unique:help_categories,name',
                'status' => 'required|in:0,1'
            ])
            );


            return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $category = HelpCategory::findOrFail($id);
        $data = $request->validate([
        'name' => 'required|unique:help_categories,name,'. $category->id,
        'status' => 'required|in:0,1'
        ]);

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->back();

    }


    public function articles(HelpCategory $id)
    {
        return view('admin.help.articals',compact('id'));
    }

    public function articlesStore(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:articals,title',
            'description' => 'required'
        ]);

        Artical::create([
            'help_category_id' => $request->help_category_id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success','Successfully Create Article');
    }


    public function articlesUpdate(Request $request)
    {
        $article = Artical::findOrFail($request->article_id);

        $request->validate([
            'title' => 'required|unique:articals,title,'.$article->id,
            'description' => 'required'
        ]);

        $article->update([
            'title' => $request->title,
            'description' => $request->description
        ]);


        return redirect()->back()->with('success','Successfully Update Article');
    }
}
