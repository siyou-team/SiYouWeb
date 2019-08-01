<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="Author" contect="U2FsdGVkX1+liZRYkVWAWC6HsmKNJKZKIr5plAJdZUSg1A==">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="format-detection" content="telephone=no"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<meta name="format-detection" content="telephone=no" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title><?=__('浏览历史')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_products_list.css">
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
    <div class="header-title">
      <h1><?=__('浏览历史')?></h1>
    </div>
    <div class="header-r">
		<a id="clearbtn" href="javascript:void(0);" class="text"><?=__('清空')?></a>
	</div>
  </div>
</header>
<div class="sstouch-main-layout">
  <div id="viewlist" class="list"> </div>
</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>

<footer id="footer"></footer>
<script type="text/html" id="viewlist_data">
<% if (items.length > 0) {%>
	<ul class="goods-secrch-list">
	<% for (var i=0; i<items.length; i++) {%>
	<li class="goods-item">
		<span class="goods-pic">
			<a href="../product_detail.html?item_id=<%=items[i].item_id%>">
				<img src="<%=items[i].product_image%>"/>
			</a>
		</span>
		<dl class="goods-info">
			<dt class="goods-name">
				<a href="../product_detail.html?item_id=<%=items[i].item_id%>">
					<h4><%=items[i].product_item_name%></h4>
					<h6></h6>
				</a>
			</dt>
			<dd class="goods-sale">
				<a href="../product_detail.html?item_id=<%=items[i].item_id%>">
					<span class="goods-price">￥<em><%=items[i].item_unit_price%></em></span>
				</a>
			</dd>
		</dl>
</li>
<% } %>
<li class="loading"><div class="spinner"><i></i></div><?=__('浏览记录读取中')?>...</li>
</ul>
<% } else {%>
	<div class="sstouch-norecord views">
		<div class="norecord-ico"><i></i></div>
		<dl>
			<dt><?=__('暂无您的浏览记录')?></dt>
			<dd><?=__('可以去看看哪些想要买的')?></dd>
		</dl>
		<a href="../../index.html" class="btn"><?=__('随便逛逛')?></a>
	</div>
<% } %>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/view_list.js"></script>

</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
