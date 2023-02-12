<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $language = json_decode(file_get_contents(resource_path('lang/website.json')),true);

        return view('admin.language.index',compact('language'));
    }

    public function update (Request $request)
    {
        $data = json_encode($request->lang);

        file_put_contents(resource_path('lang/website.json'),$data);

        $notify[] = ['success','Update Success'];
        return redirect()->back()->withNotify($notify);
    }
}