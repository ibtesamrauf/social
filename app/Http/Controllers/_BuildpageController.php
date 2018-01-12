<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\User_videos;
use Auth;
use App\User_page;
use Illuminate\Support\Facades\Validator;

class BuildpageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth','isVerified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buildpage');
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
                    User_videos::create([
                        'user_id'       => Auth::user()->id, 
                        'videos_url'    => $youtube_ids[1]
                    ]);
                }
            }
        }

        return redirect('viewpage')->with('status', 'Videos Added!');

        // $data = [
        //     'success': true,
        //     'message': 'Your AJAX processed correctly'
        // ];
        // return response()->json($data, 200, [], JSON_PRETTY_PRINT);

        // return response()->json($data);
    }

    public function buildpage_form(Request $request)
    {
        Validator::make($request->all(), [
            'page_title'                => 'required',
            'page_description'          => 'required',
            'page_about_your_self'      => 'required',
        ])->validate();

        User_page::create([
                'user_id'                   => Auth::user()->id, 
                'page_title'                => $request->page_title,
                'page_description'          => $request->page_description,
                'page_about_your_self'      => $request->page_about_your_self,
            ]);
        return redirect('home')->with('status', 'Page created succesfully!');
    }
    
    public function editpage($id)
    {
        $user_page_data = User_page::where('user_id' , Auth::user()->id)
                            ->where('id',$id)
                            ->first();                 
        // vv($user_page_data);
        return view('buildpage' , compact('user_page_data'));
    }

}
