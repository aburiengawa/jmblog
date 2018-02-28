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
    		return redirect('/')->withError('You can only view the settings of your own account');
    	}
        return view('admin.settings.user', compact('user'));
    }

   	public function update(Request $request, $id)
    {
    	if (auth()->user()->id !== $user->id) {
    		return redirect('/')->withError('You can only update your own account via user settings');
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
    		return redirect('/')->withError('You can only delete your own account via user settings');
    	}
        $user = User::findOrFail($id);
        auth()->user()->whereId($id)->first()->delete();
        return redirect('/')->withInfo('User deleted');
    }  
}