<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cott List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<style>
    body {
        background-color: #FFF;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 8px;
        margin: 5px 15px;
    }
    #table-cotts th, #table-cotts td {
        border: 1px solid #DDD;
        padding: 5px
    }
    #table-side th, #table-side td {
        font-size: 9px;
        padding: 5px
    }
    .box-container {
        width: 500px; 
        height: 100px; 
        border: 2px solid #DDD; 
        margin-top: 20px;
    }
    @page { margin: 5px 15px; }
    
</style>



<div class="row">
    <div class="col-12" align="center">
        <img alt="image" src="{{URL::asset('/images/wgroup.png')}}" style='width:120px;margin-bottom:-10px'>
        <h4>Sourcing Plan</h4>
    </div>
    <h5 class="export-date">Date:</h5>
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
            </tr>
        </thead>
        <tbody>
            @if(count($cotts))
                @foreach($cotts->where('approved',1) as $cott)
                    <tr>
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
                        <td>{{$cott->chips_yield}}</td>
                        <td>{{$cott->powder_yield}}%</td>
                        <td>{{$cott->price_yield}}</td>
                        <td>{{$cott->forex_rate}}</td>
                        <td>{{$cott->price_usd}}</td>
                        <td>{{$cott->cost_produce}}</td>
                        <td>{{$cott->price_ctp}}</td>
                        <td>{{$cott->remarks}}</td>
                    </tr>
                @endforeach
            @else
            <tr>
                <td colspan="24">No Cott Found</td>
            </tr>
        </tbody>
        @endif
        <tfoot>
            <tr>
                <td colspan="4" align="right">Total:</td>
                <td></td>
                <td></td>
                <td colspan="17"></td>
            </tr>
        </tfoot>
    </table>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td style="width: 40%; padding:0%;">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-cotts">
                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align: center";>Total Average Cost</th>
                                </tr>
                                <tr>
                                    <th width="15%">Item</th>
                                    <th width="17%">Quantity (MT)</th>
                                    <th width="18%">Cost</th>
                                    <th width="15%">Item</th>
                                    <th width="17%">Quantity (MT)</th>
                                    <th width="18%"> Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1-1</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-9</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1-2</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-10</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1-3</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-11</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1-4</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-12</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1-5</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-13</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1-6</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-14</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1-7</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-15</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1-8</td>
                                    <td></td>
                                    <td></td>
                                    <td>1-16</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </td>
                <td style="width: 60%; padding-left: 100px; border: 0px solid #FFF">
                    <table id="table-side">
                        <thead>
                            <tr>
                                <th colspan="2" style="padding-right: 80px">QUANTITY DISTRIBUTION PER PLANT</th>
                                <th colspan="2">DEMAND AND SUPPLY AS OF DEC 6 UPDATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CAR</td>
                                <td>MT</td>
                                <td>CAR</td>
                                <td>MT</td>
                            </tr>
                            <tr>
                                <td>CCC</td>
                                <td>MT</td>
                                <td>CCC</td>
                                <td>MT</td>
                            </tr>
                            <tr>
                                <td>PBI</td>
                                <td>MT</td>
                                <td>PBI</td>
                                <td>MT</td>
                            </tr>
                        </tbody>
                        <tfoot style="border-top: 1px solid black">
                            <tr>
                                <td><b>Total</b></td>
                                <td>MT</td>
                                <td><b>Total</b></td>
                                <td>MT</td>
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
    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <td width="25%">Prepared By:</td>
                <td width="25%">Reviewed By:</td>
                <td width="25%"></td>
                <td width="25%">Approved By:</td>
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <td style="padding-top: 20px;">KIARA BEATRIZ GALIMAO</td>
                <td style="padding-top: 20px;">YEANESA MAE SAJA</td>
                <td style="padding-top: 20px;">MA MICHELLE PILOTON/JHANICE FABABAER</td>
                <td style="padding-top: 20px;">JLW</td>
            </tr>
            <tr>
                <td>___________________________________________</td>
                <td>___________________________________________</td>
                <td>___________________________________________</td>
                <td>___________________________________________</td>
            </tr>
            <tr>
                <td>SEAWEEDS PURCHASING SUPERVISOR</td>
                <td>ASST. SEAWEEDS PURCHASING MANAGER</td>
                <td>PLANT MANAGER</td>
                <td>PRESIDENT</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
