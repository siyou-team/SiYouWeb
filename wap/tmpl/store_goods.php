<?php
include __DIR__ . '/../includes/header.php';
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
<title><?=__('店铺商品')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_store.css">

<!-- loadcss 不完美-->
<link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">

</head>
<body>
<header id="header" class="sstouch-store-header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <a class="header-inp" id="goods_search" href=""><i class="zc zc-search-thin icon"></i><span class="search-input"><?=__('搜索店铺内商品')?></span></a>
    <div class="header-r"> <a id="store_categroy" href="" class="store-categroy"><i class="zc zc-categroy-3"></i>
      <p><?=__('分类')?></p>
    </a> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a></div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
        <li><a href="search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
        <li><a href="product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
        <li><a href="cart_list.html"><i class="zc zc-cart cart"></i><?=__('购物车')?><sup></sup></a></li>
        <li><a href="member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout mt40" id="goodslist_con"></div>
<div class="fix-block-r">
  <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<!-- <footer id="footer"></footer> -->
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>

<script>
$(function() {
  var store_id = getQueryString("store_id");
  $("#goods_search").attr('href','store_search.html?store_id='+store_id);
  $("#store_categroy").attr('href','store_search.html?store_id='+store_id);

  //加载列表页
  $("#goodslist_con").load('store_goods_list.html');
});
</script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>