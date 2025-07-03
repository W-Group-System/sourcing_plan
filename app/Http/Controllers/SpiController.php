<?php

namespace App\Http\Controllers;
use App\DeletionRequest;
use App\Spi;
use App\Supplier;
use App\DemandSupply;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use PDF;
use View;

class SpiController extends Controller
{
    // list
    public function index()
    {   
        $spis = Spi::orderBy('price_yield', 'asc')->get();
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
            $data->pes = $request->pes[$key];
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

    public function addCommentsSpi(Request $request, $id)
    {
        $data = SPI::find($id);
        $data->comments = $request->input('comments');
        $data->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function dateFilter($start_date, $end_date) 
    {
        return SPI::whereDate('created_at','>=',$start_date)
                    ->whereDate('created_at','<=',$end_date)
                    ->orderBy('status', 'desc')
                    ->orderBy('price_yield','asc')
                    ->get();
    }

    public function dateFilterTwo($start_date, $end_date) 
    {
        return SPI::whereDate('created_at','>=',$start_date)
                    ->whereDate('created_at','<=',$end_date)
                    ->where('approved', 0)
                    ->orderBy('status', 'desc')
                    ->orderBy('price_yield','asc')
                    ->get();
    }

    public function filterSpi(Request $request) 
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();

        $spis = $this->dateFilter($start_date, $end_date);
        
        // return view('spi.index', compact('spis'));  
        return view('spi.index', ['spis' => $spis, 'start_date' => $start_date, 'end_date' => $end_date]);
    }
    
    public function export_spi_pdf(Request $request)
    {   
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();

        $spis = $this->dateFilter($start_date, $end_date);

        $demandSupplies = DemandSupply::whereDate('from', '>=', $start_date)
            ->whereDate('to', '<=', $end_date)
            ->where('type', '=', 2)
            ->get();

        View::share('demandSupplies', $demandSupplies);

        // $spis = SPI::all();
        $pdf = PDF::loadView('spi.export', [
            'spis' => $spis,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ])->setPaper('legal', 'landscape');

        return $pdf->stream('spi.pdf', ['spis' => $spis, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function for_approval_spi(Request $request)
    {   
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();

        // Ensure dateFilter returns a query builder and use orderBy to sort by price_yield
        $spis = $this->dateFilterTwo($start_date, $end_date)->sortBy('price_yield');

        $demandSupplies = DemandSupply::whereDate('from', '>=', $start_date)
            ->whereDate('to', '<=', $end_date)
            ->where('type', '=', 2)
            ->get();

        View::share('demandSupplies', $demandSupplies);

        $pdf = PDF::loadView('spi.for_approval', [
            'spis' => $spis,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ])->setPaper('legal', 'landscape');

        return $pdf->stream('spi.pdf', ['spis' => $spis, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'checkbox' => 'required|array',
        ]);

        $action = $request->input('action'); 

        foreach ($request->input('checkbox') as $id) {
            $data = Spi::find($id);
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

    public function delete($id)
    {
        $data = Spi::find($id);

        if ($data) {
            $data->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back();
    }

    public function delete_approval(Request $request,$id)
    {
        $data = Spi::findOrFail($id);
        $filteredData = $data->toArray();
        unset($filteredData['created_at'], $filteredData['updated_at'], $filteredData['deleted_at']);

        $for_approval = new DeletionRequest();
        $for_approval->item_id = $id;
        $for_approval->requestor_id = auth()->user()->id;
        $for_approval->status = "Pending Approval";
        $for_approval->data = json_encode($filteredData);
        $for_approval->reason = $request->reason;
        $for_approval->type = "Spi";
        $for_approval->save();

        return back();
    }

    public function approve_deletion($id)
    {
        $request = DeletionRequest::findOrFail($id);
        $item = Spi::findOrFail($request->item_id);

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

    public function preStatus($id, $status)
    {
        $spi = Spi::find($id);

        if ($spi) {
            $spi->status = $status;
            $spi->save();
            Alert::success(($status ? 'Approved' : 'Disapproved'), 'Records Updated Successfully');
        }

        return back();
    }

    public function approvedStatus($id)
    {
        return $this->preStatus($id, 1);
    }

    public function disapprovedStatus($id)
    {
        return $this->preStatus($id, 0);
    }

    public function preApproverSpi($id)
    {
        if ($spi = SPI::find($id)) {
            $spi->pre_approved = auth()->user()->name;
            $spi->save();
            Alert::success('Approved', 'Records Updated Successfully');
        }

        return back();
    }

    public function add_demand_spi(Request $request)
    {   
        // dd('mark');
        $cott = new DemandSupply();
        $cott->from = $request->from;
        $cott->to = $request->to;
        $cott->car = $request->car;
        $cott->ccc = $request->ccc;
        $cott->pbi = $request->pbi;
        $cott->type = 2;
        $cott->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function edit($id) {
        $spis = Spi::find($id);
        return view('spi.edit', compact('spis'));  
    }

    public function editApproved($id) {
        $spis = Spi::find($id);
        // $suppliers = Supplier::all();
        return view('spi.editApproved', compact('spis'));  
    }
    
    public function update(Request $request, $id)
    {
        $spis = Spi::find($id);
        $spis->pes = $request->input('pes');
        $spis->destination = $request->input('destination');
        $spis->origin = $request->input('origin');
        $spis->offer_quantity = $request->input('offer_quantity');
        $spis->buying_quantity = $request->input('buying_quantity');
        $spis->original_price = $request->input('original_price');
        $spis->buying_price = $request->input('buying_price');
        $spis->expenses = $request->input('expenses');
        $spis->price_expense = $request->input('price_expense');
        $spis->moisture_content = $request->input('moisture_content');
        $spis->delivery_schedule = $request->input('delivery_schedule');
        $spis->terms_payment = $request->input('terms_payment');
        $spis->potassium = $request->input('potassium');
        $spis->chips_yield = $request->input('chips_yield');
        $spis->price_yield = $request->input('price_yield');
        $spis->forex_rate = $request->input('forex_rate');
        $spis->price_usd = $request->input('price_usd');
        $spis->cost_produce = $request->input('cost_produce');
        $spis->price_ctp = $request->input('price_ctp');
        $spis->remarks = $request->input('remarks');
        $spis->area = $request->input('area');   
          
        $spis->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function editMultipleApproved(Request $request) {
        $spiIds = explode(',', $request->query('ids'));
        
        $spis = Spi::whereIn('id', $spiIds)->get();
        
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
    
        return view('spi.editMultipleApproved', compact('spis', 'start_date', 'end_date'));  
    }

    public function updateMultiple(Request $request){
            $ids = $request->input('id');
            $names = $request->input('name');
            $destinations = $request->input('destination');
            $pes = $request->input('pes');
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
            $spis = Spi::find($id);
            if ($spis) {
                $spis->name = $names[$key];
                $spis->destination = $destinations[$key];
                $spis->pes = $pes[$key];
                $spis->origin = $origins[$key];
                $spis->offer_quantity = $offerQuantities[$key];
                $spis->buying_quantity = $buyingquantities[$key];
                $spis->uom = $uoms[$key];
                $spis->original_price = $originalprices[$key];
                $spis->buying_price = $buyingprices[$key];
                // $spis->expenses = $expenses[$key];
                $spis->price_expense = $priceexpenses[$key];
                $spis->moisture_content = $moisturecontent[$key];
                $spis->delivery_schedule = $deliveryschedule[$key];
                $spis->terms_payment = $termpayments[$key];
                $spis->potassium = $potassiums[$key];
                $spis->chips_yield = $chipyields[$key];
                $spis->powder_yield = $powderyields[$key];
                $spis->price_yield = $priceyields[$key];
                $spis->forex_rate = $forexrates[$key];
                $spis->price_usd = $priceusd[$key];
                $spis->cost_produce = $costproduces[$key];
                $spis->price_ctp = $pricectps[$key];
                $spis->remarks = $remarks[$key];
                $spis->area = $areas[$key];
                $spis->area = isset($areas[$key]) ? $areas[$key] : null;
                $spis->save();
            }
        }
        return back();
    }
    
    public function disapprovedComments(Request $request, $id)
    {
        $spi = Spi::find($id);
        $spi->comments = $request->input('comments');
        $spi->status = 0;
        $spi->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function pre_approval_spi($id)
    {
        $spi = Spi::find($id);
        $spi->approved = 0;
        $spi->status = 2;
        $spi->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }
}