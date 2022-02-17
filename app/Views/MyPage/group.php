
<div class="group-item">
    <div class="mtName">모임이름 : <?=$group['mtName']?></div>
    <div class="groupname">그룹이름 : <?=$group['groupname']?> </div>
    <div class="mt-time">모임날짜 : <?=$group['startMTTime']?> ~ <?=$group['endMTTime']?> </div>
    <div class="access-time">신청날짜 : <?=$group['startAccessTime']?> ~ <?=$group['endAccessTime']?></div>
    <div class="approvalType">승인방식: <?= $group["approvalType"] ? "선착순" : "개발자승인"?></div>
    <div class="limitHead">정원 : <?=$group['limitHead']?> </div>
    <div class="accessHead">승인한인원 : <?=$group['accessHead']?> </div>
    <button type="button" onclick="location.href='/manage/group/groupinfo/<?=$group['_gid']?>'">
    변경하기
    </button>
</div>

<div class="request-box">
    <div>신청인원</div>
    <div class="request-list">
    <?php foreach($requests as $request):?>
    <div class="request-item">
        <div>신청자 : <?= $request['username']?></div>
        <div>신청사유 : <?= $request['reason']?></div>
        <div>승인상태 : <?= $request["Approval"] ? "승인됨" : "대기중"?></div>
        <button type="button" onclick="location.href='/manage/group/approval/<?=$group['mtName']?>/<?=$request['_rid']?>'">
        변경하기
        </button>
    </div>
    <?php endforeach;?>
    </div>
</div>