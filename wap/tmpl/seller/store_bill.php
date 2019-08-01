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
<title><?=__('统计结算-商家中心')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">
</head>
<body>
<header id="header" class="app-no-fixed">
   <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
    <div class="header-title">
      <h1><?=__('统计结算')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../seller"><i class="zc zc-home home"></i><?=__('商家中心')?></a></li>
        <li><a href="../seller/goods_add.html"><i class="zc zc-shangpinfabu"></i><?=__('商品发布')?></a></li>
        <li><a href="../seller/goods_list.html"><i class="zc zc-shangpinguanli"></i><?=__('商品管理')?></a></li>
        <li><a href="../seller/order_list.html"><i class="zc zc-wodedingdan"></i><?=__('订单管理')?></a><sup></sup></li>
        <li><a href="../seller/order_list.html?data-state=2010"><i class="zc zc-shezhidaifahuo"></i><?=__('设置发货')?></a><sup></sup></li>
        <li><a href="../seller/chat_list.html"><i class="zc zc-zaixian-im"></i><?=__('IM客服')?><sup></sup></a></li>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout">
<!--   <div class="sstouch-order-search">
    <form>
      <span><input type="text" autocomplete="on" maxlength="50" placeholder="输入商品标题或订单号进行搜索" name="order_key" id="order_key" oninput="writeClear($(this));" >
      <span class="input-del"></span></span>
      <input type="button" id="search_btn" value="&nbsp;">
    </form>
  </div> -->
<!--   <div id="fixed_nav" class="sstouch-single-nav">
    <ul id="filtrate_ul" class="w20h">
      <li class="selected"><a href="javascript:void(0);" data-state="">出售商品</a></li>
      <li><a href="javascript:void(0);" data-state="2010">仓库商品</a></li>
      <li><a href="javascript:void(0);" data-state="state_success">发布商品</a></li>
    </ul>
  </div> -->
  <div class="sstouch-order-list">
  	<div id="bill-list">

    </div>
  </div>

</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="bill-list-tmpl">
<% var bill_list = datas.bill_list; %>
<% if (bill_list.length > 0){%>
  <dl style="border-top: solid 0.05rem #EEE;">
          <dt>
            <h3>
            <span class="bill-2"><?=__('起止时间')?></span><span class="bill-3"><?=__('本期应收')?></span><span class="bill-4"><?=__('结算状态')?></span></h3>
            <h5></h5>

          </dt>
        </dl>
	<% for(var i = 0;i<bill_list.length;i++){
		var billList = bill_list[i];
	%>
		<dl style="border-top: solid 0.05rem #EEE;">
	        <dt><a href="store_bill_info.html?ob_id=<%=billList.ob_id;%>">
	          <h3><span class="bill-2"><%=billList.ob_time;%></span><span class="bill-3"><%=billList.ob_result_totals;%></span><span class="bill-4"><%=billList.ob_states;%></span></h3>
	          <h5><i class="zc zc-arrow-r arrow-r"></i></h5>
	          </a>
	        </dt>
      	</dl>
	<%}%>
	<% if (hasmore) {%>
	<li class="loading"><div class="spinner"><i></i></div><?=__('结算数据读取中')?>...</li>
	<% } %>
<%}else {%>
	<div class="sstouch-norecord order">
		<div class="norecord-ico"><i></i></div>
		<dl>
			<dt><?=__('您还没有结算数据')?></dt>
			<dd><?=__('可能还没有到结算日期请耐心等待')?></dd>
		</dl>
		<a href="<%=WapSiteUrl+'/tmpl/seller/member.html'%>" class="btn"><?=__('返回商家中心')?></a>
	</div>
<%}%>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>


<script type="text/javascript" src="../../js/tmpl/seller/store_bill.js"></script>

</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
