<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\User_videos;
use Auth;
use App\User_page;
use App\User;
use Ixudra\Curl\Facades\Curl;
use Facebook\Facebook;
use App\Facebook_page_data;
use App\Youtube_page_data;
use App\Instagram_page_data;
use App\Hashtags;
use App\Preferred_medium;
use App\User_preferred_medium;
// use SammyK;
use App\Country;
use App\User_roles_hashtags;
use Illuminate\Support\Facades\Validator;

class ViewpageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['auth','isVerified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $url_2 = "https://graph.facebook.com/vernetroyer?fields=name,likes,link,fan_count&access_token=1942200009377124|2aa44fec0382b4d5715af57be82779d2";
        $response_2 = file_get_contents($url_2);
        
        $facebook_response = json_decode($response_2);
        $facebook_response_page_image = "https://graph.facebook.com/v2.11/vernetroyer/picture";
        // v($facebook_response);
        // echo "<img src='".$facebook_response_page_image."'>";
            // "https://graph.facebook.com/v2.11/vernetroyer/picture"

// die;

        $user_videos_data = User_videos::where('user_id' , Auth::user()->id)->orderBy('id','DESC')->paginate(15);
        $user_page_data = User_page::where('user_id' , Auth::user()->id)->get();
        
        // var_dump($user_page_data[2]->youtube_page_url);
        
        $youtube_page_id = $user_page_data[2]->youtube_page_url;
        $numbers = explode('/', $youtube_page_id);
        $lastNumber = end($numbers);
        // var_dump($lastNumber);

        $url = "https://www.googleapis.com/youtube/v3/channels?part=snippet&fields=items%2Fsnippet%2Fthumbnails%2Fdefault&id=".$lastNumber."&key=AIzaSyAg_FC0M57hpDOSnCgCjiXlnHdr979nEJE";
        $youtube_response_page_image = Curl::to($url)->get();
        $youtube_response_page_image = json_decode($youtube_response_page_image);
        $youtube_response_page_image = $youtube_response_page_image->items[0]->snippet->thumbnails->default->url;
        // v($youtube_response_page_image);


        $youtube_response = Curl::to('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id='.$lastNumber.'&key=AIzaSyAg_FC0M57hpDOSnCgCjiXlnHdr979nEJE')->get();
        $youtube_response = json_decode($youtube_response);
        $youtube_response = $youtube_response->items[0];

        // vv($youtube_response);
        // die;
        return view('viewpage',compact('user_videos_data' , 'user_page_data' , 'youtube_response', 
                'youtube_response_page_image' , 'facebook_response' , 'facebook_response_page_image'));
        // return view('youtube');
    }

    public function viewpagelist()
    {   
        $perPage = 10;
        $user_page = User_page::paginate($perPage);

        return view('viewpagelist' , compact('user_page'));
    }   

    public function view_facebook_page($id)
    {
        $facebook_page_data = Facebook_page_data::where('id' , $id)->get();
        return view('view_facebook_page' , compact('facebook_page_data'));
    }   

    public function view_youtube_page($id)
    {
        $youtube_page_data = Youtube_page_data::where('id' , $id)->get();
        return view('view_youtube_page' , compact('youtube_page_data'));
    }  

    public function view_instagram_page($id)
    {
        $instagram_page_data = Instagram_page_data::where('id' , $id)->get();
        return view('view_instagram_page' , compact('instagram_page_data'));
    }  
    public function upload_youtube_video()
    {
        return view('upload_youtube_video');
    }

    public function number_of_videos(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            if($key == "_token"){

            }else{
                if(isset($value)){
                    // var_dump($value);
                    $youtube_ids = explode('v=', $value);
                    User_videos::insert([
                        'user_id'       => Auth::user()->id, 
                        'videos_url'    => $youtube_ids[1]
                    ]);
                }
            }
        }

        return redirect('home')->with('status', 'Videos Added!');

        // $data = [
        //     'success': true,
        //     'message': 'Your AJAX processed correctly'
        // ];
        // return response()->json($data, 200, [], JSON_PRETTY_PRINT);

        // return response()->json($data);
    }

    public function delete_youtube_video($youtube_video_id,$id)
    {
        if(!empty($youtube_video_id)){
            User_videos::where('user_id', Auth::user()->id)
                            ->where('videos_url' , $youtube_video_id)
                            ->where('id' , $id)
                            ->delete();
            return redirect('viewpage')->with('status', 'Video deleted Success fully!');
        }else{
            return redirect('viewpage')->with('status', 'Havign some problem try again later!');
        }
    }

    public function test()
    {
        return view('test');
    }

    public function viewprofile()
    {
        $facebook_page_data = Facebook_page_data::where('user_id' , Auth::user()->id)->get();
        $youtube_page_data = Youtube_page_data::where('user_id' , Auth::user()->id)->get();
        $instagram_page_data = Instagram_page_data::where('user_id' , Auth::user()->id)->get();
         
        return view('viewprofile' , compact('facebook_page_data' , 'youtube_page_data' , 
            'instagram_page_data' ));
    }

    public function editprofile()
    {
        $facebook_page_data = Facebook_page_data::where('user_id' , Auth::user()->id)->get();
        $youtube_page_data = Youtube_page_data::where('user_id' , Auth::user()->id)->get();
        $instagram_page_data = Instagram_page_data::where('user_id' , Auth::user()->id)->get();
        $hashtags = hashtags::get();
        $preferred_medium = Preferred_medium::get();
        
        return view('editprofile_test' , compact('facebook_page_data' , 'youtube_page_data' , 
            'instagram_page_data' , 'hashtags', 'preferred_medium'));
    }

    public function editprofile_post(Request $request)
    {
        // $facebook_page_data = Facebook_page_data::where('user_id' , Auth::user()->id)->get();
        // $youtube_page_data = Youtube_page_data::where('user_id' , Auth::user()->id)->get();
        // $instagram_page_data = Instagram_page_data::where('user_id' , Auth::user()->id)->get();
        // $hashtags = hashtags::get();
        // $preferred_medium = Preferred_medium::get();

        // $request->
        
        return redirect('editprofile')->with('status', 'Profile Updated'); 
    }
    

    public function users_preferred_medium_add($preferred_medium_id)
    {
        User_preferred_medium::create([
                'user_id' => Auth::user()->id,
                'preferred_medium_id' => $preferred_medium_id,
            ]);
        return redirect('editprofile')->with('status', 'Prefered Medium Added'); 
    } 

    public function users_preferred_medium_remove($user_preferred_medium_table_id)
    {
        User_preferred_medium::where('id' , $user_preferred_medium_table_id)->delete();
        return redirect('editprofile')->with('status', 'Prefered Medium Removed'); 
    }
    
    public function add_facebook_page($id)
    {
        $facebook_page_data = Facebook_page_data::where('id' , $id)->get();
        return view('add_facebook_page' , compact('facebook_page_data'));
    }  

    public function add_youtube_page($id)
    {
        $youtube_page_data = Youtube_page_data::where('id' , $id)->get();
        return view('add_youtube_page' , compact('youtube_page_data'));
    }  

    public function add_instagram_page($id)
    {
        $instagram_page_data = Instagram_page_data::where('id' , $id)->get();
        return view('add_instagram_page' , compact('instagram_page_data'));
    } 

    public function update_profile_login_with_social()
    {
        $user = User::findOrFail(Auth::user()->id);
        $preferred_medium_value = Preferred_medium::get();
        $country1 = Country::orderBy('id' , 'asc')->get();
        return view('update_profile_login_with_social' , compact( 'preferred_medium_value' , 'country1' , 'user'));
    }

    public function update_profile_login_with_social_post(Request $request)
    {   
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
       
        return redirect('viewprofile')->with('status', 'Prefered Medium Added');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone_number' => 'required',
            'country' => 'required|not_in:Select',
            'title' => 'required',
            'hashtags' => 'required',
            'preferred_medium' => 'required',
        ]);
        // vv("ppp");
    }

    protected function create(array $data)
    {

        $image_name = "";
        foreach ($data as $key => $value) {
            if(empty($value)){
                $data[$key] = ""; 
            }
        }
        
        if(array_key_exists("file",$data) ){
            echo 'Uploaded';
            // $file = Input::file($data['file']);
            $file = $data['file'];
            $file->move('uploads', time().$file->getClientOriginalName());
            echo '';
            $image_name = time().$file->getClientOriginalName();
        }else{
            $user_data = User::where('id',Auth::user()->id)->first();

            if(!empty($user_data->profile_picture)){
                $image_name = $user_data->profile_picture;
            }
        }
        
        $user = User::where('id',Auth::user()->id)
            ->update([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'profile_picture'     => $image_name,
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
            'company_id'        => 1,
            'company_name'      => 'no',
            'provider'          => '',
            'provider_id'       => '',
        ]);

        // add facebook page data
        if(!empty($data['faebook_url'])){
            $facebook_url = explode("/", $data['faebook_url']);
            if(empty(last($facebook_url))){
                unset($facebook_url[count($facebook_url) - 1]);
                $facebook_url = last($facebook_url);
            }else{
                $facebook_url = last($facebook_url);
            }

            // vv($facebook_url);
            $url_2 = "https://graph.facebook.com/".$facebook_url."/?fields=name,likes,link,fan_count,picture&access_token=1942200009377124|2aa44fec0382b4d5715af57be82779d2";
            $response_2 = file_get_contents($url_2);
            
            $facebook_response = json_decode($response_2);
            $facebook_response_page_image = "https://graph.facebook.com/v2.11/".$facebook_url."/picture?type=large";
            Facebook_page_data::create([
                    'user_id'           => Auth::user()->id,
                    'page_id'           => 0,
                    'name'              => $facebook_response->name,
                    'link'              => $facebook_response->link,
                    'keyword'           => $facebook_url,
                    'likes'             => $facebook_response->fan_count,
                    'image'             => $facebook_response_page_image,
                ]);
        }


        // add instagram page data
        if(!empty($data['instagram_url'])){
            if( strpos( $data['instagram_url'] , '/' ) !== false ) {
                $instagram_url = explode("/", $data['instagram_url']);
                if(empty(last($instagram_url))){
                    unset($instagram_url[count($instagram_url) - 1]);
                    $instagram_url = last($instagram_url);
                }else{
                    unset($instagram_url[count($instagram_url) - 1]);
                    $instagram_url = last($instagram_url);
                }
            }else{
                $instagram_url = $data['instagram_url'];
            }
            
            $url_22 = "https://www.instagram.com/".$instagram_url."/?__a=1";

            // $url_2 = "https://graph.facebook.com/".$instagram_url."/?fields=name,likes,link,fan_count,picture&access_token=1942200009377124|2aa44fec0382b4d5715af57be82779d2";
            $response_22 = file_get_contents($url_22);
            
            $instagram_response = json_decode($response_22);     
            $instagram_response = $instagram_response->user;
            vv($instagram_response );
            Instagram_page_data::create([
                    'user_id'           => Auth::user()->id,
                    'page_id'           => 0,
                    'name'              => $instagram_response->full_name,
                    'keyword'           => $instagram_url,
                    'followed_by'       => $instagram_response->followed_by->count,
                    'follows'           => $instagram_response->follows->count,
                    'image'             => $instagram_response->profile_pic_url_hd,
                ]);
       
        }


        // add youtube page data
        if(!empty($data['youtube_url'])){
            $youtube_url = explode("/", $data['youtube_url']);
            if(empty(last($youtube_url))){
                unset($youtube_url[count($youtube_url) - 1]);
                $youtube_url = last($youtube_url);
            }else{
                $youtube_url = last($youtube_url);
            }
            // vv($youtube_url);
            $youtube_response = file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id='.$youtube_url.'&key=AIzaSyAg_FC0M57hpDOSnCgCjiXlnHdr979nEJE');
            $youtube_response = json_decode($youtube_response);
            $youtube_response = $youtube_response->items[0];
            // vv($youtube_response);
            if(empty($youtube_response->snippet->description)){
                $youtube_response->snippet->description = 'null';
            }
            Youtube_page_data::create([
                    'user_id'           => Auth::user()->id,
                    'page_id'           => 0,
                    'name'              => $youtube_response->snippet->title,
                    'keyword'              => $youtube_url,
                    'subscriberCount'   => $youtube_response->statistics->subscriberCount,
                    'image'             => $youtube_response->snippet->thumbnails->medium->url,
                    'description'       => $youtube_response->snippet->description,
                ]);
       
        }

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
                        'user_id'       => Auth::user()->id,
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
                        'user_id'       => Auth::user()->id,
                        'client'        => $value,
                        'link'          => $link_var[$key],
                        'details'       => $details_var[$key],
                    ]);
                }  
            }  
        }

        foreach ($data['preferred_medium'] as $key => $value) {    
            User_preferred_medium::create([
                'user_id'               => Auth::user()->id,
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
                'user_id'       => Auth::user()->id,
                'hashtags_id'   => $checking_exist->id,
            ]);
        }  
        return $user;
    }

    

}
