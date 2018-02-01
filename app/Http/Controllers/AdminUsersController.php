<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth');
	}

    public function store(Request $request)
    {
        // dd($request);
        $this->validate(request(), [
            'name' => 'required|max:50',
            'email'  => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $input = $request->all(); 
        $input['password'] = bcrypt($request->password);
        $input['verified'] = 1;

        User::create($input);

        return redirect('/admin')->withInfo('The user has been created');

    }

    public function create()
    {
        return view('admin.users.create');    
    }

	public function index()
	{
		$users = User::orderBy('created_at', 'desc')->paginate(10);
		return view('admin.users.index', compact('users'));
	}

    public function edit(User $user)
    {
    	$roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        auth()->user()->whereId($id)->first()->delete();
        return redirect('/admin')->withInfo('User deleted');
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
        $user->role_id = $request->role_id;

        if($request->password) {
        	$user->password = bcrypt($request->password);
        }

        $user->update();

        // session()->flash('message', 'User has been updated');
        return redirect('/admin')->withInfo('User has been updated');
    }      

}
