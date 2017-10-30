<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{

    public function store(Request $request)
    {
        $this->validate(request(), [
        	'title' => 'required',
        	'body' 	=> 'required'
        ]);

        auth()->user()->publish(
        	new Post(request(['title', 'body']))
        );
        session()->flash('message', 'Your post has now been published');
        return redirect('/admin');
    }

    public function test(Request $request)
    {
        dd($request);
        // $body = $request['body'];
        // return view('output', compact('body'));
    }

    public function summernote(Request $request)
    {
        dd($request);
    }

}
