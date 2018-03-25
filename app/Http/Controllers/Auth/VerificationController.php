<?php

namespace App\Http\Controllers\Auth;

use App\VerificationToken;
use App\User;
use Auth;

use App\Http\Controllers\Controller;
use App\Events\UserRequestedVerificationEmail;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(VerificationToken $token)
    {
        $token->user()->update(['verified' => true]);
 
        $token->delete();
 
        // Uncomment the following lines if you want to login the user 
        // directly upon email verification
        // Auth::login($token->user);
        // return redirect('/home');
     
        return redirect('/login')->withInfo('Email verification successful. Please login again');
    }
 
    public function resend(Request $request)
    {
        $user = User::byEmail($request->email)->firstOrFail();
 
        if($user->hasVerifiedEmail()) {
            return redirect('/home');
        }
     
        event(new UserRequestedVerificationEmail($user));
     
        return redirect('/login')->withInfo('Verification email resent. Please check your inbox');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function show(VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function edit(VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VerificationToken  $verificationToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationToken $verificationToken)
    {
        //
    }
}
