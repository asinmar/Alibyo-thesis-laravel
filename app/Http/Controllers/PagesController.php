<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\Donor;
use App\Donation;
use App\Expenditure;
use App\Relief;




class PagesController extends Controller
{
    public function index(){
        return view('pages.signin');
    }

    public function resident(){
        return view('pages.resident');
    }
    public function donation(){
        return view('pages.donation');
    }
    public function relief(){
        return view('pages.relief');
    }
    public function signin(){
        return view('pages.signin');
    }
    public function reg(){
        return view('pages.reg');
    }
    public function adminview(){
        return view('pages.adminview');
    }
    public function smsSender(){
        return view('pages.smsSender');
    }
    public function dashboard(){
        $res = Resident::count();
        $donor = Donor::count();
        $donation = Donation::count();
        $distrel = Relief::where('relief_status','Completed')->count();
        $exp = Expenditure::count();
        $relief = Relief::count();

        return view('pages.dash')
        ->with('res',$res)
        ->with('donor',$donor)
        ->with('donation',$donation)
        ->with('distrel',$distrel)
        ->with('exp',$exp)
        ->with('relief',$relief);
    }
    public function editaccount(){
        return view('pages.brgyeditacc');
    }
    public function updateaccount(){
        return view('pages.updateaccount');
    }
    public function admin_reg(){
        return view('pages.admin_register');
    }
    public function reset_password(){
        return view('pages.reset_password');
    }

    public function updateinfo(){
        return view('pages.city-admin.updateaccount');
    }
    
    public function supereditaccount(){
        return view('pages.super_updateaccount');
    }
}

