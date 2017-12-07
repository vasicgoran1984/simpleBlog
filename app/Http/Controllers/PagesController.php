<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Request;
use App\User;
use App\Profile;
use App\Posts;
use App\PostsComments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    /**
     * Function show Home page
     * 
     * @return view
     */
    public function homePage($id = null) {
        
                
        $allPosts = Posts::all();
        $loggedUser_id = \Auth::user()->id;
        $profile = User::find($loggedUser_id)->profile;
        
        return view('authentication.welcome', compact('profile', 'allPosts'));
    }
    
    
    /**
     * Function show Profile page
     * 
     * @return view
     */
    public function profilePage($id = null) {
        
        $loggedUser_id = \Auth::user()->id;
        
        $profile = User::find($loggedUser_id)->profile;
        
        return view('authentication.profile', compact('profile'));
    }
    
    /**
     * Function show Post page
     * 
     * @return view
     */
    public function postPage() {
        
                
        return view('authentication.post');
        
    }
    /**
     * Function show Comment Page
     * 
     * @return view
     */
    public function commentPage() {
        
        return view('authentication.comment');
        
    }
     /**
     * Function show Comments and Posts Page
     * 
     * @return view
     */
    public function allCommentsPosts() {
        
        $allPosts = Posts::all();
        
       $allPostAndComments = User::showAllPostsAndComments();
        
        return view('authentication.allCommentsPosts', compact('allPosts', '$allPostAndComments'));
        
    }
    
}
