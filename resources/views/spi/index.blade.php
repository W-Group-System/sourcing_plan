@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>SPI List</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('spi/create') }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">List</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">For Approval</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Seller's Name</th>
                                                            <th>Destination (Plant)</th>
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
                                                        @foreach($spis->where('approved',1) as $spi)
                                                            <tr>
                                                                <td>{{$spi->name}}</td>
                                                                <td>{{$spi->destination}}</td>
                                                                <td>{{$spi->origin}}</td>
                                                                <td>{{$spi->offer_quantity}}</td>
                                                                <td>{{$spi->buying_quantity}}</td>
                                                                <td>{{$spi->uom}}</td>
                                                                <td>{{$spi->original_price}}</td>
                                                                <td>{{$spi->buying_price}}</td>
                                                                <td>{{$spi->expenses}}</td>
                                                                <td>{{$spi->price_expense}}</td>
                                                                <td>{{$spi->moisture_content}}</td>
                                                                <td>{{$spi->delivery_schedule}}</td>
                                                                <td>{{$spi->potassium}}</td>
                                                                <td>{{$spi->chips_yield}}</td>
                                                                <td>{{$spi->powder_yield}}%</td>
                                                                <td>{{$spi->price_yield}}</td>
                                                                <td>{{$spi->forex_rate}}</td>
                                                                <td>{{$spi->price_usd}}</td>
                                                                <td>{{$spi->cost_produce}}</td>
                                                                <td>{{$spi->price_ctp}}</td>
                                                                <td>{{$spi->remarks}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <form method="POST" action="{{url('spi/updateStatus')}}">
                                        @csrf
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th><input id="checkAll" type="checkbox" class="form-check-input"></th>
                                                                <th>Seller's Name</th>
                                                                <th>Destination (Plant)</th>
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
                                                            @foreach($spis->where('approved',0) as $spi)
                                                                <tr>
                                                                    <td>
                                                                        <input type="checkbox" class="form-check-input check-item" name="checkbox[]" value="{{ $spi->id }}">
                                                                    </td>
                                                                    <td>{{$spi->name}}</td>
                                                                    <td>{{$spi->destination}}</td>
                                                                    <td>{{$spi->origin}}</td>
                                                                    <td>{{$spi->offer_quantity}}</td>
                                                                    <td>{{$spi->buying_quantity}}</td>
                                                                    <td>{{$spi->uom}}</td>
                                                                    <td>{{$spi->original_price}}</td>
                                                                    <td>{{$spi->buying_price}}</td>
                                                                    <td>{{$spi->expenses}}</td>
                                                                    <td>{{$spi->price_expense}}</td>
                                                                    <td>{{$spi->moisture_content}}</td>
                                                                    <td>{{$spi->delivery_schedule}}</td>
                                                                    <td>{{$spi->potassium}}</td>
                                                                    <td>{{$spi->chips_yield}}</td>
                                                                    <td>{{$spi->powder_yield}}%</td>
                                                                    <td>{{$spi->price_yield}}</td>
                                                                    <td>{{$spi->forex_rate}}</td>
                                                                    <td>{{$spi->price_usd}}</td>
                                                                    <td>{{$spi->cost_produce}}</td>
                                                                    <td>{{$spi->price_ctp}}</td>
                                                                    <td>{{$spi->remarks}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div align="right" class="mt-10">
                                                        <button type="submit" class="btn btn-primary btn-submit" disabled>Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<!-- DataTables -->
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<style>
    div.dataTables_wrapper div.dataTables_length label {
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
    }
    div.dataTables_wrapper div.dataTables_length select {
        width: 75px;
        display: inline-block;
    }
    div.dataTables_wrapper div.dataTables_filter {
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_filter label {
        font-weight: normal;
        white-space: nowrap;
        text-align: left;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }
    div.dataTables_wrapper div.dataTables_paginate {
        margin: 0;
        white-space: nowrap;
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin: 2px 0;
        white-space: nowrap;
    }
    table.dataTable {
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }
    .dataTables_empty {
        text-align: center;
    }
    .dataTables_wrapper {
        padding-bottom: 0px;
    }
    .mb-10 {
        margin-bottom: 10px;
    }
</style>
<script>
    $(document).on('click', '#checkAll', function () {
        if (this.checked) {
            $('.check-item').each(function () {
                this.checked = true;
            })
        } else {
            $('.check-item').each(function () {
                this.checked = false;
            })
        }
          
        buttonDisabled()
    })

    $(document).on('click', '.check-item', function () {
        if ($('.check-item').length === $('.check-item:checked').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }

        buttonDisabled()
    })

    function buttonDisabled() {
        if ($('.check-item:checked').length > 0) {
            $('.btn-submit').removeAttr('disabled')
        } else {
            $('.btn-submit').attr('disabled', true)
        }
    }

    $(document).ready(function(){

        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'csv', title: 'COTT List'},
                {extend: 'excel', title: 'COTT List'},
                {extend: 'pdf', title: 'COTT List'},
            ]

        });

    });
</script>
@endsection