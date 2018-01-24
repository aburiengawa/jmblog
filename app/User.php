<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function publish(Post $post)
    {
        $this->posts()->save($post);
    }
    
    public function role() 
    {
        return $this->belongsTo(Role::class);
    } 

    public function verificationToken()
    {
    return $this->hasOne(VerificationToken::class);
    }

    public function hasVerifiedEmail()
    {
        return $this->verified;
    }
    public static function byEmail($email)
    {
        return static::where('email', $email);
    }
    
}
