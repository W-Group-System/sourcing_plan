<?php

namespace App\Http\Controllers;

use App\Spi;
use App\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SpiController extends Controller
{
    // list
    public function index()
    {   
        $spis = Spi::all();
        return view('spi.index', compact('spis'));  
    }

    public function create()
    {     
        $suppliers = Supplier::all();
        return view('spi.create', compact('suppliers'));
    }

    public function submitData(Request $request)
    {   
        foreach($request->name as $key=>$name) {
            
            $data = new Spi();
            $data->name = $name;
            $data->destination = $request->destination[$key];
            $data->origin = $request->origin[$key];
            $data->offer_quantity = $request->offer_quantity[$key];
            $data->buying_quantity = $request->buying_quantity[$key];
            $data->uom = $request->uom[$key];
            $data->original_price = $request->original_price[$key];
            $data->buying_price = $request->buying_price[$key];
            $data->expenses = $request->expenses[$key];
            $data->price_expense = $request->price_expense[$key];
            $data->moisture_content = $request->moisture_content[$key];
            $data->delivery_schedule = $request->delivery_schedule[$key];
            $data->potassium = $request->potassium[$key];
            $data->chips_yield = $request->chips_yield[$key];
            $data->powder_yield = $request->powder_yield[$key];
            $data->price_yield = $request->price_yield[$key];
            $data->forex_rate = $request->forex_rate[$key];
            $data->price_usd = $request->price_usd[$key];
            $data->cost_produce = $request->cost_produce[$key];
            $data->price_ctp = $request->price_ctp[$key];
            $data->remarks = $request->remarks[$key];
            $data->save();
        }
        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'checkbox' => 'required|array',
        ]);

        foreach ($request->input('checkbox') as $id) {
            $data = Spi::find($id);
            if ($data) {
                $data->approved = 1; 
                $data->save();
            }
        }
        Alert::success('Success Title', 'Records Updated Successfully');
        return back();
    }
}
