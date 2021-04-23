<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use SimpleSoftwareIO\QrCode\Generator;

class QrcodeDLController extends Controller
{
    //
    public function display(Request $request){
        $val = new Generator;
       $asdasd = $request->input('id');
       $disp = $val->size(200)->generate(($asdasd));
      return response()->download($disp);
    }
}
