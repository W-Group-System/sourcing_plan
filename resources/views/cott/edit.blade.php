@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Cottonii</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('/cott') }}"><button class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;Back</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{url('update_cott/'.$cotts->id)}}">
                    @csrf
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableEstimate">
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
                                        <th>Area</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="name" class="form-control adjust" value="{{$cotts->name}}">
                                        </td>
                                        <td>
                                            <input type="text" name="destination" class="form-control adjust" value="{{$cotts->destination}}">
                                        </td>
                                        <td>
                                            <input type="text" name="food_grade" class="form-control adjust" value="{{$cotts->food_grade}}">
                                        </td>
                                        <td><input type="text" name="origin" id="origin" class="form-control adjust" value="{{$cotts->origin}}"></td>
                                        <td><input type="text" name="offer_quantity" class="form-control adjust" value="{{$cotts->offer_quantity}}"></td>
                                        <td><input type="text" name="buying_quantity" class="form-control adjust" value="{{$cotts->buying_quantity}}"></td>
                                        <td><input type="text" name="uom[]" id="uom" class="form-control adjust" value="MT" readonly></td>
                                        <td><input type="text" name="original_price" class="form-control adjust" value="{{$cotts->original_price}}"></td>
                                        <td><input type="text" name="buying_price" class="form-control adjust buying_price" value="{{$cotts->buying_price}}"></td>
                                        <td><input type="text" name="expenses" class="form-control adjust expenses" value="{{$cotts->expenses}}"></td>
                                        <td><input type="text" name="price_expense" class="form-control adjust price_expense" value="{{$cotts->price_expense}}"></td>
                                        <td>
                                            <input type="text" name="moisture_content" class="form-control adjust" value="{{$cotts->moisture_content}}"> 
                                        </td>
                                        <td><input type="text" name="delivery_schedule" class="form-control adjust" value="{{$cotts->delivery_schedule}}"></td>
                                        <td><input type="text" name="terms_payment" class="form-control adjust" value="{{$cotts->terms_payment}}"></td>
                                        <td><input type="text" name="potassium" class="form-control adjust" value="{{$cotts->potassium}}"></td>
                                        <td><input type="text" name="chips_yield" class="form-control adjust chips_yield" value="{{$cotts->chips_yield}}"></td>
                                        <td>
                                            {{-- <input type="text" name="powder_yield[]" id="powder_yield" class="form-control adjust powder_yield"> --}}
                                            <div class="input-group m-b">
                                                <input type="text" name="powder_yield" class="form-control powder_yield" style="width: 80px" value="{{$cotts->powder_yield}}"><span class="input-group-addon">%</span> 
                                            </div>
                                        </td>
                                        <td><input type="text" name="price_yield" class="form-control adjust price_yield" value="{{$cotts->price_yield}}"></td>
                                        <td><input type="text" name="forex_rate" class="form-control adjust forex_rate" value="{{$cotts->price_yield}}"></td>
                                        <td><input type="text" name="price_usd" class="form-control adjust price_usd" value="{{$cotts->price_usd}}"></td>
                                        <td><input type="text" name="cost_produce" class="form-control adjust cost_produce" value="{{$cotts->cost_produce}}"></td>
                                        <td><input type="text" name="price_ctp" class="form-control adjust price_ctp" value="{{$cotts->price_ctp}}"></td>
                                        <td><input type="text" name="remarks" class="form-control adjust"  value="{{$cotts->remarks}}"></td>
                                        <td><select class="form-control adjust" name="area" id="area">
                                            <option value="" disabled selected>Select Area</option>
                                            <option value="ZAMBO BS" {{ $cotts->area == "ZAMBO BS" ? 'selected' : '' }}>ZAMBO BS</option>
                                            <option value="PAL BS" {{ $cotts->area == "PAL BS" ? 'selected' : '' }}>PAL BS</option>
                                            <option value="MINDORO BS" {{ $cotts->area == "MINDORO BS" ? 'selected' : '' }}>MINDORO BS</option>
                                            <option value="CEBU" {{ $cotts->area == "CEBU BS" ? 'selected' : '' }}>CEBU</option>
                                            <option value="OTHERS" {{ $cotts->area == "OTHERS BS" ? 'selected' : '' }}>OTHERS</option>
                                            <option value="INDO" {{ $cotts->area == "INDO BS" ? 'selected' : '' }}>INDO</option>
                                        </select></td>
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