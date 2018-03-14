<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'WelcomeController@index')->name('home');

// Route::get('/', 'WelcomeController@index')->name('home');

Route::get('/home', 'WelcomeController@index')->name('home');
// Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();


// Route::get('/buildpage', 'BuildpageController@index');

// Route::post('/buildpage_form', 'BuildpageController@buildpage_form');

// Route::get('/editpage/{id}', 'BuildpageController@editpage');


Route::resource('buildpages', 'BuildpagesController');


Route::get('/upload_youtube_video', 'BuildpagesController@upload_youtube_video');

Route::post('/number_of_videos', 'BuildpagesController@number_of_videos');

Route::get('/viewpage', 'ViewpageController@index');

// view pages of follows {facebook, youtube and instagram}
Route::get('/view_facebook_page/{id}', 'ViewpageController@view_facebook_page');
Route::get('/view_youtube_page/{id}', 'ViewpageController@view_youtube_page');
Route::get('/view_instagram_page/{id}', 'ViewpageController@view_instagram_page');
//end

Route::get('/viewpagelist', 'ViewpageController@viewpagelist');


Route::get('/delete_youtube_video/{youtube_video_id}/{id}', 'ViewpageController@delete_youtube_video');

// Route::get('/findinfulencer', 'FindInfulencerController@index');


Route::get('/test', 'ViewpageController@test');


// profile Show and edit -- START


Route::get('/viewprofile', 'ViewpageController@viewprofile');
Route::get('/editprofile', 'ViewpageController@editprofile');

Route::post('/editprofile_post', 'ViewpageController@editprofile_post');

Route::get('/users_preferred_medium_add/{preferred_medium_id}', 'ViewpageController@users_preferred_medium_add');
Route::get('/users_preferred_medium_remove/{user_preferred_medium_table_id}', 'ViewpageController@users_preferred_medium_remove');

Route::get('/edit_previous_campaign/{previous_campaign_id}', 'ViewpageController@edit_previous_campaign');
Route::post('/edit_previous_campaign_update/{id}', 'ViewpageController@edit_previous_campaign_update');

Route::get('/delete_previous_campaign/{previous_campaign_id}', 'ViewpageController@delete_previous_campaign');

Route::get('/edit_portfolio/{portfolio}', 'ViewpageController@edit_portfolio');
Route::post('/edit_portfolio_update/{id}', 'ViewpageController@edit_portfolio_update');

Route::get('/delete_portfolio/{portfolio}', 'ViewpageController@delete_portfolio');

// profile Show and edit -- END



Route::get('/add_facebook_page', 'ViewpageController@add_facebook_page');
Route::get('/add_youtube_page', 'ViewpageController@add_youtube_page');
Route::get('/add_instagram_page', 'ViewpageController@add_instagram_page');

Route::resource('facebook_page_resource', 'Facebook_pageController');
Route::resource('youtube_page_resource', 'Youtube_pageController');
Route::resource('instagram_page_resource', 'Instagram_pageController');
Route::resource('twitter_page_resource', 'Twitter_pageController');

Route::resource('hashtags', 'HashtagsController');


// Route::get('/register', 'Auth\RegisterController@getRegister');

Route::get('finde_influencer_test', 'FindInfulencerController@finde_influencer_test');


    Route::get('/viewprofile_from_find_influencer/{user_id}', 'FindInfulencerController@viewprofile_from_find_influencer');
Route::group(['middleware' => 'jobseeker_guest'], function() {
    

    Route::get('/jobseeker_register', 'JobseekerAuth\RegisterController@showRegistrationForm');
    Route::post('/jobseeker_register', 'JobseekerAuth\RegisterController@register');
    Route::get('jobseeker_login', 'JobseekerAuth\LoginController@showLoginForm');
    Route::post('jobseeker_login', 'JobseekerAuth\LoginController@login');
    Route::get("/view-job/{token}", 'Jobseeker\JobseekerController@viewJob');
});

Route::group(['middleware' => 'jobseeker_auth'], function() {
    Route::get('/findinfulencer', 'FindInfulencerController@index');
    Route::get('/viewprofile_marketer', 'Profile_page_marketerController@viewprofile_marketer');
    Route::get('/jobseeker_logout', 'JobseekerAuth\LoginController@logout');

    //messages from marketer
    Route::group(['prefix' => 'messages_marketer'], function () {
            Route::get('/', ['as' => 'messages_marketer', 'uses' => 'MessagesmarketerController@index']);
            Route::get('{belongsto1}/create', ['as' => 'messages_marketer.create', 'uses' => 'MessagesmarketerController@create']);
            Route::post('/', ['as' => 'messages_marketer.store', 'uses' => 'MessagesmarketerController@store']);
            Route::get('{belongsto1}/{id}', ['as' => 'messages_marketer.show', 'uses' => 'MessagesmarketerController@show']);
            Route::put('{id}', ['as' => 'messages_marketer.update', 'uses' => 'MessagesmarketerController@update']);
    });

    Route::get('/messages_marketer_show_ajax/{belongsto1}/{id}', 'MessagesmarketerController@messages_marketer_show_ajax');
    
    Route::get('/editprofile_marketer', 'Profile_page_marketerController@editprofile_marketer');

    Route::post('/editprofile_marketer_post', 'Profile_page_marketerController@editprofile_marketer_post');


    Route::get('/edit_previous_campaign_marketer/{previous_campaign_id}', 'Profile_page_marketerController@edit_previous_campaign_marketer');
    Route::post('/edit_previous_campaign_update_marketer/{id}', 'Profile_page_marketerController@edit_previous_campaign_update_marketer');

    Route::get('/delete_previous_campaign_marketer/{previous_campaign_id}', 'Profile_page_marketerController@delete_previous_campaign_marketer');
    
    Route::get('/update_profile_login_with_social_marketer', 'Profile_page_marketerController@update_profile_login_with_social_marketer');
    Route::post('/update_profile_login_with_social_marketer_post', 'Profile_page_marketerController@update_profile_login_with_social_marketer_post');


});

// insert data i  countery table
Route::get('/insert_data', 'HomeController@insert_country');

Route::get('/email-verifications.custom/{token}', 'HomeController@email_verifications');

//messages
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});



Route::group(['prefix' => 'messages_influencer'], function () {
    Route::get('/', ['as' => 'messages_influencer', 'uses' => 'MessagesinfluencerController@index']);
    Route::get('create', ['as' => 'messages_influencer.create', 'uses' => 'MessagesinfluencerController@create']);
    Route::post('/', ['as' => 'messages_influencer.store', 'uses' => 'MessagesinfluencerController@store']);
    Route::get('{id}', ['as' => 'messages_influencer.show', 'uses' => 'MessagesinfluencerController@show']);
    Route::put('{id}', ['as' => 'messages_influencer.update', 'uses' => 'MessagesinfluencerController@update']);
});
Route::get('/messages_influencer_show_ajax/{id}', 'MessagesinfluencerController@messages_influencer_show_ajax');


Route::get('/messages_count_influencer', 'HomeController@messages_count_influencer');
Route::get('/messages_count_marketer', 'HomeController@messages_count_marketer');


Route::get('/email_test', 'HomeController@email_test');


Route::get('/test_for_unread_email', 'HomeController@test_for_unread_email');

// for social login and register
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
// for social login and register

// for social login and register marketer
Route::get('auth_marketer/{provider}', 'JobseekerAuth\LoginController@redirectToProvider_marketer');
Route::get('auth_marketer/{provider}/callback', 'JobseekerAuth\LoginController@handleProviderCallback_marketer');
// for social login and register marketer


Route::get('/update_profile_login_with_social', 'ViewpageController@update_profile_login_with_social');
Route::post('/update_profile_login_with_social_post', 'ViewpageController@update_profile_login_with_social_post');




