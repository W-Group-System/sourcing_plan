<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Plant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SetupController extends Controller
{
    public function plants()
    {   
        $plants = Plant::all();
        return view('setup.plant', compact('plants'));  
    }

    public function add_plant(Request $request)
    {
        $data = new Plant();
        $data->name = $request->name;
        
        $data->save();

        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }

    public function inventories()
    {   
        $inventories = Inventory::all();
        return view('setup.inventory', compact('inventories'));  
    }

    public function add_inventory(Request $request)
    {
        $data = new Inventory();
        $data->name = $request->name;
        
        $data->save();

        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }
}
