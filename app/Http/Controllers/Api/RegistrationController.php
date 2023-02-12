<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {
        $rules = [
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:8|confirmed',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        
        
            $code = (string) rand(1000,9999);
            $phone = $request->phone;

        $user =  User::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'code' => $code,
            'status' => 0
        ]);
        
        
            
            $token  = "7bc26225b80f23ed3ccacd70e62aae42";
            $mobile = $request->phone;
            $sms_content = 'Verification OTP from Hypershop. Your OTP is: ' . $code;
            $msg=urlencode($sms_content);


            $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
            $tweets =  $this->curl($feed);
            
           

        return response()->json(['user'=>$user, 'signature' => $request->signature],200);
    }
    
    public function sendAgain(Request $request){
        $user = User::where('phone', $request->phone)->first();
        
        if(!$user){
            return response()->json(['error'=> 'user not found'], 404);
        }
        $code = (string) rand(1000,9999);
            $phone = $request->phone;
        
         $user->code = $code;
        $user->save();
        
        
        $token  = "7bc26225b80f23ed3ccacd70e62aae42";
            $mobile = $request->phone;
            $sms_content = 'Verification OTP from Hypershop. Your OTP is: ' . $code;
            $msg=urlencode($sms_content);


        $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
            $tweets =  $this->curl($feed);
          return response()->json(['user'=>$user, 'signature' => $request->signature],200);
        
        
    }
    
    public function verifyOtp(Request $request){
        $user = User::where('phone', $request->phone)->first();
        
     
        
        if(!$user){
            return response()->json(['error'=> 'user not found'], 404);
        }
        
        if($user->code == null && $user->code != $request->code){
            return response()->json(['error'=> 'Invalid Otp Code'], 404);
        }
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        
        $user->code = null;
        $user->status = 1;
        $user->save();
        
        
       return response()->json(['user'=>$user, 'token' => $token],200);
        
        
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
