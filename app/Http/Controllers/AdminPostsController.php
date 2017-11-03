<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{

    public function store(Request $request)
    {
        // $this->validate(request(), [
        // 	'title' => 'required',
        // 	'body' 	=> 'required'
        // ]);

        if($file = $request->file('photo')) {
            $name = $file->getClientOriginalName();
            $file->move('photos/shares', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        // auth()->user()->publish(
        // 	new Post(request(['title', 'body']))
        // );
        // session()->flash('message', 'Your post has now been published');
        // return redirect('/admin');
        dd($request);
    }

    public function index() {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // public function summernote(Request $request)
    // {
    //     dd($request);
    // }

}
