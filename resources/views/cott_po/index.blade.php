@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Additional PO Cottonii List</h5>
                    <div class="ibox-tools">
                        @if (@auth()->user()->position != 'Plant Manager')
                            <a href="{{ url('cott_po/create') }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a>
                        @endif
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="table-responsive">
                            <table class="table table-bordered dataTables-example2 mt-3" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier Name</th>
                                        <th>Lot Code</th>
                                        <th>Quantity</th>                                            
                                        <th>Buying Price</th>
                                        <th>Expenses</th>
                                        <th>Price + Expenses</th>
                                        <th>Original PO Date</th>
                                        <th>PO Date</th>
                                        <th>Area</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($po_cotts as $po_cott)
                                    <tr>
                                        <td>{{$po_cott->id}}</td>
                                        <td>{{$po_cott->supplier->name }}</td>
                                        <td>{{$po_cott->lot_code}}</td>
                                        <td>{{$po_cott->quantity}}</td>
                                        <td>{{$po_cott->buying_price}}</td>
                                        <td>{{$po_cott->expenses}}</td>
                                        <td>{{$po_cott->price_expenses}}</td>
                                        <td>{{$po_cott->original_po_date}}</td>
                                        <td>{{$po_cott->po_date}}</td>
                                        <td>{{$po_cott->area}}</td>
                                        <td>{{$po_cott->remarks}}</td>
                                        <td align="center" style="width: 100px;">
                                            <a href="{{ route('cott_po.edit', ['id' => $po_cott->id]) }}" class="btn btn-warning btn-outline" title="Edit PO Cottonii"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-outline" title="Delete PO Cottonii" onclick="confirmDelete({{ $po_cott->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $po_cott->id }}" action="{{ route('cott_po.delete', ['id' => $po_cott->id]) }}" method="GET" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
@endsection

@section('footer')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        color: #000;
    }
    .pre-disapproved {
        background-color: #ed8282;
        color: #FFF;
    }
    .action {
        max-width: 150px;
        min-width: 150px;
        width: 150px;
        text-align: center;
    }
</style>
<script>
    $(document).ready(function(){
        $('.dataTables-example2').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'csv', title: 'PO Cottonii List'},
                {extend: 'excel', title: 'PO Cottonii List'},
            ]
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
