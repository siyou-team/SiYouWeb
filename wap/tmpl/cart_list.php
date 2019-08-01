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
<title><?=__('购物车')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_cart.css"><link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
</head>
<body>
<header id="header" class="app-no-fixed">
	<div class="header-wrap">
		<div class="header-l">
			<a href="javascript:history.go(-1)">
				<i class="zc zc-back back"></i>
			</a>
		</div>
		<div class="header-title">
			<h1><?=__('购物车')?></h1>
		</div>
		<div class="header-r">
			<a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>
		</div>
	</div>
	<div class="sstouch-nav-layout">
		<div class="sstouch-nav-menu">
			<span class="arrow"></span>
      <ul>
        <li><a href="../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
        <li><a href="search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
        <li><a href="product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
        <li><a href="member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
      </ul>
		</div>
	</div>
</header>
<div class="sstouch-main-layout">
  <div id="cart-list-wp"></div>
</div>
<footer id="footer" class="bottom"></footer>
<div class="pre-loading">
  <div class="pre-block">
    <div class="spinner"><i></i></div><?=__('购物车数据读取中...')?>
  </div>
</div>

<div id="J_animationBox" class="sstouch-bottom-mask">
    <div class="sstouch-bottom-mask-bg"></div>
    <div class="sstouch-bottom-mask-block">
        <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
        <div class="sstouch-bottom-mask-top">
            <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
        </div>
        <div class="goods-detail sstouch-bottom-mask-rolling">
            <div class="goods-options-stock list" id="J_choosePro">
            </div>
        </div>
    </div>
</div>


<script id="activity_list" type="text/html">
    <% var StateCode = getStateCode();%>
    <% if(items && items.length >0){%>
    <% for (var i = 0;i<items.length;i++){%>
    <% if(items[i].cart_select == 1){%>

    <!-- 店铺加价购商品商品列表 start -->
    <% if (items[i].bargainDiv && items[i].bargainDiv.length>0) { %>
    <% for (var k = 0;k<items[i].bargainDiv.length;k++){ var bargainDiv = items[i].bargainDiv[k]; %>
    <ul class="goods-secrch-list activity-items-list-<%=bargainDiv.actId%>">
        <% if (bargainDiv.selecInfo && bargainDiv.selecInfo.length>0) {%>
        <% for (var j =0;j<bargainDiv.selecInfo.length;j++){ var selecInfo = bargainDiv.selecInfo[j] %>
        <li class="goods-item" item_id="<%=selecInfo.item_id%>">
            <span class="goods-pic">
                <a id="goods_pic<%=selecInfo.item_id%>" href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                    <img src="<%=$image_thumb(selecInfo.product_image, 360) %>">
                </a>
            </span>
            <dl class="goods-info">
                <dt class="goods-name">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                        <h4><%=selecInfo.product_item_name%></h4>
                        <h6><%=selecInfo.product_tips%></h6>
                    </a>
                </dt>
                <dd class="goods-sale">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                        <span class="goods-price">
                            ￥<em><%=selecInfo.item_sale_price%></em>
                        </span>
                    </a>
                </dd>
                <dd class="goods-assist">
                    <div class="add-cart" data-type="1" data-actid="<%=bargainDiv.actId%>" data-activity_item_id="<%=bargainDiv['activity_item_id']%>">
                        <a item_id="<%=selecInfo.item_id%>" href="javascript:void(0);"><i></i></a>
                    </div>
                </dd>
            </dl>
        </li>
        <% } %>
        <% } %>
    </ul>
    <% } %>
    <% } %>
    <!-- 店铺加价购商品列表 end -->
    <!-- 店铺赠品商品商品列表 start -->
    <% if (items[i].giftsDiv && items[i].giftsDiv.length>0) { %>
    <% for (var k = 0;k<items[i].giftsDiv.length;k++){ var giftsDiv = items[i].giftsDiv[k]%>
    <ul class="goods-secrch-list activity-items-list-<%=giftsDiv.actId%>">
        <% if (giftsDiv.selecInfo && giftsDiv.selecInfo.length>0) { %>
        <% for (var j =0;j<giftsDiv.selecInfo.length;j++){ var selecInfo = giftsDiv.selecInfo[j] %>
        <li class="goods-item" item_id="<%=selecInfo.item_id%>">
                        <span class="goods-pic">
                            <a id="goods_pic<%=selecInfo.item_id%>" href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                                <img src="<%=$image_thumb(selecInfo.product_image, 360) %>">
                            </a>
                        </span>
            <dl class="goods-info">
                <dt class="goods-name">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                        <h4><%=selecInfo.product_item_name%></h4>
                        <h6><%=selecInfo.product_tips%></h6>
                    </a>
                </dt>
                <dd class="goods-sale">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                                    <span class="goods-price">
                                        ￥<em><%=selecInfo.item_sale_price%></em>
                                    </span>
                    </a>
                </dd>
                <dd class="goods-assist">
                    <div class="add-cart" data-type="3" data-actid="<%=giftsDiv.actId%>" data-activity_item_id="<%=giftsDiv['activity_item_id']%>">
                        <a item_id="<%=selecInfo.item_id%>" href="javascript:void(0);"><i></i></a>
                    </div>
                </dd>
            </dl>
        </li>
        <% } %>
        <% } %>
    </ul>

    <% } %>
    <% } %>
    <!-- 店铺赠品商品列表 end -->

    <!-- 商品加价购商品列表 end -->
    <% for (var j = 0;j<items[i].items.length;j++){%>
    <% if(items[i].items[j].pulse_bargains && items[i].items[j].pulse_bargains.length>0 ) { %>
    <% for (var n = 0;n<items[i].items[j].pulse_bargains.length;n++){  var bargainDiv = items[i].items[j].pulse_bargains[n] %>
    <ul class="goods-secrch-list activity-items-list-<%=bargainDiv.actId%>">
        <% if (items[i].items[j].pulse_bargains[n].selecInfo && items[i].items[j].pulse_bargains[n].selecInfo.length >0) {%>
        <% for (var m = 0;m<items[i].items[j].pulse_bargains[n].selecInfo.length;m++){  var selecInfo = bargainDiv.selecInfo[m] %>
        <li class="goods-item" item_id="<%=selecInfo.item_id%>">
                        <span class="goods-pic">
                            <a id="goods_pic<%=selecInfo.item_id%>" href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                                <img src="<%=$image_thumb(selecInfo.product_image, 360) %>">
                            </a>
                        </span>
            <dl class="goods-info">
                <dt class="goods-name">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                        <h4><%=selecInfo.product_item_name%></h4>
                        <h6><%=selecInfo.product_tips%></h6>
                    </a>
                </dt>
                <dd class="goods-sale">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                                    <span class="goods-price">
                                        ￥<em><%=selecInfo.item_sale_price%></em>
                                    </span>
                    </a>
                </dd>
                <dd class="goods-assist">
                    <div class="add-cart" data-type="1" data-actid="<%=bargainDiv.actId%>" data-activity_item_id="<%=bargainDiv['activity_item_id']%>">
                        <a item_id="<%=selecInfo.item_id%>" href="javascript:void(0);"><i></i></a>
                    </div>
                </dd>
            </dl>
        </li>
        <% } %>
        <% } %>
    </ul>
    <% } %>
    <% } %>
    <% } %>
    <!-- 商品加价购商品列表 end -->
    <!-- 商品赠品商品列表 end -->
    <% for (var j = 0;j<items[i].items.length;j++){%>
    <% if(items[i].items[j].pulse_gift_cart && items[i].items[j].pulse_gift_cart.length>0){ %>
    <% for (var n = 0;n<items[i].items[j].pulse_gift_cart.length;n++){  var giftsDiv = items[i].items[j].pulse_gift_cart[n] %>
    <ul class="goods-secrch-list activity-items-list-<%=giftsDiv.actId%>">
        <% if(items[i].items[j].pulse_gift_cart[n].selecInfo && items[i].items[j].pulse_gift_cart[n].selecInfo.length>0) { %>
        <% for (var m = 0;m<items[i].items[j].pulse_gift_cart[n].selecInfo.length;m++){  var selecInfo = giftsDiv.selecInfo[m] %>
        <li class="goods-item" item_id="<%=selecInfo.item_id%>">
                        <span class="goods-pic">
                            <a id="goods_pic<%=selecInfo.item_id%>" href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                                <img src="<%=$image_thumb(selecInfo.product_image, 360) %>">
                            </a>
                        </span>
            <dl class="goods-info">
                <dt class="goods-name">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                        <h4><%=selecInfo.product_item_name%></h4>
                        <h6><%=selecInfo.product_tips%></h6>
                    </a>
                </dt>
                <dd class="goods-sale">
                    <a href="product_detail.html?item_id=<%=selecInfo.item_id%>">
                                    <span class="goods-price">
                                        ￥<em><%=selecInfo.item_sale_price%></em>
                                    </span>
                    </a>
                </dd>
                <dd class="goods-assist">
                    <div class="add-cart" data-type="3" data-actid="<%=giftsDiv.actId%>" data-activity_item_id="<%=giftsDiv['activity_item_id']%>">
                        <a item_id="<%=selecInfo.item_id%>" href="javascript:void(0);"><i></i></a>
                    </div>
                </dd>
            </dl>
        </li>

        <% } %>
        <% } %>
    </ul>
    <% } %>
    <% } %>
    <% } %>
    <!-- 商品赠品商品列表 end -->
    <% } %>
    <% } %>
    <% } %>
</script>
<script id="cart-list" type="text/html">
    <% var StateCode = getStateCode();%>
    <!-- start 店铺-->
    <% if(items && items.length >0){%>
    <% for (var i = 0;i<items.length;i++){%>
    <div class="sstouch-cart-container">
        <!-- start 购物车中的商品 -->
        <dl class="sstouch-cart-store">
            <dt><span class="store-check">
                <input class="store_checkbox" type="checkbox" value="<%=items[i].store_id%>" <%=(items[i].cart_select ? 'checked' : '')%> >
            </span>
                <i class="icon-store"></i>
                <%=items[i].store_name%>
                <% if (items[i]['activitys'].voucher) { %>
                <span class="handle">
                    <a href="javascript:void(0);" class="voucher animation-up animation-up<%=i%>"><i></i><?=__('领券')?></a>
                </span>
                <% } %>
            </dt>
            <% if (items[i].postFree) { %>
            <dd class="store-activity">
                <em><?=__('免运费')?></em>
                <!--<span><%=items[i].freight%></span>-->
            </dd>
            <% }else if(items[i].postFreeBalance){ %>
            <dd class="store-activity">
                <?=__('还需')?> <i id="J_postFreeBalance"><%=items[i].postFreeBalance%></i> <?=__('元')?><?=__('即可免邮费')?>  <!--<a href="javascript:void(0);" id="J_showCoudan"><?=__('立即凑单')?></a>-->
            </dd>
            <% } %>
            <% if (items[i]['activitys'].gift && items[i]['activitys'].gift.length > 0) { %>
            <dd class="store-activity">
                <em><?=__('满即送')?></em>
                <% for (var j=0; j<items[i]['activitys'].gift.length; j++) { var mansong = items[i]['activitys'].gift[j]%>
                <span><%=mansong.actName%><%if(!isEmpty(mansong.url)){%><img src="<%=mansong.url%>" /><%}%></span>
                <% } %>
                <i class="arrow-down"></i>
            </dd>
            <% } %>
            <% if (items[i].bargains && items[i].bargains.length > 0) { %>
            <% for (var j=0; j<items[i].bargains.length; j++) { var bargains = items[i]['bargains'][j]%>
            <dd class="store-activity <%= (!bargains.num && !bargains.selectable) ? 'hide' : '' %>">
                <% if(bargains.selectable) {%>
                    <em><%=bargains.bargain_name ? bargains.bargain_name : '<?=__('加价购')?>'%></em>
                    <span><%if(!isEmpty(bargains.product_image)){%><img src="<%=bargains.product_image%>" /><%}%>
                    <i class="item J_bargainsItem" id="J_activityItem-<%=bargains.actId%>" data-actid="<%=bargains.actId%>" ><?=__('选购其他加价购商品')?><%=bargains.num%><?=__('件')?></i></span>
                    <i class="arrow-down"></i>
                <% } else { %>
                    <!-- data-activity_item_id="<%= items[i].item_id%>" <?=__('为活动商品的item_id，')?><?=__('多商品不确定是哪一个设为0')?> -->
                    <span class="add-cart" data-type="1" data-actid="<%=bargains.actId%>" data-activity_item_id="0">
                        <a item_id="<%=bargains.item_id%>" href="javascript:void(0);">+</a>
                        <i><%if(!isEmpty(bargains.product_image)){%><img src="<%=bargains.product_image%>" /><%}%>
                        <i><?=__('还可购买该加价购商品')?><%=bargains.num%><?=__('件')?></i>
                    </i>
                    </span>
                <% } %>
            </dd>
            <% } %>
            <% } %>
        </dl>
        <!-- end 购物车中的商品 -->

        <!-- start 店铺商品 -->
        <ul class="sstouch-cart-item">
            <% if (items[i].items) { %>
            <% for (var d=0; d<items[i].items.length; d++) {var goods = items[i].items[d];%>
            <li cart_id="<%=goods.cart_id%>" class="cart-litemw-cnt item-disable-box" >
                <div class="goods-check">
                    <input type="checkbox" <%=(goods.cart_select ? 'checked' : '')%>  name="cart_id" value="<%=goods.cart_id%>" />
                </div>
                <div class="goods-pic">
                    <a href="./product_detail.html?item_id=<%=goods.item_id%>">
                        <img src="<%=goods.product_image%>"/>
                    </a>
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"> <a href="./product_detail.html?item_id=<%=goods.item_id%>"> <%=goods.product_name%> </a></dt>
                    <dd class="goods-type"><%=goods.item_name%></dd>
                </dl>
                <div class="goods-del" cart_id="<%=goods.cart_id%>"><a href="javascript:void(0);"></a></div>
                <div class="goods-subtotal"> <span class="goods-price"><% if(goods.item_sale_price) { %>￥<em><%=goods.item_sale_price%></em><% } %> <% if(goods.item_unit_points) { %><em>+ <%=goods.item_unit_points%></em><?=__('积分')?><% } %></span>
                    <span class="goods-sale">
                        <% if(goods.show_oos) { %>
                        <em class="disabled"><?=__('已售罄')?></em>
                        <% } %>

                        <% if(goods.is_over_ttl || goods.show_open_activity_status) { %>
                        <em class="disabled"><?=__('已失效')?></em>
                        <% } %>

                        <% if(!goods.is_on_sale) { %>
                        <em class="disabled"><?=__('已下架')?></em>
                        <% } %>

                        <% if (goods.show_typename != ''){ %>
                        <em><%=goods.show_typename%></em>
                        <% } %>

                        <% if (goods.show_type === 'bigtap'){ %>
                        <em><?=__('开放购买活动商品')?></em>
                        <% } %>

                        <% if (goods.cart_type_id == getStateCode().CART_GET_TYPE_POINT){ %>
                        <em><?=__('积分兑换')?></em>
                        <% }else if (goods.cart_type_id == getStateCode().CART_GET_TYPE_GIFT){ %>
                        <em><?=__('赠品')?></em>
                        <% }else if (goods.cart_type_id == getStateCode().CART_GET_TYPE_BARGAIN){ %>
                        <em><i></i><?=__('活动促销')?></em>
                        <% } %>
                    </span>
                    <div class="value-box">
                        <span class="minus">
                            <a href="javascript:void(0);">&nbsp;</a>
                        </span>
                        <span>
                            <input type="text" pattern="[0-9]*" readonly class="buy-num buynum" value="<%=goods.cart_quantity%>"/>
                        </span>
                        <span class="add">
                            <a href="javascript:void(0);">&nbsp;</a>
                        </span>
                    </div>
                </div>
                <% if (goods.gift_list && goods.gift_list.length > 0) { %>
                <div class="goods-gift">
                    <% for (var k=0; k<goods.gift_list.length; k++) { var gift = goods.gift_list[k]%>
                    <span><em><?=__('赠品')?></em><%=gift.gift_goodsname%>x<%=gift.gift_amount%></span>
                    <% } %>
                </div>
                <% } %>
            </li>

            <% if (goods.pulse_gift && goods.pulse_gift.length > 0) {%>
            <dl class="sstouch-cart-store">
                <dd class="store-activity">
                    <em><?=__('满即送')?></em>
                    <% for (var k=0; k<goods.pulse_gift.length; k++) { var mansong = goods.pulse_gift[k]%>
                    <span><%=mansong.actName%><%if(!isEmpty(mansong.url)){%><img src="<%=mansong.url%>" /><%}%></span>
                    <% } %>
                    <i class="arrow-down"></i>
                </dd>
            </dl>
            <% } %>

            <% if (goods.pulse_bargains && goods.pulse_bargains.length > 0) { %>
            <% for (var k=0; k<goods.pulse_bargains.length; k++) { var bargains = goods.pulse_bargains[k]%>
            <dl class="sstouch-cart-store <%= (!bargains.num && !bargains.selectable) ? 'hide' : '' %>">
                <dd class="store-activity">
                    <% if(bargains.selectable) {%>
                        <em><%=bargains.bargain_name ? bargains.bargain_name : '<?=__('加价购')?>'%></em>
                        <span><%if(!isEmpty(bargains.product_image)){%><img src="<%=bargains.product_image%>" /><%}%>
                        <i class="item J_bargainsItem" id="J_activityItem-<%=bargains.actId%>" data-actid="<%=bargains.actId%>" ><?=__('选购其他加价购商品')?><%=bargains.num%><?=__('件')?></i></span>
                        <i class="arrow-down"></i>
                    <% } else { %>
                        <!-- data-activity_item_id="<%= items[i].item_id%>" <?=__('为活动商品的')?>item_id -->
                        <span class="add-cart" data-type="1" data-actid="<%=bargains.actId%>" data-activity_item_id="<%= goods.item_id%>">
                            <a item_id="<%=bargains.item_id%>" href="javascript:void(0);">+</a>
                            <i><%if(!isEmpty(bargains.product_image)){%><img src="<%=bargains.product_image%>" /><%}%>
                                <i><?=__('还可购买该加价购商品')?><%=bargains.num%><?=__('件')?></i>
                            </i>
                        </span>
                    <% } %>
                </dd>
            </dl>
            <% } %>
            <% } %>

            <!-- 商品赠品 start -->
            <% if (goods.pulse_gift_cart && goods.pulse_gift_cart.length > 0) {%>
            <% for (var k = 0;k<goods.pulse_gift_cart.length ;k++) { var giftValue=goods.pulse_gift_cart[k] %>
            <li class="cart-litemw-cnt">
                <div class="goods-pic">
                    <a href="./product_detail.html?item_id=<%=giftValue.item_id%>">
                        <img src="<%=giftValue.product_image%>" />
                    </a>
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"><a href="./product_detail.html?item_id=<%=giftValue.item_id%>">
                        <%=giftValue.product_name%> </a></dt>
                    <dd class="goods-type"><%=giftValue.item_name%></dd>
                </dl>
                <!--<div class="goods-del" cart_id="<%=goods.cart_id%>"><a href="javascript:void(0);"></a></div>-->
                <div class="goods-subtotal"><span class="goods-price">￥<em><%=giftValue.subtotal%></em></span>

                    <span class="goods-sale">
                        <% if( giftValue.selectable){ %>
                            <dl class="sstouch-cart-store">
                                <dd class="store-activity">
                                    <span id="J_activityItem-<%=giftValue.actId%>" class="J_bargainsItem" data-actid="<%=giftValue.actId%>" data-activity_item_id="<%=giftValue.activity_item_id%>"><?=__('选择其他赠品')?></span>
                                </dd>
                            </dl>
                        <% } %>
                    </span>


                    <div class="value-box">
                        <span>
                            <span class="buy-num buynum"><%=giftValue.cart_quantity%></span>
                        </span>
                    </div>
                </div>


            </li>
            <% } %>
            <% } %>
            <!-- 商品赠品 end -->


            <!-- 商品满减 start -->
            <% if(goods.pulse_reduction && goods.pulse_reduction.length > 0){ %>
            <% for (var k = 0;k<goods.pulse_reduction.length;k++) { var reductionValue=goods.pulse_reduction[k] %>
            <li class="item-sub-box col-md-12 ">
                <div class="goods-pic icon-activity icon-activity-reduction">
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"><a href="./product_detail.html?item_id=<%=reductionValue.item_id%>">
                        <%=reductionValue.actName%> </a></dt>
                    <dd class="goods-type"><?=__('满减')?></dd>
                </dl>
                <div class="goods-subtotal"><span
                        class="goods-price">-￥<em><%=reductionValue.reduceMoney%></em></span>
                    <!--<span class="goods-sale">
                        <em><?=__('满减')?></em>
                    </span>-->
                    <div class="value-box">
                        <span>
                            <span class="buy-num buynum"><%=reductionValue.times%></span>
                        </span>
                    </div>
                </div>
                <i class="arrow"></i>
            </li>
            <% } %>

            <% } %>
            <!-- 商品满减 end -->


            <!-- 商品加价购 start -->
            <% if(goods.pulse_bargains_cart && goods.pulse_bargains_cart.length > 0){ %>
            <% for (var k = 0;k<goods.pulse_bargains_cart.length ;k++) { var bcValue=goods.pulse_bargains_cart[k] %>
            <li class="item-sub-box col-md-12 ">
                <div class="goods-pic">
                    <a href="./product_detail.html?item_id=<%=bcValue.item_id%>">
                        <img src="<%=bcValue.product_image%>"/>
                    </a>
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"><a href="./product_detail.html?item_id=<%=bcValue.item_id%>">
                        <%=bcValue.product_name%> </a></dt>
                    <dd class="goods-type"><%=bcValue.item_name%></dd>
                </dl>
                <div class="goods-del" cart_id="<%=bcValue.cart_id%>"><a href="javascript:void(0);"></a></div>
                <div class="goods-subtotal"><span class="goods-price">￥<em><%=(bcValue.item_sale_price * parseInt(bcValue.num)).toFixed(2)%></em></span>

                    <!--<span class="goods-sale">
                         <em><?=__('加价购')?></em>
                     </span>-->
                    <% if( bcValue.selectable){ %>

                    <% } %>

                    <div class="value-box">
                        <span>
                            <span class="buy-num buynum"><%=bcValue.num%></span>
                        </span>
                    </div>
                </div>
                <div class="col col-action col-md-1 col-xs-3 col-sm-1  text-center">
                    <a id="<%=bcValue.cart_id%>" data-msg="<%=bcValue.del_confirm%>" href="javascript:void(0);"
                       title="<?=__('删除')?>" class="del J_delGoods  text-center"></a>
                </div>
            </li>
            <% } %>
            <% } %>
            <!-- 商品加价购 end -->


            <% } %>
            <% } %>


            <!-- 店铺赠品 start -->
            <% if (items[i]['activitys'].gift && items[i]['activitys'].gift.length > 0) {%>
            <% for (var k = 0;k<items[i]['activitys'].gift.length;k++) { var giftValue=items[i]['activitys'].gift[k] %>
            <li class="cart-litemw-cnt">
                <div class="goods-pic">
                    <a href="./product_detail.html?item_id=<%=giftValue.item_id%>">
                        <img src="<%=giftValue.product_image%>"/>
                    </a>
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"><a href="./product_detail.html?item_id=<%=giftValue.item_id%>">
                        <%=giftValue.product_name%> </a></dt>
                    <dd class="goods-type"><%=giftValue.item_name%></dd>
                </dl>
                <!--<div class="goods-del" cart_id="<%=goods.cart_id%>"><a href="javascript:void(0);"></a></div>-->
                <div class="goods-subtotal"><span class="goods-price">￥<em><%=giftValue.subtotal%></em></span>

                    <span class="goods-sale">
                        <% if( giftValue.selectable){ %>
                            <dl class="sstouch-cart-store">
                                <dd class="store-activity">
                                    <span id="J_activityItem-<%=giftValue.actId%>" class="J_bargainsItem" data-actid="<%=giftValue.actId%>" data-activity_item_id="<%=giftValue.activity_item_id%>"><?=__('选择其他赠品')?></span>
                                </dd>
                            </dl>
                        <% } %>
                     </span>

                    <div class="value-box">
                        <span>
                            <span class="buy-num buynum"><%=giftValue.num%></span>
                        </span>
                    </div>
                </div>

            </li>
            <% } %>
            <% } %>
            <!-- 店铺赠品 end -->

            <!-- 店铺满减 start -->
            <% if(items[i]['activitys'].reduction && items[i]['activitys'].reduction.length > 0){ %>

            <% for (var k = 0;k<items[i]['activitys'].reduction.length;k++) { var reductionValue=items[i]['activitys'].reduction[k] %>
            <li class="item-sub-box col-md-12 ">
                <div class="goods-pic icon-activity icon-activity-reduction">
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"><a href="./product_detail.html?item_id=<%=reductionValue.item_id%>">
                        <%=reductionValue.actName%> </a></dt>
                    <dd class="goods-type"><?=__('满减')?></dd>
                </dl>
                <div class="goods-subtotal"><span
                        class="goods-price">-￥<em><%=reductionValue.reduceMoney%></em></span>
                    <!--<span class="goods-sale">
                        <em><?=__('满减')?></em>
                    </span>-->
                    <div class="value-box">
                        <span>
                            <span class="buy-num buynum"><%=reductionValue.times%></span>
                        </span>
                    </div>
                </div>
                <i class="arrow"></i>
            </li>
            <% } %>
            <% } %>
            <!-- 店铺满减 end -->

            <!-- 店铺加价购？ start -->
            <!-- 店铺加价购？ end -->
        </ul>
        <!-- end 店铺商品 -->

        <% if (items[i]['activitys'].voucher) { %>
        <div class="sstouch-bottom-mask sstouch-bottom-mask<%=i%>">
            <div class="sstouch-bottom-mask-bg"></div>
            <div class="sstouch-bottom-mask-block">
                <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
                <div class="sstouch-bottom-mask-top store-voucher">
                    <i class="icon-store"></i>
                    <%=items[i].store_name%>&nbsp;&nbsp;<?=__('领取店铺优惠券')?>
                    <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
                </div>
                <div class="sstouch-bottom-mask-rolling sstouch-bottom-mask-rolling<%=i%>">
                    <div class="sstouch-bottom-mask-con">
                        <ul class="sstouch-voucher-list">
                            <% for (var j=0; j<items[i]['activitys'].voucher.length; j++) {var voucher = items[i]['activitys'].voucher[j];%>
                            <li>
                                <dl>
                                    <dt class="money"><?=__('面额')?><em><%=voucher['activity_rule'].voucher_price%></em><?=__('元')?></dt>
                                    <dd class="need"><?=__('需消费')?><%=voucher['activity_rule']['requirement']['buy'].subtotal%><?=__('使用')?>
                                    </dd>
                                    <dd class="time"><?=__('至')?><%=voucher['activity_rule'].voucher_end_date%><?=__('前使用')?></dd>
                                </dl>
                                <a href="javascript:void(0);" class="btn" data-tid=<%=voucher.activity_id%>><?=__('领取')?></a>
                            </li>
                            <% } %>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <% } %>
    </div>
    <%}%>
    <!-- end 店铺 -->

    <% if (check_out === true) {%>
    <div class="sstouch-cart-bottom">
        <div class="all-check"><input class="all_checkbox" type="checkbox" <%=(cart_select ? 'checked' : '')%> ></div>
        <div class="total">
            <dl class="total-money">
                <dt><?=__('合计总金额：')?></dt>
                <dd><% if (orderSelMoneyAmount) {%>￥<em><%=orderSelMoneyAmount%></em><% } %> <% if (orderSelPointsAmount) {%><em>+ <%=orderSelPointsAmount%></em>?=__('积分')?><% } %></dd>
            </dl>
        </div>
        <div class="check-out ok">
            <a href="javascript:void(0)"><?=__('确认信息')?></a>
        </div>
    </div>
    <% } else { %>
    <div class="sstouch-cart-bottom no-login">
        <div class="cart-nologin-tip"><?=__('结算购物车中的商品，需先登录商城')?></div>
        <div class="cart-nologin-btn"><a href="javascript:car_login();" class="btn"><?=__('登录')?></a>
            <a href="javascript:car_register();" class="btn"><?=__('注册')?></a>
        </div>
    </div>
    <% } %>
    <%}else{%>
    <div class="sstouch-norecord cart">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您的购物车还是空的')?></dt>
            <dd><?=__('去挑一些中意的商品吧')?></dd>
        </dl>
        <a href="../index.html" class="btn"><?=__('随便逛逛')?></a>
    </div>
    <%}%>
</script>

<script> var navigate_id ="4";</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/cart-list.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>