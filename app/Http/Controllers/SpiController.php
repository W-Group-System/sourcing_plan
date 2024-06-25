<?php

namespace App\Http\Controllers;
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

        $spis = $this->dateFilter($start_date, $end_date)->orderBy('price_yield', 'asc')->get();

        $demandSupplies = DemandSupply::whereDate('from', '>=', $start_date)
            ->whereDate('to', '<=', $end_date)
            ->where('type', '=', 2)
            ->get();

        View::share('demandSupplies', $demandSupplies);

        // $spis = SPI::all();
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
        $spis->origin = $request->input('origin');
        $spis->offer_quantity = $request->input('offer_quantity');
        $spis->buying_quantity = $request->input('buying_quantity');
        $spis->original_price = $request->input('original_price');
        $spis->delivery_schedule = $request->input('delivery_schedule');
        $spis->terms_payment = $request->input('terms_payment');
        $spis->potassium = $request->input('potassium');
        $spis->remarks = $request->input('remarks');
     
        $spis->update();
        Alert::success('Success Title', 'Success Message');
        return back();
    }
}
