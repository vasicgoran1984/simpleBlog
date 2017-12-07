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

class CommentController extends Controller
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
        {
        $rules = array(
            'text'      => 'required'
        );
        
        
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            
            exit(json_encode(array(
                'errors' => $validator->messages()->toArray()
            )));
            
        } else {
            
            if (Request::get('post_id')) {
                
                $comment = Comments::FindOrFail(Request::get('post_id'));
                
            } else {
                
                $comment = New Comments();
                
            }
            
                    $comment->text = Request::get('text');

                if ($comment->save()) {

                    $allPosts = Posts::all();
                    $allComments = Comments::all();
                    

                    return response()->json([
                        'status' => true,
                        'relocate' => 'homePage',
                        'body' => view('authentication.welcome', compact('allPosts', 'allComments'))->render()
                    ]);

                } 
            
        }
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
    
}
