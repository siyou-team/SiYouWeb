
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
    <title><?=__('砍价活动')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/bargain_list.css">
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
            <h1><?=__('砍价活动')?></h1>
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
<div id="container" v-cloak  style="margin-top: 1.2rem;padding-top: 0.1rem;">
    <div scroll-y="true" class="m-product-all u-pa" bindscrolltolower="scrollbottom" :scroll-top="scposition" v-if="isdata">
        <div v-for="item in Info" v-for-item="">
            <div :href="'../activity/bargain.html?mid=' + item.activity_id + '&pid=' + item.item_id" class="m-product-item m-product-GP">
                <div class="m-product-img">
                    <img :src="item.product_image" />
                </div>
                <div class="m-product-info">
                    <div class="m-product-name">
                        <label v-text="item.product_item_name"></label>
                    </div>
                    <div class="m-product-price">
                        <label>¥</label><span v-text="item.item_unit_price"></span>
                        <button class="u-btn u-btn-default"><?=__('立即砍价')?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-loading-box">
            <div v-if="ispage">
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
    <div href="../../search.html" redirect="true" class="m-nullpage" v-else>
        <div class="m-nullpage-middle">
            <label class="iconfont icon-sousuo-sousuo"></label>
            <div class="m-null-tip">
                <span><?=__('亲~找不到您想要的商品')?></span>
                <span><?=__('再多点提示呗')?></span>
            </div>
        </div>
    </div>
</div>
<div class="pre-loading">
    <div class="pre-block">
        <div class="spinner"><i></i></div>
        <?=__('数据读取中...')?> </div>
</div>
</body>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/bargain_list.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
