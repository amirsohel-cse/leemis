<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;   

    protected $redirectTo = '/admin/dashboard';

    public function showLoginForm()
    {
      return view('admin.auth.login');
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request)
    {
        // update user->status to 1 after login
        $email =$request->input('email');
        $admin = Admin::where('email',$email)->first();
        $admin->status = '1';
        $admin->save();
    }

    public function logout(Request $request, Admin $admin)
    {
        // update user->status to 0 just before logout
        $admin = Admin::find(Auth::id());
        $admin->status = '0';
        $admin->save();

        $this->guard()->logout(); 

        /*** to prevent admin/user logout to logout both admin and user at the same time ***/
        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin/login');
    } 
 /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->route('admin.dashboard');

    }

}