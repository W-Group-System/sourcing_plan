<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\OnhandSeaweed;
use App\Plant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OnhandSeaweedController extends Controller
{
    public function index(Request $request)
    {   
        $plants = Plant::all();
        // $onhands = OnhandSeaweed::all();
        $query = OnhandSeaweed::with('plants');

        if ($request->start_date) {
            $query->whereDate('date_updated', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('date_updated', '<=', $request->end_date);
        }

        $onhands = $query->get();

        return view('onhand_seaweed.index', compact('onhands','plants'));  
    }

    public function create()
    {     
        $plants = Plant::all();
        $inventories = Inventory::all();
        return view('onhand_seaweed.create', compact('plants', 'inventories'));
    }

    public function store_onhand(Request $request)
    {   
        foreach($request->plant as $key=>$plant) {

            
            $data = new OnhandSeaweed();
            $data->plant_id = $plant;
            // $data->inventory_id = $request->inventory[$key];
            $data->quantity = $request->quantity[$key];
            $data->plant_consumption = $request->plant_consumption[$key];
            $data->no_of_days = $request->no_of_days[$key];
            $data->date_updated = $request->date_updated[$key];
            $data->save();
        }

        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }

    public function edit_onhand(Request $request, $id)
    {   
        $data = OnhandSeaweed::find($id);
        $data->plant_id = $request->plant;
        $data->quantity = $request->quantity;
        $data->plant_consumption = $request->plant_consumption;
        $data->no_of_days = $request->no_of_days;
        $data->date_updated = $request->date_updated;
        $data->save();

        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }
}