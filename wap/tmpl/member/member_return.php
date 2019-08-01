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
<title><?=__('退款列表')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="member.html"> <i class="zc zc-back back"></i> </a> </div>
	  <div class="header-title">
		  <h1><?=__('退款列表')?></h1>
	  </div>
	  <!--<span class="header-tab"><a href="member_refund.html">退款列表</a><a href="javascript:void(0);" class="cur">退货列表</a></span>-->
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
<div class="sstouch-main-layout">
  <div class="sstouch-order-list">
    <ul id="return-list">
    </ul>
  </div>
</div>
<div class="fix-block-r"> <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a> </div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="return-list-tmpl">
<% if (items.length > 0){%>
	<% for(var i = 0;i<items.length;i++){
	%>
		<li class=" <%if(i>0){%>mt10<%}%>">
			<div class="sstouch-order-item">
				<div class="sstouch-order-item-head">
					<a href="javascript:void(0);" class="store"><i class="icon"></i><%=items[i].store.store_name%></a><span class="state"><%=items[i].store_is_open%></span>
				</div>
				<div class="sstouch-order-item-con">
					<div class="goods-block">
					<a href="../../tmpl/member/member_return_info.html?return_id=<%=items[i].return_id%>">
						<div class="goods-pic">
							<img src="<%=items[i].store.store_logo%>"/>
						</div>
						<dl class="goods-info">
							<% if(items[i].items && items[i].items.length>0) {%>
							<% for(var j = 0;j<items[i].items.length;j++){ var val = items[i].items[j] %>
							<dt class="goods-name"><%=val.item_name%> x <%= val.return_item_num %></dt>
							<dd class="goods-type"><%=val.spec_info%></dd>
							<% } %>
							<% } %>
						</dl>
						<div class="goods-subtotal">
							<span class="goods-price"><%=items[i].return_state_name%></span>
						</div>
					</a>
					</div>
				</div>
				<div class="sstouch-order-item-footer">
					<div class="store-totle">
					<time class="refund-time"><%=items[i].return_add_time%></time>
					<span class="refund-sum"><?=__('退款总金额')?>：<em>￥<%=items[i].return_refund_amount%></em></span>
					<br/>
					<span class="refund-sum"><?=__('退货数量')?>：<em><%=items[i].return_num%></em><?=__('件')?></span>
					</div>
					<div class="handle">
						<div class="pull-right">
							<a href="../../tmpl/member/member_return_info.html?return_id=<%=items[i].return_id%>" class="btn"><?=__('退款详情')?></a>
							<%if(items[i].delay_state == 1){%>
							<a href="javascript:void(0);" return_id="<%=items[i].return_id%>" class="btn delay-btn"><?=__('延迟')?></a>
							<%}%>
							<%if(items[i].ship_state == 1){%>
							<a href="../../tmpl/member/member_return_ship.html?return_id=<%=items[i].return_id%>" class="btn key"><?=__('退货发货')?></a>
							<%}%>
						</div>
					</div>
				</div>
			</div>
		</li>
	<%}%>
	<% if (hasmore) {%>
	<li class="loading"><div class="spinner"><i></i></div><?=__('订单数据读取中')?>...</li>
	<% } %>
<%}else {%>
	<div class="sstouch-norecord refund">
		<div class="norecord-ico"><i></i></div>
		<dl>
			<dt><?=__('您还没有退货信息')?></dt>
			<dd><?=__('已购订单详情可申请退货')?></dd>
		</dl>
	</div>
<%}%>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/member_return.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
