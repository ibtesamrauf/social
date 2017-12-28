<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\User_videos;
use Auth;

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
        $user_videos_data = User_videos::where('user_id' , Auth::user()->id)->orderBy('id','DESC')->paginate(15);
        return view('viewpage',compact('user_videos_data'));
        // return view('youtube');

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
    

}
