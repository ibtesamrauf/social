<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Http\Request;
use App\Hashtags;
use App\Roles_hashtags;
use App\Preferred_medium;
use App\User_preferred_medium;
use App\User_portfolio;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest',['except' => ['getVerification', 'getVerificationError']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'hashtags' => 'required',
            'preferred_medium' => 'required',
            'phone_number' => 'required|numeric',
            'countery' => 'required',
            'title' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        foreach ($data as $key => $value) {
            if(empty($value)){
                $data[$key] = ""; 
            }
        }
        // vv($data);
        $user = User::create([
            'name'              => $data['name'],
            'user_role'         => 'influencer',
            'phone_number'      => $data['phone_number'],
            'countery'          => $data['countery'],
            'title'             => $data['title'],

            'faebook_url'         => $data['faebook_url'],
            'instagram_url'       => $data['instagram_url'],
            'youtube_url'         => $data['youtube_url'],
            'twitter_url'         => $data['twitter_url'],
            'soundcloud_url'      => $data['soundcloud_url'],
            'website_blog'        => $data['website_blog'],
            'monthly_visitors'    => $data['monthly_visitors'],
            
            'company_name'      => 'no',
            'email'             => $data['email'],
            'password'          => bcrypt($data['password']),
        ]);

        
        if(!empty($data['description'])){
            $link_var = $data['link_p'];        
            foreach ($data['description'] as $key => $value) {  
                if(empty($value)){
                    $value = "";
                    if(empty($link_var[$key])){
                        $link_var[$key] = "";
                    }
                }  
                User_portfolio::create([
                    'user_id'       => $user->id,
                    'link'          => $link_var[$key],
                    'description'   => $value,
                ]);
            }  
        }

        foreach ($data['preferred_medium'] as $key => $value) {    
            User_preferred_medium::create([
                'user_id'       => $user->id,
                'preferred_medium_id'   => $value,
            ]);
        }  
        
        foreach ($data['hashtags'] as $key => $value) {    
            Roles_hashtags::create([
                'user_id'       => $user->id,
                'hashtags_id'   => $value,
            ]);
        }  
        return $user;
    }

    public function showRegistrationForm()
    {
        $hashtags = Hashtags::get();
        $preferred_medium = Preferred_medium::get();
        
        return view('auth.register' , compact('hashtags' , 'preferred_medium'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        UserVerification::generate($user);
        UserVerification::send($user, 'Account varification Email');
        return back()->withAlert('Register successfully, please verify your email.');
    }
}