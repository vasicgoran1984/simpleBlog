<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;

use Request;
use App\User;
use App\Profile;
use App\Posts;
use App\Comments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
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
        $rules = array(
            'user_id'   => 'required',
            'title'     => 'required',
            'text'      => 'required'
        );
        
        
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            
            exit(json_encode(array(
                'errors' => $validator->messages()->toArray()
            )));
            
        } else {
            
            if (Request::get('post_id')) {
                
                $post = Posts::FindOrFail(Request::get('post_id'));
                
            } else {
                
                $post = New Posts();
                
            }
            
                $post->user_id = Request::get('user_id');
                $post->title = Request::get('title');
                $post->text = Request::get('text');

                if ($post->save()) {

                    //return view('authentication.welcome');
                    $allPosts = Posts::all();

                    //dump($allPosts);

                    return response()->json([
                        'status' => true,
                        'relocate' => 'homePage',
                        'body' => view('authentication.welcome', compact('allPosts'))->render()
                    ]);

                } 
            
        }
    }
    
    /**
     * Function edit post
     *
     * @param  Request
     * @return json
     */
    public function editPost(Request $request) {
        
        if (Request::ajax()) {
            
            if ($validator->fails()) {

                exit(json_encode(array(
                    'errors' => $validator->messages()->toArray()
                )));

            } else {

                if (Request::get('post_id')) {

                    $post = Posts::FindOrFail(Request::get('post_id'));

                    $post->user_id = Request::get('user_id');
                    $post->title = Request::get('title');
                    $post->text = Request::get('text');

                    
                    if ($post->save()) {

                        return response()->json([
                            'status' => true
                        ]);

                    } else {
                        exit(json_encode(array(
                            'status' => false
                        )));
                    }
                } 
            }
        
        }
    }
    
    /**
     * Display the specified post.
     *
     * @param  Request
     * @return view
     */
    public function selectPost(Request $request) {
        
        if (Request::ajax()) {
            
            if (Request::get('id_post')) {
                $post = Posts::FindOrFail(Request::get('id_post'));
            }
            
            return view('authentication.editPost', compact('post'));
        }
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
    
    
    public function selectPostForComment(Request $request) {
        
        if (Request::ajax()) {
            
            if (Request::get('id_post')) {
                $post = Posts::FindOrFail(Request::get('id_post'));
            }
            
            
            $data['allComments'] = Comments::all();
            
            return view('authentication.commentPost', compact('post', 'data'));
        }
        
        
    }
    
}
