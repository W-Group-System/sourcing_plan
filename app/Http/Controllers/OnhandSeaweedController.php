<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\OnhandSeaweed;
use App\Plant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

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

        $onhands = $query->orderBy('date_updated')->get();
        $weeklyOnhands = $onhands->groupBy(function ($item) {
            $date = \Carbon\Carbon::parse($item->date_updated);

            return $date->format('Y-W');
        });

        return view('onhand_seaweed.index', compact('onhands','weeklyOnhands','plants'));  
    }

    public function create()
    {     
        $plants = Plant::all();
        $inventories = Inventory::all();
        return view('onhand_seaweed.create', compact('plants', 'inventories'));
    }

    public function store_onhand(Request $request)
    {   
        $dateUpdated = Carbon::parse($request->date_updated);

        $weekStart = $dateUpdated->copy()->startOfWeek(Carbon::MONDAY);
        $weekEnd = $dateUpdated->copy()->endOfWeek(Carbon::SUNDAY);

        $existingRecord = OnhandSeaweed::whereBetween(
            'date_updated',
            [
                $weekStart->format('Y-m-d'),
                $weekEnd->format('Y-m-d')
            ]
        )->first();

        if ($existingRecord) {

            Alert::error(
                'Duplicate Week',
                'There is already an On-Hand record for this calendar week (' .
                $weekStart->format('F d') . ' - ' .
                $weekEnd->format('F d, Y') . ').'
            );

            return back()->withInput();
        }
        foreach ($request->plants as $plant) {

            $data = new OnhandSeaweed();

            $data->plant_id = $plant['plant_id'];
            $data->quantity = $plant['quantity'];
            $data->plant_consumption = $plant['plant_consumption'];
            $data->no_of_days = $plant['no_of_days'];

            $data->date_updated = $request->date_updated;

            $data->save();
        }

        Alert::success('Onhand Seaweeds', 'Records Successfully Added');
        return back();
    }

    public function edit_onhand(Request $request)
    {   
        $dateUpdated = Carbon::parse($request->date_updated);

        $weekStart = $dateUpdated->copy()->startOfWeek(Carbon::MONDAY);
        $weekEnd = $dateUpdated->copy()->endOfWeek(Carbon::SUNDAY);

        $editingIds = collect($request->plants)
            ->pluck('id')
            ->filter()
            ->toArray();

        $existingRecord = OnhandSeaweed::whereBetween(
            'date_updated',
            [
                $weekStart->format('Y-m-d'),
                $weekEnd->format('Y-m-d')
            ]
        )
        ->whereNotIn('id', $editingIds)
        ->first();

        if ($existingRecord) {

            Alert::error(
                'Duplicate Week',
                'There is already an On-Hand record for this calendar week (' .
                $weekStart->format('F d') . ' - ' .
                $weekEnd->format('F d, Y') . ').'
            );

            return back()->withInput();
        }

        foreach ($request->plants as $plant) {

            $data = OnhandSeaweed::find($plant['id']);

            if ($data) {

                $data->plant_id = $plant['plant_id'];
                $data->quantity = $plant['quantity'];
                $data->plant_consumption = $plant['plant_consumption'];
                $data->no_of_days = $plant['no_of_days'];
                $data->date_updated = $request->date_updated;

                $data->save();
            }
        }

        Alert::success('Onhand Seaweeds', 'Records Successfully Added');
        return back();
    }
}