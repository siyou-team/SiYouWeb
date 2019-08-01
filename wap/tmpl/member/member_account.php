<?php
include __DIR__ . '/../../includes/header.php';
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
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
    <div class="header-wrap">
        <div class="header-l"><a href="member.html"> <i class="zc zc-back back"></i> </a></div>
        <div class="header-title">
            <h1><?=__('设置')?></h1>
        </div>
    </div>
    <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"><span class="arrow"></span>
            <ul>
                <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
                <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
                <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
                <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
                <li><a href="../cart_list.html"><i class="zc zc-cart cart"></i><?=__('购物车')?><sup></sup></a></li>
                <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
            </ul>
        </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <ul class="sstouch-default-list">

        <li><a href="member_info.html">
            <h4><?=__('基本信息')?></h4>
            <h6><?=__('账户基本信息管理')?></h6>
            <span class="zc zc-arrow-r arrow-r"></span></a></li>
        <!-- <li><a href="member_mobile_bind.html" id="mobile_link">
            <h4><?=__('手机验证')?></h4>
            <h6><?=__('若您的手机已丢失或停用，请立即修改更换')?></h6>
            <span class="tip" id="mobile_value"></span> <span class="zc zc-arrow-r arrow-r"></span></a></li>
        <li><a href="member_password.html">
            <h4><?=__('登录密码')?></h4>
            <h6><?=__('建议您定期更改密码以保护账户安全')?></h6>
            <span class="zc zc-arrow-r arrow-r"></span></a></li>
        <li><a href="member_paypwd.html" id="paypwd_url">
            <h4><?=__('支付密码')?></h4>
            <h6><?=__('建议您设置复杂的支付密码保护账户金额安全')?></h6>
            <span class="tip" id="paypwd_tips"></span> <span class="zc zc-arrow-r arrow-r"></span> </a></li>

        <li><a href="member_certification.html">
            <h4><?=__('实名认证')?></h4>
            <h6><?=__('账户实名认证信息管理')?></h6>
            <span class="zc zc-arrow-r arrow-r"></span></a></li> -->
    </ul>
    <ul class="sstouch-default-list mt5">
        <li><a href="member_feedback.html">
            <h4><?=__('用户反馈')?></h4>
            <h6><?=__('您在使用中遇到的问题与建议可向我们反馈')?></h6>
            <span class="zc zc-arrow-r arrow-r"></span></a></li>
    </ul>
    <ul class="sstouch-default-list mt5">
        <li><a href="member_language.html">
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
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<!-- <script type="text/javascript" src="../../js/tmpl/member_account.js"></script> -->
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
