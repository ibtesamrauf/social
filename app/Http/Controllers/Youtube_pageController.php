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


class Youtube_pageController extends Controller
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
      
        return view('youtube.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('youtube.create');
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

            
        $youtube_url = explode("/", $request->page_url);
        if(empty(last($youtube_url))){
            unset($youtube_url[count($youtube_url) - 1]);
            $youtube_url = last($youtube_url);
        }else{
            $youtube_url = last($youtube_url);
        }
        // vv($youtube_url);
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        $page_already_exist = Youtube_page_data::where("keyword" , $youtube_url)->first();
        if($page_already_exist){
            return back()->with('status', 'Page already exist');
        }
        $youtube_response = file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id='.$youtube_url.'&key=AIzaSyAg_FC0M57hpDOSnCgCjiXlnHdr979nEJE', false, stream_context_create($arrContextOptions));
        $youtube_response = json_decode($youtube_response);
        // vv($youtube_response);
        if(empty($youtube_response->items)){
            return back()->with('status', 'Page Not Found');
        }
        $youtube_response = $youtube_response->items[0];
        // vv($youtube_response);
        if(empty($youtube_response->snippet->description)){
            $youtube_response->snippet->description = 'null';
        }

        $count = Youtube_page_data::where('user_id', Auth::user()->id)->count();
        // vv($count);
        if($count > 4){
            return redirect('viewprofile')->with('status', 'Max 5 Page limit');
        }else{ 
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
   
        return redirect('viewprofile')->with('status', 'Pages Added Succesfully!');
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
        $youtube_page_data = Youtube_page_data::where('id' , $id)->get();
        return view('youtube.view_youtube_page' , compact('youtube_page_data'));
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
        return view('youtube.edit', compact('user'));
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
        Youtube_page_data::destroy($id);
        return redirect('viewprofile')->with('status', 'Page Deleted Succesfully!');
    }

    public function upload_youtube_video()
    {
        return view('upload_youtube_video');
    }

}
