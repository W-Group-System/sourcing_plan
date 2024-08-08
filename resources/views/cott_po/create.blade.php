@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create PO Cottonii</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('/cott_po') }}"><button class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;Back</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ url('submitPoCott') }}">
                    @csrf
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableEstimate">
                                <thead>
                                    <tr>
                                        <th><a href="javascript:;" class="btn btn-primary addRow">+</th>
                                        <th>Suppliers Name</th>
                                        <th>Lot Code</th>
                                        <th>Quantity</th>
                                        <th>Buying Price</th>
                                        <th>Expenses</th>
                                        <th>Price + Expenses</th>
                                        <th>Original PO Date</th>
                                        <th>PO Date</th>
                                        <th>Area</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="javascript:;" class="btn btn-danger deleteRow">-</a></td>
                                        <td>
                                            <select name="supplier_name[]" id="supplier_name" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Supplier" required>
                                                @foreach($suppliers->where('status', 1) as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ ($supplier->id == $supplier->name) ? 'selected' : '' }}>
                                                        {{ $supplier->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="lot_code[]" id="lot_code" class="form-control adjust" placeholder="Enter Lot Code" required></td>
                                        <td><input type="text" name="quantity[]" id="quantity" class="form-control adjust" placeholder="Enter Quantity" required></td>
                                        <td><input type="text" name="buying_price[]" id="buying_price" class="form-control adjust buying_price" placeholder="Enter Buying Price" required></td>
                                        <td><input type="text" name="expenses[]" id="expenses" class="form-control adjust expenses" placeholder="Enter Expenses" required></td>
                                        <td><input type="text" name="price_expenses[]" id="price_expenses" class="form-control adjust price_expense" placeholder="Enter Price Expenses" readonly></td>
                                        <td><input type="date" name="original_po_date[]" id="original_po_date" class="form-control adjust_date" required></td>
                                        <td><input type="date" name="po_date[]" id="po_date" class="form-control adjust_date" required></td>
                                        <td>
                                            <select class="form-control adjust selectpicker" data-live-search="true" data-live-search-placeholder="Search" name="area[]" id="area" title="Select Area" required>
                                                <option value="" disabled selected>Select Area</option>
                                                <option value="ZAMBO BS">ZAMBO BS</option>
                                                <option value="PAL BS">PAL BS</option>
                                                <option value="MINDORO BS">MINDORO BS</option>
                                                <option value="CEBU">CEBU</option>
                                                <option value="OTHERS">OTHERS</option>
                                                <option value="INDO">INDO</option>
                                                <option value="" >None</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="remarks[]" id="remarks" class="form-control adjust" placeholder="Enter Remarks"></td>
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
    .float-e-margins .btn {
        margin-bottom: 0px;
    }
    .bootstrap-select>.dropdown-toggle {
        width: 150px;
    }
    .adjust_date {
        width: 150px;
    }
</style>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script>
    $('#tableEstimate thead').on('click', '.addRow', function(){
        var tr = '<tr>' +
            '<td><a href="javascript:;" class="btn btn-danger deleteRow">-</a></td>'+
            '<td>'+
                '<select name="supplier_name[]" id="supplier_name" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Supplier" required>'+
                    '@foreach($suppliers->where("status", 1) as $supplier)'+
                        '<option value="{{ $supplier->id }}" {{ ($supplier->id == $supplier->name) ? "selected" : " " }}>'+
                            '{{ $supplier->name }}'+
                        '</option>'+
                    '@endforeach'+
                '</select>'+
            '</td>'+
            '<td><input type="text" name="lot_code[]" id="lot_code" class="form-control adjust" placeholder="Enter Lot Code" required></td>'+
            '<td><input type="text" name="quantity[]" id="quantity" class="form-control adjust" placeholder="Enter Quantity" required></td>'+
            '<td><input type="text" name="buying_price[]" id="buying_price" class="form-control adjust buying_price" placeholder="Enter Buying Price" required></td>'+
            '<td><input type="text" name="expenses[]" id="expenses" class="form-control adjust expenses" placeholder="Enter Expenses" required></td>'+
            '<td><input type="text" name="price_expenses[]" id="price_expenses" class="form-control adjust price_expense" placeholder="Enter Price Expenses" readonly></td>'+
            '<td><input type="date" name="original_po_date[]" id="original_po_date" class="form-control adjust_date" required></td>'+
            '<td><input type="date" name="po_date[]" id="po_date" class="form-control adjust_date" required></td>'+
            '<td>'+
                '<select class="form-control adjust selectpicker" data-live-search="true" data-live-search-placeholder="Search" name="area[]" id="area" title="Select Area" required>'+
                    '<option value="" disabled selected>Select Area</option>'+
                    '<option value="ZAMBO BS">ZAMBO BS</option>'+
                    '<option value="PAL BS">PAL BS</option>'+
                    '<option value="MINDORO BS">MINDORO BS</option>'+
                    '<option value="CEBU">CEBU</option>'+
                    '<option value="OTHERS">OTHERS</option>'+
                    '<option value="INDO">INDO</option>'+
                    '<option value="" >None</option>'+
                '</select>'+
            '</td>'+
            '<td><input type="text" name="remarks[]" id="remarks" class="form-control adjust" placeholder="Enter Remarks"></td>'+
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

    function calc_total() {
        var sum = 0;
        $('.price_expense').each(function () {
            sum += parseFloat($(this).val());
        });
    }

</script>

@endsection