<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [
    'uses' => 'UserController@checkIsUserLogged',
    'as' => 'checkIsUserLogged'
]);

Route::post('/loginUser', [
    'uses' => 'UserController@loginUser',
    'as'  => 'loginUser'
]);


Route::post('createNewUser',[
   'uses' => 'UserController@create',
    'as'  => 'createNewUser'
]);

Route::post('registerNewUser',[
   'uses' => 'UserController@store',
    'as'  => 'registerNewUser'
]);

Route::group(['middleware' => ['admin']], function(){
    // Insert Time--------------------------------------------------------------
    Route::post('insertTime', [
        'uses' => 'UserTimeController@insertTime',
        'as'   => 'insertTime'
    ]);
    // Logout-------------------------------------------------------------------
    Route::get('/logout', [
        'uses' => 'UserController@userLogout',
        'as' => 'userLogout'
    ]);
    // Save New User------------------------------------------------------------
    Route::post('saveNewUser', [
       'uses' => 'UserController@saveNewUser',
        'as'  => 'saveNewUser'
    ]);
    
    Route::post('addEditProfileUser', [
       'uses' => 'UserController@addEditProfileUser',
        'as'  => 'addEditProfileUser'
    ]);
    
    Route::post('addNewPost', [
       'uses' => 'PostController@store',
        'as'  => 'addNewPost'
    ]);
    
    Route::post('addNewComment', [
       'uses' => 'CommentController@store',
        'as'  => 'addNewComment'
    ]);
    
    Route::post('selectPost', [
       'uses' => 'PostController@selectPost',
        'as'  => 'selectPost'
    ]);
    
    Route::post('editPost', [
       'uses' => 'PostController@editPost',
        'as'  => 'editPost'
    ]);
    Route::post('selectPostForComment', [
       'uses' => 'PostController@selectPostForComment',
        'as'  => 'selectPostForComment'
    ]);
    
    Route::post('saveCommentedPost', [
       'uses' => 'PostsCommentsController@saveCommentedPost',
        'as'  => 'saveCommentedPost'
    ]);
 
     
    /**
     * Pages Navigation---------------------------------------------------------
     * 
     * Start Pages Navigation---------------------------------------------------
     */
    Route::get('homePage', [
        'uses' => 'PagesController@homePage',
        'as'   => 'homePage'
    ]);
    Route::get('profilePage', [
        'uses' => 'PagesController@profilePage',
        'as'   => 'profilePage'
    ]);
    Route::get('postPage', [
        'uses' => 'PagesController@postPage',
        'as'   => 'postPage'
    ]);
    Route::get('commentPage', [
        'uses' => 'PagesController@commentPage',
        'as'   => 'commentPage'
    ]);
    Route::get('allCommentsPosts', [
        'uses' => 'PagesController@allCommentsPosts',
        'as'   => 'allCommentsPosts'
    ]);
    
    
    Route::get('registerNewUser', [
        'uses' => 'PagesController@registerNewUser',
        'as'   => 'registerNewUser'
    ]);


    /** 
     * Pages Navigation---------------------------------------------------------
     *
     * End Pages Navigation-----------------------------------------------------
     */
});
