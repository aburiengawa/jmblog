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

Route::get('/', 'PostsController@index');

Route::get('/post', function() {
	return view('post');
});

Route::get('/post/create', function() {
	return view('admin.posts.create');
});

// Route::get('/post/createsummer', function() {
// 	return view('admin.posts.createsummer');
// });

Route::get('/post/{post}', 'PostsController@show');

Route::post('post/create', 'AdminPostsController@store');
// Route::post('post/create', 'AdminPostsController@test');
// Route::post('post/createsummer', 'AdminPostsController@summernote');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/logout', 'AdminController@destroy');
