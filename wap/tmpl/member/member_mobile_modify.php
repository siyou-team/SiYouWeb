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
<title><?=__('修改手机验证')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
	<div class="header-wrap">
		<div class="header-l">
			<a href="member_account.html">
				<i class="zc zc-back back"></i>
			</a>
		</div>
		<div class="header-title">
			<h1><?=__('修改手机验证')?></h1>
		</div>
	</div>
</header>
<div class="sstouch-main-layout">
<div class="register-mobile-tip"> <?=__('您当前使用的手机号码是')?><em id="mobile"></em></div>
  <div class="sstouch-inp-con">
    <form action="" method ="">
    <ul class="form-box">
      <li class="form-item">
        <h4><?=__('验&nbsp;证&nbsp;码')?></h4>
        <div class="input-box">
          <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="<?=__('输入图形验证码')?>" oninput="writeClear($(this));"/>
          <span class="input-del code"></span> <a href="javascript:void(0)" id="refreshcode" class="code-img"><img border="0" id="codeimage" name="codeimage"></a>
          <input type="hidden" id="codekey" name="codekey" value="">
        </div>
      </li>
      <li class="form-item">
        <h4><?=__('动&nbsp;态&nbsp;码')?></h4>
        <div class="input-box">
          <input type="text" id="auth_code" name="auth_code" class="inp" value="" maxlength="11" placeholder="<?=__('输入短信动态验证码')?>" oninput="writeClear($(this));" onfocus="writeClear($(this));" pattern="[0-9]*" />
          <span class="input-del code"></span>
          <span class="code-countdown" style=" display: none;">
            <p>（<?=__('等待')?><em>59</em><?=__('秒后）')?></p><p><?=__('重新获取验证码')?></p>
            </span>
          <span class="code-again" style=""><a id="send" href="javascript: void(0);"><?=__('获取短信验证')?></a></span>
          </div>
      </li>
    </ul>
    <div class="error-tips"></div>
    <div class="form-btn"><a href="javascript:void(0);" class="btn" id="nextform"><?=__('下一步')?></a></div>
    </form>
    <div class="register-mobile-tip hide"><a href="member_paypwd_input.html"><?=__('通过支付密码来验证')?></a></div>
    <div class="register-mobile-tip"> <?=__('小提示：通过手机验证后，可用于快速找回登录密码及支付密码，接收账户金额变更等提醒。')?></div>
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/member_mobile_modify.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
