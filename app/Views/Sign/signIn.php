        <div class="main">
            <div class="sign-in">
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>
                <form action="/SignIn/signin" method="post" style="display:flex; flex-direction:column;">
                    <input type="text" id="email" name="email" placeholder="이메일 아이디를 입력해주세요(ID@xxxx.com)">
                    <input type="password" id="pw" name="pw" placeholder="비밀번호를 입력해주세요">
                    <button type="submit">로그인</button>
                </form>
                <button type="button" onclick="location.href='/SignUp'">회원가입</button>
            </div>
        </div>