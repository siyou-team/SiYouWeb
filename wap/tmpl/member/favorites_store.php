<?php
include __DIR__ . '/../../includes/header.php';
?>
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
<title><?=__('店铺收藏')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_products_list.css">
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="member.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-tab"><a href="favorites.html"><?=__('商品收藏')?></a><a href="javascript:void(0);" class="cur"><?=__('店铺收藏')?></a></div>
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
      <ul class="favorites-store-list" id="favorites_list"></ul>
</div>
<div class="fix-block-r">
    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="sfavorites_list">
    <%if(items.length>0){%>
        <% for (var k in items) { var v = items[k]; %>
        <li id="favitem_<%=v.favorites_store_id %>">
            <a href="../../tmpl/store.html?store_id=<%=v.store_id %>">
                <div class="store-avatar"><img src="<%=v.store_logo %>"/></div>
                <dl class="store-info">
                    <dt class="store-name"><%=v.store_name %></dt>
                    <dd class=""><span>粉丝：<em><%=v.store_favorite_num %></em>人</span> &nbsp;&nbsp;<span><?=__('销量')?>：<em><%=v.store_sales_num %></em><?=__('件')?></span></dd>
                </dl>
            </a>
			<a href="javascript:void(0);" shopsuite_type="fav_del" data_id="<%=v.favorites_store_id %>" data-store_id="<%=v.store_id %>" class="del-fav"></a>
        </li>
        <%}%>
        <li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>
    <%}else{%>
    <div class="sstouch-norecord favorite-store">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您还没有关注任何店铺')?></dt>
            <dd><?=__('可以去看看哪些店铺值得收藏')?></dd>
        </dl>
        <a href="../../index.html" class="btn"><?=__('随便逛逛')?></a>
    </div>
    <%}%>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/favorites_store.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
