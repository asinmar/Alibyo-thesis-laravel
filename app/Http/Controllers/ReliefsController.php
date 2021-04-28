<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relief;
use App\Donation;
use SimpleSoftwareIO\QrCode\Generator;

class ReliefsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scannedrel($id){
        $rel = Relief::find($id);
        return $rel;
    }


    public function index()
    {   
        $donations = Donation::all()->where('donation_status','PENDING');
        $reliefs = Relief::with('donations')->where('relief_status','PENDING')->get();
        return view('pages.relief')->with('reliefs',$reliefs)->with('donations',$donations);
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
       
        
        $relief = new Relief;
        $relief->relief_name=$request->input('reliefname');
        $relief->relief_description=$request->input('reliefdesc');
        $relief->relief_quantity = $request->input('reliefqty');
        $relief->relief_remarks = $request->input('remarks');
        $relief->relief_date_prepared=$request->input('reliefprep');
        $relief->relief_status = $request->input('status');
        // $test = Relief::with('donations')->get();
        $relief->save();
        $save = Relief::with('donations')->latest()->first();
        $save->donations()->attach($request->get('yay'));
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $relid = new Generator;
        $qrrelid = $relid->size(200)->generate(($id));
        return view('pages.reliefqrdisplay')->with('qrcode',$qrrelid);
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


    
    public function softdelete(Request $request){
       $del = Relief::find($request->get('id'));
       $del->delete();
       return back()->with('success','Relief Successfully Deleted');
    }


    public function complete(Request $request){
        $id = $request->get('completeid');
        $relief = Relief::find($id);
        $relief->relief_status = $request->input('status');
        $relief->save();
        return redirect('/relief')->with('alert','Data Moved to Completed Relief');
    }

    // User
    public function completed(){
        $reliefs = Relief::where('relief_status','COMPLETED')->orderBy('relief_date_prepared','DESC')->paginate(10);
        return view('pages.distributedRel')->with('reliefs',$reliefs);
    }
    public function distRel(){
        $reliefs = Relief::where('relief_status','COMPLETED')->orderBy('relief_date_prepared','DESC')->paginate(10);
        return view('pages.brgydistrel')->with('reliefs',$reliefs);
    }




    // City Admin
    public function relToDist(){
        $reliefs = Relief::where('relief_status','PENDING')->orderBy('relief_date_prepared','DESC')->paginate(10);
        return view('pages.brgyRelief')->with('reliefs',$reliefs);
    }

    public function city_relief(){
        $pending_reliefs = Relief::where('relief_status','PENDING')->orderBy('relief_date_prepared','DESC')->get();
        $completed_reliefs = Relief::where('relief_status','COMPLETED')->orderBy('relief_date_prepared','DESC')->get();
        return view('pages.city-admin.relief')->with('pending_reliefs',$pending_reliefs)->with('completed_reliefs',$completed_reliefs);
    }


    public function relief_receivers(){
        $records = Relief::all();
        return view('pages.city-admin.relief_distributed')->with('records',$records);
    }
}
