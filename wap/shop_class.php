<?php
include __DIR__ . '/includes/header.php';
?>

<!doctype html>
<html lang="zh-CN" >
<head>
<meta charset="UTF-8">
<title>所有店铺</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type="text/css" href="css/sstouch_products_list.css">
<style type="text/css">
.sstouch-footer-wrap { margin:0 auto; max-width:640px;}
</style>
</head>
<body>
<header id="header" class="fixed fixed-Width">
  <div class="header-wrap">
  	<div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
    <div class="header-tab"><a href="shop.html">所有店铺</a><a href="shop_class.html" class="cur">店铺分类</a></div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="index.html"><i class="zc zc-home home"></i>首页</a></li>
        <li><a href="tmpl/search.html"><i class="zc zc-search search"></i>搜索</a></li>
        <li><a href="tmpl/product_first_categroy.html"><i class="zc zc-categroy categroy"></i>分类</a></li>
        <li><a href="tmpl/cart_list.html"><i class="zc zc-cart cart"></i>购物车<sup></sup></a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i>消息<sup></sup></a></li>
        <li><a href="tmpl/member/member.html"><i class="zc zc-member member"></i>我的商城</a></li>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout fixed-Width">
      <ul class="favorites-store-list" id="categroy-cnt"></ul>
</div>
<footer id="footer"></footer>
</body>
</body>
<script type="text/html" id="category-one">
	<ul class="categroy-list">
		<% for(var i = 0;i<items.length;i++){
		var locUrl = "";
		if(items[i]['store_category_id'].toString().length >0) {
			locUrl = WapSiteUrl+"/shop.html?store_category_id="+items[i]['store_category_id'].toString();
		}else {
			locUrl = WapSiteUrl+"/index.html";
		}
		%>
		 <li>
            <a href="<%=locUrl%>">
                <dl class="store-info" style="margin-left:10px;">
                    <dt class="store-name"><%=items[i]['store_category_name'].toString() %></dt>
                </dl>
            </a>
        </li>
	
		<% } %>
	</ul>
</script>
<script> var navigate_id ="1";</script> 
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/libs/lib.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/shop_class.js"></script>
<script type="text/javascript" src="js/tmpl/footer.js"></script>
</html>

<?php
include __DIR__ . '/includes/footer.php';
?>
