<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Resident;
use App\Donor;
class SenderController extends Controller
{


    public function sender(){
        $donors = Donor::paginate(5);
        return view('pages.smsSender')->with('donors',$donors);
    }
    // public function resident(Request $request){
        
    //     $name = $request->input('name');
    //     $num = $request->input('number');
    //     $msg = $request->input('sms');
    //     $api = "TR-VINCE484106_H25A1";
    //     $pass = "6@9uq!mv#i";
    //     // $value = $name.';'.$num.';'.$msg;
    //     $result = itexmo($num,$msg,$api,$pass);
    //     if ($result == ""){
    //     echo "iTexMo: No response from server!!!
    //     Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
    //     Please CONTACT US for help. ";	
    //     }else if ($result == 0){
    //     echo "Message Sent!";
    //     }
    //     else{	
    //     echo "Error Num ". $result . " was encountered!";
    //     }
	
    // }

    // public function donor(Request $request){
        
    //     $name = $request->input('name');
    //     $num = $request->input('number');
    //     $msg = $request->input('sms');
    //     $api = "TR-VINCE484106_H25A1";
    //     $pass = "6@9uq!mv#i";
    //     // $value = $name.';'.$num.';'.$msg;
    //     $result = itexmo($num,$msg,$api,$pass);
    //     if ($result == ""){
    //     echo "iTexMo: No response from server!!!
    //     Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
    //     Please CONTACT US for help. ";	
    //     }else if ($result == 0){
    //     echo "Message Sent!";
    //     }
    //     else{	
    //     echo "Error Num ". $result . " was encountered!";
    //     }
	
    // }
    
}