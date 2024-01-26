<?php

namespace App\Http\Controllers;
use App\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    // list
    public function index()
    {   
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));  
    }

    // store
    public function create(Request $request)
    {   
        $new_supplier = new Supplier;
        $new_supplier->name = $request->name;
        $new_supplier->nickname = $request->nickname;
        $new_supplier->code = $request->code;
        $new_supplier->contact_person = $request->contact_person;
        $new_supplier->address = $request->address;
        $new_supplier->tel_no = $request->tel_no;
        $new_supplier->fax_no = $request->fax_no;
        $new_supplier->mobile_no = $request->mobile_no;
        $new_supplier->email = $request->email;
        $new_supplier->terms = $request->terms;
        $new_supplier->accreditation_date = $request->accreditation_date;
        $new_supplier->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }
    
    // edit 
    public function edit($id)
    {
        $suppliers = Supplier::find($id);
        return view('supplier.index', compact('suppliers'));  
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->name = $request->input('name');
        $supplier->nickname = $request->input('nickname');
        $supplier->code = $request->input('code');
        $supplier->contact_person = $request->input('contact_person');
        $supplier->address = $request->input('address');
        $supplier->tel_no = $request->input('tel_no');
        $supplier->fax_no = $request->input('fax_no');
        $supplier->mobile_no = $request->input('mobile_no');
        $supplier->email = $request->input('email');
        $supplier->terms = $request->input('terms');
        $supplier->accreditation_date = $request->input('accreditation_date');
        $supplier->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function status ($id)
    {
        $supplier = Supplier::find($id);
        if($supplier){
            if($supplier->status){
                $supplier->status = 0;
            }
            else {
                $supplier->status = 1;
            }
            $supplier->save();
        }
        return back();
    }
}
