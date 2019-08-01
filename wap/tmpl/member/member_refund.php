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
    <span class="header-tab"><a href="javascript:void(0);" class="cur"><?=__('退款列表')?></a><a href="member_return.html"><?=__('退货列表')?></a></span>
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
    <ul id="refund-list">
    </ul>
  </div>
</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="refund-list-tmpl">
<% if (refund_list && refund_list.length > 0){%>
	<% for(var i = 0;i<refund_list.length;i++){
	%>
		<li class=" <%if(i>0){%>mt10<%}%>">
			<div class="sstouch-order-item">
				<div class="sstouch-order-item-head">
					<a href="../../tmpl/member/member_refund_info.html?refund_id=<%=refund_list[i].refund_id%>" class="store"><i class="icon"></i><%=refund_list[i].store_name%></a><span class="state"><%=refund_list[i].seller_state%></span>
				</div>
				<div class="sstouch-order-item-con">
				<% for(var j = 0;j<refund_list[i].goods_list.length;j++){
					var goods_list = refund_list[i].goods_list[j];
				%>
					<div class="goods-block">
					<a href="../../tmpl/member/member_refund_info.html?refund_id=<%=refund_list[i].refund_id%>">
						<div class="goods-pic">
							<img src="<%=goods_list.goods_img_360%>"/>
						</div>
						<dl class="goods-info" style="margin-right: auto;">
							<dt class="goods-name"><%=goods_list.goods_name%></dt>
							<dd class="goods-type"><%=goods_list.goods_spec%></dd>
						</dl>
					</a>
					</div>
				<%}%>
				</div>
				<div class="sstouch-order-item-footer">
					<div class="store-totle">
					<time class="refund-time"><%=refund_list[i].add_time%></time>
					<span class="refund-sum">?=__('退款金额')?>：<em>￥<%=refund_list[i].refund_amount%></em></span>
					</div>
					<div class="handle">
						<a href="../../tmpl/member/member_refund_info.html?refund_id=<%=refund_list[i].refund_id%>" class="btn evaluation-again-order">?=__('退款详情')?></a>
					</div>
				</div>
			</div>
		</li>
	<%}%>
	<% if (hasmore) {%>
	<li class="loading"><div class="spinner"><i></i></div>?=__('订单数据读取中')?>...</li>
	<% } %>
<%}else {%>
	<div class="sstouch-norecord refund">
		<div class="norecord-ico"><i></i></div>
		<dl>
			<dt>?=__('您还没有退款信息')?></dt>
			<dd>?=__('已购订单详情可申请退款')?></dd>
		</dl>
	</div>
<%}%>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/member_refund.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
