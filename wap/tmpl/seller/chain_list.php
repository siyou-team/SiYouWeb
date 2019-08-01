<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="cn" >
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
    <title>My xiyou</title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/index.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
    <link rel="stylesheet" type="text/css" href="../../css/swiper.min.css">

    <style>
        .sstouch-home-top {display: block;z-index: 2;background-color: #f7f7f7;overflow: hidden;}
        .appheader {line-height: 3rem;
            text-align: center;
            font-size: .8rem;
            font-weight: 700;}
        .footnav ul li i {vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .item-goods ul.goods-list li {width: 32%;}
        .item-goods ul.goods-list li:nth-child(odd) {margin: 0 0 0 1rem;}
        .item-goods ul.goods-list li:nth-child(even) {margin: 0 0 0 1rem;}
        .footnav ul li i {vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .categroy-child-list{margin: 0 1rem;background-color: #fff;}
        .categroy-child-list dt i {width: .4rem;height: .4rem;vertical-align: middle;display: inline-block;border-radius: .2rem;margin-right: .4rem;}
        .categroy-child-list dt a {display: block;width: 96%;height: 3rem;padding: 0 0 0 .1rem;font-size: .6rem;line-height: 1.6rem;color: #111;}
        .point{margin:0.5rem;width:1rem;}
        .categroy-child-list dt i.arrow-r {display: block;width: .6rem;height: .6rem;font-size: 1rem;color: #212121;float: right;margin: 0rem .3rem 0 0;opacity: .4;}
        .app-myspan{display: inline-block;border-bottom: 1px solid #d3d3d3;width: 80%;line-height: 2.3rem;font-size: .8rem;}
    </style>
    <link rel="apple-touch-icon" href="../../images/touch-icon-iphone.png"/>
</head>
<body>
<div class="sstouch-home-top fixed-Width">
    <div class="appheader">
        <?=__('选择登录门店')?>
    </div>
    <div class="sstouch-home-block">
        <div class="sstouch-home-block item-goods">
            <dl class="categroy-child-list" id="categroy-child-list">
<!--                <dt><a href="order_list.html"><img class="point" src="../../images/app-index/2-1.png"> <div class="app-myspan">--><?//=__('我的订单')?><!--<i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>-->
<!--                <dt><a href="address_list.html"><img class="point" src="../../images/app-index/2-2.png"> <div class="app-myspan">--><?//=__('收货地址')?><!--<i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>-->
<!--                <dt><a href="chat_list.html"><img class="point" src="../../images/app-index/2-3.png"> <div class="app-myspan">--><?//=__('消息提醒')?><!--<i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>-->
<!--                <dt><a href="../setting.html"><img class="point" src="../../images/app-index/2-4.png">  <div class="app-myspan">--><?//=__('系统设置')?><!--<i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>-->

            </dl>
        </div>
    </div>
</div>
<script type="text/html" id="chain_list_tmp">
    <% for (var i in items) { %>
    <dt>
        <a href="seller.html?chain_id=<%= items[i].chain_id%>">
            <img class="point" src="../../images/app-index/2-5.png">
            <div class="app-myspan"><%= items[i].chain_name%><i class="zc zc-arrow-r arrow-r"></i></div>
        </a>
    </dt>
    <% } %>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/libs/sweetalert.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/chain_list.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
