<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;

use Request;
use App\User;
use App\Profile;
use storage;
use App\Posts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
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
        return view('authentication.registerNewUser');
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
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
            
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            
            exit(json_encode(array(
                'errors' => $validator->messages()->toArray()
            )));
            
        } else {
            
            $user = New user();
            $user->email = Request::get('email');
            $user->password = bcrypt(Request::get('password'));
            
            if ($user->save()) {
                exit(json_encode(array(
                    'status' => true
                )));
            }
            
        }
    }

    /**
     * Function check is user logged
     * 
     * @return object 
     */
    public function checkIsUserLogged() {
        
        $loggedUser = \Auth::user();
        
        if($loggedUser) {
            
            return view('authentication.welcome', compact('loggedUser'));
        } else {
            return view('authentication.login');
        }
        
    }
    
    /**
     * Function register user
     * 
     * @param  Request $request
     * @return json object
     * 
     */
    public function loginUser(Request $request) {
        
        $rules = array(
            'email' 	=> 'required|email',
            'password'  => 'required|min:8'
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            
            return response()->json([
                'errors' => true,
                'body' => view('authentication.login', compact('validator'))->render(),
                'warning' => 'Email or password are incorrect.'
            ]);
                   
        } else if (!Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')])) {
                  
            return response()->json([
                'errors' => true,
                'body' => view('authentication.login', compact('validator'))->render(),
                'warning' => 'Wrong email or password. Please try again.'
            ]);
            
        } else if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')])) {
            
            session_start();

        
            $data['session']    = \Auth::user();
            $data['session_id'] = session_id();
         
            $data['user_id']    = \Auth::user()->id;
            $data['ip_address'] = getenv('REMOTE_ADDR');
            $loggedUser_id = \Auth::user()->id;
            $profile = User::find($loggedUser_id)->profile;
            $allPosts = Posts::all();
            
            
            return response()->json([
                'status' => true,
                'body' => view('authentication.welcome', compact('data', 'profile', 'allPosts'))->render()
            ]);
        }
    }
    
    /**
     * Function Logout User
     * 
     * @return user to login page
     */
    public function userLogout() {
       
        if(\Auth::user()->id) {

        }
        
        Auth::Logout();
        session_start();
        session_regenerate_id(TRUE);
    	session_destroy();
        
        return redirect('/');
    }
    
    public function addEditProfileUser(Request $request) {
        
        $rules = array(
            'first_name'                 => 'required',
            'last_name'              => 'required',
            'phone_number' => 'required',
            'mobile_number' => 'required',
            'address' => 'required',
            'city' => 'required|',
            'state' => 'required',
            'zip' => 'required'
            
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            
            exit(json_encode(array(
                'errors' => $validator->messages()->toArray()
            )));
            
        } else {
            
                   
            $profile = New Profile();
            $profile->users_id = Request::get('users_id');
            $profile->first_name = Request::get('first_name');
            $profile->last_name = Request::get('last_name');
            $profile->phone_number = Request::get('phone_number');
            $profile->mobile_number = Request::get('mobile_number');
            $profile->address = Request::get('address');
            $profile->city = Request::get('city');
            $profile->state = Request::get('state');
            $profile->zip = Request::get('zip');
            $profile->profile_pic = Request::get('profile_pic');
            
                        
            if ($profile->save()) {
                exit(json_encode(array(
                    'status' => true
                )));
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
