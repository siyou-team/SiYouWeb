<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=__('_店铺相册')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta name="author" content="talon">
    <meta name="application-name" content="niuniuhui-wap">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="format-detection" content="telephone=no" />

    <link rel="stylesheet" type="text/css" href="../../css/baguettebox.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/amazeui.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/near.css">

    <script type="text/javascript" src="../../js/config.js"></script>
    <script type="text/javascript" src="../../js/libs/lib.min.js"></script>
    <script type="text/javascript" src="../../js/libs/amazeui.min.js"></script>
    <script type="text/javascript" src="../../js/libs/baguettebox.min.js"></script>
    <script type="text/javascript" src="../../js/libs/vue.min.js"></script>
    <script type="text/javascript" src="../../js/libs/vue-resource.min.js"></script>
    <script type="text/javascript" src="../../js/libs/swipe.js"></script>
    <style>

        .album-wrap{
            padding: 9px 14px;
        }
        .album-wrap .am-u-sm-6{
            padding: 0;
            float: ;
        }
        .album-wrap .am-u-sm-6:last-child{
            float: left;
        }
        .album-wrap .one-store{
            margin-bottom: 9px;
        }
        .album-wrap  .am-u-sm-6:nth-child(even) .one-store{
            padding-left: 4.5px;
        }
        .album-wrap .am-u-sm-6:nth-child(odd) .one-store{

            padding-right: 4.5px;
        }
    </style>


    <script type="text/javascript">
      (function () {
        window.addEventListener("DOMContentLoaded",function(){
          var img_with=$(".one-store img").width();
          $(".one-store img").css({
            "height":0.625*img_with+'px'
          });
        },false);
      })();
      $(function(){
        $(window).resize(function(){
          var img_with=$(".one-store img").width();
          $(".one-store img").css({
            "height":0.625*img_with+'px'
          });
        });

        baguetteBox.run('.baguetteBox', {
          //buttons: true,
          animation: 'fadeIn'

        });
      });
    </script>

    <style type="text/css">
        .am-slider .am-slides img {
            display: block;
            width: 100vw;
            height: 66.67vw;
        }
        .a_ic_store{
            position: absolute;
            bottom: 10px;
            z-index: 100;
            right: 10px
        }
        .ic_store{
            background:url(../../images/near/icon/ic_store_top_picture@2x.png) no-repeat;
            background-size: 100%;
            width: 45px;
            height: 45px;
        }
        .ic_store .ic_count{
            font-size: 12px;
            position: absolute;
            bottom: 2px;
            right: 10px;
            color: #dedbdb;
        }
    </style>
</head>

<body>
<header class="page-header">
    <div class="page-bar">
        <a href="javascript:history.go(-1)">
            <span class="back-ico"></span>
        </a>
        <span class="bar-title"><?=__('深圳青逸植发')?></span>
    </div>
</header>

<div class="album-wrap">
    <div class="am-g album-list baguetteBox">
        <div class="am-u-sm-6">

            <div class="one-store">
                <a href="https://nnhtest.oss-cn-shenzhen.aliyuncs.com/nnh/images/2017-12-14/1513230316eeny2244.jpeg?x-oss-process=image/quality,q_80"><img src="https://nnhtest.oss-cn-shenzhen.aliyuncs.com/nnh/images/2017-12-14/1513230316eeny2244.jpeg?x-oss-process=image/quality,q_80" /></a>
            </div>

        </div>

    </div>
</div>

<!-- <a href="http://a.app.qq.com/o/simple.jsp?pkgname=com.ynh.nnh.tt"><div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default footer  am-g login-note" id="navbar">
 <img src="http://image.niuniuhuiapp.com/mobile/img/icon/LOGO2.png" class="am-u-sm-2" />
    <div class="footer-des flex-column am-u-sm-6">
        <div>你买单，我送钱</div>
        <div>赶快下载<label class="red">牛牛汇</label>手机客户端</div>
    </div>
    <div class="am-u-sm-4 text-right">
        <span class="download">点击下载</span>
    </div>
</div></a> -->


</body>

<!-- <script src="http://cdn.amazeui.org/amazeui/2.7.2/http://image.niuniuhuiapp.com/mobile/js/amazeui.min.js"></script> -->

</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
