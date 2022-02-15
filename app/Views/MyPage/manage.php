<div class="manage-mt">
    <div class="mt-box">
        <div class="mt-item">
            <div class="mtName">모임이름 : <?=$mt['mtName']?></div>
            <div class="registTime">등록일 : <?=$mt['registTime']?></div>
            <div class="viewCount">조회수 : <?=$mt['viewCount']?></div>
            <div class="requestCount">총 신청수 : <?=$mt['requestCount']?></div>
            <button type="button" onclick="location.href='/MyPage/revise/<?=$mt['mtName']?>/'">
            수정하기
            </button>
        </div>
    </div>

    <div class="group-box">
        <?php foreach($groups as $group):?>
        <div class="group-item">
            <div class="groupname">그룹이름 : <?=$group['groupname']?> </div>
            <div class="mt-time">모임날짜 : <?=$group['startMTTime']?> ~ <?=$group['endMTTime']?> </div>
            <div class="access-time">신청날짜 : <?=$group['startAccessTime']?> ~ <?=$group['endAccessTime']?></div>
            <div class="approvalType">승인방식: <?= $group["approvalType"] ? "선착순" : "개발자승인"?></div>
            <div class="limitHead">정원 : <?=$group['limitHead']?> </div>
            <div class="accessHead">승인한인원 : <?=$group['accessHead']?> </div>
            <button type="button" onclick="location.href='/manage/group/<?=$group['_gid']?>'">
            관리하기
            </button>
        </div>
        <?php endforeach;?>
    </div>
</div>