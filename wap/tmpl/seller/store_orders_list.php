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
<title><?=__('订单管理')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">
</head>
<body>
<header id="header" class="app-no-fixed">
 <div class="header-wrap">
    <div class="header-l"> <a href="seller.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('订单管理')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
		<ul>
			<li><a href="seller.html"><i class="zc zc-home home"></i><?=__('商家中心')?></a></li>
			<li><a href="seller_address_list.html"><i class="zc zc-peisongdizhi"></i><?=__('发货地址')?></a></li>
			<li><a href="seller_express.html"><i class="zc zc-wuliukuaidi"></i><?=__('物流公司')?></a></li>
			<li><a href="seller_account.html"><i class="zc zc-yonghushezhi1"></i><?=__('店铺设置')?><sup></sup></a></li>
			<li><a href="chat_list.html"><i class="zc zc-message message"></i>IM <<?=__('客服')?>sup></sup></a></li>
			<li id="logoutbtn"><a href="javascript:void(0);"><i class="zc zc-logout"></i><?=__('退出登录')?><sup></sup></a></li>
		</ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout">
  <div class="sstouch-order-search">
    <form>
      <span><input type="text" autocomplete="on" maxlength="50" placeholder="<?=__('输入商品标题或订单号进行搜索')?>" name="order_key" id="order_key" oninput="writeClear($(this));" >
      <span class="input-del"></span></span>
      <input type="button" id="search_btn" value="&nbsp;">
    </form>
  </div>
  <div id="fixed_nav" class="sstouch-single-nav">
        <ul id="filtrate_ul" class="w20h">
            <li class="selected"><a href="javascript:void(0);" data-state="2010"><?=__('待付款')?></a></li>
            <li><a href="javascript:void(0);" data-state="2011,2013"><?=__('待审核')?></a></li>
            <li><a href="javascript:void(0);" data-state="2020,2030"><?=__('待发货')?></a></li>
            <li><a href="javascript:void(0);" data-state="2040"><?=__('已发货')?></a></li>
            <li><a href="javascript:void(0);" data-state="2060"><?=__('已完成')?></a></li>
            <li class="hide"><a href="javascript:void(0);" data-state="2070"><?=__('已取消')?></a></li>
        </ul>
  </div>
  <div class="sstouch-order-list">
    <ul id="order-list">
    </ul>
  </div>
</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="order-list-tmpl">
	<%
		var orderlist = data.items;
        var StateCode = getStateCode();
	%>
		<li class="green-order-skin mt10">
			<%
			 for (j in orderlist){
				 var order_goods = orderlist[j].item;
			%>
				<div class="sstouch-order-item">
					<div class="sstouch-order-item-head">

					 <a class="store"><?=__('单号')?>:<%=orderlist[j].order_id%></a>

						<span class="state">

							<span class="<%=stateClass%>"><%=$getLocalTime(orderlist[j].order_time)%></span>
						</span>
					</div>
					<div class="sstouch-order-item-con">
						<%
							var count = 0;
							 for (k in order_goods){
								count += parseInt(order_goods[k].order_item_quantity);
						%>
						<div class="goods-block">
							<div class="goods-pic">
                                <img src="<%=order_goods[k].order_item_image%>"/>
							</div>
							<dl class="goods-info">
								<dt class="goods-name"><%=order_goods[k].item_name%></dt>
								<dd class="goods-type"><?=__('买家')?>:<%=orderlist[j].buyer_user_name%></dd>
							</dl>
							<div class="goods-subtotal">
                                <span class="goods-price">￥<em><%=order_goods[k].order_item_unit_price%></em></span>
                                <span class="goods-num">x<%=order_goods[k].order_item_quantity%></span>
							</div>

						</div>
						<%}%>

					</div>
					<div class="sstouch-order-item-footer">
						<div class="store-totle">
							<span><?=__('共')?><em><%=count%></em><?=__('件')?><?=__('商品')?>，<?=__('合计')?></span><span class="sum"><?=__('已完成')?>￥<em><%=orderlist[j].order_payment_amount%></em></span><span class="freight">(<?=__('含运费')?>￥<%=orderlist[j].order_shipping_fee%>)</span>
						</div>

						<div class="handle" order_state_id="<%= orderlist[j].order_state_id  %>" buyer_name="<%=orderlist[j].buyer_user_name%>">

							<a href="javascript:void(0)" class="btn"><%=orderlist[j].order_state_name%></a>

							<%if(orderlist[j].order_state_id == StateCode.ORDER_STATE_WAIT_FINANCE_REVIEW){%>
							<a href="javascript:void(0)" order_id="<%=orderlist[j].order_id%>" opera_name="<?=__('财务审核')?>" class="btn review-order key"><i></i><?=__('财务审核')?></a>
							<%}%>
                            <%if(orderlist[j].if_buyer_cancel){%>
							<a href="javascript:void(0)" order_id="<%=orderlist[j].order_id%>" opera_name="<?=__('取消订单')?>" class="btn key cancel-order"><i></i><?=__('取消订单')?></a>
							<%}%>

                            <%if(orderlist[j].order_state_id == StateCode.ORDER_STATE_WAIT_REVIEW){%>
                            <a href="javascript:void(0)" order_id="<%=orderlist[j].order_id%>"  opera_name="<?=__('审核')?>" class="btn review-order key"><i></i><?=__('审核')?></a>
                            <%}%>

                            <%if(0 && orderlist[j].order_state_id == StateCode.ORDER_STATE_WAIT_FINANCE_REVIEW){%>
                            <a href="javascript:void(0)" order_id="<%=orderlist[j].order_id%>" opera_name="<?=__('查看物流')?>" class="btn key"><?=__('查看物流')?></a>
                            <%}%>
                            <%if(orderlist[j].order_state_id == StateCode.ORDER_STATE_PICKING){%>
                            <a href="javascript:void(0)" order_id="<%=orderlist[j].order_id%>" opera_name="<?=__('出库')?>" class="btn review-order key"><?=__('出库')?></a>
                            <%}%>

							<%if(0 && orderlist[j].order_state_id == StateCode.ORDER_STATE_WAIT_FINANCE_REVIEW){%>
							<p><?=__('退款/退货中')?>...</p>
							<%}%>

							<%if(orderlist[j].order_state_id == StateCode.ORDER_STATE_WAIT_PAY){%>
							<!-- <a href="javascript:void(0)" order_id="<%=orderlist[j].order_id%>" opera_name="<?=__('添加收款记录')?>" order_sn="<%=orderlist[j].order_id%>" class="btn add-fund key"><?=__('添加收款记录')?></a> -->
							<%}%>

							<%if(orderlist[j].if_edit_fee){%>
							<a href="javascript:void(0)" order_id="<%=orderlist[j].order_id%>" opera_name="<?=__('修改邮费')?>" order_sn="<%=orderlist[j].order_id%>" class="btn key edit-order-fee"><?=__('修改邮费')?></a>
							<%}%>

							<%if(orderlist[j].order_state_id == StateCode.ORDER_STATE_WAIT_SHIPPING){%>
							    <a href="seller_send_order.html?orderid=<%=orderlist[j].order_id%>" class="btn key"><?=__('发货')?></a>
							<%}%>
						</div>
					</div>
				</div>
			<%}%>

		</li>
	<% if (hasmore) {%>
	<li class="loading"><div class="spinner"><i></i></div><?=__('订单数据读取中')?>...</li>
	<% } %>

</script>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script>
// function getQueryString(name){
//     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
//     var r = window.location.search.substr(1).match(reg);
//
//     if (name == 'store_id')
//     {
//         if (!SYS.MULTISHOP_ENABLE)
//         {
//             return SYS.STORE_ID;
//         }
//     }
//
//     if (r!=null) return r[2]; return '';
// }

  var state = getQueryString('data-state');
  if(state =='2010')
  {
    var navigate_id ="4";
    $('#filtrate_ul li').eq(1).addClass('selected').siblings().removeClass('selected');
  }
  else{
    var navigate_id ="2";
  }
</script>

<script type="text/javascript" src="../../js/tmpl/seller/seller_order_list.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
