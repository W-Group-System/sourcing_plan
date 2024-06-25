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
                    <form method="POST" action="{{url('update_cotts')}}">
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
                                    @foreach($cotts as $cott)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id[]" value="{{ $cott->id }}">
                                            <input type="text" name="name[]" class="form-control adjust" value="{{$cott->name}}" readonly>
                                        </td>
                                        <td>
                                            {{-- <input type="text" name="destination[]" class="form-control adjust" value="{{$cott->destination}}"> --}}
                                            <select name="destination[]" id="destination" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Destination" >
                                                <option value="" disabled selected>Select Destination</option>
                                                <option value="CCC" {{ $cott->destination == "CCC" ? 'selected' : '' }}>CCC</option>
                                                <option value="CAR" {{ $cott->destination == "CAR" ? 'selected' : '' }}>CAR</option>
                                                <option value="PBI" {{ $cott->destination == "PBI" ? 'selected' : '' }}>PBI</option>
                                                <option value="CAR/PBI" {{ $cott->destination == "CAR/PBI" ? 'selected' : '' }}>CAR/PBI</option>
                                            </select>
                                        </td>
                                        <td>
                                            {{-- <input type="text" name="food_grade[]" class="form-control adjust" value="{{$cott->food_grade}}"> --}}
                                            <select class="form-control adjust" name="food_grade[]" id="food_grade">
                                                <option value="" disabled selected>Select Food Grade</option>
                                                <option value="FG" {{ $cott->food_grade == "FG" ? 'selected' : '' }}>FG</option>
                                                <option value="PF" {{ $cott->food_grade == "PF" ? 'selected' : '' }}>PF</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="origin[]" id="origin" class="form-control adjust" value="{{$cott->origin}}"></td>
                                        <td><input type="text" name="offer_quantity[]" class="form-control adjust" value="{{$cott->offer_quantity}}"></td>
                                        <td><input type="text" name="buying_quantity[]" class="form-control adjust" value="{{$cott->buying_quantity}}"></td>
                                        <td><input type="text" name="uom[]" id="uom[]" class="form-control adjust" value="MT" readonly></td>
                                        <td><input type="text" name="original_price[]" class="form-control adjust" value="{{$cott->original_price}}" readonly></td>
                                        <td><input type="text" name="buying_price[]" class="form-control adjust buying_price" value="{{$cott->buying_price}}" readonly></td>
                                        <td><input type="text" name="expenses[]" class="form-control adjust expenses" value="{{$cott->expenses ?: '-'  }}" readonly></td>
                                        <td><input type="text" name="price_expense[]" class="form-control adjust price_expense" value="{{$cott->price_expense}}" readonly></td>
                                        <td>
                                            <input type="text" name="moisture_content[]" class="form-control adjust" value="{{$cott->moisture_content}}" readonly> 
                                        </td>
                                        <td><input type="text" name="delivery_schedule[]" class="form-control adjust" value="{{$cott->delivery_schedule}}" readonly></td>
                                        <td><input type="text" name="terms_payment[]" class="form-control adjust" value="{{$cott->terms_payment}}" readonly></td>
                                        <td><input type="text" name="potassium[]" class="form-control adjust" value="{{$cott->potassium}}" readonly></td>
                                        <td><input type="text" name="chips_yield[]" class="form-control adjust chips_yield" value="{{$cott->chips_yield}}" readonly></td>
                                        <td>
                                            {{-- <input type="text" name="powder_yield[]" id="powder_yield" class="form-control adjust powder_yield"> --}}
                                            <div class="input-group m-b">
                                                <input type="text" name="powder_yield[]" class="form-control powder_yield" style="width: 80px" value="{{$cott->powder_yield}}" readonly><span class="input-group-addon">%</span> 
                                            </div>
                                        </td>
                                        <td><input type="text" name="price_yield[]" class="form-control adjust price_yield" value="{{$cott->price_yield}}" readonly></td>
                                        <td><input type="text" name="forex_rate[]" class="form-control adjust forex_rate" value="{{$cott->price_yield}}" readonly></td>
                                        <td><input type="text" name="price_usd[]" class="form-control adjust price_usd" value="{{$cott->price_usd}}" readonly></td>
                                        <td><input type="text" name="cost_produce[]" class="form-control adjust cost_produce" value="{{$cott->cost_produce}}" readonly></td>
                                        <td><input type="text" name="price_ctp[]" class="form-control adjust price_ctp" value="{{$cott->price_ctp}}" readonly></td>
                                        <td><input type="text" name="remarks[]" class="form-control adjust"  value="{{$cott->remarks}}"></td>
                                        <td><select class="form-control adjust" name="area[]" id="area">
                                            <option value="" disabled selected>Select Area</option>
                                            <option value="ZAMBO BS" {{ $cott->area == "ZAMBO BS" ? 'selected' : '' }}>ZAMBO BS</option>
                                            <option value="PAL BS" {{ $cott->area == "PAL BS" ? 'selected' : '' }}>PAL BS</option>
                                            <option value="MINDORO BS" {{ $cott->area == "MINDORO BS" ? 'selected' : '' }}>MINDORO BS</option>
                                            <option value="CEBU" {{ $cott->area == "CEBU" ? 'selected' : '' }}>CEBU</option>
                                            <option value="OTHERS" {{ $cott->area == "OTHERS" ? 'selected' : '' }}>OTHERS</option>
                                            <option value="INDO" {{ $cott->area == "INDO" ? 'selected' : '' }}>INDO</option>
                                            <option value=" " {{ $cott->area == " " ? 'selected' : '' }}>None</option>
                                        </select></td>
                                    </tr>
                                    @endforeach
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