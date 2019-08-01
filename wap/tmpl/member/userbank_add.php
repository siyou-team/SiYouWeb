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
    <title><?=__('添加银行卡信息')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
</head>
<body>
<header id="header">
    <div class="header-wrap">
        <div class="header-l"> <a href="userbank_list.html"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('添加银行卡信息')?></h1>
        </div>
        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-save save"></i></a> </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <form id="#userBank-form">
        <div class="sstouch-inp-con">
            <ul class="form-box">
                <li class="form-item">
                    <h4><?=__('选择银行')?>:</h4>
                    <div class="input-box">
                        <span class='inp-black' style="padding: 0.1rem 0.5rem;height: 100%;line-height: 100%;width: 100%;">
                                        <select id="bank_id" name="bank_id" style="height: 1.75rem;">
                                            <option value="" disabled selected><?=__('选择银行名称')?></option>
                                        </select>
                        </span>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('开户支行')?></h4>
                    <div class="input-box">
                        <input type="text" class="inp" name="user_bank_card_address" id="user_bank_card_address" placeholder="<?=__('请输入开户支行')?>" autocomplete="off" oninput="writeClear($(this));"/>
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('银行卡卡号')?></h4>
                    <div class="input-box">
                        <input type="tel" class="inp" name="card_code" id="user_bank_card_code" placeholder="<?=__('请输入银行卡卡号')?>" autocomplete="off" oninput="writeClear($(this));"/>
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('持卡人姓名')?></h4>
                    <div class="input-box">
                        <input type="text" class="inp" name="user_bank_card_name" id="user_bank_card_name" placeholder="<?=__('请输入持卡人姓名')?>" autocomplete="off" oninput="writeClear($(this));">
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('预留手机号')?></h4>
                    <div class="input-box">
                        <input type="text" class="inp" name="user_bank_card_mobile" id="user_bank_card_mobile" placeholder="<?=__('请输入预留手机号')?>" autocomplete="off" oninput="writeClear($(this));">
                        <span class="input-del"></span> </div>
                </li>
            </ul>
            <div class="error-tips"></div>
            <div class="form-btn"><a class="btn" id="J_submit" href="javascript:void (0);"><?=__('保存')?></a></div>
        </div>
    </form>
</div>
<footer id="footer" class="bottom"></footer>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/userbank_add.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
