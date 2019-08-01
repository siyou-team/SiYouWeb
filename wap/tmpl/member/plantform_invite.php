<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
    <title><?=__('邀请获取奖励')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body><header id="header" class="transparent">
    <div class="header-wrap">
        <div class="header-l"> <a href="member_account.html"> <i class="set"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('我的商城')?></h1>
        </div>
        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"> <span class="arrow"></span>
            <ul>
                <li><a href="../../index.html"><i class="home"></i><?=__('首页')?></a></li>
                <li><a href="../cart_list.html"><i class="cart"></i><?=__('购物车')?></a><sup></sup></li>
                <li><a href="javascript:void(0);"><i class="message"></i><?=__('消息')?><sup></sup></a></li>
            </ul>
        </div>
    </div>
</header>
<div class="scroller-body">
    <div class="scroller-box">
        <div class="member-top"></div>
        <div class="member-center">
            <dl class="mt5">
                <dd>
                    <ul id="order_ul">
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
</div>


<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/plantform_invite.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
