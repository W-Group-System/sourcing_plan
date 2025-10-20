<div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('userUpdate', $user->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" value="{{ $user->name }}" class="form-control" type="text" placeholder="Enter Name" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Position</label>
                            <select name="position" id="position" class="form-control selectpicker" title="Select Position" required>
                                <option value="Seaweeds Purchaser" @if($user->position === 'Seaweeds Purchaser')selected @endif>Seaweeds Purchaser</option>
                                <option value="Seaweeds Purchaser" @if($user->position === 'Administrator')selected @endif>Administrator</option>
                                <option value="Supervisor" @if($user->position === 'Supervisor')selected @endif>Supervisor</option>
                                <option value="Asst. Manager" @if($user->position === 'Asst. Manager')selected @endif>Asst. Manager</option>
                                <option value="Manager" @if($user->position === 'Manager')selected @endif>Manager</option>
                                <option value="Plant Manager" @if($user->position === 'Plant Manager')selected @endif>Plant Manager</option>
                                <option value="Plant Analyst" @if($user->position === 'Plant Analyst')selected @endif>Plant Analyst</option>
                                <option value="QC Senior Supervisor" @if($user->position === 'QC Senior Supervisor')selected @endif>QC Senior Supervisor</option>
                                <option value="President" @if($user->position === 'President')selected @endif>President</option>
                            </select>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Email Address</label>
                            <input name="email" value="{{ $user->email }}" class="form-control" type="text" placeholder="Enter Email Address" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Company</label>
                            <select name="company" id="company" class="form-control selectpicker" title="Select Company" required>
                                <option value="ALL" @if($user->company === 'ALL')selected @endif>ALL</option>
                                <option value="WHI" @if($user->company === 'WHI')selected @endif>WHI</option>
                                <option value="CCC" @if($user->company === 'CCC')selected @endif>CCC</option>
                            </select>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
