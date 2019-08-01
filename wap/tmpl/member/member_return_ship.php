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
<title><?=__('退款详情')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <span class="header-title">
    <h1><?=__('退款详情')?></h1>
    </span> </div>
</header>
<div class="sstouch-main-layout">
  <div class="special-tips">
    <p><?=__('发货')?><span id="delayDay"></span><?=__('天后，当商家选择未收到则要进行延迟时间操作；如果超过')?><span id="confirmDay"></span><?=__('天不处理按弃货处理，直接由管理员确认退款。')?></p>
  </div>
  <form>
    <div class="sstouch-inp-con">
      <ul class="form-box">
        <li class="form-item">
          <h4><?=__('物流公司')?></h4>
          <div class="input-box">
            <select id="express" class="select" name="express_id ">
            </select>
            <i class="arrow-down"></i> </div>
        </li>
        <li class="form-item">
          <h4><?=__('物流单号')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="invoice_no" placeholder="请填写物流单号">
          </div>
        </li>
      </ul>
    </div>
    <a class="btn-l mt5 mb5"><?=__('确认发货')?></a>
  </form>
</div>
<footer id="footer"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/member_return_ship.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
