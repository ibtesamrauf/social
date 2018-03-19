<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Socialite;
use App\Facebook_page_data;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        // vv("asd");
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            // vv($user);
            $authUser = $this->findOrCreateUser($user, $provider);
            if($authUser == 'no_email_found'){
                return redirect('register')->with('alert', 'Email not found try again later or use another platform');
            }
            Auth::login($authUser, true);
            // vv(Auth::user()->last_name);
            if(empty(Auth::user()->last_name)){
                return redirect('update_profile_login_with_social')->with('status', 'Register Successfully, Now Update Your profile');
            }else{
                return redirect($this->redirectTo);
            }
        } catch (\Exception $e) {
            // return redirect('register')->with('alert', 'Something Wrong try again');
        }
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->orwhere('email',$user->email)->first();
        if ($authUser) {
            return $authUser;
        }
        if(empty($user->email)){
            return "no_email_found";
        }
        $password_variable = 'influencer2';
        $user_created = User::create([
            'first_name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'last_name'           => '',
            'profile_picture'     => $user->avatar_original,
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
        return $user_created;
    }


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->verified != 1) {
            $errors = [$this->username() => trans('auth.notactivated')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate() {
        if ( Auth::attempt( ['email' => $email, 'password' => $password, 'verified' => 1] ) ) {
            // Authentication passed...
            return redirect()->intended( '/' );
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // var_dump($request);
        // die;
        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
            'verified' => '1',
        ];
    }



    public function facebook_test_callback()
    {
        $user_id_variable = "";
        try {
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

            if(empty($user['email'])){
                // return "no_email_found";
                return redirect('register')->with('alert', 'Email not found try again later or use another platform');
            }
            $authUser = User::where('provider_id', $user['id'])->orwhere('email',$user['email'])->first();
            // v($authUser);
            if (!$authUser) 
            {
                // v("pass if");
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
                
                $user_id_variable = $user_created->id;

                $facebook_pages_data = file_get_contents("https://graph.facebook.com/v2.12/me/accounts?access_token=".$accessToken->getValue());
                // $facebook_pages_data = file_get_contents("https://graph.facebook.com/v2.12/me/accounts?access_token=EAACEdEose0cBAOVOOlxShOq7jY5ms2zUq87n6AuYk7d7ylFlwzV1ACL4mFD9enO42Dysr5goBNFRIeSrKwmPY7MM6CbZC1IHL9YlUUHHqgPIXX5SzJTnqXqiWYPssOPL5WZB3ld7DZCoUCi5FQcbHnahnQgnogjXfLcE53vd3jHiwMZCj0PpJ7cJHXAvPKbCrPB2VK5TsgZDZD");
                $facebook_pages_data = json_decode($facebook_pages_data);
                foreach ($facebook_pages_data->data as $key => $value) {
                    $url_2 = "https://graph.facebook.com/".$value->id."/?fields=name,likes,link,fan_count,picture&access_token=1942200009377124|2aa44fec0382b4d5715af57be82779d2";
                    $response_2 = file_get_contents($url_2);
                    
                    $facebook_response = json_decode($response_2);
                    $facebook_response_page_image = "https://graph.facebook.com/v2.11/".$value->id."/picture?type=large";
                    Facebook_page_data::create([
                            'user_id'           => $user_id_variable,
                            'page_id'           => 0,
                            'name'              => $facebook_response->name,
                            'link'              => $facebook_response->link,
                            'keyword'           => $value->id,
                            'likes'             => $facebook_response->fan_count,
                            'image'             => $facebook_response_page_image,
                        ]);
                }
            
                \Mail::send('email.welcome_email', ['user' => $user_created , 'password_variable' => $password_variable], function ($m) use ($user_created) {
                    $m->to($user_created->email, $user_created->first_name)->subject('You have New massage!');
                });
                // return redirect('login_influencer/'.$user_created->id); 
            }else{
                $user_id_variable = $authUser->id;
                // return redirect('login_influencer/'.$authUser->id); 
            }
            return redirect('login_influencer/'.$user_id_variable); 

        } catch (\Exception $e) {
            return redirect('register')->with('alert', 'Something Wrong try again');
        }
    }


}
