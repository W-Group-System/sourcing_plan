@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">as of {{ date('M. d, Y') }}</span>
                    <h5>Cottonii</h5>
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
                    <h5>Cottonii </h5>
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
                    <h5>Spinosum</h5>
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
                    <h5>Spinosum</h5>
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
                    <h5>Cottonii</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <div style="justify-content: center; display:flex;" id="legend-container"></div>
                    </div>
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
                    <h5>Spinossum</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="spinossum-dashboard-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <div style="justify-content: center; display:flex;" id="spilegend-container"></div>
                    </div>
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
 
<!-- Flot -->
 <script src="js/plugins/flot/jquery.flot.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.stack.min.js"></script>
 <script src="js/plugins/flot/jquery.flot.pie.js"></script>
 <script src="js/plugins/flot/jquery.flot.time.js"></script>

 <!-- EayPIE -->
 <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>
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

    //    Jun Jihad Barroga Combograph
    var weeklyQuantities = @json($weeklyQuantities);
    var weightedPrices = @json($weightedPrices);
    var dataSets = {
        "ZAMBO BS": [],
        "PAL BS": [],
        "MINDORO BS": [],
        "CEBU": [],
        "INDO": [],
        "OTHERS": []
    };

    function getMonday(d) {
        d = new Date(d);
        var day = d.getDay(),
            diff = d.getDate() - day + (day === 0 ? -6 : 1); 
        return new Date(d.setDate(diff));
    }

    function getDateOfISOWeek(w, y) {
        var simple = new Date(y, 0, 1 + (w - 1) * 7);
        var dow = simple.getDay();
        var ISOweekStart = simple;
        if (dow <= 4)
            ISOweekStart.setDate(simple.getDate() - simple.getDay() + 1);
        else
            ISOweekStart.setDate(simple.getDate() + 8 - simple.getDay());
        return ISOweekStart;
    }

    for (var week in weeklyQuantities) {
        var yearWeek = week.split('-');
        var year = parseInt(yearWeek[0]);
        var weekNum = parseInt(yearWeek[1]);
        var monday = getDateOfISOWeek(weekNum, year);

        // console.log(`Week: ${week}, Monday: ${monday}`);

        var cumulativeQuantity = {};
        var hasData = false;

        Object.keys(dataSets).forEach(area => {
            if (weeklyQuantities[week].hasOwnProperty(area) && weeklyQuantities[week][area] > 0) {
                hasData = true;
            }
            var quantity = weeklyQuantities[week][area] || 0;
            cumulativeQuantity[area] = (cumulativeQuantity[area] || 0) + quantity;
        });

        if (hasData) {
            Object.keys(dataSets).forEach(area => {
                dataSets[area].push([monday.getTime(), cumulativeQuantity[area]]);
            });
        }
    }

    var priceData = [];
    for (var week in weightedPrices) {
        var yearWeek = week.split('-');
        var year = parseInt(yearWeek[0]);
        var weekNum = parseInt(yearWeek[1]);
        var monday = getDateOfISOWeek(weekNum, year);

        // console.log(`Price Week: ${week}, Monday: ${monday}`);

        priceData.push([monday.getTime(), weightedPrices[week]]);
        
    }

    var minDate = Infinity;
    var maxDate = -Infinity;

    Object.keys(dataSets).forEach(area => {
        dataSets[area].forEach(point => {
            minDate = Math.min(minDate, point[0]);
            maxDate = Math.max(maxDate, point[0]);
        });
    });

    var tickPositions = [];
    var currentDate = minDate;
    while (currentDate <= maxDate) {
        tickPositions.push(currentDate);
        currentDate += 7 * 24 * 60 * 60 * 1000; 
    }

    var areaColors = {
        "ZAMBO BS": "#2e75b6",
        "PAL BS": "#ff0000",
        "MINDORO BS": "#00b050",
        "CEBU": "#ffff00",
        "INDO": "#002060",
        "OTHERS": "#000000",
    };

    var dataset = Object.keys(dataSets).map(area => ({
        label: area,
        data: dataSets[area],
        color: areaColors[area],
        bars: {
            show: true,
            align: "center",
            barWidth: 2 * 24 * 60 * 60 * 1000, 
            lineWidth: 0,
            fill: true,
            fillColor: areaColors[area],
        }
    }));

    dataset.push({
        label: "Price",
        data: priceData,
        yaxis: 2,
        color: "#8A2BE2",
        lines: {
            show: true,
            lineWidth: 1.5,
            fill: false,
        },
        stack: null,
        points: {
        show: true,
        radius: 3,
        fill: true,
        fillColor: "#8A2BE2"
    }
    });

    var options = {
        series: {
            stack: true, 
        },
        xaxis: {
            mode: "time",
            ticks: tickPositions,
            axisLabel: "Date",
            tickSize: [7, "day"],
            tickLength: 0,
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 10,
            color: "#d5d5d5",
            tickFormatter: function(val, axis) {
                var date = new Date(val);
                var startDate = getMonday(date);
                var endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 6);
                return $.plot.formatDate(startDate, "%b %d") + " - " + $.plot.formatDate(endDate, "%d");
            },
            rotateTicks: 45
        },
        yaxes: [{
            position: "left",
            max: 1200,
            color: "#d5d5d5",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 3,
            ticks: [0, 200, 400, 600, 800, 1000, 1200]
        }, {
            position: "right",
            color: "#d5d5d5",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 67
        }],
        legend: {
            noColumns: 9,
            labelBoxBorderColor: "#000000",
            container: $("#legend-container"),
            labelFormatter: function(label, series) {
        return '<span style="padding-right: 10px;">' + label + '</span>';
    }
        },
        grid: {
            hoverable: true,
            borderWidth: 0
        },
        
    };

  
var plot = $.plot($("#flot-dashboard-chart"), dataset, options);


function addDataLabels() {
    var plotOffset = plot.getPlotOffset();


    priceData.forEach(function(point) {
        var x = point[0];
        var y = point[1].toFixed(2); 
        var plotPos = plot.pointOffset({ x: x, y: y });

        
        var label = $('<div class="data-label">' + y + '</div>').css({
            position: 'absolute',
            left: plotPos.left - plotOffset.left ,
            top: plotPos.top - plotOffset.top , 
            color: '#8a2be2',
            // backgroundColor: '#ffffff', 
            // padding: '4px',
            borderRadius: '4px',
            zIndex: '10' 
        });

        $("#flot-dashboard-chart").append(label);
    });
}

addDataLabels();


    $("<div id='tooltip'></div>").css({
        position: "absolute",
        display: "none",
        border: "1px solid #fdd",
        padding: "2px",
        "background-color": "#fee",
        opacity: 0.80
    }).appendTo("body");

    $("#flot-dashboard-chart").bind("plothover", function(event, pos, item) {
        if (item) {
            var series = item.series;
            var x = item.datapoint[0];
            var y;

            if (series.bars.show) { 
                y = item.datapoint[1] - item.datapoint[2]; 
            } else { 
                y = item.datapoint[1];
            }

            var date = new Date(x);
            var formattedDate = $.plot.formatDate(date, "%b %d, %Y");

            $("#tooltip").html(series.label + ": " + y.toFixed(2) + "<br>" + formattedDate)
                .css({
                    top: item.pageY + 5,
                    left: item.pageX + 5
                })
                .fadeIn(200);
        } else {
            $("#tooltip").hide();
        }
    });



    var spinossumWeeklyQuantities = @json($weeklySpiQuantities);
    var spinossumWeightedPrices = @json($weightedSpiPrices);
    var dataSets = {
        "ZAMBO BS": [],
        "PAL BS": [],
        "MINDORO BS": [],
        "CEBU": [],
        "INDO": [],
        "OTHERS": []
    };

    function getMonday(d) {
        d = new Date(d);
        var day = d.getDay(),
            diff = d.getDate() - day + (day === 0 ? -6 : 1); 
        return new Date(d.setDate(diff));
    }

    function getDateOfISOWeek(w, y) {
        var simple = new Date(y, 0, 1 + (w - 1) * 7);
        var dow = simple.getDay();
        var ISOweekStart = simple;
        if (dow <= 4)
            ISOweekStart.setDate(simple.getDate() - simple.getDay() + 1);
        else
            ISOweekStart.setDate(simple.getDate() + 8 - simple.getDay());
        return ISOweekStart;
    }

    for (var week in spinossumWeeklyQuantities) {
        var yearWeek = week.split('-');
        var year = parseInt(yearWeek[0]);
        var weekNum = parseInt(yearWeek[1]);
        var monday = getDateOfISOWeek(weekNum, year);

        // console.log(`Week: ${week}, Monday: ${monday}`);

        var cumulativeQuantity = {};
        var hasData = false;

        Object.keys(dataSets).forEach(area => {
            if (spinossumWeeklyQuantities[week].hasOwnProperty(area) && spinossumWeeklyQuantities[week][area] > 0) {
                hasData = true;
            }
            var quantity = spinossumWeeklyQuantities[week][area] || 0;
            cumulativeQuantity[area] = (cumulativeQuantity[area] || 0) + quantity;
        });

        if (hasData) {
            Object.keys(dataSets).forEach(area => {
                dataSets[area].push([monday.getTime(), cumulativeQuantity[area]]);
            });
        }
    }

    var priceData = [];
    for (var week in spinossumWeightedPrices) {
        var yearWeek = week.split('-');
        var year = parseInt(yearWeek[0]);
        var weekNum = parseInt(yearWeek[1]);
        var monday = getDateOfISOWeek(weekNum, year);

        // console.log(`Price Week: ${week}, Monday: ${monday}`);

        priceData.push([monday.getTime(), spinossumWeightedPrices[week]]);
    }

    var minDate = Infinity;
    var maxDate = -Infinity;

    Object.keys(dataSets).forEach(area => {
        dataSets[area].forEach(point => {
            minDate = Math.min(minDate, point[0]);
            maxDate = Math.max(maxDate, point[0]);
        });
    });

    var tickPositions = [];
    var currentDate = minDate;
    while (currentDate <= maxDate) {
        tickPositions.push(currentDate);
        currentDate += 7 * 24 * 60 * 60 * 1000;
    }

    var areaColors = {
        "ZAMBO BS": "#2e75b6",
        "PAL BS": "#ff0000",
        "MINDORO BS": "#00b050",
        "CEBU": "#ffff00",
        "INDO": "#002060",
        "OTHERS": "#000000",
    };

    var dataset = Object.keys(dataSets).map(area => ({
        label: area,
        data: dataSets[area],
        color: areaColors[area],
        bars: {
            show: true,
            align: "center",
            barWidth:  2 * 24 * 60 * 60 * 1000, 
            lineWidth: 0,
            fill: true,
            fillColor: areaColors[area],
            // stack: true,
        }
    }));

    // function calculateBarWidth(numBars) {
    //     var minBarWidth = 0.5 * 10 * 30 * 30 * 60;
    //     var availableSpace = maxDate - minDate; 
    //     var barWidth = availableSpace / numBars;

        
    //     if (barWidth < minBarWidth) {
    //         barWidth = minBarWidth;
    //     }

    //     return barWidth;
    // }

    dataset.push({
        label: "Price",
        data: priceData,
        yaxis: 2,
        color: "#8A2BE2",
        lines: {
            show: true,
            lineWidth: 1.5,
            fill: false
        },
        stack: null,
        points: {
        show: true,
        radius: 3,
        fill: true,
        fillColor: "#8A2BE2"
    }
    });
    var options = {
        series: {
            stack: true, 
        },
        xaxis: {
            mode: "time",
            ticks: tickPositions,
            axisLabel: "Date",
            tickSize: [7, "day"],
            tickLength: 0,
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 10,
            color: "#d5d5d5",
            tickFormatter: function(val, axis) {
                var date = new Date(val);
                var startDate = getMonday(date);
                var endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 6);
                return $.plot.formatDate(startDate, "%b %d") + " - " + $.plot.formatDate(endDate, "%d");
            },
            rotateTicks: 45
        },
        yaxes: [{
            position: "left",
            max: 1200,
            color: "#d5d5d5",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 3,
            ticks: [0, 200, 400, 600, 800, 1000, 1200]
        }, {
            position: "right",
            color: "#d5d5d5",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 67
        }],
        legend: {
            noColumns: 9,
            labelBoxBorderColor: "#000000",
            container: $("#spilegend-container"),
            labelFormatter: function(label, series) {
        return '<span style="padding-right: 10px;">' + label + '</span>';
    }
        },
        grid: {
            hoverable: true,
            borderWidth: 0
        }
    };

    var plot = $.plot($("#spinossum-dashboard-chart"), dataset, options);

    
function addSpiDataLabels() {
    var plotOffset = plot.getPlotOffset();


    priceData.forEach(function(point) {
        var x = point[0];
        var y = point[1].toFixed(2); 
        var plotPos = plot.pointOffset({ x: x, y: y });

        
        var label = $('<div class="data-label">' + y + '</div>').css({
            position: 'absolute',
            left: plotPos.left - plotOffset.left ,
            top: plotPos.top - plotOffset.top , 
            color: '#8a2be2',
            // backgroundColor: '#ffffff', 
            // padding: '4px',
            borderRadius: '4px',
            zIndex: '10' 
        });

        $("#spinossum-dashboard-chart").append(label);
    });
}

addSpiDataLabels();
    $("<div id='tooltip'></div>").css({
        position: "absolute",
        display: "none",
        border: "1px solid #fdd",
        padding: "2px",
        "background-color": "#fee",
        opacity: 0.80
    }).appendTo("body");

    $("#spinossum-dashboard-chart").bind("plothover", function(event, pos, item) {
        if (item) {
            var x = item.datapoint[0],
                y = item.datapoint[1];
            var date = new Date(x);
            var formattedDate = $.plot.formatDate(date, "%b %d, %Y");
            $("#tooltip").html(item.series.label + ": " + y + "<br>" + formattedDate)
                .css({
                    top: item.pageY + 5,
                    left: item.pageX + 5
                })
                .fadeIn(200);
        } else {
            $("#tooltip").hide();
        }
    });

    //    Jun Jihad Barroga Combograph
</script>
@endsection