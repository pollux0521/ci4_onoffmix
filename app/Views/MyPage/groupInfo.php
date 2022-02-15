<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="/public/js/groupInfo.js"></script>
<?php if(isset($validation)):?>
  <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif;?>
<div class="revise-group-info">
  <form action="/Manage/reviseGroup/<?=$group['_gid']?>" method="post">
      <div class="group" name="">
            <div class="groupname">
                그룹이름 : <?=$group['groupname']?><br>
                변경할 그룹이름<input type="text" class="groupname" name="groupname" maxlength="64"/><br>
            </div>
            <div class="mt-time">
                모임날짜 : <?=$group['startMTTime']?> ~ <?=$group['endMTTime']?><br> 
                변경할 모임기간<input type="text" class="datetimes" name="meeting_time" value="Date"/><br>
            </div>
            <div class="access-time">
                신청날짜 : <?=$group['startAccessTime']?> ~ <?=$group['endAccessTime']?><br>
                변경할 신청날짜<input type="text" class="datetimes" name="sign_time" value="Date"/><br>
            </div>
            <div class="approvalType">
                승인방식: <?= $group["approvalType"] ? "선착순" : "개발자승인"?><br>
                변경할 신청방법
                <div class="approvalType">
                    선착순<input type="radio" id="approvalType" name="approvalType" value="1">
                    개발자승인<input type="radio" id="approvalType" name="approvalType" value="0">
                </div>
            </div>
            <div class="limitHead">
                정원 : <?=$group['limitHead']?> <br>
                변경할 정원<input type="number" name="limitHead"><br>
            </div>
        </div>
    <button type="submit" class="openMT">모임개설</button>
  </form>
</div>