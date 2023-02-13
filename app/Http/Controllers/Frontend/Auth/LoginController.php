<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        session(['url.intended' => url()->previous()]);

        return view('frontend.auth.login');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        session(['url.intended' => url()->previous()]);

        return view('frontend.auth.register');
    }

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
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request, User $user)
    {

        $user = User::find(Auth::id());


        $this->guard()->logout();


        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

        /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

        $user = User::find(Auth::id());



        if(!$user->status){
            Auth::logout();

            return redirect()->back()->with('notify','disabled');

        }


        if ($request->ajax()){

            return response()->json([
                'auth' => auth()->check(),
                'route' => route('customer.profile'),
            ]);

        } else return redirect()->route('view.cart');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $check = User::where('email', $user->email)->first();

        if ($check) {
            Auth::login($check);
            $this->authenticatedSocial();
            return redirect()->route('customer.profile');
        } else {
            $data = new User();
            $data->name = $user->name;
            $data->email = $user->email;
            $data->image = $user->avatar;
            $data->status = '1';
            $data->password= bcrypt(uniqid());
            $data->save();
            Auth::login($data);
            $this->authenticatedSocial();
            return redirect()->route('customer.profile');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try{
            $user = Socialite::driver('facebook')->user();
            // dd($user);
            if($user->email){
                $check = User::where('email', $user->email)->first();
            }else{
                $check = User::where('fb_id', $user->id)->first();
            }

            if ($check) {
                Auth::login($check);
                $this->authenticatedSocial();
                // return redirect()->intended($this->redirectPath());
                return redirect()->route('customer.profile');
            } else {

                    $data = new User();
                    $data->name = $user->name;
                    $data->email = $user->email;
                    $data->image = $user->avatar;
                    $data->password= bcrypt(uniqid());
                    $data->status = '1';
                    $data->save();
                    Auth::login($data);
                    $this->authenticatedSocial();


                return redirect()->route('customer.profile');
            }
        }catch(Exception $e){

            return redirect('/login')->with('error','Login Failed');
        }
    }

            // -----------------------------------------------------------
        /**
         * The user has been authenticated by soicialite
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  mixed  $user
         * @return mixed
         */
        protected function authenticatedSocial()
        {
            $user = User::where('id', Auth::id())->first();
            $user->save();
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

                        : null;
        }


}
