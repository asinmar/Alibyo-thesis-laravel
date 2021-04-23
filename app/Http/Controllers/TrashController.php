<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\Donor;
use App\Donation;
use App\Distributor;
use App\Bought_item;
use App\Expenditure;
use App\Relief;

class TrashController extends Controller
{
    public function index(){
        $reliefs = Relief::onlyTrashed()->get();
        $donors = Donor::onlyTrashed()->get();
        $donations  = Donation::onlyTrashed()->get();
        $residents = Resident::onlyTrashed()->get();
        $exps   = Expenditure::onlyTrashed()->get();
        $exp_items  = Bought_item::onlyTrashed()->get();
        $distributors = Distributor::onlyTrashed()->get();
        
        

        return view('pages.trashed')
        ->with('reliefs',$reliefs)
        ->with('donors',$donors)
        ->with('donations',$donations)
        ->with('residents',$residents)
        ->with('exps',$exps)
        ->with('exp_items',$exp_items)
        ->with('distributors',$distributors);
    }
    public function ret_res(Request $request){
        $res = Resident::onlyTrashed()->find($request->get('id'));
        $res->restore();
        return back()->with('success','Resident Retrieved Successfully');
    }



    public function ret_dist(Request $request){
        $ret = Distributor::onlyTrashed()->find($request->get('id'));
        $ret->restore();
        return back()->with('success','Distributor Retrieved Successfully');
    }


    public function ret_donor(Request $request){
        $ret = Donor::onlyTrashed()->find($request->get('id'));
        $ret->restore();
        return back()->with('success','Donor Retrieved Successfully');
    }




    // city_admin
    public function brgytrashed(){
      
        $reliefs = Relief::onlyTrashed()->get();
        $donors = Donor::onlyTrashed()->get();
        $donations  = Donation::onlyTrashed()->get();
        $residents = Resident::onlyTrashed()->get();
        $exps   = Expenditure::onlyTrashed()->get();
        $exp_items  = Bought_item::onlyTrashed()->get();
        $distributors = Distributor::onlyTrashed()->get();
        
        return view('pages.city-admin.trashed')
        ->with('reliefs',$reliefs)
        ->with('donors',$donors)
        ->with('donations',$donations)
        ->with('residents',$residents)
        ->with('exps',$exps)
        ->with('exp_items',$exp_items)
        ->with('distributors',$distributors);
    }
}
