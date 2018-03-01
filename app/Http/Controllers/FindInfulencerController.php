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
use App\User;

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
        // $search_page_data = new \stdclass();
        $search_page_data = "";
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
        if(!empty($request->advance_search)){
            // vv($request->advance_search);
            if(empty($request->likes_on_Facebook) && empty($request->followers_on_Instagram) && 
                empty($request->subscribers_on_Youtube)) {
                if(!empty($request->country) && $request->country != 'Select'){
                    // vv($request->country);
                    $facebook_data = Facebook_page_data::join('users', 'users.id', '=', 'facebook_page_data.user_id');
                    if($request->country == 'Select'){
                        // $request->country = 0;
                    }else{
                        $facebook_data = $facebook_data->where('users.country', $request->country);
                    }
                    $search_page_data = $facebook_data->get(); 

                    $Instagram_data = Instagram_page_data::join('users', 'users.id', '=', 'instagram_page_data.user_id');
                    if($request->country == 'Select'){
                        // $request->country = 0;
                    }else{
                        $Instagram_data = $Instagram_data->where('users.country', $request->country);
                    }
                    $Instagram_data = $Instagram_data->get();

                    $Youtube_data = Youtube_page_data::join('users', 'users.id', '=', 'youtube_page_data.user_id');
                    if($request->country == 'Select'){
                        // $request->country = 0;
                    }else{
                        $Youtube_data = $Youtube_data->where('users.country', $request->country);
                    }
                    $Youtube_data = $Youtube_data->get();                  

                    foreach ($Instagram_data as $key => $value) {
                        $search_page_data->push($value);
                    }foreach ($Youtube_data as $key => $value2) {
                        $search_page_data->push($value2);
                    }
                    
                }elseif (!empty($request->preferred_medium)) {
                    // v('asd');
                    $preferred_medium_temp = implode(",", $request->preferred_medium);
                    
                    $facebook_data = Facebook_page_data::join('users', 'users.id', '=', 'facebook_page_data.user_id')
                                            ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                    $facebook_data = $facebook_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 
                    $search_page_data = $facebook_data;

                    $instagram_data = Instagram_page_data::join('users', 'users.id', '=', 'instagram_page_data.user_id')
                                            ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                    $instagram_data = $instagram_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 
                   
                    $youtube_data = Youtube_page_data::join('users', 'users.id', '=', 'youtube_page_data.user_id')
                                            ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                    $youtube_data = $youtube_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 

                    foreach ($instagram_data as $key => $value) {
                        $search_page_data->push($value);
                    }foreach ($youtube_data as $key => $value2) {
                        $search_page_data->push($value2);
                    }
                        
                }else{ 
                    $facebook_data = Facebook_page_data::get();  
                    // vv($facebook_data);              
                    $instagram_data = Instagram_page_data::get();
                    $youtube_data = Youtube_page_data::get();
                    $search_page_data = $facebook_data;
                    foreach ($instagram_data as $key => $value) {
                        $search_page_data->push($value);
                    }foreach ($youtube_data as $key => $value2) {
                        $search_page_data->push($value2);
                    }
                }
            }

            if(!empty($request->likes_on_Facebook)){
                // v($request->country);
                // if($request->country == 'Select'){
                //     $request->country = 0;
                // }
                // $temp_country = $request->country;
                // $temp_country = $temp_country+0;
                // v($request->country);
                if($request->likes_on_Facebook_checkbox == 1){
                    // $facebook_data = Facebook_page_data::with(['User_details' => function ($query) use ($temp_country){
                    //                     $query->where('country', $temp_country);
                    //                 }])
                    //                 ->join('contacts', 'users.id', '=', 'contacts.user_id')
                    //                 ->where('likes' , '>=' ,  $request->likes_on_Facebook)
                    //                 ->get();   
                    
                    $facebook_data = Facebook_page_data::join('users', 'users.id', '=', 'facebook_page_data.user_id')
                                            ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');

                        if(!empty($request->country)){
                            if($request->country == 'Select'){
                                $request->country = 0;
                            }else{
                                $facebook_data = $facebook_data->where('users.country', $request->country);
                            }
                        }
                        if (!empty($request->preferred_medium)) {
                            $preferred_medium_temp = implode(",", $request->preferred_medium);
                            $facebook_data = $facebook_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp]); 
                        }
                        $facebook_data = $facebook_data->where('likes' , '>=' ,  $request->likes_on_Facebook)->get();                   
                        $search_page_data = $facebook_data;
                        if (!empty($request->preferred_medium)) {
                            $instagram_data = Instagram_page_data::join('users', 'users.id', '=', 'instagram_page_data.user_id')
                                                    ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                            $instagram_data = $instagram_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 
                           
                            $youtube_data = Youtube_page_data::join('users', 'users.id', '=', 'youtube_page_data.user_id')
                                                    ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                            $youtube_data = $youtube_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 

                            foreach ($instagram_data as $key => $value) {
                                $search_page_data->push($value);
                            }foreach ($youtube_data as $key => $value2) {
                                $search_page_data->push($value2);
                            }
                        }
                    // vv($search_page_data);
                }
            }

            if(!empty($request->followers_on_Instagram)){
                if($request->followers_on_Instagram_checkbox == 1){
                    // $instagram_data = Instagram_page_data::with(['User_details_2' => function ($query1) {
                    //                     $query1->where('country', $request->country);
                    //                 }])
                    //                 ->where('followed_by' , '>=' ,  $request->followers_on_Instagram)
                    //                 ->get();
                    $instagram_data = Instagram_page_data::join('users', 'users.id', '=', 'instagram_page_data.user_id');
                        if(!empty($request->country)){
                            if($request->country == 'Select'){
                                $request->country = 0;
                            }else{
                                $instagram_data = $instagram_data->where('users.country', $request->country);
                            }
                        }

                        if (!empty($request->preferred_medium)) {
                            $preferred_medium_temp = implode(",", $request->preferred_medium);
                            $instagram_data = $instagram_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp]);                                    
                        }
                    $instagram_data =  $instagram_data->where('followed_by' , '>=' ,  $request->followers_on_Instagram)->get();  
                    if (!is_object($search_page_data)) {
                        $search_page_data = $instagram_data;
                    }else{
                        foreach ($instagram_data as $key => $value) {
                            $search_page_data->push($value);
                        }
                    }
                    if (!empty($request->preferred_medium)) {
                        $facebook_data = Facebook_page_data::join('users', 'users.id', '=', 'facebook_page_data.user_id')
                                                ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                        $facebook_data = $facebook_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get();                        
                        $youtube_data = Youtube_page_data::join('users', 'users.id', '=', 'youtube_page_data.user_id')
                                                ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                        $youtube_data = $youtube_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 

                        foreach ($facebook_data as $key => $value) {
                            $search_page_data->push($value);
                        }foreach ($youtube_data as $key => $value2) {
                            $search_page_data->push($value2);
                        }
                    }
                    
                }
            }

            if(!empty($request->subscribers_on_Youtube)){
                if($request->subscribers_on_Youtube_checkbox == 1){
                    // v($request->subscribers_on_Youtube);
                    // $youtube_data = Youtube_page_data::with(['User_details_3' => function ($query2) {
                    //                     $query2->where('country', $request->country);
                    //                 }])
                    //                 ->where('subscriberCount' , '>=' ,  $request->subscribers_on_Youtube)
                    //                 ->get();

                    // $youtube_data = Youtube_page_data::with(['User_details_3' => function ($query) use ($temp_country){
                    //                     $query->where('country', $temp_country);
                    //                 }])
                    //                 ->join('users', 'users.id', '=', 'youtube_page_data.user_id')
                    //                 ->where('users.country', $temp_country)
                    //                 ->where('subscriberCount' , '>=' ,  $request->subscribers_on_Youtube)
                    //                 ->get();  


                    $youtube_data = Youtube_page_data::join('users', 'users.id', '=', 'youtube_page_data.user_id')
                                                ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                        
                        if(!empty($Request->country)){
                            if($request->country == 'Select'){
                                $request->country = 0;
                            }else{
                                $youtube_data = $youtube_data->where('users.country', $request->country);
                            }
                        }
                    if (!empty($request->preferred_medium)) {
                        $preferred_medium_temp = implode(",", $request->preferred_medium);
                        $youtube_data = $youtube_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp]);       
                    }
                    $youtube_data = $youtube_data->where('subscriberCount' , '>=' ,  $request->subscribers_on_Youtube)->get();  

                    if (!is_object($search_page_data)) {
                        $search_page_data = $youtube_data;
                    }else{
                        foreach ($youtube_data as $key => $value) {
                            $search_page_data->push($value);
                        }
                    }

                    if (!empty($request->preferred_medium)) {
                        $facebook_data = Facebook_page_data::join('users', 'users.id', '=', 'facebook_page_data.user_id')
                                                ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                        $facebook_data = $facebook_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 
                        $instagram_data = Instagram_page_data::join('users', 'users.id', '=', 'instagram_page_data.user_id')
                                                ->join('user_preferred_medium', 'user_preferred_medium.user_id', '=', 'users.id');
                        $instagram_data = $instagram_data->whereIn('user_preferred_medium.preferred_medium_id' , [$preferred_medium_temp])->get(); 
                       
                        foreach ($instagram_data as $key => $value) {
                            $search_page_data->push($value);
                        }foreach ($facebook_data as $key => $value2) {
                            $search_page_data->push($value2);
                        }
                    }
                }
            }
        }else{
            $facebook_data = Facebook_page_data::get();                
            $instagram_data = Instagram_page_data::get();
            $youtube_data = Youtube_page_data::get();
            $search_page_data = $facebook_data;
            foreach ($instagram_data as $key => $value) {
                $search_page_data->push($value);
            }foreach ($youtube_data as $key => $value2) {
                $search_page_data->push($value2);
            }
        }
        $sorted = $search_page_data->sortBy('name');
        // v($sorted);
        $search_page_data = $sorted;
        $search_page_data = $search_page_data->toArray();
        
        $search_page_data = array_filter($search_page_data);
        $search_page_data = array_values($search_page_data);

        $search_page_data = json_decode(json_encode($search_page_data), FALSE);
        
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
    }

    public function viewprofile_from_find_influencer($user_id = 0)
    {    
        $temp_user_id = $user_id;
        
        $facebook_page_data = Facebook_page_data::where('user_id' , $temp_user_id)->get();
        $youtube_page_data = Youtube_page_data::where('user_id' , $temp_user_id)->get();
        $instagram_page_data = Instagram_page_data::where('user_id' , $temp_user_id)->get();
        $user_data = User::where('id' , $temp_user_id)->first();
        // vv($user_data);
        return view('viewprofile_from_find_influencer' , compact('facebook_page_data' , 'youtube_page_data' , 
            'instagram_page_data', 'user_data'));
    }
    

}
