<?php

namespace App\Http\Controllers\JobseekerAuth;

use Illuminate\Http\Request;
use App\Jobseeker;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Event;
use App\Events\JobSeekerSignup;
use App\Hashtags;
use App\User_roles_hashtags;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Country;

class RegisterController extends Controller
{
    use VerifiesUsers;

    protected $redirectTo = 'findinfulencer';
    
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
        vv($request->all());
        //Validates data
        $this->validator($request->all())->validate();
        
       //Create seller
        $user = User::create([
            'name'          => $request->name,
            'user_role'     => 'jobseeker',
            'company_name'  => $request->company_name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password)
        ]);
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
                'name'          => 'required',
                'company_name'  => 'required',
                'email'         => 'required|email|unique:users',
                'password'      => 'required|string|min:6|confirmed',
            ]);
    }
    
    //Get the guard to authenticate Jobseeker
    protected function guard()
    {
        return Auth::guard('jobseeker');
    }
}
