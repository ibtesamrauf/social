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
use App\Roles_hashtags;

class RegisterController extends Controller
{
    protected $redirectTo = 'jobseeker_home';
    
    //shows registration form to jobseeker
    public function showRegistrationForm()
    {
        $hashtags = Hashtags::get();
        return view('auth.register_2' , compact('hashtags'));
    }
    
    public function register(Request $request)
    {
        // vv($request);
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
        
       // $jobseeker = new Jobseeker($request->all());
        
        // $jobseeker = $user->jobseeker()->create($request->all());
        
        // Authenticates seller
        $this->guard()->login($user);
        
        // Event::fire(new JobSeekerSignup($jobseeker));
        
       //Redirects 
        return redirect($this->redirectTo);
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
