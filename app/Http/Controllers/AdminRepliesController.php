<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Comment;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

class AdminRepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom.auth');
    }
    public function index() 
    {
        if (auth()->user()->role_id === 1) {
            $replies = Reply::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.comments.replies.index', compact('replies'));
        }
        if(auth()->user()->role_id === 2 || auth()->user()->role_id === 3) {
            $userId = auth()->user()->id;
            $replies = Reply::where('user_id', '=', $userId)->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.comments.replies.index', compact('replies'));
        }     
    }
    public function store(Request $request) 
    {
        $reply = new Reply;
        if ($request->ajax()) {
            $this->validate(request(), [
                'comment_id' => 'required',
                'body'  => 'required|max:200'
            ]);
            $reply->user_id = auth()->user()->id;
            $reply->comment_id = $request->comment_id;
            $reply->body = $request->body;
            $reply->save();
            $reply_id = $reply->id;
            return $reply_id;
        } else {
            return ("Uh oh");
        }
    }
    public function showCommentReplies($id)
    {
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.comments.replies.show-comment-replies', compact('replies'));
    }
    public function destroy($id)
    {
        
    }
}
