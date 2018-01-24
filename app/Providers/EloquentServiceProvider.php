<?php

namespace App\Providers;

use App\User;
use App\Events\UserRegistered;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        User::created(function($user) {
            $token = $user->verificationToken()->create([
                'token' => bin2hex(random_bytes(64))
            ]);
            event(new UserRegistered($user));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
