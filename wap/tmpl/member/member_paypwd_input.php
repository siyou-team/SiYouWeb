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
<title><?=__('输入支付密码')?></title>
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
			<h1><?=__('输入支付密码')?></h1>
		</div>
	</div>
</header>
<div class="sstouch-main-layout">
  <div class="sstouch-inp-con">
    <form action="" method ="">
    <ul class="form-box">
      <li class="form-item">
        <h4><?=__('支付密码')?></h4>
        <div class="input-box">
          <input type="password" id="password" name="password" maxlength="20" size="10" class="inp" autocomplete="off" placeholder="<?=__('输入支付密码')?>" oninput="writeClear($(this));"/>
        </div>
      </li>
      <li class="form-item">
        <h4><?=__('验&nbsp;证&nbsp;码')?></h4>
        <div class="input-box">
          <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="<?=__('输入图形验证码')?>" oninput="writeClear($(this));"/>
          <span class="input-del code"></span> <a href="javascript:void(0)" id="refreshcode" class="code-img"><img border="0" id="codeimage" name="codeimage"></a>
          <input type="hidden" id="codekey" name="codekey" value="">
        </div>
      </li>
    </ul>
    <div class="error-tips"></div>
    <div class="form-btn"><a href="javascript:void(0);" class="btn" id="nextform"><?=__('提交')?></a></div>
    </form>
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/member_paypwd_input.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
