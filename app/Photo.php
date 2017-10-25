<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
