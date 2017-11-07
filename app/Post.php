<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
        'title', 'body', 'photo_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

}
