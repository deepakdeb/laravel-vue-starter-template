<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    
    
    
    public function passwordReset(Request $request)
    {
    
    	$requestData = $request->all();
    	
    	$email = $requestData['email'];
    	$token = $requestData['token'];
    	
    	
    	
    	$checktoken = DB::table('password_resets')->where('email' , $email)->first();
    	
    	if($checktoken)
    	{
    		$saved_token = $checktoken->token;
    		
    		if (Hash::check($token, $saved_token)) 
    		{
		    $password = Hash::make($requestData['password']);
    		
    		    User::where('email' , $email)->update(array('password'=>$password));
		}
    		
    	}
    	else
    	{
    		dd('no');
    	}
    	
    	
    }
    
    public function updateuser(Request $request)
    {
        if(!isset($request->id))
        {
            $user = $request->user();
        }
        else
        {
            $user_id = $request->id;
            $user = User::where('id' , $user_id);
        }

        $name = $request->name;
        $password = $request->password;

        $update_arr = array();

        $update_arr['name'] = $name;

            
        if($password != '')
            $update_arr['password'] = Hash::make($password);        

        $user->update($update_arr);
    }
    
    public function userList(Request $request)
    {
        $users = User::all()->toArray();
        return array_reverse($users);
    }
    
    
    public function register(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $requestData['password'] = Hash::make($requestData['password']);

        $user = User::create($requestData);

        return response([ 'status' => true, 'message' => 'User successfully register.' ], 200);
    }
    
    public function createuser(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $requestData['password'] = Hash::make($requestData['password']);

        $user = User::create($requestData);

        return response([ 'status' => true, 'message' => 'User successfully register.' ], 200);
    }

    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(! auth()->attempt($requestData)){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken], 200);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => $user], 200);
    }

    public function logout (Request $request)
    {        
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function logoutget (Request $request)
    {
        echo 'test fars..';
    }

    
}
