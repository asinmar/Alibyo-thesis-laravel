<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donation;
class DonationsController extends Controller
{
    public function sum(){
        $data = Donation::sum('donation_quantity');
        return $data;
    }


    public function donationpdf(){
        $pdf = \App::make('dompdf.wrapper');
        $data = Donation::all();
        $pdf->loadHTML($this->convert_resident_data_to_html());
        return $pdf->stream();
    }
    
    public function convert_resident_data_to_html(){
        $customer_data = Donation::all();
        $output = '
                    <h2>Donations Lists</h2>
                    <table style = "width:100%">
                        <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($customer_data as $data){
                            $output .='
                                <tr>
                                    <td>'.$data->donation_quantity.'</td>
                                    <td>'.$data->donation_unit.'</td>
                                    <td>'.$data->donation_amount.'</td>
                                    <td>'.$data->donation_description.'</td>
                                    <td>'.$data->donation_type.'</td>
                                    <td>'.$data->donation_status.'</td>
                                </tr>';
                            }
                        '</tbody>
                    </table>';
        return $output;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // asd
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
        if($request->donation_type == 'RELIEF'){
            $this->validate($request,[
                'description' => 'required',
                'unit'=>'required',
            ]);
        }
        $donation = new Donation;
        $donation->donation_quantity = $request->input('qty');
        $donation->donation_unit = $request->input('unit');
        $donation->donation_amount = $request->input('amountval');
        $donation->donation_description = strtoupper($request->input('description'));
        $donation->donation_type = $request->input('donation_type');
        $donation->donation_recieved_by = strtoupper($request->input('recieveby'));
        $donation->donation_status = $request->input('donation_status');
        $donation->donor_id = $request->input('id');
        $donor=$request->input('id');
        $donation->save();
        return back()->with('success','Donation Added!!');
    //    return redirect()->to('donorInfo/'.$donor);
    }
    public function completed(Request $request){
        $id = $request->get('id');
        $donation = Donation::find($id);
        $donation->donation_status = $request->input('stat_update');
        $donation->save();
        return back()->with('successcomp','Donation Completed!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  
        // $donorid = Donation::find($id)->mydonor;
        // $donations = Donation::all();
        // // return $donorid;
        // // foreach($donorid as $donor){
        // //     $donor=$donor->donor_id;
        // // }
        // $donor = 1;
        // return view('pages.donorInfo')->with('donor',$donor)->with('donations',$donations);
        
         /* $wow = Donation::find($id)->mydonor;
        //$lol = $wow->donor_id;
        foreach($wow as $donor){
           $newvar = $donor->donor_id;
        }
        
        $wew = Donation::all();
        $donations = array();
        $i=0;
      

        foreach($wew as $p){
            if($p->donor_id==$newvar){
                $donations[$i]=$p->donation_description;
           }
           $i++;
        }
        
       return view('pages.donorInfo')->with('donations',$donations);
        */
       
    }
    public function softdelete(Request $request){
        $id = $request->get('id');
        $donation = Donation::find($id);
        $donation->reason_to_delete = $request->input('reason');
        $donation->save();
        $donation->delete();
        return back()->with('success','Deleted Successfully');
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
}
