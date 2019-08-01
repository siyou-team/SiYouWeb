<?php
include __DIR__ . '/../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1"/>
    <title><?=__('设置')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_member.css">
</head>
<body>
<header id="header">
    <div class="header-wrap">
        <div class="header-l"><a href="./seller/seller.html"> <i class="zc zc-back back"></i> </a></div>
        <div class="header-title">
            <h1><?=__('设置')?></h1>
        </div>
    </div>
    <div class="header-r">
    </div>
</header>
<div class="sstouch-main-layout">

    <ul class="sstouch-default-list mt5">
        <li><a href="member/member_feedback.html">
            <h4><?=__('用户反馈')?></h4>
            <h6><?=__('您在使用中遇到的问题与建议可向我们反馈')?></h6>
            <span class="zc zc-arrow-r arrow-r"></span></a></li>
    </ul>
    <ul class="sstouch-default-list mt5">
        <li><a href="language.html">
            <h4><?=__('语言切换')?></h4>
            <h6><?=__('系统支持多语言功能')?></h6>
            <span class="zc zc-arrow-r arrow-r"></span></a></li>
    </ul>
    <ul class="sstouch-default-list mt5 J_logoutBtn">
        <li><a id="logoutbtn" href="javascript:void(0);">
            <h4><?=__('注销')?></h4>
            <h6></h6>
            <span class="zc zc-arrow-r arrow-r"></span></a></li>
    </ul>
</div>
<footer id="footer"></footer>
<script> var navigate_id = "5";</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<!-- <script type="text/javascript" src="../../js/tmpl/member_account.js"></script> -->
<script type="text/javascript" src="../js/tmpl/seller/seller_footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>
