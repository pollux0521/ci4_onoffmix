<!-- 모임 내용 제작해야함-->
<div class="manage-mt">
    <form action="/manage/mt/revise/<?=$mt['mtName']?>" method="post">
        <div class="mt-box">
            <div class="mt-item">
                <div class="mtName">
                    모임이름 : <?=$mt['mtName']?><input type="text" name="mtName"></input>
                </div>

                <button type="submit">제출하기</button>
            </div>
        </div>
    </form>
</div>