<?php
include __DIR__ . '/../includes/header.php';
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
<title><?=__('商品搜索')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
</head>
<body>
<header id="header" class="appshow">
	<div class="header-wrap">
		<div class="header-l">
			<a href="javascript:history.go(-1)">
				<i class="zc zc-back back"></i>
			</a>
		</div>
		<div class="header-inp">
			<i class="zc zc-search-thin icon"></i>
			<input type="text" class="search-input" value="" oninput="writeClear($(this));" id="keyword" placeholder="<?=__('请输入搜索关键词')?>" maxlength="50" autocomplete="on" autofocus>
			<span class="input-del"></span>
		</div>
		<div class="header-r">
			<a id="header-nav" href="javascript:void(0);" class="search-btn"><?=__('搜索')?></a>
		</div>
	</div>
</header>

<!-- 全文搜索提示 begin -->
<div class="sstouch-main-layout mb-20" id="search_tip_list_container" style="display:none"></div>
<script type="text/html" id="search_tip_list_script">
<ul class="sstouch-default-list">
<%for(i = 0; i < list.length; i++){%>
	<li><a href="<%=$buildUrl('keyword',list[i])%>"><%=list[i]%></a></li>
<%}%>
</ul>
</script>
<!-- 全文搜索提示 end -->

<div id="store-wrapper">
  <div class="sstouch-search-layout">
    <dl class="hot-keyword">
      <dt><?=__('热门搜索')?></dt>
      <dd id="hot_list_container"></dd>
    </dl>
    <dl>
      <dt><?=__('历史纪录')?></dt>
      <dd id="search_his_list_container"></dd>
    </dl>
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="hot_list">
<ul>
<%for(i = 0; i < hot_list.length; i++){%>
	<li><a href="<%=$buildUrl('keyword',hot_list[i])%>"><%=hot_list[i]%></a></li>
<%}%>
</ul>
</script>
<script type="text/html" id="search_his_list">
<ul>
<%for(i = 0; i < search_his_list.length; i++){%>
	<li><a href="<%=$buildUrl('keyword',search_his_list[i])%>"><%=search_his_list[i]%></a></li>
<%}%>
</ul><a href="javascript:void(0);" class="clear-history" onclick="$(this).prev().remove();delLocalStorage('hisSearch');"<?=__('清空历史')?></a>
</script>
<script> var navigate_id ="3";</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/search.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>