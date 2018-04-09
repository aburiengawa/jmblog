<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
        'title', 'body', 'photo_id', 'category_id', 'subheading'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
