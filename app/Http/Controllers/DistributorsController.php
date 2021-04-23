<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distributor;
use Hash;
class DistributorsController extends Controller
{
    public function index(){
        $dist = Distributor::paginate(10);
        return view('pages.distributor')->with('distributors',$dist);
    }

    public function register(Request $request){

        $request->validate([
            'username' => 'required|unique:distributors|max:255',
        ]);
        $dist = new Distributor;
        $dist->last_name = $request->input('lname');
        $dist->first_name = $request->input('fname');
        $dist->middle_name = $request->input('mname');
        $dist->contact_number = $request->input('contact');
        $dist->date_of_birth = $request->input('dob');
        $dist->status = $request->input('status');
        $dist->gender = $request->input('gender');
        $dist->username = $request->input('username');
        $dist->password = Hash::make($request->input('password'));
        $dist->save();
        return back()->with('success','Account Successfully Added');
    }

    public function editinfo(Request $request){
        
        $dist = Distributor::find($request->get('id'));
        $dist->last_name = $request->input('lname');
        $dist->first_name = $request->input('fname');
        $dist->middle_name = $request->input('mname');
        $dist->gender = $request->input('gender');
        $dist->contact_number = $request->input('contact');
        $dist->date_of_birth = $request->input('dob');
        $dist->save();
        return back()->with('success',"Distributor's information successfully updated");
    }

    public function update_status(Request $request){
        $dist = Distributor::find($request->get('id'));

        $dist->status = $request->input('status');
        $dist->save();
        return back()->with('success',$dist->last_name.', '.$dist->first_name.' '.$dist->middle_name. '  '.'Status:  '.$request->get('status'));
    }

    public function search(Request $request){
        $dist = Distributor::where('last_name','like','%'.$request->get('search').'%')->paginate(20);
        return view('pages.distributor')->with('distributors',$dist);
    }

    public function reset(Request $request){
        $dist = Distributor::find($request->get('id'));
        $dist->password = Hash::make($request->get('pass'));
        $dist->save();
        return back()->with('success','Password of '.$dist->last_name.', '.$dist->first_name.' '.$dist->middle_name.' reset successfully!');
    }

    public function softdelete(Request $request){
        $del = Distributor::find($request->get('id'));
        $del->delete();
        return back()->with('success','Distributor Successfully Deleted');
    }


}
