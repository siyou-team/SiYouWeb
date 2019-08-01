<?php
include __DIR__ . '/../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
<meta charset="UTF-8">
<title><?=__('商品分类')?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/child.css">
</head>
<body id="second_category">
<header id="header"></header>
<div class="content" id="content"></div>
<div id="footer"></div>
</body>
<script type="text/html" id="category2">
	<div class="categroy-cnt">
		<ul class="categroy-seciond-list">
			<%for(i=0;i<class_list.length;i++){%>
			<li class="category-seciond-item" category_id="<%=class_list[i].category_id%>">
				<div class="cs-frist-category">
					<%=class_list[i].category_name%>
					<span class="graydownarrow"></span>
				</div>
			</li>
			<%}%>
		</ul>
	</div>
</script>
<script type="text/html" id="category3">
	<ul class="categroy-third-list">
			<li><a href="javascript:void(0);" class="product_list" category_id="<%=category_id %>"><?=__('全部商品')?></a>
		<%for(i=0;i<class_list.length;i++){%>
			<li><a href="javascript:void(0);" class="product_list" category_id="<%=class_list[i].category_id%>"><%=class_list[i].category_name%></a></li>
		<%}%>
	</ul>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../js/tmpl/common-top.js"></script>
<script type="text/javascript" src="../js/tmpl/categroy-second-list.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>