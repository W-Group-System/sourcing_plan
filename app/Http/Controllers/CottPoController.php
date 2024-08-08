<?php

namespace App\Http\Controllers;

use App\CottPo;
use App\Supplier;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CottPoController extends Controller
{
    // List
    public function index()
    {   
        $po_cotts = CottPo::with('supplier')->get();
        $suppliers = Supplier::all();
        return view('cott_po.index', compact('po_cotts', 'suppliers'));  
    }

    // Create
    public function create()
    {     
        $suppliers = Supplier::all();
        return view('cott_po.create', compact('suppliers'));
    }

    // store
    public function submitPoCott(Request $request)
    {   
        foreach($request->supplier_name as $key=>$supplier_name) {


            $quantity = $request->quantity[$key];
            if (!is_numeric($quantity) || $quantity < 0) {
                // Log or handle invalid quantity
                dd("Invalid quantity for record at index $key: " . $quantity);
            }
            
            $data = new CottPo();
            $data->supplier_name = $supplier_name;
            $data->lot_code = $request->lot_code[$key];
            $data->quantity = $request->quantity[$key];
            $data->buying_price = $request->buying_price[$key];
            $data->expenses = $request->expenses[$key];
            $data->price_expenses = $request->price_expenses[$key];
            $data->original_po_date = $request->original_po_date[$key];
            $data->po_date = $request->po_date[$key];
            $data->area = $request->area[$key];
            $data->remarks = $request->remarks[$key];

            $data->save();
        }

        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }

    // Edit 
    public function edit($id) {
        $cott_po = CottPo::find($id);
        $suppliers = Supplier::all();
        return view('cott_po.edit', compact('cott_po', 'suppliers'));  
    }

    // Update
    public function update(Request $request, $id)
    {
        $cotts = CottPo::find($id);
        $cotts->supplier_name = $request->input('supplier_name');
        $cotts->lot_code = $request->input('lot_code');
        $cotts->quantity = $request->input('quantity');
        $cotts->buying_price = $request->input('buying_price');
        $cotts->expenses = $request->input('expenses');
        $cotts->price_expenses = $request->input('price_expenses');
        $cotts->original_po_date = $request->input('original_po_date');
        $cotts->po_date = $request->input('po_date');
        $cotts->area = $request->input('area');
        $cotts->remarks = $request->input('remarks');
        $cotts->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    // Delete
    public function delete($id)
    {
        $cott_po = CottPo::find($id);

        if ($cott_po) {
            $cott_po->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back();
    }
}
