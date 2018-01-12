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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('/findinfulencer', 'FindInfulencerController@index');


Route::get('/test', 'ViewpageController@test');


Route::get('/viewprofile', 'ViewpageController@viewprofile');

Route::get('/add_facebook_page', 'ViewpageController@add_facebook_page');
Route::get('/add_youtube_page', 'ViewpageController@add_youtube_page');
Route::get('/add_instagram_page', 'ViewpageController@add_instagram_page');

Route::resource('facebook_page_resource', 'Facebook_pageController');
Route::resource('youtube_page_resource', 'Youtube_pageController');
Route::resource('instagram_page_resource', 'Instagram_pageController');


// Route::get('/register', 'Auth\RegisterController@getRegister');
