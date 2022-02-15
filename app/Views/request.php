<div class="request-mt">
    <div class="mt">
    </div>
    <div class="mt-group">
        
    </div>
    <div class="insert-info">
        <form action="/MTPage/attend/<?=$mt['mtName']?>/<?=$mtGroup['groupname']?>" method="post">
            <h3>신청사유 (최대 200자)</h3>
            <p><textarea cols="50" rows="10" id="reason"name="reason"></textarea></p>
            <p><button id="req-class-button" type="submit" >신청하기</button></p>
        </form>
    </div>
</div>