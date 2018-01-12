<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\User_videos;
use Auth;
use App\User_page;


class FindInfulencerController extends Controller
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
