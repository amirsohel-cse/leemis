<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        // to update customer
        $user = User::find(Auth::id());

        $this->validate($request, [
            'name' => 'required|max:100',
            // if requested email and user email same, no validation applied
            'email' => ($request->email != $user->email ? 'required|email|unique:users,email,':''),
            'phone' =>  ($request->phone != $user->phone ? 'required|unique:users,':''),
            // if the password field is blank, no validation applied
            'password' => ($request->password!=''?'min:8|confirmed':''),
            'gender' =>'',
            'city' =>'max:100',
            'address' =>'max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        //  insert data ........
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request-> phone;
        $user->address = $request-> address;
        $user->gender = $request-> gender;
        $user->city = $request-> city;

        // if there is password & not blank then insert password
        if($request->has('password') && !empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        //  if there is image
        if($request->hasFile('image')) {
            // remove image
            $this->removeImage($user);
            $file = $request->file('image');
            $filename = time().'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $user->image = $filename;
        }

        $user->save();
        return response()->json($user,200);
    }


    private function removeImage($user)
    {
        if($user->image != "" && \File::exists('uploads/users/' . $user->image)) {
            @unlink(public_path('uploads/users/' . $user->image));
        }
    }
}