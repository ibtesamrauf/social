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
use App\Twitter_page_data;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class Twitter_pageController extends Controller
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
      
        return view('twitter.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('twitter.create');
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
        
        $instagram_url = $youtube_url;


        $settings = array(
            'oauth_access_token' => env('TWITTER_OAUTH_ACCESS_TOKEN'),
            'oauth_access_token_secret' => env('TWITTER_OAUTH_ACCESS_TOKEN_SECRET'),
            'consumer_key' => env('TWITTER_KEY'),
            'consumer_secret' => env('TWITTER_SECRET')
        );

        $url = 'https://api.twitter.com/1.1/users/show.json';
        $getfield = '?screen_name='.$instagram_url;
        $requestMethod = 'GET';

        $twitter = new \App\Helpers\TwitterAPIExchange($settings);
        // $twitter = new TwitterAPIExchange($settings);
        $output =  $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();
              
        $twitter_response = json_decode($output, true);
        if(!empty($twitter_response['errors'])){
            return redirect('viewprofile')->with('status', 'Page not found!');
        }
        
        $count = Twitter_page_data::where('user_id', Auth::user()->id)->count();
        // vv($count);
        if($count > 4){
            return redirect('viewprofile')->with('status', 'Max 5 Page limit');
        }else{ 
            Twitter_page_data::create([
                    'user_id'           => Auth::user()->id,
                    'name'              => $twitter_response['name'],
                    'keyword'           => $instagram_url,
                    'followers_count'   => $twitter_response['followers_count'],
                    'statuses_count'    => $twitter_response['statuses_count'],
                    'friends_count'     => $twitter_response['friends_count'],
                    'favourites_count'  => $twitter_response['favourites_count'],
                    'image'             => $twitter_response['profile_image_url_https'],
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
        $instagram_page_data = Instagram_page_data::where('id' , $id)->get();
        return view('twitter.view_instagram_page' , compact('instagram_page_data'));
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
        Instagram_page_data::destroy($id);
        return redirect('viewprofile')->with('status', 'Instagram Page Deleted Succesfully!');
    }

    public function upload_youtube_video()
    {
        return view('upload_youtube_video');
    }

}
