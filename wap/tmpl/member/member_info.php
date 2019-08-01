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
    <title><?=__('基本信息')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
</head>
<body>
<header id="header" class="app-no-fixed">
    <div class="header-wrap">
        <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('基本信息')?></h1>
        </div>
        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-save save"></i></a> </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <form>
        <div class="sstouch-inp-con">
            <ul class="form-box">
                <li class="form-item">
                    <h4><?=__('ID号：')?></h4>
                    <div class="input-box">
                        <input type="text" readonly class="inp no-follow" id="user_id" name="user_id" autocomplete="off"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('账号：')?></h4>
                    <div class="input-box">
                        <input type="text" readonly class="inp no-follow" id="user_account" name="user_account" autocomplete="off"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('昵称：')?></h4>
                    <div class="input-box">
                        <input type="text"  class="inp no-follow" id="user_nickname" name="user_nickname" autocomplete="off"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4  style="height:4rem;line-height: 4rem;"><?=__('头像：')?></h4>
                    <div class="input-box"  style="height:4rem;line-height: 4rem;">
                        <div class="sstouch-upload" style="width:4rem;height: 4rem; border:0px;">
                            <a href="javascript:void(0);">
                <span>
                  <input type="file"  hidefocus="true" size="1" class="input-file no-follow" id="file_011" name="upfile" style="line-height: 4rem;">
                </span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden"  class=" no-follow" name="user_avatar" id="user_avatar" value="">
                        </div>
                    </div>
                </li>
                <li class="form-item hide">
                    <h4><?=__('性别：')?></h4>
                    <div class="input-box">
                        <label>
                            <input type="radio" class="inp" name="g_state" value=1 checked>&nbsp;男&nbsp;
                            <input type="radio" class="inp" name="g_state" value=0 >&nbsp;女
                            <span class="input-del"></span>
                        </label>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('生日：')?></h4>
                    <div class="input-box">
                        <input name="user_birthday" type="tel" class="inp no-follow" id="user_birthday" autocomplete="off"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('签名：')?></h4>
                    <div class="input-box">
                        <input type="text" class="inp no-follow" name="user_sign" id="user_sign" autocomplete="off">
                        <span class="input-del"></span>
                    </div>
                </li>

            </ul>
            <div class="error-tips"></div>
            <div class="form-btn ok"><a class="btn" href="javascript:;"><?=__('保存信息')?></a></div>
        </div>
    </form>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/member_info.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
