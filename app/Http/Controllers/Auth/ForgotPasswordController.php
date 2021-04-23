<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


use Sentinel;
use Reminder;
use App\User;
use Mail;

use App\Mail\WelcomMail;
use App\Mail\SendMail;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function password(Request $request){

        $user = User::whereEmail($request->get('email'))->first();
        if($user == null){
            return back()->with('error','Email does not Exists!.');
        }else{
            Mail::send(new SendMail());
            return back()->with('success','Password reset, Please check your Email');     
        }
        

        // $user = User::whereEmail($request->get('email'))->first();

        // if($user == null){
        //     return back()->with('error','Email does not Exists!.');

        // }

        // $user = Sentinel::findById($user->id);
        // // $reminder = Reminder::exists($user) ? : Reminder::create($user);
        // $code = str_random(8);
        // $this->sendEmail($user,$code);
        
        // return back()->with('success','Your new password is sent to your email!!.');
    }

    public function sendEmail($user,$code){

        // Mail::to($user)->send('yey');
        Mail::send(
            'emails.password_reset',
            ['user'=>$user,'code'=>$code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->lastname,reset your password.");
            }
        );
    }
}
