<?php
include __DIR__ . '/../includes/header.php';
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
    <title><?=__('语言切换')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_member.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
    <style>
        .sstouch-home-block {width: 100%;clear: both;margin-top: 4rem;}
        .categroy-child-list{margin: 0 1rem;background-color: #fff;}
        .categroy-child-list dt i {display:block;float:right;display:none;width:1rem;height: 1rem;margin-top: 1rem;}
        .categroy-child-list dt i img{width:100%;}
        .categroy-child-list dt a {display: block;width: 96%;height: 3rem;padding: 0 0 0 .1rem;font-size: .6rem;line-height: 1.6rem;color: #111;}
        .point{margin-top: 1rem;width: 1rem;margin-left: 1rem;}
        .app-myspan{display: inline-block;border-bottom: 1px solid #f5f5f5;width: 68%;line-height: 3rem;font-size: .65rem;margin-left: 1rem;}
    </style>
</head>

<body>
<header id="header" class="app-no-fixed">
    <div class="header-wrap">
        <div class="header-l"> <a href="./setting.php"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('语言切换')?></h1>
        </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <ul class="sstouch-language-list" id="languageList">
        <li>
            <div class="image"></div>
            <div class="language"></div>
        </li>
        <li>
            <div class="image"></div>
            <div class="language"></div>
        </li>
        
    </ul>
</div>
<div class="sstouch-home-block item-goods">
    <dl class="categroy-child-list">
        <dt data-lang="zh-CN">
            <a href="##"><img class="point" src="../images/app-index/cn.png">
                <div class="app-myspan"><?=__('简体中文')?>
                    <i><img src="../images/app-index/dui.png"></i>

                </div>
            </a>
        </dt>
        <dt data-lang="it">
            <a href="##">
                <img class="point" src="../images/app-index/it.png">
                <div class="app-myspan"><?=__('意大利文')?>
                    <i><img src="../images/app-index/dui.png"></i>
                </div>
            </a>
        </dt>
        <dt  data-lang="en" style="display: none;">
            <a href="##">
                <img class="point" src="../images/app-index/en.png">
                <div class="app-myspan">
                    <?=__('英文')?>
                    <i><img src="../images/app-index/dui.png"></i>

                </div>
            </a>
        </dt>
    </dl>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
<script>
$(".categroy-child-list dt").click(function(){
    var lang=$(this).data('lang');
    addCookie('language',lang,1);
    console.log(lang);
    $(this).siblings('dt').find('i').hide();
    $(this).find('i').show();
});
$(".categroy-child-list dt").each(function(i){
    if ($(this).data('lang') == getCookie('language')){
        $(this).find('i').show();
    }
});
</script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>
