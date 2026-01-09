@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Delete Requests</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Cottonii</a></li>
                                    <li><a data-toggle="tab" href="#tab-2">Spinosum</a></li>
                                    <li><a data-toggle="tab" href="#tab-3">Additional Cottonii Po</a></li>
                                    <li><a data-toggle="tab" href="#tab-4">Additional Spinosum Po</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Requestor</th>
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
                                                            <th>Reason</th>
                                                            <th>Status</th>
                                                            <th>Approved By</th>
                                                            <th>Approved At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($delete_requests->where('type', 'Cott') as $cott)
                                                            <tr>
                                                                <td>{{$cott->requestor->name}}</td>
                                                                <td>{{$cott->cotts->name}}</td>
                                                                <td>{{$cott->cotts->destination}}</td>
                                                                <td>{{$cott->cotts->food_grade}}</td>
                                                                <td>{{$cott->cotts->origin}}</td>
                                                                <td>{{$cott->cotts->offer_quantity}}</td>
                                                                <td>{{$cott->cotts->buying_quantity}}</td>
                                                                <td>{{$cott->cotts->uom}}</td>
                                                                <td>{{$cott->cotts->original_price ?$cott->cotts->original_price : 'Non-nego'}}</td>
                                                                <td>{{$cott->cotts->buying_price}}</td>
                                                                <td>{{$cott->cotts->expenses ? $cott->cotts->expenses : '-'}}</td>
                                                                <td>{{$cott->cotts->price_expense}}</td>
                                                                <td>{{$cott->cotts->moisture_content}}</td>
                                                                <td>{{$cott->cotts->delivery_schedule}}</td>
                                                                <td>{{$cott->cotts->terms_payment}}</td>
                                                                <td>{{$cott->cotts->potassium}}</td>
                                                                <td>
                                                                    @if (is_numeric($cott->cotts->chips_yield))
                                                                        {{ number_format($cott->cotts->chips_yield, 2) }}%
                                                                    @else
                                                                        {{ $cott->cotts->chips_yield }}
                                                                    @endif
                                                                </td>
                                                                <td>{{$cott->cotts->powder_yield}}%</td>
                                                                <td>{{$cott->cotts->price_yield}}</td>
                                                                <td>{{$cott->cotts->forex_rate}}</td>
                                                                <td>{{$cott->cotts->price_usd}}</td>
                                                                <td>{{$cott->cotts->cost_produce}}</td>
                                                                <td>{{$cott->cotts->price_ctp}}</td>
                                                                <td>{{$cott->cotts->remarks}}</td>
                                                                <td>{{$cott->cotts->area}}</td>
                                                                <td>{{$cott->reason}}</td>
                                                                <td>{{$cott->status}}</td>
                                                                <td>{{optional($cott->approvedBy)->name}}</td>
                                                                <td>{{$cott->approved_at}}</td>
                                                                <td align="center">
                                                                    @if ($cott->status === "Pending Approval")
                                                                        <form action="{{ url('cotts/approve_deletion/' . $cott->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                            <button type="submit" class="btn btn-success btn-outline" title="Approve">
                                                                                <i class="fa fa-check"></i>
                                                                            </button>
                                                                        </form>
                                                                        <form action="{{ url('cotts/disapprove_deletion/' . $cott->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-warning btn-outline" title="Decline">
                                                                                <i class="fa fa-ban"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    
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
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Requestor</th>
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
                                                            <th>Reason</th>
                                                            <th>Status</th>
                                                            <th>Approved By</th>
                                                            <th>Approved At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($delete_requests->where('type', 'Spi') as $spi)
                                                            <tr>
                                                                <td>{{$spi->requestor->name}}</td>
                                                                <td>{{$spi->spis->name}}</td>
                                                                <td>{{$spi->spis->destination}}</td>
                                                                <td>{{$spi->spis->pes}}</td>
                                                                <td>{{$spi->spis->origin}}</td>
                                                                <td>{{$spi->spis->offer_quantity}}</td>
                                                                <td>{{$spi->spis->buying_quantity}}</td>
                                                                <td>{{$spi->spis->uom}}</td>
                                                                <td>{{$spi->spis->original_price ?$spi->spis->original_price : 'Non-nego'}}</td>
                                                                <td>{{$spi->spis->buying_price}}</td>
                                                                <td>{{$spi->spis->expenses ? $spi->spis->expenses : '-'}}</td>
                                                                <td>{{$spi->spis->price_expense}}</td>
                                                                <td>{{$spi->spis->moisture_content}}</td>
                                                                <td>{{$spi->spis->delivery_schedule}}</td>
                                                                <td>{{$spi->spis->terms_payment}}</td>
                                                                <td>{{$spi->spis->potassium}}</td>
                                                                <td> 
                                                                    @if (is_numeric($spi->spis->chips_yield))
                                                                        {{ number_format($spi->spis->chips_yield, 2) }}%
                                                                    @else
                                                                        {{ $spi->spis->chips_yield }}
                                                                    @endif
                                                                </td>
                                                                <td>{{$spi->spis->powder_yield}}%</td>
                                                                <td>{{$spi->spis->price_yield}}</td>
                                                                <td>{{$spi->spis->forex_rate}}</td>
                                                                <td>{{$spi->spis->price_usd}}</td>
                                                                <td>{{$spi->spis->cost_produce}}</td>
                                                                <td>{{$spi->spis->price_ctp}}</td>
                                                                <td>{{$spi->spis->remarks}}</td>
                                                                <td>{{$spi->spis->area}}</td>
                                                                <td>{{$spi->reason}}</td>
                                                                <td>{{$spi->status}}</td>
                                                                <td>{{optional($spi->approvedBy)->name}}</td>
                                                                <td>{{$spi->approved_at}}</td>
                                                                <td align="center">
                                                                    @if ($spi->status === "Pending Approval")
                                                                        <form action="{{ url('spis/approve_deletion/' . $spi->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                            <button type="submit" class="btn btn-success btn-outline" title="Approve">
                                                                                <i class="fa fa-check"></i>
                                                                            </button>
                                                                        </form>
                                                                        <form action="{{ url('spis/disapprove_deletion/' . $spi->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-warning btn-outline" title="Decline">
                                                                                <i class="fa fa-ban"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Requestor</th>
                                                            <th>Supplier Name</th>
                                                            <th>Lot Code</th>
                                                            <th>Quantity</th>                                            
                                                            <th>Buying Price</th>
                                                            <th>Expenses</th>
                                                            <th>Price + Expenses</th>
                                                            <th>Original PO Date</th>
                                                            <th>PO Date</th>
                                                            <th>Area</th>
                                                            <th>Reason</th>
                                                            <th>Status</th>
                                                            <th>Approved By</th>
                                                            <th>Approved At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($delete_requests->where('type', 'Cott Po') as $po_cott)
                                                        <tr>
                                                            <td>{{$po_cott->requestor->name}}</td>
                                                            <td>{{$po_cott->po_cotts->supplier->name }}</td>
                                                            <td>{{$po_cott->po_cotts->lot_code}}</td>
                                                            <td>{{$po_cott->po_cotts->quantity}}</td>
                                                            <td>{{$po_cott->po_cotts->buying_price}}</td>
                                                            <td>{{$po_cott->po_cotts->expenses}}</td>
                                                            <td>{{$po_cott->po_cotts->price_expenses}}</td>
                                                            <td>{{$po_cott->po_cotts->original_po_date}}</td>
                                                            <td>{{$po_cott->po_cotts->po_date}}</td>
                                                            <td>{{$po_cott->po_cotts->area}}</td>
                                                            <td>{{$po_cott->reason}}</td>
                                                            <td>{{$po_cott->status}}</td>
                                                            <td>{{optional($po_cott->approvedBy)->name}}</td>
                                                            <td>{{$po_cott->approved_at}}</td>
                                                            <td align="center">
                                                                @if ($po_cott->status === "Pending Approval")
                                                                    <form action="{{ url('cott_po/approve_deletion/' . $po_cott->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                        <button type="submit" class="btn btn-success btn-outline" title="Approve">
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ url('cott_po/disapprove_deletion/' . $po_cott->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-warning btn-outline" title="Decline">
                                                                            <i class="fa fa-ban"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-4" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Requestor</th>
                                                            <th>Supplier Name</th>
                                                            <th>Lot Code</th>
                                                            <th>Quantity</th>                                            
                                                            <th>Buying Price</th>
                                                            <th>Expenses</th>
                                                            <th>Price + Expenses</th>
                                                            <th>Original PO Date</th>
                                                            <th>PO Date</th>
                                                            <th>Area</th>
                                                            <th>Reason</th>
                                                            <th>Status</th>
                                                            <th>Approved By</th>
                                                            <th>Approved At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($delete_requests->where('type', 'Spi Po') as $po_spi)
                                                        <tr>
                                                            <td>{{$po_spi->requestor->name}}</td>
                                                            <td>{{$po_spi->po_spis->supplier->name }}</td>
                                                            <td>{{$po_spi->po_spis->lot_code}}</td>
                                                            <td>{{$po_spi->po_spis->quantity}}</td>
                                                            <td>{{$po_spi->po_spis->buying_price}}</td>
                                                            <td>{{$po_spi->po_spis->expenses}}</td>
                                                            <td>{{$po_spi->po_spis->price_expenses}}</td>
                                                            <td>{{$po_spi->po_spis->original_po_date}}</td>
                                                            <td>{{$po_spi->po_spis->po_date}}</td>
                                                            <td>{{$po_spi->po_spis->area}}</td>
                                                            <td>{{$po_spi->reason}}</td>
                                                            <td>{{$po_spi->status}}</td>
                                                            <td>{{optional($po_spi->approvedBy)->name}}</td>
                                                            <td>{{$po_spi->approved_at}}</td>
                                                            <td align="center">
                                                                @if ($po_spi->status === "Pending Approval")
                                                                    <form action="{{ url('spi_po/approve_deletion/' . $po_spi->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                        <button type="submit" class="btn btn-success btn-outline" title="Approve">
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ url('spi_po/disapprove_deletion/' . $po_spi->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-warning btn-outline" title="Decline">
                                                                            <i class="fa fa-ban"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
</div>
{{-- @foreach($demand_supplies as $demand_supply)
<div class="modal fade" id="editDemandSupply-{{ $demand_supply->id }}" tabindex="-1" aria-labelledby="demandSupplyLabel" aria-hidden="true">
    <form action="{{ url('update_demand_supply/' . $demand_supply->id) }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="demandSupplyLabel">Edit Demand and Supply</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mb-10" style="padding-left: 0px">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="from" value="{{ $demand_supply->from }}" readonly>
                        </div>
                        <div class="col-lg-6 mb-10" style="padding-right: 0px">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="to" value="{{ $demand_supply->to }}" readonly>
                        </div>
                        <div class="col-12 mb-10">
                            <label>CAR</label>
                            <input name="car" class="form-control" type="text" placeholder="Enter CAR" value="{{ $demand_supply->car }}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>CCC</label>
                            <input name="ccc" class="form-control" type="text" placeholder="Enter CCC" value="{{ $demand_supply->ccc }}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>PBI</label>
                            <input name="pbi" class="form-control" type="text" placeholder="Enter PBI" value="{{ $demand_supply->pbi ?? '0' }}">
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
@endforeach --}}
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
  
</style>
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: true,
        });
    });
</script>
@endsection