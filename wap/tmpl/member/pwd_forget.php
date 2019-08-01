<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
    <meta charset="UTF-8">
    <title><?=__('找回密码')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/member.css">
</head>
<body>
        <header id="header" class="layout">
		<div class="header-wrap">
			<a href="javascript:history.back();" class="header-back"><span><?=__('返回')?></span></a>
				<h2><?=__('忘记密码')?></h2>
			<span class="btn"><?=__('完成')?></span>
		</div>
		</header>
        <div class="layout-640">
            <div class="pwd_forgetwarp">
                <div class="item item1">
                    <input id="telephone" type="tel" class="phone" value="" placeholder="<?=__('手机号')?>" tip="<?=__('手机号')?>" need="" telephone="">
                    <a href="javascript:void(0)" class="getckcode" id="getckcode"><?=__('获取验证码')?></a>
                    <div class="getckcode getckcode2"><?=__('23秒')?></div>
                </div>
                <div class="item item100 item1">
                    <input id="ckcode" type="number" class="ckcode" value="" placeholder="<?=__('输入收到的验证码')?>" need="" disabled="" tip="验证码">
                </div>
                <div class="item item100 item1">
                    <a href="javascript:void(0)" class="next"><?=__('下一步')?></a>
                </div>
                <div class="item item100 item2">
                    <input id="password" type="password" class="ckcode" value="" placeholder="<?=__('输入新密码')?>" tip="<?=__('密码')?>" need="" min="6">
                </div>
                <div class="item item100 item2">
                    <input id="repassword" type="password" class="ckcode" value="" placeholder="<?=__('再次输入新密码')?>" tip="<?=__('两次输入不同')?>" sameto="password">
                </div>
                <div class="item item100 item2">
                    <a href="javascript:void(0)" class="btn_editpwd" id="btn_editpwd"><?=__('修改密码')?></a>
                </div>

            </div>
        </div>
    <div class="footer" id="footer"></div>
    <input type="hidden" name="referurl">
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
    <script type="text/javascript" src="../../js/tmpl/common-top.js"></script>

    <script type="text/javascript" src="../../js/tmpl/pwd_forget.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
