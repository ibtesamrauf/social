<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\User;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
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
    public function index()
    {
        // return view('welcome');
        return view('welcome2');
    }
    

    public function facebook_test()
    {
        $fb = new \Facebook\Facebook([
          'app_id' => '717877275077234',
          'app_secret' => '495ca21fbdff25278903cc08ae2a48f3',
          'default_graph_version' => 'v2.10',
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
        $loginUrl = $helper->getLoginUrl('http://influence-laravel-theme.com/facebook_test_callback', $permissions);

        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
        if(Auth::guest()){
            v("guest");
        }else{
            v("login");
            v(Auth::user()->email);
        }
        vv(session()->all());
    }


    public function facebook_test_callback()
    {
        // try {
            
        
            $fb = new \Facebook\Facebook([
              'app_id' => '717877275077234',
              'app_secret' => '495ca21fbdff25278903cc08ae2a48f3',
              'default_graph_version' => 'v2.10',
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
            v($user);
            echo 'Email: ' . $user['email'];
            $profile_image_url = "https://graph.facebook.com/".$user['id']."/picture?type=large";

            $facebook_pages_data = file_get_contents("https://graph.facebook.com/v2.12/me/accounts?access_token=".$accessToken->getValue());
            // $facebook_pages_data = file_get_contents("https://graph.facebook.com/v2.12/me/accounts?access_token=EAACEdEose0cBAOVOOlxShOq7jY5ms2zUq87n6AuYk7d7ylFlwzV1ACL4mFD9enO42Dysr5goBNFRIeSrKwmPY7MM6CbZC1IHL9YlUUHHqgPIXX5SzJTnqXqiWYPssOPL5WZB3ld7DZCoUCi5FQcbHnahnQgnogjXfLcE53vd3jHiwMZCj0PpJ7cJHXAvPKbCrPB2VK5TsgZDZD");
            $facebook_pages_data = json_decode($facebook_pages_data);
            v($facebook_pages_data);
               

            if(empty($user['email'])){
                // return "no_email_found";
                return redirect('register')->with('alert', 'Email not found try again later or use another platform');
            }
            $authUser = User::where('provider_id', $user['id'])->orwhere('email',$user['email'])->first();
            v($authUser);
            if (!$authUser) 
            {
                $password_variable = 'influencer2';
                $user_created = User::create([
                    'first_name'          => $user['name'],
                    'email'               => $user['email'],
                    'provider'            => "facebook",
                    'provider_id'         => $user['id'],
                    'last_name'           => '',
                    'profile_picture'     => $profile_image_url,
                    'user_role'           => 'influencer',
                    'phone_number'        => '',
                    'country'             => '',
                    'title'               => '',
                    'faebook_url'         => '',
                    'instagram_url'       => '',
                    'youtube_url'         => '',
                    'twitter_url'         => '',
                    'soundcloud_url'      => '',
                    'website_blog'        => '',
                    'monthly_visitors'    => '',
                    'company_id'        => 1,
                    'verified'          => 1,
                    'company_name'      => 'no',
                    'password'          => bcrypt($password_variable),
                ]);

                \Mail::send('email.welcome_email', ['user' => $user_created , 'password_variable' => $password_variable], function ($m) use ($user_created) {
                    $m->to($user_created->email, $user_created->first_name)->subject('You have New massage!');
                });
                // Auth::login($user_created, true);
                auth()->loginUsingId($user_created->id);

            }else{
                Auth::login($authUser, true);
            }
            v(Auth::user()->email);
            if(Auth::guest()){
                v("guest");
            }else{
                v("login");
            }
            echo "<br><a href='/'>home</a>";
            // // vv($user);
            // $authUser = $this->findOrCreateUser($user, "facebook");
            // if($authUser == 'no_email_found'){
            //     return redirect('register')->with('alert', 'Email not found try again later or use another platform');
            // }
            // Auth::login($authUser, true);
            // // vv(Auth::user()->last_name);
            // if(empty(Auth::user()->last_name)){
            //     return redirect('update_profile_login_with_social')->with('status', 'Register Successfully, Now Update Your profile');
            // }else{
            //     return redirect($this->redirectTo);
            // }
           
        // } catch (\Exception $e) {
        //     return redirect('register')->with('alert', 'Something Wrong try again');
        // }
    }

    public function login_influencer($id)
    {
        $user_data = User::find($id);
        Auth::login($user_data, true);
        if(empty(Auth::user()->last_name)){
            return redirect('update_profile_login_with_social')->with('status', 'Register Successfully, Now Update Your profile');
        }else{
            return redirect('/');
        }
    }
        
}
