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
<title><?=__('扫码核销')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">
  <style>
    .jsbridge {
      height: 200px;
      width: 200px;
      background-color: red;
    }

    .upimg {
      height: 200px;
      width: 200px;
      background-color: green;
      margin-bottom: 50px;
    }


    input[node-type=jsbridge]{
      visibility: hidden;
      width: 1rem;
    }
  </style>
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('扫码核销')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-daiziti scan"></i></a> </div>
  </div>
</header>
<div class="sstouch-main-layout" style="margin-bottom: 14rem!important">
  <div class="sstouch-order-search"  style="height: auto !important">
    <form class="sstouch-inp-con">
      <input type="text" autocomplete="on" maxlength="50" placeholder="<?=__('请输入提货码进行核销')?>" name="pickup_code" id="pickup_code" oninput="writeClear($(this));" >
      <span class="input-del"></span>
      <div id="scan_btn" class="zc" style="width:2rem;height: 44px;line-height: 44px;font-size: 1rem;float: right;opacity: 0.6;">&#xe630;<input class="no-follow" node-type="jsbridge" type="file" name="myPhoto" value="<?=__('扫描二维码1')?>" /></div>

      <div class="form-btn"><a class="btn J_search" href="javascript:;"><?=__('查询订单')?></a></div>
    </form>
  </div>

  <div class="sstouch-order-list">
    <ul id="order-detail">
    </ul>
  </div>

</div>
<footer id="footer" class="bottom"></footer>


<script type="text/html" id="order-detail-tmpl">
  <%
  var order_detail = data;
  var StateCode = getStateCode();
  %>
  <li class="green-order-skin mt10">
    <%
    var order_goods = order_detail.items;
    %>
    <div class="sstouch-order-item">
      <div class="sstouch-order-item-head">

        <a class="store"><?=__('单号')?>:<%=order_detail.order_id%></a>

        <span class="state">

							<span class="<%=stateClass%>"><%=$getLocalTime(order_detail.order_time)%></span>
						</span>
      </div>
      <div class="sstouch-order-item-con">
        <%
        var count = 0;
        for (var k=0; k< order_goods.length; k++){
        count += parseInt(order_goods[k].order_item_quantity);
        %>
        <div class="goods-block">
          <div class="goods-pic">
            <img src="<%=order_goods[k].order_item_image%>"/>
          </div>
          <dl class="goods-info">
            <dt class="goods-name"><%=order_goods[k].item_name%></dt>
            <dd class="goods-type"><?=__('买家')?>:<%=order_detail.buyer_user_name%></dd>
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
          <span><?=__('共')?><em><%=count1%></em><?=__('件')?><?=__('商品')?>，<?=__('合计')?></span><span class="sum">￥<em><%=order_detail.order_payment_amount%></em></span><span class="freight">(<?=__('含运费')?>￥<%=order_detail.order_shipping_fee%>)</span>
        </div>

        <div class="handle" order_state_id="<%= order_detail.order_state_id  %>" buyer_name="<%=order_detail.buyer_user_name%>">

          <a href="javascript:void(0)" class="btn"><%=order_detail.order_state_name%></a>

          <%if(0 && order_detail.order_state_id == StateCode.ORDER_STATE_WAIT_FINANCE_REVIEW){%>
          <p><?=__('退款/退货中')?>...</p>
          <%}%>

          <%if(order_detail.order_state_id == StateCode.ORDER_STATE_WAIT_PAY){%>
          <a href="javascript:void(0)" order_id="<%=order_detail.order_id%>" opera_name="<?=__('添加收款记录')?>" order_sn="<%=order_detail.order_id%>" class="btn add-fund key"><?=__('添加收款记录')?></a>
          <%}%>


          <%if(order_detail.order_state_id == StateCode.ORDER_STATE_SHIPPED || order_detail.order_state_id == StateCode.ORDER_STATE_RECEIVED || order_detail.order_state_id == StateCode.ORDER_STATE_FINISH  || order_detail.order_state_id == StateCode.ORDER_STATE_CANCEL){%>
          <%} else {%>
          <a href="javascript:void(0)"  order_id="<%=order_detail.order_id%>" pickup_code="<%=pickup_code%>" class="btn key J_pickup"<?=__('核销')?></a>
          <%}%>
        </div>
      </div>
    </div>
  </li>
  <% if (hasmore) {%>
  <li class="loading"><div class="spinner"><i></i></div><?=__('订单数据读取中')?>...</li>
  <% } %>

</script>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/qrcode.lib.min.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/store_order_verification.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
