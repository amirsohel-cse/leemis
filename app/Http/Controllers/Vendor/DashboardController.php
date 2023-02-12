<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Vendor\Banner;
use App\Model\Withdraw;
use App\Model\Vendor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $totalProduct = Product::where('vendor_id',Auth::id())->count();
        $total=OrderProduct::get();
        $withdraw = Withdraw::where('vendor_id', Auth::id())->where('status', '!=', 'Declined')->sum('amount');
        return view('vendor.dashboard.index',compact("total",'withdraw','totalProduct'));
    }
    public function bannerView()
    {
        $id = Auth::id();
        $data=Banner::where('vendor_id','=',$id)->first();
        $logo=Vendor::where('id',$id)->first();
        if($data)
        {
            $data=$data->file;
        }
        else{
            $data="common.png";
        }

        if($logo->shop_image)
        {
            $logo=$logo->shop_image;
        }
        else if(!$logo->shop_image){
            $data="common.png";
        }
        //return $data;
        return view('vendor.setting.banner',['data'=>$data,'id'=>$id,'logo'=>$logo]);
    }
    public function storeBanner(Request $request,$id)
    {
        //return $id;
        $this->validate($request, [
             'file'=>'required',    
        ]);
        $id = Auth::id();
        $banner=Banner::where('vendor_id','=',$id)->first();
        if($banner)
        {
            $file_name=$banner->file;
            $file_path= public_path('storage/storeFavicon/'.$file_name);
            unlink($file_path);
            $banner->delete();
        }
       
            $banner = new Banner();
            if ($request->hasFile('file')){
                $extension = $request->file->getClientOriginalExtension();
                $filename = rand(10000,99999).time().'.'.$extension;
                $request->file->move('storage/storeFavicon/',$filename);
                $banner->file=$filename;
            }
            $banner->vendor_id=$id;
            $banner->save();
        
        return response()->json(['success'=>'Ajax request submitted successfully']);
      
    }
    
    
    public function storeLogo(Request $request,$id)
    {
        //return $id;
        $this->validate($request, [
             'file'=>'required',
        ]);
        $id = Auth::id();
        //$banner=Vendor::where('id','=',$id)->select('shop_image')->first();
        // if($banner)
        // {
        //     $file_name=$banner->shop_image;
        //     $file_path= public_path('uploads/vendors/'.$file_name);
        //     unlink($file_path);
        //     $banner->delete();
        // }

            $banner = Vendor::find($id);
            if ($request->hasFile('file')){
                $extension = $request->file->getClientOriginalExtension();
                $filename = rand(10000,99999).time().'.'.$extension;
                $request->file->move('uploads/vendors/',$filename);
                $banner->shop_image=$filename;
            }
           // $banner->vendor_id=$id;
            $banner->save();

        return response()->json(['success'=>'Ajax request submitted successfully']);

    }

}
