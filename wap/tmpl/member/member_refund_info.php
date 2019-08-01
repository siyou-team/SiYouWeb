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
<div class="sstouch-main-layout" id="refund-info-div"> </div>
<footer id="footer"></footer>
<script type="text/html" id="refund-info-script">
<h3 class="sstouch-default-list-tit"><?=__('我的退款申请')?></h3>
<ul class="sstouch-default-list">
  <li>
    <h4><?=__('退款编号')?></h4>
    <span class="num"><%=refund.refund_sn%></span> </li>
  <li>
    <h4><?=__('退款原因')?></h4>
    <span class="num"><%=refund.reason_info%></span></li>
  <li>
    <h4><?=__('退款金额')?></h4>
    <span class="num"><%=refund.refund_amount%></span></li>
  <li>
    <h4><?=__('退款说明')?></h4>
    <span class="num"><%=refund.buyer_message%></span></li>
  <li>
    <h4><?=__('凭证上传')?></h4>
    <span class="pics">
    <% for (var k in pic_list) { %>
    <img src="<%=pic_list[k]%>" />
    <% } %>
    </span></li>
</ul>
<h3 class="sstouch-default-list-tit"><?=__('商家退款处理')?></h3>
<ul class="sstouch-default-list">
  <li>
    <h4><?=__('审核状态')?></h4>
    <span class="num"><%=refund.seller_state%></span></li>
  <li>
    <h4><?=__('商家备注')?></h4>
    <span class="num"><%=refund.seller_message%></span></li>
</ul>
<h3 class="sstouch-default-list-tit"><?=__('商城退款审核')?></h3>
<ul class="sstouch-default-list">
  <li>
    <h4><?=__('平台确认')?></h4>
    <span class="num"><%=refund.admin_state%></span></li>
  <li>
    <h4><?=__('平台备注')?></h4>
    <span class="num"><%=refund.admin_message%></span></li>
</ul>
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
<script type="text/javascript" src="../../js/tmpl/member_refund_info.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
