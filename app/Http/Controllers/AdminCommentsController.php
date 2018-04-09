<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function index() 
    {
    	return view('admin.comments.index');
    }

}
