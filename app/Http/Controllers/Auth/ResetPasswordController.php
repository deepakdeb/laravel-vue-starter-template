<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login';

    
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        //$request->put('message' , 'Please login with new password.');
        //Session::put('message', 'Please login with new password.');
    }
    
    public function postReset(Request $request)
    {
        $status = Password::reset(
        $request->only('email', 'password', 'token'),
		function ($user, $password) {
		    $user->forceFill([
		        'password' => Hash::make($password)
		    ])->setRememberToken(Str::random(60));
	 
		    $user->save();
	 
		    event(new PasswordReset($user));
		}
    	);
 
    
    }
    
    
}
