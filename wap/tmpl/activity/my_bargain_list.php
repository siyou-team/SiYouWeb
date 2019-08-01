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
    <title><?=__('我的砍价')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/my_bargain_list.css">
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
            <h1><?=__('我的砍价')?></h1>
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
    <div class="m-product-all">
        <div class="m-tab" id="active_tab">
            <div class="m-navbar">
                <div :class="'m-navbar-item ' + (tapindex==1?'m-navbar-item-on':'')" bindtap="allOrders">
                    <?=__('我发起的')?>
                </div>
                <div :class="'m-navbar-item ' + (tapindex==2?'m-navbar-item-on':'')" bindtap="toBePaid">
                      <?=__('我参与的')?>
                </div>
            </div>
        </div>
        <div v-if="orderlist.length>0" scroll-y="true" class="m-orderlist" bindscrolltolower="scrollbottom">
            <div v-for="items in orderlist" class="m-panel m-panel-access">
                <!-- <div class="m-panel-hd">订单编号：items.order_id
                <label v-if="items.IsCancel">拼团失败</label>
                <label v-if="items.IsSuccess">拼团成功</label>
                <label v-if="!items.IsSuccess && !items.IsCancel">拼团中</label>
                </div> -->
                <div class="m-product-list">
                    <div :href="'../activity/bargain.html?mid=' + items.activity_id + '&pid=' +items.activity_rule.item_id + '&sid=' + items.buyer_user_id + '&ac_id=' + items.ac_id" class="m-product-item">
                        <div class="m-product-img">
                            <img :src="items.activity_rule.product_image" mode="aspectFill" />
                        </div>
                        <div class="m-product-info">
                            <div class="m-product-name" style="height:90px">
                                <label v-text='items.activity_rule.item_name'></label>
                            </div>
                            <div class="progressBarBox">
                                <div class="u-progressBar">
                                    <div class="u-progressBar-cont" :style="'width:' + 100*(items.activity_rule.item_unit_price - items.ac_sale_price) / (items.activity_rule.item_unit_price - items.activity_rule.cut_down_min_limit_price) + '%'"></div>
                                </div>
                            </div>
                            <!-- <div class="progress-bar">
                              <div class="left" style="width:100*items.CutPricePercent%"></div>
                            </div> -->
                            <div class="m-product-price" style="display:flex;margin-top:16px;font-size:24px;justify-content: space-between;padding-right:36px">
                                <div><label style="color:#717171"><?=__('原价')?></label> <?=__('￥')?><span v-text="items.activity_rule.item_unit_price"></span></div>
                                <div style="color:#717171"><span v-text="items.activity_rule.item_unit_price - items.ac_sale_price"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-loading-box">
                <div v-if="ispage">
                    <div class="u-loadmore">
                        <label class="u-loading"></label>
                        <text class="u-loadmore-tips">  <?=__('正在加载')?></text>
                    </div>
                </div>
                <div v-else>
                    <div class="u-loadmore u-loadmore-line">
                        <text class="u-loadmore-tips"><?=__('没有更多数据啦！')?></text>
                    </div>
                </div>
            </div>
        </div>
        <div href   ="../activity/bargain_list.html" redirect="true" class="m-nullpage" v-else>
            <div class="m-nullpage-middle">
                <div class="m-null-tip">
                    <label style="font-size:32rpx;"><?=__('亲~您还没有砍价哦，')?></label><label class="highlight-link"><?=__('亲~快去看看吧')?></label>
                </div>
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
<script type="text/javascript" src="../../js/tmpl/activity/my_bargain_list.js"></script>


<script>

    $(function(){
        //店铺导航
        $('#active_tab').waypoint(function() {
            $("#active_tab").toggleClass('fixed');

            if (window.suteshopApp)
            {
                //如果没有header
                //$('.sstouch-single-nav.fixed').css({'top': 0});

                $('.active_tab.fixed').css({'top': '0rem'});
            }
            else
            {
                $('.active_tab.fixed').css({'top': '1.2rem'});
            }

        }, {
            offset: '1.2rem'
        });
    })
</script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
