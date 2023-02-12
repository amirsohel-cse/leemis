<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Other;
use App\Model\Rating;
use Illuminate\Http\Request;

class mobileversionController extends Controller
{
    public function mobileversion()
    {
        $version = Other::first();
       
        return view('admin.mobileversion.index',compact('version'));
    }

    public function update(Request $request)
    { 
        $version = Other::first();

        $version->app_version = $request->version;

        $version->save();

        return redirect()->back()->with('success','Successfully save app version');
       
    }

   
   
}