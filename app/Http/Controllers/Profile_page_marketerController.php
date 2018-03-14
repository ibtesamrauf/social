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
use App\Marketer_company;
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
        $image_name_logo = "";
        // vv($request->all());
        Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'country' => 'required',
            'company_name' => 'required',
            'website' => 'required',
            'description' => 'required',
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

        if(array_key_exists("logo",$request->all()) ){
            echo 'Uploaded';
            // $file = Input::file($request->file);
            $file = $request->logo;
            $file->move('uploads', time().$file->getClientOriginalName());
            echo '';
            $image_name_logo = time().$file->getClientOriginalName();
            Marketer_company::where('user_id' , Auth::guard('jobseeker')->user()->id)->update([
                'logo' => $image_name_logo,
            ]);
        }

        Marketer_company::where('user_id' , Auth::guard('jobseeker')->user()->id)->update([
                'company_name' => $request->company_name,
                'website' => $request->website,
                'description' => $request->description,
            ]);

        Admin::where('id' , Auth::guard('jobseeker')->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'country' => $request->country,
            ]);

        if(!empty($request->previously_campaign_client)){
            $link_var = $request->previously_campaign_link;        
            $details_var = $request->previously_campaign_details;        
            foreach ($request->previously_campaign_client as $key => $value) {  
                if(empty($value)){
                    $value = "";
                }  
                if(empty($details_var[$key])){
                    $details_var[$key] = "";
                }
                if(empty($link_var[$key])){
                    $link_var[$key] = "";
                }
                if(empty($value) && empty($link_var[$key]) && empty($details_var[$key]) ){
                }else{
                    Marketer_previously_campaign::create([
                        'user_id'       => Auth::guard('jobseeker')->user()->id,
                        'influencer_used'        => $value,
                        'campaign_link'          => $link_var[$key],
                        'description'       => $details_var[$key],
                    ]);
                }  
            }  
        }
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


    public function update_profile_login_with_social_marketer()
    {
        $user = Admin::findOrFail(Auth::guard('jobseeker')->user()->id);
        $country1 = Country::orderBy('id' , 'asc')->get();
        return view('update_profile_login_with_social_marketer' , compact('country1' , 'user'));
    }

    public function update_profile_login_with_social_marketer_post(Request $request)
    {
        $image_name = "";
        // vv($request->all());
        //Validates data       
        Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone_number'  => 'required',
            'country'       => 'required|not_in:Select',
            'password'      => 'required|string|min:6|confirmed',
        ])->validate();

        //Create seller
        $user = Admin::where('id', Auth::guard('jobseeker')->user()->id)->update([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'phone_number'      => $request->phone_number,
            'country'           => $request->country,
            'password'          => bcrypt($request->password),
            'profile_picture'   => "",
        ]);
        // Agency / Company details
        if(!empty($request->company_name) || !empty($request->website) || !empty($request->facebook_url) 
            || !empty($request->description ))
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
                    'user_id'           => Auth::guard('jobseeker')->user()->id,
                    'company_name'      => $request->company_name,
                    'logo'              => $image_name,
                    'website'           => $request->website,
                    'facebook_url'      => $request->facebook_url,
                    'description'       => $request->description,
                ]);
        }

        if(!empty($request->influencer_used)){
            $link_var = $request->campaign_link;       
            $details_var = $request->description_p;       
            foreach ($request->influencer_used as $key => $value) {  
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
                    // vv($link_var[$key]);
                    Marketer_previously_campaign::create([
                        'user_id'               => Auth::guard('jobseeker')->user()->id,
                        'influencer_used'       => $value,
                        'campaign_link'         => $link_var[$key],
                        'description'           => $details_var[$key],
                    ]);
                }  
            }  
        }
        return redirect('viewprofile_marketer')->with('alert', 'Profile updated Successfully!');
    }
    
    

    
    
}