
<?php
include __DIR__ . '/includes/header.php';
?>

<!doctype html>
<html lang="zh-CN" >
<head>
    <meta charset="UTF-8">
    <title>所有店铺</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/sstouch_products_list.css">
    <link rel="stylesheet" type="text/css" href="css/sstouch_member.css">
    <link rel="stylesheet" type="text/css" href="css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="css/sstouch_products_detail.css" />

    <style type="text/css">
        .sstouch-footer-wrap {
            margin: 0 auto;
            max-width: 640px;
        }

        .sstouch-inp-con ul li h4 {
            width: 4.6rem;
            text-align: left
        }

        .sstouch-inp-con ul li h4 i {
            background-image: url("images/location_b.png");
            background-position: 50% 50%;
            background-repeat: no-repeat;
            background-size: 80% auto;
            display: block;
            height: 0.9rem;
            position: absolute;
            right: 0.2rem;
            top: 0.55rem;
            width: 0.8rem;
            z-index: 1;
        }

        .sstouch-order-search {
            position: relative;
        }

        .sstouch-inp-con ul li .input-box .input-del {
            display: block;
        }

        .sstouch-inp-con ul li .input-box {
            margin: 0 0.5rem 0 4.4rem
        }
    </style>


    <style type="text/css">
        body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
        #baidu_map{height:100%;width:100%;}
        #r-result,#r-result table{width:100%;}
    </style>
</head>
<body>
<header id="header" class="fixed fixed-Width">
    <div class="header-wrap">
        <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
        <div class="header-tab"><a href="shop.html" class="cur">所有店铺</a><a href="shop_class.html">店铺分类</a></div>
        <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a></div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"><span class="arrow"></span>
            <ul>
                <li><a href="index.html"><i class="zc zc-home home"></i>首页</a></li>
                <li><a href="tmpl/search.html"><i class="zc zc-search search"></i>搜索</a></li>
                <li><a href="tmpl/product_first_categroy.html"><i class="zc zc-categroy categroy"></i>分类</a></li>
                <li><a href="tmpl/cart_list.html"><i class="zc zc-cart cart"></i>购物车<sup></sup></a></li>
                <li><a href="javascript:void(0);"><i class="zc zc-message message"></i>消息<sup></sup></a></li>
                <li><a href="tmpl/member/member.html"><i class="zc zc-member member"></i>我的商城</a></li>
            </ul>
        </div>
    </div>
</header>


<div class="sstouch-main-layout fixed-Width">

    <!--
    <div class="goods-search-list-nav">
        <ul id="nav_ul" style="width:100%;">
            <li  style="width:25%;"><a href="javascript:void(0);" onclick="init_get_list('default', '')" class="current">默认排序</a></li>
            <li  style="width:25%;"><a href="javascript:void(0);"  onclick="init_get_list('or', 'collect')" class="">收藏量</a></li>
            <li  style="width:25%;"><a href="javascript:void(0);"  onclick="init_get_list('plat', 1)">平台自营</a></li>
            <li  style="width:25%;"><a href="javascript:void(0);"  onclick="init_get_list('near', 1)">附近的店铺</a></li>
        </ul>
    </div>
    -->


    <div class="sstouch-inp-con o2o-enable">
        <ul class="form-box">
            <li class="form-item">
                <h4 style="width: 4rem;">我的位置：<i></i></h4>
                <div class="input-box">
                    <input name="district_info" type="text" class="inp" id="district_info" autocomplete="off"
                           placeholder="选择所在地区" readonly/>
                    <span class="input-del"></span>
                </div>
            </li>
        </ul>
    </div>

    <div class="sstouch-order-search">
        <span><input type="text" oninput="writeClear($(this));" id="keyword" name="keyword" placeholder="输入店铺名称"
                     maxlength="50" autocomplete="on">
        <span class="input-del"></span></span>
        <input type="button" value="&nbsp;" id="serach_store">
    </div>
    <ul class="favorites-store-list" id="categroy-cnt"></ul>

</div>
<div id="mapholder" style="width:500px;height:500px;"></div>

<footer id="footer"></footer>

<input type="hidden" name="key" value="4">
<input type="hidden" name="order" value="1">
<input type="hidden" name="page" value="10">
<input type="hidden" name="curpage" value="1">
<input type="hidden" name="hasmore">
<input type="hidden" name="store_category_id" value="">

<script type="text/html" id="category-one">
    <%if(items.length>0){%>
    <% for (var k in items) { var v = items[k]; %>
    <li id="favitem_<%=v.store_id %>">
        <div class="store-avatar" style="width: 3rem;height: 3rem;top:.22rem;"><img src="<%=v.store_logo %>"/></div>
        <dl class="store-info" style="margin-left: 4rem;">
            <a href="tmpl/store.html?store_id=<%=v.store_id %>"><dt class="store-name" style="font-size: 0.6rem;"><%=v.store_name %> <span style="right: 3.5rem;position: absolute;font-size: 0.4rem;"></span>  <span style="right: 0.5rem;position: absolute;font-size: 0.4rem;"><%=v.store_category_name %> &nbsp; <% if(v.store_opening_hours){ %><%=v.store_opening_hours %>-<%=v.store_close_hours %><% } %> </span> </dt></a>
            <dd class=""><span>粉丝：<em><%= v.store_favorite_num ? v.store_favorite_num : 0 %></em>人</span></dd>

            <a href="javascript:void(0);" class="store_map" data-long="<%= v.store_longitude %>" data-lat="<%= v.store_latitude %>"><dd><span><% if(!isEmpty(v.distance)&&v.distance<1000) {%><em><%=v.distance %> 米</em><%}%><% if(!isEmpty(v.distance)&&v.distance>=1000) {%><em><%=distance(v.distance) %> 公里</em><%}%> <i> <% if (v.store_address){%><i class="zc zc-shouhuodizhi1" style="font-size: 14px;"></i> <%=v.store_address %><% } %> </i>&nbsp;</span></dd></a>
        </dl>
    </li>
    <%}%>
    <li class="loading"><div class="spinner"><i></i></div>数据读取中</li>
    <%}else{%>
    <style type="text/css">.pagination {
        display: none;
    }</style>
    <div class="sstouch-norecord favorite-store">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt>没有店铺</dt>
            <dd>可以去看看其它的吧</dd>
        </dl>
        <a href="./index.html" class="btn">随便逛逛</a>
    </div>
    <%}%>
    <div id="map-wrappers" class="sstouch-full-mask hide">
        <div class="sstouch-full-mask-bg"></div>
        <div class="sstouch-full-mask-block">
            <div class="header transparent"  style="display: block;">
                <div class="header-wrap">
                    <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
                </div>
            </div>
            <div class="sstouch-map-layout">
                <div id="baidu_map" class="sstouch-map"></div>

                <div id="r-result"></div>
            </div>
        </div>
    </div>
</script>
<script> var navigate_id = "1";</script>
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/libs/lib.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<script type="text/javascript" src="js/shop.js"></script>
<script type="text/javascript" src="js/tmpl/footer.js"></script>
</body>
</html>

<?php
include __DIR__ . '/includes/footer.php';
?>
