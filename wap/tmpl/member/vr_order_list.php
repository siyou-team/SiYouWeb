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
<title><?=__('虚拟订单')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">
</head>
<body>
<header id="header" class="app-no-fixed appshow">
  <div class="header-wrap">
    <div class="header-l"> <a href="member.html"> <i class="zc zc-back back"></i> </a> </div>
    <span class="header-tab"><a href="order_list.html"><?=__('实物订单')?></a><a href="javascript:void(0);" class="cur"><?=__('虚拟订单')?></a></span>
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
<div class="sstouch-main-layout mt2rem">
  <div class="sstouch-order-search">
    <form>
      <span>
      <input type="text" autocomplete="on" maxlength="50" placeholder="<?=__('输入商品标题或订单号进行搜索')?>" name="order_key" id="order_key" oninput="writeClear($(this));" >
      </span> <span class="input-del"></span>
      <input type="button" id="search_btn" value="&nbsp;">
    </form>
  </div>
  <div id="fixed_nav" class="sstouch-single-nav">
    <ul id="filtrate_ul" class="w25h">
      <li class="selected"><a href="javascript:void(0);" data-state=""><?=__('全部')?></a></li>
      <li><a href="javascript:void(0);" data-state="2010"><?=__('待付款')?></a></li>
        <li><a href="javascript:void(0);" data-state="2040"><?=__('待服务')?></a></li>
        <li class="evaluation-enable"><a href="javascript:void(0);" data-state="state_noeval"><?=__('待评价')?></a></li>
      <!--<li><a href="javascript:void(0);" data-state="state_pay">待使用</a></li>-->
    </ul>
  </div>
  <div class="sstouch-order-list" id="order-list"> </div>
</div>
<!--底部总金额固定层End-->
<div class="sstouch-bottom-mask">
  <div class="sstouch-bottom-mask-bg"></div>
  <div class="sstouch-bottom-mask-block">
    <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
    <div class="sstouch-bottom-mask-top">
      <p class="sstouch-cart-num"><?=__('本次交易需在线支付')?><em id="onlineTotal">0.00</em><?=__('点击此处返回')?>元</p>
      <p style="display:none" id="isPayed"></p>
      <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a> </div>
    <div class="sstouch-inp-con sstouch-inp-cart">
      <ul class="form-box" id="internalPay">
        <p class="rpt_error_tip" style="display:none;color:red;"></p>
        <li class="form-item" id="wrapperUseRCBpay">
          <div class="input-box pl5">
            <label>
              <input type="checkbox" class="checkbox" id="useRCBpay" autocomplete="off" />
              <?=__('使用充值卡支付')?> <span class="power"><i></i></span> </label>
            <p><?=__('可用余额')?> ￥<em id="availableRcBalance"></em></p>
          </div>
        </li>
        <li class="form-item" id="wrapperUsePDpy">
          <div class="input-box pl5">
            <label>
              <input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
              <?=__('预存款支付')?>  <span class="power"><i></i></span> </label>
            <p><?=__('可用余额')?>  ￥<em id="availablePredeposit"></em></p>
          </div>
        </li>

          <li class="form-item" id="wrapperUsePoints">
              <div class="input-box pl5">
                  <label>

                      <input type="checkbox" class="checkbox" id="usePoints" autocomplete="off" />
                      <?=__('积&nbsp;&nbsp;分&nbsp;&nbsp;支付')?> <span class="power"><i></i></span>
                  </label>
                  <p>   <?=__('￥')?>  <em id="availablePointsMoney"></em>    <?=__('当前积分')?>   <em id="availablePoints"></em></p>
              </div>
          </li>


          <li class="form-item" id="wrapperUseCredit">
              <div class="input-box pl5">
                  <label>
                      <input type="checkbox" class="checkbox" id="useCredit" autocomplete="off" />
                    <?=__(' 信 用 支 付')?>  <span class="power"><i></i></span>
                  </label>
                  <p><?=__(' 可用信用余额')?> <?=__('￥')?><em id="availableCredit"></em></p>
              </div>
          </li>
        <li class="form-item" id="wrapperPaymentPassword" style="display:none">
          <div class="input-box"> <span class="txt"><?=__('输入支付密码')?></span>
            <input type="password" class="inp" id="paymentPassword" autocomplete="off" />
            <span class="input-del"></span></div>
          <a href="../member/member_paypwd_step1.html" class="input-box-help" style="display:none"><i>i</i><?=__('尚未设置')?></a> </li>
      </ul>
      <div class="sstouch-pay">
        <div class="spacing-div"><span><?=__('在线支付方式')?></span></div>
        <div class="pay-sel">
          <label style="display:none">
            <input type="radio" name="payment_channel_code" class="checkbox" id="alipay" autocomplete="off" />
            <span class="alipay"><?=__('支付宝')?></span></label>
          <label style="display:none">
            <input type="radio" name="payment_channel_code" class="checkbox" id="wx_native" autocomplete="off" />
            <span class="wxpay"><?=__('微信')?></span></label>
        </div>
      </div>
      <div class="pay-btn"> <a href="javascript:void(0);" id="toPay" class="btn-l"><?=__('确认支付')?></a> </div>
    </div>
  </div>
</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="order-list-tmpl">
<div class="order-list"><% var order_list = items;
    var StateCode = getStateCode(); %>
    <% if (order_list && order_list.length > 0) { %>
	<ul>
    <% for (var i = 0; i < order_list.length; i++) { var order = order_list[i]; %>
        <li class="<% if (order.order_is_paid != getStateCode().ORDER_PAID_STATE_YES) { %>gray-order-skin<% } else { %>green-order-skin<% } %> mt10">
			<div class="sstouch-order-item">
				<div class="sstouch-order-item-head">
					<%if (order.self_support){%>
						<a class="store"><i class="icon"></i><%=order.store_name%></a>
					<%}else{%>
						<a href="../../tmpl/store.html?store_id=<%=order.store_id%>" class="store"><i class="icon"></i><%=order.store_name%><i class="zc zc-arrow-r arrow-r"></i></a>
					<%}%>
					<span class="state">
				     <span class="<% if (order.order_state_id == getStateCode().ORDER_STATE_CANCEL) { %>ot-cancel<% } else { %>ot-nofinish<% } %>">
                            <%= order.order_state_name %>
                        </span>
					</span>
				</div>
				<div class="sstouch-order-item-con">
                    <% for(var j = 0;j<order.item.length;j++){
                    var order_goods = order.item[j];
                    count += order_goods.order_item_quantity;
                    %>
                    <div class="goods-block">
                        <a href="../../tmpl/member/vr_order_detail.html?order_id=<%=order.order_id%>">
                            <div class="goods-pic">
                                <img src="<%=order_goods.order_item_image%>"/>
                            </div>
                            <dl class="goods-info">
                                <dt class="goods-name"><%=order_goods.item_name%></dt>
                                <dd class="goods-type"><%=order_goods.activity_type_name%></dd>
                            </dl>
                            <div class="goods-subtotal">
                                <%if (2 == order.cart_type_id || order_goods.order_item_points_fee){%>
                                <span class="goods-price"><em><%=order_goods.order_item_points_fee/order_goods.order_item_quantity%></em><?=__('积分')?></span>
                                <span class="goods-num">x<%=order_goods.order_item_quantity%></span>
                                <%} else {%>
                                        <span class="goods-price">
                                            <%if (order_goods.order_item_unit_price){%>
                                            ￥<em><%=order_goods.order_item_unit_price%></em>
                                            <%}%>

                                            <%if (order_goods.item_unit_points){%>
                                            <em><%=order_goods.item_unit_points%></em><?=__('积分')?>
                                            <%}%>
                                        </span>
                                        <span class="goods-num">x<%=order_goods.order_item_quantity%></span>
                                <%}%>
                            </div>
                        </a>
                    </div>
                    <%}%>

				</div>
				<div class="sstouch-order-item-footer">
					<div class="store-totle">

                        <%if (2 == order.cart_type_id){%>
                        <span><?=__('合计')?></span><span class="sum"><%=order.order_points_fee%></em><?=__('积分')?></span>
                        <%} else {%>
                        <span><?=__('合计')?></span>

                        <%if (order.order_payment_amount){%>
                        <span class="sum"><?=__('￥')?><em><%=order.order_payment_amount%></em></span>
                        <%}%>

                        <%if (order.order_resource_ext1){%>
                        <span class="sum"><em><%=order.order_resource_ext1%></em><?=__('积')?></span>
                        <%}%>

                        <%}%>

					</div>
					<div class="handle">
					<% if (order.order_is_paid == getStateCode().ORDER_PAID_STATE_NO) { %>
                        <a href="javascript:void(0)" order_id="<%=order.order_id%>" class="btn cancel-order"><?=__('取消订单')?></a>
                    <% } %>
					<% if (order.order_buyer_evaluation_status == 0 && order.order_state_id == getStateCode().ORDER_STATE_FINISH) { %>
                        <a href="javascript:void(0)" order_id="<%=order.order_id%>" class="btn evaluation-order"><?=__('评价订单')?></a>
                    <% } %>
					</div>
				</div>
				</div>
				<% if (order.order_is_paid != getStateCode().ORDER_PAID_STATE_YES) { %>
            		<a href="javascript:;" data-paySn="<%=order.order_id %>" class="btn-l check-payment"><?=__('订单支付')?><em>（￥<%= p2f(order.order_payment_amount) %>）</em></a>
        		<% } %>
        	</li>
		<% } %>
		<% if (hasmore) {%>
		<li class="loading"><div class="spinner"><i></i></div><?=__('订单数据读取中')?>...</li>
		<% } %>
	</ul>
	<% } else { %>
    <div class="sstouch-norecord order">
					<div class="norecord-ico"><i></i></div>
					<dl>
                    	<dt><?=__('您还没有相关的订单')?></dt>
						<dd><?=__('可以去看看哪些想要买的')?></dd>
					</dl>
					<a href="../../index.html" class="btn"><?=__('随便逛逛')?></a>
                </div>
	<% } %>
</div>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/order_payment_common.js"></script>
<script type="text/javascript" src="../../js/tmpl/vr_order_list.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
