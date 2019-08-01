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
    <title>favourite</title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/index.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_products_list.css">
    <style>
        .sstouch-home-top {display: block;z-index: 2;background-color: #f7f7f7;overflow: hidden;}
        .appheader {height: 1rem;text-align: center;margin: 1rem 0;width: 98%;overflow: hidden;}
        .appheader-img{float: right;width: 0.8rem;margin: .2rem;}
        .footnav ul li i {vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .tarbul{vertical-align: top;display: inline-block;width: 1rem;height: 1rem;margin: 0 auto .1rem;font-size: 1rem;color: #888;}
        .img-all{float: left;margin: .2rem 1rem;width: .8rem;}
        .appheader-tit{font-size:.8rem;color:#E4E4E4;}
        .appheader-edit{float:right;margin:.2rem 1rem;font-size:.5rem}
        .sstouch-main-layout{margin:1rem;}
        .list .goods-secrch-list .goods-name {display: block;height: 2.4rem;line-height: 1.2rem;overflow: hidden;text-align: right;margin-right: 1rem;}
        .list .goods-secrch-list .goods-sold {float: right;height: 2rem;line-height: 3.6rem;font-size: .8rem;}
        .list .goods-secrch-list .goods-assist {display: block;height: 2rem;padding-bottom: .2rem;overflow: hidden;}
        .list .goods-secrch-list .goods-info {border-bottom:0;}
        .list .goods-secrch-list .goods-item {margin-bottom: .5rem;border-radius: .5rem;}
        .list .goods-secrch-list .goods-price {font-size: 1.3rem;float: right;margin-right: 1.3rem;}
        .goods-desc{display: inline-block;margin-left: .38rem;color:#d3d3d3;}
    </style>
    <link rel="apple-touch-icon" href="../../images/touch-icon-iphone.png"/>
</head>
<body>
<div class="sstouch-home-top fixed-Width">
    <div class="appheader">
        <b>Favourites</b>
        <a href="../../tmpl/search.html"><img class="appheader-img" src="../../images/app-index/search.png" /></a>
        <img class="appheader-img" src="../../images/app-index/share.png" />
    </div>
</div>
<div class="sstouch-home-top fixed-Width">
    <div class="appheader">
        <img src="../../images/app-index/all.png"  class="img-all"/>
        <span class="appheader-tit">just updated</span>
        <span class="appheader-edit"><b>Edit</b></span>
    </div>
</div>
<div class="sstouch-main-layout ">
    <div id="product_list" class="list">
        <ul class="goods-secrch-list" id="favorites_list">
        </ul>
    </div>
</div>
<script type="text/html" id="sfavorites_list">
    <%if(items.length>0){%>
    <% for (var k in items) { var v = items[k]; %>
    <li class="goods-item"  id="favitem_<%=v.favorites_item_id %>">
				<span class="goods-pic">
					<a id="goods_pic5" href="../../tmpl/product_detail.html?item_id=<%=v.item_id %>">
						<img src="<%=$image_thumb(v.product_image, 240) %>">
					</a>
				</span>
        <dl class="goods-info">
            <dt class="goods-name">
                <a href="">
                    <h3><%=v.product_item_name %></h3>
                </a>
            </dt>
            <dd class="goods-name">
                            <span class="goods-sold">
                                from
                            </span>
            </dd>
        </dl>
        <p><span class="goods-desc">No price change</span> <span class="goods-price"><b>$<%=v.item_unit_price %></b></span></p>
    </li>


<!---->
<!--    <li class="goods-item" id="favitem_<%=v.favorites_item_id %>">-->
<!--        <a href="../../tmpl/product_detail.html?item_id=<%=v.item_id %>">-->
<!--            <span class="goods-pic"><img src="<%=$image_thumb(v.product_image, 240) %>"/></span>-->
<!--            <dl class="goods-info"><dt class="goods-name"><h4><%=v.product_item_name %></h4></dt>-->
<!--            </dl>-->
<!--            <dd class="goods-sale">-->
<!--                <span class="goods-price">￥<em><%=v.item_unit_price %></em></span>-->
<!--            </dd>-->
<!--        </a>-->
<!--        <a href="javascript:void(0);" shopsuite_type="fav_del" data_id="<%=v.favorites_item_id %>" class="fav-del"></a>-->
<!--    </li>-->
    <%}%>
    <li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>
    <%}else{%>
    <div class="sstouch-norecord favorite-goods">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您还没有关注任何商品')?></dt>
            <dd><?=__('可以去看看哪些商品值得收藏')?></dd>
        </dl>'
        <a href="../../index.html" class="btn"><?=__('随便逛逛')?></a>
    </div>
    <%}%>
</script>
<footer id="footer" >
</footer>
<script> var navigate_id ="2";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/favorites.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript">
    $(function(){
        $.ajax({
            type: "get",
            url: SiteUrl +"/index.php?ctl=Index&met=suggesition&typ=json",
            dataType:'json',
            success: function(res){
                var pdata=res.data.items;
                var apx = new Vue({
                    el     : '#app',
                    data(){
                        return{
                            pdata
                        }
                    }
                });
                suggest()
            }
        });
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
