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
                            {{-- <a href="{{ url('onhand_seaweed/create') }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a> --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newOnhand">
                                <i class="fa fa-plus">Add</i>
                            </button>
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
                                                        <th>Date Range</th>
                                                        <th>Date Updated</th>
                                                        <th>Action</th>

                                                        {{-- <th>Plant</th> --}}
                                                        {{-- <th>Inventory</th> --}}
                                                        {{-- <th>Quantity</th>
                                                        <th>Plant Consumption</th>
                                                        <th># of Days</th>                                            
                                                        
                                                        <th>Until</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($weeklyOnhands as $week => $records)
                                                        @php
                                                            $date = \Carbon\Carbon::parse($records->first()->date_updated);

                                                            $weekStart = $date->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
                                                            $weekEnd = $date->copy()->endOfWeek(\Carbon\Carbon::SATURDAY);

                                                            $updatedDate = \Carbon\Carbon::parse($records->max('date_updated'));
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <span class="label label-info">
                                                                    {{ $date->format('F') }}
                                                                    Week {{ $date->weekOfMonth }}
                                                                </span>
                                                            </td>

                                                            <td>
                                                                {{ $weekStart->format('F d') }}
                                                                -
                                                                {{ $weekEnd->format('F d, Y') }}
                                                            </td>

                                                            <td>
                                                                {{ $updatedDate->format('F d, Y') }}
                                                            </td>


                                                            <td>
                                                                <button type="button"
                                                                        class="btn btn-success edit-week"
                                                                        data-toggle="modal"
                                                                        data-target="#editOnhand"
                                                                        data-date="{{ $updatedDate->format('Y-m-d') }}"
                                                                        data-records='@json($records)'>
                                                                    <i class="fa fa-pencil"></i> Edit
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        @endforeach
                                                    {{-- @php
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
                                                        <td>
                                                            @if($onhand->date_updated && is_numeric($onhand->no_of_days))
                                                                
                                                                @if($onhand->plants->name == 'CAR - SPI')
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
                                                    </tr> --}}
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
@include('onhand_seaweed.new')
{{-- @foreach ($onhands as $onhand)
    @include('onhand_seaweed.edit')
@endforeach --}}
{{-- @foreach($weeklyOnhands as $week => $records) --}}
    @include('onhand_seaweed.edit_onhand')
{{-- @endforeach --}}
    

@section('footer')
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

 $(document).on('click', '.edit-week', function () {

    var dateUpdated = $(this).data('date');

    var records = JSON.parse(
        $(this).attr('data-records')
    );

    $('#edit_date_updated').val(dateUpdated);

    $('#editOnhand .plant-row').each(function () {

        var plantId = $(this)
            .find('input[name*="[plant_id]"]')
            .val();

        $('#edit-id-' + plantId).val('');
        $('#edit-quantity-' + plantId).val('');
        $('#edit-consumption-' + plantId).val('');
        $('#edit-days-' + plantId).val('');
        $('#edit-until-date-' + plantId).val('');

    });

    $.each(records, function(index, record) {

        var plantId = record.plant_id;

        $('#edit-id-' + plantId)
            .val(record.id);

        $('#edit-quantity-' + plantId)
            .val(record.quantity);

        $('#edit-consumption-' + plantId)
            .val(record.plant_consumption);

        $('#edit-days-' + plantId)
            .val(record.no_of_days);

    });

    calculateEditUntilDates();

});


$(document).on(
    'input',
    '#editOnhand .quantity, #editOnhand .plant-consumption',
    function () {

        var row = $(this).closest('.plant-row');

        var quantity = parseFloat(
            row.find('.quantity').val()
        );

        var consumption = parseFloat(
            row.find('.plant-consumption').val()
        );

        if (
            !isNaN(quantity) &&
            !isNaN(consumption) &&
            consumption > 0
        ) {

            var days = Math.round(
                quantity / consumption
            );

            row.find('.new-no-of-days').val(days);

        } else {

            row.find('.new-no-of-days').val('');

        }

        calculateEditUntilDates();

    }
);


$(document).on(
    'change',
    '#edit_date_updated',
    function () {

        calculateEditUntilDates();

    }
);


function calculateEditUntilDates() {

    var dateUpdated = $('#edit_date_updated').val();

    if (!dateUpdated) {
        return;
    }

    var records = [];

    $('#editOnhand .plant-row').each(function () {

        var row = $(this);

        // Get plant name from the first column
        var plantName = row
            .find('td:first')
            .text()
            .trim();

        var days = parseInt(
            row.find('.new-no-of-days').val()
        );

        if (!plantName || isNaN(days)) {
            return;
        }

        records.push({
            plantName: plantName,
            days: days
        });

    });


    function getPlantDays(name) {

        var result = records.find(function (item) {
            return item.plantName === name;
        });

        return result ? result.days : null;

    }


    function addDays(dateString, days) {

        var date = new Date(
            dateString + 'T00:00:00'
        );

        date.setDate(
            date.getDate() + days
        );

        var year = date.getFullYear();

        var month = String(
            date.getMonth() + 1
        ).padStart(2, '0');

        var day = String(
            date.getDate()
        ).padStart(2, '0');

        return year + '-' + month + '-' + day;

    }


    $('#editOnhand .plant-row').each(function () {

        var row = $(this);

        var plantName = row
            .find('td:first')
            .text()
            .trim();

        var days = parseInt(
            row.find('.new-no-of-days').val()
        );

        if (!plantName || isNaN(days)) {

            row.find('.until-date').val('');

            return;

        }


        // CAR - SPI
        if (plantName === 'CAR - SPI') {

            var cottDays = getPlantDays(
                'CAR - COTT'
            );

            if (cottDays !== null) {

                var cottDate = addDays(
                    dateUpdated,
                    cottDays
                );

                var untilDate = addDays(
                    cottDate,
                    days
                );

                row.find('.until-date')
                    .val(untilDate);

            } else {

                row.find('.until-date').val('');

            }

        }


        // CCC - SPI
        else if (plantName === 'CCC - SPI') {

            var cottDays = getPlantDays(
                'CCC - COTT'
            );

            if (cottDays !== null) {

                var cottDate = addDays(
                    dateUpdated,
                    cottDays - 1
                );

                var untilDate = addDays(
                    cottDate,
                    days
                );

                row.find('.until-date')
                    .val(untilDate);

            } else {

                row.find('.until-date').val('');

            }

        }


        // COTT / Other plants
        else {

            var untilDate = addDays(
                dateUpdated,
                days - 1
            );

            row.find('.until-date')
                .val(untilDate);

        }

    });

}


    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: true,
        });
    });

</script>
@endsection