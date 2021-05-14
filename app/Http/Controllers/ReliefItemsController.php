<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relief_Item;
use App\Donation;
use App\Bought_item;
class ReliefItemsController extends Controller
{
  public function store(Request $request){

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
    if($request->desc == 'Rice'){
        if($request->qty>$rice){
            return back()->with('failed','The Relief Exceeded');
        }
    }
    if($request->desc == 'Noodle'){
        if($request->qty>$noodle){
            return back()->with('failed','The Relief Exceeded');
        }
    }
    if($request->desc == 'Canned Goods'){
        if($request->qty>$can){
            return back()->with('failed','The Relief Exceeded');
        }
    }
    if($request->desc == 'Bottled Water'){
        if($request->qty>$bw){
            return back()->with('failed','The Relief Exceeded');
        }
    }
    if($request->desc == 'Coffee'){
        if($request->qty>$cofee){
            return back()->with('failed','The Relief Exceeded');
        }
    }
    if($request->desc == 'Hygiene Kits'){
        if($request->qty>$hk){
            return back()->with('failed','The Relief Exceeded');
        }
    }
    $this->validate($request,[
        'desc' => 'required',
        'unit'=>'required',
    ]);

    $item = new Relief_Item;
    $item->ri_quantity = $request->qty;
    $item->ri_unit = $request->unit;
    $item->ri_description = strtoupper($request->desc);
    $item->relief_id = $request->relief_id;
    $item->save();
    return back()->with('success','Relief Added!');
  }
}
