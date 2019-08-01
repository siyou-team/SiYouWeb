<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
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
  <title><?=__('扫码核销')?></title>
  <link rel="stylesheet" type="text/css" href="../../css/base.css">
  <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
  <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('扫码核销')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-daiziti scan"></i></a> </div>
  </div>
</header>
<div class="sstouch-main-layout" style="margin-bottom: 4rem!important">
  <div class="sstouch-order-search">
    <form class="sstouch-inp-con">
      <input type="text" autocomplete="on" maxlength="50" placeholder="<?=__('请输入预约码进行核销')?>" name="order_key" id="order_key" oninput="writeClear($(this));" >
      <span class="input-del"></span>
      <div type="button" id="scan_btn" class="zc" style="width: 12%;height: 44px;line-height: 44px;font-size: 1rem;float: right">&#xe630;</div>

      <div class="form-btn"><a class="btn" href="javascript:;"><?=__('查询订单')?></a></div>
    </form>
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/store_order_yuyue_verification.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
