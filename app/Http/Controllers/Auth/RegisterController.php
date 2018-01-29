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
use App\User_roles_hashtags;
use App\Preferred_medium;
use App\User_preferred_medium;
use App\User_portfolio;
use App\Country;
use Illuminate\Support\Facades\Input;
use App\User_previously_campaign;

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
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required',
            'country' => 'required|numeric',
            'title' => 'required',
            'hashtags' => 'required',
            'preferred_medium' => 'required',
            'country' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // vv("ppp");
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $image_name = "";
        foreach ($data as $key => $value) {
            if(empty($value)){
                $data[$key] = ""; 
            }
        }
        // v('ads');
        // $data['file']->move('users',$data['file']->getClientOriginalName());
        // if(Input::hasFile($data['file'])){
        if($data['file']){
            echo 'Uploaded';
            // $file = Input::file($data['file']);
            $file = $data['file'];
            $file->move('uploads', $file->getClientOriginalName());
            echo '';
            $image_name = $file->getClientOriginalName();
        }
        // die;
        // vv($data);
        $user = User::create([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'profile_picture'     => $image_name,
            'user_role'           => 'influencer',
            'email'               => $data['email'],
            'phone_number'        => $data['phone_number'],
            'country'             => $data['country'],
            'title'               => $data['title'],
            'faebook_url'         => $data['faebook_url'],
            'instagram_url'       => $data['instagram_url'],
            'youtube_url'         => $data['youtube_url'],
            'twitter_url'         => $data['twitter_url'],
            'soundcloud_url'      => $data['soundcloud_url'],
            'website_blog'        => $data['website_blog'],
            'monthly_visitors'    => $data['monthly_visitors'],
            'company_id' => 1,
            'company_name'      => 'no',
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
                if(empty($value) && empty($link_var[$key])){
                }else{
                    User_portfolio::create([
                        'user_id'       => $user->id,
                        'link'          => $link_var[$key],
                        'description'   => $value,
                    ]);
                }  
            }  
        }

        if(!empty($data['client'])){
            $link_var = $data['link'];        
            $details_var = $data['details'];        
            foreach ($data['client'] as $key => $value) {  
                if(empty($value)){
                    $value = "";
                    if(empty($link_var[$key])){
                        $link_var[$key] = "";
                    }
                    if(empty($details_var[$key])){
                        $details_var[$key] = "";
                    }
                }  
                if(empty($value) && empty($link_var[$key]) && empty($details_var[$key]) ){
                }else{
                    User_previously_campaign::create([
                        'user_id'       => $user->id,
                        'client'        => $value,
                        'link'          => $link_var[$key],
                        'details'       => $details_var[$key],
                    ]);
                }  
            }  
        }

        foreach ($data['preferred_medium'] as $key => $value) {    
            User_preferred_medium::create([
                'user_id'       => $user->id,
                'preferred_medium_id'   => $value,
            ]);
        }  
        $hashtags_var = $data['hashtags'];
        $hashtags_var = explode("#", $hashtags_var);
        $hashtags_var = array_filter($hashtags_var);
        $hashtags_var = str_replace(' ', '', $hashtags_var);
        foreach ($hashtags_var as $key => $value) {
            # code...
            $checking_exist = Hashtags::where('tags' , $value)->get();
            if($checking_exist->isEmpty()){
                // v($checking_exist);
                Hashtags::create([
                    'tags' => $value,
                    ]);
            }
        }

        foreach ($hashtags_var as $key => $value) {
            $checking_exist = Hashtags::where('tags' , $value)->first();    
            User_roles_hashtags::create([
                'user_id'       => $user->id,
                'hashtags_id'   => $checking_exist->id,
            ]);
        }  
        return $user;
    }

    public function showRegistrationForm()
    {
        // $hashtags = Hashtags::get();
        $preferred_medium_value = Preferred_medium::get();
        $country1 = Country::orderBy('id' , 'asc')->get();

        // return view('auth.register' , compact('hashtags' , 'preferred_medium' , 'country'));
        return view('auth.register' , compact( 'preferred_medium_value' , 'country1'));
    }

    public function register(Request $request)
    {   
        // vv($request->all());
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        UserVerification::generate($user);
        UserVerification::send($user, 'Account varification Email');
        return back()->withAlert('Register successfully, please verify your email.');
    }
}