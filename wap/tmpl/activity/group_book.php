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
    <link rel="stylesheet" type="text/css" href="../../css/activity/group_book.css">
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
        <div class="m-tab">
            <div class="m-navbar">
                <div :class="'m-navbar-item ' + (tapindex==1?'m-navbar-item-on':'')" bindtap="groupLists">
                    <?=__('立即开团')?>
                </div>
                <div :class="'m-navbar-item ' + (tapindex==2?'m-navbar-item-on':'')" bindtap="toBeGroupLists">
                    <?=__('即将开团')?>
                </div>
            </div>
        </div>
        <div :class="(tapindex==1?'':'hide')" style="font-size:0.37333333333333rem;">
            <div scroll-y="true" v-if="pdlist.length>0" class="m-orderlist" bindscrolltolower="scrollbottom" style="width:100%;height:100%;position:absolute;/*padding-top:1rem;*/box-sizing: border-box;">
                <div v-for="item in pdlist">
                    <div :href="'../product_detail.html?gb_id=0&item_id=' + item.activity_rule.item_id" class="m-product-item m-product-GP">
                        <div class="m-product-img">
                            <img :src="item.activity_rule.product_image" />
                        </div>
                        <div class="m-product-info">
                            <div class="m-product-name">
                                <label><span class='u-tuan-label'><?=__('拼')?></span><span v-text="item.activity_rule.item_name"></span></label>
                                <div class="groupNumber">
                                    <count-down :millisecond="item.Time" Type="1">
                                    </count-down>
                                </div>
                            </div>
                            <div class="m-product-price" style='font-size:0.50666666666667rem'>
                                <label>¥</label><span v-text="item.activity_rule.group_sale_price"></span>
                                <label class="u-del-price" style='margin-left:0.10666666666667rem' v-text="'¥' + item.activity_rule.item_unit_price"></label>
                                <button class="u-btn u-btn-default"><?=__('立即开团')?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-loading-box">
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
                </div>
            </div>
            <div redirect="true" class="m-nullpage" v-else>
                <div class="m-nullpage-middle">
                    <div class="m-null-tip">
                        <span><?=__('亲，拼团商品正在备货中')?>~</span>
                    </div>
                </div>
            </div>
        </div>
        <div :class="(tapindex==2?'':'hide')" style="font-size:0.37333333333333rem">
            <div scroll-y="true" v-if="fglist.length>0" class="m-orderlist" bindscrolltolower="scrollbottomtwo" style="width:100%;height:100%;position:absolute;/*padding-top:0.88rem;*/box-sizing: border-box;">
                <div v-for="item in fglist">
                        <div class="m-product-item m-product-GP">
                        <div class="m-product-img">
                            <img :src="item.activity_rule.product_image" />
                        </div>
                        <div class="m-product-info">
                            <div class="m-product-name">
                                <label><span class='u-tuan-label'><?=__('拼')?></span><span v-text="item.activity_rule.item_name"></span></label>
                                <div class="groupNumber">
                                    <count-down :millisecond="item.activity_rule.item_unit_price - item.activity_rule.group_sale_price" Type="0">
                                    </count-down>
                                </div>
                            </div>
                            <div class="m-product-price">
                                <label>¥</label>
                                <span v-text="item.activity_rule.group_sale_price"></span>
                                <label class="u-del-price">¥<span v-text="item.activity_rule.item_unit_price"></span></label>
                                <button class="u-btn u-btn-default" style='background:#bdbdbd'><?=__('立即开团')?></button>
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
            <div redirect="true" class="m-nullpage" v-else>
                <div class="m-nullpage-middle">
                    <div class="m-null-tip">
                        <span><?=__('亲，拼团商品正在备货中')?>~</span>
                    </div>
                </div>
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
