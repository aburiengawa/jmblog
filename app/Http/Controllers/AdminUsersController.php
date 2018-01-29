<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth');
	}

	public function index()
	{
		$users = User::orderBy('created_at', 'desc')->paginate(10);
		return view('admin.users.index', compact('users'));
	}

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        auth()->user()->whereId($id)->first()->delete();
        return redirect('/admin');
    }

   	public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|max:50',
            'email'  => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password) {
        	$user->password = bcrypt($request->password);
        }

        $user->update();

        session()->flash('message', 'User has been updated');
        return redirect('/admin');
    }      

}
