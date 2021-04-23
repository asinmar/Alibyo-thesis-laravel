<?php

namespace App\Http\Controllers;
use App\Expenditure;
use Illuminate\Http\Request;

class ExpendituresController extends Controller
{
    public function index(){
        $exp = Expenditure::orderBy('date_purchased','DESC')->paginate(10);
        return view('pages.expenditures')->with('expenditures',$exp);
    }


    public function store(Request $request){
        $exp = new Expenditure;
        $exp->exp_used_amount = $request->input('amtused');
        $exp->purchased_by = $request->input('purchased_by');
        $exp->date_purchased = $request->input('date_purchased');
        $exp->save();
        return back()->with('success','Data Saved!!');
    }

    public function expitem($id){
       
        $items = Expenditure::find($id)->exp_items;
        return view('pages.expitem')->with('items',$items)->with('exp_id',$id); 
    }


    public function softdelete(Request $request){
        $del = Expenditure::find($request->get('id'));
        $del->delete();
        return back()->with('success','Expenditure Deleted Successfully');
    }

    //User
    public function expenses(){
        $exp = Expenditure::orderBy('date_purchased','DESC')->paginate(10);
        return view('pages.brgyExpenditure')->with('expenditures',$exp);
    }



    // City Admin
    public function city_expenditures(){
        $exp = Expenditure::orderBy('date_purchased','DESC')->paginate(10);
        return view('pages.city-admin.expenditures')->with('expenditures',$exp);
    }
}
