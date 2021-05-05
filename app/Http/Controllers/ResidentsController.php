<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use SimpleSoftwareIO\QrCode\Generator;


class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function recieved_relief(Request $request){

         $user = Resident::find($request->get('res_id'));
         $user->res_qrcode_status = "Disabled";
         $user->save();
         $user->relief()->attach($request->get('rel_id'));
         return "Relief Successfully Recieved";
         
     }
    public function scanqr($id){
        $post = Resident::find($id);
        if($post == null){
            return "Unknown QR Code";
        }
        return $post;

    }
    public function index(Request $request)
    {

       // $residents = Resident::all();
        //return view('pages.resident')->with('residents',$residents);
        //
        
        $selpurok = $request->get('purok');
        $name_search = $request->get('name_search');
        if($selpurok==null or $selpurok=="all"){
            $residents = Resident::all();
            if($name_search != null){
                $residents = Resident::where('res_last_name','like','%'. $name_search .'%')->get();
            }
        }
        else{
        $residents = Resident::where('res_purok',$selpurok)->get();
        }
        
        return view('pages.resident',['residents'=>$residents])->with('selpurok',$selpurok);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateqr(Request $request, $id)
    {
        // $qrid = $request->input('qrid');
        $resident = Resident::find($id);
        $resident->res_qrcode_status = $request->input('qrstat');
        $resident->save();
    }
    public function create()
    {
        //
    }
    public function residentsms(Request $request)
    {
        $residents = Resident::where('res_qrcode_status','Enabled')->get();
        if($residents->isEmpty()){
            return back()->with('error','No Qr-code enabled!!');
        }
        else{
            foreach($residents as $resident){
              
                $num = $resident->res_contact_number;
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
    
       }

    public function search(Request $request)
    {
        # code...
        $selpurok = $request->get('purok');
        if($selpurok=="all"){
            $residents = Resident::all();
        }
        else{
        $residents = Resident::where('res_purok',$selpurok)->paginate();
        }
        return view('pages.resident',['residents'=>$residents]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'last_name' => 'required',
            'first_name' => 'required',
            'barangay' => 'required',
            'gender' => 'required',
            'purok' => 'required',
            'dob' =>'required',
            'civil_status' => 'required',
            'family_number' => 'required'

        ]);
        //Saving Resident's Info
       
        $resident = new Resident;
        $resident->res_last_name = $request->input('last_name');
        $resident->res_first_name = $request->input('first_name');
        $resident->res_middle_name = $request->input('middle_name');
        $resident->res_gender = $request->input('gender');
        $resident->res_contact_number = $request->input('contact_number');
        $resident->res_barangay = $request->input('barangay');
        $resident->res_purok = $request->input('purok');
        $resident->res_civil_status = $request->input('civil_status');
        $resident->res_family_number = $request->input('family_number');
        $resident->res_qrcode_status = $request->input('qrcode');
        $resident->res_date_of_birth = $request->input('dob');
        
        $resident->save();
        return redirect('/resident')->with('alert', 'Data Saved');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $val = new Generator;
        $qrcode = $val->size(200)->style('round')->eye('circle')->generate(($id));
        return view('pages.qrdisplay')->with('qrcode',$qrcode);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $resident= Resident::find($id);
        return view('pages.editResident')->with('resident',$resident);
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
        $this->validate($request,[
            'last_name' => 'required',
            'first_name' => 'required',
            'barangay' => 'required',
            'gender' => 'required',
            'purok' => 'required',
            'dob' =>'required',
            'civil_status' => 'required',
            'family_number' => 'required'

        ]);
        //Updating Resident's Info
        $resident = Resident::find($id);
        $resident->res_last_name = $request->input('last_name');
        $resident->res_first_name = $request->input('first_name');
        $resident->res_middle_name = $request->input('middle_name');
        $resident->res_gender = $request->input('gender');
        $resident->res_contact_number = $request->input('contact_number');
        $resident->res_barangay = $request->input('barangay');
        $resident->res_purok = $request->input('purok');
        $resident->res_civil_status = $request->input('civil_status');
        $resident->res_family_number = $request->input('family_number');
        $resident->res_qrcode_status = $request->input('qrcode');
        $resident->res_date_of_birth = $request->input('dob');
        $resident->save();
        // return redirect('/resident');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function destroy($id)
    {
    //''    
    }

    public function duplicateCheck(Request $request)
    {
   
        $newreg = array(
            $request->get('last_name'),
            $request->get('first_name'),
            $request->get('middle_name'),
            $request->get('gender'),
            $request->get('dob'),
            $request->get('barangay')
        );

        
        $lastname = $request->get('last_name');
        
        $age = $request->get('dob');
        $residents = Resident::where('res_last_name',$lastname)->where('res_date_of_birth',$age)->get();
    
        // if($residents == []){
        //     return "ulol"; 
        // }
        if($residents->isEmpty()){
            return $this->store($request);
        }
        else{
            return view('pages.duplicateResident')->with('residents',$residents)->with('newregister',$newreg)->with('request',$request);
        }
    }
    public function updateAllQr(Request $request)
    {
        $qr = $request->get('allqr');
       $residents = Resident::all();
       foreach($residents as $resident){
            $resident->res_qrcode_status = $request->input('allqr');
            $resident->save();
           }
       return redirect('/resident');
    }
    public function purokQrupdate(Request $request){

        $this->validate($request,[
            'purok' => 'required',
            'purokqrupdate' => 'required'
        ]);
        $purok = $request->get('purok');
        $residents = Resident::where('res_purok',$purok)->get();
        // return $residents;
        foreach($residents as $resident){
            $resident->res_qrcode_status = $request->input('purokqrupdate');
            $resident->save();
        }
        // return redirect('/resident');
    }

    public function listToReceive(){
        $residents = Resident::where('res_qrcode_status','Enabled')->orderBy('res_purok','ASC')->paginate(10);
        return view('pages.claim')->with('residents',$residents);
    }
    public function softdelete(Request $request){
        $id = $request->get('deleteid');
        $resident = Resident::find($id);
        $resident->res_qrcode_status = 'Disabled';
        $resident->save();
        $resident->delete();
    }
    public function recipients(){
        $recipients = Resident::where('res_qrcode_status','Enabled')->paginate(10);
        return view('pages.brgyRecipients')->with('recipients',$recipients);
    }
    public function recievers(){
        $recievers = Resident::where('res_qrcode_status','Enabled')->orderBy('res_purok','ASC')->paginate(10);
        return view('pages.brgyrecieverlist')->with('recievers',$recievers);
    }


    public function records(){
        $records  = Resident::with('relief')->orderBy('res_last_name','ASC')->paginate(10);
        return view('pages.record')->with('records',$records);
    }


    public function postman($id){
        $as = Resident::find($id);
        return $as;
    }

    public function records_city(){
        $records  = Resident::with('relief')->get();
        return view('pages.city-admin.relief_distributed')->with('records',$records);
    }
}
