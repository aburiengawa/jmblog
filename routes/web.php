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
//Home page
Route::get('/', 'PostsController@index');
//Categories
Route::get('/categories', 'CategoriesController@index');
Route::get('/category/{id}', 'CategoriesController@categoryIndex');
//Tags
Route::get('tag/{id}', 'TagsController@tagIndex');
// Search
Route::get('search/{s?}', 'SearchesController@getIndex')->where('s', '[\w\d]+');
//Admin post routes
Route::get('/posts/create', 'AdminPostsController@create');
Route::get('posts/edit/{post}', 'AdminPostsController@edit');
Route::patch('posts/edit/{post}', 'AdminPostsController@update')->name('update');
Route::delete('posts/edit/{post}', 'AdminPostsController@destroy');
Route::post('posts/create', 'AdminPostsController@store');
Route::get('/posts/index', 'AdminPostsController@index');
//Show post
Route::get('/post/{post}', 'PostsController@show');
Route::get('/getcomments', 'PostsController@getcomments');
//Admin comments routes
Route::get('comments/index', 'AdminCommentsController@index');
Route::get('/post/comments/{id}', 'AdminCommentsController@showPostComments');
// Route::get('comments/edit/{comment}', 'AdminCommentsController@edit');
Route::get('comments/edit/{comment}', 'AdminCommentsController@edit');
Route::patch('comments/edit/{comment}', 'AdminCommentsController@update');
Route::delete('comments/edit{comment}', 'AdminCommentsController@destroy');
//Comment store
Route::post('comments/create', 'AdminCommentsController@store');
//Delete comments from post
Route::delete('post-comment/delete', 'PostsController@destroyComment');
//Admin comment replies
Route::get('replies/index', 'AdminRepliesController@index');
Route::get('/comment/replies/{id}', 'AdminRepliesController@showCommentReplies');
Route::get('replies/edit/{reply}', 'AdminRepliesController@edit');
Route::patch('replies/edit/{reply}', 'AdminRepliesController@update');
Route::delete('replies/edit/{reply}', 'AdminRepliesController@destroy');
//Reply store
Route::post('replies/create', 'AdminRepliesController@store');
//Delete replies from post
Route::delete('post-reply/delete', 'PostsController@destroyReply');
//User routes
Route::get('/users/index', 'AdminUsersController@index');
Route::get('users/create', 'AdminUsersController@create');
Route::post('users/create', 'AdminUsersController@store');
Route::get('/users/edit/{user}', 'AdminUsersController@edit');
Route::patch('/users/edit/{user}', 'AdminUsersController@update')->name('update_user');
Route::delete('/users/edit/{user}', 'AdminUsersController@destroy');
//User settings
Route::get('admin/user-settings/{user}', 'AdminReadersController@user_settings');
Route::delete('/admin/user-settings/{user}', 'AdminReadersController@destroy');
Route::patch('admin/user-settings/{user}', 'AdminReadersController@update')->name('update_from_settings');

//Show posts by category
Route::get('/posts/category/{category}', 'PostsController@category');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::resource('admin/categories', 'AdminCategoriesController', ['names' => [
	'index' => 'admin.categories.index',
	'edit' => 'admin.categories.edit',
	'update' => 'admin.categories.update',
	'store' => 'admin.categories.store',
	'destroy' => 'admin.categories.destroy'
]]);

// Route::get('admin/categories', 'AdminCategoriesController@index');
// Route::get('admin/categories/{category}', 'AdminCategoriesController@edit');
// Route::patch('admin/categories/{category}', 'AdminCategoriesController@update');
// Route::post('admin/categories', 'AdminCategoriesController@store');
// Route::delete('admin/categories', 'AdminCategoriesController@destroy');

Route::get('admin/tags', 'AdminTagsController@index');
Route::post('admin/tags', 'AdminTagsController@store');
Route::get('admin/tags/{tag}', 'AdminTagsController@edit');
Route::patch('admin/tags/{tag}', 'AdminTagsController@update');
Route::delete('admin/tags', 'AdminTagsController@destroy');

Route::get('/verify/token/{token}', 'Auth\VerificationController@verify')->name('auth.verify'); 
Route::get('/verify/resend', 'Auth\VerificationController@resend')->name('auth.verify.resend');

Route::get('about', function() {
	return view('about');
});

Route::get('/logout', 'AdminController@destroy');
