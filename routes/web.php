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

Route::post('post/create', 'AdminPostsController@store');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/logout', 'HomeController@destroy');
