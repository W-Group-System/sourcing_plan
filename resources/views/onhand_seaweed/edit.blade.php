<div class="modal fade" id="edit_onhan_seaweed{{ $onhand->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('update_onhand_seaweed', $onhand->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Plant</label>
                            <select name="plant" id="plant" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Select Plant" required>
                                @foreach($plants as $plant)
                                    <option value="{{ $plant->id }}" @if($plant->id == $onhand->plant_id) selected @endif>
                                        {{ $plant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Quantity</label>
                            <input type="number" step="0.01" min="0" name="quantity" value="{{ $onhand->quantity }}" class="form-control quantity" type="text" placeholder="Enter Quantity" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Plant Consumption</label>
                            <input type="number" step="0.01" min="0" name="plant_consumption" value="{{ $onhand->plant_consumption }}" class="form-control plant-consumption" type="text" placeholder="Enter Plant Consumption" >
                        </div>
                        <div class="col-md-6">
                            <label># of Days</label>
                            <input name="no_of_days" value="{{ $onhand->no_of_days }}" class="form-control no-of-days" type="text" placeholder="No of Days" required required>
                        </div>
                        <div class="col-md-6">
                            <label>Date Updated</label>
                            <input type="date" name="date_updated" value="{{ $onhand->date_updated }}" id="date_updated" class="form-control date-updated">
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
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script>
     $('.modal').on('input', '.quantity, .plant-consumption', function () {
        var modal = $(this).closest('.modal');

        var quantity = parseFloat(modal.find('.quantity').val()) || 0;
        var consumption = parseFloat(modal.find('.plant-consumption').val()) || 0;

        if (consumption > 0) {
            var days = quantity / consumption;

            modal.find('.no-of-days').val(Math.round(days));
        } else {
            modal.find('.no-of-days').val('');
        }
    });
</script>
