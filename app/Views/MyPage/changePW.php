<div>
    <form action="/MyPage/changePWRequest" method="post">
        <div class="current-password">
            현재 비밀번호     | <input type="password" name="currentPW"></input>
        </div>
        <div class="password-to-change">
            새 비밀번호       | <input type="password" name="newPW"></input>
        </div>
        <div class="re-enter">
            새 비밀번호 재입력 | <input type="password" name="confpw"></input>
        </div>
        <button type="submit">제출하기</button>
    </form>
</div>