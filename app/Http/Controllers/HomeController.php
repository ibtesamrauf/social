<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Session;
use App\Country;
use App\Preferred_medium;
use Illuminate\Support\Facades\Validator;
use Jrean\UserVerification\Facades\UserVerification as UserVerificationFacade;
use Jrean\UserVerification\Exceptions\UserNotFoundException;
use Jrean\UserVerification\Exceptions\UserIsVerifiedException;
use Jrean\UserVerification\Exceptions\TokenMismatchException;
use Illuminate\Mail\Mailer;
use Jrean\UserVerification\Traits\RedirectsUsers;
use Mail;
use App\User;
use App\Admin;
use App\Thread_marketer;
use App\Participant_marketer;
use Carbon\Carbon;

class HomeController extends Controller
{
    use RedirectsUsers;
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
        return view('home');
    }

    public function insert_country()
    {
        $data = array(
            array('country_name'=>'Afghanistan'),
            array('country_name'=>'Albania'),
            array('country_name'=>'Algeria'),
            array('country_name'=>'Andorra'),
            array('country_name'=>'Angola'),
            array('country_name'=>'Antigua & Deps'),
            array('country_name'=>'Argentina'),
            array('country_name'=>'Armenia'),
            array('country_name'=>'Australia'),
            array('country_name'=>'Austria'),
            array('country_name'=>'Azerbaijan'),
            array('country_name'=>'Bahamas'),
            array('country_name'=>'Bahrain'),
            array('country_name'=>'Bangladesh'),
            array('country_name'=>'Barbados'),
            array('country_name'=>'Belarus'),
            array('country_name'=>'Belgium'),
            array('country_name'=>'Belize'),
            array('country_name'=>'Benin'),
            array('country_name'=>'Bhutan'),
            array('country_name'=>'Bolivia'),
            array('country_name'=>'Bosnia Herzegovina'),
            array('country_name'=>'Botswana'),
            array('country_name'=>'Brazil'),
            array('country_name'=>'Brunei'),
            array('country_name'=>'Bulgaria'),
            array('country_name'=>'Burkina'),
            array('country_name'=>'Burundi'),
            array('country_name'=>'Cambodia'),
            array('country_name'=>'Cameroon'),
            array('country_name'=>'Canada'),
            array('country_name'=>'Cape Verde'),
            array('country_name'=>'Central African Rep'),
            array('country_name'=>'Chad'),
            array('country_name'=>'Chile'),
            array('country_name'=>'China'),
            array('country_name'=>'Colombia'),
            array('country_name'=>'Comoros'),
            array('country_name'=>'Congo'),
            array('country_name'=>'Costa Rica'),
            array('country_name'=>'Croatia'),
            array('country_name'=>'Cuba'),
            array('country_name'=>'Cyprus'),
            array('country_name'=>'Czech Republic'),
            array('country_name'=>'Denmark'),
            array('country_name'=>'Djibouti'),
            array('country_name'=>'Dominica'),
            array('country_name'=>'Dominican Republic'),
            array('country_name'=>'East Timor'),
            array('country_name'=>'Ecuador'),
            array('country_name'=>'Egypt'),
            array('country_name'=>'El Salvador'),
            array('country_name'=>'Equatorial Guinea'),
            array('country_name'=>'Eritrea'),
            array('country_name'=>'Estonia'),
            array('country_name'=>'Ethiopia'),
            array('country_name'=>'Fiji'),
            array('country_name'=>'Finland'),
            array('country_name'=>'France'),
            array('country_name'=>'Gabon'),
            array('country_name'=>'Gambia'),
            array('country_name'=>'Georgia'),
            array('country_name'=>'Germany'),
            array('country_name'=>'Ghana'),
            array('country_name'=>'Greece'),
            array('country_name'=>'Grenada'),
            array('country_name'=>'Guatemala'),
            array('country_name'=>'Guinea'),
            array('country_name'=>'Guinea-Bissau'),
            array('country_name'=>'Guyana'),
            array('country_name'=>'Haiti'),
            array('country_name'=>'Honduras'),
            array('country_name'=>'Hungary'),
            array('country_name'=>'Iceland'),
            array('country_name'=>'India'),
            array('country_name'=>'Indonesia'),
            array('country_name'=>'Iran'),
            array('country_name'=>'Iraq'),
            array('country_name'=>'Ireland'),
            array('country_name'=>'Israel'),
            array('country_name'=>'Italy'),
            array('country_name'=>'Ivory Coast'),
            array('country_name'=>'Jamaica'),
            array('country_name'=>'Japan'),
            array('country_name'=>'Jordan'),
            array('country_name'=>'Kazakhstan'),
            array('country_name'=>'Kenya'),
            array('country_name'=>'Kiribati'),
            array('country_name'=>'Korea North'),
            array('country_name'=>'Korea South'),
            array('country_name'=>'Kosovo'),
            array('country_name'=>'Kuwait'),
            array('country_name'=>'Kyrgyzstan'),
            array('country_name'=>'Laos'),
            array('country_name'=>'Latvia'),
            array('country_name'=>'Lebanon'),
            array('country_name'=>'Lesotho'),     
            array('country_name'=>'Liberia'),
            array('country_name'=>'Libya'),
            array('country_name'=>'Liechtenstein'),
            array('country_name'=>'Lithuania'),
            array('country_name'=>'Luxembourg'),
            array('country_name'=>'Macedonia'),
            array('country_name'=>'Madagascar'),
            array('country_name'=>'Malawi'),
            array('country_name'=>'Malaysia'),
            array('country_name'=>'Maldives'),
            array('country_name'=>'Mali'),
            array('country_name'=>'Malta'),
            array('country_name'=>'Marshall Islands'),
            array('country_name'=>'Mauritania'),
            array('country_name'=>'Mauritius'),
            array('country_name'=>'Mexico'),
            array('country_name'=>'Micronesia'),
            array('country_name'=>'Moldova'),
            array('country_name'=>'Monaco'),
            array('country_name'=>'Mongolia'),
            array('country_name'=>'Montenegro'),
            array('country_name'=>'Morocco'),
            array('country_name'=>'Mozambique'),
            array('country_name'=>'Myanmar, {Burma}'),
            array('country_name'=>'Namibia'),
            array('country_name'=>'Nauru'),
            array('country_name'=>'Nepal'),
            array('country_name'=>'Netherlands'),
            array('country_name'=>'New Zealand'),
            array('country_name'=>'Nicaragua'),
            array('country_name'=>'Niger'),
            array('country_name'=>'Nigeria'),
            array('country_name'=>'Norway'),
            array('country_name'=>'Oman'),
            array('country_name'=>'Pakistan'),
            array('country_name'=>'Palau'),
            array('country_name'=>'Panama'),
            array('country_name'=>'Papua New Guinea'),
            array('country_name'=>'Paraguay'),
            array('country_name'=>'Peru'),
            array('country_name'=>'Philippines'),
            array('country_name'=>'Poland'),
            array('country_name'=>'Portugal'),
            array('country_name'=>'Qatar'),
            array('country_name'=>'Romania'),
            array('country_name'=>'Russian Federation'),
            array('country_name'=>'Rwanda'),
            array('country_name'=>'St Kitts & Nevis'),      
            array('country_name'=>'St Lucia'),
            array('country_name'=>'Saint Vincent & the Grenadines'),
            array('country_name'=>'Samoa'),
            array('country_name'=>'San Marino'),
            array('country_name'=>'Sao Tome & Principe'),
            array('country_name'=>'Saudi Arabia'),
            array('country_name'=>'Senegal'),
            array('country_name'=>'Serbia'),
            array('country_name'=>'Seychelles'),
            array('country_name'=>'Sierra Leone'),
            array('country_name'=>'Singapore'),
            array('country_name'=>'Slovakia'),
            array('country_name'=>'Slovenia'),
            array('country_name'=>'Solomon Islands'),
            array('country_name'=>'Somalia'),
            array('country_name'=>'South Africa'),
            array('country_name'=>'South Sudan'),
            array('country_name'=>'Spain'),
            array('country_name'=>'Sri Lanka'),
            array('country_name'=>'Sudan'),
            array('country_name'=>'Suriname'),
            array('country_name'=>'Swaziland'),
            array('country_name'=>'Sweden'),
            array('country_name'=>'Switzerland'),
            array('country_name'=>'Syria'),
            array('country_name'=>'Taiwan'),
            array('country_name'=>'Tajikistan'),
            array('country_name'=>'Tanzania'),
            array('country_name'=>'Thailand'),
            array('country_name'=>'Togo'),
            array('country_name'=>'Tonga'),
            array('country_name'=>'Trinidad & Tobago'),
            array('country_name'=>'Tunisia'),
            array('country_name'=>'Turkey'),
            array('country_name'=>'Turkmenistan'),
            array('country_name'=>'Tuvalu'),
            array('country_name'=>'Uganda'),
            array('country_name'=>'Ukraine'),
            array('country_name'=>'United Arab Emirates'),
            array('country_name'=>'United Kingdom'),
            array('country_name'=>'United States'),
            array('country_name'=>'Uruguay'),
            array('country_name'=>'Uzbekistan'),
            array('country_name'=>'Vanuatu'),
            array('country_name'=>'Vatican City'),
            array('country_name'=>'Venezuela'),
            array('country_name'=>'Vietnam'),
            array('country_name'=>'Yemen'),
            array('country_name'=>'Zambia'),
            array('country_name'=>'Zambia'),
        );

        Country::insert($data);


        $data2 = array(
            array('preferred_medium_title'  =>  'Recorded Video'),
            array('preferred_medium_title'  =>  'Live Video'),
            array('preferred_medium_title'  =>  'Photos'),
            array('preferred_medium_title'  =>  'Blog Posts'),
            array('preferred_medium_title'  =>  'Podcast'),
            array('preferred_medium_title'  =>  'Tweets / Comments'),
            array('preferred_medium_title'  =>  'Long Form Articles'),
            array('preferred_medium_title'  =>  'Long Form Articles'),
            array('preferred_medium_title'  =>  'Others'),
            );
        
        Preferred_medium::insert($data2);

    }
    
    public function email_verifications(Request $request, $token)
    {

        if (! $this->validateRequest($request)) {
            return redirect($this->redirectIfVerificationFails());
        }

        try {
            // $user = UserVerificationFacade::process($request->input('email'), $token, $this->userTable());
            $user = UserVerificationFacade::process($request->input('email'), $token, $request->input('table'));
        } catch (UserNotFoundException $e) {
            return redirect($this->redirectIfVerificationFails());
        } catch (UserIsVerifiedException $e) {
            return redirect($this->redirectIfVerified());
        } catch (TokenMismatchException $e) {
            return redirect($this->redirectIfVerificationFails());
        }

        if (config('user-verification.auto-login') === true) {
            if($request->input('table') == 'users'){
                auth()->loginUsingId($user->id);
            }else{
                auth()->guard('jobseeker')->loginUsingId($user->id);
            }   
        }

        return redirect($this->redirectAfterVerification());


        // vv("ponka");

        // $user = $this->getUserByEmail($email, $userTable);

        // unset($user->{"password"});

        // // Check if the given user is already verified.
        // // If he is, we stop here.
        // $this->isVerified($user);

        // $this->verifyToken($user->verification_token, $token);

        // $this->wasVerified($user);

        // return $user;
    }


     /**
     * Validate the verification link.
     *
     * @param  string  $token
     * @return bool
     */
    protected function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        return $validator->passes();
    }

    /**
     * Get the user by e-mail.
     *
     * @param  string  $email
     * @param  string  $table
     * @return stdClass
     *
     * @throws \Jrean\UserVerification\Exceptions\UserNotFoundException
     */
    protected function getUserByEmail($email, $table)
    {
        $user = DB::table($table)
            ->where('email', $email)
            ->first();

        if ($user === null) {
            throw new UserNotFoundException();
        }

        $user->table = $table;

        return $user;
    }


    /**
     * Check if the given user is verified.
     *
     * @param  stdClass  $user
     * @return void
     *
     * @throws \Jrean\UserVerification\Exceptions\UserIsVerifiedException
     */
    protected function isVerified($user)
    {
        if ($user->verified == true) {
            throw new UserIsVerifiedException();
        }
    }


    /**
     * Compare the two given tokens.
     *
     * @param  string  $storedToken
     * @param  string  $requestToken
     * @return void
     *
     * @throws \Jrean\UserVerification\Exceptions\TokenMismatchException
     */
    protected function verifyToken($storedToken, $requestToken)
    {
        if ($storedToken != $requestToken) {
            throw new TokenMismatchException();
        }
    }


    /**
     * Update and save the given user as verified.
     *
     * @param  stdClass  $user
     * @return void
     */
    protected function wasVerified($user)
    {
        $user->verification_token = null;

        $user->verified = true;

        $this->updateUser($user);

        event(new UserVerified($user));
    }

    public function messages_count_influencer()
    {
        return view('messenger_influencer.unread-count');
    }

    public function messages_count_marketer()
    {
        return view('messenger_marketer.unread-count');
    }

    public function email_test()
    {
        $user = User::findOrFail(2);

        \Mail::send('email.new_messages', ['user' => $user], function ($m) use ($user) {
            // $m->from('hello@app.com', 'Your Application');
            $m->to($user->email, $user->name)->subject('You have New massage!');
        });
    }

    public function test_for_unread_email()
    {
        $users = Participant_marketer::where('unread' , 1)
                                    ->where('user_type' , 'influencer')
                                    ->get();
        
        foreach ($users as $key => $value) {
            $temp_create_at = $value->created_at;
            $created_at_user_two_hours = $value->created_at->addHour(2);
            $created_at_user_three_hours = $temp_create_at->addHour(2)->addMinute();
            // v(Carbon::now());
            // v($created_at_user_two_hours);
            // v($created_at_user_three_hours);

            if(Carbon::now() > $created_at_user_two_hours){
                if(Carbon::now() > $created_at_user_three_hours){

                }else{
                    $user = User::findOrFail($value->user_id);
                    $admin_marketer = Participant_marketer::where('thread_id' , $value->thread_id)
                                        ->where('user_type' , 'marketer')
                                        ->first();  
                    $admin = Admin::findOrFail($admin_marketer->user_id);

                    \Mail::send('email.new_messages', ['user' => $user , 'admin' => $admin], function ($m) use ($user) {
                        $m->to($user->email, $user->name)->subject('You have New massage!');
                    });
                }
            }
        }
    }
    
}
