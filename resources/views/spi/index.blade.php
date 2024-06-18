@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Spinosum List</h5>
                    <div class="ibox-tools">
                        @if (@auth()->user()->position != 'Plant Manager')
                            <a href="{{ url('spi/create') }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a>
                        @endif
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <form method="GET" action="{{ url('/filterSpi') }}">
                                    @csrf
                                    <div class="row mt-10 mb-10">
                                        <div class="col-md-offset-5 col-md-3">
                                            <label>Start Date:</label>
                                            <input type="date" class="form-control" name="start_date" value="{{ isset($start_date) ? $start_date->format('Y-m-d') : '' }}">
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
                                                <a target='_blank' href="{{ route('export_spi_pdf', ['start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-primary export">Export PDF</a>
                                                @if (@auth()->user()->position != 'Plant Manager')
                                                    @if(App\DemandSupply::where(function ($query) use ($start_date, $end_date) {
                                                        $query->whereBetween('from', [$start_date, $end_date])
                                                            ->orWhereBetween('to', [$start_date, $end_date]);
                                                            })->where('type', '!=', 1)->exists())
                                                        <button class="btn btn-primary" style="display: none" >Demand and Supply</button>
                                                    @else
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demandSupply">
                                                            <a href="#" style="color: #FFF">Demand and Supply</a>
                                                        </button>
                                                    @endif
                                                @endif
                                            @endif                      
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
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
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($spis->where('approved',1) as $spi)
                                                            <tr>
                                                                <td>{{$spi->name}}</td>
                                                                <td>{{$spi->destination}}</td>
                                                                <td>{{$spi->pes}}</td>
                                                                <td>{{$spi->origin}}</td>
                                                                <td>{{$spi->offer_quantity}}</td>
                                                                <td>{{$spi->buying_quantity}}</td>
                                                                <td>{{$spi->uom}}</td>
                                                                <td>{{$spi->original_price ?$spi->original_price : 'Non-nego'}}</td>
                                                                <td>{{$spi->buying_price}}</td>
                                                                <td>{{$spi->expenses ? $spi->expenses : '-'}}</td>
                                                                <td>{{$spi->price_expense}}</td>
                                                                <td>{{$spi->moisture_content}}</td>
                                                                <td>{{$spi->delivery_schedule}}</td>
                                                                <td>{{$spi->terms_payment}}</td>
                                                                <td>{{$spi->potassium}}</td>
                                                                <td> 
                                                                    @if (is_numeric($spi->chips_yield))
                                                                        {{ number_format($spi->chips_yield, 2) }}%
                                                                    @else
                                                                        {{ $spi->chips_yield }}
                                                                    @endif
                                                                </td>
                                                                <td>{{$spi->powder_yield}}%</td>
                                                                <td>{{$spi->price_yield}}</td>
                                                                <td>{{$spi->forex_rate}}</td>
                                                                <td>{{$spi->price_usd}}</td>
                                                                <td>{{$spi->cost_produce}}</td>
                                                                <td>{{$spi->price_ctp}}</td>
                                                                <td>{{$spi->remarks}}</td>
                                                                <td>{{$spi->area}}</td>
                                                                <td align="center">
                                                                    <a href="{{ route('spi.editApproved', ['id' => $spi->id]) }}" class="btn btn-warning btn-outline" title="Edit Cottonii"><i class="fa fa fa-pencil"></i></a>
                                                                    <a href="{{ route('spis.delete', ['id' => $spi->id]) }}">
                                                                        <button type="button" class="btn btn-danger btn-outline" title="Delete SPI"><i class="fa fa fa-trash"></i></button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                        <div align="right">
                                                @if(isset($start_date))
                                                    <a target='_blank' href="{{ route('for_approval_spi', ['start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-primary export">Export PDF</a>
                                                    @if (@auth()->user()->position != 'Plant Manager')
                                                        @if(App\DemandSupply::where(function ($query) use ($start_date, $end_date) {
                                                            $query->whereBetween('from', [$start_date, $end_date])
                                                                ->orWhereBetween('to', [$start_date, $end_date]);
                                                                })->where('type', '!=', 1)->exists())
                                                            <button class="btn btn-primary" style="display: none" >Demand and Supply</button>
                                                        @else
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demandSupply">
                                                                <a href="#" style="color: #FFF">Demand and Supply</a>
                                                            </button>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            <form method="POST" action="{{url('spi/updateStatus')}}">
                                            @csrf
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th><input id="checkAll" type="checkbox" class="form-check-input"></th>
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
                                                                <th>Comments</th>
                                                                <th>Pre Approved</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($spis->where('approved',0) as $spi)
                                                                <tr>
                                                                    <td>
                                                                        <input type="checkbox" class="form-check-input check-item" name="checkbox[]" value="{{ $spi->id }}">
                                                                    </td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->name}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->destination}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->pes}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->origin}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->offer_quantity}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->buying_quantity}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->uom}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->original_price ? $spi->original_price : 'Non-nego'}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->buying_price}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->expenses ? $spi->expenses : '-'}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->price_expense}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->moisture_content}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->delivery_schedule}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->terms_payment}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->potassium}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">
                                                                        @if (is_numeric($spi->chips_yield))
                                                                            {{ number_format($spi->chips_yield, 2) }}%
                                                                        @else
                                                                            {{ $spi->chips_yield }}
                                                                        @endif
                                                                    </td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->powder_yield}}%</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->price_yield}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->forex_rate}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->price_usd}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->cost_produce}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->price_ctp}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->remarks}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->area}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->comments}}</td>
                                                                    <td class="{{ $spi->status == 1 ? 'pre-approved' : '' }}">{{$spi->pre_approved}}</td>
                                                                    <!-- <td class="action">
                                                                        <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#add_comments_spi{{$spi->id}}">
                                                                            <i class="fa fa-comments"></i>
                                                                            <a href="{{url('add_comments_spi/'.$spi->id)}}"></a>
                                                                        </button>
                                                                        <a href="approvedStatus/{{ $spi->id }}" title="Approved" class="btn btn-success btn-outline" style="{{ $spi->status == 1 ? 'display: none;' : '' }}">
                                                                            <i class="fa fa-thumbs-up"></i>
                                                                        </a>
                                                                        <a href="disapprovedStatus/{{ $spi->id }}" title="Disapproved" class="btn btn-danger btn-outline" style="{{ $spi->status == 0 ? 'display: none;' : '' }}">
                                                                            <i class="fa fa-thumbs-down"></i>
                                                                        </a>
                                                                    </td> -->
                                                                    <td class="action">
                                                                        <a href="{{ route('spi.edit', ['id' => $spi->id]) }}" class="btn btn-warning btn-outline" title="Edit Cottonii"><i class="fa fa fa-pencil"></i></a>
                                                                        <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#add_comments_spi{{$spi->id}}" title="Add Comments">
                                                                            <i class="fa fa-comments"></i>
                                                                            <a href="{{url('add_comments_spi/'.$spi->id)}}"></a>
                                                                        </button>
                                                                        @if (@auth()->user()->position == 'Plant Manager' && $spi->status == 1) 
                                                                            <a href="preApproverSpi/{{ $spi->id }}" title="Pre-approved" class="btn btn-success btn-outline"><i class="fa fa-thumbs-up"></i></a>
                                                                        @endif
                                                                        @if (@auth()->user()->position != 'Plant Manager')
                                                                            <a href="approvedStatus/{{ $spi->id }}" title="Approved" class="btn btn-success btn-outline" style="{{ $spi->status == 1 ? 'display: none;' : '' }}">
                                                                                <i class="fa fa-thumbs-up"></i>
                                                                            </a>
                                                                            <a href="disapprovedStatus/{{ $spi->id }}" title="Disapproved" class="btn btn-danger btn-outline" style="{{ $spi->status == 0 ? 'display: none;' : '' }}">
                                                                                <i class="fa fa-thumbs-down"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div align="right" class="mt-10">
                                                        <button type="submit" name="action" value="approved" class="btn btn-info btn-submit" disabled>Submit</button>
                                                        <button type="submit" class="btn btn-primary btn-submit" name="action" value="approve" disabled>Approve All</button>
                                                        <button type="submit" class="btn btn-danger btn-submit" name="action" value="disapprove" disabled>Disapprove All</button>
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
@foreach($spis as $spi)
<div class="modal fade" id="add_comments_spi{{$spi->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('add_comments_spi/'.$spi->id)}}" method="POST">
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
                            <input name="comments" class="form-control" type="text" placeholder="Add Comments">
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
<div class="modal fade" id="demandSupply" tabindex="-1" aria-labelledby="demandSupply" aria-hidden="true">
    <form action="{{ url('add_demand_spi') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="demandSupply">Demand and Supply</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mb-10" style="padding-left: 0px">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="from" value="{{ isset($start_date) ? $start_date->format('Y-m-d') : '' }}" readonly>
                        </div>
                        <div class="col-lg-6 mb-10" style="padding-right: 0px">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="to" value="{{ isset($end_date) ? $end_date->format('Y-m-d') : '' }}" readonly> 
                        </div>
                        <div class="col-12 mb-10">
                            <label>CAR</label>
                            <input name="car" class="form-control" type="text" placeholder="Enter CAR">
                        </div>
                        <div class="col-12 mb-10">
                            <label>CCC</label>
                            <input name="ccc" class="form-control" type="text" placeholder="Enter CCC">
                        </div>
                        <!-- <div class="col-12 mb-10">
                            <label>PBI</label>
                            <input name="pbi" class="form-control" type="text" placeholder="Enter PBI">
                        </div> -->
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
    .export {
        margin: 5px 5px 5px 5px;
    }
    .pre-approved {
        background-color: #d4e7c5;
        color: black;
    }
    .action {
        max-width: 150px;
        min-width: 150px;
        width: 150px;
        text-align: center;
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
            ordering: false,
        });

        // $('.dataTables-example2').DataTable({
        //     pageLength: 25,
        //     responsive: true,
        //     dom: '<"html5buttons"B>lTfgitp',
        //     buttons: [
        //         {extend: 'csv', title: 'SPI List'},
        //         {extend: 'excel', title: 'SPI List'},
        //     ]
        // });

    });
</script>
@endsection