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
                    <form method="POST" action="{{url('update_spis')}}">
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
                                        <th>Area</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($spis as $spi)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id[]" value="{{ $spi->id }}">
                                            <input type="text" name="name[]" class="form-control adjust" value="{{$spi->name}}" readonly>
                                        </td>
                                        <td>
                                            {{-- <input type="text" name="destination[]" class="form-control adjust" value="{{$spi->destination}}"> --}}
                                            <select name="destination[]" id="destination" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Destination" >
                                                <option value="" disabled selected>Select Destination</option>
                                                <option value="CCC" {{ $spi->destination == "CCC" ? 'selected' : '' }}>CCC</option>
                                                <option value="CAR" {{ $spi->destination == "CAR" ? 'selected' : '' }}>CAR</option>
                                                <option value="PBI" {{ $spi->destination == "PBI" ? 'selected' : '' }}>PBI</option>
                                                <option value="CAR/PBI" {{ $spi->destination == "CAR/PBI" ? 'selected' : '' }}>CAR/PBI</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="pes[]" class="form-control adjust" value="{{$spi->pes}}"></td>
                                        <td><input type="text" name="origin[]" class="form-control adjust" value="{{$spi->origin}}"></td>
                                        <td><input type="text" name="offer_quantity[]" class="form-control adjust" value="{{$spi->offer_quantity}}"></td>
                                        <td><input type="text" name="buying_quantity[]" class="form-control adjust" value="{{$spi->buying_quantity}}"></td>
                                        <td><input type="text" name="uom[]" class="form-control adjust" value="MT" readonly></td>
                                        <td><input type="text" name="original_price[]" class="form-control adjust" value="{{$spi->original_price}}" readonly></td>
                                        <td><input type="text" name="buying_price[]" class="form-control adjust buying_price" value="{{$spi->buying_price}}" readonly></td>
                                        <td><input type="text" name="expenses[]" class="form-control adjust expenses" value="{{$spi->expenses}}" readonly></td>
                                        <td><input type="text" name="price_expense[]" class="form-control adjust price_expense" value="{{$spi->price_expense}}" readonly></td>
                                        <td> <input type="text" name="moisture_content[]" class="form-control adjust" value="{{$spi->moisture_content}}" readonly></td>
                                        <td><input type="text" name="delivery_schedule[]" class="form-control adjust" value="{{$spi->delivery_schedule}}" readonly></td>
                                        <td><input type="text" name="terms_payment[]" class="form-control adjust" value="{{$spi->terms_payment}}" readonly></td>
                                        <td><input type="text" name="potassium[]" class="form-control adjust" value="{{$spi->potassium}}" readonly></td>
                                        <td><input type="text" name="chips_yield[]" class="form-control adjust chips_yield" value="{{$spi->chips_yield}}" readonly></td>
                                        <td>
                                            <div class="input-group m-b">
                                                <input type="text" name="powder_yield[]" class="form-control powder_yield" style="width: 80px" value="{{$spi->powder_yield}}" readonly><span class="input-group-addon">%</span> 
                                            </div>
                                        </td>
                                        <td><input type="text" name="price_yield[]" class="form-control adjust price_yield" value="{{$spi->price_yield}}" readonly></td>
                                        <td><input type="text" name="forex_rate[]" class="form-control adjust forex_rate" value="{{$spi->forex_rate}}" readonly></td>
                                        <td><input type="text" name="price_usd[]" class="form-control adjust price_usd" value="{{$spi->price_usd}}" readonly></td>
                                        <td><input type="text" name="cost_produce[]" class="form-control adjust cost_produce" value="{{$spi->cost_produce}}" readonly></td>
                                        <td><input type="text" name="price_ctp[]" class="form-control adjust price_ctp" value="{{$spi->price_ctp}}" readonly></td>
                                        <td><input type="text" name="remarks[]" class="form-control adjust" value="{{$spi->remarks}}"></td>
                                        <td><select class="form-control adjust" name="area[]" id="area">
                                            <option value="" disabled selected>Select Area</option>
                                            <option value="ZAMBO BS" {{ $spi->area == "ZAMBO BS" ? 'selected' : '' }}>ZAMBO BS</option>
                                            <option value="PAL BS" {{ $spi->area == "PAL BS" ? 'selected' : '' }}>PAL BS</option>
                                            <option value="MINDORO BS" {{ $spi->area == "MINDORO BS" ? 'selected' : '' }}>MINDORO BS</option>
                                            <option value="CEBU" {{ $spi->area == "CEBU" ? 'selected' : '' }}>CEBU</option>
                                            <option value="OTHERS" {{ $spi->area == "OTHERS" ? 'selected' : '' }}>OTHERS</option>
                                            <option value="INDO" {{ $spi->area == "INDO" ? 'selected' : '' }}>INDO</option>
                                            <option value=" " {{ $spi->area == " " ? 'selected' : '' }}>None</option>
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