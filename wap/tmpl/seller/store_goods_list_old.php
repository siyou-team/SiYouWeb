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
<title><?=__('商品管理')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="app-no-fixed">
 <div class="header-wrap">
    <div class="header-l"> <a href="seller.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('商品管理')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <ul>
			<li><a href="seller.html"><i class="zc zc-home home"></i><?=__('商家中心')?></a></li>
			<li><a href="seller_address_list.html"><i class="zc zc-peisongdizhi"></i><?=__('发货地址')?></a></li>
			<li><a href="seller_express.html"><i class="zc zc-wuliukuaidi"></i><?=__('物流公司')?></a></li>
			<li><a href="seller_account.html"><i class="zc zc-yonghushezhi1"></i><?=__('店铺设置')?><sup></sup></a></li>
			<li><a href="chat_list.html"><i class="zc zc-message message"></i>IM <?=__('客服')?><sup></sup></a></li>
			<li id="logoutbtn"><a href="javascript:void(0);"><i class="zc zc-logout"></i><?=__('退出登录')?><sup></sup></a></li>
		</ul>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout">
  <div class="sstouch-order-search">
    <form>
      <span><input type="text" autocomplete="on" maxlength="50" placeholder="<?=__('输入商品标题进行搜索')?>" name="goods_key" id="goods_key" oninput="writeClear($(this));" >
      <span class="input-del"></span></span>
      <input type="button" id="search_btn" value="&nbsp;">
    </form>
  </div>
  <div id="fixed_nav" class="sstouch-single-nav">
    <ul id="filtrate_ul" class="w20h">
      <li class="selected"><a href="javascript:void(0);" data-state="1001"><?=__('出售中')?></a></li>
      <li><a href="javascript:void(0);" data-state="1002" id="state1002"><?=__('仓库中')?></a></li>
      <li><a href="javascript:void(0);" data-state="1000" id="state1000"><?=__('违规商品')?></a></li>
    </ul>
  </div>
  <div class="sstouch-order-list">
    <ul id="order-list">
    </ul>
  </div>

</div>

<footer id="footer" class="bottom"></footer>
<script type="text/html" id="order-list-tmpl">
<%
var goods_list = data.items;
var StateCode = getStateCode();
%>
<% if (goods_list.length > 0){%>
	<% for(var i = 0;i<goods_list.length;i++){ %>
    <div class="sstouch-order-item">
        <div class="sstouch-order-item-con">
            <div class="goods-block">
                <div class="goods-pic">
                    <img src="<%=goods_list[i].product_image%>" style="border:solid 1px #ccc;padding:1px;"/>
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"><%=goods_list[i].product_name%></dt>
                    <dd class="goods-type"><?=__('出售中')?>￥<%=goods_list[i].product_unit_price%>
                    <br/><?=__('日期')?>：<%= $getLocalTime(goods_list[i].product_add_time)%><!-- 库存：<%=goods_list[i].goods_storage_sum%>-->
                    </dd>
                </dl>
                <div class="goods-subtotal">
                    <a href="javascript:void(0)" item_id="<%=goods_list[i].product_id%>" class="hide"><?=__('编辑')?></a>
                    <% if (goods_list[i].product_state_id == StateCode.PRODUCT_STATE_OFF_THE_SHELF){ %>
                    <a href="javascript:void(0)" item_id="<%=goods_list[i].product_id%>" class="btn online-goods" style="margin-bottom: 10px;"><?=__('上架')?></a>
                    <% } else if(goods_list[i].product_state_id == StateCode.PRODUCT_STATE_NORMAL) { %>
                    <a href="javascript:void(0)" item_id="<%=goods_list[i].product_id%>" class="btn offline-goods"  style="margin-bottom: 10px;"><?=__('下架')?></a>
                    <% } else { %>
                    <?=__('禁售')?>
                    <% } %>
                    <a href="javascript:void(0)" item_id="<%=goods_list[i].product_id%>" class="btn delete-goods" ><?=__('删除')?></a>
                </div>
            </div>
        </div>
    </div>


	<%}%>
  <% if (hasmore) {%>
	<li class="loading"><div class="spinner"><i></i></div><?=__('订单数据读取中')?>...</li>
	<% } %>
<%}else {%>
	<div class="sstouch-norecord order">
		<div class="norecord-ico"><i></i></div>
		<dl>
			<dt><?=__('暂无数据！')?></dt>
		</dl>
	</div>
<%}%>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_goods_list.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
