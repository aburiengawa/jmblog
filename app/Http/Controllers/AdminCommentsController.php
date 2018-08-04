<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
// use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom.auth');
    }
    public function index()
    {
    	if (auth()->user()->role_id === 1) {
            $comments = Comment::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.comments.index', compact('comments'));
        }
        if(auth()->user()->role_id === 2 || auth()->user()->role_id === 3) {
            $userId = auth()->user()->id;
            $comments = Comment::where('user_id', '=', $userId)->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.comments.index', compact('comments'));
        }     
    }
    public function showPostComments($id) {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.comments.show-post-comments', compact('comments'));
    }
    public function store(Request $request) 
    {
    	$comment = new Comment;
    	if ($request->ajax()) {
	        $this->validate(request(), [
	        	'post_id' => 'required',
	        	'body' 	=> 'required|max:200'
	        ]);
			$comment->user_id = auth()->user()->id;
			$comment->post_id = $request->post_id;
			$comment->body = $request->body;
	    	$comment->save();
	    	$comment_id = $comment->id;
	    	return $comment_id;
    	}
    }
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'body'  => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->body = $request->body;
        $comment->update();

        return redirect('/admin')->withInfo('Your comment has been updated');
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (auth()->user()->role_id === 1) {
            $comment->delete();
        } else {
            auth()->user()->comments()->whereId($id)->first()->delete();
        }        
        return redirect('/comments/index')->withInfo('Your comment has been deleted');
    }       
}
