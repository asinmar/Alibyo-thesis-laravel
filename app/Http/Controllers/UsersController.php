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

    // DISTRIBUTORS-------------------------
    public function register(Request $request){

        $request->validate([
            'username' => 'required|unique:distributors|max:255',
        ]);
        $dist = new User;
        $dist->lastname = $request->input('lname');
        $dist->firstname = $request->input('fname');
        $dist->middlename = $request->input('mname');
        $dist->contact_number = $request->input('contact');
        $dist->acc_position = "Distributor";
        $dist->acc_status = "Disabled";
        $dist->username = $request->input('username');
        $dist->password = Hash::make('password');
        $dist->email = $request->input('email');
        $dist->save();
        return back()->with('success','Account Successfully Added');
    }

    public function distributor(){
        $dist = User::where('acc_position','Distributor')->paginate(10);
        return view('pages.distributor')->with('distributors',$dist);
    }

    public function search(Request $request){
        $dist = User::where('lastname','like','%'.$request->get('search').'%')->where('acc_position','Distributor')->paginate(20);
        return view('pages.distributor')->with('distributors',$dist);
    }

    public function editinfo(Request $request){
        
        $dist = User::find($request->get('id'));
        $dist->lastname = $request->input('lname');
        $dist->firstname = $request->input('fname');
        $dist->middlename = $request->input('mname');
        $dist->email = $request->input('email');
        $dist->contact_number = $request->input('contact');
        $dist->save();
        return back()->with('success',"Distributor's information successfully updated");
    }

    public function update_status(Request $request){
        $dist = User::find($request->get('id'));
        $dist->acc_status = $request->input('status');
        $dist->save();
        return back()->with('success',$dist->lastname.', '.$dist->firstname.' '.$dist->middlename. '  '.'Status:  '.$request->get('status'));
    }

    
    public function reset(Request $request){
        $dist = User::find($request->get('id'));
        $dist->password = Hash::make($request->get('pass'));
        $dist->save();
        return back()->with('success','Password of '.$dist->lastname.', '.$dist->firstname.' '.$dist->middlename.' reset successfully!');
    }


    public function distributor_pass(Request $request){
        $id = $request->get('distributor_id');
        $dist = User::find($id);
        $dist->password = Hash::make($request->get('password'));
        $dist->save();
        return "Password Successfully Changed";

    }
    public function softdeletedist(Request $request){
        $del = User::find($request->get('id'));
        $del->delete();
        return back()->with('success','Distributor Successfully Deleted');
    }

}
