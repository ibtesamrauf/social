<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User_page;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User_videos;
use App\Facebook_page_data;
use App\Youtube_page_data;
use App\Instagram_page_data;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Socialite;


class Social_profile_integration extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        // $this->middleware('auth');
        ini_set('upload_max_filesize', '50M');
        ini_set('post_max_size', '50M');
    }

    public function index(Request $request)
    {
        $perPage = 15;    
        $device = User_page::where('user_id' , Auth::user()->id)->orderBy('id','DESC')->paginate($perPage);
      
        return view('facebook.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // vv("create");
        return view('facebook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'page_url'            => 'required',           
        ]);
        
        $facebook_url = explode("/", $request->page_url);
        if(empty(last($facebook_url))){
            unset($facebook_url[count($facebook_url) - 1]);
            $facebook_url = last($facebook_url);
        }else{
            $facebook_url = last($facebook_url);
        }
        // session(['facebook_url' => $facebook_url]);
        if (Session::has('facebook_url'))
        {
            Session::forget('facebook_url');
            Session::put('facebook_url', $facebook_url);
            Session::save();
        }
        // $page_already_exist = Facebook_page_data::where("keyword" , $facebook_url)->first();
        // if($page_already_exist){
        //     return back()->with('status', 'Page already exist');
        // }
        // vv($facebook_url);
        $fb = new \Facebook\Facebook([
            'app_id' =>  env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => env('FACEBOOK_APP_default_graph_version'),
        ]);

        $helper = $fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) 
        { 
            $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
        }
        $permissions = ['manage_pages', 'publish_pages',
                'ads_management','pages_messaging','pages_show_list','read_custom_friendlists',
                'user_friends','email','user_photos','user_likes','user_posts',
                'user_videos','user_birthday']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://influence-laravel-theme.com/facebook_page_facebook_call_back_page_add', $permissions);
        header("Location:".$loginUrl);
        die;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $facebook_page_data = Facebook_page_data::where('id' , $id)->get();
        return view('facebook.view_facebook_page' , compact('facebook_page_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User_page::findOrFail($id);
        return view('facebook.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {   
        $this->validate($request, [
            'page_title'            => 'required',
            'page_description'      => 'required',
            'page_about_your_self'  => 'required',
        ]);
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if(empty($value)){
                $requestData[$key] = "";
                var_dump($requestData[$key]);
            }
        }
        // vv($requestData);
        $user = User_page::findOrFail($id);
        $user->update($requestData);

        return redirect('viewprofile')->with('status', 'Page Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        // vv("here");
        Facebook_page_data::destroy($id);
        return redirect('viewprofile')->with('status', 'Facebook Page Deleted Succesfully!');
    }

    public function upload_youtube_video()
    {
        return view('upload_youtube_video');
    }
    
    public function redirectToProvider_profile_integration()
    {
        $redirect_url_variable = "";    
        $redirect_url_variable = env('TWITTER_REDIRECT_URI_PROFILE_INTEGRATION');
  
        return Socialite::with('twitter')->redirect();

        // return Socialite::with("twitter")->redirectUrl($redirect_url_variable)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback_profile_integration()
    {
      vv("ruko");
      die;
        $redirect_url_variable = "";    
        $redirect_url_variable = env('TWITTER_REDIRECT_URI_PROFILE_INTEGRATION');
        // try {

            $user = Socialite::driver('twitter')->user();
            vv($user);
            $authUser = $this->findOrCreateUser($user, $provider);
            if($authUser == 'no_email_found'){
                return redirect('jobseeker_register')->with('alert', 'Email not found try again later or use another platform');
            }
            Auth::guard('jobseeker')->login($authUser, true);

            // vv(Auth::guard('jobseeker')->user()->last_name);
            if(empty(Auth::guard('jobseeker')->user()->last_name)){

                return redirect('update_profile_login_with_social_marketer')->with('status', 'Register Successfully, Now Update Your profile');
            }else{
                return redirect($this->redirectTo);
            }
        // } catch (\Exception $e) {
        //     return redirect('jobseeker_register')->with('alert', 'Something Wrong try again');
        // }
    }



    public function redirectToProvider_profile_integration_instagram()
    {
        $redirect_url_variable = "";    
        $redirect_url_variable = env('TWITTER_REDIRECT_URI_PROFILE_INTEGRATION');
        return Socialite::with('instagram')->redirect();
        // return Socialite::with('twitter')->redirect();

        // return Socialite::with("twitter")->redirectUrl($redirect_url_variable)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback_profile_integration_instagram()
    {
        try {
          $user = Socialite::driver('instagram')->user();
          $accessTokenResponseBody = $user->accessTokenResponseBody;
          $usermane_form_page_data = $accessTokenResponseBody['user']['username'];
          // vv($accessTokenResponseBody['user']['username']);
          $url_22 = "https://www.instagram.com/".$usermane_form_page_data."/?__a=1";
          $response_22 = file_get_contents($url_22);
          
          $instagram_response = json_decode($response_22);     
          $instagram_response = $instagram_response->graphql->user;
            Instagram_page_data::create([
                    'user_id'           => Auth::user()->id,
                    'page_id'           => 0,
                    'name'              => $instagram_response->full_name,
                    'keyword'           => $usermane_form_page_data,
                    'followed_by'       => $instagram_response->edge_followed_by->count,
                    'follows'           => $instagram_response->edge_follow->count,
                    'image'             => $instagram_response->profile_pic_url_hd,
                ]);
          return redirect('viewprofile')->with('status', 'Instagram Page Integrated!');
        } catch (\Exception $e) {
            return redirect('viewprofile')->with('alert', 'Something Wrong try again');
        }
    }

}
