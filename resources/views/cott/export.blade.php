<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cottonii List</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<style>
     @page {
        size: legal landscape; 
        margin: 5px 15px; 
    }
    body {
        background-color: #FFF;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 8px;
        margin: 5px 10px;
    }
    
    #table-cotts th, #table-cotts td {
        border: 1px solid #DDD;
        padding: 3px
    }
    #table-side th, #table-side td {
        font-size: 7px;
        padding: 0px
    }
    #table-cotts1 th, #table-cotts1 td {
        border: 1px solid #DDD;
        padding: 1px;
        font-size: 7px;
    }
    #table-summary{
        margin: none;
        padding: none;
    }
    .box-container {
        width: 400px; 
        height: 50px; 
        border: 2px solid #DDD; 
        margin-top: 10px;
    }
    @page { margin: 5px 15px; }
    
</style>



<div class="row">
    {{-- <div class="col-12" align="center">
        <img alt="image" src="{{URL::asset('/images/wgroup.png')}}" style='width:120px;margin-bottom:-10px'>
        <h4>Sourcing Plan</h4>
    </div> --}}
    <h6>Date: {{ date('M d', strtotime($start_date)) }} - {{ date('M d, Y', strtotime($end_date)) }}</h5>
    <table class="table table-bordered table-responsive" id="table-cotts">
        <thead>
            <tr>
                <th>Seller's Name</th>
                <th>Destination (Plant)</th>
                <th>Food Grade/ Pet Food</th>
                <th>Origin</th>
                <th>Offer Quantity</th>
                <th>Buying Quantity</th>
                <th>UOM</th>
                <th>Original Price</th>
                <th>Buying Price</th>
                <th>Expenses</th>
                <th>Price + Expenses</th>
                <th>Agreed Moisture Content</th>
                <th>Delivery Schedule</th>
                <th>Terms of Payment</th>
                <th>Potassium Gel Strength (KGS)</th>
                <th>Chips Yield</th>
                <th>Powder Yield</th>
                <th>Price/ Yield</th>
                <th>FX Rate</th>
                <th>Price in USD</th>
                <th>Cost to Produce (Powder in USD)</th>
                <th>Price + CTP (Budget in USD)</th>
                <th>Remarks</th>
                <th>Pre Approved</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalOfferQuantity = 0;
                $totalBuyingQuantity = 0; 
            @endphp
            @if(count($cotts))
                @foreach($cotts->where('approved', 1) as $cott)
                    @php
                        // Ensure all necessary fields are numeric or cast them as zero if not
                        $offerQuantity = is_numeric($cott->offer_quantity) ? $cott->offer_quantity : 0;
                        $buyingQuantity = is_numeric($cott->buying_quantity) ? $cott->buying_quantity : 0;
                        $originalPrice = is_numeric($cott->original_price) ? $cott->original_price : 0;
                        $buyingPrice = is_numeric($cott->buying_price) ? $cott->buying_price : 0;
                        $expenses = is_numeric($cott->expenses) ? $cott->expenses : 0;
                        $priceExpense = is_numeric($cott->price_expense) ? $cott->price_expense : 0;
                        $chipsYield = is_numeric($cott->chips_yield) ? $cott->chips_yield : 0;
                        $powderYield = is_numeric($cott->powder_yield) ? $cott->powder_yield : 0;
                        $forexRate = is_numeric($cott->forex_rate) ? $cott->forex_rate : 0;
                        $priceUsd = is_numeric($cott->price_usd) ? $cott->price_usd : 0;
                        $costProduce = is_numeric($cott->cost_produce) ? $cott->cost_produce : 0;
                        $priceCtp = is_numeric($cott->price_ctp) ? $cott->price_ctp : 0;
                    @endphp
                    <tr>
                        <td>{{ $cott->name }}</td>
                        <td>{{ $cott->destination }}</td>
                        <td>{{ $cott->food_grade }}</td>
                        <td>{{ $cott->origin }}</td>
                        <td>{{ number_format($offerQuantity) }}</td>
                        <td>{{ number_format($buyingQuantity) }}</td>
                        <td>{{ $cott->uom }}</td>
                        <td>{{ number_format($originalPrice, 2) }}</td>
                        <td>{{ number_format($buyingPrice, 2) }}</td>
                        <td>{{ number_format($expenses, 2) }}</td>
                        <td>{{ number_format($priceExpense, 2) }}</td>
                        <td>{{ $cott->moisture_content }}</td>
                        <td>{{ $cott->delivery_schedule }}</td>
                        <td>{{ $cott->terms_payment }}</td>
                        <td>{{ $cott->potassium }}</td>
                        <td>{{ number_format($chipsYield, 2) }}%</td>
                        <td>{{ number_format($powderYield, 2) }} %</td>
                        <td>{{ $cott->price_yield }}</td>
                        <td>{{ number_format($forexRate, 2) }}</td>
                        <td>{{ number_format($priceUsd, 2) }}</td>
                        <td>{{ number_format($costProduce, 2) }}</td>
                        <td>{{ number_format($priceCtp, 2) }}</td>
                        <td>{{ $cott->remarks }}</td>
                        <td>{{ $cott->pre_approved }}</td>
                    </tr>
                    @php
                        $totalBuyingQuantity += $buyingQuantity;
                        $totalOfferQuantity += $offerQuantity;
                    @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="25" align="center">No Cottonii Found</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" align="right">Total:</td>
                <td>{{ number_format($totalOfferQuantity) }}</td>
                <td>{{ number_format($totalBuyingQuantity) }}</td>
                <td colspan="18"></td>
            </tr>
        </tfoot>
    </table>

    <table class="table table-borderless">
        <tbody>
            <tr>
                <td style="width: 20%; padding:0%;">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-cotts1">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Total Average Cost</th>
                                </tr>
                                <tr>
                                    <th width="30%">Item</th>
                                    <th width="34%">Quantity (MT)</th>
                                    <th width="36%"> Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $cost_total = 0;
                                @endphp
                                @for($i=1;$i<=8;$i++)
                                <tr>
                                    <td>1-{{$i}}</td>
                                    @php
                                        $cotts_data = $cotts->where('approved',1);
                                        if(array_key_exists($i-1,$cotts_data->toArray()))
                                        {
                                            $total = $total + $cotts_data[$i-1]->buying_quantity;
                                            $cost = $cotts_data[$i-1]->buying_quantity*$cotts_data[$i-1]->price_ctp;
                                            $cost_total = $cost_total + $cost; 
                                        }
                                    @endphp
                                    <td> 
                                        @if(array_key_exists($i-1,$cotts_data->toArray()))
                                            {{$total}} 
                                        @endif
                                    </td>
                                    <td>
                                        @if(array_key_exists($i-1,$cotts_data->toArray()))
                                            <!-- {{number_format($cost_total/$total,2)}} -->
                                            {{ sprintf("%.2f", $cost_total/$total) }}
                                        @endif
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div> 
                </td>
                <td style="width: 20%; padding:0%;">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-cotts1">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Total Average Cost</th>
                                </tr>
                                <tr>
                                    <th width="30%">Item</th>
                                    <th width="34%">Quantity (MT)</th>
                                    <th width="36%"> Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=9;$i<=16;$i++)
                                <tr>
                                    <td>1-{{$i}}</td>
                                    @php
                                        $cotts_data = $cotts->where('approved',1);
                                        if(array_key_exists($i-1,$cotts_data->toArray()))
                                        {
                                            $total = $total + $cotts_data[$i-1]->buying_quantity;
                                            $cost = $cotts_data[$i-1]->buying_quantity*$cotts_data[$i-1]->price_ctp;
                                            $cost_total = $cost_total + $cost; 
                                        }
                                    @endphp
                                    <td> 
                                        @if(array_key_exists($i-1,$cotts_data->toArray()))
                                            {{$total}} 
                                        @endif
                                    </td>
                                    <td>
                                        @if(array_key_exists($i-1,$cotts_data->toArray()))
                                            <!-- {{number_format($cost_total/$total,2)}} -->
                                            {{ sprintf("%.2f", $cost_total/$total) }}
                                        @endif
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div> 
                </td>
                <td style="width: 60%; padding-left: 80px; border: 0px solid #FFF">
                    @php
                        $totals = [
                            'CAR' => 0,
                            'CCC' => 0,
                            'PBI' => 0,
                        ];
                    @endphp
                    @foreach($cotts->where('approved', 1) as $cott)
                        @php
                            if ($cott->destination == 'CCC') {
                                $totals['CCC'] += $cott->buying_quantity;
                            } elseif ($cott->destination == 'CAR') {
                                $totals['CAR'] += $cott->buying_quantity ;
                            } elseif ($cott->destination == 'PBI') {
                                $totals['PBI'] += $cott->buying_quantity ;
                            } elseif ($cott->destination == 'CAR/PBI') {     
                                $totals['CAR'] += $cott->buying_quantity / 2;
                                $totals['PBI'] += $cott->buying_quantity / 2;
                            } elseif ($cott->destination == 'CCC/CAR') {     
                                $totals['CAR'] += $cott->buying_quantity / 2;
                                $totals['CCC'] += $cott->buying_quantity / 2;
                            }
                        @endphp
                    @endforeach  
                    @php
                        $totalDemand = $demandSupplies->sum('car') + $demandSupplies->sum('ccc') + $demandSupplies->sum('pbi');
                    @endphp           
                    <table id="table-side">
                        <thead>
                            <tr>
                                <th colspan="2" style="padding-right: 80px">QUANTITY DISTRIBUTION PER PLANT</th>
                                <th colspan="2">DEMAND AND SUPPLY AS OF {{ strtoupper(date('M d, Y', strtotime($end_date))) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CAR</td>
                                <td>{{$totals['CAR']}}&nbsp;MT</td>
                                <td>CAR</td>
                                <td>{{$demandSupplies->sum('car')}} MT</td>
                            </tr>
                            <tr>
                                <td>CCC</td>
                                <td>{{$totals['CCC']}}&nbsp;MT</td>
                                <td>CCC</td>
                                <td>{{$demandSupplies->sum('ccc')}} MT</td>
                            </tr>
                            <tr>
                                <td>PBI</td>
                                <td>{{$totals['PBI']}}&nbsp;MT</td>
                                <td>PBI</td>
                                <td>{{$demandSupplies->sum('pbi')}} MT</td>
                            </tr>
                        </tbody>
                        <tfoot style="border-top: 1px solid black">
                            <tr>
                                <td><b>Total</b></td>
                                <td>{{ array_sum($totals) }}&nbsp;MT</td>
                                <td><b>Total</b></td>
                                <td>{{ $totalDemand }} MT</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="box-container">
                        <label>Recommendation:</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 0px;" width="100%" id="table-summary">
        <thead>
            <tr>
                <td width="30%">Prepared By:</td>
                <td width="35%">Reviewed By:</td>
                <!-- <td width="25%"></td> -->
                <td width="35%">Approved By:</td>
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <td style="padding-top: 0px;">{{ auth()->user()->name }}</td>
                <td style="padding-top: 0px;">YEANESA MAE SAJA</td>
                <!-- <td style="padding-top: 20px;">MA MICHELLE PILOTON/JHANICE FABABAER</td> -->
                <td style="padding-top: 0px;">JLW</td>
            </tr>
            <tr>
                <td>___________________________________________</td>
                <td>___________________________________________</td>
                <!-- <td>___________________________________________</td> -->
                <td>___________________________________________</td>
            </tr>
            <tr>
                <td>SEAWEEDS PURCHASING SUPERVISOR</td>
                <td>SEAWEEDS PURCHASING MANAGER</td>
                <!-- <td>PLANT MANAGER</td -->
                <td>PRESIDENT</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
