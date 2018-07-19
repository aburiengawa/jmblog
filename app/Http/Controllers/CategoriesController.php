<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
		$categories = Category::orderBy('name', 'desc')->simplePaginate(5);
		return view('categories.index', compact('categories'));
	}
    public function categoryIndex($id) {
    	$category = Category::findOrFail($id);
    	$posts = $category->posts()->orderBy('created_at', 'desc')->simplePaginate(5);
		// $posts = Post::where('title', 'like', "%$s%")
		// 		->orWhere('body', 'like', "%$s%")
		// 		->paginate(5);
		// dd($posts);
		return view('categories.category.index', compact('category', 'posts'));
	}		
}
