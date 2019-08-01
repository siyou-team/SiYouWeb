<?php
include __DIR__ . '/../../includes/header.php';
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
<title><?=__('订单详情')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="app-no-fixed appshow">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('订单详情')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
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
<div class="sstouch-main-layout mb20">
  <div class="sstouch-order-list" id="order-info-container">
    <ul>
    </ul>
  </div>
</div>
<footer id="footer"></footer>
<script type="text/html" id="order-info-tmpl">
	<div class="sstouch-oredr-detail-block clearfix">
		<h3><i class="orders"></i><?=__('交易状态')?>
			&nbsp;<div class="order-state">
				<%if (2 == cart_type_id){%>
				<?=__('积分换购')?>
				<%}%>
			</div>
		</h3>

		<div class="order-state state-text"> <%=order_is_paid_name%>  <%=order_state_name%></div>
		<%if (order_tips != ''){%><div class="info"><%=order_tips%></div><%}%>
	</div>
	<%if(if_logistics){%>
	<div class="sstouch-oredr-detail-delivery">
		<a href="../../tmpl/member/order_delivery.html?order_id=<%=order_id%>">
			<span class="time-line">
				<i></i>
			</span>
			<div class="info">
				<p id="delivery_content"></p>
				<time id="delivery_time"></time>
			</div>
			<span class="zc zc-arrow-r arrow-r"></span>
		</a>
	</div>
	<%}%>
	<div class="sstouch-oredr-detail-block mt5">
		<div class="sstouch-oredr-detail-add">
			<i class="icon-add"></i>
			<dl>
        		<dt><?=__('收货人')?>：<span><%=delivery.da_name%></span><span><%=delivery.da_telephone%></span></dt>
				<dd><?=__('收货地址')?>：<%=delivery.da_address%></dd>
			</dl>
		</div>
	</div>
	<%if (order_message != ''){%>
	<div class="sstouch-oredr-detail-block">
		<h3><i class="msg"></i><?=__('买家留言')?></h3>
		<div class="info"><%=order_message%></div>
	</div>
	<%}%>
	<%if (order_invoice_title != ''){%>
	<div class="sstouch-oredr-detail-block clearfix">
		<h3><i class="invoice"></i><?=__('发票信息')?></h3>
		<div class="info"><%=order_invoice_title%></div>
	</div>
	<%}%>
	<%if (payment_type_id != ''){%>
	<div class="sstouch-oredr-detail-block">
		<h3><i class="pay"></i><?=__('付款方式')?></h3>
		<div class="info"><%=order_payment_name%></div>
	</div>
	<%}%>
	<div class="sstouch-order-item mt5">
		<div class="sstouch-order-item-head">
			<%if (self_support){%>
			<a class="store"><i class="icon"></i><%=store_name%></a>
			<%}else{%>
				<a href="../../tmpl/store.html?store_id=<%=store_id%>" class="store"><i class="icon"></i><%=store_name%><i class="zc zc-arrow-r arrow-r"></i></a>
			<%}%>
		</div>
		<div class="sstouch-order-item-con">
            <%for(i=0; i<items.length; i++){%>
            <div class="goods-block detail">
                <a href="../../tmpl/product_detail.html?item_id=<%=items[i].item_id%>">
                    <div class="goods-pic">
                        <img src="<%=items[i].order_item_image%>">
                    </div>
                    <dl class="goods-info">
                        <dt class="goods-name"><%=items[i].item_name%></dt>
                        <dd class="goods-type"><%=items[i].spec_info%></dd>
                    </dl>
                    <div class="goods-subtotal">

						<%if (2 == cart_type_id){%>
						<span class="goods-price"><em><%=items[i].order_item_points_fee/items[i].order_item_quantity%></em><?=__('积分')?></span>
						<%} else {%>
							<%if (items[i].order_item_unit_price){%>
								<span class="goods-price">￥<em><%=items[i].order_item_unit_price%></em></span>
							<%}%>

							<%if (items[i].item_unit_points){%>
							<span class="goods-price"><em><%=items[i].item_unit_points%></em><?=__('积分')?></span>
							<%}%>
						<%}%>

                        <span class="goods-num">x<%=items[i].order_item_quantity%></span>
                    </div>

					<% if (items[i].if_return) {%>
					<!--<a href="javascript:void(0)" order_id="<%=order_id%>" order_item_id="<%=items[i].order_item_id%>" class="goods-refund"><?=__('退款')?></a>-->
					<a href="javascript:void(0)" order_id="<%=order_id%>" order_item_id="<%=items[i].order_item_id%>" class="goods-return"><?=__('退货')?></a>
					<%}%>
                </a>
            </div>
            <%}%>
            <%
            zengpin_list = [];
            if (zengpin_list.length > 0){%>
            <div class="goods-gift">
                <%for(i=0; i<zengpin_list.length; i++){%>
                <span><em><?=__('赠品')?></em>%=zengpin_list[i].goods_name%> x <%=zengpin_list[i].goods_num%</span>
                <%}%>
            </div>
            <%}%>

            <div class="goods-subtotle">
                <%
                    promotion= [];
                if (promotion.length > 0){%>
                <dl>
                    <dt><?=__('优惠')?></dt>
                    <dd><%for (var ii in promotion){%><span><%=promotion[ii][1]%></span><%}%></dd>
                </dl>
                <%}%>
                <dl>
                    <dt><?=__('运费')?></dt>
                    <dd><?=__('￥')?><em><%=order_shipping_fee%></em></dd>
                </dl>
                <dl class="t">
                    <dt><?=__('实付款（含运费）')?></dt>

					<%if (2 == cart_type_id){%>
					<dd><em><%=order_points_fee%></em><?=__('积分')?></dd>
					<%} else {%>
						<%if (order_payment_amount){%>
						<dd><?=__('￥')?><em><%=order_payment_amount%></em></dd>
						<%}%>
						&nbsp;&nbsp;
						<%if (order_resource_ext1){%>
						<dd><em><%=order_resource_ext1%></em><?=__('积分')?></dd>
						<%}%>

					<%}%>

                </dl>
            </div>

		</div>
		<div class="sstouch-order-item-bottom">
			<span>
			<% if (im_chat) {%>
			<a href="chat_html?t_id=<%=store_member_id%>"><i class="im"></i><?=__('联系客服')?></a>
			<%}else{%>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<%=store_qq%>&site=qq&menu=yes"><i class="im"></i><?=__('联系客服')?></a>
			<%}%>
			</span>
			<span><a href="tel:<%=chain_telephone ? chain_telephone : store_phone %>"><i class="tel"></i><?=__('拨打电话')?></a></span>
		</div>
	</div>
	<div class="sstouch-oredr-detail-block mt5">
		<ul class="order-log">
			<li><?=__('订单编号')?>：<%=order_id%></li>
			<li><?=__('创建时间')?>：<%=$getLocalTime(order_time)%></li>
			<% if(payment_time && order_is_paid == getStateCode().ORDER_PAID_STATE_YES){%>
			<li><?=__('付款时间')?>：<%=payment_time%></li>
			<%}%>
			<% if(shipping_time && order_is_shipped == getStateCode().ORDER_SHIPPED_STATE_YES){%>
			<li><?=__('发货时间')?>：<%=shipping_time%></li>
			<%}%>
			<% if(order_settlement_time && order_state_id == getStateCode().ORDER_STATE_FINISH){%>
			<li><?=__('完成时间')?>：<%=order_settlement_time%></li>
			<%}%>
		</ul>
	</div>
	<div class="sstouch-oredr-detail-bottom">
	<% if (if_lock) {%>
	<p><?=__('退款/退货中')?>...</p>
	<% } %>
	<% if (if_buyer_cancel) {%>
	<a href="javascript:void(0)" order_id="<%=order_id%>" class="btn cancel-order"><?=__('取消订单')?></a>
	<% } %>
	<% if (if_refund_cancel) {%>
	<a href="javascript:void(0)" order_id="<%=order_id%>" class="btn all_refund_order"><?=__('订单退款')?></a>
	<% } %>
	<% if (if_logistics) { %>
	<a href="javascript:void(0)" order_id="<%=order_id%>" class="btn viewdelivery-order"><?=__('查看物流')?></a>
	<%}%>
	<% if (if_receive){ %>
	<a href="javascript:void(0)" order_id="<%=order_id%>" class="btn key sure-order"><?=__('确认收货')?></a>
	<% } %>
	<% if (if_evaluation) {%>
	<a href="javascript:void(0)" order_id="<%=order_id%>" class="btn key evaluation-order"><?=__('评价订单')?></a>
	<% } %>
	<!--<% if (if_evaluation_again){ %>
	<a href="javascript:void(0)" order_id="<%=order_id%>" class="btn evaluation-again-order"><?=__('追加评价')?></a>
	<% } %>-->
	</div>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/order_detail.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
