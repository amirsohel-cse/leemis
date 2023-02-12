<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Model\Vendor;
use App\User;
use App\Model\Product;
use App\Model\Withdraw;


use App\Mail\VendorEmail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendorShow()
    {
        $vendors = Vendor::where('s_status', 1)->get();

        return view('admin.vendor.vendorsList', compact('vendors'));
    }

    public function deactivatedvendor()
    {
        $vendors = Vendor::where('s_status', 0)->get();
        return view('admin.vendor.vendorsList', compact('vendors'));
    }

    public function sendmail(Request $req)
    {
        $order = Vendor::findOrFail($req->id);

        $inputs = $req->all();
        // Ship the order...

        Mail::to($order->email)->send(new VendorEmail($inputs));
        return redirect()->back()->with('success',"E-mail Successfully Send");
    }

    public function featureUpdate(Request $request, Vendor $vendor)
    {
        $vendor->feature = $request->feature;
        $vendor->save();
        return response()->json('Status Successfully Updated!!!');
    }
    public function statusUpdate(Request $request, Vendor $vendor)
    {
        $vendor->s_status = $request->status;
        $vendor->save();
        if ($request->status == 0) {
            Product::where('vendor_id', $vendor->id)
                ->update(['status' => 0]);
        } else {
            Product::where('vendor_id', $vendor->id)
                ->update(['status' => 1]);
        }

        return response()->json('Status Successfully Updated!!!');
    }


    public function edit(Vendor $vendor)
    {
        return response()->json($vendor, 200);
    }

    public function update(Request $request, Vendor $vendor)
    {
        
        $request->validate([
            'shop_name' => 'required|unique:vendors,shop_name,'.$vendor->id,
            'email' => 'required|unique:vendors,email,'.$vendor->id,
            'phone' => 'required|unique:vendors,phone,'.$vendor->id,
            'address' => 'required',
            'name' => 'required'
        ]);

        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->shop_name = $request->shop_name;
        $vendor->address = $request->address;
        $vendor->save();
        // return response()->json($vendor, 200);
        if(url()->previous() === url('admin/vendor/deactivatedvendorsList')){
            
            $vendors = Vendor::where('s_status', 0)->get();
        }else{
            $vendors = Vendor::where('s_status', 1)->get();
        }


        return view('admin.vendor.vendor_response', compact('vendors'));

    }

    public function delete(Vendor $vendor)
    {
        $vendor->delete();
        return response()->json('Successfully Deleted!!!', 200);
    }


    public function customerShow()
    {
        $customer = User::all();

    

        return view('admin.customer.list', compact('customer'));
    }

    public function customerstatusUpdate(Request $request, User $customer)
    {
        $customer->status = $request->status;

        $customer->save();

        return response()->json('Status Successfully Updated!!!');
    }


    public function customerEdit(User $customer)
    {
        return response()->json($customer, 200);
    }

    public function customerUpdate(Request $request, User $customer)
    {

        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();
        return response()->json($customer, 200);
    }

    public function customerDelete(User $customer)
    {
        $customer->delete();
        return response()->json('Successfully Deleted!!!', 200);
    }


    //withdraw
    public function withdraw()
    {
        $withdraw = Withdraw::all();
        return view('admin.vendor.vendor_withdraw', compact('withdraw'));
    }

    public function withdrawUpdate(Request $request, withdraw $id)
    {
        $id->status = $request->status;
        $id->save();
        return response()->json('Status Successfully Updated!!!');
    }


    public function withdrawView($id)
    {
        $withdraw = Withdraw::where('id', $id)->get();
        return view('admin.vendor.withdrawview', compact('withdraw'));
    }
}
