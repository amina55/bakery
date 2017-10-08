

$(document).ready(function() {
   /* $('.data-tables').DataTable({
        'aoColumnDefs': [{
        }]
    });*/

    $('.date-format').datepicker({
        maxDate: new Date()
    })

    $('.date-format-min').datepicker({
        minDate: new Date()
    });
});
