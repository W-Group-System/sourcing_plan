@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Spinosum</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('/spi') }}"><button class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;Back</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{url('update_spi/'.$spis->id)}}">
                    @csrf
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableEstimate">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="name" class="form-control adjust" value="{{$spis->name}}" readonly></td>
                                        <td><input type="text" name="destination" class="form-control adjust" value="{{$spis->destination}}" readonly></td>
                                        <td><input type="text" name="pes" class="form-control adjust" value="{{$spis->pes}}"></td>
                                        <td><input type="text" name="origin" class="form-control adjust" value="{{$spis->origin}}"></td>
                                        <td><input type="text" name="offer_quantity" class="form-control adjust" value="{{$spis->offer_quantity}}"></td>
                                        <td><input type="text" name="buying_quantity" class="form-control adjust" value="{{$spis->buying_quantity}}"></td>
                                        <td><input type="text" name="uom" class="form-control adjust" value="MT" readonly></td>
                                        <td><input type="text" name="original_price" class="form-control adjust" value="{{$spis->original_price}}"></td>
                                        <td><input type="text" name="buying_price" class="form-control adjust buying_price" value="{{$spis->buying_price}}" readonly></td>
                                        <td><input type="text" name="expenses" class="form-control adjust expenses" value="{{$spis->expenses}}" readonly></td>
                                        <td><input type="text" name="price_expense" class="form-control adjust price_expense" value="{{$spis->price_expense}}" readonly></td>
                                        <td> <input type="text" name="moisture_content" class="form-control adjust" value="{{$spis->moisture_content}}" readonly></td>
                                        <td><input type="text" name="delivery_schedule" class="form-control adjust" value="{{$spis->delivery_schedule}}"></td>
                                        <td><input type="text" name="terms_payment" class="form-control adjust" value="{{$spis->terms_payment}}"></td>
                                        <td><input type="text" name="potassium" class="form-control adjust" value="{{$spis->potassium}}"></td>
                                        <td><input type="text" name="chips_yield" class="form-control adjust chips_yield" value="{{$spis->chips_yield}}" readonly></td>
                                        <td>
                                            <div class="input-group m-b">
                                                <input type="text" name="powder_yield" class="form-control powder_yield" style="width: 80px" value="{{$spis->powder_yield}}" readonly><span class="input-group-addon">%</span> 
                                            </div>
                                        </td>
                                        <td><input type="text" name="price_yield" class="form-control adjust price_yield" value="{{$spis->price_yield}}" readonly></td>
                                        <td><input type="text" name="forex_rate" class="form-control adjust forex_rate" value="{{$spis->forex_rate}}" readonly></td>
                                        <td><input type="text" name="price_usd" class="form-control adjust price_usd" value="{{$spis->price_usd}}" readonly></td>
                                        <td><input type="text" name="cost_produc" class="form-control adjust cost_produce" value="{{$spis->cost_produce}}" readonly></td>
                                        <td><input type="text" name="price_ctp" class="form-control adjust price_ctp" value="{{$spis->price_ctp}}" readonly></td>
                                        <td><input type="text" name="remarks" class="form-control adjust" value="{{$spis->remarks}}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div align="right" class="mt-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection