<?php

namespace App\Http\Controllers\JobseekerAuth;

use Illuminate\Http\Request;
use App\Jobseeker;
use App\User;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Event;
use App\Events\JobSeekerSignup;
use App\Hashtags;
use App\Marketer_company;
use App\User_roles_hashtags;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Country;
use Illuminate\Validation\Rule;


class RegisterController extends Controller
{
    use VerifiesUsers;

    protected $redirectTo = '/';
    
    public function __construct()
    {
        $this->middleware('guest',['except' => ['getVerification', 'getVerificationError']]);
    }

    //shows registration form to jobseeker
    public function showRegistrationForm()
    {
        $hashtags = Hashtags::get();
        $country = Country::orderBy('id' , 'asc')->get();

        return view('auth.register_2' , compact('hashtags' , 'country'));
    }
    
    public function register(Request $request)
    {
        $image_name = "";
        // vv($request->all());
        //Validates data
        $this->validator($request->all())->validate();

        //Create seller
        $user = Admin::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
            'country'       => $request->country,
            'password'      => bcrypt($request->password),

            // 'user_role'           => 'maketer',


            // 'profile_picture'     => "",
            // 'title'               => "",
            // 'faebook_url'         => "",
            // 'instagram_url'       => "",
            // 'youtube_url'         => "",
            // 'twitter_url'         => "",
            // 'soundcloud_url'      => "",
            // 'website_blog'        => "",
            // 'monthly_visitors'    => "",
            // 'company_id'          => 1,
            // 'company_name'          => 'no',

        ]);
        // Agency / Company details
        if(!empty($request->company_name) || !empty($request->website) || !empty($request->facebook_url) 
            || !empty($request->twitter_url) || !empty($request->description ))
        {
            if($request->logo){
                echo 'Uploaded';
                // $file = Input::file($data['file']);
                $file = $request->logo;
                $file->move('uploads', time().$file->getClientOriginalName());
                echo '';
                $image_name = time().$file->getClientOriginalName();
            }

            Marketer_company::create([
                    'user_id'           => $user->id,
                    'company_name'      => $request->company_name,
                    'logo'              => $image_name,
                    'website'           => $request->website,
                    'facebook_url'      => $request->facebook_url,
                    'twitter_url'       => $request->twitter_url,
                    'description'       => $request->description,
                ]);
            
            
            // vv("pass");
        }
        // vv("fail");


        UserVerification::generate($user);
        UserVerification::send($user, 'Account varification Email');
        return back()->withAlert('Register successfully, please verify your email.');


       // // $jobseeker = new Jobseeker($request->all());
        
       //  // $jobseeker = $user->jobseeker()->create($request->all());
        
       //  // Authenticates seller
       //  $this->guard()->login($user);
        
       //  // Event::fire(new JobSeekerSignup($jobseeker));
        
       // //Redirects 
       //  return redirect($this->redirectTo);
    }
    
    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    // Rule::unique('users')->where(function ($query) {
                    //         $query->where('user_role', 'maketer');
                    //     }),
                    // ],
                    'unique:admins',
                ],
                'phone_number'  => 'required',
                'country'       => 'required|not_in:Select',
                'password'      => 'required|string|min:6|confirmed',
            ]);
    }
    
    //Get the guard to authenticate Jobseeker
    protected function guard()
    {
        return Auth::guard('jobseeker');
    }
}
