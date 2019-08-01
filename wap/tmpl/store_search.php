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
<title><?=__('店内搜索')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_store.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1);"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-inp"> <i class="zc zc-search-thin icon"></i>
      <input type="text" class="search-input" id="search_keyword" placeholder="<?=__('请输入搜索关键词')?>" maxlength="50" autocomplete="on" autofocus>
    </div>
    <div class="header-r"><a id="search_btn" href="javascript:void(0);" class="search-btn"><?=__('搜索')?></a></div>
  </div>
</header>
<div class="sstouch-main-layout fixed-Width">
  <div class="sstouch-main-layout">
    <div class="categroy-cnt">
      <div class="categroy-all"><a id="goods_search_all" href="javascript:void(0);"><?=__('全部商品')?><i class="zc zc-arrow-r arrow-r"></i></a></div>
      <ul class="categroy-list" id="store_category">
      </ul>
    </div>
  </div>
</div>
<div class="fix-block-r">
  <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
</body>
<script type="text/html" id="store_category_tpl">
	<% for (var i in items) { var gc = items[i]; %>

		<li class="category-frist">
			<a class="level%= gc.level %" href="store_goods.html?store_id=<%= gc.store_id %>&store_category_ids=<%= gc.store_product_cat_id %>"><%= gc.store_product_cat_name %><span><?=__('查看全部')?></span></a>
		</li>

        <% if(gc.sub){ %>
            <% for(var j in gc.sub){ var v = gc.sub[j];%>
                <li class="category-seciond" >
                    <a href="store_goods.html?store_id=<%= v.store_id %>&store_category_ids=<%= v.store_product_cat_id %>"><%= v.store_product_cat_name %></a>
                </li>
            <%}%>
		<% }%>
	<% } %>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/store_search.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>