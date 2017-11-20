<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
        	'title' => 'required|max:100',
        	'body' 	=> 'required'
        ]);

        $input = $request->all(); 

        if($file = $request->file('photo')) {
            $name = $file->getClientOriginalName();
            $file->move('photos/shares', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        auth()->user()->posts()->create($input);

        session()->flash('message', 'Your post has now been published');
        return redirect('/admin');
        // dd($request);
    }

    public function index() {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // public function summernote(Request $request)
    // {
    //     dd($request);
    // }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }    

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'title' => 'required|max:100',
            'body'  => 'required'
        ]);

        $input = $request->all(); 

        if($file = $request->file('photo')) {
            $name = $file->getClientOriginalName();
            $file->move('photos/shares', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        auth()->user()->posts()->whereId($id)->first()->update($input);

        session()->flash('message', 'Your post has now been updated');
        return redirect('/admin');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->photo) {
            // dd(public_path());
            unlink(public_path() . "/photos/shares/" . $post->photo->file);
            Photo::findOrFail($post->photo_id)->delete();
        }
        auth()->user()->posts()->whereId($id)->first()->delete();
        return redirect('/admin');
    }   

}
