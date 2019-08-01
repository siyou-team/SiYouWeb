<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
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
    <title><?=__('我的奖品')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/receive_prize.css">
</head>
<body>

<header id="header" class="app-no-fixed">
    <div class="header-wrap">
        <div class="header-l">
            <a href="javascript:history.go(-1)">
                <i class="zc zc-back back"></i>
            </a>
        </div>
        <div class="header-title">
            <h1><?=__('领取奖品')?></h1>
        </div>
        <div class="header-r">
            <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>
        </div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu">
            <span class="arrow"></span>
            <ul>
                <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
                <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
                <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
                <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
                <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
            </ul>
        </div>
    </div>
</header>
<div id="container" v-cloak>
    <div class="m-cells m-cells-form">
        <div class="m-cell">
            <div class="m-cell-hd">
                <label class="u-label"><?=__('姓名')?>：</label>
            </div>
            <div class="m-cell-bd">
                <input class="u-input" type="text" placeholder="请输入姓名" name="user_name" bindinput="inputname" :value="UserName" />
            </div>
            <div v-if="!isName" class="m-cell-ft">
                <i class="m-icon-warn" type="warn">！</i>
            </div>
        </div>
        <div class="m-cell">
            <div class="m-cell-hd">
                <label class="u-label"><?=__('电话')?>：</label>
            </div>
            <div class="m-cell-bd">
                <input class="u-input" type="number" placeholder="请输入手机号" name="user_phone" :value="UserPhone" bindinput="inputphone" maxlength="11" />
            </div>
            <div v-if="!isPhone" class="m-cell-ft">
                <i class="m-icon-warn" type="warn">！</i>
            </div>
        </div>
        <div class="m-cell">
            <div class="m-cell-hd">
                <label class="u-label"><?=__('地址')?>：</label>
            </div>
            <div class="m-cell-bd">
                <input class="u-input" type="text" placeholder="请输入地址" name="user_address" bindinput="inputaddress" :value="UserAddress" />
            </div>
            <div v-if="!isAddress" class="m-cell-ft">
                <i class="m-icon-warn" type="warn">！</i>
            </div>
        </div>
    </div>
    <div class="m-tip"><?=__('注：为了方便兑奖，请认真填写兑奖信息。若因未填写资料或资料填写错误导致兑奖失败,主办方不承担任何责任')?></div>
    <div class="btn_box">
        <button class="u-btn u-btn-default" bindtap="submit"><?=__('提交信息')?></button>
    </div>
</div>
<div class="pre-loading">
    <div class="pre-block">
        <div class="spinner"><i></i></div>
        <?=__('数据读取中... ')?></div>
</div>
</body>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/receive_prize.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
