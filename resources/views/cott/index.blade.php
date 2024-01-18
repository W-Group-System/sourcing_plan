@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>COTT List</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('cott/create') }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <form method="GET" action="{{ url('/filter') }}">
                                    @csrf
                                    <div class="row mt-10 mb-10">
                                        <div class="col-md-offset-5 col-md-3">
                                            <label for="start_date">Start Datesss:</label>
                                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ isset($start_date) ? $start_date->format('Y-m-d') : '' }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>End Date:</label>
                                            <input type="date" class="form-control" name="end_date" value="{{ isset($end_date) ? $end_date->format('Y-m-d') : '' }}">
                                        </div>
                                        <div class="col-md-1" style="margin-top: 22px">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">List</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">For Approval</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div align="right">
                                                @if(isset($start_date))
                                                    <a target='_blank' href="{{ route('export_cott_pdf', ['start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-primary">Export PDF</a>
                                                @else
                                                    <button class="btn btn-primary" disabled>Export PDF</button>
                                                @endif
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
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
                                                        @foreach($cotts->where('approved',1) as $cott)
                                                            <tr>
                                                                <td>{{$cott->name}}</td>
                                                                <td>{{$cott->destination}}</td>
                                                                <td>{{$cott->food_grade}}</td>
                                                                <td>{{$cott->origin}}</td>
                                                                <td>{{$cott->offer_quantity}}</td>
                                                                <td>{{$cott->buying_quantity}}</td>
                                                                <td>{{$cott->uom}}</td>
                                                                <td>{{$cott->original_price ?$cott->original_price : 'Non-nego'}}</td>
                                                                <td>{{$cott->buying_price}}</td>
                                                                <td>{{$cott->expenses ? $cott->expenses : '-'}}</td>
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
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            {{-- <form method="GET" action="{{ url('/filter') }}">
                                                @csrf
                                                <div class="row mt-10 mb-10">
                                                    <div class="col-md-offset-5 col-md-3">
                                                        <label>Start Date:</label>
                                                        <input type="date" class="form-control" name="start_date">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>End Date:</label>
                                                        <input type="date" class="form-control" name="end_date">
                                                    </div>
                                                    <div class="col-md-1" style="margin-top: 22px">
                                                        <button type="submit" class="btn btn-primary">Filter</button>
                                                    </div>
                                                </div>
                                            </form> --}}
                                            <form method="POST" action="{{url('updateStatus')}}">
                                            @csrf
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th><input id="checkAll" type="checkbox" class="form-check-input"></th>
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
                                                                <th>Comments</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($cotts->where('approved',0) as $cott)
                                                                <tr>
                                                                    <td><input type="checkbox" class="form-check-input check-item" name="checkbox[]" value="{{ $cott->id }}"></td>
                                                                    <td>{{$cott->name}}</td>
                                                                    <td>{{$cott->destination}}</td>
                                                                    <td>{{$cott->food_grade}}</td>
                                                                    <td>{{$cott->origin}}</td>
                                                                    <td>{{$cott->offer_quantity}}</td>
                                                                    <td>{{$cott->buying_quantity}}</td>
                                                                    <td>{{$cott->uom}}</td>
                                                                    <td>{{$cott->original_price ? $cott->original_price : 'Non-nego'}}</td>
                                                                    <td>{{$cott->buying_price}}</td>
                                                                    <td>{{$cott->expenses ? $cott->expenses : '-'}}</td>
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
                                                                    <td>{{$cott->comments}}</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_comments_cott{{$cott->id}}">Add Comments<a href="{{url('add_comments_cott/'.$cott->id)}}"></a></button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div align="right" class="mt-10">
                                                        <button type="submit" class="btn btn-primary btn-submit" disabled>Submit</button>
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
</div>
@foreach($cotts as $cott)
<div class="modal fade" id="add_comments_cott{{$cott->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('add_comments_cott/'.$cott->id)}}" method="POST">
    @csrf
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add Comments</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Comments</label>
                            <input name="comments" class="form-control" type="text" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endforeach
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

        $('.').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
        });

    });

    $(document).on('input', '.check-comments', function () {
        if ($('.check-comments').filter(':enabled').length > 0) {
            $('.btn-comment-submit').removeAttr('disabled');
        } else {
            $('.btn-comment-submit').attr('disabled', true);
        }
    });
</script>
@endsection