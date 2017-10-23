<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{

    public function store()
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
}
