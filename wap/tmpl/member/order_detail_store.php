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
<title>订单详情</title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<style>
	.upload-pay-img{
		background-color: #ff6700;
		color:white !important;
	}
	.upload-pay-ok{
		background-color: green;
		color:white !important;
	}
	.upload-pay-pass{
		background-color: red;
		color:white !important;
	}
	.upload-pay{
		background-color: black;
		color:white !important;
	}
</style>
</head>
<body>
<header id="header" class="app-no-fixed appshow">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1>订单详情</h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../../index.html"><i class="zc zc-home home"></i>首页</a></li>
        <li><a href="../search.html"><i class="zc zc-search search"></i>搜索</a></li>
        <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i>分类</a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i>消息<sup></sup></a></li>
        <li><a href="../cart_list.html"><i class="zc zc-cart cart"></i>购物车<sup></sup></a></li>
        <li><a href="../member/member.html"><i class="zc zc-member member"></i>我的商城</a></li>
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
	<div class="sstouch-oredr-detail-block">
		<h3><i class="orders"></i>交易状态
			&nbsp;<div class="order-state">
				<%if (2 == cart_type_id){%>
				积分换购
				<%}%>
			</div>
		</h3>

		<div class="order-state"> <%=order_is_paid_name%>  <%=order_state_name%></div>
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
        		<dt>收货人：<span><%=delivery.da_name%></span><span><%=delivery.da_telephone%></span></dt>
				<dd>收货地址：<%=delivery.da_address%></dd>
				<dd>联系电话：<%=delivery.da_mobile%></dd>
			</dl>
		</div>
	</div>
	<%if (order_message != ''){%>
	<div class="sstouch-oredr-detail-block">
		<h3><i class="msg"></i>买家留言</h3>
		<div class="info"><%=order_message%></div>
	</div>
	<%}%>
	<%if (order_invoice_title != ''){%>
	<div class="sstouch-oredr-detail-block">
		<h3><i class="invoice"></i>发票信息</h3>
		<div class="info"><%=order_invoice_title%></div>
	</div>
	<%}%>
	<%if (payment_type_id != ''){%>
	<div class="sstouch-oredr-detail-block">
		<h3><i class="pay"></i>付款方式</h3>
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
                        <img src="<%=items[i].order_item_image?items[i].order_item_image:'../../images/default.png'%>">
                    </div>
                    <dl class="goods-info">
                        <dt class="goods-name"><%=items[i].item_name%></dt>
                        <dd class="goods-type"><%=items[i].spec_info%></dd>
                    </dl>
                    <div class="goods-subtotal">

						<%if (2 == cart_type_id){%>
						<span class="goods-price"><em><%=items[i].order_item_points_fee/items[i].order_item_quantity%></em>积分</span>
						<%} else {%>
							<%if (items[i].order_item_unit_price){%>
								<span class="goods-price">￥<em><%=items[i].order_item_unit_price%></em></span>
							<%}%>

							<%if (items[i].item_unit_points){%>
							<span class="goods-price"><em><%=items[i].item_unit_points%></em><%=__('积分')%></span>
							<%}%>
						<%}%>

                        <span class="goods-num">x<%=items[i].order_item_quantity%></span>
                    </div>

                </a>
            </div>
            <%}%>
            <%
            zengpin_list = [];
            if (zengpin_list.length > 0){%>
            <div class="goods-gift">
                <%for(i=0; i<zengpin_list.length; i++){%>
                <span><em>赠品</em>%=zengpin_list[i].goods_name%> x <%=zengpin_list[i].goods_num%</span>
                <%}%>
            </div>
            <%}%>

            <div class="goods-subtotle">
                <%
                    promotion= [];
                if (promotion.length > 0){%>
                <dl>
                    <dt>优惠</dt>
                    <dd><%for (var ii in promotion){%><span><%=promotion[ii][1]%></span><%}%></dd>
                </dl>
                <%}%>
                <dl>
                    <dt>运费</dt>
                    <dd>￥<em><%=order_shipping_fee%></em></dd>
                </dl>
                <dl class="t">
                    <dt>实付款（含运费）</dt>

					<%if (2 == cart_type_id){%>
					<dd><em><%=order_points_fee%></em>积分</dd>
					<%} else {%>
						<%if (order_payment_amount){%>
						<dd>￥<em><%=order_payment_amount%></em></dd>
						<%}%>
						&nbsp;&nbsp;
						<%if (order_resource_ext1){%>
						<dd><em><%=order_resource_ext1%></em><%=__('积分')%></dd>
						<%}%>

					<%}%>

                </dl>
            </div>

		</div>
		<div class="sstouch-order-item-bottom">
			<span>
			<% if (im_chat) {%>
			<a href="chat_html?t_id=<%=store_member_id%>"><i class="im"></i>联系客服</a>
			<%}else{%>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<%=store_qq%>&site=qq&menu=yes"><i class="im"></i>联系客服</a>
			<%}%>
			</span>
			<span><a href="tel:<%=chain_telephone ? chain_telephone : store_phone %>"><i class="tel"></i>拨打电话</a></span>
		</div>
	</div>
	<div class="sstouch-oredr-detail-block mt5">
		<ul class="order-log">
			<li>订单编号：<%=order_id%></li>
			<li>创建时间：<%=$getLocalTime(order_time)%></li>
			<% if(payment_time && order_is_paid == getStateCode().ORDER_PAID_STATE_YES){%>
			<li>付款时间：<%=payment_time%></li>
			<%}%>
			<% if(shipping_time && order_is_shipped == getStateCode().ORDER_SHIPPED_STATE_YES){%>
			<li>发货时间：<%=shipping_time%></li>
			<%}%>
			<% if(order_settlement_time && order_state_id == getStateCode().ORDER_STATE_FINISH){%>
			<li>完成时间：<%=order_settlement_time%></li>
			<%}%>
		</ul>
	</div>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/order_detail_store.js"></script>
</body>
</html>