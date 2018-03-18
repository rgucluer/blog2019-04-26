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

// controller => PostsController
// Eloquent model => Post
// migration => create_posts_table


// ------------------------------------------------------------
// Front view
// ------------------------------------------------------------

// Main page
Route::get('/', 'PostsController@index')->name('home');

// List Posts
Route::get('/posts', 'PostsController@index');

// Get a single Post
Route::get('/posts/{post}', 'PostsController@show');



// ------------------------------------------------------------
// Manage
// ------------------------------------------------------------

// Blog Manage Page
Route::get('/'.config('app.management', 'manage'), 'ManageController@index')->name('manage');

// Get New Post Form
Route::get('/'.config('app.management', 'manage').'/posts/create', 'PostsController@create');

// Create a new post with given form data
Route::post('/'.config('app.management', 'manage').'/posts', 'PostsController@store');

// Get Posts list in manage view
Route::get('/'.config('app.management', 'manage').'/posts', 'ManageController@postslist');

// Get Login Form
Route::get('/'.config('app.management', 'manage').'/login', 'SessionsController@create')->name('login');

// Login to blog with given form data
Route::post('/'.config('app.management', 'manage').'/login', 'SessionsController@store');

// Logout from blog
// "post request would be better" 
Route::get('/'.config('app.management', 'manage').'/logout', 'SessionsController@destroy')->name('logout');