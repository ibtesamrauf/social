<?php

namespace App\Http\Controllers\Jobseeker;

use Illuminate\Http\Request;
use App\Jobseeker;
use App\JobseekerLicenses;
use App\User;
use App\Jobs;
use App\JobsLicenseRequired;
use App\Licenses;
use App\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
 use App\SentEmail;
use App\Http\Controllers\JobseekerAuth\LoginController;
 
class JobseekerController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function viewJob($token){
        $token_detail = SentEmail::where('token',$token)->first();
        
        if(count($token_detail)){
               
            $jobseeker = Jobseeker::find($token_detail->jobseeker_id);
            if($jobseeker!=null){
                //$method = 'POST';
                //$path = 'jobseeker_login';
                //$data = array('email' =>$jobseeker->email,'password'=>'jameel');
                
               // $request = Request::create($path, $method, $data);
                $LoginAuth = new LoginController();
                //$LoginAuth->login($request);
                 
                if($LoginAuth->loginUsingId($jobseeker->id)){
                    return redirect('/jobseeker_home');
                }else{
                    Session::flash('errMsg','Sorry, unable to login');
                    return redirect('/');
                }
            } else
                {   Session::flash('errMsg','Your login details are not in our database');
                    return redirect('/');
                }  
            
        }else{
            Session::flash('errMsg','Invalid Link');  
            return redirect('/');
        }
    }
 
 
    public function home() {
    	return Jobseeker::getHome();
    }

    public function search() {
    	return view('frontend.jobseeker.search');
    }

    public function jobpage($job_id) {
        
    	$job = Jobs::find($job_id);
//        $job->employer;
        $loginAuth = isset(Auth::guard('jobseeker')->user()->id) ? Auth::guard('employer')->user()->id :0;
    	
        return view('frontend.jobseeker.jobpage', compact('job','loginAuth'));
    }
    
    public function applyJob( $job_id){
        return Jobseeker::applyJob($job_id);
    }
    
    public function saveJob( $job_id){
        return Jobseeker::saveJob($job_id);
    }

    public function submitCV(Request $request){
        return Jobseeker::enterCvDetails($request);
    }

    public function map() {
    	return view('frontend.jobseeker.map');
    }  
    
    public function deleteLicense($license_id){
        return Jobseeker::deleteLicense($license_id);
    }
        
}
 
 
