<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
// use SammyK;
use App\User_videos;
use Auth;
use App\User_page;
use Ixudra\Curl\Facades\Curl;
use Facebook\Facebook;
use App\Facebook_page_data;
use App\Youtube_page_data;
use App\Instagram_page_data;
use App\Hashtags;
use App\Country;
use App\Marketer_previously_campaign;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use Illuminate\Support\Facades\Input;

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
    

    public function editprofile_marketer()
    {        
        $country = Country::pluck('country_name', 'id');
        return view('editprofile_marketer_test' , compact('country'));
    }

    public function editprofile_marketer_post(Request $request)
    {
        $image_name = "";
        // vv($request->all());
        Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'country' => 'required',
        ])->validate();

        if(array_key_exists("file",$request->all()) ){
            echo 'Uploaded';
            // $file = Input::file($request->file);
            $file = $request->file;
            $file->move('uploads', time().$file->getClientOriginalName());
            echo '';
            $image_name = time().$file->getClientOriginalName();
            Admin::where('id' , Auth::guard('jobseeker')->user()->id)->update([
                    'profile_picture' => $image_name,
                ]);
        }

        Admin::where('id' , Auth::guard('jobseeker')->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'country' => $request->country,
            ]);
        return redirect('viewprofile_marketer')->with('status', 'Profile Updated!');
    } 

    public function delete_previous_campaign_marketer($previous_campaign_id)
    {
        Marketer_previously_campaign::where('id' , $previous_campaign_id)->delete();
        return redirect('editprofile_marketer')->with('status', 'previous campaign Deleted!');
    } 

    public function edit_previous_campaign_marketer($previous_campaign_id)
    {
        $data = Marketer_previously_campaign::where('id' , $previous_campaign_id)->first();
        return view('edit_previous_campaign_marketer' ,compact('data'));
    } 

    public function edit_previous_campaign_update_marketer($id,Request $request)
    {
        Validator::make($request->all(), [
            'influencer_used' => 'required',
            'campaign_link'  => 'required',
            'description' => 'required',
        ])->validate();
        Marketer_previously_campaign::where('id' , $id)->update([
                'influencer_used' => $request->influencer_used,
                'campaign_link' => $request->campaign_link,
                'description' => $request->description,
            ]);
        return redirect('editprofile_marketer')->with('status', 'previous campaign Updated!');
    } 

    
    
}