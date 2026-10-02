<div class="modal fade" id="editOnhand" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit On-Hand Seaweed</h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ url('onhand_seaweed_update') }}">
                @csrf

                <div class="modal-body">

                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-4">
                            <label>Date Updated</label>

                            <input type="date"
                                   name="date_updated"
                                   id="edit_date_updated"
                                   class="form-control"
                                   required>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped"
                               style="margin-bottom: 0;">

                            <thead>
                                <tr>
                                    <th style="width: 20%;">Plant</th>
                                    <th style="width: 20%;">Quantity</th>
                                    <th style="width: 20%;">Plant Consumption</th>
                                    <th style="width: 15%;"># of Days</th>
                                    <th style="width: 25%;">Until Date</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($plants as $plant)

                                    <tr class="plant-row"
                                        id="edit-plant-row-{{ $plant->id }}">

                                        <td style="vertical-align: middle;">

                                            <strong>
                                                {{ $plant->name }}
                                            </strong>

                                            <input type="hidden"
                                                   name="plants[{{ $plant->id }}][plant_id]"
                                                   value="{{ $plant->id }}">

                                            <input type="hidden"
                                                   name="plants[{{ $plant->id }}][id]"
                                                   id="edit-id-{{ $plant->id }}">

                                        </td>

                                        <td>

                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   name="plants[{{ $plant->id }}][quantity]"
                                                   id="edit-quantity-{{ $plant->id }}"
                                                   class="form-control quantity"
                                                   placeholder="Quantity"
                                                   required>

                                        </td>

                                        <td>

                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   name="plants[{{ $plant->id }}][plant_consumption]"
                                                   id="edit-consumption-{{ $plant->id }}"
                                                   class="form-control plant-consumption"
                                                   placeholder="Consumption"
                                                   required>

                                        </td>

                                        <td>

                                            <input type="number"
                                                   step="0.01"
                                                   name="plants[{{ $plant->id }}][no_of_days]"
                                                   id="edit-days-{{ $plant->id }}"
                                                   class="form-control new-no-of-days"
                                                   placeholder="Days"
                                                   readonly>

                                        </td>

                                        <td>

                                            <input type="date"
                                                   id="edit-until-date-{{ $plant->id }}"
                                                   class="form-control until-date"
                                                   readonly>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        Save changes
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>