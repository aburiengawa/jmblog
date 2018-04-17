<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

class AdminRepliesController extends Controller
{
    public function store(Request $request) {
    	$reply = new Reply;
    	$this->validate(request(), [
    		'comment_id' => 'required',
    		'body' => 'required|max:200'
    	]);
    	$reply->user_id = auth()->user()->id;
    	$reply->comment_id = $request->comment_id;
    	$reply->body = $request->body;
    	$reply->save();
        return back()->withInfo('Your reply has been published');
    }
}
