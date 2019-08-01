
<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
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
    <title><?=__('活动报名页')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/activity_sign.css">
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
            <h1><?=__('活动报名页')?></h1>
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
    <div class="m-activity-item">
        <img :src="EventMainPic" mode="aspectFill" class="m-activity-img"/>
        <div class="m-activity-info">
            <div class="m-activity-name" v-text="Title"></div>
            <label class="iconfont icon-shijian gray"></label>
            <label class="m-activity-time" v-text="EventTime"></label>
        </div>
    </div>
    <form>
        <div class="m-cells m-cells-form">
            <div class="m-cell">
                <div class="m-cell-hd">
                    <label class="u-label"><?=__('姓名')?>：</label>
                </div>
                <div class="m-cell-bd">
                    <input class="u-input" type="text" placeholder="<?=__('请输入姓名')?>" name="user_name" id="inputname" />
                </div>
                <div v-if="!isName" class="m-cell-ft">
                    <i class="m-icon-warn" type="warn">！</i>
                </div>
            </div>
            <div class="m-cell">
                <div class="m-cell-hd">
                    <i class="u-label"><?=__('电话')?>：</i>
                </div>
                <div class="m-cell-bd">
                    <input class="u-input" type="number" placeholder="<?=__('请输入电话')?>" name="user_phone" maxlength="11" id="inputphone" />
                </div>
                <div v-if="!isPhone" class="m-cell-ft">
                    <i class="m-icon-warn" type="warn">！</i>
                </div>
            </div>
            <div class="m-cell">
                <div class="m-cell-hd">
                    <label class="u-label"><?=__('公司')?>：</label>
                </div>
                <div class="m-cell-bd">
                    <input class="u-input" type="text" placeholder="<?=__('请输入公司名称')?>" name="user_company" id="inputfirm" />
                </div>
                <div v-if="!isFirm " class="m-cell-ft">
                    <i class="m-icon-warn" type="warn">！</i>
                </div>
            </div>
            <div class="m-cell">
                <div class="m-cell-hd">
                    <label class="u-label"><?=__('职位')?>：</label>
                </div>
                <div class="m-cell-bd">
                    <input class="u-input" type="text" placeholder="<?=__('请输入职位')?>" name="user_position" id="inputjob"/>
                </div>
                <div v-if="!isJob" class="m-cell-ft">
                    <i class="m-icon-warn" type="warn">！</i>
                </div>
            </div>
        </div>
        <div class="btn_box">
            <!--<button class="u-btn u-btn-default" id="signinnow">立即报名</button>-->

            <div id="signinnow" class="u-btn u-btn-default" v-text="source==StateCode.MARKRTING_ACTIVITY_JOIN?'立即报名':'立即签到'"></div>

        </div>
    </form>
    <div class="u-tap-btn">
        <div href="../../index.html" open-type="switchTab" class="u-go-home zc zc-home">
            <div class="iconfont icon-shouyeshouye"></div>
        </div>
    </div>
</div>

<div class="pre-loading">
    <div class="pre-block">
        <div class="spinner"><i></i></div>
        <?=__('数据读取中')?>... </div>
</div>
</body>
<script> var navigate_id = "5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/activity_sign.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
