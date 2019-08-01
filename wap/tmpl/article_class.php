<?php
include __DIR__ . '/../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
	<meta charset="UTF-8">
	<title><?=__('文类分类')?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
</head>
<body>
<header id="header">
	<div class="header-wrap">
		<div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
		<div class="header-title">
			<h1><?=__('文类分类')?></h1>
		</div>
		<div class="header-r">
			<a id="header-nav" href="article_class.html?ac_id=1"><i class="zc zc-more more"></i><sup></sup></a>
		</div>
	</div>
</header>
<div id="article-content">
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="article-class">
	<% if(items.length >0){%>
	<ul class="article-class">
		<% for (var i = 0;i<items.length;i++){%>
		<li class="article-class-item">
			<a href="<%=WapSiteUrl%>/tmpl/article_list.html?ac_id=<%=items[i].category_id%>"><%=items[i].category_name%>
			</a>
		</li>
		<%}%>
	</ul>
	<%}else{%>
	<div class="no-record m10"><?=__('暂无记录')?></div>
	<%}%>
</script>
<script> var navigate_id ="1";</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/article_class.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>