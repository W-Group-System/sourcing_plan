@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cottonii List</h5>
                    <div class="ibox-tools">
                        @if (@auth()->user()->position != 'Plant Manager')
                            <a href="{{ url('cott/create') }}"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a>
                        @endif
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
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Approved List</a></li>
                                    <li><a data-toggle="tab" href="#tab-2">Disapproved List</a></li>
                                    <li><a data-toggle="tab" href="#tab-3
                                        ">For Approval</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div align="right">
                                                @if(isset($start_date))
                                                    <a target='_blank' href="{{ route('export_cott_pdf', ['start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-primary export">Export PDF</a>
                                                    @if (@auth()->user()->position != 'Plant Manager')
                                                        @if(App\DemandSupply::where(function ($query) use ($start_date, $end_date) {
                                                            $query->whereBetween('from', [$start_date, $end_date])
                                                                ->orWhereBetween('to', [$start_date, $end_date]);
                                                                })->where('type', '!=', 2)->exists())
                                                            <button class="btn btn-primary" style="display: none" >Demand and Supply</button>
                                                        @else
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demandSupply">
                                                                <a href="#" style="color: #FFF">Demand and Supply</a>
                                                            </button>
                                                        @endif
                                                    @endif
                                                    @if(count($cotts) > 0)
                                                        <?php
                                                        $cottIds = collect($cotts)->pluck('id')->toArray();
                                                        $encodedIds = implode(',', $cottIds); 
                                                        ?>
                                                        <a href="{{ route('cott.editMultipleApproved', ['ids' => $encodedIds, 'start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-primary export">Edit Multiple</a>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered dataTables-example">
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
                                                            <th>Area</th>
                                                            <th>Action</th>
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
                                                                <td>
                                                                    @if (is_numeric($cott->chips_yield))
                                                                        {{ number_format($cott->chips_yield, 2) }}%
                                                                    @else
                                                                        {{ $cott->chips_yield }}
                                                                    @endif
                                                                </td>
                                                                <td>{{$cott->powder_yield}}%</td>
                                                                <td>{{$cott->price_yield}}</td>
                                                                <td>{{$cott->forex_rate}}</td>
                                                                <td>{{$cott->price_usd}}</td>
                                                                <td>{{$cott->cost_produce}}</td>
                                                                <td>{{$cott->price_ctp}}</td>
                                                                <td>{{$cott->remarks}}</td>
                                                                <td>{{$cott->area}}</td>
                                                                <td align="center">
                                                                    <a href="{{ route('cott.editApproved', ['id' => $cott->id]) }}" class="btn btn-warning btn-outline" title="Edit Cottonii"><i class="fa fa fa-pencil"></i></a>
                                                                    @if (auth()->user()->position == "Asst. Manager")
                                                                        <a href="{{ route('cotts.delete', ['id' => $cott->id]) }}">
                                                                            <button type="button" class="btn btn-danger btn-outline" title="Delete COTT"><i class="fa fa fa-trash"></i></button>
                                                                        </a>
                                                                    @else
                                                                        @if ($cott->delete_requests)
                                                                            
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-outline" data-toggle="modal" data-target="#delete_request{{ $cott->id }}">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                            {{-- <form action="{{ url('cotts/cott_delete_request/' . $cott->id) }}" method="POST" style="display:inline;">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-danger btn-outline" title="Delete COTT">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </form> --}}
                                                                        @endif
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
                                                <table class="table table-bordered dataTables-example mt-3">
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
                                                            <th>Area</th>
                                                            <th>Comments</th>
                                                            <!-- <th>Pre Approved</th> -->
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($cotts->where('approved',2) as $cott)
                                                            <tr>
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
                                                                <td>
                                                                    @if (is_numeric($cott->chips_yield))
                                                                        {{ number_format($cott->chips_yield, 2) }}%
                                                                    @else
                                                                        {{ $cott->chips_yield }}
                                                                    @endif
                                                                </td>
                                                                <td>{{$cott->powder_yield}}%</td>
                                                                <td>{{$cott->price_yield}}</td>
                                                                <td>{{$cott->forex_rate}}</td>
                                                                <td>{{$cott->price_usd}}</td>
                                                                <td>{{$cott->cost_produce}}</td>
                                                                <td>{{$cott->price_ctp}}</td>
                                                                <td>{{$cott->remarks}}</td>
                                                                <td>{{$cott->area}}</td>
                                                                <td>{{$cott->comments}}</td>
                                                                <td align="center">
                                                                    <a href="{{ url('pre_approval_cott/'.$cott->id) }}">
                                                                        <button type="button" class="btn btn-primary btn-outline" title="For Approval Cottonii"><i class="fa fa fa-undo"></i></button>
                                                                    </a>
                                                                </td>
                                                                <!-- <td>{{$cott->pre_approved}}</td> -->
                                                                <!-- <td class="action">
                                                                    <a href="{{ route('cott.edit', ['id' => $cott->id]) }}" class="btn btn-warning btn-outline" title="Edit Cottonii"><i class="fa fa fa-pencil"></i></a>
                                                                    <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#add_comments_cott{{$cott->id}}" title="Add Comments">
                                                                        <i class="fa fa-comments"></i>
                                                                        <a href="{{url('add_comments_cott/'.$cott->id)}}"></a>
                                                                    </button>
                                                                    @if (@auth()->user()->position == 'Plant Manager' && $cott->status == 1) 
                                                                        <a href="preApprover/{{ $cott->id }}" title="Pre-approved" class="btn btn-success btn-outline"><i class="fa fa-thumbs-up"></i></a>
                                                                    @endif
                                                                    @if (@auth()->user()->position != 'Plant Manager')
                                                                        <a href="approvedCott/{{ $cott->id }}" title="Approved" class="btn btn-success btn-outline" style="{{ $cott->status == 1 ? 'display: none;' : '' }}">
                                                                            <i class="fa fa-thumbs-up"></i>
                                                                        </a>
                                                                        <a href="disapprovedCott/{{ $cott->id }}" title="Disapproved" class="btn btn-danger btn-outline" style="{{ $cott->status == 0 ? 'display: none;' : '' }}">
                                                                            <i class="fa fa-thumbs-down"></i>
                                                                        </a>
                                                                    @endif
                                                                </td> -->
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            <div align="right">
                                                @if(isset($start_date))
                                                    <a target='_blank' href="{{ route('for_approval_pdf', ['start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-primary export">Export PDF</a>
                                                    @if (@auth()->user()->position != 'Plant Manager')
                                                        @if(App\DemandSupply::where(function ($query) use ($start_date, $end_date) {
                                                            $query->whereBetween('from', [$start_date, $end_date])
                                                                ->orWhereBetween('to', [$start_date, $end_date]);
                                                                })->where('type', '!=', 2)->exists())
                                                            <button class="btn btn-primary" style="display: none" >Demand and Supply</button>
                                                        @else
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demandSupply">
                                                                <a href="#" style="color: #FFF">Demand and Supply</a>
                                                            </button>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            <form method="POST" action="{{url('updateStatusCott')}}">
                                            @csrf
                                                <div class="table-responsive">
                                                    <table class="table table-bordered dataTables-example">
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
                                                                <th>Area</th>
                                                                <th>Comments</th>
                                                                <th>Pre Approved</th>
                                                                <th>Date Created</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($cotts->where('approved',0) as $cott)
                                                                <tr>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}"><input type="checkbox" class="form-check-input check-item" name="checkbox[]" value="{{ $cott->id }}"></td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->name}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->destination}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->food_grade}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->origin}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->offer_quantity}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->buying_quantity}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->uom}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->original_price ? $cott->original_price : 'Non-nego'}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->buying_price}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->expenses ? $cott->expenses : '-'}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->price_expense}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->moisture_content}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->delivery_schedule}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->terms_payment}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->potassium}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">
                                                                        @if (is_numeric($cott->chips_yield))
                                                                            {{ number_format($cott->chips_yield, 2) }}%
                                                                        @else
                                                                            {{ $cott->chips_yield }}
                                                                        @endif
                                                                    </td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->powder_yield}}%</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->price_yield}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->forex_rate}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->price_usd}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->cost_produce}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->price_ctp}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->remarks}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->area}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->comments}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{$cott->pre_approved}}</td>
                                                                    <td class="{{ $cott->status == 1 ? 'pre-approved' : ($cott->status == 0 ? 'pre-disapproved' : '') }}">{{date_format($cott->created_at, 'Y-m-d')}}</td>
                                                                    <td class="action">
                                                                        <a href="{{ route('cott.edit', ['id' => $cott->id]) }}" class="btn btn-warning btn-outline" title="Edit Cottonii"><i class="fa fa fa-pencil"></i></a>
                                                                        <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#add_comments_cott{{$cott->id}}" title="Add Comments">
                                                                            <i class="fa fa-comments"></i>
                                                                            <a href="{{url('add_comments_cott/'.$cott->id)}}"></a>
                                                                        </button>
                                                                        @if (@auth()->user()->position == 'Plant Manager' && $cott->status == 1) 
                                                                            <a href="preApprover/{{ $cott->id }}" title="Pre-approved" class="btn btn-success btn-outline"><i class="fa fa-thumbs-up"></i></a>
                                                                        @endif
                                                                        @if (@auth()->user()->position != 'Plant Manager')
                                                                            <a href="approvedCott/{{ $cott->id }}" title="Approved" class="btn btn-success btn-outline" style="{{ $cott->status == 1 ? 'display: none;' : '' }}">
                                                                                <i class="fa fa-thumbs-up"></i>
                                                                            </a>
                                                                            <!-- <a href="disapprovedCott/{{ $cott->id }}" title="Disapproved" class="btn btn-danger btn-outline" style="{{ $cott->status == 0 ? 'display: none;' : '' }}">
                                                                                <i class="fa fa-thumbs-down"></i>
                                                                            </a> -->
                                                                            <a href="javascript:void(0)" title="Disapproved" class="btn btn-danger btn-outline" style="{{ $cott->status == 0 ? 'display: none;' : '' }}" data-toggle="modal" data-target="#disapproveModal-{{ $cott->id }}">
                                                                                <i class="fa fa-thumbs-down"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div align="right" class="mt-10">
                                                        @if (@auth()->user()->position != 'Plant Manager')
                                                        <button type="submit" class="btn btn-info btn-submit" name="action" value="approved" disabled>Submit</button>
                                                        @endif
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

@foreach($cotts as $cott)
<div class="modal fade" id="disapproveModal-{{ $cott->id }}" tabindex="-1" role="dialog" aria-labelledby="disapproveModalLabel-{{ $cott->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="disapproveModalLabel-{{ $cott->id }}">Disapprove Cott</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('disapproved_comments_cott', ['id' => $cott->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Reason for Disapproval:</label>
                            <input name="comments" class="form-control" type="text" placeholder="Reason for Disapproval" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Disapprove</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Comments -->
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
    <form action="{{ url('add_demand') }}" method="POST">
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
                        <div class="col-12 mb-10">
                            <label>PBI</label>
                            <input name="pbi" class="form-control" type="text" placeholder="Enter PBI">
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

@foreach ( $cotts->where('approved',1) as $cott )
    <div class="modal fade" id="delete_request{{ $cott->id }}" tabindex="-1" aria-hidden="true">
        <form action="{{ url('cotts/cott_delete_request/' . $cott->id) }}" method="POST">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="demandSupply">Request Deletion</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-10">
                                <label>Reason</label>
                                <input name="reason" class="form-control" type="text" placeholder="Enter Reason">
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

    $(document).on('input', '.check-comments', function () {
        if ($('.check-comments').filter(':enabled').length > 0) {
            $('.btn-comment-submit').removeAttr('disabled');
        } else {
            $('.btn-comment-submit').attr('disabled', true);
        }
    });
</script>
@endsection