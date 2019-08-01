<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="cn" >
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
    <title>products</title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/index.css">
    <style>
        .sstouch-home-top {display: block;min-height: 3.9rem;z-index: 2;background-color: #f7f7f7;overflow: hidden;}
        .sstouch-home-block {width: 100%;clear: both;margin-top: .5rem;}
        .appheader {height: 2rem;text-align: center;margin-top: 1rem;width: 98%;}
        .sicon {float: left;width: .8rem;margin: .3rem .2rem;}
        .appsearch {position: relative;display: block;height: 1.4rem;border: .05rem solid #DEDEDE;border-radius: .2rem;margin: 0 1rem;color: #BBB;line-height: 1.5rem;background-color: #F3F3F3;text-align: left;}
        .sys_icon{float: right;width:.8rem;margin: .3rem .2rem;}
        .sstouch-home-block .tit-bar {height: 50px;}
        .goods-title1{color:black;font-size: 1rem;float: left;margin-left: 1rem;}
        .item-goods ul.goods-list {font-size: 0;padding-bottom: .5rem;white-space: nowrap;}
        .item-goods ul.goods-list li {width: 32%;}
        .item-goods ul.goods-list li:nth-child(odd) {margin: 0 0 0 1rem;width: 5rem;overflow: hidden;height: 8rem;}
        .item-goods ul.goods-list li:nth-child(even) {margin: 0 0 0 1rem;width: 5rem;overflow: hidden;height: 8rem;}
        .item-goods ul.goods-list li dt.goods-name {white-space: normal;font-size: 0.5rem;}
        .goods-info .goods-name {display: block;font-size: .65rem;color: #000;height: 1.6rem;text-align: center;}
        .footnav ul li i {vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .tarbul{vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .categroy-child-list{margin: 0 1rem;background-color: #fff;}
        .categroy-child-list dt i {width: .4rem;height: .4rem;vertical-align: middle;display: inline-block;border-radius: .2rem;margin-right: .4rem;}
        .categroy-child-list dt a {display: block;width: 96%;height: 1.8rem;padding: 0 0 0 .1rem;font-size: .6rem;line-height: 1.8rem;color: #111;}
        .point{margin:0.5rem;}
        .categroy-child-list dt i.arrow-r {display: block;width: .6rem;height: .6rem;font-size: 1rem;color: #212121;float: right;margin: 0rem .5rem 0 0;opacity: .4;}
    </style>
    <link rel="apple-touch-icon" href="../images/touch-icon-iphone.png"/>
</head>
<body>
<div class="sstouch-home-top fixed-Width">
    <div class="appheader"><b>Products</b></div>
    <div style="height:2rem;">
        <a href="search.html" class="appsearch">
            <img src="../../images/app-index/search.png" class="sicon" />
            <span class="searchs-input" id="keyword">Search...</span>
            <img src="../../images/app-index/sys.png" class="sys_icon" />
        </a>
    </div>
</div>
<div class="sstouch-home-layout fixed-Width">
    <div class="sstouch-home-block">
        <div class="tit-bar style1">
            <b><div class="goods-title1">Top Deals  </div></b>
        </div>
        <div class="sstouch-home-block item-goods" id="topd">
            <ul class="goods-list  huadong" style="background-color: #F0F0F0">
                <li v-for="item in data">
                    <a :href="'tmpl/product_detail.html?product_id='+item.product_id">
                        <div class="goods-pic"><img :src="item.product_image"  alt=""></div>
                        <dl class="goods-info">
                            <dt class="goods-name">{{item.product_name}}</dt>
                        </dl>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="sstouch-home-layout fixed-Width" id="main-container2">
    <div class="sstouch-home-block">
        <div class="tit-bar style1">
            <b><div class="goods-title1">Complete Catalogue  </div></b>
        </div>

          <div class="sstouch-home-block item-goods" id="categorytop">
            <dl class="categroy-child-list">
                <dt v-for="item in data">
                  <a :href="'product_list.html?category_id='+item.category_id">
                    <img class='point' :src="item.category_image" style="width:30px;"> {{item.category_name}}
                    <i class="zc zc-arrow-r arrow-r"></i>
                  </a>
                </dt>

            </dl>
          </div>

    </div>
</div>
<!--<footer  >-->
    <!--<div  class="footnav clearfix">-->
        <!--<ul>-->
          <!--<li>-->
              <!--<a href="../index.html"><img class="tarbul" src="../images/app-index/home1.png" alt=""><p>Highlighs</p></a>-->
          <!--</li>-->
          <!--<li>-->
              <!--<a href="member/favorites.html"><img class="tarbul" src="../images/app-index/like.png" alt=""><p>Favourites</p></a>-->
          <!--</li>-->
          <!--<li >-->
              <!--<a href="product_first_categroy.html" class="current"><img class="tarbul" src="../images/app-index/products1.png" alt=""><p>Products</p></a>-->
          <!--</li>-->
          <!--<li>-->
              <!--<a href="member/member.html"><img class="tarbul" src="../images/app-index/ren.png" alt=""></span><p>My xiyou</p></a>-->
          <!--</li>-->
        <!--</ul>-->
    <!--</div>-->
<!--</footer>-->
<footer id="footer">
</footer>
<script> var navigate_id ="4";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/vue.min.js"></script>
<script src="../js/iscroll.js"></script>
<script type="text/javascript">
$(function(){
    $.ajax({
          type: "get",
          url: SiteUrl+"/index.php?ctl=Product&met=lists&typ=json",
          dataType:'json',
          success: function(res){
              var data=res.data.items;
              var top = new Vue({
              el  : '#topd',
              data(){
                return{
                    data
                }
              }
              });
              huadong();
          }
    });
  $.ajax({
        type: "get",
        url: SiteUrl+"/index.php?ctl=Product&met=category&typ=json",
        dataType:'json',
        success: function(res){
            var data=res.data.items;
            var category = new Vue({
            el     : '#categorytop',
            data(){
              return{
                  data
              }
            }
            });
        }
  });
});
function huadong(){
    var ele = $(".huadong");
    ele.width((ele.find("li").length + 1) * (ele.find("li").width()+20));
    var myScroll = new IScroll('#topd', {eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false});
};
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>

