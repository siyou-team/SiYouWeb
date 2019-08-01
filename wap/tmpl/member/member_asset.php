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
    <title><?=__('我的财产')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
    <div class="header-wrap">
        <div class="header-l"><a href="member.html"> <i class="zc zc-back back"></i> </a></div>
        <div class="header-title">
            <h1><?=__('我的财产')?></h1>
        </div>
    </div>
    <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"><span class="arrow"></span>
          <ul>
              <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
              <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
              <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
              <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
              <li><a href="../cart_list.html"><i class="zc zc-cart cart"></i><?=__('购物车')?><sup></sup></a></li>
              <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
          </ul>
        </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <ul class="sstouch-default-list">
        <li><a href="predepositlog_list.html">
            <h4><i class="zc zc-yue"></i><?=__('账户余额')?></h4>
            <h6><?=__('余额账户余额、充值及提现明细')?></h6>
            <span class="tip" id="predepoit"></span> <span class="zc zc-arrow-r arrow-r"></span></a></li>
        <li class=""><a href="rechargecardlog_list.html">
            <h4><i class="zc zc-qiachongzhi"></i><?=__('充值卡余额')?></h4>
            <h6><?=__('充值卡账户余额以及卡密充值操作')?></h6>
            <span class="tip" id="rcb"></span> <span class="zc zc-arrow-r arrow-r"></span></a></li>
        <li class=""><a href="voucher_list.html">
            <h4><i class="zc zc-youhuiquan"></i><?=__('店铺优惠券')?></h4>
            <h6><?=__('店铺优惠券使用情况以及卡密兑换优惠券操作')?></h6>
            <span class="tip" id="voucher"></span><span class="zc zc-arrow-r arrow-r"></span></a></li>
        <li class="redpacket-enable hide"><a href="redpacket_list.html">
            <h4><i class="zc zc-hongbao"></i><?=__('平台红包')?></h4>
            <h6><?=__('平台红包使用情况以及卡密领取红包操作')?></h6>
            <span class="tip" id="redpacket"></span><span class="zc zc-arrow-r arrow-r"></span></a></li>
        <li class="point-enable hide"><a href="pointslog_list.html">
            <h4><i class="zc zc-jifen"></i><?=__('消费积分(CP)')?></h4>
            <h6><?=__('消费积分获取及消费日志')?></h6>
            <span class="tip" id="point"></span><span class="zc zc-arrow-r arrow-r"></span></a></li>
        <li class="credit-enable hide"><a href="credit_list.html">
            <h4><i class="zc zc-credit"></i><?=__('信用账户')?></h4>
            <h6><?=__('会员信用账户及消费日志')?></h6>
            <span class="tip" id="credit"></span><span class="zc zc-arrow-r arrow-r"></span></a></li>

        <li class="sp-enable hide"><a href="../exchange/sp/sp_list.html">
            <h4><i class="zc zc-jifen"></i><?=__('购物积分(众宝)')?></h4>
            <h6><?=__('购物积分获取及消费日志')?></h6>
            <span class="tip" id="sp"></span><span class="zc zc-arrow-r arrow-r"></span></a></li>

        <li class="bp-enable hide"><a href="../exchange/bp/bp_list.html">
            <h4><i class="zc zc-jifen"></i><?=__('分红积分(金宝)')?></h4>
            <h6><?=__('分红积分获取及消费日志')?></h6>
            <span class="tip" id="bp"></span><span class="zc zc-arrow-r arrow-r"></span></a></li>
    </ul>
</div>
<footer id="footer" class="posa"></footer>
<script> var navigate_id = "5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/member_asset.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
