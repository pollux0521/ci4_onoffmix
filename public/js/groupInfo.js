$(document).ready(()=>{
    $('input[class="datetimes"]').daterangepicker({
        autoUpdateInput: false,
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
          format: 'YYYY/MM/DD hh:mm A'
        },
    });
    $('input[class="datetimes"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY/MM/DD hh:mm A') + ' - ' + picker.endDate.format('YYYY/MM/DD hh:mm A'));
    });
    $('input[class="datetimes"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
});