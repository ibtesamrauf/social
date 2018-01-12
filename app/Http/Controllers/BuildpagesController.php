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


class BuildpagesController extends Controller
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
      
        return view('buildpages.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('buildpages.create');
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
            'page_title'            => 'required',
            'page_description'      => 'required',
            'page_about_your_self'  => 'required',
           
        ]);
        // vv('ddd');
        if(empty($request->facebook_page_url)){
            $request->facebook_page_url = "";
        }
        if(empty($request->youtube_page_url)){
            $request->youtube_page_url = "";
        }
        if(empty($request->instagram_page_url)){
            $request->instagram_page_url = "";
        }
        $page_id = User_page::create([
                            'user_id'                   => Auth::user()->id, 
                            'page_title'                => $request->page_title,
                            'page_description'          => $request->page_description,
                            'page_about_your_self'      => $request->page_about_your_self,
                            'facebook_page_url'         => $request->facebook_page_url,
                            'youtube_page_url'          => $request->youtube_page_url,
                            'instagram_page_url'        => $request->instagram_page_url,
                        ])->id;

        if(!empty($request->youtube_page_url)){ 
            $this->validate($request, [
                'youtube_page_url'     => 'url',
            ]);           
            
            $youtube_url = explode("/", $request->youtube_page_url);
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
                    'page_id'           => $page_id,
                    'name'              => $youtube_response->snippet->title,
                    'subscriberCount'   => $youtube_response->statistics->subscriberCount,
                    'image'             => $youtube_response->snippet->thumbnails->medium->url,
                    'description'       => $youtube_response->snippet->description,
                ]);
        }
        
        if(!empty($request->facebook_page_url)){
            $this->validate($request, [
                'facebook_page_url'     => 'url',
            ]);
            $facebook_url = explode("/", $request->facebook_page_url);
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
            
            // echo "<img src='".$facebook_response_page_image."'>";
            // v($facebook_url);
            // v($facebook_response->picture->data->url);
            // vv($facebook_response_page_image);

            Facebook_page_data::create([
                    'page_id'           => $page_id,
                    'name'              => $facebook_response->name,
                    'likes'             => $facebook_response->fan_count,
                    'image'             => $facebook_response_page_image,
                ]);
        }

        if(!empty($request->instagram_page_url)){
            // $request->instagram_page_url = "";
            $this->validate($request, [
                'instagram_page_url'     => 'url',
            ]);
            $instagram_url = explode("/", $request->instagram_page_url);
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

            // $instagram_response->followed_by->count;
            // $instagram_response->follows->count;
            // $instagram_response->profile_pic_url_hd;
            // $instagram_response->media->count;

            // v($instagram_response->followed_by->count);
            // v($instagram_response->follows->count);
            // v($instagram_response->profile_pic_url_hd);
            // v($instagram_response->media->count);
            // v($instagram_response->full_name);
            
            // vv($instagram_response);

            Instagram_page_data::create([
                    'page_id'           => $page_id,
                    'name'              => $instagram_response->full_name,
                    'followed_by'       => $instagram_response->followed_by->count,
                    'follows'           => $instagram_response->follows->count,
                    'image'             => $instagram_response->profile_pic_url_hd,
                ]);
        }

       
        return redirect('buildpages')->with('status', 'Pages Created Succesfully!');
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
        $user = User_page::findOrFail($id);
        return view('buildpages.show', compact('user'));
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

        return redirect('buildpages')->with('status', 'Page Updated Succesfully!');
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
        return redirect('buildpages')->with('status', 'Page Deleted Succesfully!');
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
}
