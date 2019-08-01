<?php
include __DIR__ . '/../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
	<meta charset="UTF-8">
	<title id="art_name"></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
<style type="text/css">body { background: #fff}</style>

</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1 id="art_title"></h1>
    </div>
    <div class="header-r">
			<a id="header-nav" href="article_class.html?ac_id=1"><i class="zc zc-more more"></i><sup></sup></a>
		</div>
  </div>
</header>
		<div class="sstouch-main-layout">
      <div id="article-content"></div>
</div>
	<footer id="footer" class="bottom"></footer>
<script type="text/html" id="article">
		<div class="article-title"><%=article_title%></div>
		<div class="article-content"></div>
	</div>
</script>
<script> var navigate_id ="1";</script> 
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/article_show.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>