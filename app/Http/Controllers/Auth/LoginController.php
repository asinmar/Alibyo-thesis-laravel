<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    public function username()
{
    return 'username';
}
    // public function authenticate()
    // {
    //     if (Auth::attemp(['lastname' => $lastname, 'password' => $password])) {
    //         // Authentication passed...
    //         return redirect()->intended('/resident');
    //     }
    // }
    protected function authenticated(Request $request, $user)
    {
        if(Auth::user()->acc_position=='Admin'){
            return redirect('/dashboard');
        }
        if(Auth::user()->acc_position=='User'){
            return redirect('/brgyPage');
        }
        if(Auth::user()->acc_position=='Super_Admin'){
            return redirect('/super_admin');
        }
        if(Auth::user()->acc_position=='City_Admin'){
            return redirect('/donation_recieved');
        }
        else{
            return redirect('/signin');
        }
    }
    
        

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
