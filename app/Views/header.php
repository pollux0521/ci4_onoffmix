<!DOCTYPE html>
<html>
    <head>
        <title><?= $meta_title?></title>
        <link rel="stylesheet" type="text/css" href="/public/css/default.css">
    </head>
    <body>
        <div class="header1">
            <?php if(isset($is_login)):?>
            <div class="header1-item"><a href="/mypage"><?= $username ?> 님</a></div>
            <div class="header1-item"><a href="/Home/SignOut">로그아웃</a></div>
            <?php else:?>
            <div class="header1-item"><a href="/sign/signIn">로그인</a></div>
            <div class="header1-item"><a href="/sign/signUp">회원가입</a></div>
            <?php endif;?>
            <div class="header1-item"><a href="#">서비스안내</a></div>
            <div class="header1-item"><a href="#">고객센터</a></div>
        </div>
        <?php if($meta_title != "sign"):?>
        <div class="header2">
            <div class="first">
                <div class="main-logo">
                    <a href="/"><img src="/public/assets/img/ofm_logo.png"></a>
                </div>
                <div>검색엔진</div>
                <div> 메인페이지</div>
                <div><a href="/mypage">마이페이지</a></div>
                <div><a href="/OpenMeeting">모임개설</a></div>
                <div>알림</div>
            </div>

            <div class="second">
                <div>카테고리</div>
                <div> 기획전</div>
                <div>파트너센터</div>
                <div> 실시간</div>
            </div>
        </div>
        <?php endif;?>