<?php
//$user_id = Zero_Perm::getUserId();
$app=$_GET['isapp'];
if($user_id){
    header("Location: /wap/tmpl/seller/seller.php?isapp=".$app);
}else{
    header("Location: /wap/tmpl/member/login.php?isapp=".$app);
}
//确保重定向后，后续代码不会被执行
exit;
include __DIR__ . '/includes/header.php';
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
    <title><?=__('触屏版')?></title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="css/swiper.min.css">
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .sstouch-home-top {
            display: block;
            min-height: 3.9rem;
            z-index: 2;
            background-color: #f7f7f7;
            overflow: hidden;
            box-shadow: 1px 2px 9px #d6d2d2;
        }
        .appheader{
            text-align: center;
            display: flex;
            justify-content: space-between;
            height: 2rem;
            overflow: hidden;
        }
        .appheader_logo{
            width: 5rem;
            height: 100%;
        }
        .sicon {
            float: left;
            width: .8rem;
            margin: .3rem .2rem;

        }
        .appsearch {
            position: relative;
            display: block;
            height: 1.5rem;
           /* border: .05rem solid #DEDEDE;*/
            border-radius: .2rem;
            margin: 0 1rem;
            color: #BBB;
            line-height: 1.5rem;
            background-color: #efeeee;
            text-align: left;
        }
        .searchs-input {
            float: left;
            font-size: .65rem;
            display: inline-block;
            line-height: 1.5rem;
        }
        .sys_icon{
            width: 1rem;
            margin: .5rem 1rem;
        }
        .sstouch-home-block .tit-bar {
            height: 50px;
        }
        .goods-title1{
            color:black;
            font-size: .9rem;
            float: left;
            margin-left: .8rem;
        }
        .goods-title2{
            color: #0b76ac;
            float: right;
            margin-right: 1rem;
            font-size: 0.6rem;
        }
        .item-goods ul.goods-list {
            font-size: 0;
            padding-bottom: .5rem;
            white-space: nowrap;
        }
        .item-goods ul.goods-list li {
            width: 32%;
        }
        .item-goods ul.goods-list li a {
            display: block;
            height: 100%;
        }
        .item-goods ul.goods-list li:nth-child(odd) {
            margin: 0 0 0 .8rem;
            width: 5.5rem;
            overflow: hidden;
            height: 8.5rem;
        }
        .item-goods ul.goods-list li:nth-child(even) {
            margin: 0 0 0 .8rem;
            width: 5.5rem;
            overflow: hidden;
            height: 8.5rem;
        }
        .item-goods ul.goods-list li dd.goods-price {
            float:right;
            margin-right:.2rem;
            border-top: none;
            color: red;
            font-size: .5rem;
            padding-top: 0;
            margin-top: 0;
        }
        .item-goods ul.goods-list li dt.goods-name {
            white-space: normal;
            font-size: 0.5rem;
            text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;
        }
        .goods-info .goods-name {
            display: block;
            font-size: .65rem;
            color: #000;
            height: 1.6rem;
        }
        .footnav ul li i {vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .sstouch-home-block{overflow:hidden;}
        .goods-pic {height: 5.5rem;overflow: hidden;}
        .goods-pic img {height:100%;}
        footer{ z-index:999}
        .swiper{box-sizing: border-box;position: relative;overflow: hidden;}
        .swiper-container {margin-top: .5rem;margin-bottom: .5rem;overflow: visible!important;}
        .swiper-container .swiper-wrapper .swiper-slide img{width: 100%;height: 7rem;border-radius: 5px;}

        .swiper-pagination{bottom: -30px!important;}
        [v-cloak]{display:none}
    </style>
    <link rel="apple-touch-icon" href="images/touch-icon-iphone.png"/>
</head>
<body>
<div class="sstouch-home-top fixed-Width">
    <div class="appheader">
        <div style="height: 1.6rem;margin: .2rem 1rem;">
            <img src="./images/app-index/xiyou.png" class='appheader_logo' >
        </div>
        <div style="    height: 100%;">
            <img src="./images/app-index/sys.png" class="sys_icon" />
        </div>
    </div>
    <div style="    margin-top: 0.2rem;">
        <a href="tmpl/search.html" class="appsearch">
            <img src="./images/app-index/search.png" class="sicon" />
            <span class="searchs-input" id="">Search...</span>
        </a>
    </div>
</div>
<!--轮播图-->
<div class="swiper" style="margin-top: .1rem">
    <div class="swiper-container adv_list" id="main-container1">

        <div class="swiper-wrapper">
            
        </div>

    </div>
</div>
<!--商品推荐-->
<div class="sstouch-home-block" >
    <div class="tit-bar style1">
        <b><div class="goods-title1">Suggesition for you </div></b>
        <a href="./tmpl/product_list.html"><div class="goods-title2">Show all</div></a>
    </div>
    <div class="sstouch-home-block item-goods" id="app" v-cloak>
        <ul class="goods-list suggest"   style="background-color: #F0F0F0" >
            <li   v-for="item in suggesition">
                <a :href="'tmpl/product_detail.html?product_id='+item.product_id">
                    <div class="goods-pic"><img :src="item.product_image" alt=""></div>
                    <dl class="goods-info">
                        <dt class="goods-name" v-text="item.product_name"></dt>
                        <dd class="goods-price" v-text="item.product_unit_price"></dd>
                    </dl>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--热销-->
<div class="sstouch-home-block">
    <div class="tit-bar style1">
        <b><div class="goods-title1">Top Deals  </div></b>
        <a href="./tmpl/product_list.html"><div class="goods-title2">Show all</div></a>
    </div>
    <div class="sstouch-home-block item-goods" id="topd" v-cloak>
        <ul class="goods-list top-deals " style="background-color: #F0F0F0">
            <li v-for="item in topdeals">
                <a :href="'tmpl/product_detail.html?product_id='+item.product_id">
                    <div class="goods-pic"><img :src="item.product_image" alt=""></div>
                    <dl class="goods-info">
                        <dt class="goods-name" v-text="item.product_name"></dt>
                        <dd class="goods-price" v-text="item.product_unit_price"></dd>
                    </dl>
                </a>
            </li>
        </ul>
    </div>
</div>
<script type="text/html" id="adv_list">
    <div class="swiper-wrapper">
        <% for (var i in item) { %>
        <div class="swiper-slide">
            <a href="<%= item[i].data %>">
                <img src="<%= item[i].image %>"/>
            </a>
        </div>
        <% } %>
    </div>
</script>
<footer id="footer"></footer>
<script> var navigate_id ="1";</script>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/libs/lib.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/libs/swipe.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/tmpl/footer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.2/js/swiper.min.js"></script>
<script type="text/javascript" src="js/vue.min.js"></script>
<script src="js/iscroll.js"></script>
</body>
</html>

<?php
include __DIR__ . '/includes/footer.php';
?>
