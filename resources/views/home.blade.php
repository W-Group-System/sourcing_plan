@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">as of {{ date('M. d, Y') }}</span>
                    <h5>COTT</h5>
                </div>
                <div class="ibox-content">
                    @php
                        $cottTotal = \App\Cott::where('approved', '1')->sum('buying_quantity');
                    @endphp
                    <h1 class="no-margins">{{ number_format($cottTotal, 2) }}</h1>
                    <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                    <small>Total MT</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">as of {{ date('M. d, Y') }}</span>
                    <h5>COTT</h5>
                </div>
                <div class="ibox-content">
                    @php
                        $cottExpenses = \App\Cott::where('approved', '1')->sum('expenses');
                    @endphp
                    <h1 class="no-margins">{{ number_format($cottExpenses, 2) }}</h1>
                    <!-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> -->
                    <small>Total Expenses</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">as of {{ date('M. d, Y') }}</span>
                    <h5>SPI</h5>
                </div>
                <div class="ibox-content">
                    @php
                        $spiTotal = \App\Spi::where('approved', '1')->sum('buying_quantity');
                    @endphp
                    <h1 class="no-margins">{{ number_format($spiTotal, 2) }}</h1>
                    <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                    <small>Total MT</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-warning pull-right">as of {{ date('M. d, Y') }}</span>
                    <h5>SPI</h5>
                </div>
                <div class="ibox-content">
                    @php
                        $spiExpenses = \App\Spi::where('approved', '1')->sum('expenses');
                    @endphp
                    <h1 class="no-margins">{{ number_format($spiExpenses, 2) }}</h1>
                    <!-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> -->
                    <small>Total Expenses</small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Suppliers</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Active</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Inactive</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Supplier Code</th>
                                                            <th>Contact Person</th>
                                                            <th>Address</th>
                                                            <th>Tel No.</th>
                                                            <th>Fax No.</th>
                                                            <th>Mobile No.</th>
                                                            <th>Email Address</th>
                                                            <th>Terms</th>
                                                            <th>Accreditation Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($suppliers->where('status', 1) as $supplier)
                                                            <tr>
                                                                <td>{{$supplier->name}}</td>
                                                                <td>{{$supplier->code}}</td>
                                                                <td>{{$supplier->contact_person}}</td>
                                                                <td>{{$supplier->address}}</td>
                                                                <td>@if($supplier->tel_no != null){{$supplier->tel_no}}@else N/A @endif</td>
                                                                <td>@if($supplier->fax_no != null){{$supplier->fax_no}}@else N/A @endif</td>
                                                                <td>0{{$supplier->mobile_no}}</td>
                                                                <td>@if($supplier->email != null){{$supplier->email}}@else N/A @endif</td>
                                                                <td>{{$supplier->terms}}</td>
                                                                <td>{{date('M/d/Y', strtotime($supplier->accreditation_date))}}</td>
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
                                                            <th>Name</th>
                                                            <th>Supplier Code</th>
                                                            <th>Contact Person</th>
                                                            <th>Address</th>
                                                            <th>Tel No.</th>
                                                            <th>Fax No.</th>
                                                            <th>Mobile No.</th>
                                                            <th>Email Address</th>
                                                            <th>Terms</th>
                                                            <th>Accreditation Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($suppliers->where('status',0) as $supplier)
                                                            <tr>
                                                                <td>{{$supplier->name}}</td>
                                                                <td>{{$supplier->code}}</td>
                                                                <td>{{$supplier->contact_person}}</td>
                                                                <td>{{$supplier->address}}</td>
                                                                <td>@if($supplier->tel_no != null){{$supplier->tel_no}}@else N/A @endif</td>
                                                                <td>@if($supplier->fax_no != null){{$supplier->fax_no}}@else N/A @endif</td>
                                                                <td>0{{$supplier->mobile_no}}</td>
                                                                <td>@if($supplier->email != null){{$supplier->email}}@else N/A @endif</td>
                                                                <td>{{$supplier->terms}}</td>
                                                                <td>{{date('M/d/Y', strtotime($supplier->accreditation_date))}}</td>
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
    .ibox-content {
        clear: none;
    }
    .wrapper-content {
        padding: 20px 10px 0px;
    }
    .ibox-title h5 {
        float: none;
        padding: 0px;
    }
</style>
<script>
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