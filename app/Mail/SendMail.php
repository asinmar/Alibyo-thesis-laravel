<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

use Hash;
use App\User;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $user = User::whereEmail($request->get('email'))->first();
        $newpass = str_random(8);
        $user->password = Hash::make($newpass);
        $user->save();
        return $this->view('mail',
        [
            'lastname'=>$user->lastname,
            'firstname'=>$user->firstname,
            'middlename'=>$user->middlename,
            'password'=>$newpass
        ])->to($user->email);
    }
}
