<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Model\Vendor;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VendorLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/vendor/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:vendor')->except('logout');
    }
    // guard
    protected function guard()
    {
        return Auth::guard('vendor');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('vendor.auth.login');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    // public function showRegisterForm()
    // {
    //     session(['url.intended' => url()->previous()]);

    //     return view('vendor.auth.register');
    // }

        /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|min:8|string',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // update user->status to 0 just before logout
        $vendor = Vendor::find(Auth::id());
       
        $vendor->save();

        $this->guard()->logout();

        /***  to prevent admin/user logout to logout both admin and user at the same time ***/
        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect( route('vendor.login'));
    }

        /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $vendor
     * @return mixed
     */
    protected function authenticated(Request $request)
    {
        // update user->status to 1 after login
        $phone = $request->input('phone');
        $vendor = Vendor::where('phone',$phone)->first();
        
        $vendor->save();


        if ($request->ajax()){

            return response()->json([
                'auth' => auth()->check(),
                'vendor' => $vendor,
            ]);

        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {

        // throw ValidationException::withMessages([
        //     $this->username() => [trans('auth.failed')],
        // ]);

        $errors = [$this->username() => trans('auth.failed')];

        $user = Vendor::where('phone', $request->{$this->username()})->first();

        if(!empty($user)){

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if (Hash::check($request->password, $user->password) == false) {

            session()->flash('pass','Credentials does not match');

            $errors = [$this->username() => trans('auth.passError')];
        }
        else if ($user->status != 1) {

            session()->flash('activeerr','Your Account have not activated yet. A Confirmation mail will be sent to you!');
            $errors = [$this->username() => trans('auth.activationError')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
    }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    
    
     protected function credentials(Request $request)
    {
        return ['phone'=>$request->{$this->username()}, 'password'=>$request->password,'s_status'=>'1'];
    }


}
