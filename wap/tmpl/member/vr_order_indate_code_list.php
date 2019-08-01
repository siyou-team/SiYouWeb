<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html lang="zh-CN" >
<head>
<meta charset="UTF-8">
<title><?=__('兑换码列表')?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="../../css/reset.css">
<link rel="stylesheet" type="text/css" href="../../css/main.css">
<link rel="stylesheet" type="text/css" href="../../css/member.css">
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header"></header>
<div class="order-delivery-wp" id="order-indatecode"></div>
<script type="text/html" id="order-indatecode-tmpl">
<div class="order-delivery-wrapper">
<% if (err) { %>
	<div class="no-record m10"><%= err %></div>
<% } else { %>
	<ul class="order-delivery-infolist">
	<% for (var i in items) { %>
		<li>
			<b><%= items[i].chain_code %></b>
			（<?=__('过期时间')?>：<%= items[i].virtual_service_time %>）
		</li>
	<% } %>
	</ul>
<% } %>
</div>
</script>
<footer id="footer"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/common-top.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/vr_order_indate_code_list.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
