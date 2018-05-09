<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    	$posts = Post::whereIn('category_id', $category)->orderBy('created_at', 'desc')->simplePaginate(5);
    	return view('categories.index', compact('category', 'posts'));
    }
    public function getcomments(Request $request) 
    {
        $id = $request->id;
        $post = Post::findOrFail($id);
        $comments = $post->comments;
        foreach ($comments as &$comment) {
            $comment->created_at = $comment->created_at->diffForHumans();
        }
        return compact('comments');
    }

}
