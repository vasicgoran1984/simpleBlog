<?php

namespace App;
use DB;
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
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function profile() {
        return $this->hasOne('App\Profile', 'users_id');
    }
    
    /*
     * Functon show all Posts and Comments
     * 
     * @return object
     */
    public static function showAllPostsAndComments() {
        $result = DB::table('posts_comments')
                ->leftJoin('posts', 'posts_comments.posts_id', '=', 'posts.id')
                ->leftJoin('comments', 'posts_comments.comments_id', '=', 'comments.id')
                ->select('posts_comments.id', 'posts.title', 'posts.text', 'comments.text')->get();
        return $result;
    }
}
