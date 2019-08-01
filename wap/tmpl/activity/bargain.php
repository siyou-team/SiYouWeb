
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
    <link rel="stylesheet" type="text/css" href="../../css/activity/bargain.css">

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
    <!--<import src="../../wxParse/wxParse.wxml" />
<import src="../../tpl/shareMskTpl.wxml" />-->
    <div style="background: rgb(41, 36, 56);">
        <div class="bargin" v-if="show==false">
            <div class="part1">
                <div class="part1_image">
                    <div class="goods">
                        <img :src="Info.activity_rule.product_image" class="goods1" />
                        <div v-if="end==1">
                            <div class="remaining"><?=__('距离开始时间仅剩')?></div>
                            <div class="remaining_time">
                                <div class="time" v-text="Time.hour"></div>:
                                <div class="time" v-text="Time.min"></div>:
                                <div class="time" v-text="Time.sec"></div>
                            </div>
                        </div>
                        <div v-if="end==2">
                            <div class="remaining"><?=__('活动时间仅剩')?></div>
                            <div class="remaining_time">
                                <div class="time" v-text="Time.hour"></div>:
                                <div class="time" v-text="Time.min"></div>:
                                <div class="time" v-text="Time.sec"></div>
                            </div>
                        </div>
                        <div v-if="end==3">
                            <div class="remaining"><?=__('活动已结束')?></div>
                        </div>
                        <div class="product_name" v-text="Info.activity_rule.item_name"></div>
                        <div class="present">
                            <div class="present_price" style="font-family:'微软雅黑';font-size:0.42666666666667rem;color:#ffc001;">
                                <label style="color:#fff"><?=__('原价')?></label> ￥<span v-text="Info.activity_rule.item_unit_price">0</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="part2" v-cloak>
                <img :src="imgPath" />
                <div style="width:6.3466666666667rem">
                    <div class="username" v-text="user_nickname"></div>
                    <div class="text1" v-if="Info.is_cut==false&&istrue"><?=__('快试试刀法如何，看看你能砍掉多少')?></div>
                    <div class="text1" v-if="Info.is_cut&&istrue"><?=__('您总共砍掉')?>
                        <label style="color:#ffc001;" v-text="Info.cut_row.ach_price"></label><?=__('元，离底价又近了一步')?></div>
                    <div class="text1" v-if="Info.is_cut==false&&istrue==false"><?=__('您的好友在参加砍价活动，快帮ta砍一刀，试试刀法')?>~</div>
                    <div class="text1" v-if="Info.is_cut&&istrue==false"><?=__('您帮好友砍掉')?>
                        <label style="color:#ffc001;" v-text="Info.cut_row.ach_price"></label><?=__('元，刀法了得啊')?></div>
                </div>
            </div>
            <div class="part3" >
                <div class="progressBarBox">
                    <div class="u-progressBar">
                        <div class="u-progressBar-cont" :style="'width:' + width + '%'"></div>
                    </div>
                </div>
                <div style="display:flex;justify-content: space-between">
                    <div class="original">
                        <div class="og1"><?=__('原价')?></div>
                        <div class="og2" style="margin-top:0.08rem">￥<span v-text="Info.activity_rule.item_unit_price">0</span></div>
                    </div>
                    <div class="floor" v-if="isCut==false"><?=__('已砍到底价啦！')?></div>
                    <div class="cut-off">
                        <div class="cut1"><?=__('已砍')?></div>
                        <div class="cut2" style="margin-top:0.08rem">￥<span v-text="Info.activity_rule.item_unit_price - Info.ac_sale_price">0</span></div>
                    </div>
                </div>
                <!-- 还未砍价，发起人=帮砍人，活动正在进行 -->
                <div class="button" bindtap="bargin" v-if="Info.is_cut==false&&istrue&&end!=1&&end!=3&&Info.order_id==''"><?=__('开始砍价')?></div>
                <!-- 还未砍价，发起人=帮砍人，活动还未开始 -->
                <div class="button2" v-if="Info.is_cut==false&&istrue&&end==1&&Info.order_id==''"><?=__('开始砍价')?></div>
                <!-- 还未砍价，发起人！=帮砍人，活动还未结束 -->
                <div class="button" bindtap="bargin" v-if="Info.is_cut==false&&istrue==false&&isCut&&end!=1&&end!=3&&Info.order_id==''"><?=__('帮忙砍价')?></div>
                <!-- 已经砍价，发起人=帮砍人，活动还未结束，已砍价！=砍价空间 -->
                <div style="display:flex;justify-content: space-around" v-if="Info.is_cut&&istrue&&isCut&&end!=1&&end!=3&&Info.order_id==''">
                    <div class="button1" bindtap="goshop"><?=__('立即出手')?></div>
                    <!-- <button open-type="share" class="button1" style="margin:0.53333333333333rem 0 0 0" bindtap='shareBox'>找人帮砍</button>  -->
                    <button class="button1" style="margin:0.53333333333333rem 0 0 0" bindtap='shareBox'><?=__('找人帮砍')?></button>
                </div>
                <!-- 已经砍价，发起人=帮砍人，活动还未结束，已砍价=砍价空间 -->
                <div class="button" bindtap="goshop" v-if="Info.is_cut&&istrue&&isCut==false&&end!=1&&end!=3&&Info.order_id==''"><?=__('立即出手')?></div>
                <!-- 已经砍价，发起人！=帮砍人，活动还未结束，已砍价！=砍价空间 -->
                <div style="display:flex;justify-content: space-around" v-if="Info.is_cut&&istrue==false&&isCut&&end!=1&&end!=3&&Info.order_id==''">
                    <div :href="'../activity/bargain?mid=' + mid + '&pid=' + pid + '&ac_id=' + ac_id" class="button1"><?=__('我也要')?></div>
                    <!-- <button open-type="share" class="button1" style="margin:0.53333333333333rem 0 0 0" bindtap='shareBox'>找人帮砍</button>  -->
                    <button class="button1" style="margin:0.53333333333333rem 0 0 0" bindtap='shareBox'><?=__('找人帮砍')?></button>
                </div>
                <!-- 已经砍价，发起人！=帮砍人，活动还未结束，已砍价=砍价空间 -->
                <div :href="'../activity/bargain.html?mid=' + mid + '&pid=' + pid + '&ac_id=' +ac_id" v-if="istrue==false&&isCut==false&&end!=1&&end!=3&&Info.order_id==''" class="button"><?=__('我也要')?></div>
                <!-- 活动已经结束 -->
                <div class="button" href="../activity/bargain_list.html" v-if="end==3"><?=__('再逛逛')?></div>
                <div class="button" href="../activity/bargain_list.html" v-if="Info.order_id&&end!=3"><?=__('您已购买，再逛逛')?></div>
            </div>
            <div class="part4" v-if="Info.Description">
                <div class="header"><?=__('活动说明')?></div>
                <div is="wxParse" v-html="data.activity_rule.activity_intro"></div>
                <!--<template is="wxParse" data="wxParseData:PromotionRule.nodes" />-->
            </div>
            <div class="part5">
                <div class="header_shadow">
                    <div class="header1"><?=__('砍价高手')?></div>
                </div>
            </div>
            <div class="part6" v-for="items in List">
                <img :src="items.user_avatar" style="border-radius:50%" />
                <div class="kanjia">
                    <div v-text="items.user_nickname"></div>
                    <div style="margin-top:0.26666666666667rem"><?=__('砍掉价格')?>
                        <label style="color:#ffc001;" v-text="items.ach_price"></label><?=__('元！')?></div>
                </div>
            </div>
        </div>

        <div class="animation" v-if="show" v-cloak>
            <img src="../../images/activity/dao.png" animation="animation" :class="(show?'dao1':'')" bindtap="rotate" />
            <img src="../../images/activity/bag.png" v-if="showImg==false" class="bag" />
            <img src="../../images/activity/bagmoney.png" v-if="showImg" class="bagmoney" />
            <div class="Price" v-if="showImg">
                <div><?=__('成功砍价')?></div>
                <div><span v-text="money">0</span><?=__('元')?></div>
            </div>
            <div class="success" v-if="showImg" bindtap="back">
                <?=__('太棒啦')?>
            </div>
        </div>
    </div>
    <div class="u-tap-btn">
        <div href="../../index.html" open-type="switchTab" class="u-go-home zc zc-home">
            <div class="iconfont icon-shouyeshouye"></div>
        </div>
    </div>

    <div name="shareMskTpl">
        <div :class="'shareMsk ' + (PageQRCodeInfo.IsShare?'':'hide')">
            <div :class="'sharebox ' + (PageQRCodeInfo.IsShareBox?'bounceInUp animated':'bounceOutDown animated')">
                <div class='shareList g-flex '>
                    <div class='shareItem g-flex-item'>
                        <div class='shareBtn'>
                            <button open-type="share" style='line-height:0' hover-class="none">
                                <img src='../../images/activity/friend.png' style='width:2.6667rem;height:2.6667rem;margin-bottom:0.16rem' />
                            </button>
                            <label><?=__('分享给朋友')?></label>
                        </div>
                    </div>
                    <div class='shareItem g-flex-item'>
                        <div class='shareBtn' bindtap='shareQRCode'>
                            <img src='../../images/activity/allfriend.png' style='width:2.6667rem;height:2.6667rem' />
                            <label><?=__('分享到朋友圈')?></label>
                        </div>
                    </div>
                </div>
                <div class='cancelShare' bindtap='cancelShare'><?=__('取消')?></div>
            </div>
            <div class="'shareCodeImg ' + (PageQRCodeInfo.IsJT?'':'hide')">
                <i type="clear" size="20" bindtap='cancelShare'> </i>
                <div  bindtap='showCodeImg'>
                    <img mode="widthFix" :src='PageQRCodeInfo.Path' />
                </div>
                <label><?=__('保存至相册 分享到朋友圈')?></label>
                <button type="primary" size="mini" bindtap="saveImg"> <?=__('保存图片')?> </button>
            </div>
        </div>
    </div>
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
       <?=__('数据读取中')?>... </div>
</div>
</body>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/bargain.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
