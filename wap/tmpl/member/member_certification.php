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
            <h1><?=__('实名认证')?></h1>
        </div>
        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-save save"></i></a> </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <form>
        <div class="sstouch-inp-con">
            <ul class="form-box">
                <li class="form-item">
                    <h4  style="width:4rem;"><i style="color: red;">*</i><?=__('真实姓名：')?></h4>
                    <div class="input-box" style="margin-left: 4rem;">
                        <input type="text"  class="inp no-follow" id="user_realname" name="user_realname" autocomplete="off"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4  style="width:4rem;"><i style="color: red;">*</i><?=__('身份证号码：')?></h4>
                    <div class="input-box" style="margin-left: 4rem;">
                        <input type="text"  class="inp no-follow" id="user_idcard" name="user_idcard" autocomplete="off"/>
                    </div>
                </li>
                <li class="form-item">
                    <h4  style="width:4rem;height:4rem;line-height: 4rem;"><i style="color: red;">*</i><?=__('身份证正面：')?></h4>
                    <div class="input-box"  style="height:4rem;line-height: 4rem;margin-left: 4rem;">
                        <div class="sstouch-upload" style="width:4rem;height: 4rem; border:0px;">
                            <a href="javascript:void(0);">
                                <span>
                                  <input type="file"  hidefocus="true" size="1" class="input-file no-follow" id="file_0" name="upfile"  style="line-height: 4rem;">
                                </span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden"  class=" no-follow" name="user_idcard_images[]" id="user_idcard_images_0" value="">
                        </div>
                    </div>
                </li>
                <li class="form-item">
                    <h4  style="width:4rem;height:4rem;line-height: 4rem;"><i style="color: red;">*</i><?=__('身份证反面：')?></h4>
                    <div class="input-box"  style="height:4rem;line-height: 4rem;margin-left: 4rem;">
                        <div class="sstouch-upload" style="width:4rem;height: 4rem; border:0px;">
                            <a href="javascript:void(0);">
                                <span>
                                  <input type="file"  hidefocus="true" size="1" class="input-file no-follow" id="file_1" name="upfile"  style="line-height: 4rem;">
                                </span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden"  class=" no-follow" name="user_idcard_images[]" id="user_idcard_images_1" value="">
                        </div>
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

<script type="text/javascript" src="../../js/tmpl/member_certification.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
