<?php

namespace App\Http\Controllers;
use App\Cott;
use App\DeletionRequest;
use App\Supplier;
use App\DemandSupply;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use View;
use Carbon\Carbon;
use CreateDeletionRequests;

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

    public function submitCott(Request $request)
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
            $data->area = $request->area[$key];

            $data->save();
        }
        Alert::success('Success Title', 'Records Successfully Added');
        return back();
    }
    
    public function addCommentsCott(Request $request, $id)
    {
        $cott = Cott::find($id);
        $cott->comments = $request->input('comments');
        $cott->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }
    
    public function disapprovedComments(Request $request, $id)
    {
        $cott = Cott::find($id);
        $cott->comments = $request->input('comments');
        $cott->status = 0;
        $cott->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function updateStatusCott(Request $request)
    {
        $request->validate([
            'checkbox' => 'required|array',
        ]);

        $action = $request->input('action'); 

        foreach ($request->input('checkbox') as $id) {
            $data = Cott::find($id);
            if ($data) {
                if ($action === 'approve') {
                    $data->status = 1; 
                } elseif ($action === 'disapprove') {
                    $data->status = 0; 
                    $data->approved = 2;
                } elseif ($action === 'approved') {
                    $data->approved = 1;
                }
                $data->save();
            }
        }

        $message = ($action === 'approve') ? 'Approved' : 'Disapproved';
        Alert::success('Success Title', 'Records ' . $message . ' Successfully');

        return back();
    }

    public function dateFilter($start_date, $end_date) {
        return Cott::whereDate('created_at','>=',$start_date)
                        ->whereDate('created_at','<=',$end_date)
                        ->orderBy('status', 'desc')
                        ->orderBy('price_yield', 'asc')
                        ->get();
    }

    public function filter(Request $request) 
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();

        $cotts = $this->dateFilter($start_date, $end_date);
        
        return view('cott.index', ['cotts' => $cotts, 'start_date' => $start_date, 'end_date' => $end_date]);  
    }

    public function export_cott_pdf(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();

        $demandSupplies = DemandSupply::whereDate('from', '>=', $start_date)
            ->whereDate('to', '<=', $end_date)
            ->where('type', '=', 1)
            ->get();

        View::share('demandSupplies', $demandSupplies);

        $cotts = $this->dateFilter($start_date, $end_date);
        // $cotts = Cott::all();
        $pdf = PDF::loadView('cott.export', [
            'cotts' => $cotts,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ])->setPaper('legal', 'landscape');

        return $pdf->stream('cott.pdf', ['cotts' => $cotts, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function for_approval_pdf(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();

        $demandSupplies = DemandSupply::whereDate('from', '>=', $start_date)
            ->whereDate('to', '<=', $end_date)
            ->where('type', '=', 1)
            ->get();

        View::share('demandSupplies', $demandSupplies);

        $cotts = $this->dateFilter($start_date, $end_date)->sortBy('price_yield');
        
        // $cotts = Cott::all();
        $pdf = PDF::loadView('cott.for_approval', [
            'cotts' => $cotts,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ])->setPaper('legal', 'landscape');

        return $pdf->stream('cott.pdf', ['cotts' => $cotts, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function delete($id)
    {
        $cott = Cott::find($id);

        if ($cott) {
            $cott->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back();
    }
    
    public function delete_approval(Request $request,$id)
    {
        $data = Cott::findOrFail($id);
        $filteredData = $data->toArray();
        unset($filteredData['created_at'], $filteredData['updated_at'], $filteredData['deleted_at']);

        $for_approval = new DeletionRequest();
        $for_approval->item_id = $id;
        $for_approval->requestor_id = auth()->user()->id;
        $for_approval->status = "Pending Approval";
        $for_approval->reason = $request->reason;
        $for_approval->data = json_encode($filteredData);
        $for_approval->type = "Cott";
        $for_approval->save();

        return back();
    }
    public function approve_deletion($id)
    {
        $request = DeletionRequest::findOrFail($id);
        $item = Cott::findOrFail($request->item_id);

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
    
    public function statusCott($id, $status)
    {
        $cott = Cott::find($id);

        if ($cott) {
            $cott->status = $status;
            $cott->save();
            Alert::success(($status ? 'Approved' : 'Disapproved'), 'Records Updated Successfully');
        }

        return back();
    }

    public function approvedCott($id)
    {
        return $this->statusCott($id, 1);
    }

    public function disapprovedCott($id)
    {
        return $this->statusCott($id, 0);
    }

    public function preApprover($id)
    {
        if ($cott = Cott::find($id)) {
            $cott->pre_approved = auth()->user()->name;
            $cott->save();
            Alert::success('Approved', 'Records Updated Successfully');
        }

        return back();
    }

    public function add_demand(Request $request)
    {   
        // dd('mark');
        $cott = new DemandSupply();
        $cott->from = $request->from;
        $cott->to = $request->to;
        $cott->car = $request->car;
        $cott->ccc = $request->ccc;
        $cott->pbi = $request->pbi;
        $cott->type = 1;
        $cott->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    // Edit
    public function edit($id) {
        $cotts = Cott::find($id);
        // $suppliers = Supplier::all();
        return view('cott.edit', compact('cotts'));  
    }

    public function editApproved($id) {
        $cotts = Cott::find($id);
        // $suppliers = Supplier::all();
        return view('cott.editApproved', compact('cotts'));  
    }

    public function update(Request $request, $id)
    {
        $cotts = Cott::find($id);
        $cotts->name = $request->input('name');
        $cotts->destination = $request->input('destination');
        $cotts->food_grade = $request->input('food_grade');
        $cotts->origin = $request->input('origin');
        $cotts->offer_quantity = $request->input('offer_quantity');
        $cotts->buying_quantity = $request->input('buying_quantity');
        $cotts->original_price = $request->input('original_price');
        $cotts->buying_price = $request->input('buying_price');
        $cotts->expenses = $request->input('expenses');
        $cotts->price_expense = $request->input('price_expense');
        $cotts->moisture_content = $request->input('moisture_content');
        $cotts->delivery_schedule = $request->input('delivery_schedule');
        $cotts->terms_payment = $request->input('terms_payment');
        $cotts->potassium = $request->input('potassium');
        $cotts->chips_yield = $request->input('chips_yield');
        $cotts->powder_yield = $request->input('powder_yield');
        $cotts->price_yield = $request->input('price_yield');
        $cotts->forex_rate = $request->input('forex_rate');
        $cotts->price_usd = $request->input('price_usd');
        $cotts->cost_produce = $request->input('cost_produce');
        $cotts->price_ctp = $request->input('price_ctp');
        $cotts->remarks = $request->input('remarks');
        $cotts->area = $request->input('area');
        $cotts->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function editMultipleApproved(Request $request) {
        $cottIds = explode(',', $request->query('ids'));
        
        $cotts = Cott::whereIn('id', $cottIds)->get();
        
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
    
        return view('cott.editMultipleApproved', compact('cotts', 'start_date', 'end_date'));  
    }

    public function updateMultiple(Request $request)
    {
        $ids = $request->input('id');
        $names = $request->input('name');
        $destinations = $request->input('destination');
        $foodGrades = $request->input('food_grade');
        $origins = $request->input('origin');
        $offerQuantities = $request->input('offer_quantity');
        $buyingquantities = $request->input('buying_quantity');
        $uoms = $request->input('uom');
        $originalprices = $request->input('original_price');
        $buyingprices = $request->input('buying_price');
        // $expenses = $request->input('expenses');
        $priceexpenses = $request->input('price_expense');
        $moisturecontent = $request->input('moisture_content');
        $deliveryschedule = $request->input('delivery_schedule');
        $termpayments = $request->input('terms_payment');
        $potassiums = $request->input('potassium');
        $chipyields = $request->input('chips_yield');
        $powderyields = $request->input('powder_yield');
        $priceyields = $request->input('price_yield');
        $forexrates = $request->input('forex_rate');
        $priceusd = $request->input('price_usd');
        $costproduces = $request->input('cost_produce');
        $pricectps = $request->input('price_ctp');
        $remarks = $request->input('remarks');
        $areas = $request->input('area');
        
        foreach ($ids as $key => $id) {
            $cott = Cott::find($id);
            if ($cott) {
                $cott->name = $names[$key];
                $cott->destination = $destinations[$key];
                $cott->food_grade = $foodGrades[$key];
                $cott->origin = $origins[$key];
                $cott->offer_quantity = $offerQuantities[$key];
                $cott->buying_quantity = $buyingquantities[$key];
                $cott->uom = $uoms[$key];
                $cott->original_price = $originalprices[$key];
                $cott->buying_price = $buyingprices[$key];
                // $cott->expenses = $expenses[$key];
                $cott->price_expense = $priceexpenses[$key];
                $cott->moisture_content = $moisturecontent[$key];
                $cott->delivery_schedule = $deliveryschedule[$key];
                $cott->terms_payment = $termpayments[$key];
                $cott->potassium = $potassiums[$key];
                $cott->chips_yield = $chipyields[$key];
                $cott->powder_yield = $powderyields[$key];
                $cott->price_yield = $priceyields[$key];
                $cott->forex_rate = $forexrates[$key];
                $cott->price_usd = $priceusd[$key];
                $cott->cost_produce = $costproduces[$key];
                $cott->price_ctp = $pricectps[$key];
                $cott->remarks = $remarks[$key];
                $cott->area = isset($areas[$key]) ? $areas[$key] : null;
                $cott->save();
            }
        }

        // Redirect back to a relevant page (e.g., index page)
        return back();
    }
    
    public function pre_approval_cott($id)
    {
        $cott = Cott::find($id);
        $cott->approved = 0;
        $cott->status = 2;
        $cott->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }
}
