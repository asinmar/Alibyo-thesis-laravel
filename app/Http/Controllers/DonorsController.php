<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donor;

class DonorsController extends Controller
{

   public function posttest(Request $request){
    //    return $request;
       $don = new Donor;
       $don->donor_name = $request->input('name');
       $don->donor_type = $request->input('type');
       $don->donor_contact_number = $request->input('number');
       $don->donor_email = $request->input('email');
       $don->save();
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donors = Donor::All();
        return view('pages.donation')->with('donors',$donors);
    }

    public function info($id){
    
        $donations = Donor::find($id)->mydonor->where('donation_status','PENDING');
        $compdonations = Donor::find($id)->mydonor->where('donation_status','COMPLETED');
        
         return view('pages.donorInfo')->with('donations',$donations)->with('donorid',$id)->with('compdonations',$compdonations); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required',
            'donor_type'=>'required',
            'contactnum' => 'required',
            'email' => 'required'
        ]);
        $donor = new Donor;
        $donor->donor_name = $request->input('name');
        $donor->donor_type = $request->input('donor_type');
        $donor->donor_contact_number = $request->input('contactnum');
        $donor->donor_email = $request->input('email');
        $donor->save();
        return back()->with('success','Registered Successfully');
        
    }
    public function donorsms(Request $request){
        // $name = $request->input('name');
        $lists = $request->get('lists');
        if($lists == null)
        {
            return back()->with('error','Please Select Donors');
        }
        foreach($lists as $list){
        $donor = Donor::find($list);
            $num = $donor->donor_contact_number;
            $msg = $request->input('sms');
            $api = "TR-THESI583052_D4Y9U";
            $pass = "7pt8]jxzw9";
            // $value = $name.';'.$num.';'.$msg;
            $result = itexmo($num,$msg,$api,$pass);
            if ($result == ""){
                echo "iTexMo: No response from server!!!
                Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
                Please CONTACT US for help. ";	
            }else if ($result == 0){
                echo "Message Sent!";
            }
            else{	
                echo "Error Num ". $result . " was encountered!";
            }
        }
        return back()->with('success','Message Sent!');
    }
       
        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
        // $donations = Donor::find($id);
        // return 'DonationsController'->with('$donations', $donations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editinfo(Request $request)
    {
        $donor = Donor::find($request->get('id'));
        $donor->donor_name = $request->input('name');
        $donor->donor_contact_number = $request->input('contact');
        $donor->donor_email = $request->input('email');
        $donor->save();
        return back()->with('success','Donor info updated Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function donationsDisp(){
        $donors = Donor::orderBy('donor_name','ASC')->paginate(10);
        return view('pages.brgyPage')->with('donors',$donors);
    }
    
    public function givendonation($id){
        $donations = Donor::find($id)->mydonor;
         return view('pages.brgyDonorsDonation')->with('donations',$donations); 
    }




    public function donation_city(){
        $donations = Donor::all();
        return view('pages.city-admin.city_admin')->with('donations',$donations);

    }


    public function donation_recieve($id){
        $compdonations = Donor::find($id)->mydonor->where('donation_status','COMPLETED');
        $pendonations = Donor::find($id)->mydonor->where('donation_status','PENDING');
        $deldonation = Donor::find($id)->mydonor_del;
        return view('pages.city-admin.donation_recieve')->with('compdonations',$compdonations)->with('pendonations',$pendonations)->with('deldonations',$deldonation);
    }



    public function softdelete(Request $request){
        $del = Donor::find($request->get('id'));
        $del->delete();
        return back()->with('success','Donor Successfully deleted');
    }
}
