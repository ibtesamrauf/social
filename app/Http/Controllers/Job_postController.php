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
use App\Jobs_hashtags;
use App\Hashtags;
use App\Jobs_applicant;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class Job_postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
       
    }

    public function index(Request $request)
    {
        $perPage = 15;    
        $device = Jobs::where('user_id' , Auth::guard('jobseeker')->user()->id)->orderBy('id','DESC')->paginate($perPage);
      
        return view('jobs.index', compact('device'));
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
        $hashtags = Hashtags::orderBy('tags', 'ASC')->get();
        return view('jobs.create' , compact('preferred_medium' , 'hashtags'));
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

        if(empty($request->audience_facebook) && empty($request->audience_instagram) &&
            empty($request->audience_youtube) && empty($request->audience_twitter) && 
            empty($request->audience_all)){
            return back()->with('status', 'Select audience for one first!');
        }
        $this->validate($request, [
            'title'               => 'required',           
            'description'         => 'required',           
            'timing'              => 'required',           
            // 'audience'             => 'required',    
            'preferred_medium'    => 'required',
            'jobs_hashtags'     => 'required',
        ]);

        if(empty($request->audience_facebook)){
            $request->audience_facebook = "";
        }
        if(empty($request->audience_instagram)){
            $request->audience_instagram = "";
        }
        if(empty($request->audience_youtube)){
            $request->audience_youtube = "";
        }
        if(empty($request->audience_twitter)){
            $request->audience_twitter = "";
        }
        if(empty($request->audience_all)){
            $request->audience_all = "";
        }

        $jobs_id = Jobs::create([
                    'user_id'               => Auth::guard('jobseeker')->user()->id,
                    'title'                 => $request->title,
                    'description'           => $request->description,
                    'timing'                => $request->timing,
                    'audience_all'          => $request->audience_all,
                    'audience_twitter'      => $request->audience_twitter,
                    'audience_instagram'    => $request->audience_instagram,
                    'audience_facebook'     => $request->audience_facebook,
                    'audience_youtube'      => $request->audience_youtube,
                ]);
        foreach ($request->preferred_medium as $key => $value) {
            Jobs_preferred_medium::create([
                      'jobs_id'                 => $jobs_id->id,
                      'preferred_medium_id'     => $value,
                  ]);
        }

        foreach ($request->jobs_hashtags as $key => $value) {
            Jobs_hashtags::create([
                      'jobs_id'                 => $jobs_id->id,
                      'hashtags_id'             => $value,
                  ]);
        }
        return redirect('job_post_resource')->with('status', 'Job Posted Succesfully!');
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
        $facebook_page_data = Jobs::where('id' , $id)->first();
        // vv($facebook_page_data);
        $preferred_medium_job_ids = Jobs_preferred_medium::select('preferred_medium_id')
                                          ->where('jobs_id' , $id)
                                          ->get();

        $hashtags_job_ids = Jobs_hashtags::select('hashtags_id')
                                          ->where('jobs_id' , $id)
                                          ->get();

        return view('jobs.show' , compact('facebook_page_data' , 'preferred_medium_job_ids' , 'hashtags_job_ids'));
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

        $hashtags = Hashtags::orderBy('tags', 'ASC')->get();
        $hashtags_job_value = Jobs_hashtags::select('hashtags_id')
                                          ->where('jobs_id' , $id)
                                          ->get();
        foreach ($hashtags_job_value as $key => $value) {
          $hashtags_id[] = $value->hashtags_id;
        }

        return view('jobs.edit', compact('user', 'preferred_medium' , 'temp' , 'hashtags' , 'hashtags_id'));
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
            // 'audience'             => 'required',    
            // 'preferred_medium'    => 'required',
        ]);

        if(empty($request->audience_facebook)){
            $request->audience_facebook = "";
        }
        if(empty($request->audience_instagram)){
            $request->audience_instagram = "";
        }
        if(empty($request->audience_youtube)){
            $request->audience_youtube = "";
        }
        if(empty($request->audience_twitter)){
            $request->audience_twitter = "";
        }
        if(empty($request->audience_all)){
            $request->audience_all = "";
        }

        
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

        return redirect('job_post_resource')->with('status', 'Job Updated Succesfully!');
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
        Jobs_hashtags::where('jobs_id' , $id)->delete();
        Jobs_applicant::where('jobs_id' , $id)->delete();
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

    
    public function job_post_resource_add_hashtags($job_id , $job_hashtags_id)
    {
        Jobs_hashtags::create([
                      'jobs_id'         => $job_id,
                      'hashtags_id'     => $job_hashtags_id,
                  ]);
        return back()->with('status', 'Hashtags Added Succesfully!');
    }


    public function job_post_resource_delete_hashtags($job_id , $job_hashtags_id)
    {
        Jobs_hashtags::where('jobs_id' , $job_id)
                                ->where('hashtags_id' , $job_hashtags_id)
                                ->delete();
        return back()->with('status', 'Hashtags Deleted Succesfully!');
    }
   
   

}
