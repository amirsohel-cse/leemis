<?php

namespace App\Http\Controllers\Vendor;

use App\Events\OrderCompleteEvent;
use App\Events\WithdrawEvent;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\OrderProduct;
use App\Model\Other;
use App\Model\Vendor;
use App\Model\Withdraw;
use App\Notifications\VendorOrderNotification;
use App\Notifications\WithdrawNotification;
use App\Vendor\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class vendorController extends Controller
{
    public function index(){
        return view('vendor.vendor_login');
    }

    public function banner()
    {
        $data=Banner::first();

        if($data){
            $data=$data->file;

        }
        else{
            $data="common.png";
        }
        return view('vendor.setting.banner',['data'=>$data]);
    }
    public function storeBanner(Request $req)
    {
      // return $req;
        $validated = $req->validate([
            'file' => 'required',
        ]);
        $data=Banner::first();
        if($data){
            $data_name=$data->file;
            $data_path= public_path('storage/storeFavicon/'.$data_name);
            unlink($data_path);
            $data->delete();
        }

        $data=new Banner;
        if($req->file('file')){
            $file=$req->file('file');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $req->file->move('storage/storeFavicon/',$filename);
            $data->file=$filename;
        }
        $data->save();

        return response()->json(['success'=>'Ajax request submitted successfully']);
    }
     public function viewProfile()
    {
        $vendor = Vendor::find(Auth::id());
        return view('vendor.vendor.profile',compact('vendor'));
    }

    public function showProfile()
    {
        $vendor = Vendor::find(Auth::id());
        return view('vendor.vendor.vendor-profile',compact('vendor'));
    }
    public function updateProfile(Request $request)
    {
        //return $request;
        $vendor = Vendor::find(Auth::id());
        $this->validate($request, [
            'shop_name' => 'max:100',
            'address' => 'required',
            'shop_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'max:100',
            'email' => 'required',
            'phone' => 'required|digits:11',
            'password' => ($request->password!=''?'min:8|confirmed':''),

        ]);


        if ($request->hasFile('shop_image')){
            if($vendor->shop_image)
            {unlink('uploads/vendors/'.$vendor->shop_image);}
            $extension = $request->shop_image->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->shop_image->move('uploads/vendors/',$filename);
            $vendor->shop_image = $filename;
        }
        if ($request->hasFile('image')){
            if($vendor->image)
           { unlink('uploads/vendors/'.$vendor->image);}
            $extension = $request->image->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->image->move('uploads/vendors/',$filename);
            $vendor->image = $filename;
        }

        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->shop_name = $request->shop_name;
        $vendor->address = $request->address;
        if($request->has('password') && !empty($request->password)) {
            $vendor->password = bcrypt($request->password);
        }

        $vendor->save();
        return response()->json($vendor,200);
    }
    public function vendorWithdraws()
    {
        $data['withdraws'] = Withdraw::where('vendor_id', Auth::id())->get();

        $total_income = OrderProduct::where('vendor_id',Auth::id())->sum('vendor_income');
        $withdraw = Withdraw::where('vendor_id', Auth::id())->where('status', '!=' , 'Declined')->sum('amount');
        $data['current_bal'] = $total_income-$withdraw;
        // dd($data);
        return view('vendor.withdraws.withdraw', compact('data'));
    }

    public function withdrawStore(Request $request, Withdraw $withdraw)
    {
        $other = Other::latest()->first();
        $this->validate($request, [
        'method' => 'required',
        'amount' => 'required|numeric',
        'iban' => 'required',
        'acc_name' => 'required',
        'routing_number' => 'required',
        'swift' => 'required',
        'bankname' => 'required',
        ]);

        if($other->min_withdraw_amount > $request->amount){
            return response()->json(['minimum_withdraw' => ['amount' =>$other->min_withdraw_amount, 'error'=>'error']], 421);
        }

        $total_income = OrderProduct::where('vendor_id',Auth::id())->sum('vendor_income');

        $withdraw = Withdraw::where('vendor_id', Auth::id())->where('status', '!=' , 'Declined')->sum('amount');
        $current_bal = $total_income-$withdraw;


        if($current_bal >= $request->amount){
            $withdraw = new Withdraw();
            $withdraw->vendor_id = Auth::id();
            $withdraw->method = $request->method;
            $withdraw->amount += $request->amount;
            $withdraw->account_no = $request->iban;
            $withdraw->account_name = $request->acc_name;
            $withdraw->routing_number = $request->routing_number;
            $withdraw->swift_code = $request->swift;
            $withdraw->bank_name = $request->bankname;
            $withdraw->status = 'Pending';

            $withdraw->save();
        }else{
            return response()->json('balance_error', 421);
        }

        $withdraw = Withdraw::where('vendor_id', Auth::id())->where('status', '!=', 'Declined')->sum('amount');
        $current_bal = $total_income-$withdraw;
        $data = Withdraw::latest()->first();
        //Real time Notification
        $admins = Admin::all();
        Notification::send($admins,new WithdrawNotification($data->vendor->name, $request->amount, Auth::id()));
        $note = DB::table('notifications')->latest()->first();
        $text = 'has placed an Withdraw Req.';
        $type = 'withdraw';
        $created_at = $note->created_at;
        event(new WithdrawEvent($data->vendor->name,Auth::id(),
            $request->amount,$text,$type,$created_at,$note->id));
        //Notification
        return response()->json([$data, $current_bal],200);
    }



}
