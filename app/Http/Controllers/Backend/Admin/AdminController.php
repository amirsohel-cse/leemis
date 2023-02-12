<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admin.admin-view',compact('admins'));
    }

    // return create view
    public function create()
    {
        return view('admin.admins.admin-create');
    }

    // wil be used for admin add
    public function store(Request $request, Admin $admin)
    {
        $this->validate($request, [
        'name' => 'required|max:100',
        'email' => 'required|email|unique:admins',
        'phone' => '',
        'password' => 'required|min:8|confirmed',
        'status' => '',
        'role_id' => '',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $admin = new Admin();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->role_id = $request->role_id;
        $admin->password = bcrypt($request->password);

        // if there is file in image field
        if($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time().'-'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('uploads/admins'), $filename);

            // save filename to database
            $admin->image = $filename;
        }

        $admin->save();
        $data = Admin::latest()->first();
        return response()->json($data, 200);
    }

    // ------------------------------------------------------------------------------------------
    public function edit(Admin $admin)
    {
        return response()->json($admin,200);
    }

    //  to update admin
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, [
            'name' => 'max:100',
            // if requested email and admin email same, no validation applied
            'email' => ($request->email != $admin->email ? 'required|email|unique:admins,email,':''),
            'phone' => '',
            // if the password field is blank, no validation applied
            'password' => ($request->password!=''?'min:8|confirmed':''),
            'status' => '',
            'role_id' => '',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        //  if validation fails
        // if($validator->fails()){
        //     $erorrs = ['message' => 'Validation error!!!',
        //                'errors' => ['name' => $validator->errors()->get('name'),
        //                             'email' => $validator->errors()->get('email'),
        //                             'password' => $validator->errors()->get('password'),
        //                             'role' => $validator->errors()->get('role'),
        //                             'gender' => $validator->errors()->get('gender'),
        //                             'address' => $validator->errors()->get('address')
        //                             ]
        //             ];
        //     return redirect()->route('admin.edit', $admin->id)->withInput()->with(['errors' => $erorrs]);
        // }

        //  insert data ........
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request-> phone;
        $admin->role_id = $request->role_id;

        // if there is password & not blank then insert password
        if($request->has('password') && !empty($request->password)) {
            $admin->password = bcrypt($request->password);
        }

        //  if there is image
        if($request->hasFile('image')) {
            // remove image
            $this->removeImage($admin);
            $file = $request->file('image');
            $filename = time().'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/admins'), $filename);
            $admin->image = $filename;
        }

        $admin->save();
        return response()->json($admin,200);
    }

    public function showProfile()
    {   
        $admin = Admin::find(Auth::id());
        return view('admin.admin.admin-profile',compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        // to update admin
        $admin = Admin::find(Auth::id());

        $this->validate($request, [
            'name' => 'max:100',
            // if requested email and admin email same, no validation applied
            'email' => ($request->email != $admin->email ? 'required|email|unique:admins,email,':''),
            'phone' => '',
            // if the password field is blank, no validation applied
            'password' => ($request->password!=''?'min:8|confirmed':''),
            'status' => '',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        //  insert data ........
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request-> phone;

        // if there is password & not blank then insert password
        if($request->has('password') && !empty($request->password)) {
            $admin->password = bcrypt($request->password);
        }

        //  if there is image
        if($request->hasFile('image')) {
            // remove image
            $this->removeImage($admin);
            $file = $request->file('image');
            $filename = time().'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/admins'), $filename);
            $admin->image = $filename;
        }

        $admin->save();
        return response()->json($admin,200);
    }

    public function delete(Admin $admin)
    {
        // remove image
        $this->removeImage($admin);
        $admin->delete();
        return response()->json('Successfully Deleted!!!',200);
    }

    // public function deleteImage(Admin $admin)
    // {
    //     // remove image
    //     $this->removeImage($admin);
    //     $admin->image = null;
    //     $admin->save();
    //     return redirect()->back()->with("success_msg", ' Image Deleted successfully!');
    // }

    private function removeImage($admin)
    {
        if($admin->image != "" && \File::exists('uploads/admins/' . $admin->image)) {
            @unlink(public_path('uploads/admins/' . $admin->image));
        }
    }
}
