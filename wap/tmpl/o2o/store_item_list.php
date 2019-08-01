<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html style="height: 100%;">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=__('深圳青逸植发')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
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

        .store-addr{height: 3.8rem;line-height: 3.8rem;padding: 0 14px;border-bottom: 1px solid #EEEEEE;position: relative;}
        .store-addr .icon-address{  position: relative;top: 5px; margin-right: 9px;}
        .store-addr .p-split{right: 58px;position: absolute;border-left: 0.5px solid #ddd;height: 25px;top: 5px;}
        .store-goods-wrap{position: absolute;top: 3.8rem;width: 100%;bottom: 0;right: 0;    overflow: hidden;}
        .store-goods-wrap .left-menu{width:95px;position: absolute;bottom: 0;right: 0;left: 0;top: 0;overflow: auto;height: 100%;background: #EEEEEE;}
        .left-menu .menu{background: #EEEEEE;height:4.2rem;line-height: 4.2rem;padding-left: 1.4rem;border-left: 2px solid transparent;}
        .left-menu .menu.active{background: #FFFFFF;border-left: 2px solid #F13437;}
        .left-menu .menu a{color: #333333;width: 100%;display: inline-block;}
        .left-menu .menu.active a{color: #F13437;}
        .store-goods-wrap .right-content{-ms-touch-action:none;position: absolute;bottom: 0;right: 0;left: 95px;top: 0;overflow: hidden;}

        .one-class .c-name{background: #fef5f5;padding-left: 9px;height: 2.4rem;line-height: 2.4rem;}
        .one-class .c-name h4{padding-left: 9px;position: relative;font-weight: normal;}
        .one-class .c-name h4:after{content: '';position: absolute;height:16px ;top: 4px;left: 0;border-left: 3px solid #F13437;}

        .pos-a{}
        .one-c-good{position: relative;margin: 9px 12px 0 9px;border-bottom: 1px solid #EEEEEE;padding-bottom: 9px;height: 7.4rem;z-index: 999;}
        .one-c-good a{color: #333333;}
        .one-c-good:last-child{border-bottom: 0;}
        .one-c-good img{width: 9.5rem;height: 6.3rem;}
        .one-c-good .c-good-name{position: absolute;left: 10.4rem;top: 0;}
        .one-c-good .c-good-price{position: absolute;left: 10.4rem;bottom: 9px;}

        .foodlistwrap{
            transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1);
            transition-duration: 0ms;

        }
    </style>
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
            background:url(http://image.niuniuhuiapp.com/mobile/img/icon/ic_store_top_picture@2x.png) no-repeat;
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

<body style="overflow: hidden;">
<header class="page-header" >
    <div class="page-bar">
        <a href="javascript:history.go(-1)">
            <span class="back-ico"></span>
        </a>
        <span class="bar-title"><?=__('深圳青逸植发')?></span>
    </div>
</header>

<div class="store-addr" >
    <a class="gray" href="http://m.amap.com/share/index/__q=22.542053,114.114524,深圳青逸植发&src=jsapi&callapp=0&lnglat=114.114524,22.5420538&name=深圳青逸植发"><i class="icon icon-address"></i><?=__('世界金融中心A座首层青逸植发')?></a><span class="p-split"></span><a href="tel:13682692783"><i class="am-icon-phone am-icon-md red" style="float: right;"></i></a>
</div>
<div class="store-goods-wrap" style="margin-top: 45px;">
    <div class="left-menu" id="left-menu">
        <div class="menu" id="menu-0" data-key="0">
            <span class="tl-ellipsis"><?=__('毛发种植')?></span>
        </div>



    </div>
    <div class="right-content">
        <div id="mainwrap">
            <div class="foodlistwrap" style="transform: translate(0px, 0px) translateZ(0px);">
                <!--分类商品-->
                <div class="one-class" id="list-0" data-tagid="0">
                    <div class="c-name">
                        <h4><?=__('毛发种植')?></h4>
                    </div>
                    <div class="c-goods-wrap">

                        <div class="one-c-good">
                            <a href="/StoBusiness/Index/setpayamount?storeid=1869&amount=0&business_code=44109">
                                <div class="am-fl"><img src="https://nnhtest.oss-cn-shenzhen.aliyuncs.com/nnh/images/2017-12-17/1513504512zmpt4058.jpeg?x-oss-process=image/resize,m_fill,w_300,h_200" /></div>
                                <div class="am-fl">


                                    <div class="c-good-name tl-ellipsis"><?=__('种植发际线，发际线调整(1200毛囊)')?></div>

                                </div>
                            </a>
                            <div class="clear"></div>
                        </div>

                        <div class="one-c-good">
                            <a href="/StoBusiness/Index/setpayamount?storeid=1869&amount=0&business_code=44109">
                                <div class="am-fl"><img src="https://nnhtest.oss-cn-shenzhen.aliyuncs.com/nnh/images/2017-12-17/1513503691kczc8724.jpeg?x-oss-process=image/resize,m_fill,w_300,h_200" /></div>
                                <div class="am-fl">


                                    <div class="c-good-name tl-ellipsis"><?=__('植发际线100毛囊100元')?></div>

                                </div>
                            </a>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/end分类商品-->




        </div>
    </div>
    <!--/end分类商品-->
</div>
</div>
</div>
</div>

<script type="text/javascript">
  $(function(){
    /*			$(".menu").click(function(){
                    $(this).addClass("active").siblings().removeClass("active");
                });*/

    $(".menu").click(function(){
      var _key=$(this).data("key");
      //对应右侧列表距离顶部位置的高度
      var slideY= $("#list-"+_key).offset().top.toFixed(2);

      var translates = $(".foodlistwrap").css("transform");
      //var translateX=parseFloat(translates.substring(7).split(',')[4]);
      var translateY=parseFloat(translates.substring(7).split(',')[5]);
      //38的地址栏高度
      translateY=translateY-slideY+38;
      $(".foodlistwrap").css({
        "transition-timing-function": "cubic-bezier(0.1, 0.57, 0.1, 1)",
        "transition-duration": "600ms",
        "transform":  "translate(0px,"+translateY+"px)"
      });

      $(this).addClass("active").siblings().removeClass("active");
    });

    $(".one-c-good a").on("touchend",function(){
      window.location.href=$(this).attr('href');
    });

  });
</script>

<script>
  //全局变量，触摸开始位置
  var startX = 0, startY = 0;

  //touchstart事件
  function touchSatrtFunc(evt) {

    evt.stopPropagation();
    evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等

    var touch = evt.touches[0]; //获取第一个触点
    var x = Number(touch.pageX); //页面触点X坐标
    var y = Number(touch.pageY); //页面触点Y坐标
    //记录触点初始位置
    startX = x;
    startY = y;

  }

  //touchmove事件，这个事件无法获取坐标
  function touchMoveFunc(evt) {

    evt.stopPropagation();
    evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
    var touch = evt.touches[0]; //获取第一个触点
    var x = Number(touch.pageX); //页面触点X坐标
    var y = Number(touch.pageY); //页面触点Y坐标

    //判断滑动方向
    // x - startX != 0 左右滑动
    //y - startY != 0 上下滑动


    var translates = $(".foodlistwrap").css("transform");
    var translateX=parseFloat(translates.substring(7).split(',')[4]);
    var translateY=parseFloat(translates.substring(7).split(',')[5]);

    /*if(-translateY+$(".right-content").height()>$(".foodlistwrap").height()){
        translateY=-($(".foodlistwrap").height()-$(".right-content").height());
    }*/

    var tY=translateY+(y-startY);
    if(tY>0){
      tY=0;
    }
    if(-tY+$(".right-content").height()>$(".foodlistwrap").height()){
      tY=-($(".foodlistwrap").height()-$(".right-content").height());
    }

    //滚动
    $(".foodlistwrap").css({
      "transition-timing-function": "cubic-bezier(0.1, 0.57, 0.1, 1)",
      "transition-duration": "600ms",
      "transform":  "translate(0px,"+tY+"px)"
    });

  }

  //touchend事件
  function touchEndFunc(evt) {

    evt.stopPropagation();
    evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等

    $(".foodlistwrap").css({
      "transition-timing-function": "cubic-bezier(0.1, 0.57, 0.1, 1)",
      "transition-duration": "0ms"

    });

    var translates = $(".foodlistwrap").css("transform");
    //var translateX=parseFloat(translates.substring(7).split(',')[4]);
    var translateY=parseFloat(translates.substring(7).split(',')[5]);

    var hMin=0;
    var hMax=0;
    $(".one-class").each(function(idx,ele){
      //累计tag 高度
      hMax+=$(ele).height();
      //滑动结束，translateY 的值在当前tag 区域内
      if(-translateY>=hMin&&-translateY<hMax){
        //获取左侧菜单对应id
        var tagid=$(ele).data("tagid");
        //左侧菜单对应选中
        $("#menu-"+tagid).addClass("active").siblings().removeClass("active");
        //循环终止
        return false;
        /*return false：将停止循环 (就像在普通的循环中使用 'break')。
         * return true：跳至下一个循环(就像在普通的循环中使用'continue')。*/

      }else{
        //不在区域，最小区域值变大
        hMin=hMax;
      }
    });


  }


  //绑定事件
  function bindEvent() {
    var rightWrap=document.getElementById("mainwrap");
    rightWrap.addEventListener('touchstart', touchSatrtFunc, false);
    rightWrap.addEventListener('touchmove', touchMoveFunc, false);
    rightWrap.addEventListener('touchend', touchEndFunc, false);

  }

  bindEvent();
</script>
</body>

</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
