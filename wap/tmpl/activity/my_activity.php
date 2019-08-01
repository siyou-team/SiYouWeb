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
    <title><?=__('砸金蛋活动')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/my_activity.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
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
            <h1><?=__('我的活动')?></h1>
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
<div v-if="ispage" id="body"  v-cloak>
    <div scroll-y="true" v-if="Info.length>0" bindscrolltolower="scrollbottom" style="width:100%;height:100%">
        <div href="'../activity/activity?id=' + items.activity_id" class="m-activity-item" v-for="items in Info">
            <img :src="items.activity_rule.activity_image" mode="aspectFill" class="m-activity-img" />
            <div class="m-activity-info">
                <div class="m-activity-name" v-text="items.activity_name"> </div>
                <label class="iconfont icon-shijian gray"></label>
                <label class="m-activity-time" v-text="items.activity_endtime"></label>
            </div>
        </div>
        <div class="m-loading-box">
            <div v-if="flag">
                <div class="u-loadmore">
                    <label class="u-loading"></label>
                    <span class="u-loadmore-tips"><?=__('正在加载')?></span>
                </div>
            </div>
            <div v-else>
                <div class="u-loadmore u-loadmore-line">
                    <span class="u-loadmore-tips"><?=__('没有更多数据啦！')?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="m-nullcontent" v-else>
        <div class="m-nullpage-middle">
            <label class="iconfont icon-meiyougengduo"></label>
            <div class="m-null-tip">
                <span><?=__('没有参加任何活动')?>~~</span>
                <div class="highlight" style="padding:10px;" href="../activity/activitylist.html"><?=__('前往活动中心')?></div>
            </div>
        </div>
    </div>
</div>

<div class="pre-loading">
    <div class="pre-block">
        <div class="spinner"><i></i></div>
        <?=__('数据读取中')?>... </div>
</div>
</body>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/my_activity.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
