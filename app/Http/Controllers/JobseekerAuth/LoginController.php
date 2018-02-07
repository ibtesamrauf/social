<?php

namespace App\Http\Controllers\JobseekerAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    protected $redirectTo = '/finde_influencer_test';
    
    public function __construct()
    {
        $this->middleware('guest')->except('jobseeker');
    }

    use AuthenticatesUsers;
    
    //Custom guard for jobeeker
    protected function guard()
    {
      return Auth::guard('jobseeker');
    }

   
    //Shows jobseeker login form
    public function showLoginForm()
    {
       return view('auth.login_2');
    }
    
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $user = \App\Admin::where('email',$request->email)->first();
        // vv($user);
        if(!empty($user)){
            // if($user->user_role == 'jobseeker' && Hash::check($request->password, $user->password)){
            if(Hash::check($request->password, $user->password)){
                    return TRUE;

            }
        }
        return FALSE;
    }
    
    
    public function login(Request $request)
    { 
        if (!$this->validateLogin($request)){
            return $this->sendFailedLoginResponse($request);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        
        return $this->sendFailedLoginResponse($request);
    }
    
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors)->with('jobseeker_login',TRUE);
    }
    
    public function loginUsingId($id) {
        
       return ($this->guard()->loginUsingId($id)) ? true : false;
       
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate() {
        if ( Auth::attempt( ['email' => $email, 'password' => $password, 'verified' => 1] ) ) {
            // Authentication passed...
            return redirect()->intended( '/' );
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // var_dump($request);
        // die;
        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
            'verified' => '1',
        ];
    }
}
