<div class="reviseUser">
    
    <div class="changePW">    
        <button type="button" onclick="location.href='/MyPage/changePW/'">
        비밀번호 변경하러 가기
        </button>        
    </div>
    <form action="/MyPage/reviseRequest" method="post"> 
        <div class="username">
            현재이름 : <?= $user['username']?><br>
            변경이름 : <input type="text" name="username"></input>
        </div>
        <div class="email">
            현재 email : <?= $user['email']?><br>
            변경 email : <input type="text" name="email"></input>
        </div>
        <button type="submit">제출하기</button>
    </form>

</div>