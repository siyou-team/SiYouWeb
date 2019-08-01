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
<title><?=__('编辑收货地址')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="address_list.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('编辑收货地址')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-save save"></i></a> </div>
  </div>
</header>
<div class="sstouch-main-layout">
  <form>
    <div class="sstouch-inp-con">
      <ul class="form-box">
        <li class="form-item">
          <h4><?=__('收货人姓名')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="true_name" id="true_name" autocomplete="off" oninput="writeClear($(this));"/>
            <span class="input-del"></span> </div>
        </li>
        <li class="form-item">
          <h4><?=__('联系手机')?></h4>
          <div class="input-box">
            <input type="tel" class="inp" name="mob_phone" id="mob_phone" autocomplete="off" oninput="writeClear($(this));"/>
            <span class="input-del"></span> </div>
        </li>
        <li class="form-item">
          <h4><?=__('地区选择')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="district_info" id="district_info" autocomplete="off" onchange="btn_check($('form'));" readonly/>
          </div>
        </li>
        <li class="form-item">
          <h4><?=__('详细地址')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="address" id="address" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span> </div>
        </li>
        <li class="form-item">
          <h4><?=__('邮政编码')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="ud_postalcode" id="ud_postalcode" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span> </div>
        </li>
        <li>
          <h4><?=__('默认地址')?></h4>
          <div class="input-box">
            <label>
              <input type="checkbox" name="is_default" id="is_default" value="1" />
              <span class="power"><i></i></span> </label>
          </div>
        </li>
      </ul>
      <div class="error-tips"></div>
      <div class="form-btn ok"><a class="btn" href="javascript:;"><?=__('保存地址')?></a></div>
    </div>
  </form>
</div>
<footer id="footer" class="bottom"></footer>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/address_opera_edit.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
