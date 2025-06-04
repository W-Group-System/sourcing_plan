<?php

namespace App\Http\Controllers;

use App\DeletionRequest;
use App\Spi;
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
            $data->area = $request->area[$key];
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
        $spis = Spipo::find($id);
        $spis->supplier_name = $request->input('supplier_name');
        $spis->lot_code = $request->input('lot_code');
        $spis->quantity = $request->input('quantity');
        $spis->buying_price = $request->input('buying_price');
        $spis->expenses = $request->input('expenses');
        $spis->price_expenses = $request->input('price_expenses');
        $spis->original_po_date = $request->input('original_po_date');
        $spis->po_date = $request->input('po_date');
        $spis->area = $request->input('area');
        $spis->remarks = $request->input('remarks');
        $spis->update();
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

    public function delete_approval(Request $request,$id)
    {
        $data = SpiPo::findOrFail($id);
        $filteredData = $data->toArray();
        unset($filteredData['created_at'], $filteredData['updated_at'], $filteredData['deleted_at']);

        $for_approval = new DeletionRequest();
        $for_approval->item_id = $id;
        $for_approval->requestor_id = auth()->user()->id;
        $for_approval->status = "Pending Approval";
        $for_approval->reason = $request->reason;
        $for_approval->data = json_encode($filteredData);
        $for_approval->type = "Spi Po";
        $for_approval->save();

        return back();
    }

    public function approve_deletion($id)
    {
        $request = DeletionRequest::findOrFail($id);
        $item = SpiPo::findOrFail($request->item_id);

        $item->delete();

        $request->approved_by_id = auth()->user()->id;
        $request->approved_at = now();
        $request->status = "Approved";
        $request->save();

        return back();
    }
    public function disapprove_deletion($id)
    {
        $request = DeletionRequest::findOrFail($id);

        $request->delete();

        return back();
    }

}
