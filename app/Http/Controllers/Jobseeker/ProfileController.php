<?php

namespace App\Http\Controllers\Jobseeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Jobseeker;

class ProfileController extends Controller
{
   
    protected static $current_user;
    
    public function __construct() {        
    }

        public function getProfile(){
            
            $jobseeker = Jobseeker::getProfile( Auth::guard('jobseeker')->user() );
            return view('frontend.jobseeker.home')->with('jobseeker' ,$jobseeker);
        }
        
        public function submitCV(Request $request){
            echo "***** in cv submit ****</br>";
            var_dump($request->all());
            die;
        }
}
