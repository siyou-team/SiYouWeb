<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=__('附近的店铺')?></title>
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

        .store-bars{
            height: 40px;
            padding: 8px 10px;
        }
        .store-bars.white{
            background: #FFFFFF;
        }
        .store-bars .back-ico{
            width: 28px;
            height: 28px;
            background: url(../../images/near/icon/ic_store_top_back@2x.png) no-repeat;
            background-size:100% ;

            font-family: zc;
            font-size: 2.4rem;


            display: block;
            float: left;
        }
        .store-bars.white .back-ico{
            background: url(../../images/near/icon/ic_store_top_back_white@2x.png) no-repeat;
            background-size:100% ;
        }

        .store-bars .collect{
            width: 28px;
            height: 28px;
            background: url(../../images/near/icon/ic_store_top_star@2x.png) no-repeat;
            background-size:100% ;
            display: block;
            float: right;
            margin-right: 10px;
        }
        .store-bars .collect.active{
            background: url(../../images/near/icon/ic_store_top_star_pressed@2x.png) no-repeat;
            background-size:100% ;
        }
        .store-bars.white .collect{
            background: url(../../images/near/icon/ic_store_top_star_white@2x.png) no-repeat;
            background-size:100% ;
        }
        .store-bars.white .collect.active{
            background: url(../../images/near/icon/ic_store_top_star_white_pressed@2x.png) no-repeat;
            background-size:100% ;
        }
        .store-bars .suggest{
            width: 28px;
            height: 28px;
            background: url(../../images/near/icon/ic_store_top_edit@2x.png) no-repeat;
            background-size:100% ;
            display: block;
            float: right;
        }
        .store-bars.white .suggest{
            background: url(../../images/near/icon/ic_store_top_edit_white@2x.png) no-repeat;
            background-size:100% ;
        }
    </style>
</head>

<body>
<div id="app">
    <header class="am-header-fixed store-bars">
        <a href="javascript:history.go(-1);" class="back-ico"></a>

        <!--shop/complaints.html-->
        <a href="/index/index/storecomplaints?storeid=2143" class="suggest"></a>
        <a class="star" v-if="!starOn" @click="collect"></a>

        <a href="javascript:void(0)" class="collect active" v-if="starOn == true" @click="collect"></a>
        <a href="javascript:void(0)" class="collect"  v-else  @click="collect"></a>
    </header>
    <div class="pro-detail-container">
        <div class="pro-detail-item">
            <div data-am-widget="slider" class="am-slider am-slider-a1" data-am-slider='{&quot;directionNav&quot;:false}'>
                <ul class="am-slides baguetteBox" >
                    <li>
                        <a href="../../images/1521013838gtng4892.jpeg"><img src="../../images/1521013838gtng4892.jpeg"></a>
                    </li>
                    <li>
                        <a href="../../images/1521013838gtng4892.jpeg"><img src="../../images/1521013838gtng4892.jpeg"></a>
                    </li>
                </ul>
                <a href="./storealbum.html?storeid=1869&from=singlemessage&isappinstalled=1" class="a_ic_store" style="display: none">
                    <div class="ic_store">
                        <span class="ic_count"><?=__('1张')?></span>
                    </div>
                </a>

            </div>
            <div class="am-g pro-txt">
                <div class="am-u-sm-8 text-overflow"><?=__('佳艺石材')?></div>
                <div class="am-u-sm-4 text-right gray-more">09:30-20:00</div>
            </div>



            <div class="store-intro-star am-g">
                <div class="am-u-sm-10">

                    <!--  quan -->
                    <i class="icon icon-jude zc zc-start active"></i>
                    <!--  quan -->
                    <i class="icon icon-jude zc zc-start active"></i>
                    <!--  quan -->
                    <i class="icon icon-jude zc zc-start active"></i>
                    <!--  quan -->
                    <i class="icon icon-jude zc zc-start active"></i>
                    <!--  quan -->
                    <i class="icon icon-jude zc zc-start active"></i>

                    &nbsp;&nbsp;
                    5.0 <?=__('分')?><span class="gray">&nbsp;0 <?=__('人')?><?=__('评分')?></span>
                </div>

                <div class="am-u-sm-2"></div>
            </div>
            <div class="store-intro-star am-g c-666">
                <div class="am-u-sm-4"><?=__('442位消费者')?></div>
                <div class="am-u-sm-4 text-center"><?=__('141人浏览')?></div>
                <div class="am-u-sm-4 text-right"><?=__('63人消费')?></div>
            </div>
            <div class="store-address-row">
                <div class="store-address gray">

                        <span>

                          <?=__('  配送费5.50元')?>
                        </span>

                </div>

            </div>

            <div class="store-address-row">


                <div class="gray">
                    <a href="http://m.amap.com/share/index/__q=22.578395,113.883697,牛牛汇&src=jsapi&callapp=0&lnglat=113.883697,22.5783958&name=佳艺石材" class="gray-more"> <i class="icon icon-address"></i> </a>
                </div>
                <a href="http://m.amap.com/share/index/__q=22.578395,113.883697,牛牛汇&src=jsapi&callapp=0&lnglat=113.883697,22.5783958&name=佳艺石材" class="store-address  c-666"> <div class=""><?=__('宝安区流塘路口国安居建材市场一楼A006')?></div> </a>



                <!--  <div class="store-address-row">
                     <div class="gray">
                         <i class="icon icon-address"></i>
                     </div>
                     <div class="store-address gray">
                         广东省深圳市南山区软件园一期 1栋3楼广东省深圳市南山区软件园一期 1栋3楼
                     </div>
                     <div>
                         <a href="login.html"><i class="am-icon-phone am-icon-md red"></i></a>
                     </div>
                 </div> -->

                <div class="am-fr">
                    <a href="tel:18902762909"><i class="am-icon-phone am-icon-md red" style="border-left: 1px solid #ddd; padding-left: 10px;"></i></a>
                </div>
            </div>

        </div>
        <div class="pro-detail-item  am-g">
            <div class="pro-line"></div>
            <div class="am-u-sm-4"><i class="icon icon-stop  icon-no-stop"></i>&nbsp;  <?=__('免费停车')?></div>
            <div class="am-u-sm-4 text-center"><i class="icon icon-wifi    icon-no-wifi "></i>&nbsp;<?=__('免费wifi')?></div>
            <div class="am-u-sm-4 text-right"><i class="icon icon-truck  icon-no-truck "></i>&nbsp;<?=__('免费送货')?></div>
        </div>
        <div class="pro-detail-item am-g">
            <div class="am-u-sm-6" style="margin-top: 5px;">
                <span class="red"><?=__('送75%牛豆')?></span>             </div>
            <div class="am-u-sm-6 text-right">
                <a href="./setpayamount.html?business_code=44351&dev_type=wap&p_type=" class="topay"><?=__('优惠付款')?></a>
            </div>
        </div>
        <div class="pro-detail-item">
            <div class="am-g  store-intro-title">
                <div class="am-u-sm-12"><?=__('购买须知')?></div>
                <!-- <div class="am-u-sm-2 text-right"><a href="login.html" class="gray"><i class="icon-right"></i></a></div> -->
            </div>
            <div class="foot-slide" style="color: #999;">
                <?=__('大理石乃天然产物，因此，成品的石纹及颜色可能与样板差异。易碎物品，货物交收后，恕不退货，敬请谅解。')?>            </div>
        </div>


        <div class="pro-detail-item">


            <div class="am-g  store-intro-title">
                <a href="./store_item_list.html?store_id=1869">
                    <div class="am-u-sm-10" style="color: #333;"><?=__('全部商品')?>(2)</div>
                    <div class="am-u-sm-2 text-right"><i class="icon-right"></i></div>
                </a>
            </div>


            <!--<div class="foot-slide">
                <div class="slide-box">
                    <img src="img/food1.png" />
                    <div class="gray text-overflow">提拉米苏草莓蛋糕123123</div>
                </div>
                <div class="slide-box">
                    <img src="img/food2.png" />
                    <div class="gray text-overflow">魔方白果香双层123123</div>
                </div>
                <div class="slide-box">
                    <img src="img/food3.png" />
                    <div class="gray text-overflow">提拉米苏草莓蛋糕123123</div>
                </div>
                <div class="slide-box">
                    <img src="img/food1.png" />
                    <div class="gray text-overflow">魔方白果香双层3123123</div>
                </div>
            </div>-->

            <div class="recom-list">
                <div class="one-recom">
                    <a href="/StoBusiness/Index/setpayamount?storeid=1869&amount=0&business_code=44109">
                        <div class="am-fl"><img
                                src="https://nnhtest.oss-cn-shenzhen.aliyuncs.com/nnh/images/2017-12-17/1513504512zmpt4058.jpeg?x-oss-process=image/resize,m_fill,w_300,h_300"/>
                        </div>
                        <div class="am-fl">
                            <div class="recom-good-name tl-ellipsis"><?=__('种植发际线，发际线调整(1200毛囊)')?></div>

                        </div>
                        <div class="clear"></div>
                    </a>
                </div>
                <div class="one-recom">
                    <a href="/StoBusiness/Index/setpayamount?storeid=1869&amount=0&business_code=44109">
                        <div class="am-fl"><img
                                src="https://nnhtest.oss-cn-shenzhen.aliyuncs.com/nnh/images/2017-12-17/1513503691kczc8724.jpeg?x-oss-process=image/resize,m_fill,w_300,h_300"/>
                        </div>
                        <div class="am-fl">
                            <div class="recom-good-name tl-ellipsis"><?=__('植发际线100毛囊100元')?></div>

                        </div>
                        <div class="clear"></div>
                    </a>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
  $(function(){
    baguetteBox.run('.baguetteBox', {
      //buttons: true,
      captions:true,
      animation: 'fadeIn'

    });

    $(window).scroll(function() {

      if( $(window).scrollTop()>40){
        $(".store-bars").addClass("white");
      }else{
        $(".store-bars").removeClass("white");
      }
    });
    $("#collect").on("click",function(){
      //如果已收藏
      if($(this).hasClass("active")){
        //取消收藏
        $(this).removeClass("active");
        toast("取消收藏成功");
      }else{
        //添加收藏
        $(this).addClass("active");
        toast("收藏成功");
      }
    });
  });
</script>
<div class="download-bar">
    <div class="close-box">
        <a href="javascript:void(0)">
            <img src="../../images/near/icon/download_close@2x.png" />
        </a>
    </div>
    <div class="bar-content">
        <div class="logo-box"><img src="../../images/near/icon/LOGO2.png" /></div>
        <div class="bar-desc">
            <div>
                <div><?=__('你买单，我送钱')?></div>
                <div><?=__('赶快下载')?><label class="red"><?=__('牛牛汇')?></label><?=__('手机客户端')?></div>
            </div>
            <a href="http://a.app.qq.com/o/simple.jsp?pkgname=com.ynh.nnh.tt"><?=__('点击下载')?></a>
        </div>

    </div>
</div>
<script>
  $(function(){
    $(".download-bar .close-box a").click(function(){
      $(this).parent().parent().fadeOut();
    });
  });
</script>
<script>
  new Vue({
    el:'#app',
    data:{
      curTab:0,
      starOn:"",
      storeid:"2143",
      maxPage:0,
      switchShow:false,
      page:1,
      indexgoodslist:[],
    },
    mounted:function(){


    },
    methods:{

      collect:function(){
        var _this=this;

        if(!_this.starOn){

          //_this.starOn=!_this.starOn;
          _this.addCollection();
        }else{
          //_this.starOn=!_this.starOn;
          _this.cancelCollection();
        }

      },
      addCollection:function(){
        var _this=this;

        _this.$http.post('/user/index/addCollection',{
          obj_id:_this.storeid,
          type:3
        }).then(
          function (res) {
            // 处理成功的结果
            //console.log(res);

            data = eval("("+res.body+")");

            if(data.code=='200'){
              _this.starOn=!_this.starOn;
              layer.open({
                content:'<?=__('收藏成功！')?>',
                skin: 'msg',
                time: 2
              });
            }else{
              layer.open({
                content: data.msg,
                skin: 'msg',
                time: 2
              });
              return false;
            }

          },function (res) {
            // 处理失败的结果
            layer.open({
              content: '<?=__('加载数据错误！请重新请求')?>',
              skin: 'msg',
              time: 2
            });
          }
        );
      },
      cancelCollection:function(){
        var _this=this;

        _this.$http.post('/user/index/cancelCollection',{
          obj_id:_this.storeid,
          type:3
        }).then(
          function (res) {
            // 处理成功的结果
            //console.log(res);

            data = eval("("+res.body+")");

            if(data.code=='200'){
              _this.starOn=!_this.starOn;
              layer.open({
                content:'<?=__('取消成功！')?>',
                skin: 'msg',
                time: 2
              });
            }else{
              layer.open({
                content: data.msg,
                skin: 'msg',
                time: 2
              });
              return false;
            }

          },function (res) {
            // 处理失败的结果
            layer.open({
              content: '<?=__('加载数据错误！请重新请求')?>',
              skin: 'msg',
              time: 2
            });
          }
        );
      }
    },directives: { // 自定义指令
      scroll: {
        bind: function(el, binding) {
          window.addEventListener('scroll', function() {
            if(document.body.scrollTop + window.innerHeight+20 >= el.clientHeight) {
              var fnc = binding.value;
              fnc();
            }
          })
        }
      }
    }

  });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
