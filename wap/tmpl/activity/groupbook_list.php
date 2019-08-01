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
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/groupbook_list.css">
    <link rel="stylesheet" type="text/css" href="../../css/public.css">
</head>
<body style="background: #F8F8F8">
<header id="header" class="app-no-fixed">
    <div class="header-wrap">
        <div class="header-l">
            <a href="javascript:history.go(-1)">
                <i class="zc zc-back back"></i>
            </a>
        </div>
        <div class="header-title">
            <h1><?=__('拼团活动')?></h1>
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
    <div class="m-product-all">
        <div class="img-w100" id="brand">
            <a href=""><img src="../../images/groupbook.png" alt=""></a>
        </div>

        <div class="m-tab">
            <div class="m-navbar">
                <a href="javascript:;" :class="'m-navbar-item ' + (tapindex==1?'m-navbar-item-on':'')" bindtap="groupLists">
                    <span><?=__('立即开团')?></span>
                </a>
                <a href="javascript:;" :class="'m-navbar-item ' + (tapindex==2?'m-navbar-item-on':'')" bindtap="toBeGroupLists">
                    <span><?=__('即将开团')?></span>
                </a>
            </div>
        </div>

        <div :class="(tapindex==1?'':'hide')" style="font-size:0.37333333333333rem;margin-top: 0.25rem;">
            <ul class="collage-list" scroll-y="true" v-if="pdlist.length>0" class="m-orderlist" bindscrolltolower="scrollbottom" style="width:100%;position:absolute;box-sizing: border-box;background: #fff">
                <li class="" v-for="item in pdlist">
                    <a class="pd65 flex-sb borb-d1" :href="'../product_detail.html?gb_id=0&item_id=' + item.activity_rule.item_id">
                        <div class="wh522 flex-fb522 img-w100 mb2 bg8">
                            <img :src="item.activity_rule.product_image" :alt="item.activity_rule.item_name">
                        </div>
                        <div class="flex-sb flex-dc w100 flex-overflow pl21">
                            <div>
                                <div class="f6 c26 ellipsis1" v-text="item.activity_rule.item_name">
                                </div>
                                <div class="f2 ca ellipsis2" v-text="item.activity_rule.item_name"></div>
                            </div>
                            <div class="flex-sb flex-ycenter" :class="{'disabled':item.activity_state == 2 }" >
                                <div class="flex-b50">
                                    <div class="bor-c5 flex-box flex-center bor-r60 tc">
                                        <div class="f1 c5" v-text="item.activity_rule.group_quantity + '<?=__('人拼')?>'"></div>
                                        <div class="f4 cf bg5" v-text="'￥' + item.activity_rule.group_sale_price"></div>
                                    </div>
                                    <div class="f2 c79 line-th  ellipsis1" v-text="'<?=__('原价')?> ￥' + item.activity_rule.item_unit_price"></div>
                                </div>
                                <div class="flex-xsye">
                                    <span class="list-main-btn pdr0" v-if="item.activity_state==1"><?=__('去拼单')?><i class="icon-arrow-right"></i></span>
                                    <span class="list-main-btn" v-else-if="item.activity_state==4"><?=__('即将团')?></span>
                                    <span class="list-main-btn pdl0" v-else><i class="icon-clock"></i><?=__('即将团')?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="m-loading-box">
                    <div v-if="ispage">
                        <div class="u-loadmore">
                            <lael class="u-loading"></lael>
                            <span class="u-loadmore-tips"><?=__('正在加载')?></span>
                        </div>
                    </div>
                    <div v-else>
                        <div class="u-loadmore u-loadmore-line">
                            <span class="u-loadmore-tips"><?=__('没有更多数据啦！')?></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div :class="(tapindex==2?'':'hide')" style="font-size:0.37333333333333rem;margin-top: 0.25rem">
            <div scroll-y="true" v-if="fglist.length>0" class="m-orderlist" bindscrolltolower="scrollbottomtwo" style="width:100%;height:100%;position:absolute;/*padding-top:0.88rem;*/box-sizing: border-box;background: #fff">
                <li class="" v-for="item in fglist">
                    <a class="pd65 flex-sb borb-d1" :href="'../product_detail.html?gb_id=0&item_id=' + item.activity_rule.item_id">
                        <div class="wh522 flex-fb522 img-w100 mb2 bg8">
                            <img :src="item.activity_rule.product_image" :alt="item.activity_rule.item_name">
                        </div>
                        <div class="flex-sb flex-dc w100 flex-overflow pl21">
                            <div>
                                <div class="f6 c26 ellipsis1" v-text="item.activity_rule.item_name">
                                </div>
                                <div class="f2 ca ellipsis2" v-text="item.activity_rule.item_name"></div>
                            </div>
                            <div class="flex-sb flex-ycenter" :class="{'disabled':item.activity_state == 2 }" >
                                <div class="flex-b50">
                                    <div class="bor-c5 flex-box flex-center bor-r60 tc">
                                        <div class="f1 c5" v-text="item.activity_rule.group_quantity + '<?=__('人拼')?>'"></div>
                                        <div class="f4 cf bg5" v-text="'￥' + item.activity_rule.group_sale_price"></div>
                                    </div>
                                    <div class="f2 c79 line-th  ellipsis1" v-text="'<?=__('原价')?> ￥' + item.activity_rule.item_unit_price"></div>
                                </div>
                                <div class="flex-xsye">
                                    <span class="list-main-btn pdr0" v-if="item.activity_state==1"><?=__('去拼单')?><i class="icon-arrow-right"></i></span>
                                    <span class="list-main-btn" v-else-if="item.activity_state==4"><?=__('即将团')?></span>
                                    <span class="list-main-btn pdl0" v-else><i class="icon-clock"></i><?=__('即将团')?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="loading" v-if="ispage">
                    <div class="spinner"><i></i></div>
                    <?=__('数据读取中...')?>
                </li>
            </div>
            <div class="sstouch-norecord search" v-else>
                <div class="norecord-ico"><i></i></div>
                    <dl>
                        <dt><?=__('亲，拼团商品正在备货中~')?></dt>
                    </dl>
            </div>

        </div>
    </div>
    <div class="u-tap-btn hide">

        <div class="red-dot"></div>
        <div href="../../index.html" open-type="switchTab" class="u-go-home zc zc-home">
            <div class="iconfont icon-shouyeshouye" style="font-size:0.66666666666667rem;"></div>
        </div>
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
<script type="text/javascript" src="../../js/tmpl/activity/group_book.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
