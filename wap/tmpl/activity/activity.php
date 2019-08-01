
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
    <title><?=__('活动中心')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/activity.css">
</head>
<body>
<!--<import src="../../wxParse/wxParse.wxml" />-->
<div class="m-activity-container" v-if="isPage" id="container"  v-cloak>
    <div class="m-activity-info">
        <img :src="Info.activity_rule.activity_image" mode="aspectFill" class="m-activity-img" v-if="!isEventMainPic" />
        <div class="m-activity-name" v-text="Info.activity_name"></div>
        <div class="m-activity-eventdesc" v-text="Info.activity_remark"></div>
        <div class="m-cell m-cell-access">
            <div class="m-cell-hd highlight">
                <label class="zc zc-yuyue "></label>
            </div>
            <div class="m-cell-bd m-cell-primary">
                <p v-text="'<?=__('活动时间')?>：' + Info.activity_starttime + '<?=__('至')?>' + Info.activity_endtime">  </p>
            </div>
        </div>
        <div class="m-cell m-cell-access">
            <div class="m-cell-hd" style="color:#EB543D">
                <label class="iconfont icon-gerenziliao "></label>
            </div>
            <div class="m-cell-bd m-cell-primary">
                <p v-text="'<?=__('报名截止时间')?>：' + Info.activity_rule.end_join_time"></p>
            </div>
        </div>
        <div class="m-cell m-cell-access">
            <div class="m-cell-hd" style="color:#1BC2A6">
                <label class="iconfont icon-shouhuodizhi "></label>
            </div>
            <div class="m-cell-bd m-cell-primary">
                <p v-text="'<?=__('活动地址')?>：' + Info.activity_rule.activity_address"></p>
            </div>
        </div>

        <div class="m-activity-otherinfo" v-if="!isEventDetail">
            <div class="item-otherinfo">
                <div class="item-title"><?=__('活动介绍')?></div>
            </div>
            <div style="padding:0 20px;">
                <div is="wxParse" v-html="Info.activity_rule.activity_detail_intro"> </div>
            </div>
        </div>
        <div class="m-activity-otherinfo" v-if="!isVip1">
            <div class="item-otherinfo">
                <div class="item-title"><?=__('嘉宾介绍')?></div>
            </div>
            <img :src="Info.VipGuestPic1" mode="widthFix" class="item-otherimg" v-if="!isVip1" />
            <img :src="Info.VipGuestPic2" mode="widthFix" class="item-otherimg" v-if="!isVip2" />
            <img :src="Info.VipGuestPic3" mode="widthFix" class="item-otherimg" v-if="!isVip3" />
            <img :src="Info.VipGuestPic4" mode="widthFix" class="item-otherimg" v-if="!isVip4" />
            <img :src="Info.VipGuestPic5" mode="widthFix" class="item-otherimg" v-if="!isVip5" />
        </div>
        <div class="m-activity-otherinfo" v-if="!isAgendaPlan">
            <div class="item-otherinfo">
                <div class="item-title"><?=__('活动议程')?></div>
            </div>
            <div style="padding:0 20px;">
                <div is="wxParse" v-html="Info.activity_rule.activity_process"></div>
            </div>
        </div>

        <div class="m-activity-otherinfo">
            <div class="item-otherinfo" style="margin-bottom:0px;">
                <div class="item-title"><?=__('主办单位')?></div>
            </div>
            <div class="m-cell m-cell-access borderNone">
                <div class="m-cell-hd" style="color:#1BC2A6">
                    <label class="iconfont icon-i1"></label>
                </div>
                <div class="m-cell-bd m-cell-primary">
                    <p> <?=__('主办方：')?><span v-text="Info.activity_rule.activity_sponsor "></span></p>
                </div>
            </div>
            <div class="m-cell m-cell-access">
                <div class="m-cell-hd" style="color:#1BC2A6">
                    <label class="iconfont icon-i "></label>
                </div>
                <div class="m-cell-bd m-cell-primary">
                    <p> <?=__('联系人：')?><span v-text="Info.activity_rule.contact_organizer"></span></p>
                </div>
            </div>
            <div class="m-cell m-cell-access">
                <div class="m-cell-hd" style="color:#1BC2A6">
                    <label class="iconfont icon-mobilephone "></label>
                </div>
                <div class="m-cell-bd m-cell-primary">
                    <p> <?=__('联系电话：')?><span v-text="Info.activity_rule.contact_phone"></span></p>
                </div>
            </div>
        </div>
        <div class="u-cleanbox"></div>
    </div>
    <div class="bottombar g-flex">
        <div class="service">
            <label class="iconfont icon-more"></label>
            <div class="text-kefu"><?=__('客服')?></div>
        </div>
        <div :class="'signin ' +  (isGray ?'m-footer-desable':'')" id="J_sign" v-text="content"></div>
    </div>
    <div size="27" type="default-dark" session-from="weapp" class="kefu"></div>
</div>

<div class="u-tap-btn">
    <div href="../../index.html" open-type="switchTab" class="u-go-home zc zc-home">
        <div class="iconfont icon-shouyeshouye" style="font-size:50px;"></div>
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
<script type="text/javascript" src="../../js/tmpl/activity/activity.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
