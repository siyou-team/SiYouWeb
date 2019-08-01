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
<title><?=__('退款详情')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <span class="header-title">
    <h1><?=__('退款详情')?></h1>
    </span>
  </div>
</header>
<div class="sstouch-main-layout" id="return-info-div"> </div>
<footer id="footer"></footer>
<script type="text/html" id="return-info-script">

  <% for(var i=0;i<items.length;i++){ var val=items[i];%>
<h3 class="sstouch-default-list-tit"><?=__('我的退款申请')?></h3>
<ul class="sstouch-default-list">
  <li>
    <h4><?=__('退款编号')?></h4>
    <span class="num"><%=return_id%></span>
  </li>
  <li>
    <h4><?=__('申请时间')?></h4>
    <span class="num"><%=return_add_time%></span>
  </li>
  <li>
    <h4><?=__('退款原因')?></h4>
    <span class="num"><%=return_reason_name%></span>
  </li>
  <li>
    <h4><?=__('申请金额')?></h4>
    <span class="num"><?=__('￥')?><%=submit_return_refund_amount%><?=__('元')?></span>
  </li>
  <li>
    <h4><?=__('退款金额')?></h4>
    <span class="num"><?=__('￥')?><%=return_refund_amount%><?=__('元')?></span>
  </li>
  <li>
    <h4><?=__('备注')?></h4>
    <span class="num"><%=return_buyer_message%></span>
  </li>
  <li>
    <h4><?=__('退款商品明细')?></h4>
        <ul class="items">
        <% if (items &&  items.length>0) {%>
        <% for (var k=0;k<items.length;k++) { var item=items[k] %>
          <li class="mt10">
            <div class="sstouch-order-item">
              <div class="sstouch-order-item-con">
                <div class="goods-block">
                  <a href="../../tmpl/product_detail.html?product_id=<%=item.product_id%>">
                    <div class="goods-pic">
                        <img src="<%=item.order_item_image%>"/>
                    </div>
                    <dl class="goods-info" style="margin-right: auto;">
                      <dt class="goods-name"><%=item.item_name%> x <%= item.return_item_num %></dt>
                      <dd class="goods-type"><%=item.spec_info%></dd>
                    </dl>
                    <div class="store-totle">
                      <span class="refund-sum"><?=__('退款金额')?>：<em>￥<%=item.return_item_subtotal%></em></span>
                    </div>
                      <% if(item.return_item_image && item.return_item_image.length>0){%>
                      <span class="pics">
                      <h5><?=__('上传凭证')?></h5>
                      <%for( var t=0;t<item.return_item_image.length;t++){%>
                        <img src="<%=item.return_item_image[t]%>" />
                      <% } %>
                      </span>
                      <% } %>
                  </a>
                </div>
              </div>
            </div>
          </li>

        <% } %>
        <% } %>
        </ul>
    </li>
  <% if(return_is_paid == 0 && return_state_id != getStateCode().RETURN_PROCESS_FINISH){ %>
  <li>
    <a href="javascript:void(0);" data-return_id="<%=return_id%>" class="btn-l confirm-refund"><?=__('确认收款')?><em></em></a>
  </li>
  <% } %>
  <!---->
  <% if(return_state_id == getStateCode().RETURN_PROCESS_CHECK && return_is_paid == 1){ %>
  <a href="javascript:void(0);" data-return_id="<%=return_id%>" class="btn-l cancel-return"><?=__('取消退单')?><em></em></a>
  <% } %>
</ul>
<h3 class="sstouch-default-list-tit"><?=__('商家退款处理')?></h3>
<ul class="sstouch-default-list">
  <li>
    <h4><?=__('审核状态')?></h4>
    <span class="num"><%= return_state_name%></span>
  </li>
  <li class="<%= (return_state_id== getStateCode().RETURN_PROCESS_SUBMIT || return_state_id== getStateCode().RETURN_PROCESS_CHECK) ? 'hide' : '' %>">
    <h4><?=__('是否退货')?></h4>
    <span class="num"><%=return_flag ? "<?=__('退货')?>" : "<?=__('不退货')?>" %></span>
  </li>
  <li class="<%= (return_state_id== getStateCode().RETURN_PROCESS_SUBMIT || return_state_id== getStateCode().RETURN_PROCESS_CHECK) ? 'hide' : '' %>">
    <h4><?=__('商家备注')?></h4>
    <span class="num"><%=return_store_message%></span>
  </li>
</ul>
<% if(plantform_return_state_id != getStateCode().PLANTFORM_RETURN_STATE_WAITING){ %>
  <h3 class="sstouch-default-list-tit"><?=__('商城退款审核')?></h3>
  <ul class="sstouch-default-list">
    <li>
      <h4><?=__('平台确认')?></h4>
      <%if(plantform_return_state_id == getStateCode().PLANTFORM_RETURN_STATE_WAITING){ %>
      <span class="num"><?=__('待处理')?></span>
      <% } else if (plantform_return_state_id == getStateCode().PLANTFORM_RETURN_STATE_AGREE) { %>
      <span class="num"><?=__('处理中')?></span>
      <% } else if (plantform_return_state_id == getStateCode().PLANTFORM_RETURN_PROCESS_FINISH) { %>
      <span class="num"><?=__('已完成')?></span>
      <% } %>
    </li>
    <li>
      <h4><?=__('平台备注')?></h4>
      <span class="num"><%=return_platform_message%></span></li>
  </ul>
<% } %>
<% } %>



  <%if(!isEmpty(detail_array)) {%>
<h3 class="sstouch-default-list-tit"><?=__('退款详细')?></h3>
<ul class="sstouch-default-list">
  <li>
    <h4><?=__('支付方式')?></h4>
    <span class="num"><%=detail_array.refund_code%></span></li>
  <li>
    <h4><?=__('在线退款金额')?></h4>
    <span class="num"><%=detail_array.pay_amount%></span></li>
  <li>
    <h4><?=__('预存款返还金额')?></h4>
    <span class="num"><%=detail_array.pd_amount%></span></li>
  <li>
    <h4><?=__('充值卡返还金额')?></h4>
    <span class="num"><%=detail_array.rcb_amount%></span></li>
</ul>
<%}%>

</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/member_return_info.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
