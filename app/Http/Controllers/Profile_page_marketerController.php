<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\User_videos;
use Auth;
use App\User_page;
use Ixudra\Curl\Facades\Curl;
use Facebook\Facebook;
use App\Facebook_page_data;
use App\Youtube_page_data;
use App\Instagram_page_data;
use App\Hashtags;
// use SammyK;

class Profile_page_marketerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(['auth','isVerified']);
    }


    public function viewprofile_marketer()
    {
//        $facebook_page_data = Facebook_page_data::where('user_id' , Auth::user()->id)->get();
//        $youtube_page_data = Youtube_page_data::where('user_id' , Auth::user()->id)->get();
//        $instagram_page_data = Instagram_page_data::where('user_id' , Auth::user()->id)->get();
       
        

        // $c = Hashtags::get();
        // vv($c);
        // v($facebook_page_data);
        // vv(Auth::user()->Users_Roles_hashtags); 
        // vv(Auth::user()->Users_Roles_hashtags_names); 
         
//        //        return view('viewprofile' , compact('facebook_page_data' , 'youtube_page_data' , 'instagram_page_data' ));
        return view('viewprofile_marketer' );
    }
    
    
}