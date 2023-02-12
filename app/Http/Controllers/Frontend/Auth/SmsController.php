<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\OrderCompleteEvent;
use App\Events\UserSignupEvent;
use App\Events\VendorSignupEvent;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Notifications\OrderNotification;
use App\Notifications\UserSignupNotification;
use App\Notifications\VendorSignupNotification;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
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
        'phone' => ['required','digits:11', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()){
            return response([
                'error' => ['message' => 'Validation error!',
                            'name' => $validator->errors()->get('name'),
                            'phone' => $validator->errors()->get('phone'),
                            'password' => $validator->errors()->get('password')]
            ], 422);
        }
        // if another request within 1 min
        if($freq_req = Cache::get($request->phone)){
            return response([ 'error' => ['frequent_req' => $freq_req]], 500);
        }

        try{
            $code = (string)rand(1000,9999);
            $phone = '+88'.$request->phone;
            Cache::add($code, $phone, 120);  //cache for 2 minutes
            
            $token  = "7bc26225b80f23ed3ccacd70e62aae42";
            $mobile = $request->phone;
            $sms_content = 'Verification OTP from Hypershop. Your OTP is: ' . $code;
            $msg=urlencode($sms_content);


            $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
            $tweets =  $this->curl($feed);
           

            Session::put([$phone => [
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ]]);
            
            Cache::add($request->phone,'Please wait 60 sec for another request.',60);
            $message = 'Verification code has been sent to your number';
            return response()->json(['response' => ['code_sent' => $message]], 200);

        } catch(Exception $e){
            $message = 'Error sending verification code. Please try again.';
            return response()->json([ 'error' => [ 'sending_error' => $message]], 500);
        }

        //get the code without sending sms
        /*** please remove the $code from below $message ***/

        $message = 'Verification OTP has been sent to your number. Please verifiy.'. $code;

        return response()->json(['response' => ['code_sent' => $message]], 200);
    }

    public function verifyOtp(Request $request)
    {

        try{
            $phone = Cache::get($request->code);
            if($phone == null){
                $error_message = "Verification code does not match or expired!";
                return response()->json([ 'error' => [ 'code_invalid' => $error_message,
                ]], 422);
            }

            $user = Session::pull($phone);
        

        } catch(Exception $e){
            $error_message = "Verification code does not match or expired!";
            return response()->json([ 'error' => [ 'code_invalid' => $error_message,]], 422);
        }

        try{
             // save user into db
 
            $new_user = User::create([
                'name' => $user['name'],
                'phone' => $user['phone'],
                'password' => bcrypt( $user['password'])
            ]);

            // send notification to all admins
            $admins = Admin::all();
            $text = 'New user created';
            Notification::send( $admins,new UserSignupNotification( $new_user->name, $new_user->phone));
            $note = DB::table('notifications')->latest()->first();
            //Real time notification by pusher
            $created_at = $note->created_at;
            $type = 'user';
            event(new UserSignupEvent($new_user->name,$created_at,$text,$type,$note->id));

            $reg_successful = 'You have successfully registered.Please login';
            try{
                Auth::login($new_user);
                // update user->status to 1 after login
                $user = User::find(Auth::id());
                $user->status = '1';
                $user->save();
            }catch(Exception $e){
                return response()->json(['response' => ['reg_successful' => $reg_successful]], 200);
            }

            // $intended = session::pull('url.intended');
            // return response()->json(['response' => ['intended' => $intended]], 200);

            return response()->json(['response' => ['route' => route('customer.profile')]], 200);

        } catch(Exception $e){
            // return redirect()->route('register')->with(['reg_error' => 'Registration Error.Please try agian.']);
            $reg_error = 'Registration Error.Please try agian.';
            return response()->json([ 'error' => ['reg_error' => $reg_error]], 500);

        }


    }

    // ===========================================================================================

    public function sendOtpForgotPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'digits:11']
        ]);
        if($validator->fails()){
            return response(['error' => ['message' => 'Validation error!',
                            'phone' => $validator->errors()->get('phone')]
            ], 422);
        }

        $user = User::where('phone', $request->phone)->first();

        if($user){
            // if another request within 1 min
            if($freq_req = Cache::get($request->phone)){
                return response([ 'error' => ['frequent_req' => $freq_req]], 500);
            }

            try{
                $code = (string)rand(1000,9999);
                $phone = '+88'.$request->phone;
                Cache::add($code, $phone, 120);  //cache for 2 minutes
              
                $token  = "7bc26225b80f23ed3ccacd70e62aae42";
                
                $mobile = $request->phone;
                $sms_content = 'Forgot Password OTP from Hypershop. Your OTP is: ' . $code;
                $msg=urlencode($sms_content);

                $feed = "https://smsapi.bindulogic.com/send-sms?token=$token&to=$mobile&message=$msg";
                $tweets =  $this->curl($feed);
                
                

                Session::put([$phone => $request->phone]);
                Cache::add($request->phone,'Please wait 60 sec for another request.',60);
                
                $message = 'Verification code has been sent to your number';

                return response()->json(['response' => ['code_sent' => $message]], 200);

            } catch(Exception $e){
                $message = 'Error sending verification code. Please try again.';
                return response([ 'error' => ['sending_error' => $message]], 500);
            }

            // get the code without sending sms
            // please remove the $code below $message
            $message = 'Verification code has been sent to your number. Please verifiy.';

            return response()->json(['response' => ['code_sent' => $message]], 200);

        }
        // if phone num is not found
        else {
            $message = 'Mobile number is not found!';
            return response( ['error' => ['phone_invalid' => $message]], 422);
        }
    }

    public function verifyOtpForgotPass(Request $request)
    {
        try{
            $phone = Cache::get($request->code);
            if($phone == null){
                $error_message = "Verification code does not match or expired!";
                return response()->json([ 'error' => [ 'code_invalid' => $error_message,
                ]], 422);
            }

            $phone = Session::get($phone);

        } catch(Exception $e){
            $error_message = "Verification code does not match or expired!";
            return response()->json([ 'error' => [ 'code_invalid' => $error_message,]], 422);
        }

        $uniqid = uniqid();
        Session::put([$uniqid => $phone]);

        return response()->json(['response' => ['uniqid' => $uniqid]], 200);
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        if($validator->fails()){
            return response(['error' =>
                ['message' => 'Validation error!',
                'password' => $validator->errors()->get('password')
            ]], 422);
        }

        $phone = Session::get($request->uniqid);
        $user = User::where('phone', $phone)->first();

        if($user){
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json([ 'response' => ['reset_successful' => 'Your password reset done! Please Login.']], 201);

        } else{
            $message = 'Mobile number is not found!';
            return response( ['error' => ['phone_invalid' => $message]], 422);
        }

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
