<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1"/>
    <title><?=__('邀请获取奖励')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
    <script>
        function oCopy(obj)
        {
            obj.select();
            if (!!window.ActiveXObject || "ActiveXObject" in window)
            {
                js = obj.createTextRange();
                js.execCommand("Copy")
                alert(<?=__("复制成功!")?>);
            }
            else
            {
                alert(<?=__('在“您的邀请链接”文本框上全选后，选择“复制”后，发送到您的朋友圈里吧！')?>);
            }
        }
    </script>
</head>
<body>
<header id="header">
    <div class="header-wrap">
        <div class="header-l"><a href="plantform_invite.html"><i class="zc zc-back back"></i></a></div>
        <span class="header-tab"><a href="javascript:void(0);" class="cur"><?=__('邀请获取奖励')?></a><a href="member_invite1.html"><?=__('推广收入')?></a></span>
        <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i
                class="zc zc-more more"></i><sup></sup></a></div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"><span class="arrow"></span>
          <ul>
              <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
              <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
              <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
              <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
              <li><a href="../cart_list.html"><i class="zc zc-cart cart"></i><?=__('购物车')?><sup></sup></a></li>
              <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
          </ul>
        </div>
    </div>
</header>
<div class="sstouch-main-layout feedback">
    <div class="sstouch-asset-info">
        <div class="container voucher"><i class="icon"></i>
            <dl class="rule" style="margin: 0 0.5rem 0 0;">
                <dd><?=__('分享二维码，成功邀请粉丝注册商城')?></dd>
                <dd><?=__('当粉丝在商城产生消费时，即可获得市场推荐奖励。')?></dd>
            </dl>
        </div>
    </div>
    <div style="font-size: 16px; padding: 10px; margin-top:10px;text-align: center;">
        <?=__('您的邀请二维码')?>：
    </div>

    <div style="width:200px;margin:0 auto; padding-bottom:10px;text-align: center;">
        <a href="javascript:;" id="download_url" title="<?=__('保存二维码')?>"><img id="qrcode" style="width:200px; height:200px"/></a><!--点击二维码可以保存哦-->
    </div>

    <div class="hide">
    <div style="font-size: 16px; text-align: center; padding: 10px; text-align: center;">
        <?=__('您的邀请链接')?>：
    </div>
    <textarea id="invite_url" onclick="oCopy(this)" class="textarea"
              style="height: 1rem; font-size: 0.6rem;"></textarea>
    <div style="text-align: center;"><?=__('请在上面的文本框上“全选-复制”，记得到朋友圈推广邀请哦')?></div>
    </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/member_invite.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
