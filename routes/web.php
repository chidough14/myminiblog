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

Route::get('getposts', 'PostsController@index');
Route::post('addpost', 'PostsController@store');
Route::get('getsinglepost/{id}', 'PostsController@singlepost');
Route::get('getloggedinuser', 'HomeController@getloggedinuser');
Route::get('getpost/{id}', 'PostsController@getEditPost');
Route::patch('updatepost/{id}', 'PostsController@updatepost');
Route::post('likepost', 'LikeController@likepost');
Route::post('unlikepost', 'LikeController@unlikepost');
Route::get('getlikes/{id}', 'LikeController@getlikes');
Route::get('checklikes/{id}', 'LikeController@checklikes');
Route::get('getuser/{id}', 'HomeController@getuser');
Route::get('getuserposts/{id}', 'PostsController@getuserposts');
Route::post('saveimage', 'HomeController@saveimage');
Route::post('followuser', 'FollowController@followuser');
Route::get('checkfollowed/{id}', 'FollowController@checkfollowed');
Route::get('unfollowuser/{id}', 'FollowController@unfollowuser');
Route::post('sharepost', 'ShareController@sharepost');
Route::get('checkshared/{id}', 'ShareController@checkshared');
Route::get('unsharepost/{id}', 'ShareController@unsharepost');
Route::get('getfollow/{id}', 'FollowController@getfollow');
