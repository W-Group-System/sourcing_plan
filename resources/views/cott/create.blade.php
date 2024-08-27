@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create Cottonii</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('/cott') }}"><button class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;Back</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ url('submitCott') }}">
                    @csrf
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableEstimate">
                                <thead>
                                    <tr>
                                        <th><a href="javascript:;" class="btn btn-primary addRow">+</th>
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
                                        <td><a href="javascript:;" class="btn btn-danger deleteRow">-</a></td>
                                        <td>
                                            <select name="name[]" id="name" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Seller" required>
                                                @foreach($suppliers->where('status', 1) as $supplier)
                                                    <option value="{{ $supplier->nickname }}" {{ ($supplier->id == $supplier->nickname) ? 'selected' : '' }}>
                                                        {{ $supplier->nickname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- <td><input type="text" name="destination[]" id="destination" class="form-control adjust" required></td> -->
                                        <td>
                                            <select name="destination[]" id="destination" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Destination" required>
                                                <option value="CCC">CCC</option>
                                                <option value="CAR">CAR</option>
                                                <option value="PBI">PBI</option>
                                                <option value="CAR/PBI">CAR/PBI</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control adjust" name="food_grade[]" id="food_grade" required>
                                                <option selected>Select</option>
                                                <option value="FG">FG</option>
                                                <option value="PF">PF</option>
                                            </select>
                                            {{-- <input type="text" name="food_grade[]" id="food_grade" class="form-control adjust"> --}}
                                        </td>
                                        <td><input type="text" name="origin[]" id="origin" class="form-control adjust"></td>
                                        <td><input type="text" name="offer_quantity[]" id="offer_quantity" class="form-control adjust" required></td>
                                        <td><input type="text" name="buying_quantity[]" id="buying_quantity" class="form-control adjust" required></td>
                                        <td><input type="text" name="uom[]" id="uom" class="form-control adjust" value="MT" readonly></td>
                                        <td><input type="text" name="original_price[]" id="original_price" class="form-control adjust"></td>
                                        <td><input type="text" name="buying_price[]" id="buying_price" class="form-control adjust buying_price" required></td>
                                        <td><input type="text" name="expenses[]" id="expenses" class="form-control adjust expenses"></td>
                                        <td><input type="text" name="price_expense[]" id="price_expense" class="form-control adjust price_expense" readonly></td>
                                        <td>
                                            <select class="form-control adjust" name="moisture_content[]" id="moisture_content" required>
                                                <option selected>Select</option>
                                                <option value="42%">42%</option>
                                                <option value="45%">45%</option>
                                                <option value="38%">38%</option>
                                            </select>
                                            {{-- <input type="text" name="moisture_content[]" id="moisture_content" class="form-control adjust"> --}}
                                        </td>
                                        <td><input type="text" name="delivery_schedule[]" id="delivery_schedule" class="form-control adjust"></td>
                                        <td><input type="text" name="terms_payment[]" id="terms_payment" class="form-control adjust"></td>
                                        <td><input type="text" name="potassium[]" id="potassium" class="form-control adjust"></td>
                                        <td><input type="text" name="chips_yield[]" id="chips_yield" class="form-control adjust chips_yield"></td>
                                        <td>
                                            {{-- <input type="text" name="powder_yield[]" id="powder_yield" class="form-control adjust powder_yield" readonly> --}}
                                            <div class="input-group m-b">
                                                <input type="text" name="powder_yield[]" id="powder_yield" class="form-control powder_yield" style="width: 80px" readonly><span class="input-group-addon">%</span> 
                                            </div>
                                        </td>
                                        <td><input type="text" name="price_yield[]" id="price_yield" class="form-control adjust price_yield" readonly></td>
                                        <td><input type="text" name="forex_rate[]" id="forex_rate" class="form-control adjust forex_rate"></td>
                                        <td><input type="text" name="price_usd[]" id="price_usd" class="form-control adjust price_usd" readonly></td>
                                        <td><input type="text" name="cost_produce[]" id="cost_produce" class="form-control adjust cost_produce"></td>
                                        <td><input type="text" name="price_ctp[]" id="price_ctp" class="form-control adjust price_ctp" readonly></td>
                                        <td><input type="text" name="remarks[]" id="remarks" class="form-control adjust"></td>
                                        <td><select class="form-control adjust selectpicker" data-live-search="true" data-live-search-placeholder="Search" name="area[]" id="area">
                                            <option value="" disabled selected>Select Area</option>
                                            <option value="ZAMBO BS" >ZAMBO BS</option>
                                            <option value="PAL BS" >PAL BS</option>
                                            <option value="MINDORO BS" >MINDORO BS</option>
                                            <option value="CEBU" >CEBU</option>
                                            <option value="OTHERS" >OTHERS</option>
                                            <option value="INDO" >INDO</option>
                                            <option value="" >None</option>
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
<style>
    .mt-10 {
        margin-top: 10px;
    }
    .adjust {
        width: 100px;
    }
    .float-e-margins .btn {
        margin-bottom: 0px;
    }
    .bootstrap-select>.dropdown-toggle {
        width: 150px;
    }
</style>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script>
    $('#tableEstimate thead').on('click', '.addRow', function(){
        var tr = '<tr>' +
            '<td><a href="javascript:;" class="btn btn-danger deleteRow">-</a></td>'+
            '<td>'+
                '<select name="name[]" id="name" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Seller" required>'+
                    '@foreach($suppliers->where("status", 1) as $supplier)'+
                        '<option value="{{ $supplier->nickname }}" {{ ($supplier->id == $supplier->nickname) ? "selected" : " " }}>'+
                            '{{ $supplier->nickname }}'+
                        '</option>'+
                    '@endforeach'+
                '</select>'+
            '</td>'+
            // '<td><input type="text" name="destination[]" id="destination" class="form-control adjust"></td>'+
            '<td>'+
                '<select name="destination[]" id="destination" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Destination" required>'+
                    '<option value="CCC">CCC</option>'+
                    '<option value="CAR">CAR</option>'+
                    '<option value="PBI">PBI</option>'+
                    '<option value="CAR/PBI">CAR/PBI</option>'+
                '</select>'+
            '</td>'+
            '<td>'+
                '<select class="form-control adjust" name="food_grade[]" id="food_grade" required>'+
                    '<option selected>Select</option>'+
                    '<option value="FG">FG</option>'+
                    '<option value="PF">PF</option>'+
                '</select>'+
                // <input type="text" name="food_grade[]" id="food_grade" class="form-control adjust">
            '</td>'+
            '<td><input type="text" name="origin[]" id="origin" class="form-control adjust"></td>'+
            '<td><input type="text" name="offer_quantity[]" id="offer_quantity" class="form-control adjust"></td>'+
            '<td><input type="text" name="buying_quantity[]" id="buying_quantity" class="form-control adjust"></td>'+
            '<td><input type="text" name="uom[]" id="uom" class="form-control adjust" value="MT" readonly></td>'+
            '<td><input type="text" name="original_price[]" id="original_price" class="form-control adjust"></td>'+
            '<td><input type="text" name="buying_price[]" id="buying_price" class="form-control adjust buying_price" required></td>'+
            '<td><input type="text" name="expenses[]" id="expenses" class="form-control adjust expenses"></td>'+
            '<td><input type="text" name="price_expense[]" id="price_expense" class="form-control adjust price_expense" readonly></td>'+
            '<td>'+
                '<select class="form-control adjust" name="moisture_content[]" id="moisture_content" required>'+
                    '<option selected>Select</option>'+
                    '<option value="42%">42%</option>'+
                    '<option value="45%">45%</option>'+
                    '<option value="38%">38%</option>'+
                '</select>'+
                // <input type="text" name="moisture_content[]" id="moisture_content" class="form-control adjust">
            '</td>'+
            '<td><input type="text" name="delivery_schedule[]" id="delivery_schedule" class="form-control adjust"></td>'+
            '<td><input type="text" name="terms_payment[]" id="terms_payment" class="form-control adjust"></td>'+
            '<td><input type="text" name="potassium[]" id="potassium" class="form-control adjust"></td>'+
            '<td><input type="text" name="chips_yield[]" id="chips_yield" class="form-control adjust chips_yield"></td>'+
            '<td>'+
                '<div class="input-group m-b">'+
                    '<input type="text" name="powder_yield[]" id="powder_yield" class="form-control powder_yield" style="width: 80px" readonly><span class="input-group-addon">%</span>'+
                '</div>'+
            '</td>'+
            '<td><input type="text" name="price_yield[]" id="price_yield" class="form-control adjust price_yield" readonly></td>'+
            '<td><input type="text" name="forex_rate[]" id="forex_rate" class="form-control adjust forex_rate"></td>'+
            '<td><input type="text" name="price_usd[]" id="price_usd" class="form-control adjust price_usd" readonly></td>'+
            '<td><input type="text" name="cost_produce[]" id="cost_produce" class="form-control adjust cost_produce"></td>'+
            '<td><input type="text" name="price_ctp[]" id="price_ctp" class="form-control adjust price_ctp" readonly></td>'+
            '<td><input type="text" name="remarks[]" id="remarks" class="form-control adjust "></td>'+
            '<td><select class="form-control adjust selectpicker" data-live-search="true" data-live-search-placeholder="Search" name="area[]" id="area">'+
                '<option value="" disabled selected>Select Area</option>' +
                '<option value="ZAMBO BS" >ZAMBO BS</option>'+
                '<option value="PAL BS" >PAL BS</option>'+
                '<option value="MINDORO BS" >MINDORO BS</option>'+
                '<option value="CEBU" >CEBU</option>'+
                '<option value="OTHERS" >OTHERS</option>'+
                '<option value="INDO" >INDO</option>'+
                '<option value=" " >None</option>'+
            '</select></td>'+
        '</tr>';

        $('tbody').append(tr);

        $('.selectpicker').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });
    });

    $('#tableEstimate tbody').on('click', '.deleteRow', function(){
        $(this).parent().parent().remove();
    });

    // computation for price expenses
    $("#tableEstimate tbody").on("input", ".buying_price, .expenses", function() {
        var buying_price = parseFloat($(this).closest("tr").find(".buying_price").val()) || 0;
        var expenses = parseFloat($(this).closest("tr").find(".expenses").val()) || 0;
        var price_expense = $(this).closest("tr").find(".price_expense");
        price_expense.val((buying_price + expenses).toFixed(2));
        calc_total(); 
    });

    // computation for powder yield
    $("#tableEstimate tbody").on("input", ".chips_yield", function() {
        var chips_yield = parseFloat($(this).val()) || 0;
        var powder_yield = $(this).closest("tr").find(".powder_yield");
        var calculatedPowderYield = chips_yield * 0.9;
        powder_yield.val(calculatedPowderYield.toFixed(2));
    });
    
    // computation for price yield
    // $("#tableEstimate tbody").on("change", ".chips_yield", function() {
    //     var price_expense = parseFloat($(this).closest("tr").find(".price_expense").val()) || 0;
    //     var powder_yield = parseFloat($(this).closest("tr").find(".powder_yield").val()) || 0;
    //     var price_yield = $(this).closest("tr").find(".price_yield");
       
    //     price_yield.val(parseFloat(price_expense / powder_yield).toFixed(4));
        
    // })
    $("#tableEstimate tbody").on("change", ".chips_yield", function() {
        var price_expense = parseFloat($(this).closest("tr").find(".price_expense").val()) || 0;
        var powder_yield = parseFloat($(this).closest("tr").find(".powder_yield").val()) || 0;
        var price_yield = $(this).closest("tr").find(".price_yield");

        powder_yield = powder_yield / 100;
        var calculatedValue = (price_expense / powder_yield).toFixed(2);

        if (calculatedValue.indexOf('.') === -1) {
            calculatedValue += '.';
        } else {
            var decimalPart = calculatedValue.split('.')[1];
            var padding = 2 - decimalPart.length;
            for (var i = 0; i < padding; i++) {
                calculatedValue += '0';
            }
        }

        price_yield.val(calculatedValue);
    });

    // computation for price in usd
    $("#tableEstimate tbody").on("input", ".forex_rate", function() {
        var price_yield = parseFloat($(this).closest("tr").find(".price_yield").val()) || 0;
        var forex_rate = parseFloat($(this).closest("tr").find(".forex_rate").val()) || 0;
        var price_usd = $(this).closest("tr").find(".price_usd");
        price_usd.val((price_yield / forex_rate).toFixed(2));
    });

    // computation for price ctp
    $("#tableEstimate tbody").on("input", ".price_usd, .cost_produce", function() {
        var price_usd = parseFloat($(this).closest("tr").find(".price_usd").val()) || 0;
        var cost_produce = parseFloat($(this).closest("tr").find(".cost_produce").val()) || 0;
        var price_ctp = $(this).closest("tr").find(".price_ctp");
        price_ctp.val((price_usd + cost_produce).toFixed(2));
    });

    function calc_total() {
        var sum = 0;
        $('.price_expense').each(function () {
            sum += parseFloat($(this).val());
        });
    }
    
</script>

@endsection