<?php

namespace App\Http\Controllers;

use App\DemandSupply;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DemandSupplyController extends Controller
{
    // List
    public function index()
    {   
        $demand_supplies = DemandSupply::all();
        return view('demand_supplies.index', compact('demand_supplies'));  
    }
    
    // Update
    public function update(Request $request, $id)
    {
        $demand_supplies = DemandSupply::find($id);
        $demand_supplies->car = $request->input('car');
        $demand_supplies->ccc = $request->input('ccc');
        $demand_supplies->pbi = $request->input('pbi');
     
        $demand_supplies->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }
}
