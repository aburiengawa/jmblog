<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::orderBy('created_at', 'desc')->simplePaginate(5);
    	return view('welcome', compact('posts'));
    }
}
