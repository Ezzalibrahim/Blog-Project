<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model
{
    // allow laravel to fill this cullom using $request->all() to avoid problems in the request 
    protected $fillable = ['name'];

    public function posts()
    {
        // every category  have a lot of posts   
        // we use this to know all the posts of this category    
        return $this->hasMany(Post::class);
    }
}
