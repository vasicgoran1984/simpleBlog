<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;

use Request;
use App\User;
use App\Profile;
use App\Posts;
use App\Comments;
use App\PostsComments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class PostsCommentsController extends Controller
{
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function saveCommentedPost(Request $request) {
        
         $rules = array(
            'posts_id'                 => 'required',
            'comments_id'              => 'required'
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            
            exit(json_encode(array(
                'errors' => $validator->messages()->toArray()
            )));
            
        } else {
            
            $postsComments = New PostsComments();
            
            $postsComments->posts_id = Request::get('posts_id');
            $postsComments->comments_id = Request::get('comments_id');
                        
            if ($postsComments->save()) {
                exit(json_encode(array(
                    'status' => true
                )));
            }
            
        }
        
        
    }
}
