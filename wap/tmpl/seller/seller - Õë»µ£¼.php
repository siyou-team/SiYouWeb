<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
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
    <title><?=__('商家管理中心')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="transparent">
    <div class="header-wrap">
        <div class="header-ls"></div>
        <div class="header-title">
            <h1><?=__('商家管理中心')?></h1>
        </div>
        <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i
                class="zc zc-more more"></i><sup></sup></a></div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"><span class="arrow"></span>
            <ul>
                <li><a href="seller.html"><i class="zc zc-home home"></i><?=__('商家中心')?></a></li>
                <li><a href="seller_address_list.html"><i class="zc zc-peisongdizhi"></i><?=__('发货地址')?></a></li>
                <li><a href="seller_express.html"><i class="zc zc-wuliukuaidi"></i><?=__('物流公司')?></a></li>
                <li><a href="seller_account.html"><i class="zc zc-yonghushezhi1"></i><?=__('店铺设置')?><sup></sup></a></li>
                <li><a href="chat_list.html"><i class="zc zc-message message"></i>IM <?=__('客服')?><sup></sup></a></li>
                <li id="logoutbtn"><a href="javascript:void(0);"><i class="zc zc-logout"></i><?=__('退出登录')?><sup></sup></a></li>
            </ul>
        </div>
    </div>
</header>
<div class="scroller-body">
    <div class="scroller-box">
        <div class="member-top" style="background-image: url(../../images/appstore/bg.jpg);background-size: 100%;"></div>
        <div class="member-center">
            <dl class="mt5">
                <dt>
                    <a href="store_orders_list.html">
                        <h3><i class="zc zc-wodedingdan" style="color: #009688;font-size: 0.8rem;opacity: 0.6"></i><?=__('订单管理')?>
                        </h3>
                        <h5><?=__('查看全部订单')?><i class="zc zc-arrow-r arrow-r"></i></h5>
                    </a>
                </dt>
                <dd>
                    <ul id="order_ul"></ul>
                </dd>
            </dl>
            <dl class="mt5">
                <dt>
                    <a href="store_orders_list_chain.html">
                        <h3><i class="zc zc-wodedingdan" style="color: #009688;font-size: 0.8rem;opacity: 0.6"></i><?=__('店内订单')?>
                        </h3>
                        <h5><?=__('查看全部订单')?><i class="zc zc-arrow-r arrow-r"></i></h5>
                    </a>
                </dt>
            </dl>
            <dl class="mt5">
                <dt>
                    <a href="store_goods_list.html">
                        <h3><i class="zc zc-dianpu" style="color: #9C27B0;font-size: 0.8rem;opacity: 0.6"></i></i><?=__('商品管理')?>
                        </h3>
                        <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                    </a>
                </dt>
                <dd>
                    <ul id="goods_ul"></ul>
                </dd>
            </dl>

            <dl class="mt5 hide">
                <dt>
                    <a href="store_bill.html">
                        <h3><i class="mc-02"></i><?=__('统计结算')?></h3>
                    </a>
                </dt>
                <dd>
                    <ul id="asset_ul"></ul>
                </dd>
            </dl>


           <!--  <dl class="mt5">
                <dt><a href="seller_address_list.html">
                    <h3><i class="zc zc-shouhuodizhi1" style="color: #962d77;font-size: 0.8rem;opacity: 0.6"></i><?=__('发货地址管理')?>
                    </h3>
                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                </a></dt>
            </dl>
            <dl style="border-top: solid 0.05rem #EEE;">
                <dt><a href="seller_express.html">
                    <h3><i class="zc zc-wuliukuaidi" style="color: #03A9F4;font-size: 0.8rem;opacity: 0.6"></i></i>
                      <?=__('物流公司管理')?>  </h3>
                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                </a></dt>
            </dl> -->

           <!--  <dl style="border-top: solid 0.05rem #EEE;" class="hide">
                <dt><a href="store_order_yuding_verification.html">
                    <h3><i class="zc zc-saomahexiao" style="color: #ff0000;font-size: 0.8rem;opacity: 0.6"></i><?=__('扫码核销')?></h3>
                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                </a></dt>
            </dl> -->
            <!-- <dl style="border-top: solid 0.05rem #EEE;">
                <dt><a href="store_order_ziti_verification.html">
                    <h3><i class="zc zc-tihuohexiao" style="color: #009688;font-size: 0.8rem;opacity: 0.6"></i><?=__('扫码核销')?>
                        </h3>
                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                </a></dt>
            </dl> -->
            <!-- <dl style="border-top: solid 0.05rem #EEE;">
                <dt><a href="seller_account.html">
                    <h3><i class="zc zc-yonghushezhi1" style="color: #e50dbb;font-size: 0.8rem;opacity: 0.6"></i><?=__('店铺设置')?>
                    </h3>
                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                </a></dt>
            </dl>
 -->
          <!--   <dl class="store_apply"  style="border-top: solid 0.05rem #EEE;">
                <dt><a href="../member/store_apply.html">
                    <h3><i class="zc zc-dianpu" style="color: #9C27B0;font-size: 0.7rem;opacity: 0.6"></i><?=__('入驻信息')?></h3>
                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                </a></dt>
            </dl> -->
<!--            <dl style="border-top: solid 0.05rem #EEE;">-->
<!--                <dt><a href="supplier_product_list.html">-->
<!--                    <h3><i class="zc zc-yonghushezhi1" style="color: #e50dbb;font-size: 0.8rem;opacity: 0.6"></i>--><?//=__('批发市场')?>
<!--                    </h3>-->
<!--                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>-->
<!--                </a></dt>-->
<!--            </dl>-->

            <dl style="border-top: solid 0.05rem #EEE;margin-bottom: 0.7rem;">
                <dt><a href="javascript:void(0);" id="clean_cache">
                    <h3><i class="zc zc-qingchuhuancun" style="color: #48e5ad;font-size: 0.8rem;opacity: 0.6"></i><?=__('清除缓存')?>
                    </h3>
                    <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                </a></dt>
            </dl>
            <dl style="border-top: solid 0.05rem #EEE;margin-bottom: 0.7rem;" class="hide chain_lists">
                <dt>
                    <a href="./chain_list.php">
                        <h3>
                            <i class="zc zc-qingchuhuancun" style="color: #48e5ad;font-size: 0.8rem;opacity: 0.6"></i><?=__('切换门店')?>
                        </h3>
                        <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
                    </a>
                </dt>

            </dl>
        </div>
    </div>
    <footer id="footer"></footer>
</div>
<script> var navigate_id ="1";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
