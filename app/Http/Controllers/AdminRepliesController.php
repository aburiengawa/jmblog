<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

class AdminRepliesController extends Controller
{
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
        } else {
            return ("Uh oh");
        }
    }
}
