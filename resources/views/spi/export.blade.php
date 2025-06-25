<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spinosum List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            margin: 5px 15px;
        }
        #table-spis th, #table-spis td {
            border: 1px solid #DDD;
            padding: 3px
        }
        #table-side th, #table-side td {
            font-size: 7px;
            padding: 0px
        }
        #table-spis1 th, #table-spis1 td {
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
        <h6>Date: {{ date('M-d', strtotime($start_date)) }} - {{ date('d-Y', strtotime($end_date)) }}</h5>
        <table class="table table-bordered table-responsive" id="table-spis">
            <thead>
                <tr>
                    <th>Seller's Name</th>
                    <th>Destination (Plant)</th>
                    <th>PES</th>
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
                    <th>Calcium Gel Strength (CaGS)</th>
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
                @if(count($spis))
                    @foreach($spis->whereIn('status', [1,0]) as $spi)
                        <tr>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->name}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->destination}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->pes}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->origin}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->offer_quantity}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->buying_quantity}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->uom}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->original_price ?$spi->original_price : 'Non-nego'}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->buying_price}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->expenses ? $spi->expenses : '-'}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->price_expense}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->moisture_content}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->delivery_schedule}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->terms_payment}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->potassium}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{($spi->chips_yield)}}%</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->powder_yield}}%</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->price_yield}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->forex_rate}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->price_usd}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->cost_produce}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->price_ctp}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->remarks}}</td>
                            <td class="{{ $spi->status == 1 ? 'status' : '' }}">{{$spi->pre_approved}}</td>
                        </tr>
                        @php
                            $totalBuyingQuantity += $spi->buying_quantity; 
                            $totalOfferQuantity += $spi->offer_quantity; 
                        @endphp
                    @endforeach
                @else
                <tr>
                    <td colspan="24" align="center">No Spinosum Found</td>
                </tr>    
            </tbody>
            @endif
            <tfoot>
                <tr>
                    <td colspan="4" align="right">Total:</td>
                    <td>{{$totalOfferQuantity}}</td>
                    <td>{{$totalBuyingQuantity}}</td>
                    <td colspan="18"></td>
                </tr>
            </tfoot>
        </table>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td style="width: 20%; padding:0%;">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-spis1">
                                <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: center";>Total Average Cost</th>
                                    </tr>
                                    <tr>
                                        <th width="30%">Item</th>
                                        <th width="34%">Quantity (MT)</th>
                                        <th width="36%">Cost</th>
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
                                            $spis_data = $spis->where('approved',1);
                                            if(array_key_exists($i-1,$spis_data->toArray()))
                                            {
                                                $total = $total + $spis_data[$i-1]->buying_quantity;
                                                $cost = $spis_data[$i-1]->buying_quantity*$spis_data[$i-1]->price_ctp;
                                                $cost_total = $cost_total +$cost; 
                                            }
                                        @endphp
                                        <td>
                                            @if(array_key_exists($i-1,$spis_data->toArray()))
                                                {{$total}}
                                            @endif
                                        </td>
                                        <td>
                                        @if(array_key_exists($i-1,$spis_data->toArray()))
                                            {{number_format($cost_total/$total,2)}}
                                        @endif</td>
                                    </tr>
                                    @endfor
                                    
                                </tbody>
                            </table>
                        </div> 
                    </td>
                    <td style="width: 20%; padding:0%;">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-spis1">
                                <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: center";>Total Average Cost</th>
                                    </tr>
                                    <tr>
                                        <th width="30%">Item</th>
                                        <th width="34%">Quantity (MT)</th>
                                        <th width="36%">Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                        $cost_total = 0;
                                    @endphp
                                    @for($i=9;$i<=16;$i++)
                                    <tr>
                                        <td>1-{{$i}}</td>
                                        @php
                                            $spis_data = $spis->where('approved',1);
                                            if(array_key_exists($i-1,$spis_data->toArray()))
                                            {
                                                $total = $total + $spis_data[$i-1]->buying_quantity;
                                                $cost = $spis_data[$i-1]->buying_quantity*$spis_data[$i-1]->price_ctp;
                                                $cost_total = $cost_total +$cost; 
                                            }
                                        @endphp
                                        <td>
                                            @if(array_key_exists($i-1,$spis_data->toArray()))
                                                {{$total}}
                                            @endif
                                        </td>
                                        <td>
                                        @if(array_key_exists($i-1,$spis_data->toArray()))
                                            {{number_format($cost_total/$total,2)}}
                                        @endif</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div> 
                    </td>
                    <td style="width: 60%; padding-left: 100px; border: 0px solid #FFF">
                        @php
                            $totals = [
                                'CAR' => 0,
                                'CCC' => 0,
                            ];
                        @endphp
                        @foreach($spis->where('approved', 1) as $spi)
                            @php
                                if ($spi->destination == 'CCC') {
                                    $totals['CCC'] += $spi->buying_quantity;
                                } elseif ($spi->destination == 'CAR') {
                                    $totals['CAR'] += $spi->buying_quantity;
                                }
                            @endphp
                        @endforeach
                        @php
                            $totalDemand = $demandSupplies->sum('car') + $demandSupplies->sum('ccc');
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
                                    <td>{{$totals['CAR']}} MT</td>
                                    <td>CAR</td>
                                    <td>{{$demandSupplies->sum('car')}} MT</td>
                                </tr>
                                <tr>
                                    <td>CCC</td>
                                    <td>{{$totals['CCC']}} MT</td>
                                    <td>CCC</td>
                                    <td>{{$demandSupplies->sum('ccc')}} MT</td>
                                </tr>
                            </tbody>
                            <tfoot style="border-top: 1px solid black">
                                <tr>
                                    <td><b>Total</b></td>
                                    <td>{{$totals['CAR'] + $totals['CCC']}}&nbsp;MT</td>
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
        <table style="margin-top: 30px;" width="100%" id="table-summary">
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
                    <td style="padding-top: 20px;">{{ auth()->user()->name }}</td>
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
                    <td>SEAWEEDS PURCHASING MANAGER</td>
                    <!-- <td>PLANT MANAGER</td -->
                    <td>PRESIDENT</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>