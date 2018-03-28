<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User_page;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User_videos;
use App\User;

use App\Facebook_page_data;
use App\Youtube_page_data;
use App\Instagram_page_data;
use App\Jobs;
use App\Preferred_medium;
use App\Jobs_preferred_medium;
use App\Jobs_applicant;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class Find_jobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(['auth','isVerified']);
    }

    public function index(Request $request)
    {
        $perPage = 15;    
        if(!empty($request->search)){
            $device = Jobs::with('jobs_preferred_medium' , 'jobs_hashtags')
                                ->where('title' , 'like' , "%".$request->search."%")
                                ->orWhere('description' , 'like' , "%".$request->search."%")
                                ->orderBy('id','DESC')
                                ->paginate($perPage);
        }else{
            $device = Jobs::with('jobs_preferred_medium' , 'jobs_hashtags')
                                ->orderBy('id','DESC')
                                ->paginate($perPage);
        }

        // vv($device);
        $temp_users_preferred_medium = array();
        $temp_users_hashtags = array();

        if(Auth::guest()){
            if (Auth::guard('jobseeker')->check()) { 
                return view('find_job.index2', compact('device' , 'temp_users_preferred_medium' , 'temp_users_hashtags'));
            }
        }else{
            foreach(Auth::user()->Users_preferred_medium as $preferred_medium){            
                $temp_users_preferred_medium[] = $preferred_medium->preferred_medium_id;
            }

            foreach(Auth::user()->Users_Roles_hashtags as $preferred_medium){            
                $temp_users_hashtags[] = $preferred_medium->hashtags_id;
            }
            // vv($temp_users_hashtags);
        }

        $facebook_page_likes = array();
        foreach (Auth::user()->User_facebook_page as $key => $value) {
            $facebook_page_likes[] = $value->likes;
        }
        // vv($facebook_page_likes);
        
        $youtube_page_likes = array();
        foreach (Auth::user()->User_youtube_page as $key => $value) {
            $youtube_page_likes[] = $value->subscriberCount;
        }

        $instagram_page_likes = array();
        foreach (Auth::user()->User_instagram_page as $key => $value) {
            $instagram_page_likes[] = $value->followed_by;
        }

        $twitte_page_likes = array();
        foreach (Auth::user()->User_twitter_page as $key => $value) {
            $twitte_page_likes[] = $value->followers_count;
        }
        // vv(Auth::user()->User_twitter_page);

        return view('find_job.index', compact('device' , 'temp_users_preferred_medium' , 'temp_users_hashtags',
            'facebook_page_likes' , 'youtube_page_likes' , 'instagram_page_likes' , 'twitte_page_likes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // vv("create");
        $preferred_medium = Preferred_medium::get();
        return view('find_job.create' , compact('preferred_medium'));
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
            'title'               => 'required',           
            'description'         => 'required',           
            'timing'              => 'required',           
            'sallery'             => 'required',    
            'preferred_medium'    => 'required',
        ]);
        $jobs_id = Jobs::create([
                    'user_id'           => Auth::guard('jobseeker')->user()->id,
                    'title'             => $request->title,
                    'description'       => $request->description,
                    'timing'            => $request->timing,
                    'sallery'           => $request->sallery,
                ]);
        foreach ($request->preferred_medium as $key => $value) {
          Jobs_preferred_medium::create([
                      'jobs_id'                 => $jobs_id->id,
                      'preferred_medium_id'     => $value,
                  ]);
        }
        return redirect('find_job_resource')->with('status', 'Job Posted Succesfully!');
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
        $facebook_page_data = Jobs::with('jobs_preferred_medium')->where('id' , $id)->first();
        // vv($facebook_page_data);
        return view('find_job.show' , compact('facebook_page_data'));
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
        $temp = "";
        $user = jobs::findOrFail($id);
        $preferred_medium = Preferred_medium::get();
        $preferred_medium_job_value = Jobs_preferred_medium::select('preferred_medium_id')
                                          ->where('jobs_id' , $id)
                                          ->get();

        foreach ($preferred_medium_job_value as $key => $value) {
          $temp[] = $value->preferred_medium_id;
        }

        return view('find_job.edit', compact('user', 'preferred_medium' , 'temp'));
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
            'title'               => 'required',           
            'description'         => 'required',           
            'timing'              => 'required',           
            'sallery'             => 'required',    
            'preferred_medium'    => 'required',
        ]);
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if(empty($value)){
                $requestData[$key] = "";
                var_dump($requestData[$key]);
            }
        }
        // vv($requestData);
        $user = Jobs::findOrFail($id);
        $user->update($requestData);

        return redirect('find_job_resource')->with('status', 'Job Updated Succesfully!');
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
        // vv("here");
        Jobs::destroy($id);
        Jobs_preferred_medium::where('jobs_id' , $id)->delete();
        return back()->with('status', 'Job Deleted Succesfully!');
    }

    public function job_post_resource_add_preferred_medium($job_id , $job_prefered_medium_id)
    {
        Jobs_preferred_medium::create([
                      'jobs_id'                 => $job_id,
                      'preferred_medium_id'     => $job_prefered_medium_id,
                  ]);
        return back()->with('status', 'Preferred Medium Added Succesfully!');
    }


    public function job_post_resource_delete_preferred_medium($job_id , $job_prefered_medium_id)
    {
        Jobs_preferred_medium::where('jobs_id' , $job_id)
                                ->where('preferred_medium_id' , $job_prefered_medium_id)
                                ->delete();
        return back()->with('status', 'Preferred Medium Deleted Succesfully!');
    }

    public function view_job($id)
    {
        // $jobs = Jobs::findOrFail($id);
        // return view('' , compact('jobs'))
    }

    public function apply_for_job($id)
    {
        $jobs = Jobs::findOrFail($id);
        return view('find_job.apply_for_job' , compact('jobs'));
    }
    
    public function apply_for_job_post(Request $request)
    {
        $this->validate($request, [
            'job_id'                        => 'required',           
            'applicant_name'                => 'required',           
            'applicant_description'         => 'required',           
        ]);

        // $jobs_id = Jobs_applicant::create([
        //             'jobs_id'                   => $request->job_id,
        //             'applicant_id'              => Auth::user()->id,
        //             'applicant_name'            => $request->applicant_name,
        //             'applicant_description'     => $request->applicant_description,
        //         ]);

        $jobs = Jobs::with('jobs_belongs_to_marketer')->where('id',$request->job_id)->first();
        $marketer_data = $jobs->jobs_belongs_to_marketer;
        $user = User::where('id' , Auth::user()->id)->first();
        // vv($marketer_data->email);
        \Mail::send('email.job_applicant', ['marketer_data' => $marketer_data , 'job_applicant' => $user, 'jobs' => $jobs], function ($m) use ($marketer_data) {
            // $m->from('hello@app.com', 'Your Application');
            $m->to($marketer_data->email, $marketer_data->first_name)->subject('You have New Job Applicant!');
        });

        return redirect('find_job_resource')->with('status', 'Thank you for applying on this job!');
    }
    

}
