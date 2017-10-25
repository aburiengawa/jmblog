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

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $file->move('img', $name);
            $photo = Photo::create(['file'=>$name]);
        }

        auth()->user()->publish(
        	new Post(request(['title', 'body']))
        );
        session()->flash('message', 'Your post has now been published');
        return redirect('/admin');
    }
}
