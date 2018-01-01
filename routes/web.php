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

Route::get('/buildpage', 'BuildpageController@index');

Route::post('/buildpage_form', 'BuildpageController@buildpage_form');

Route::get('/editpage/{id}', 'BuildpageController@editpage');


Route::get('/upload_youtube_video', 'BuildpageController@upload_youtube_video');

Route::post('/number_of_videos', 'BuildpageController@number_of_videos');

Route::get('/viewpage', 'ViewpageController@index');

Route::get('/delete_youtube_video/{youtube_video_id}/{id}', 'ViewpageController@delete_youtube_video');

Route::get('/findinfulencer', 'FindInfulencerController@index');


