<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchesController extends Controller
{
	public function getIndex( Request $request ) {
		$s = $request->query('s');
		
		// Query and paginate result
		$posts = Post::where('title', 'like', "%$s%")
				->orWhere('body', 'like', "%$s%")
				->paginate(5);
		// dd($posts);
		return view('search.index', ['posts' => $posts, 's' => $s ]);
	}
}
