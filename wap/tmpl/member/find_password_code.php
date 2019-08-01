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
<title><?=__('提交验证码')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('提交验证码')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="login.html" class="text"><?=__('登录')?></a> </div>
  </div>
</header>
<div class="sstouch-main-layout fixed-Width">
  <div class="register-mobile-tip">
    <p id="user_mobile" class="hide channel_type"><?=__('请输入')?><em></em><?=__('收到的短信验证码')?></p>
    <p id="user_email" class="hide channel_type"><?=__('请输入')?><em></em><?=__('收到的邮箱验证码')?></p>
    <p id="user_not_bind" class="hide channel_type"><?=__('未绑定手机或邮箱')?></p>
  </div>
  <div class="sstouch-inp-con">
    <form action="" method ="">
      <ul class="form-box mt5">
        <li class="form-item">
          <h4><?=__('动&nbsp;态&nbsp;码')?></h4>
          <div class="input-box">
            <input type="text" pattern="[0-9]*" placeholder="请输入短信动态验证码！" class="inp" name="mobilecode" id="mobilecode" oninput="writeClear($(this));"/>
            <span class="input-del code"></span> <span class="code-countdown" style=" display: none;">
            <p><?=__('重新获取验证码')?></p>
            <p>(<em>59</em>s)</p>
            </span> <span class="code-again"><a href="javascript: void(0);" id="send"><?=__('再次短信获取')?></a></span> </div>
        </li>
      </ul>
      <div class="error-tips"></div>
      <div class="form-btn"><a href="javascript:void(0);" class="btn" id="find_password_code"><?=__('下一步')?></a></div>
    </form>
  </div>
  <input type="hidden" name="referurl">
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>

<script type="text/javascript" src="../../js/tmpl/find_password_code.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
