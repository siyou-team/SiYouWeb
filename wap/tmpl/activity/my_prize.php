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
    <link rel="stylesheet" type="text/css" href="../../css/activity/my_prize.css">
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
            <h1><?=__('我的奖品')?></h1>
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
<div id="container" v-cloak style="margin-top: 1.2rem;">
    <div v-if="Prize.length > 0">
        <div class="m-myprice-item" v-for="item in Prize">
            <img :src="item.awards_image" alt="奖品图片" />
            <div class="price-title" v-text="item.awards_name"></div>
            <div class="price-time" v-text="item.alh_datetime"></div>
            <div :class="'price-btn ' + (item.alh_is_send?'gray':'red')" bindtap="buttonclicked" :data-id="item.alh_id" :data-activity_id="item.activity_id" :data-alh_is_send="item.alh_is_send" :data-alh_item_id="item.alh_item_id" v-text="item.alh_is_send?'已经发奖':'去领奖品'"></div>
        </div>
    </div>
    <div class="m-nullcontent" v-else>
        <div class="m-nullpage-middle">
            <label class="iconfont icon-meiyougengduo"></label>
            <div class="m-null-tip">
                <span><?=__('亲~什么都没有')?></span>
                <span><?=__('没有')?><em v-text="tip1"></em><?=__('中的奖品，快去')?><em v-text="tip2"></em><?=__('吧~~')?></span>
            </div>
        </div>
    </div>
</div>
<div class="pre-loading">
    <div class="pre-block">
        <div class="spinner"><i></i></div>
      <?=__('数据读取中...')?>   </div>
</div>
</body>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/my_prize.js"></script>
</html>
