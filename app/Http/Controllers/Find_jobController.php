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
use App\Jobs;
use App\Preferred_medium;
use App\Jobs_preferred_medium;

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

        return view('find_job.index', compact('device' , 'temp_users_preferred_medium' , 'temp_users_hashtags'));
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
    
    

}