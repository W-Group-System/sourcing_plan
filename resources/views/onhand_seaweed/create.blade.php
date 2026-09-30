@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>On-Hand Seaweed (Plant Stocks + CY Stocks + In-transit) Inventory</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('/onhand_seaweed') }}"><button class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;Back</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ url('onhand_seaweed_store') }}">
                    @csrf
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableEstimate" style="min-height: 500px;">
                                <thead>
                                    <tr>
                                        <th><a href="javascript:;" class="btn btn-primary addRow">+</th>
                                        <th>Plant</th>
                                        {{-- <th>Inventory</th> --}}
                                        <th>Quantity</th>
                                        <th>Plant Consumption</th>
                                        <th># of Days</th>                                            
                                        <th>Date Updated</th>                                            
                                        {{-- <th>Until</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="javascript:;" class="btn btn-danger deleteRow">-</a></td>
                                        <td>
                                            <select name="plant[]" id="plant" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Plant" required>
                                                @foreach($plants as $plant)
                                                    <option value="{{ $plant->id }}">
                                                        {{ $plant->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        {{-- <td>
                                            <select name="inventory[]" id="inventory" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Inventory" required>
                                                @foreach($inventories as $inventory)
                                                    <option value="{{ $inventory->id }}">
                                                        {{ $inventory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td> --}}
                                        <td><input type="text" name="quantity[]" id="quantity" class="form-control quantity"></td>
                                        <td><input type="text" name="plant_consumption[]" id="plant_consumption" class="form-control plant-consumption"></td>
                                        <td><input type="text" name="no_of_days[]" id="no_of_days" class="form-control no-of-days" readonly></td>
                                        <td><input type="date" name="date_updated[]" id="date_updated" class="form-control date-updated"></td>
                                        {{-- <td><input type="text" name="until_value[]" id="until_value" class="form-control" required></td> --}}
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
     {
        width: 100px;
    }
    .float-e-margins .btn {
        margin-bottom: 0px;
    }
    /* .bootstrap-select>.dropdown-toggle {
        width: 150px;
    } */
</style>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script>
    $('#tableEstimate thead').on('click', '.addRow', function(){
        var tr = '<tr>' +
            '<td><a href="javascript:;" class="btn btn-danger deleteRow">-</a></td>'+
            '<td>'+
                '<select name="plant[]" id="plant" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Plant" required>'+
                    '@foreach($plants as $plant)'+
                        '<option value="{{ $plant->id }}">'+
                            '{{ $plant->name }}'+
                        '</option>'+
                    '@endforeach'+
                '</select>'+
            '</td>'+
            // '<td>'+
            //     '<select name="inventory[]" id="inventory" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Inventory" required>'+
            //         '@foreach($inventories as $inventory)'+
            //             '<option value="{{ $inventory->id }}">'+
            //                 '{{ $inventory->name }}'+
            //             '</option>'+
            //         '@endforeach'+
            //     '</select>'+
            // '</td>'+
            '<td><input type="text" name="quantity[]" class="form-control quantity"></td>'+
            '<td><input type="text" name="plant_consumption[]" class="form-control plant-consumption"></td>'+
            '<td><input type="text" name="no_of_days[]" class="form-control no-of-days" readonly></td>'+
            '<td><input type="date" name="date_updated[]" class="form-control date-updated"></td>'+
            // '<td><input type="text" name="until_value[]" id="until_value" class="form-control" readonly></td>'+
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

    $('#tableEstimate tbody').on('input', '.quantity, .plant-consumption', function () {

        var row = $(this).closest('tr');

        var quantity = parseFloat(row.find('.quantity').val()) || 0;
        var consumption = parseFloat(row.find('.plant-consumption').val()) || 0;

        if (consumption > 0) {
            var days = quantity / consumption;

            row.find('.no-of-days').val(Math.round(days));
        } else {
            row.find('.no-of-days').val('');
        }
    });

</script>

@endsection