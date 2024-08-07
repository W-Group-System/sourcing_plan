<?php

namespace App\Http\Controllers;

use App\SpiPo;
use App\Supplier;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class SpiPoController extends Controller
{
    // List
    public function index()
    {   
        $po_spis = SpiPo::with('supplier')->get();
        $suppliers = Supplier::all();
        return view('spi_po.index', compact('po_spis', 'suppliers'));  
    }

    // Create
    public function create()
    {     
        $suppliers = Supplier::all();
        return view('spi_po.create', compact('suppliers'));
    }

    // store
    public function submitPoSpi(Request $request)
    {   
        foreach($request->supplier_name as $key=>$supplier_name) {
            
            $data = new SpiPo();
            $data->supplier_name = $supplier_name;
            $data->lot_code = $request->lot_code[$key];
            $data->quantity = $request->quantity[$key];
            $data->buying_price = $request->buying_price[$key];
            $data->expenses = $request->expenses[$key];
            $data->price_expenses = $request->price_expenses[$key];
            $data->original_po_date = $request->original_po_date[$key];
            $data->po_date = $request->po_date[$key];
            $data->destination = $request->destination[$key];
            $data->remarks = $request->remarks[$key];

            $data->save();
        }

        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }

    // Edit 
    public function edit($id) {
        $spi_po = SpiPo::find($id);
        $suppliers = Supplier::all();
        return view('spi_po.edit', compact('spi_po', 'suppliers'));  
    }

    // Update
    public function update(Request $request, $id)
    {
        $cotts = Spipo::find($id);
        $cotts->supplier_name = $request->input('supplier_name');
        $cotts->lot_code = $request->input('lot_code');
        $cotts->quantity = $request->input('quantity');
        $cotts->buying_price = $request->input('buying_price');
        $cotts->expenses = $request->input('expenses');
        $cotts->price_expenses = $request->input('price_expenses');
        $cotts->original_po_date = $request->input('original_po_date');
        $cotts->po_date = $request->input('po_date');
        $cotts->destination = $request->input('destination');
        $cotts->remarks = $request->input('remarks');
        $cotts->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    // Delete
    public function delete($id)
    {
        $spi_po = SpiPo::find($id);

        if ($spi_po) {
            $spi_po->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back();
    }
}
