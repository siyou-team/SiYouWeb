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
    <title><?=__('大转盘')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/lottery_draw.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
</head>
<body>

<div id="container" v-cloak>
    <!--<import src="../../wxParse/wxParse.wxml" />
    <import src="../../tpl/coupon_msk.wxml" />-->
    <div v-if="isPage">

        <div class="m-draw-box" v-if="outdated">
            <div class="m-title">
                <div class="m-title-main"><span v-text="DrawInfo.activity_title"></span></div>
                <div class="m-title-sub"><?=__('幸运大抽奖')?></div>
                <div class="m-title-time"><span v-text="DrawInfo.activity_starttime"></span> ~ <span v-text="DrawInfo.activity_endtime"></span></div>
            </div>
            <div class="m-table">
                <div v-for="(item,i) in PrizeList" :class="'m-table-td ' + ((i+1)==index?'select-table':'')" >
                    <img :src="item.awards_image" />
                    <div class="price-text" v-text="item.awards_name"></div>
                </div>
                <div class="m-table-btn" bindtap="LuckDraw">
                    <img src="../../images/activity/click.png" />
                </div>
            </div>
            <div class="m-tip"><?=__('您还有')?><label><span v-text="RemainingCount">0</span><?=__('次')?></label><?=__('抽奖机会，快来试试手气')?></div>
            <div class="m-model-outline">
                <div class="m-model yellow"><?=__('中奖名单')?></div>
            </div>
            <div v-if="DrawInfo.winner_rows.items.length >0">
                <swiper autoplay="true" interval="4000" duration="2000" class="m-luckylist" vertical="false" circular="true">
                    <swiper-item v-for="(items,i) in rows">
                        <div v-for="(item,j) in DrawInfo.winner_rows.items">
                            <div v-if="j>=(i*3) && j<=((i+1)*3)" class="m-luckylist-item">
                                • <span v-text="item.user_nickname"></span><?=__('抽中')?>
                                <label v-text="item.awards_name"></label>
                            </div>
                        </div>
                    </swiper-item>
                </swiper>
            </div>
            <div class="m-winner-nothing" v-else><?=__('暂无中奖名单数据')?></div>
            <div class="m-model-outline">
                <div class="m-model blue"><?=__('活动规则')?></div>
            </div>
            <div class="m-rule">
                <div is="wxParse" v-html="DrawInfo.activity_rule.activity_intro"></div>
            </div>
        </div>
        <div class="activity-outdated" v-else>
            <div class="m-nullcontent">
                <div class="m-nullpage-middle">
                    <label class="iconfont icon-meiyougengduo"></label>
                    <div class="m-null-tip">
                        <span><?=__('亲~您来晚了哦')?></span>
                        <span><?=__('该抽奖活动已经失效啦~')?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="u-tap-btn">
        <div href="../activity/my_prize.html?category=1" class="u-go-home">
            <div class="u-go-home zc zc-member"></div>
        </div>
        <div class="red-dot"></div>
        <div href="../../index.html" open-type="switchTab" class="u-go-home zc zc-home">
            <div class="iconfont icon-shouyeshouye" style="font-size:50px;"></div>
        </div>
    </div>
    <div class="mskprize" v-if="clickmsk" bindtap="cancelprize" v-cloak>
        <div class="m-result-box bounceIn animated" catchtap="nothing" v-if="PrizeResult.index >= 0">
            <div class="m-result-cancel" bindtap="cancelprize">✕</div>
            <div class="m-success-text"><?=__('恭喜你获得了~')?></div>
            <img :src="PrizeList.awards_image" class="m-success-img" />
            <div class="m-success-name" v-text="PrizeResult.awards_name"></div>
            <div class="m-success-name" v-text="PrizeResult.awards_title"></div>
            <div class="m-success-bottom">
                <div href="../activity/my_prize.html?category=1" class="succes-checkprice"><?=__('查看奖品~')?></div>
                <div class="succes-continue" bindtap="cancelprize"><?=__('继续抽奖')?></div>
            </div>
        </div>
        <div class="m-result-box wobble animated" catchtap="nothing" v-else>
            <div class="m-result-cancel" bindtap="cancelprize">✕</div>
            <div class="m-failimg-bg">
                <img src="../../images/activity/nothing.png" class="m-fail-img" />
            </div>
            <div class="m-fail-name" v-text="DrawInfo.LosingDesc"></div>
            <div class="m-fail-button" bindtap="cancelprize"><?=__('继续抽奖')?></div>
        </div>
    </div>
    <div class="mskshare" v-if="clickshare" v-cloak bindtap="cancelshare">
        <!-- <image src="../../assets/share.png" class="share-oncemore" mode="widthFix"></image> -->
        <div class="share-text">
            <div><?=__('你今天已经没有抽奖机会了')?></div>
            <div><?=__('分享给好友或者群聊')?></div>
            <div><?=__('将额外获得')?><label v-text="(!isNull(DrawInfo.IncreasementFromShare) ? DrawInfo.IncreasementFromShare : 0) + '次'">0<?=__('次')?></label>><?=__('抽奖机会')?></div>
            <button class="u-btn u-btn-default" open-type="share"><?=__('分享给好友')?></button>
        </div>
    </div>
    <!--<template is="index_msk" v-if="IsNewUser==1 && CouponAmount>0" data="CouponAmount, isCancel" />
    <template is="success_msk" v-if="!isCancelSuccess" data="Coupons" />-->
</div>
<div class="pre-loading">
    <div class="pre-block">
        <div class="spinner"><i></i></div>
        <?=__('数据读取中')?>... </div>
</div>
</body>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/lottery_draw.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
