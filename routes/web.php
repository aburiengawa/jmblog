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
Route::get('/posts/create', function() {
	return view('admin.posts.create');
});
Route::get('posts/edit/{post}', 'AdminPostsController@edit');

Route::post('posts/create', 'AdminPostsController@store');
Route::post('posts/edit/{post}', 'AdminPostsController@update');

Route::get('/posts/index', 'AdminPostsController@index');
Route::get('/post/{post}', 'PostsController@show');




Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/logout', 'AdminController@destroy');
