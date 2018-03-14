<?php

namespace App\Http\Controllers\JobseekerAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Socialite;

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


    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider_marketer($provider)
    {
        return Socialite::with($provider)->redirectUrl(env('FACEBOOK_REDIRECT_URL_2'))->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback_marketer($provider)
    {
        try {
            $user = Socialite::driver($provider)->redirectUrl(env('FACEBOOK_REDIRECT_URL_2'))->user();
            // vv($user);
            $authUser = $this->findOrCreateUser($user, $provider);
            if($authUser == 'no_email_found'){
                return redirect('jobseeker_register')->with('alert', 'Email not found try again later or use another platform');
            }
            Auth::guard('jobseeker')->login($authUser, true);

            // vv(Auth::guard('jobseeker')->user()->last_name);
            if(empty(Auth::guard('jobseeker')->user()->last_name)){
                return redirect('update_profile_login_with_social')->with('status', 'Register Successfully, Now Update Your profile');
            }else{
                return redirect($this->redirectTo);
            }
        } catch (Exception $e) {
            return redirect('jobseeker_register')->with('alert', 'Something Wrong try again');
        }
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = \App\Admin::where('provider_id', $user->id)->orwhere('email',$user->email)->first();
        if ($authUser) {
            return $authUser;
        }
        if(empty($user->email)){
            return "no_email_found";
        }
        $password_variable = 'marketer2';
        $user_created = \App\Admin::create([

            'first_name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'last_name'           => '',
            'profile_picture'     => $user->avatar_original,
            'phone_number'        => '',
            'country'             => 0,
            'verified'          => 1,
            'password'          => bcrypt($password_variable),
        ]);

        \Mail::send('email.welcome_email', ['user' => $user_created , 'password_variable' => $password_variable], function ($m) use ($user_created) {
            $m->to($user_created->email, $user_created->first_name)->subject('You have New massage!');
        });
        return $user_created;
    }
}
