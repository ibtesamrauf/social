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
        // $c = Hashtags::get();
        // vv($c);
        // v($facebook_page_data);
        // vv(Auth::user()->Users_Roles_hashtags); 
        // vv(Auth::user()->Users_Roles_hashtags_names); 
         
        return view('viewprofile' , compact('facebook_page_data' , 'youtube_page_data' , 
            'instagram_page_data' ));
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

}
