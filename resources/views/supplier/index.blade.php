@extends('layouts.app')


@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Supplier List</h5>
                    <div class="ibox-tools">
                        @if (@auth()->user()->position != 'Plant Manager')
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add_supplier"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>
                        @endif
                    </div>
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
                                                            <th>Nickname</th>
                                                            <th>Supplier Code</th>
                                                            <th>Contact Person</th>
                                                            <th>Address</th>
                                                            <th>Tel No.</th>
                                                            <th>Fax No.</th>
                                                            <th>Mobile No.</th>
                                                            <th>Email Address</th>
                                                            <th>Terms</th>
                                                            <th>Accreditation Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($suppliers->where('status', 1) as $supplier)
                                                            <tr>
                                                                <td>{{$supplier->name}}</td>
                                                                <td>{{$supplier->nickname}}</td>
                                                                <td>{{$supplier->code}}</td>
                                                                <td>{{$supplier->contact_person}}</td>
                                                                <td>{{$supplier->address}}</td>
                                                                <td>@if($supplier->tel_no != null){{$supplier->tel_no}}@else N/A @endif</td>
                                                                <td>@if($supplier->fax_no != null){{$supplier->fax_no}}@else N/A @endif</td>
                                                                <td>0{{$supplier->mobile_no}}</td>
                                                                <td>@if($supplier->email != null){{$supplier->email}}@else N/A @endif</td>
                                                                <td>{{$supplier->terms}}</td>
                                                                <td>{{date('M/d/Y', strtotime($supplier->accreditation_date))}}</td>
                                                                <td class="action">
                                                                    <button type="button" class="btn btn-sm btn-primary btn-outline" data-toggle="modal" data-target="#edit_supplier{{$supplier->id}}"><i class="fa fa fa-pencil"></i><a href="{{url('update_supplier/'.$supplier->id)}}"></a></button>
                                                                    <a href="status/{{ $supplier->id }}" class="btn btn-sm btn-{{ $supplier->status ? 'danger' : 'success' }} btn-outline">
                                                                        <i class="fa {{ $supplier->status ? 'fa-ban' : 'fa-check' }}"></i>
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
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Nickname</th>
                                                            <th>Supplier Code</th>
                                                            <th>Contact Person</th>
                                                            <th>Address</th>
                                                            <th>Tel No.</th>
                                                            <th>Fax No.</th>
                                                            <th>Mobile No.</th>
                                                            <th>Email Address</th>
                                                            <th>Terms</th>
                                                            <th>Accreditation Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($suppliers->where('status',0) as $supplier)
                                                            <tr>
                                                                <td>{{$supplier->name}}</td>
                                                                <td>{{$supplier->nickname}}</td>
                                                                <td>{{$supplier->code}}</td>
                                                                <td>{{$supplier->contact_person}}</td>
                                                                <td>{{$supplier->address}}</td>
                                                                <td>@if($supplier->tel_no != null){{$supplier->tel_no}}@else N/A @endif</td>
                                                                <td>@if($supplier->fax_no != null){{$supplier->fax_no}}@else N/A @endif</td>
                                                                <td>0{{$supplier->mobile_no}}</td>
                                                                <td>@if($supplier->email != null){{$supplier->email}}@else N/A @endif</td>
                                                                <td>{{$supplier->terms}}</td>
                                                                <td>{{date('M/d/Y', strtotime($supplier->accreditation_date))}}</td>
                                                                <td class="action">
                                                                    <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#edit_supplier{{$supplier->id}}"><i class="fa fa fa-pencil"></i><a href="{{url('update_supplier/'.$supplier->id)}}"></a></button>
                                                                    <a href="status/{{ $supplier->id }}" class="btn btn-{{ $supplier->status ? 'danger' : 'success' }} btn-outline">
                                                                        <i class="fa {{ $supplier->status ? 'fa-ban' : 'fa-check' }}"></i>
                                                                    </a>
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
@foreach($suppliers as $supplier)
    @include('supplier.edit')
@endforeach
<div class="modal fade" id="add_supplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{url('new_supplier')}}" autocomplete="off">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add Supplier</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" class="form-control" type="text" placeholder="Enter Name" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Nickname</label>
                            <input name="nickname" class="form-control" type="text" placeholder="Enter Nickname" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Supplier Code</label>
                            <input name="code" class="form-control" type="text" placeholder="Enter Supplier Code" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Contact Person</label>
                            <input name="contact_person" class="form-control" type="text" placeholder="Enter Contact Person" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Address</label>
                            <input name="address" class="form-control" type="text" placeholder="Enter Address" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Tel No.</label>
                            <input name="tel_no" class="form-control" type="text" placeholder="Enter Tel. No.">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Fax No.</label>
                            <input name="fax_no" class="form-control" type="text" placeholder="Enter Fax No.">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Mobile No.</label>
                            <input name="mobile_no" class="form-control" type="text" placeholder="i.e 0910xxxxxxx" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Email</label>
                            <input name="email" class="form-control" type="email" autocomplete="off" placeholder="Enter Email">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Terms</label>
                            <input name="terms" class="form-control" type="text" placeholder="Enter Terms" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Accreditation Date</label>
                            <input name="accreditation_date" class="form-control" type="date" required>
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
    .action {
        max-width: 100px;
        min-width: 100px;
        width: 100px;
        text-align: center;
    }
</style>
<script>
    $(document).ready(function(){

        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'csv', title: 'Supplier List'},
                {extend: 'excel', title: 'Supplier List'},
                {extend: 'pdf', title: 'Supplier List'},
            ]

        });

    });
</script>
@endsection