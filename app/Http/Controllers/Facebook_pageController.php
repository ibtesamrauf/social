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


class Facebook_pageController extends Controller
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
      
        return view('facebook.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // vv("create");
        return view('facebook.create');
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
        
        $facebook_url = explode("/", $request->page_url);
        if(empty(last($facebook_url))){
            unset($facebook_url[count($facebook_url) - 1]);
            $facebook_url = last($facebook_url);
        }else{
            $facebook_url = last($facebook_url);
        }
        // session(['facebook_url' => $facebook_url]);
        Session::put('facebook_url', $facebook_url);

        // $page_already_exist = Facebook_page_data::where("keyword" , $facebook_url)->first();
        // if($page_already_exist){
        //     return back()->with('status', 'Page already exist');
        // }
        // vv($facebook_url);
        $fb = new \Facebook\Facebook([
            'app_id' =>  env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => env('FACEBOOK_APP_default_graph_version'),
        ]);

        $helper = $fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) 
        { 
            $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
        }
        $permissions = ['manage_pages', 'publish_pages',
                'ads_management','pages_messaging','pages_show_list','read_custom_friendlists',
                'user_friends','email','user_photos','user_likes','user_posts',
                'user_videos','user_birthday']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://influence-laravel-theme.com/facebook_page_facebook_call_back_page_add', $permissions);
        header("Location:".$loginUrl);
        die;
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
        $facebook_page_data = Facebook_page_data::where('id' , $id)->get();
        return view('facebook.view_facebook_page' , compact('facebook_page_data'));
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
        return view('facebook.edit', compact('user'));
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
        // vv("here");
        Facebook_page_data::destroy($id);
        return redirect('viewprofile')->with('status', 'Facebook Page Deleted Succesfully!');
    }

    public function upload_youtube_video()
    {
        return view('upload_youtube_video');
    }

    public function facebook_page_facebook_call_back_page_add()
    {
        $user_id_variable = "";
        try {
            $fb = new \Facebook\Facebook([
                'app_id' =>  env('FACEBOOK_APP_ID'),
                'app_secret' => env('FACEBOOK_APP_SECRET'),
                'default_graph_version' => env('FACEBOOK_APP_default_graph_version'),
            ]);

            $helper = $fb->getRedirectLoginHelper();
            if (isset($_GET['state'])) 
            { 
                $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
            }
            try {
              $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }

            if (! isset($accessToken)) {
              if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
              } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
              }
              exit;
            }

            // Logged in
            echo '<h3>Access Token</h3>';
            var_dump($accessToken->getValue());

            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();

            // Get the access token metadata from /debug_token
            $tokenMetadata = $oAuth2Client->debugToken($accessToken);
            echo '<h3>Metadata</h3>';
            v($tokenMetadata);

            // Validation (these will throw FacebookSDKException's when they fail)
            $tokenMetadata->validateAppId('717877275077234');
            // If you know the user ID this access token belongs to, you can validate it here
            //$tokenMetadata->validateUserId('123');
            $tokenMetadata->validateExpiration();

            if (! $accessToken->isLongLived()) {
              // Exchanges a short-lived access token for a long-lived one
              try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
              } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
              }

              echo '<h3>Long-lived</h3>';
              var_dump($accessToken->getValue());
            }

            $_SESSION['fb_access_token'] = (string) $accessToken;

            // User is logged in with a long-lived access token.
            // You can redirect them to a members-only page.
            //header('Location: https://example.com/members.php');

            try {
              // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('/me?fields=id,name,email', $accessToken->getValue());
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }

            $user = $response->getGraphUser();
            // v($user);
            echo 'Email: ' . $user['email'];
            $facebook_url_var = Session::get('facebook_url');
            
            $url_2 = "https://graph.facebook.com/".$facebook_url_var."/?fields=name,likes,link,fan_count,picture&access_token=1942200009377124|2aa44fec0382b4d5715af57be82779d2";
            $response_2 = file_get_contents($url_2);
            
            $facebook_response = json_decode($response_2);
            // $facebook_response->id;

            // $profile_image_url = "https://graph.facebook.com/".$user['id']."/picture?type=large";     
            $facebook_pages_data = file_get_contents("https://graph.facebook.com/v2.12/me/accounts?access_token=".$accessToken->getValue());
            // $facebook_pages_data = file_get_contents("https://graph.facebook.com/v2.12/me/accounts?access_token=EAACEdEose0cBAOVOOlxShOq7jY5ms2zUq87n6AuYk7d7ylFlwzV1ACL4mFD9enO42Dysr5goBNFRIeSrKwmPY7MM6CbZC1IHL9YlUUHHqgPIXX5SzJTnqXqiWYPssOPL5WZB3ld7DZCoUCi5FQcbHnahnQgnogjXfLcE53vd3jHiwMZCj0PpJ7cJHXAvPKbCrPB2VK5TsgZDZD");
            $facebook_pages_data = json_decode($facebook_pages_data);  
            foreach ($facebook_pages_data->data as $key => $value) {
                v($value->id);
                v($facebook_response->id);

                if($value->id == $facebook_response->id){
                    $facebook_response_page_image = "https://graph.facebook.com/v2.11/".$facebook_url_var."/picture?type=large";
                    $count = Facebook_page_data::where('user_id', Auth::user()->id)->count();
                    // vv($count);
                    if($count > 4){
                        return redirect('viewprofile')->with('status', 'Max 5 Page limit');
                    }else{        
                        Facebook_page_data::create([
                                'user_id'           => Auth::user()->id,
                                'page_id'           => 0,
                                'name'              => $facebook_response->name,
                                'link'              => $facebook_response->link,
                                'keyword'           => $facebook_url_var,
                                'likes'             => $facebook_response->fan_count,
                                'image'             => $facebook_response_page_image,
                            ]);
                    }
                    
                    // return redirect('viewprofile')->with('status', 'Page Added Succesfully!');              
                    v("pass");
                }
            }
            // vv($facebook_pages_data);   
        }catch (\Exception $e) {
            return redirect('viewprofile')->with('status', 'Something Wrong try again');
        }
    }

    

}
