<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Socialite;

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
    protected $redirectTo = '/';

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
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        // vv("asd");
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // vv($user);
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->orwhere('email',$user->email)->first();
        if ($authUser) {
            return $authUser;
        }
        $password_variable = 'influencer2';
        $user_created = User::create([
            'first_name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'last_name'           => '',
            'profile_picture'     => '',
            'user_role'           => 'influencer',
            'phone_number'        => '',
            'country'             => '',
            'title'               => '',
            'faebook_url'         => '',
            'instagram_url'       => '',
            'youtube_url'         => '',
            'twitter_url'         => '',
            'soundcloud_url'      => '',
            'website_blog'        => '',
            'monthly_visitors'    => '',
            'company_id'        => 1,
            'company_name'      => 'no',
            'password'          => bcrypt($password_variable),
        ]);

        \Mail::send('email.welcome_email', ['user' => $user_created , 'password_variable' => $password_variable], function ($m) use ($user_created) {
            $m->to($user_created->email, $user_created->first_name)->subject('You have New massage!');
        });
        return $user_created;
    }


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->verified != 1) {
            $errors = [$this->username() => trans('auth.notactivated')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
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
