<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1">
    <title><?=__('修改密码')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" style="display: block;">
    <div class="header-wrap">
        <div class="header-l"> <a href="member_account.html"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('选择修改密码方式')?></h1>
        </div>
        <div class="header-r">  </div>
    </div>
</header>
<div class="sstouch-main-layout mb20">
    <div class="sstouch-address-list" id="address_list">
        <div style="
    position: absolute;
    z-index: -1;
    top: 30%;
    width: 100%;
    height: 8.2rem;
    text-align: center;
    font-size: 0;">
            <a href="member_password_step0.html" class="btn-l" style="margin: 10px;width: 40%;font-size: 0.7rem;background-color:#ff6655;"><?=__('通过原密码修改')?></a>
            <a href="member_password_step1.html" class="btn-l" style="margin: 10px;width: 40%;font-size: 0.7rem;"><?=__('通过手机验证修改')?></a>
        </div>

    </div>
</div>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
