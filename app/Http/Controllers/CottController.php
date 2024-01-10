<?php

namespace App\Http\Controllers;
use App\Cott;
use App\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class CottController extends Controller
{
    public function index()
    {   
        $cotts = Cott::all();
        return view('cott.index', compact('cotts'));  
    }
      
    public function create()
    {     
        $suppliers = Supplier::all();
        return view('cott.create', compact('suppliers'));
    }

    public function submitData(Request $request)
    {   
        foreach($request->name as $key=>$name) {
            
            $data = new Cott();
            $data->name = $name;
            $data->destination = $request->destination[$key];
            $data->food_grade = $request->food_grade[$key];
            $data->origin = $request->origin[$key];
            $data->offer_quantity = $request->offer_quantity[$key];
            $data->buying_quantity = $request->buying_quantity[$key];
            $data->uom = $request->uom[$key];
            // $data->uom = isset($request->uom[$key]) ? $request->uom[$key] : null;
            $data->original_price = $request->original_price[$key];
            $data->buying_price = $request->buying_price[$key];
            $data->expenses = $request->expenses[$key];
            $data->price_expense = $request->price_expense[$key];
            $data->moisture_content = $request->moisture_content[$key];
            $data->delivery_schedule = $request->delivery_schedule[$key];
            $data->terms_payment = $request->terms_payment[$key];
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
    public function addComments(Request $request, $id)
    {
        $cott = Cott::find($id);
        $cott->comments = $request->input('comments');
        $cott->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'checkbox' => 'required|array',
        ]);

        foreach ($request->input('checkbox') as $id) {
            $data = Cott::find($id);
            if ($data) {
                $data->approved = 1; 
                $data->save();
            }
        }
        Alert::success('Success Title', 'Records Updated Successfully');
        return back();
    }

    

    public function filter(Request $request) 
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $cotts = Cott::whereDate('created_at','>=',$start_date)
                        ->whereDate('created_at','<=',$end_date)
                        ->get();
        
        return view('cott.index', compact('cotts'));  
    }

    public function export_cott_pdf()
    {
        $cotts = Cott::all();
        $pdf = PDF::loadView('cott.export', [
            'cotts' => $cotts
        ])->setPaper('a4', 'landscape');

        return $pdf->download('cott.pdf');
    }
}
