```blade
<div class="modal fade" id="newOnhand" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">New On-Hand Seaweed</h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ url('onhand_seaweed_store') }}">
                @csrf

                <div class="modal-body">

                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-4">
                            <label>Date Updated</label>

                            <input type="date"
                                   name="date_updated"
                                   id="date_updated"
                                   class="form-control"
                                   required>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped"
                               style="margin-bottom: 0;">

                            <thead>
                                <tr>
                                    <th style="width: 25%;">Plant</th>
                                    <th style="width: 20%;">Quantity</th>
                                    <th style="width: 20%;">Plant Consumption</th>
                                    <th style="width: 15%;"># of Days</th>
                                    <th style="width: 20%;">Until Date</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($plants as $plant)

                                    <tr class="plant-row"
                                        id="plant-row-{{ $plant->id }}"
                                        data-plant-name="{{ $plant->name }}">

                                        <td style="vertical-align: middle;">

                                            <strong>
                                                {{ $plant->name }}
                                            </strong>

                                            <input type="hidden"
                                                   name="plants[{{ $plant->id }}][plant_id]"
                                                   value="{{ $plant->id }}">

                                        </td>

                                        <td>
                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   name="plants[{{ $plant->id }}][quantity]"
                                                   class="form-control quantity"
                                                   placeholder="Quantity"
                                                   required>
                                        </td>

                                        <td>
                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   name="plants[{{ $plant->id }}][plant_consumption]"
                                                   class="form-control plant-consumption"
                                                   placeholder="Consumption"
                                                   required>
                                        </td>

                                        <td>
                                            <input type="number"
                                                   step="1"
                                                   min="0"
                                                   name="plants[{{ $plant->id }}][no_of_days]"
                                                   class="form-control new-no-of-days"
                                                   placeholder="Days"
                                                   readonly>
                                        </td>

                                        <td>
                                            <input type="date"
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
                        Save
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script>
$(document).on(
    'input',
    '#newOnhand .quantity, #newOnhand .plant-consumption',
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

        calculateNewUntilDates();
    }
);


$(document).on('change', '#date_updated', function () {
    calculateNewUntilDates();
});


function calculateNewUntilDates()
{
    var dateUpdated = $('#date_updated').val();

    if (!dateUpdated) {
        return;
    }

    function addDays(dateString, days)
    {
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


    function getPlantDays(plantName)
    {
        var result = null;

        $('#newOnhand .plant-row').each(function () {

            var row = $(this);

            var name = row.data('plant-name');

            if (name === plantName) {

                var days = parseInt(
                    row.find('.new-no-of-days').val()
                );

                if (!isNaN(days)) {
                    result = days;
                }
            }

        });

        return result;
    }


    $('#newOnhand .plant-row').each(function () {

        var row = $(this);

        var plantName = row.data('plant-name');

        var days = parseInt(
            row.find('.new-no-of-days').val()
        );

        if (!plantName || isNaN(days)) {

            row.find('.until-date').val('');

            return;
        }


        // CAR - SPI
        if (plantName === 'CAR - SPI') {

            var cottDays = getPlantDays('CAR - COTT');

            if (cottDays !== null) {

                var cottDate = addDays(
                    dateUpdated,
                    cottDays
                );

                var untilDate = addDays(
                    cottDate,
                    days
                );

                row.find('.until-date').val(untilDate);

            } else {

                row.find('.until-date').val('');
            }
        }


        // CCC - SPI
        else if (plantName === 'CCC - SPI') {

            var cottDays = getPlantDays('CCC - COTT');

            if (cottDays !== null) {

                var cottDate = addDays(
                    dateUpdated,
                    cottDays - 1
                );

                var untilDate = addDays(
                    cottDate,
                    days
                );

                row.find('.until-date').val(untilDate);

            } else {

                row.find('.until-date').val('');
            }
        }


        // COTT / other plants
        else {

            var untilDate = addDays(
                dateUpdated,
                days - 1
            );

            row.find('.until-date').val(untilDate);
        }

    });
}
</script>