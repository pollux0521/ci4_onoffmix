        <div class="main">
            <div class="sign-up">
                <?php if(isset($validation)):?>
                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <form action="/sign/signUp/insert" method="post" style="display:flex; flex-direction:column;">
                    <input type="text" id="email" name="email" placeholder="이메일 아이디를 입력해주세요(ID@xxxx.com)">
                    <input type="text" id="username" name="username" placeholder="사용자 이름을 입력해주세요">
                    <input type="password" id="pw" name="pw" placeholder="비밀번호를 입력해주세요">
                    <input type="password" id="confpw" name="confpw" placeholder="비밀번호 한번더 입력해주세요">
                    <button type="submit">회원가입</button>
                </form>
            </div>
        </div>