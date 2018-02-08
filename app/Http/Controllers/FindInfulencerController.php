<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\User_videos;
use Auth;
use App\User_page;
use App\Country;
use App\Preferred_medium;
use App\Facebook_page_data;
use App\Instagram_page_data;
use App\Youtube_page_data;

class FindInfulencerController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageLimit = 15;
    	if(isset($request->search)){
	        $user_page_data = User_page::with('Users')
                        ->with('Facebook_page')
                        ->with('Youtube_page')
	        			->where('page_title', 'like' , "%$request->search%")
	        			->orWhere('page_description', 'like' , "%$request->search%")
	        			->orWhere('page_about_your_self', 'like' , "%$request->search%")
	        			->paginate($pageLimit);   
			if($user_page_data->isEmpty()){
				$user_page_data->search = "No match found. Search again!";
			} 		    		
    	}else{
	        $user_page_data = User_page::with('Users')->with('Facebook_page')->with('Youtube_page')->paginate($pageLimit);    		
    	}
        // vv($user_page_data);
        return view('findinfluencer',compact('user_page_data'));
    }

    public function finde_influencer_test(Request $request)
    {
        // vv("asdasd");
        $search_page_data = array();
        $pageLimit = 25;
        if(isset($request->search)){
            $user_page_data = User_page::with('Users')
                        ->with('Facebook_page')
                        ->with('Youtube_page')
                        ->where('page_title', 'like' , "%$request->search%")
                        ->orWhere('page_description', 'like' , "%$request->search%")
                        ->orWhere('page_about_your_self', 'like' , "%$request->search%")
                        ->paginate($pageLimit);   
            if($user_page_data->isEmpty()){
                $user_page_data->search = "No match found. Search again!";
            }                   
        }else{
            $user_page_data = User_page::with('Users')->with('Facebook_page')->with('Youtube_page')->paginate($pageLimit);          
        }
        
//                1190547
        if(isset($request->likes_on_Facebook)){
            if($request->likes_on_Facebook_checkbox == 1){
                $facebook_data = Facebook_page_data::where('likes' , '>=' ,  $request->likes_on_Facebook)
                                        ->paginate($pageLimit);                
                $search_page_data = $facebook_data;
                // vv($search_page_data);
            }
        }

        if(isset($request->followers_on_Instagram)){
            if($request->followers_on_Instagram_checkbox == 1){
                $instagram_data = Instagram_page_data::where('followed_by' , '>=' ,  $request->followers_on_Instagram)->get();

                foreach ($instagram_data as $key => $value) {
                    $search_page_data->push($value);
                }
            }
        }


        if(isset($request->subscribers_on_Youtube)){
            if($request->subscribers_on_Youtube_checkbox == 1){
                // v($request->subscribers_on_Youtube);
                $youtube_data = Youtube_page_data::where('subscriberCount' , '>=' ,  $request->subscribers_on_Youtube)->get();
                // vv($youtube_data);
                foreach ($youtube_data as $key => $value) {
                    $search_page_data->push($value);
                }
            }
        }

        

        // vv($search_page_data);
        
        $preferred_medium_value = Preferred_medium::get();
        $country = Country::orderBy('id' , 'asc')->get();
        return view('finde_influencer_test' , compact('country' , 'preferred_medium_value' , 'search_page_data'));
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
        # code...
    }
    

}
