@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Demand and Supply List</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Cottonii List</a></li>
                                    <li><a data-toggle="tab" href="#tab-2">Spinosum List</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th width="22%">Start Date</th>
                                                            <th width="22%">End Date</th>
                                                            <th width="16%">CAR</th>
                                                            <th width="16%">CCC</th>
                                                            <th width="16%">PBI</th>
                                                            <th width="8%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($demand_supplies->where('type',1) as $demand_supply)
                                                            <tr>
                                                                <td>{{date('M d, Y', strtotime($demand_supply->from))}}</td>
                                                                <td>{{date('M d, Y', strtotime($demand_supply->to))}}</td>
                                                                <td>{{ $demand_supply->car }}</td>
                                                                <td>{{ $demand_supply->ccc }}</td>
                                                                <td>{{ $demand_supply->pbi }}</td>
                                                                <td align="center">
                                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editDemandSupply-{{$demand_supply->id}}" data-id="{{$demand_supply->id}}" title='Edit Demand and Supply'>
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
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
                                                            <th width="22%">Start Date</th>
                                                            <th width="22%">End Date</th>
                                                            <th width="16%">CAR</th>
                                                            <th width="16%">CCC</th>
                                                            <th width="16%">PBI</th>
                                                            <th width="8%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($demand_supplies->where('type',2) as $demand_supply)
                                                            <tr>
                                                                <td>{{date('M d, Y', strtotime($demand_supply->from))}}</td>
                                                                <td>{{date('M d, Y', strtotime($demand_supply->to))}}</td>
                                                                <td>{{ $demand_supply->car }}</td>
                                                                <td>{{ $demand_supply->ccc }}</td>
                                                                <td>{{ $demand_supply->pbi ?? '0' }}</td>
                                                                <td align="center">
                                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editDemandSupply-{{$demand_supply->id}}" data-id="{{$demand_supply->id}}" title='Edit Demand and Supply'>
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
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
@foreach($demand_supplies as $demand_supply)
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