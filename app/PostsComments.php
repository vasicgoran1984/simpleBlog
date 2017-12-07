<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsComments extends Model
{
    protected $table = "posts_comments";
    public $timestamps = false;
    
    
    public static function post()
    {
        return $this->belongsTo('App\Posts', 'posts_id');
    }
    
    public static function comment()
    {
        return $this->belongsTo('App\Comments', 'comments_id');
    }
    
}
