<?php

namespace App\Http\Controllers;
use App\Bought_item;
use Illuminate\Http\Request;

class BoughtItemsController extends Controller
{
    public function store(Request $request){
        $items = new Bought_item;
        $items->item_name = $request->input('item_name');
        $items->item_quantity = $request->input('qty');
        $items->item_unit = $request->input('unit');
        $items->exp_id = $request->input('exp_id');
        $id = $request->input('exp_id');
        $items->save();
        return redirect()->to('expenditure_item/'.$id)->with('success',"Item Added: ".$request->get('item_name'));  
    }

    public function softdelete(Request $request){
        $del = Bought_Item::find($request->get('id'));
        $del->delete();
        return back()->with('success','Item Deleted Successfully');
    }
}
