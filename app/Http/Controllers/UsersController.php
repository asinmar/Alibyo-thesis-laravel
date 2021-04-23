<?php

namespace App\Http\Controllers;
use App\User;
use Hash;
use Auth;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function changePass(Request $request)
    {
        if(!(Hash::check($request->get('oldpass'),Auth::user()->password))){
            return back()->with('error','Password does not match on our credentials');
        }
        if(strcmp($request->get('oldpass'),$request->get('new_password'))==0){
            return back()->with('error','Old password cannot be same with new password');
        }
        // if(strcmp($request->get('cofirmpass'),$request->get('new_password'))==0){
        //     return back()->with('error','New pass does not match');
        // }
        $request->validate([
            'oldpass' => 'required',
            'new_password' => 'required|string|min:8|same:confirmpass'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        return back()->with('success','Password updated Successfully');
        
    }

    public function editacc(Request $request){
        if(Auth::user()->email!=$request->get('email')){
            $request->validate([
                'email' => 'unique:users'  
            ]);
        }
        $user = Auth::user();
        $user->lastname = $request->input('lname');
        $user->firstname = $request->input('fname');
        $user->middlename = $request->input('mname');
        $user->contact_number = $request->input('contactnum');
        $user->email = $request->input('email');
        $user->save();
        return back()->with('success','Account Updated Successfully');
    }


    public function create_admin(Request $request){
        
        $request->validate([
            'email' => 'unique:users' ,
            'password' => 'required|string|min:8|same:password_confirmation',
            'username' => 'required|unique:users',
         ]);

        $user = new User;
        $user->username = $request->input('username');
        $user->lastname =$request->input('lastname');
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->contact_number = $request->input('contact_number');
        $user->acc_position = $request->input('position');
        $user->password = Hash::make($request->get('password'));
        $user->email = $request->input('email');
        $user->acc_status = $request->input('acc_status');
        $user->save();
        return back()->with('success','Admin Account Created Successfully! Please wait to verify your account');
    }

    public function admin_account(){

        $enabled_users = User::where('acc_position','Admin')->where('acc_status','Enabled')->get();
        $disabled_users = User::where('acc_position','Admin')->where('acc_status','Disabled')->get();
        return view('pages.superadmin')->with('enabled_users',$enabled_users)->with('disabled_users',$disabled_users);
    }

    public function update_account(Request $request){
        
        $user = User::find($request->get('id'));
        $user->acc_status = $request->input('status');
        $user->save();
        return back()->with('success','Update Success: '. $request->get('name') .' : '. $request->input('status'));
    }
}
