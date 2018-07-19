<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function tagIndex($id) {
    	$tag = Tag::findOrFail($id);
    	$posts = $tag->posts()->orderBy('created_at', 'desc')->simplePaginate(5);
		// $posts = Post::where('title', 'like', "%$s%")
		// 		->orWhere('body', 'like', "%$s%")
		// 		->paginate(5);
		// dd($posts);
		return view('tag.index', compact('tag', 'posts'));
	}		
}
