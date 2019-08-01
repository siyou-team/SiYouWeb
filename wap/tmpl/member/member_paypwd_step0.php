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
    <title><?=__('更改密码')?></title>
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
            <h1><?=__('更改支付密码')?></h1>
        </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <div class="register-mobile-tip"> <?=__('支付密码由 6-20个大小写英文字母、符号或数字组成')?></div>
    <div class="sstouch-inp-con">
        <form action="" method ="" id="form-name">
            <ul class="form-box">
                <li class="form-item" id="old_pay_password_box">
                    <h4><?=__('原密码')?></h4>
                    <div class="input-box">
                        <input type="password" id="old_pay_password" name="old_pay_password" maxlength="20" size="10" class="inp" autocomplete="off" placeholder="<?=__('输入原支付密码')?>" oninput="writeClear($(this));"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('新密码')?></h4>
                    <div class="input-box">
                        <input type="password" id="new_pay_password" name="new_pay_password" maxlength="20" size="10" class="inp" autocomplete="off" placeholder="<?=__('输入新支付密码')?>" oninput="writeClear($(this));"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('确认密码')?></h4>
                    <div class="input-box">
                        <input type="password" id="pay_password1" name="password" class="inp" maxlength="20" placeholder="<?=__('再次输入新支付密码')?>" oninput="writeClear($(this));" onfocus="writeClear($(this));" />
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

<script type="text/javascript" src="../../js/tmpl/member_paypwd_step0.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>