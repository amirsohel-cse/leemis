<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $rules = [
            'phone' => 'required|string',
            'password' => 'required|min:8|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 400);
        }


        if (!Auth::attempt($request->only('phone', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('phone', $request->phone)->where('status',1)->first();
        
        if(!$user){
            return response()->json('Your Account is not active',404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user'=>$user
        ]);

    }
    
    public function forgotMobile(Request $request){
         $user = User::where('phone', $request->phone)->first();
         
         if(!$user){
             return response()->json(['error'=>'No User Associated with this mobile'], 404);
         }
         
        $code = (string)rand(1000,9999);
        
        
            $token  = "7bc26225b80f23ed3ccacd70e62aae42";
            $mobile = $request->phone;
            $sms_content = 'Verification OTP from Hypershop. Your OTP is: ' . $code;
            $msg=urlencode($sms_content);


            $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
            $tweets =  $this->curl($feed);
        
        
        $user->code = $code;
        $user->save();
        
        
         return response()->json(['otp' => $code],200);
         
    }
    
    
    public function otpverify(Request $request){
        
        $request->validate(['code' => 'required','phone' => 'required']);
        
        $user = User::where('phone', $request->phone)->first();
        
        if($user->code == $request->code){
            return response()->json('success',200);
        }
        
        return response()->json(['error'=> 'Wrong Otp Code'],404);
    }
    
    
    public function resetPassword(Request $request){
        
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);
        
        
         $user = User::where('phone', $request->phone)->first();
         
        
         
         $user->code = null;
         $user->password = bcrypt($request->password);
         $user->save();
         
         return response()->json('success',200);
        
        
    }
    
     public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
