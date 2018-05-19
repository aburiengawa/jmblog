<?php

namespace App\Http\Controllers;

use App\Post;
use App\Reply;
use App\Comment;
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
    public function destroyComment(Request $request)
    {
        $id = $request->id;
        $comment = Comment::findOrFail($id);
        $role_id = auth()->user()->role_id;
        if ($role_id === 1) {
            $comment->delete();
            return "Comment delete success";
        } else if ($role_id === 2 || $role_id === 3) {
            auth()->user()->comments()->whereId($id)->first()->delete();
            return "Comment delete success";
        } else {
            return "Comment not deleted";
        }     
    }
    public function destroyReply(Request $request)
    {
        $id = $request->id;
        $reply = Reply::findOrFail($id);
        $role_id = auth()->user()->role_id;
        if ($role_id === 1) {
            $reply->delete();
            return "Reply delete success";
        } else if ($role_id === 2 || $role_id === 3) {
            auth()->user()->replies()->whereId($id)->first()->delete();
            return "Reply delete success";
        } else {
            return "Reply not deleted";
        }        
    }
}
