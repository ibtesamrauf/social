<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Http\Request;
use App\Hashtags;
use App\User_roles_hashtags;
use App\Preferred_medium;
use App\User_preferred_medium;
use App\User_portfolio;
use App\Country;
use Illuminate\Support\Facades\Input;
use App\User_previously_campaign;
use Illuminate\Validation\Rule;

use App\Facebook_page_data;
use App\Youtube_page_data;
use App\Instagram_page_data;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',['except' => ['getVerification', 'getVerificationError']]);
        $this->is_file = false;
        $this->is_facebook = false;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Rule::unique('users')->where(function ($query) {
                //     $query->where('user_role', 'influencer');
                // }),
                'unique:users',
            ],
            'phone_number' => 'required',
            'country' => 'required|not_in:Select',
            'title' => 'required',
            'hashtags' => 'required',
            'preferred_medium' => 'required',
            // 'country' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // vv("ppp");
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $image_name = "";
        foreach ($data as $key => $value) {
            if(empty($value)){
                $data[$key] = ""; 
            }
        }
        
        if($this->is_file){
            if($data['file']){
                echo 'Uploaded';
                // $file = Input::file($data['file']);
                $file = $data['file'];
                $file->move('uploads', time().$file->getClientOriginalName());
                echo '';
                $image_name = time().$file->getClientOriginalName();
            }
        }
 
        if($this->is_facebook){
            if(!empty($data['faebook_url'])){
                $facebook_url2 = explode("/", $data['faebook_url']);
                if(empty(last($facebook_url2))){
                    unset($facebook_url2[count($facebook_url2) - 1]);
                    $facebook_url2 = last($facebook_url2);
                }else{
                    $facebook_url2 = last($facebook_url2);
                }
                $image_name = "https://graph.facebook.com/v2.11/".$facebook_url2."/picture?type=large";

            }
        }

        $user = User::create([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'profile_picture'     => $image_name,
            'user_role'           => 'influencer',
            'email'               => $data['email'],
            'phone_number'        => $data['phone_number'],
            'country'             => $data['country'],
            'title'               => $data['title'],
            'faebook_url'         => $data['faebook_url'],
            'instagram_url'       => $data['instagram_url'],
            'youtube_url'         => $data['youtube_url'],
            'twitter_url'         => $data['twitter_url'],
            'soundcloud_url'      => $data['soundcloud_url'],
            'website_blog'        => $data['website_blog'],
            'monthly_visitors'    => $data['monthly_visitors'],
            'company_id'        => 1,
            'company_name'      => 'no',
            'password'          => bcrypt($data['password']),
            'provider'          => '',
            'provider_id'       => '',
        ]);

        // add facebook page data
        if(!empty($data['faebook_url'])){
            $facebook_url = explode("/", $data['faebook_url']);
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
            Facebook_page_data::create([
                    'user_id'           => $user->id,
                    'page_id'           => 0,
                    'name'              => $facebook_response->name,
                    'link'              => $facebook_response->link,
                    'keyword'           => $facebook_url,
                    'likes'             => $facebook_response->fan_count,
                    'image'             => $facebook_response_page_image,
                ]);
        }


        // add instagram page data
        if(!empty($data['instagram_url'])){
            if( strpos( $data['instagram_url'] , '/' ) !== false ) {
                $instagram_url = explode("/", $data['instagram_url']);
                if(empty(last($instagram_url))){
                    unset($instagram_url[count($instagram_url) - 1]);
                    $instagram_url = last($instagram_url);
                }else{
                    unset($instagram_url[count($instagram_url) - 1]);
                    $instagram_url = last($instagram_url);
                }
            }else{
                $instagram_url = $data['instagram_url'];
            }
            
            $url_22 = "https://www.instagram.com/".$instagram_url."/?__a=1";

            // $url_2 = "https://graph.facebook.com/".$instagram_url."/?fields=name,likes,link,fan_count,picture&access_token=1942200009377124|2aa44fec0382b4d5715af57be82779d2";
            $response_22 = file_get_contents($url_22);
            
            $instagram_response = json_decode($response_22);     
            $instagram_response = $instagram_response->user;
            // vv($instagram_response );
            Instagram_page_data::create([
                    'user_id'           => $user->id,
                    'page_id'           => 0,
                    'name'              => $instagram_response->full_name,
                    'keyword'           => $instagram_url,
                    'followed_by'       => $instagram_response->followed_by->count,
                    'follows'           => $instagram_response->follows->count,
                    'image'             => $instagram_response->profile_pic_url_hd,
                ]);
       
        }


        // add youtube page data
        if(!empty($data['youtube_url'])){
            $youtube_url = explode("/", $data['youtube_url']);
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
                    'user_id'           => $user->id,
                    'page_id'           => 0,
                    'name'              => $youtube_response->snippet->title,
                    'keyword'              => $youtube_url,
                    'subscriberCount'   => $youtube_response->statistics->subscriberCount,
                    'image'             => $youtube_response->snippet->thumbnails->medium->url,
                    'description'       => $youtube_response->snippet->description,
                ]);
       
        }

        if(!empty($data['description'])){
            $link_var = $data['link_p'];        
            foreach ($data['description'] as $key => $value) {  
                if(empty($value)){
                    $value = "";
                    if(empty($link_var[$key])){
                        $link_var[$key] = "";
                    }
                }
                if(empty($value) && empty($link_var[$key])){
                }else{
                    User_portfolio::create([
                        'user_id'       => $user->id,
                        'link'          => $link_var[$key],
                        'description'   => $value,
                    ]);
                }  
            }  
        }

        if(!empty($data['client'])){
            $link_var = $data['link'];        
            $details_var = $data['details'];        
            foreach ($data['client'] as $key => $value) {  
                if(empty($value)){
                    $value = "";
                }  
                if(empty($details_var[$key])){
                    $details_var[$key] = "";
                }
                if(empty($link_var[$key])){
                    $link_var[$key] = "";
                }
                if(empty($value) && empty($link_var[$key]) && empty($details_var[$key]) ){
                }else{
                    User_previously_campaign::create([
                        'user_id'       => $user->id,
                        'client'        => $value,
                        'link'          => $link_var[$key],
                        'details'       => $details_var[$key],
                    ]);
                }  
            }  
        }

        foreach ($data['preferred_medium'] as $key => $value) {    
            User_preferred_medium::create([
                'user_id'       => $user->id,
                'preferred_medium_id'   => $value,
            ]);
        }  
        $hashtags_var = $data['hashtags'];
        $hashtags_var = explode("#", $hashtags_var);
        $hashtags_var = array_filter($hashtags_var);
        $hashtags_var = str_replace(' ', '', $hashtags_var);
        foreach ($hashtags_var as $key => $value) {
            # code...
            $checking_exist = Hashtags::where('tags' , $value)->get();
            if($checking_exist->isEmpty()){
                // v($checking_exist);
                Hashtags::create([
                    'tags' => $value,
                    ]);
            }
        }

        foreach ($hashtags_var as $key => $value) {
            $checking_exist = Hashtags::where('tags' , $value)->first();    
            User_roles_hashtags::create([
                'user_id'       => $user->id,
                'hashtags_id'   => $checking_exist->id,
            ]);
        }  
        return $user;
    }

    public function showRegistrationForm()
    {
        // $hashtags = Hashtags::get();
        $preferred_medium_value = Preferred_medium::get();
        $country1 = Country::orderBy('id' , 'asc')->get();

        // return view('auth.register' , compact('hashtags' , 'preferred_medium' , 'country'));
        return view('auth.register' , compact( 'preferred_medium_value' , 'country1'));
    }

    public function register(Request $request)
    {   
        if(empty($request->faebook_url)){
            if($request->file){
                $this->is_file = true;
            }else{
                return back()->withInput()->withAlert('Select Profile Image.');  
            }
        }else{
            $this->is_facebook = true;
        }
        // vv($request->all());
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        UserVerification::generate($user);
        UserVerification::send($user, 'Account varification Email');
        return back()->withAlert('Register successfully, please verify your email.');
    }
}