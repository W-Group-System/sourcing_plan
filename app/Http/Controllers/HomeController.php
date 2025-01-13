<?php

namespace App\Http\Controllers;

use App\Cott;
use App\Spi;
use App\CottPo;
use App\SpiPo;
use Illuminate\Http\Request;
use App\Supplier;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
//    

// public function index()
// {
//     $suppliers = Supplier::all();
//     $cottonli = Cott::where('approved', 1)->get();
//     $spinossum = Spi::where('approved', 1)->get();

//     $supplierAreas = $suppliers->pluck('area', 'nickname')->toArray();

//     $weeklyQuantities = [];
//     $totalExpenses = []; 
//     $weightedPrices = []; 

//     foreach ($cottonli as $record) {
       
//         $date = new DateTime($record->created_at);
//         $date->modify('this week Monday');
//         $week = $date->format("Y-W"); 
//         $supplierArea = $supplierAreas[$record->name] ?? 'OTHERS'; 
        
//         $area = $supplierArea;
//         if ($record->name === 'DARWIN') {
//             if ($record->destination === 'CAR' && $record->expenses != "0.00") {
//                 $area = 'ZAMBO BS';
//             } elseif ($record->destination === 'CCC'  && ($record->expenses === "0.00" || empty($record->expenses))) {
//                 $area = 'CEBU';
//             } elseif ($record->destination === 'CAR' && ($record->expenses === "0.00" || empty($record->expenses))) {
//                 $area = 'OTHERS';
//             } elseif ($record->destination === 'CAR/CCC' && $record->expenses != "0.00") {
//                 $area = 'ZAMBO BS';
//             } else{
//                 $area = $supplierArea;
//             }
//         } elseif ($record->name === 'AGROMAR') {
//             if ($record->destination === 'CAR' && $record->expenses != "0.00") {
//                 $area = 'ZAMBO BS';
//             } elseif ($record->destination === 'CCC'  && ($record->expenses === "0.00" || empty($record->expenses))) {
//                 $area = 'CEBU';
//             } elseif ($record->destination === 'CAR' && ($record->expenses === "0.00" || empty($record->expenses))) {
//                 $area = 'OTHERS';
//             } elseif ($record->destination === 'CAR/CCC' && $record->expenses != "0.00") {
//                 $area = 'ZAMBO BS';
//             } else{
//                 $area = $supplierArea;
//             }
//         } elseif ($record->name === 'LUCIO') {
//             if ($record->destination === 'CAR' && $record->expenses != "0.00") {
//                 $area = 'ZAMBO BS';
//             } elseif ($record->destination === 'CCC'  && ($record->expenses === "0.00" || empty($record->expenses))) {
//                 $area = 'CEBU';
//             } elseif ($record->destination === 'CAR' && ($record->expenses === "0.00" || empty($record->expenses))) {
//                 $area = 'OTHERS';
//             } elseif ($record->destination === 'CAR/CCC' && $record->expenses != "0.00") {
//                 $area = 'ZAMBO BS';
//             }else{
//                 $area = $supplierArea;
//             }
//         } else {
//             $area = $supplierArea;
//         }
//         if (!isset($weeklyQuantities[$week])) {
//             $weeklyQuantities[$week] = [];
//         }
//         if (!isset($weeklyQuantities[$week][$area])) {
//             $weeklyQuantities[$week][$area] = 0;
//         }
//         $buying_quantity = $record->buying_quantity;
//         $price_expense = $record->price_expense;

//         if (!isset($totalExpenses[$week])) {
//             $totalExpenses[$week] = 0;
//         }
//         $totalExpenses[$week] += $buying_quantity * $price_expense;
//         $weeklyQuantities[$week][$area] += $buying_quantity;


//     }
//     foreach ($totalExpenses as $week => $totalExpense) {
//         $totalQuantity = array_sum($weeklyQuantities[$week]);
//         $weightedPrices[$week] = $totalExpense / $totalQuantity;
//     }
    
//     $spinossumAreas = $suppliers->pluck('area', 'nickname')->toArray();
//     $weeklySpiQuantities = [];
//     $totalSpiExpenses = []; 
//     $weightedSpiPrices = []; 
    
//     foreach ($spinossum as $spiRecord) {

//         $date = new DateTime($spiRecord->created_at);
//         $date->modify('this week Monday');
//         $week = $date->format("Y-W");
//         $supplierArea = $spinossumAreas[$spiRecord->name] ?? 'OTHERS'; 

//         $spiArea = $supplierArea;
//         if ($spiRecord->name === 'DARWIN') {
//             if ($spiRecord->destination === 'CAR' && $spiRecord->expenses != "0.00") {
//                 $spiArea = 'ZAMBO BS';
//             } elseif ($spiRecord->destination === 'CCC'  && ($spiRecord->expenses === "0.00" || empty($spiRecord->expenses))) {
//                 $spiArea = 'CEBU';
//             } elseif ($spiRecord->destination === 'CAR' && ($spiRecord->expenses === "0.00" || empty($spiRecord->expenses))) {
//                 $spiArea = 'OTHERS';
//             } elseif ($spiRecord->destination === 'CAR/CCC' && $spiRecord->expenses != "0.00") {
//                 $spiArea = 'ZAMBO BS';
//             } else{
//                 $spiArea = $supplierArea;
//             }
//         } elseif ($spiRecord->name === 'AGROMAR') {
//             if ($spiRecord->destination === 'CAR' && $spiRecord->expenses != "0.00") {
//                 $spiArea = 'ZAMBO BS';
//             } elseif ($spiRecord->destination === 'CCC'  && ($spiRecord->expenses === "0.00" || empty($spiRecord->expenses))) {
//                 $spiArea = 'CEBU';
//             } elseif ($spiRecord->destination === 'CAR' && ($spiRecord->expenses === "0.00" || empty($spiRecord->expenses))) {
//                 $spiArea = 'OTHERS';
//             } elseif ($spiRecord->destination === 'CAR/CCC' && $spiRecord->expenses != "0.00") {
//                 $spiArea = 'ZAMBO BS';
//             } else{
//                 $spiArea = $supplierArea;
//             }
//         } elseif ($spiRecord->name === 'LUCIO') {
//             if ($spiRecord->destination === 'CAR' && $spiRecord->expenses != "0.00") {
//                 $spiArea = 'ZAMBO BS';
//             } elseif ($spiRecord->destination === 'CCC'  && ($spiRecord->expenses === "0.00" || empty($spiRecord->expenses))) {
//                 $spiArea = 'CEBU';
//             } elseif ($spiRecord->destination === 'CAR' && ($spiRecord->expenses === "0.00" || empty($spiRecord->expenses))) {
//                 $spiArea = 'OTHERS';
//             } elseif ($spiRecord->destination === 'CAR/CCC' && $spiRecord->expenses != "0.00") {
//                 $spiArea = 'ZAMBO BS';
//             }else{
//                 $spiArea = $supplierArea;
//             }
//         } else {
//             $spiArea = $supplierArea;
//         }
       
//         if (!isset($weeklySpiQuantities[$week])) {
//             $weeklySpiQuantities[$week] = [];
//         }
//         if (!isset($weeklySpiQuantities[$week][$spiArea])) {
//             $weeklySpiQuantities[$week][$spiArea] = 0;
//         }
//         $buying_quantity = $spiRecord->buying_quantity;
//         $price_expense = $spiRecord->price_expense;
    
//         if (!isset($totalSpiExpenses[$week])) {
//             $totalSpiExpenses[$week] = 0;
//         }
//         $totalSpiExpenses[$week] += $buying_quantity * $price_expense;
//         // $weeklySpiQuantities[$week][$supplierArea] = ($weeklySpiQuantities[$week][$supplierArea] ?? 0) + $buying_quantity;
//         $weeklySpiQuantities[$week][$supplierArea] += $buying_quantity;
//     }
    
//     foreach ($totalSpiExpenses as $week => $totalExpense) {
//         $totalQuantity = array_sum($weeklySpiQuantities[$week]);
//         $weightedSpiPrices[$week] = $totalExpense / $totalQuantity;
//     }
    
//     return view('home', compact('suppliers', 'cottonli', 'spinossum', 'weeklyQuantities', 'weightedPrices', 'weeklySpiQuantities', 'weightedSpiPrices'));
// }

// Jun 
// public function index()
// {
//     $suppliers = Supplier::all();
//     $cottonli = Cott::where('approved', 1)->get();
//     $spinossum = Spi::where('approved', 1)->get();

//     $weeklyQuantities = [];
//     $totalExpenses = []; 
//     $weightedPrices = []; 

//     foreach ($cottonli as $record) {
       
//         $date = new DateTime($record->created_at);
//         $date->modify('this week Monday');
//         $week = $date->format("Y-W"); 
//         $cottArea = $record->area; 
        
//         // $area = $cottArea;
       
//         // if (!isset($weeklyQuantities[$week])) {
//         //     $weeklyQuantities[$week] = [];
//         // }
//         // if (!isset($weeklyQuantities[$week][$area])) {
//         //     $weeklyQuantities[$week][$area] = 0;
//         // }
//         // $buying_quantity = $record->buying_quantity;
//         // $price_expense = $record->price_expense;

//         // if (!isset($totalExpenses[$week])) {
//         //     $totalExpenses[$week] = 0;
//         // }
//         // $totalExpenses[$week] += $buying_quantity * $price_expense;
//         // $weeklyQuantities[$week][$area] += $buying_quantity;
//         if (!empty($cottArea)) {
//             $area = $cottArea;
    
//             if (!isset($weeklyQuantities[$week])) {
//                 $weeklyQuantities[$week] = [];
//             }
//             if (!isset($weeklyQuantities[$week][$area])) {
//                 $weeklyQuantities[$week][$area] = 0;
//             }
    
//             $buying_quantity = $record->buying_quantity;
//             $price_expense = $record->price_expense;
    
//             if (!isset($totalExpenses[$week])) {
//                 $totalExpenses[$week] = 0;
//             }
//             $totalExpenses[$week] += $buying_quantity * $price_expense;
//             $weeklyQuantities[$week][$area] += $buying_quantity;
//         }

//     }
//     foreach ($totalExpenses as $week => $totalExpense) {
//         $totalQuantity = array_sum($weeklyQuantities[$week]);
//         $weightedPrices[$week] = $totalExpense / $totalQuantity;

//     }
    
//     $weeklySpiQuantities = [];
//     $totalSpiExpenses = []; 
//     $weightedSpiPrices = []; 
    
//     foreach ($spinossum as $spiRecord) {

//         $date = new DateTime($spiRecord->created_at);
//         $date->modify('this week Monday');
//         $week = $date->format("Y-W");
//         $spiArea =$spiRecord->area; 

//         if (!empty($spiArea)) {
//             $area = $spiArea;

//             if (!isset($weeklySpiQuantities[$week])) {
//                 $weeklySpiQuantities[$week] = [];
//             }
//             if (!isset($weeklySpiQuantities[$week][$area])) {
//                 $weeklySpiQuantities[$week][$area] = 0;
//             }
//             $buying_quantity = $spiRecord->buying_quantity;
//             $price_expense = $spiRecord->price_expense;
        
//             if (!isset($totalSpiExpenses[$week])) {
//                 $totalSpiExpenses[$week] = 0;
//             }
//             $totalSpiExpenses[$week] += $buying_quantity * $price_expense;
//             $weeklySpiQuantities[$week][$area] += $buying_quantity;
//         }
       
//     }
    
//     foreach ($totalSpiExpenses as $week => $totalExpense) {
//         $totalQuantity = array_sum($weeklySpiQuantities[$week]);
//         $weightedSpiPrices[$week] = $totalExpense / $totalQuantity;
//     }
    
//     return view('home', compact('suppliers', 'cottonli', 'spinossum', 'weeklyQuantities', 'weightedPrices', 'weeklySpiQuantities', 'weightedSpiPrices'));
// }

public function index(Request $request)
{
    $suppliers = Supplier::all();
    $currentYear = date('Y');
    $currentQuarter = ceil(date('n') / 3);

    // $cottYears = Cott::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year')->toArray();
    // $spiYears = Spi::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year')->toArray();

    // $years = array_unique(array_merge($cottYears, $spiYears));
    // sort($years);

    // $year = $request->input('year', $currentYear);
    // $quarter = $request->input('quarter', $currentQuarter);

    // $quarterStart = new DateTime("$year-" . (($quarter - 1) * 3 + 1) . "-01");
    // $quarterEnd = clone $quarterStart;
    // $quarterEnd->modify('+3 months -1 day');

    $startDate = $request->input('filter_start');
    $endDate = $request->input('filter_end');

    $startDate = $startDate ? new DateTime($startDate . '-01') : null;
    $endDate = $endDate ? (new DateTime($endDate . '-01'))->modify('last day of this month') : null;

    $cottonli = Cott::where('approved', 1)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get();
        
    $spinossum = Spi::where('approved', 1)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get();
    // $cottonli = Cott::where('approved', 1)
    //     ->whereBetween('created_at', [$quarterStart, $quarterEnd])
    //     ->get();
        
    // $spinossum = Spi::where('approved', 1)
    //     ->whereBetween('created_at', [$startDate, $endDate])
    //     ->get();

    $cottonii_po = CottPo::whereBetween('po_date', [$startDate, $endDate])
        ->orWhereBetween('created_at', [$startDate, $endDate])
        ->get();
    $spinossum_po = SpiPo::whereBetween('po_date', [$startDate, $endDate])
        ->orWhereBetween('created_at', [$startDate, $endDate])
        ->get();
    
    $weeklyQuantities = [];
    $totalExpenses = []; 
    $weightedPrices = []; 

    // Process Cott records
    foreach ($cottonli as $record) {
        $date = new DateTime($record->created_at);
        $date->modify('this week Monday');
        $week = $date->format("Y-W"); 
        $cottArea = $record->area;

        if (!empty($cottArea)) {
            $area = $cottArea;

            if (!isset($weeklyQuantities[$week])) {
                $weeklyQuantities[$week] = [];
            }
            if (!isset($weeklyQuantities[$week][$area])) {
                $weeklyQuantities[$week][$area] = 0;
            }

            $buying_quantity = $record->buying_quantity;
            $price_expense = $record->price_expense;

            if (!isset($totalExpenses[$week])) {
                $totalExpenses[$week] = 0;
            }
            $totalExpenses[$week] += $buying_quantity * $price_expense;
            $weeklyQuantities[$week][$area] += $buying_quantity;
        }
    }

   
    foreach ($cottonii_po as $record) {
        $date = new DateTime($record->po_date ?? $record->created_at);
        $date->modify('this week Monday');
        $week = $date->format("Y-W"); 
        $cottArea = $record->area;

        if (!empty($cottArea)) {
            $area = $cottArea;

            if (!isset($weeklyQuantities[$week])) {
                $weeklyQuantities[$week] = [];
            }
            if (!isset($weeklyQuantities[$week][$area])) {
                $weeklyQuantities[$week][$area] = 0;
            }

            $buying_quantity = $record->quantity;
            $price_expense = $record->price_expenses;

            if (!isset($totalExpenses[$week])) {
                $totalExpenses[$week] = 0;
            }
            $totalExpenses[$week] += $buying_quantity * $price_expense;
            $weeklyQuantities[$week][$area] += $buying_quantity;
        }
    }

    foreach ($totalExpenses as $week => $totalExpense) {
        $totalQuantity = array_sum($weeklyQuantities[$week]);
        $weightedPrices[$week] = $totalExpense / $totalQuantity;
    }

    $filteredWeeklyQuantities = [];
    $filteredTotalExpenses = [];

    foreach ($weeklyQuantities as $week => $areaQuantities) {
        list($year, $weekNumber) = explode('-', $week);
        $weekDate = new DateTime();
        $weekDate->setISODate($year, $weekNumber);
        if ($weekDate >= $startDate && $weekDate <= $endDate) {
            $filteredWeeklyQuantities[$week] = $areaQuantities;
            $filteredTotalExpenses[$week] = $totalExpenses[$week];
        }
    }

    $filteredWeightedPrices = [];
    foreach ($filteredTotalExpenses as $week => $totalExpense) {
        $totalQuantity = array_sum($filteredWeeklyQuantities[$week]);
        if ($totalQuantity > 0) {
            $filteredWeightedPrices[$week] = $totalExpense / $totalQuantity;
        } else {
            $filteredWeightedPrices[$week] = 0;
        }
    }
    $weeklySpiQuantities = [];
    $totalSpiExpenses = []; 
    $weightedSpiPrices = []; 

    foreach ($spinossum as $spiRecord) {
        $date = new DateTime($spiRecord->created_at);
        $date->modify('this week Monday');
        $week = $date->format("Y-W");
        $spiArea = $spiRecord->area; 

        if (!empty($spiArea)) {
            $area = $spiArea;

            if (!isset($weeklySpiQuantities[$week])) {
                $weeklySpiQuantities[$week] = [];
            }
            if (!isset($weeklySpiQuantities[$week][$area])) {
                $weeklySpiQuantities[$week][$area] = 0;
            }

            $buying_quantity = $spiRecord->buying_quantity;
            $price_expense = $spiRecord->price_expense;

            if (!isset($totalSpiExpenses[$week])) {
                $totalSpiExpenses[$week] = 0;
            }
            $totalSpiExpenses[$week] += $buying_quantity * $price_expense;
            $weeklySpiQuantities[$week][$area] += $buying_quantity;
        }
    }

    $filteredWeeklySpiQuantities = [];
    $filteredTotalSpiExpenses = [];

    foreach ($filteredTotalSpiExpenses as $week => $totalExpense) {
        $totalQuantity = array_sum($filteredWeeklySpiQuantities[$week]);
        if ($totalQuantity > 0) {
            $filteredWeightedSpiPrices[$week] = $totalExpense / $totalQuantity;
        } else {
            $filteredWeightedSpiPrices[$week] = 0;
        }
    }
    
    foreach ($spinossum_po as $spiRecord) {
        $date = new DateTime($spiRecord->po_date ?? $spiRecord->created_at);
        $date->modify('this week Monday');
        $week = $date->format("Y-W"); 
        $spiArea = $spiRecord->area;

        if (!empty($spiArea)) {
            $area = $spiArea;

            if (!isset($weeklySpiQuantities[$week])) {
                $weeklySpiQuantities[$week] = [];
            }
            if (!isset($weeklySpiQuantities[$week][$area])) {
                $weeklySpiQuantities[$week][$area] = 0;
            }

            $buying_quantity = $spiRecord->quantity;
            $price_expense = $spiRecord->price_expenses;

            if (!isset($totalSpiExpenses[$week])) {
                $totalSpiExpenses[$week] = 0;
            }
            $totalSpiExpenses[$week] += $buying_quantity * $price_expense;
            $weeklySpiQuantities[$week][$area] += $buying_quantity;
        }
    }

    foreach ($totalSpiExpenses as $week => $totalExpense) {
        $totalQuantity = array_sum($weeklySpiQuantities[$week]);

        if ($totalQuantity > 0) {
            $weightedSpiPrices[$week] = $totalExpense / $totalQuantity;
        } else {
            $weightedSpiPrices[$week] = 0; 
        }
    }

    return view('home', compact('suppliers', 'cottonli', 'spinossum', 'filteredWeeklyQuantities', 'filteredWeightedPrices', 'weeklySpiQuantities', 'weightedSpiPrices'));
}


    public function changePassword()
    {
        return view('layouts.change_password');
    }
    
    public function updatePassword(Request $request)
    {   
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old password doesn't match!");
        }
           
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
