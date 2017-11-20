<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::orderBy('created_at', 'desc')->simplePaginate(5);
    	return view('welcome', compact('posts'));
    }

    public function show(Post $post)
    {
    	return view('post', compact('post'));
    }

    public function category($id)
    {
    	$category = Category::findOrFail($id);
    	return view('categories.index', compact('category'));
    }

}
