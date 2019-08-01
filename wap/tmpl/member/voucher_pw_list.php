
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
<title><?=__('我的优惠券')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="member.html"><i class="zc zc-back back"></i></a></div>
    <span class="header-tab"> <a href="javascript:void(0);" class="cur"><?=__('我的优惠券')?></a> <a href="voucher_pwex.html"><?=__('领取优惠券')?></a> </span>
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
  <div class="sstouch-voucher-list">
    <ul class="sstouch-tickets" id="voucher-list">
    </ul>
  </div>
</div>
<div class="fix-block-r"> <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a> </div>

<script type="text/html" id="voucher-list-tmpl">
<% if (voucher_list && voucher_list.length > 0) { %>
<% for (var k in voucher_list) { var v = voucher_list[k]; %>
	<li class="ticket-item <% if (v.voucher_state == 1) { %>normal<% }else{ %>invalid<%}%>">
		<% if (v.store_is_selfsupport) { %>
		<a href="../product_list.html">
		<% }else{ %>
		<a href="../store.html?store_id=<%= v.store_id %>">
		<% } %>
		<div class="border-left"></div>
		<div class="block-center">
			<div class="store-info">
				<div class="store-avatar"><img src="<%= v.member_avatar %>" /></div>
				<dl>
					<dt class="store-name"><%= v.store_name %></dt>
					<dd><?=__('有效期至')?>：<%= tsToDateString(v.voucher_end_date)%></dd>
				</dl>
			</div>
			<div class="ticket-info">
				<div class="bg-ico"></div>
				<% if (v.voucher_state==2) { %>
				<div class="watermark ysy"></div>
				<% } %>
				<% if (v.voucher_state==3 || v.voucher_state==4) { %>
				<div class="watermark ysx"></div>
				<% } %>
				<dl>
				<dt>￥<%= v.voucher_price %></dt>
				<dd><% if (v.voucher_limit) { %><?=__('满')?><%= v.voucher_limit %><?=__('使用')?><% } %></dd>
				</dl>
			</div>
		</div>
		<div class="border-right"></div>
		</a>
	</li>
<% } %>
<li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>
<% } else { %>
	<div class="sstouch-norecord voucher">
		<div class="norecord-ico"><i></i></div>
		<dl>
			<dt><?=__('您还没有相关的优惠券')?></dt>
			<dd><?=__('店铺优惠券可享受商品折扣')?></dd>
		</dl>
	</div>
<% } %>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script>
	function showSpacing(){
		$('.spacing-div').remove();
		$('.invalid').first().before('<div class="spacing-div"><span><?=__('已失效的券')?></span></div>');
	}
	$(function(){
        if (!ifLogin()){return}

        //渲染list
		var load_class = new ssScrollLoad();
		load_class.loadInit({
			'url':ApiUrl + '/index.php?act=member_voucher&op=voucher_list',
			'getparam':{},
			'tmplid':'voucher-list-tmpl',
			'containerobj':$("#voucher-list"),
			'iIntervalId':true,
			'callback':showSpacing,
			'data':{WapSiteUrl:WapSiteUrl}
		});
	});
    template.helper('tsToDateString', function (t) {
        var d = new Date(parseInt(t) * 1000);
        var s = '';
        s += d.getFullYear() + '<?=__('年')?>';
        s += (d.getMonth() + 1) + '<?=__('月')?>';
        s += d.getDate() + '<?=__('日')?>';
        return s;
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
