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


Route::get('/viewprofile', 'ViewpageController@viewprofile');



Route::get('/add_facebook_page', 'ViewpageController@add_facebook_page');
Route::get('/add_youtube_page', 'ViewpageController@add_youtube_page');
Route::get('/add_instagram_page', 'ViewpageController@add_instagram_page');

Route::resource('facebook_page_resource', 'Facebook_pageController');
Route::resource('youtube_page_resource', 'Youtube_pageController');
Route::resource('instagram_page_resource', 'Instagram_pageController');

Route::resource('hashtags', 'HashtagsController');


// Route::get('/register', 'Auth\RegisterController@getRegister');

Route::get('finde_influencer_test', 'FindInfulencerController@finde_influencer_test');


Route::group(['middleware' => 'jobseeker_guest'], function() {
    // Route::get('/', function () {
    //     return view('frontend.welcome');
    // });
//    Route::post('search', 'SearchController@search');
    Route::get('/jobseeker_register', 'JobseekerAuth\RegisterController@showRegistrationForm');
    Route::post('/jobseeker_register', 'JobseekerAuth\RegisterController@register');
    Route::get('jobseeker_login', 'JobseekerAuth\LoginController@showLoginForm');
    Route::post('jobseeker_login', 'JobseekerAuth\LoginController@login');
    Route::get("/view-job/{token}", 'Jobseeker\JobseekerController@viewJob');
});

Route::group(['middleware' => 'jobseeker_auth'], function() {
    Route::get('/findinfulencer', 'FindInfulencerController@index');
    

    Route::get('/viewprofile_marketer', 'Profile_page_marketerController@viewprofile_marketer');
	// Route::get('/jobseeker_home', ['uses' => 'Jobseeker\JobseekerController@home']);
 //    Route::post('/submitCV',['uses' => 'Jobseeker\JobseekerController@submitCV'] );

    Route::get('/jobseeker_logout', 'JobseekerAuth\LoginController@logout');
 //    Route::get('jobseeker_search', 'Jobseeker\JobseekerController@search');
    
 //    Route::get('jobseeker_map', 'Jobseeker\JobseekerController@map');
 //    Route::get('job/{job_id}/apply', 'Jobseeker\JobseekerController@applyJob');
 //    Route::get('job/{job_id}/save', 'Jobseeker\JobseekerController@saveJob');
 //    Route::post('jobseeker/delete_license/{license_id}', 'Jobseeker\JobseekerController@deleteLicense');

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



Route::group(['prefix' => 'messages_marketer'], function () {
    Route::get('/', ['as' => 'messages_marketer', 'uses' => 'MessagesmarketerController@index']);
    Route::get('create', ['as' => 'messages_marketer.create', 'uses' => 'MessagesmarketerController@create']);
    Route::post('/', ['as' => 'messages_marketer.store', 'uses' => 'MessagesmarketerController@store']);
    Route::get('{id}', ['as' => 'messages_marketer.show', 'uses' => 'MessagesmarketerController@show']);
    Route::put('{id}', ['as' => 'messages_marketer.update', 'uses' => 'MessagesmarketerController@update']);
});


Route::group(['prefix' => 'messages_influencer'], function () {
    Route::get('/', ['as' => 'messages_influencer', 'uses' => 'MessagesinfluencerController@index']);
    Route::get('create', ['as' => 'messages_influencer.create', 'uses' => 'MessagesinfluencerController@create']);
    Route::post('/', ['as' => 'messages_influencer.store', 'uses' => 'MessagesinfluencerController@store']);
    Route::get('{id}', ['as' => 'messages_influencer.show', 'uses' => 'MessagesinfluencerController@show']);
    Route::put('{id}', ['as' => 'messages_influencer.update', 'uses' => 'MessagesinfluencerController@update']);
});