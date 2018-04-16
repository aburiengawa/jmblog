<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function index() 
    {
    	return view('admin.comments.index');
    }
    public function store(Request $request) 
    {
    	$comment = new Comment;
        $this->validate(request(), [
        	'post_id' => 'required',
        	'body' 	=> 'required|max:200'
        ]);
		$comment->user_id = auth()->user()->id;
		$comment->post_id = $request->post_id;
		$comment->body = $request->body;
    	dd($comment);
    }

}
