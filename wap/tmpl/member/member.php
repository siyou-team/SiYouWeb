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
    <style>
        .sstouch-home-top {display: block;z-index: 2;background-color: #f7f7f7;overflow: hidden;}
        .appheader {height: 3rem;text-align: center;width: 98%;overflow: hidden;}
        .appheader b{display: inline-block;  float: left;  margin: 1rem;}
        .appheader img{float: right;width:1.2rem;margin: .7rem;}
        .footnav ul li i {vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .tarbul{vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .member-top{height: 8rem;background-image: url(../../images/app-index/t.png);}
        .member-collect {background:none;}
        .member-collect .member-create {display: inline-block;width: 40%;height: .8rem;padding: .5rem 0;border-radius: .3rem;background-color: red;font-size:.65rem;color:white;}
        .member-collect  .member-log{display: inline-block;width: 40%;height:.8rem;padding: .5rem 0;border-radius: .3rem;border:1px solid white;margin-left:1rem; font-size: .65rem;color:white;}
        .goods-title1{color:black;font-size:.7rem;float: left;margin: .4rem 1rem;}
        .item-goods ul.goods-list li {width: 32%;}
        .item-goods ul.goods-list li:nth-child(odd) {margin: 0 0 0 1rem;}
        .item-goods ul.goods-list li:nth-child(even) {margin: 0 0 0 1rem;}
        .footnav ul li i {vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .tarbul{vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
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
        <b>My siyou</b>
        <a href="../search.html"><img  src="../../images/appstore/search.png" /></a>
    </div>
    <div class="member-top">

    </div>
    <div class="sstouch-home-block">
        <div class="tit-bar style1">
            <b><div class="goods-title1"><?=__('目录')?>  </div></b>
        </div>
        <div class="sstouch-home-block item-goods">
            <dl class="categroy-child-list" id="categroy-child-list">
                <dt><a href="order_list.html"><img class="point" src="../../images/app-index/2-1.png"> <div class="app-myspan"><?=__('我的订单')?><i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>
                <dt><a href="address_list.html"><img class="point" src="../../images/app-index/2-2.png"> <div class="app-myspan"><?=__('收货地址')?><i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>
                <dt><a href="chat_list.html"><img class="point" src="../../images/app-index/2-3.png"> <div class="app-myspan"><?=__('消息提醒')?><i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>
                <dt><a href="../setting.html"><img class="point" src="../../images/app-index/2-4.png">  <div class="app-myspan"><?=__('系统设置')?><i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>

            </dl>
        </div>
    </div>
</div>

<footer id="footer">
</footer>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/member.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
