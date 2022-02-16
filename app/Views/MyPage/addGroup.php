<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="/public/js/openMeeting.js"></script>
<?php if(isset($validation)):?>
  <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif;?>
<div class="openMeeting">
  <div class="mt-info">
    <div class="mt-name">모임이름 : <?=$mt['mtName']?></div>
  </div>
  <form action="/Manage/addGroupInfo/<?=$mt['_mid']?>" method="post">
      <div class="group" name=>
        그룹이름<input type="text" class="groupname" name="groupname" maxlength="64"/><br>
        신청기간<input type="text" class="datetimes" name="sign_time" value="Date"/><br>
        모임기간<input type="text" class="datetimes" name="meeting_time" value="Date"/><br>
        정원<input type="number" name="limitHead"><br>
        신청방법<div class="approvalType">
          선착순<input type="radio" id="approvalType" name="approvalType" value="1">
          개발자승인<input type="radio" id="approvalType" name="approvalType" value="0">
      </div>
    </div>
    <button type="submit">그룹추가</button>
  </form>
</div>