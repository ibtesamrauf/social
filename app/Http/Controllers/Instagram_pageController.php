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


class Instagram_pageController extends Controller
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
      
        return view('instagram.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('instagram.create');
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
        
        $instagram_url = explode("/", $request->page_url);
        if(empty(last($instagram_url))){
            unset($instagram_url[count($instagram_url) - 1]);
            $instagram_url = last($instagram_url);
        }else{
            $instagram_url = last($instagram_url);
        }

        $url_22 = "https://www.instagram.com/".$instagram_url."/?__a=1";

        // $url_2 = "https://graph.facebook.com/".$instagram_url."/?fields=name,likes,link,fan_count,picture&access_token=1942200009377124|2aa44fec0382b4d5715af57be82779d2";
        $response_22 = file_get_contents($url_22);
        
        $instagram_response = json_decode($response_22);            
        $instagram_response = $instagram_response->user;

        Instagram_page_data::create([
                'user_id'           => Auth::user()->id,
                'page_id'           => 0,
                'name'              => $instagram_response->full_name,
                'followed_by'       => $instagram_response->followed_by->count,
                'follows'           => $instagram_response->follows->count,
                'image'             => $instagram_response->profile_pic_url_hd,
            ]);
       
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
        $instagram_page_data = Instagram_page_data::where('id' , $id)->get();
        return view('instagram.view_instagram_page' , compact('instagram_page_data'));
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
        return view('buildpages.edit', compact('user'));
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
        User_page::destroy($id);
        return redirect('viewprofile')->with('status', 'Page Deleted Succesfully!');
    }

    public function upload_youtube_video()
    {
        return view('upload_youtube_video');
    }

}
