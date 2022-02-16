<div>
    <div class="userinfo">
        <div> 닉네임 : <?=$user[0]['username']?></div>
        <div> 이메일 : <?=$user[0]['email']?></div>
        <div>
            <button type="button" onclick="location.href='/MyPage/reviseUser/'">
            관리하기
            </button>
        </div>
    </div>
    <div class="mt-box">
        <div> 개설모임</div>

            <?php foreach($mts as $mt):?>
                <div class="mt-item">
                    <div class="mt-name">모임이름 : <?=$mt['mtName']?></div>
                    <div class="mt-requestCount">신청인원 : <?=$mt['requestCount']?></div>
                    <div class="manage-mt">
                        <button type="button" onclick="location.href='/Manage/mgOf/<?=$mt['mtName']?>'">
                        관리하기
                        </button>
                    </div>
                </div>
            <?php endforeach;?>
    </div>
    <div class="request-box">
        <div>신청모임</div>
        <?php foreach($requests as $request):?>
            <div class="request-item">
                <div class="mt-group-name">
                    모임이름 : <?=$request['mtName']?>
                </div>
                <div class="mt-group-name">
                    그룹이름 : <?=$request['groupname']?>
                </div>
                <div class="mt-group-name">
                    모임날짜 : <?=$request['startMTTime']?> ~ <?=$request['endMTTime']?>
                </div>
                <div class="mt-reason">
                    신청사유 : <?=$request['reason']?>
                </div>
                <div class="approval-type">
                    승인상태 : <?= $request['Approval'] ? "승인" : "대기" ?>
                </div>
                
                <div class="cancle-mt">
                    <button type="button" onclick="location.href='/MyPage/cancel/<?=$request['_rid']?>/'">
                    취소하기
                    </button>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>