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
<meta name="format-detection" content="telephone=no"/>
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title><?=__('重新设置密码')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('重新设置密码')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="login.html" class="text"><?=__('登录')?></a> </div>
  </div>
</header>
<div class="sstouch-main-layout fixed-Width">
  <div class="register-mobile-tip">
    <p><?=__('重新设置密码')?></p>
  </div>
  <div class="sstouch-inp-con">
    <form action="" method ="">
      <ul class="form-box">
        <li class="form-item">
          <h4><?=__('密&#12288;&#12288;码')?></h4>
          <div class="input-box">
            <input type="text" placeholder="<?=__('请输入6-20位密码')?>" class="inp" name="password" id="password" oninput="writeClear($(this));"/>
            <span class="input-del"></span></div>
        </li>
      </ul>
      <div class="remember-form">
        <input id="checkbox" type="checkbox" checked="">
        <label for="checkbox"><?=__('显示密码')?></label>
      </div>
      <div class="error-tips"></div>
      <div class="form-btn"><a href="javascript: void(0);" class="btn" id="completebtn"><?=__('完成')?></a></div>
    </form>
  </div>
  <input type="hidden" name="referurl">
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/find_password_password.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
