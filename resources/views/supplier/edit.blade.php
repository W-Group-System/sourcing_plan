<div class="modal fade" id="edit_supplier{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('update_supplier/'.$supplier->id)}}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Edit Supplier</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" class="form-control" type="text" value="{{$supplier->name}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Nickname</label>
                            <input name="nickname" class="form-control" type="text" value="{{$supplier->nickname}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Supplier Code</label>
                            <input name="code" class="form-control" type="text" value="{{$supplier->code}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Contact Person</label>
                            <input name="contact_person" class="form-control" type="text" value="{{$supplier->contact_person}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Address</label>
                            <input name="address" class="form-control" type="text" value="{{$supplier->address}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Tel No.</label>
                            <input name="tel_no" class="form-control" type="number" value={{$supplier->tel_no}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Fax No.</label>
                            <input name="fax_no" class="form-control" type="number" value="{{$supplier->fax_no}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Mobile No.</label>
                            <input name="mobile_no" class="form-control" type="number" value="0{{$supplier->mobile_no}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Email</label>
                            <input name="email" class="form-control" type="email" value="{{$supplier->email}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Terms</label>
                            <input name="terms" class="form-control" type="text" value="{{$supplier->terms}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Accreditation Date</label>
                            <input name="accreditation_date" class="form-control" type="date" value="{{date('Y-m-d', strtotime($supplier->accreditation_date))}}">
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