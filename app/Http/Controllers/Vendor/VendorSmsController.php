<?php

namespace App\Http\Controllers\Vendor;

use App\Events\OrderCompleteEvent;
use App\Events\VendorSignupEvent;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Vendor;
use App\Notifications\VendorSignupNotification;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Nexmo\Laravel\Facade\Nexmo;

class VendorSmsController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:11', 'unique:vendors'],
            'email' => ['required', 'email', 'unique:vendors'],
            'shop_name' => ['required', 'unique:vendors'],
            'address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return response([
                'error' => [
                    'message' => 'Validation error!',
                    'name' => $validator->errors()->get('name'),
                    'phone' => $validator->errors()->get('phone'),
                    'email' => $validator->errors()->get('email'),
                    'shop_name' => $validator->errors()->get('shop_name'),
                    'address' => $validator->errors()->get('address'),
                    'password' => $validator->errors()->get('password')
                ]
            ], 422);
        }
        // if another request within 1 min
        if ($freq_req = Cache::get($request->phone)) {
            return response(['error' => ['frequent_req' => $freq_req]], 500);
        }

        try {
            $code = (string)rand(1000, 9999);
            $phone = $request->phone;
            Cache::add($code, $phone, 120);  //cache for 2 minutes


            $token  = "7bc26225b80f23ed3ccacd70e62aae42";

            $mobile = $request->phone;
            $sms_content = 'Verification OTP from Hypershop. Your OTP is: ' . $code;
            $msg = urlencode($sms_content);

            $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
            $tweets =  $this->curl($feed);



            //  $token  = "7bc26225b80f23ed3ccacd70e62aae42";

            //     $mobile = '+88'.$request->phone;
            //     $sms_content = 'Verification OTP from Hypershop. Your OTP is: ' . $code;
            //     $msg=urlencode($sms_content);


            //     $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
            //     $tweets =  $this->curl($feed);



            Session::put([$phone => [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'shop_name' => $request->shop_name,
                'address' => $request->address,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ]]);
            Cache::add($request->phone, 'Please wait 60 sec for another request.', 60);

            $message = 'Verification OTP has been sent to your number';

            return response()->json(['response' => ['code_sent' => $message]], 200);
        } catch (Exception $e) {
            $message = 'Error sending verification code. Please try again.';
            return response()->json(['error' => ['sending_error' => $message]], 500);
        }

        //get the code without sending sms
        /*** please remove the $code from below $message ***/

        $message = 'Verification OTP has been sent to your number. Please verifiy.';

        return response()->json(['response' => ['code_sent' => $message]], 200);
    }

    public function verifyOtp(Request $request)
    {

        try {
            $phone = Cache::get($request->code);
            if ($phone == null) {
                $error_message = "Verification code does not match or expired!";
                return response()->json(['error' => [
                    'code_invalid' => $error_message,
                ]], 422);
            }

            $vendor = Session::pull($phone);
        } catch (Exception $e) {
            $error_message = "Verification code does not match or expired!";
            return response()->json(['error' => ['code_invalid' => $error_message,]], 422);
        }

        try {
            // save user into db
            // $new_user = new User();
            // $new_user->name = $user['name'];
            // $new_user->phone = $user['phone'];
            // $new_user->password = bcrypt( $user['password'] );
            // $new_user->save();
            $new_vendor = Vendor::create([
                'name' => $vendor['name'],
                'phone' => $vendor['phone'],
                'email' => $vendor['email'],
                'shop_name' => $vendor['shop_name'],
                'address' => $vendor['address'],
                'password' => bcrypt($vendor['password'])
            ]);

            // send notification to all admins
            $admins = Admin::all();
            $note = DB::table('notifications')->latest()->first();
            $text = 'New Vendor created';
            Notification::send($admins, new VendorSignupNotification($new_vendor->name, $new_vendor->phone));
            //Real time notification by pusher
            $created_at = $note->created_at;
            $type = 'vendor';
            event(new VendorSignupEvent($new_vendor->name, $new_vendor->phone, $created_at, $text, $type, $note->id));
            $reg_successful = 'You have successfully registered.Please login';

            return response()->json(['response' => ['reg_successful' => $reg_successful]], 200);
        } catch (Exception $e) {
            // return redirect()->route('register')->with(['reg_error' => 'Registration Error.Please try agian.']);
            $reg_error = 'Registration Error.Please try agian.';
            return response()->json(['error' => ['reg_error' => $reg_error]], 500);
        }
    }

    // ===========================================================================================

    public function sendOtpForgotPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'digits:11']
        ]);
        if ($validator->fails()) {
            return response([
                'error' => [
                    'message' => 'Validation error!',
                    'phone' => $validator->errors()->get('phone')
                ]
            ], 422);
        }

        $vendor = Vendor::where('phone', $request->phone)->first();

        if ($vendor) {
            // if another request within 1 min
            if ($freq_req = Cache::get($request->phone)) {
                return response(['error' => ['frequent_req' => $freq_req]], 500);
            }

            try {
                $code = (string)rand(1000, 9999);
                $phone = $request->phone;
                Cache::add($code, $phone, 120);  //cache for 2 minutes

                $token  = "7bc26225b80f23ed3ccacd70e62aae42";

                $mobile = $request->phone;
                $sms_content = 'Forgot password OTP from Hypershop. Your OTP is: ' . $code;
                $msg = urlencode($sms_content);

                $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
                $tweets =  $this->curl($feed);

                Session::put([$phone => $request->phone]);
                Cache::add($request->phone, 'Please wait 60 sec for another request.', 60);

                $message = 'Verification OTP has been sent to your number';

                return response()->json(['response' => ['code_sent' => $message]], 200);
            } catch (Exception $e) {
                $message = 'Error sending verification code. Please try again.';
                return response(['error' => ['sending_error' => $message]], 500);
            }

            // get the code without sending sms
            // please remove the $code below $message
            $message = 'Verification OTP has been sent to your number. Please verifiy.';

            return response()->json(['response' => ['code_sent' => $message]], 200);
        }
        // if phone num is not found
        else {
            $message = 'Mobile number is not found!';
            return response(['error' => ['phone_invalid' => $message]], 422);
        }
    }

    public function verifyOtpForgotPass(Request $request)
    {
        try {
            $phone = Cache::get($request->code);
            if ($phone == null) {
                $error_message = "Verification code does not match or expired!";
                return response()->json(['error' => [
                    'code_invalid' => $error_message,
                ]], 422);
            }

            $phone = Session::get($phone);
        } catch (Exception $e) {
            $error_message = "Verification code does not match or expired!";
            return response()->json(['error' => ['code_invalid' => $error_message,]], 422);
        }

        $uniqid = uniqid();
        Session::put([$uniqid => $phone]);

        return response()->json(['response' => ['uniqid' => $uniqid]], 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return response(['error' =>
            [
                'message' => 'Validation error!',
                'password' => $validator->errors()->get('password')
            ]], 422);
        }

        $phone = Session::get($request->uniqid);
        $vendor = Vendor::where('phone', $phone)->first();

        if ($vendor) {
            $vendor->password = bcrypt($request->password);
            $vendor->save();
            return response()->json(['response' => ['reset_successful' => 'Your password reset done! Please Login.']], 201);
        } else {
            $message = 'Mobile number is not found!';
            return response(['error' => ['phone_invalid' => $message]], 422);
        }
    }

    public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
