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

    <title><?=__('拼团活动')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/group_detail.css">

    <style>
        #shareit {
            -webkit-user-select: none;
            display: none;
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.85);
            text-align: center;
            top: 0;
            left: 0;
            z-index: 105;
        }
        #shareit img {
            max-width: 100%;
        }
        .arrow {
            position: absolute;
            right: 10%;
            top: 5%;
        }
        #share-text {
            margin-top: 400px;
        }
    </style>

</head>
<body>

<div id="container" v-cloak>
    <!--<import src="../../tpl/shareMskTpl.wxml" />
<import src="../../tpl/coupon_msk.wxml" />
<import src="../../wxParse/wxParse.wxml" />-->
    <div scroll-y="true" bindscrolltolower="fightPage" style="position: absolute;height:100%;width:100%;">
        <div class="m-product-list">
            <div :href="'../product_detail.html?item_id=' + GbInfo.activity_rule.item_id + '&gb_id=' + GbInfo.gb_id" class="m-product-item m-product-GP">
                <div class="m-product-img">
                    <img :src="GbInfo.activity_rule.product_image" />
                </div>
                <div class="m-product-info">
                    <div class="m-product-name">
                        <label v-text="GbInfo.activity_rule.item_name"></label>
                        <div class='groupNumber' style='margin-top:0.24rem'><?=__('拼团省')?>
                            <span v-text="GbInfo.activity_rule.item_unit_price - GbInfo.activity_rule.group_sale_price"></span>
                        </div>
                    </div>
                    <div style='position:absolute;bottom:0.26666666666667rem;'>
                        <div class="groupNumber" style='margin-bottom:0.16rem;'>
                            <!-- <label class="iconfont icon-icon"></label> -->
                            <span v-text="GbInfo.gb_quantity"></span><?=__('人团')?>
                        </div>
                        <div class="m-product-price">
                            <label>¥</label><span v-text="GbInfo.activity_rule.group_sale_price"></span>
                            <label class="u-del-price" v-text="'¥' + GbInfo.activity_rule.item_unit_price"></label>
                        </div>
                    </div>

                    <div class="isSucces">
                        <img class='simg' v-if="1==GbInfo.gb_enable" src='https://static.shopsuite.cn/xcxfile/appicon/groupbooking/success.png' />
                        <img class='simg' v-if="0==GbInfo.gb_enable" src='https://static.shopsuite.cn/xcxfile/appicon/groupbooking/failure.png' />
                    </div>
                </div>
            </div>
            <div class="headPhoto">
                <div class="personPhoto" v-for="item in GroupUsers">
                    <img class="photo" :src="item.user_avatar" />
                    <img class="photo-icon" src="https://static.shopsuite.cn/xcxfile/appicon/groupbooking/group_leader.png" v-if="GbInfo.user_id == item.user_id" />
                </div>
                <div class="personPhoto" v-for="img in remain_quantity">
                    <img class="photo-bg" src='https://static.shopsuite.cn/xcxfile/appicon/groupbooking/waiting.png' />
                </div>
            </div>
            <div class="surplus" v-if="GbInfo.gb_enable==2 && show">
                <div><?=__('仅剩')?><span v-text="GbInfo.gb_quantity - GbInfo.gb_amount_quantity"></span><?=__('名额')?></div>
                <label style='min-width:2.1333333333333rem;'>
                    <div class="htmleaf-container">
                        <div class="htmleaf-content">
                            <p class="count-time" :count_down="GbInfo.gb_endtime"><em time_id="d">00</em><?=__('天')?><em time_id="h">00</em><?=__('时')?><em time_id="m">00</em><?=__('分')?><em time_id="s">00</em><?=__('秒')?></p>
                        </div>
                    </div>
                </label>
                <label><?=__('名额，后结束')?></label>
            </div>
            <div v-if="show">
                <div class="m-btn-box" v-if="GbInfo.gb_enable==2 && !groupIsEnd">
                    <div class="u-btn u-btn-default" bindtap="shareBox"><?=__('邀请好友参团')?></div>
                </div>
                <div href="./group_book.html" class="m-btn-box" v-if="GbInfo.gb_enable==0">
                    <div class="u-btn u-btn-default"><?=__('点击再开一团')?></div>
                </div>
                <div url="../group_book.html" class="m-btn-box" v-if="GbInfo.gb_enable==1">
                    <div class="u-btn u-btn-default"><?=__('点击再开一团')?></div>
                </div>
                <div class="m-btn-box" v-if="GbInfo.gb_enable==2 && !ispaysuccess">
                    <div class="u-btn u-btn-default" bindtap="immediatelyOffered"><?=__('参与活动')?></div>
                </div>
            </div>
        </div>
        <div class='rule'>
            <div class='rule-header'>
                <?=__('拼团规则')?>
            </div>
            <div class='rule-content' v-text="GbInfo.activity_rule.activity_intro">

            </div>
        </div>
        <div class="link">
            <div href="../../index.html" open-type="switchTab" class="nav">
                <img class="nav-img" src="../../images/activity/index.png" />
                <span><?=__('首页逛逛')?></span>
            </div>
            <div href="../product_first_categroy.html" open-type="switchTab" class="nav">
                <img class="nav-img" src="../../images/activity/allproduct.png" />
                <span><?=__('全部商品')?></span>
            </div>
            <div href="../points_shop.html" class="nav">
                <img class="nav-img" src="../../images/activity/coupon.png" />
                <span><?=__('领券中心')?></span>
            </div>
            <div href="../member/member.html" open-type="switchTab" class="nav">
                <img class="nav-img" src="../../images/activity/center.png" />
                <span><?=__('个人中心')?></span>
            </div>
        </div>
    </div>
    <!--<template is="index_msk" v-if="IsNewUser==1 && CouponAmount>0" data="CouponAmount, isCancel" />
    <template is="success_msk" v-if="!isCancelSuccess" data="Coupons" />
    <template is="shareMskTpl" data="PageQRCodeInfo" />-->

    <div id="shareit" bindtap='cancelShare'>
        <img class="arrow" src="../../images/activity/share-it.png">
        <a href="#" id="follow">
            <img id="share-text" src="../../images/activity/share-text.png">
        </a>
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
<script type="text/javascript" src="../../js/countdown/raphael.js"></script>
<script type="text/javascript" src="../../js/countdown/jquery.classyled.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/group_detail.js"></script>

</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
