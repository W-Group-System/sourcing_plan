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
    body {
        background-color: #FFF;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        margin: 5px 15px;
        color: black;
    }
    #table-cotts th, #table-cotts td {
        border: 1px solid #DDD;
        padding: 5px
    }
    #table-side th, #table-side td {
        font-size: 10px;
        padding: 5px
    }
    .box-container {
        width: 500px; 
        height: 100px; 
        border: 2px solid #DDD; 
        margin-top: 20px;
    }
    .status {
        background-color: #d4e7c5;
        color: black;
    }
    @page { margin: 5px 15px; }
    
</style>



<div class="row">
    <div class="col-12" align="center">
        <img alt="image" src="{{URL::asset('/images/wgroup.png')}}" style='width:120px;margin-bottom:-10px'>
        <h4>Sourcing Plan</h4>
    </div>
    <h5>Date: {{ date('M d', strtotime($start_date)) }} - {{ date('M d, Y', strtotime($end_date)) }}</h5>
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
                <th>Pre Aprroved</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalOfferQuantity = 0;
                $totalBuyingQuantity = 0; 
            @endphp
            @if(count($cotts))
                @foreach($cotts->whereIn('status', [1, 0])->sortByDesc(function($cott) {
                    return $cott->status == 1 ? 1 : 0;
                }) as $cott)
                    <tr class="{{ $cott->status == 1 ? 'status' : '' }}">
                        <td>{{$cott->name}}</td>
                        <td>{{$cott->destination}}</td>
                        <td>{{$cott->food_grade}}</td>
                        <td>{{$cott->origin}}</td>
                        <td>{{$cott->offer_quantity}}</td>
                        <td>{{$cott->buying_quantity}}</td>
                        <td>{{$cott->uom}}</td>
                        <td>{{$cott->original_price}}</td>
                        <td>{{$cott->buying_price}}</td>
                        <td>{{$cott->expenses}}</td>
                        <td>{{$cott->price_expense}}</td>
                        <td>{{$cott->moisture_content}}</td>
                        <td>{{$cott->delivery_schedule}}</td>
                        <td>{{$cott->terms_payment}}</td>
                        <td>{{$cott->potassium}}</td>
                        <td>{{ number_format($cott->chips_yield, 2) }}%</td>
                        <td>{{ number_format($cott->powder_yield, 2) }} %</td>
                        <td>{{$cott->price_yield}}</td>
                        <td>{{$cott->forex_rate}}</td>
                        <td>{{$cott->price_usd}}</td>
                        <td>{{$cott->cost_produce}}</td>
                        <td>{{$cott->price_ctp}}</td>
                        <td>{{$cott->remarks}}</td>
                        <td>{{$cott->pre_approved}}</td>
                    </tr>
                    @php
                        $totalOfferQuantity += $cott->offer_quantity; 
                    @endphp
                    @if($cott->status == 1)
                        @php
                            $totalBuyingQuantity += $cott->buying_quantity; 
                        @endphp
                    @endif
                @endforeach
            @else
            <tr>
                <td colspan="25" align="center">No Cottonii Found</td>
            </tr>
        </tbody>
        @endif
        <tfoot>
            <tr>
                <td colspan="4" align="right">Total:</td>
                <td>{{$totalOfferQuantity}}</td>
                <td class="status">{{$totalBuyingQuantity}}</td>
                <td colspan="18"></td>
            </tr>
        </tfoot>
    </table>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td style="width: 20%; padding:0%;">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-cotts">
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
                                    $cottsWithStatus1 = $cotts->where('status', 1)->sortBy('status');
                                    $cot = $cottsWithStatus1->keys()->last();
                                    $total = 0;
                                    $cost_total = 0;
                                @endphp
                                @for($i=1;$i<=8;$i++)
                                <tr @if($cot == $i-1) class='status' @endif>
                                    <td>1-{{$i}}</td>
                                    @php
                                        $cotts_data = $cotts->whereIn('status', [1,0]);
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
                                    <td >
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
                        <table class="table table-bordered" id="table-cotts">
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
                                <tr @if($cot == $i-1) class='status' @endif>
                                    <td>1-{{$i}}</td>
                                    @php
                                        $cotts_data = $cotts->whereIn('status', [1,0]);
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
                    @foreach($cotts->where('status', 1) as $cott)
                        @php
                            if ($cott->destination == 'CCC') {
                                $totals['CCC'] += $cott->buying_quantity;
                            } elseif ($cott->destination == 'CAR') {
                                $totals['CAR'] += $cott->buying_quantity ;
                            } elseif ($cott->destination == 'CAR/PBI') {     
                                $totals['CAR'] += $cott->buying_quantity / 2;
                                $totals['PBI'] += $cott->buying_quantity / 2;
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
    <table style="margin-top: 30px;" width="100%">
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
                <td style="padding-top: 20px;">KIARA BEATRIZ GALIMAO</td>
                <td style="padding-top: 20px;">YEANESA MAE SAJA</td>
                <!-- <td style="padding-top: 20px;">MA MICHELLE PILOTON/JHANICE FABABAER</td> -->
                <td style="padding-top: 20px;">JLW</td>
            </tr>
            <tr>
                <td>___________________________________________</td>
                <td>___________________________________________</td>
                <!-- <td>___________________________________________</td> -->
                <td>___________________________________________</td>
            </tr>
            <tr>
                <td>SEAWEEDS PURCHASING SUPERVISOR</td>
                <td>ASST. SEAWEEDS PURCHASING MANAGER</td>
                <!-- <td>PLANT MANAGER</td -->
                <td>PRESIDENT</td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
