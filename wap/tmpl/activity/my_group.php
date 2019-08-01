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

    <title><?=__('我的拼团')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/my_group.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/sstouch_cart.css">
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
            <h1><?=__('我的拼团')?></h1>
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

        <div class="m-tab"  id="active_tab">
            <div class="m-navbar">
                <div :class="'m-navbar-item ' + (tapindex==1?'m-navbar-item-on':'')" bindtap="allOrders">
                  <?=__('全部拼团')?>
                </div>
                <div :class="'m-navbar-item ' + (tapindex==2?'m-navbar-item-on':'')" bindtap="toBePaid">
                    <?=__('进行中')?>
                </div>
                <div :class="'m-navbar-item ' + (tapindex==3?'m-navbar-item-on':'')" bindtap="receiptOfGoods">
                    <?=__('拼团成功')?>
                </div>
                <div :class="'m-navbar-item ' + (tapindex==4?'m-navbar-item-on':'')" bindtap="toBeEvaluated">
                    <?=__('拼团失败')?>
                </div>
            </div>
        </div>
        <div v-if="orderlist.length>0" :s="console.info(orderlist)" scroll-y="true" class="m-orderlist" bindscrolltolower="scrollbottom">
            <div v-for="items in orderlist"  class="m-panel m-panel-access">
                <div class="m-panel-hd"><?=__('订单编号')?>  ：<span v-text="items.order_id"></span>
                    <label v-if="items.gb_enable == 0"><?=__('拼团失败')?>  </label>
                    <label v-if="items.gb_enable == 1"><?=__('拼团成功')?>  </label>
                    <label v-if="items.gb_enable == 2"><?=__('拼团中')?>  </label>
                </div>
                <div class="m-product-list">
                    <div :href="'../product_detail.html?item_id=' + (items.activity_rule.item_id)" class="m-product-item">
                        <div class="m-product-img">
                            <img :src="items.activity_rule.product_image" mode="aspectFill" />
                        </div>
                        <div class="m-product-info">
                            <div class="m-product-name">
                                <label>
                                    <span class='u-tuan-label' v-if="items.Type=='FIGHTGROUP'"><?=__('拼')?> </span>
                                    <span class='u-tuan-label' v-if="items.Type=='LUCKYFIGHTGROUP'"><?=__('抽')?> </span>
                                    <span v-text="items.activity_rule.item_name"></span>
                                </label>
                            </div>
                            <div class="m-product-price">
                                <label>¥</label><span v-text="items.activity_rule.group_sale_price"></span>
                                <span style="text-decoration: line-through;">¥<span v-text="items.activity_rule.item_unit_price"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-total-info">
                    <?=__('实付款')?> ：
                    <label class="m-total-price">¥<span v-text="items.activity_rule.group_sale_price"></span></label>
                </div>
                <div class="m-total-btn">
                    <div :data-on="items.order_id" v-if="!items.gbh_flag" class="u-link-btn" bindtap="gotopay"><?=__('去支付')?></div>
                    <div v-if="2!=items.gb_enable&&items.gbh_flag" :href="'../activity/group_detail.html?gb_id=' + items.gb_id + '&pid=' + items.activity_rule.item_id + '&on=' + items.order_id + '&isfg=true&type=' + items.Type" class="u-link-btn"><?=__('拼团详情')?></div>
                    <div v-if="2==items.gb_enable&&items.gbh_flag" :href="'../activity/group_detail.html?gb_id=' + items.gb_id + '&pid=' + items.activity_rule.item_id + '&on=' + items.order_id + '&isfg=true&type=' + items.Type" class="u-link-btn"><?=__('邀请好友参团')?></div>
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
        <div    href="./group_book.html" redirect="true" class="m-nullpage" v-else>
            <div class="m-nullpage-middle">
                <div class="m-null-tip">
                    <label style="font-size:32px;"><?=__('亲~您还没有参与拼团哦，')?></label><label style="border-bottom:1px solid #db384c;color: #db384c;font-size:32px;"><?=__('亲~快去看看吧')?></label>
                </div>
            </div>
        </div>
        <!--底部总金额固定层End-->
        <div class="sstouch-bottom-mask" v-cloak>
            <div class="sstouch-bottom-mask-bg"></div>
            <div class="sstouch-bottom-mask-block">
                <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
                <div class="sstouch-bottom-mask-top">
                    <p class="sstouch-cart-num"><?=__('本次交易需在线支付')?><em id="onlineTotal">0.00</em>
                    <p style="display:none" id="isPayed"></p>
                    <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a> </div>
                <div class="sstouch-inp-con sstouch-inp-cart">
                    <ul class="form-box" id="internalPay">
                        <p class="rpt_error_tip" style="display:none;color:red;"></p>
                        <li class="form-item" id="wrapperUseRCBpay">
                            <div class="input-box pl5">
                                <label>
                                    <input type="checkbox" class="checkbox" id="useRCBpay" autocomplete="off" />
                                     <?=__('充值卡支付')?><span class="power"><i></i></span> </label>
                                <p><?=__('可用充值卡余额')?> ￥<em id="availableRcBalance"></em></p>
                            </div>
                        </li>
                        <li class="form-item" id="wrapperUsePDpy">
                            <div class="input-box pl5">
                                <label>
                                    <input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
                                    <?=__('预存款支付')?> <span class="power"><i></i></span> </label>
                                <p>  <?=__('可用预存款余额')?> ￥<em id="availablePredeposit"></em></p>
                            </div>
                        </li>
                        <li class="form-item" id="wrapperPaymentPassword" style="display:none">
                            <div class="input-box"> <span class="txt"><?=__('输入支付密码')?> </span>
                                <input type="password" class="inp" id="paymentPassword" autocomplete="off" />
                                <span class="input-del"></span></div>
                            <a href="../member/member_paypwd_step1.html" class="input-box-help" style="display:none"><i>i</i><?=__('尚未设置')?></a> </li>
                    </ul>
                    <div class="sstouch-pay">
                        <div class="spacing-div"><span><?=__('在线支付方式')?></span></div>
                        <div class="pay-sel">
                            <label style="display:none">
                                <input type="radio" name="payment_channel_code" class="checkbox" id="alipay" autocomplete="off" />
                                <span class="alipay"><?=__('支付宝')?></span></label>
                            <label style="display:none">
                                <input type="radio" name="payment_channel_code" class="checkbox" id="wx_native" autocomplete="off" />
                                <span class="wxpay"><?=__('微信')?></span></label>
                        </div>
                    </div>
                    <div class="pay-btn"> <a href="javascript:void(0);" id="toPay" class="btn-l"><?=__('确认支付')?></a> </div>
                </div>
            </div>
        </div>

    </div>


</div>
<div class="u-tap-btn hide">
    <div class="red-dot"></div>
    <div href="../../index.html" open-type="switchTab" class="u-go-home zc zc-home">
        <div class="iconfont icon-shouyeshouye" style="font-size:50px;"></div>
    </div>
</div>
<div class="pre-loading">
    <div class="pre-block">
        <div class="spinner"><i></i></div>
        <?=__('数据读取中')?></div>
</div>
</body>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/my_group.js"></script>
<script type="text/javascript" src="../../js/tmpl/order_payment_common.js"></script>

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
