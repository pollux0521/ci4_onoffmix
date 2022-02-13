<!DOCTYPE html>
<html>
    <head>
        <title><?= $meta_title?></title>
    </head>
    <body>
        <div class="header1">
            <?php if($is_login):?>
            <div class="header1-item"><?= $username ?> 님</div>
            <div class="header1-item"><a href="/Home/SignOut">로그아웃</a></div>
            <?php else:?>
            <div class="header1-item"><a href="/SignIn">로그인</a></div>
            <div class="header1-item"><a href="/SignIn">회원가입</a></div>
            <?php endif;?>
            <div class="header1-item"><a href="#">서비스안내</a></div>
            <div class="header1-item"><a href="#">고객센터</a></div>
        </div>