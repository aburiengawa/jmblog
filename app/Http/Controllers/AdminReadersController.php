<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminReadersController extends Controller
{
	public function __construct() 
	{
		$this->middleware('auth');
	}

    public function user_settings(User $user)
    {
    	if (auth()->user()->id !== $user->id) {
            return back()->withError("You trying to do something funny here, buddy?");
    		// return back()->withError('<p>Nice try, buddy!</p><p>You can only view the settings of your own account. 
    		// 	If you are authorized you can update users in the 
    		// 	<a href="' . route('admin') . '">Admin page</a></p>.');
    	}
        return view('admin.settings.user', compact('user'));
    }

   	public function update(Request $request, $id)
    {
    	if (auth()->user()->id !== $user->id) {
    		return back('/')->withError('<p>Think you can fool me? I' . "'" . 'm Laravel!</p><p>You can only update your own account via user settings</p>');
    	}
        $this->validate(request(), [
            'name'      => 'required|max:20',
            'email'     => 'required',
        ]);
        $user = User::findOrFail($id);
        if ($request->name !== $user->name) {
            $this->validate(request(), [
                'name' => 'unique:users'
            ]);
            $user->name = $request->name;
        }
        if ($request->email !== $user->email) {
            $this->validate(request(), [
                'email' => 'unique:users'
            ]);
            $user->email = $request->email;
        }
        $user->role_id = $request->role_id;
        $user->verified = $request->verified;
        if($request->password) {
        	$user->password = bcrypt($request->password);
        }
        $user->update();
        // session()->flash('message', 'User has been updated');
        return redirect('/admin')->withInfo('User has been updated');
    }        

    public function destroy($id)
    {
    	if (auth()->user()->id !== $user->id) {
    		return redirect('/')->withError('<p>You'."'".'re kidding, right?</p><p>You can only delete your own account via user settings, pal.</p>');
    	}
        $user = User::findOrFail($id);
        auth()->user()->whereId($id)->first()->delete();
        return redirect('/')->withInfo('User deleted');
    }  
}