$(document).ready(()=>{
    let groupCount = 1;

    $(".add-Group").on("click", ()=>{
        const GroupList = $(".group");
        groupCount++;
        let group =`<div>그룹이름<input type="text" class="groupname" name="groupname[]" maxlength="64"/><br>
                    신청기간<input type="text" class="datetimes" name="sign_time[]" value="Date"/><br>
                    모임기간<input type="text" class="datetimes" name="meeting_time[]" value="Date"/><br>
                    정원<input type="number" name="limitHead[]"><br>
                    신청방법<div class="approvalType">
                    선착순<input type="radio" id="approvalType`+groupCount+`" name="approvalType`+groupCount+`" value="1">
                    개발자승인<input type="radio" id="approvalType`+groupCount+`" name="approvalType`+groupCount+`"value="0"><div>`;
                    
        GroupList.append(group);
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
})