@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>On-Hand Seaweed (Plant Stocks + CY Stocks + In-transit) Inventory</h5>
                    <div class="ibox-tools">
                        @if (@auth()->user()->position != 'Plant Manager')
                            <a href="{{ url('onhand_seaweed/create') }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a>
                        @endif
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <form method="GET">
                                    @csrf
                                    <div class="row mt-10 mb-10">
                                        <div class="col-md-offset-5 col-md-3">
                                            <label>Start Date:</label>
                                            <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>End Date:</label>
                                            <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                                        </div>
                                        <div class="col-md-1" style="margin-top: 22px">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="ibox-content">
                                    <div class="wrapper wrapper-content animated fadeIn">
                                        <div class="table-responsive">
                                            <table class="table table-bordered dataTables-example2 mt-3" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Month/Week</th>
                                                        <th>Plant</th>
                                                        {{-- <th>Inventory</th> --}}
                                                        <th>Quantity</th>
                                                        <th>Plant Consumption</th>
                                                        <th># of Days</th>                                            
                                                        <th>Date Updated</th>
                                                        <th>Until</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($onhands as $onhand)
                                                    @php
                                                        $updatedDate = \Carbon\Carbon::parse($onhand->date_updated);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <span class="label label-info">
                                                                {{ $updatedDate->format('F') }} - Week {{ $updatedDate->weekOfMonth }}
                                                            </span>
                                                        </td>
                                                        <td>{{$onhand->plants->name }}</td>
                                                        <td>{{number_format($onhand->quantity,2)}}</td>
                                                        <td>{{number_format($onhand->plant_consumption,2)}}</td>
                                                        <td>{{$onhand->no_of_days}}</td>
                                                        <td>{{$onhand->date_updated}}</td>
                                                        {{-- <td>
                                                            @if($onhand->date_updated && is_numeric($onhand->no_of_days))
                                                                {{ \Carbon\Carbon::parse($onhand->date_updated)
                                                                    ->addDays((int) $onhand->no_of_days - 1)
                                                                    ->format('Y-m-d') }}
                                                            @endif
                                                        </td> --}}
                                                        <td>
                                                            @if($onhand->date_updated && is_numeric($onhand->no_of_days))
                                                                
                                                                @if($onhand->plants->name == 'CAR - SPI')

                                                                    {{-- @php
                                                                        $cott = $onhands->first(function ($item) use ($onhand) {
                                                                            return $item->plants
                                                                                && $item->plants->name == 'CAR - COTT'
                                                                                && $item->date_updated == $onhand->date_updated;
                                                                        });
                                                                    @endphp

                                                                    @if($cott && $cott->date_updated && is_numeric($cott->no_of_days))
                                                                        {{ \Carbon\Carbon::parse($cott->date_updated)
                                                                            ->addDays((int) $cott->no_of_days - 1)
                                                                            ->addDays((int) $onhand->no_of_days)
                                                                            ->format('Y-m-d') }}
                                                                    @endif --}}
                                                                    @php
                                                                        $cott = $onhands->first(function ($item) use ($onhand) {
                                                                            return $item->plants
                                                                                && $item->plants->name == 'CAR - COTT'
                                                                                && $item->date_updated == $onhand->date_updated;
                                                                        });
                                                                    @endphp

                                                                    @if($cott && $cott->date_updated
                                                                        && is_numeric($cott->no_of_days)
                                                                        && is_numeric($onhand->no_of_days))

                                                                        {{ \Carbon\Carbon::parse($cott->date_updated)
                                                                            ->addDays((int) $cott->no_of_days)
                                                                            ->addDays((int) $onhand->no_of_days)
                                                                            ->format('Y-m-d') }}

                                                                    @endif

                                                                
                                                                @elseif ($onhand->plants->name == 'CCC - SPI')

                                                                    @php
                                                                        $cott = $onhands->first(function ($item) use ($onhand) {
                                                                            return $item->plants
                                                                                && $item->plants->name == 'CCC - COTT'
                                                                                && $item->date_updated == $onhand->date_updated;
                                                                        });
                                                                    @endphp

                                                                    @if($cott && $cott->date_updated && is_numeric($cott->no_of_days))
                                                                        {{ \Carbon\Carbon::parse($cott->date_updated)
                                                                            ->addDays((int) $cott->no_of_days - 1)
                                                                            ->addDays((int) $onhand->no_of_days)
                                                                            ->format('Y-m-d') }}
                                                                    @endif
                                                                @else

                                                                    {{ \Carbon\Carbon::parse($onhand->date_updated)
                                                                        ->addDays((int) $onhand->no_of_days - 1)
                                                                        ->format('Y-m-d') }}

                                                                @endif

                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-success btn-outline" data-toggle="modal" data-target="#edit_onhan_seaweed{{ $onhand->id }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        </td>
                                                        {{-- <td align="center" style="width: 100px;">
                                                            @if (auth()->user()->position == "Asst. Manager")
                                                                <button type="button" class="btn btn-danger btn-outline" title="Delete PO Cottonii" onclick="confirmDelete({{ $po_cott->id }})">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <form id="delete-form-{{ $po_cott->id }}" action="{{ route('cott_po.delete', ['id' => $po_cott->id]) }}" method="GET" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            @else
                                                                @if ($po_cott->delete_requests)
                                                                                            
                                                                @else
                                                                    <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#delete_request{{ $po_cott->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <form action="{{ url('cott_po/cott_po_delete_request/' . $po_cott->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger btn-outline" title="Delete COTT PO">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            @endif
                                                        </td> --}}
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
@endsection
@foreach ($onhands as $onhand)
    @include('onhand_seaweed.edit')
@endforeach
    

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
        max-width: 100px !important;
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
            ordering: true,
        });

        // $('.dataTables-example2').DataTable({
        //     pageLength: 25,
        //     responsive: true,
        //     ordering: true,
        //     dom: '<"html5buttons"B>lTfgitp',
        //     buttons: [
        //         {extend: 'csv', title: 'Cottonii List'},
        //         {extend: 'excel', title: 'Cottonii List'},
        //     ]
        // });
    });

</script>
@endsection