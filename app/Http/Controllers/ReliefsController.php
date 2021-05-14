<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relief;
use App\Donation;
use App\Bought_item;
use App\Resident;
use App\Relief_Item;
use SimpleSoftwareIO\QrCode\Generator;

class ReliefsController extends Controller
{


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function relief_items($id){
        $drice = Donation::where('donation_description','RICE')->sum('donation_quantity');
        $dcan = Donation::where('donation_description','CANNED GOODS')->sum('donation_quantity');
        $dnoodle = Donation::where('donation_description','NOODLE')->sum('donation_quantity');
        $dbw = Donation::where('donation_description','BOTTLED WATER')->sum('donation_quantity');
        $dcoffee = Donation::where('donation_description','COFFEE')->sum('donation_quantity');
        $dhk = Donation::where('donation_description','HYGIENE KITS')->sum('donation_quantity');

        $erice = Bought_item::where('item_name','RICE')->sum('item_quantity');
        $ecan = Bought_item::where('item_name','CANNED GOODS')->sum('item_quantity');
        $enoodle = Bought_item::where('item_name','NOODLE')->sum('item_quantity');
        $ebw = Bought_item::where('item_name','BOTTLED WATER')->sum('item_quantity');
        $ecoffee = Bought_item::where('item_name','COFFEE')->sum('item_quantity');
        $ehk = Bought_item::where('item_name','HYGIENE KITS')->sum('item_quantity');

        $rrice = Relief_Item::where('ri_description','RICE')->sum('ri_quantity');
        $rcan = Relief_Item::where('ri_description','CANNED GOODS')->sum('ri_quantity');
        $rnoodle = Relief_Item::where('ri_description','NOODLE')->sum('ri_quantity');
        $rbw = Relief_Item::where('ri_description','BOTTLED WATER')->sum('ri_quantity');
        $rcoffee = Relief_Item::where('ri_description','COFFEE')->sum('ri_quantity');
        $rhk = Relief_Item::where('ri_description','HYGIENE KITS')->sum('ri_quantity');

        $rice = $drice + $erice - $rrice;
        $noodle = $dnoodle + $enoodle - $rnoodle;
        $can = $dcan + $ecan - $rcan;
        $bw = $dbw + $ebw - $rbw;
        $coffee = $dcoffee + $ecoffee - $rcoffee;
        $hk = $dhk + $ehk - $rhk;
        $relief_items = Relief::find($id)->relief_items;
        $res = Resident::count('res_qrcode_status','Enabled');
        return view('pages.relief_items')
                ->with('relief_items',$relief_items)
                ->with('relief_id',$id)
                ->with('rice',$rice)
                ->with('noodle',$noodle)
                ->with('can',$can)
                ->with('bw',$bw)
                ->with('coffee',$coffee)
                ->with('hk',$hk)
                ->with('res',$res);
    }



    public function scannedrel($id){
        $rel = Relief::find($id);
        return $rel;
    }


    public function index()
    {   
        $drice = Donation::where('donation_description','RICE')->sum('donation_quantity');
        $dcan = Donation::where('donation_description','CANNED GOODS')->sum('donation_quantity');
        $dnoodle = Donation::where('donation_description','NOODLE')->sum('donation_quantity');
        $dbw = Donation::where('donation_description','BOTTLED WATER')->sum('donation_quantity');
        $dcoffee = Donation::where('donation_description','COFFEE')->sum('donation_quantity');
        $dhk = Donation::where('donation_description','HYGIENE KITS')->sum('donation_quantity');

        $erice = Bought_item::where('item_name','RICE')->sum('item_quantity');
        $ecan = Bought_item::where('item_name','CANNED GOODS')->sum('item_quantity');
        $enoodle = Bought_item::where('item_name','NOODLE')->sum('item_quantity');
        $ebw = Bought_item::where('item_name','BOTTLED WATER')->sum('item_quantity');
        $ecoffee = Bought_item::where('item_name','COFFEE')->sum('item_quantity');
        $ehk = Bought_item::where('item_name','HYGIENE KITS')->sum('item_quantity');

        $rrice = Relief_Item::where('ri_description','RICE')->sum('ri_quantity');
        $rcan = Relief_Item::where('ri_description','CANNED GOODS')->sum('ri_quantity');
        $rnoodle = Relief_Item::where('ri_description','NOODLE')->sum('ri_quantity');
        $rbw = Relief_Item::where('ri_description','BOTTLED WATER')->sum('ri_quantity');
        $rcoffee = Relief_Item::where('ri_description','COFFEE')->sum('ri_quantity');
        $rhk = Relief_Item::where('ri_description','HYGIENE KITS')->sum('ri_quantity');

        $rice = $drice + $erice - $rrice;
        $noodle = $dnoodle + $enoodle - $rnoodle;
        $can = $dcan + $ecan - $rcan;
        $bw = $dbw + $ebw - $rbw;
        $coffee = $dcoffee + $ecoffee - $rcoffee;
        $hk = $dhk + $ehk - $rhk;
        
        $donations = Donation::all()->where('donation_status','PENDING');
        $res = Resident::count('res_qrcode_status','Enabled');
        $reliefs = Relief::with('donations')->where('relief_status','PENDING')->get();
        return view('pages.relief')
            ->with('reliefs',$reliefs)
            ->with('donations',$donations)
            ->with('rice',$rice)
            ->with('noodle',$noodle)
            ->with('can',$can)
            ->with('bw',$bw)
            ->with('coffee',$coffee)
            ->with('hk',$hk)
            ->with('res',$res);
            
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
        $relief->relief_quantity = $request->input('reliefqty');
        $relief->relief_remarks = $request->input('remarks');
        $relief->relief_date_prepared=$request->input('reliefprep');
        $relief->relief_status = $request->input('status');
        // $test = Relief::with('donations')->get();
        $relief->save();
        // $save = Relief::with('donations')->latest()->first();
        // $save->donations()->attach($request->get('yay'));
        
        
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
