$(document).ready(()=>{
    $('input[class="datetimes"]').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
          format: 'YYYY/MM/DD hh:mm A'
        }
    });
})