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
<title><?=__('领取优惠券')?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="member.html"><i class="zc zc-back back"></i></a></div>
    <div class="header-tab"> <a href="voucher_list.html"><?=__('我的优惠券')?></a> <a href="javascript:void(0);" class="cur"><?=__('领取优惠券')?></a> </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
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
  <div class="sstouch-asset-info">
    <div class="container voucher"> <i class="icon"></i>
      <dl class="rule">
        <dd><?=__('请输入已获得的优惠券卡密领取优惠券')?></dd>
        <dd><?=__('领取优惠券后可以在购买商品下单时选择符合使用条件的优惠券抵扣订单金额')?></dd>
      </dl>
    </div>
  </div>
  <div class="sstouch-inp-con">
    <form action="" method ="">
      <ul class="form-box">
        <li class="form-item">
          <h4><?=__('优惠券卡密')?></h4>
          <div class="input-box">
            <input type="text" id="pwd_code" name="pwd_code" class="inp" maxlength="20" placeholder="<?=__('请输入20位店铺优惠券卡密号')?>" oninput="writeClear($(this));" onfocus="writeClear($(this));"/>
            <span class="input-del"></span> </div>
        </li>
        <li class="form-item">
          <h4><?=__('验&nbsp;证&nbsp;码')?></h4>
          <div class="input-box">
            <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="<?=__('输入4位验证码')?>" oninput="writeClear($(this));"/>
            <span class="input-del code"></span><a href="javascript:void(0)" id="refreshcode" class="code-img"><img border="0" id="codeimage" name="codeimage"></a>
            <input type="hidden" id="codekey" name="codekey" value="">
          </div>
        </li>
      </ul>
      <div class="error-tips"></div>
      <div class="form-btn"><a href="javascript:void(0);" class="btn" id="saveform"><?=__('确认提交')?></a></div>
    </form>
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/voucher_pwex.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
