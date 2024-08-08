@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit PO Spinosum</h5>
                    <div class="ibox-tools">
                        <a href="{{ url('/spi_po') }}"><button class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;Back</button></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{url('update_spi_po/'.$spi_po->id)}}">
                    @csrf
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableEstimate">
                                <thead>
                                    <tr>
                                        <th>Suppliers Name</th>
                                        <th>Lot Code</th>
                                        <th>Quantity</th>
                                        <th>Buying Price</th>
                                        <th>Expenses</th>
                                        <th>Price + Expenses</th>
                                        <th>Original PO Date</th>
                                        <th>PO Date</th>
                                        <th>Destination</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="supplier_name" id="supplier_name" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Supplier" required>
                                                @foreach($suppliers->where('status', 1) as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ ($spi_po->supplier_name == $supplier->id) ? 'selected' : '' }}>
                                                        {{ $supplier->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="lot_code" class="form-control adjust" value="{{$spi_po->lot_code}}"></td>
                                        <td><input type="text" name="quantity" class="form-control adjust" value="{{$spi_po->quantity}}"></td>
                                        <td><input type="text" name="buying_price" class="form-control adjust" value="{{$spi_po->buying_price}}"></td>
                                        <td><input type="text" name="expenses" class="form-control adjust" value="{{$spi_po->expenses}}"></td>
                                        <td><input type="text" name="price_expenses" class="form-control adjust" value="{{$spi_po->price_expenses}}"></td>
                                        <td><input type="date" name="original_po_date" class="form-control adjust_date" value="{{$spi_po->original_po_date}}"></td>
                                        <td><input type="date" name="po_date" class="form-control adjust_date" value="{{$spi_po->po_date}}"></td>
                                        <td>
                                            <select class="form-control adjust selectpicker" data-live-search="true" data-live-search-placeholder="Search" name="area[]" id="area" title="Select Area" required>
                                                <option value="" disabled selected>Select Area</option>
                                                <option value="ZAMBO BS"{{ $spi_po->area == "ZAMBO BS" ? 'selected' : '' }}>ZAMBO BS</option>
                                                <option value="PAL BS"{{ $spi_po->area == "PAL BS" ? 'selected' : '' }}>PAL BS</option>
                                                <option value="MINDORO BS"{{ $spi_po->area == "MINDORO BS" ? 'selected' : '' }}>MINDORO BS</option>
                                                <option value="CEBU"{{ $spi_po->area == "CEBU" ? 'selected' : '' }}>CEBU</option>
                                                <option value="OTHERS"{{ $spi_po->area == "OTHERS" ? 'selected' : '' }}>OTHERS</option>
                                                <option value="INDO"{{ $spi_po->area == "INDO" ? 'selected' : '' }}>INDO</option>
                                                <option value="" {{ $spi_po->area == "None" ? 'selected' : '' }}>None</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="remarks" class="form-control adjust_date" value="{{$spi_po->remarks}}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div align="right" class="mt-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .adjust_date {
        width: 150px;
    }
    .mt-10 {
        margin-top: 10px;
    }
</style>
@endsection