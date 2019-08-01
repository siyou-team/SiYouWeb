<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="format-detection" content="telephone=no"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<meta name="format-detection" content="telephone=no" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title>商品列表</title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_products_list.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<style type="text/css">
	.goods-profix-text {
		font-size: .6rem;
    	line-height: 1.1rem;
    	vertical-align: top;
   	 	display: inline-block;
    	color: #ff6700;
	}
</style>
</head>
<body>
<header id="header" class="sstouch-product-header fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-inp"> <i class="zc zc-search-thin icon"></i> <span class="search-input" id="keyword">请输入关键词</span> </div>
    <div class="header-r"> <a href="../tmpl/product_first_categroy.html"><i class="zc zc-categroy categroy"></i>
      </a> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../index.html"><i class="zc zc-home home"></i>首页</a></li>
        <li><a href="search.html"><i class="zc zc-search search"></i>搜索</a></li>
        <li><a href="product_first_categroy.html"><i class="zc zc-categroy categroy"></i>分类</a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i>消息<sup></sup></a></li>
        <li><a href="cart_list.html"><i class="zc zc-cart cart"></i>购物车<sup></sup></a></li>
        <li><a href="member/member.html"><i class="zc zc-member member"></i>我的商城</a></li>
      </ul>
    </div>
  </div>
</header>
<div class="goods-search-list-nav">
    <ul id="nav_ul">
      <li><a href="javascript:void(0);" class="current" id="sort_default">综合排序<i></i></a></li>
      <li><a href="javascript:void(0);" class="" onclick="init_get_list('DESC', 'product_sale_num')">销量优先</a></li>
      <li><a href="javascript:void(0);" id="search_filter">筛选<i></i></a></li>
    </ul>
    <div class="browse-mode"><a href="javascript:void(0);" id="show_style"><span class="browse-list"></span></a></div>
  </div>
<div id="sort_inner" class="goods-sort-inner hide"> <span><a href="javascript:void(0);" class="cur"  onclick="init_get_list('', '')">综合排序<i></i></a></span> <span><a href="javascript:void(0);" onclick="init_get_list('DESC', 'product_unit_price')">价格从高到低<i></i></a></span> <span><a href="javascript:void(0);" onclick="init_get_list('ASC', 'product_unit_price')">价格从低到高<i></i></a></span> <span><a href="javascript:void(0);" onclick="init_get_list('DESC', 'product_favorite_num')">人气排序<i></i></a></span> </div>
<div class="sstouch-main-layout mt40 mb20">
  <div id="product_list" class="list">
    <ul class="goods-secrch-list">
    </ul>
  </div>
</div>
<!--筛选部分-->
<div class="sstouch-full-mask hide">
  <div class="sstouch-full-mask-bg"></div>
  <div class="sstouch-full-mask-block">
    <div class="header">
      <div class="header-wrap">
        <div class="header-l"> <a href="javascript:void(0);"><i class="zc zc-back back"></i></a></div>
        <div class="header-title">
          <h1>商品筛选</h1>
        </div>
        <div class="header-r"><a href="javascript:void(0);" id="reset" class="text">重置</a> </div>
      </div>
    </div>
    <div class="sstouch-main-layout-a secreen-layout" id="list-items-scroll" style="top: 2rem;"><div></div></div>
  </div>
</div>
<div class="fix-block-r">
	<a href="member/views_list.html" class="browse-btn"><i></i></a>
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="search_items">
<div style="height:100%;">
	<dl>
		<dt>价格区间</dt>
		<dd>
			<span class="inp-balck"><input type="text" id="price_from" sstype="price" pattern="[0-9]*" class="inp" placeholder="最低价"/></span>
			<span class="line"></span>
			<span class="inp-balck"><input sstype="price" type="text" id="price_to" pattern="[0-9]*" class="inp" placeholder="最高价"/></span>
		</dd>
	</dl>
	<dl>
		<dt>积分区间</dt>
		<dd>
			<span class="inp-balck"><input type="text" id="points_from" sstype="price" pattern="[0-9]*" class="inp" placeholder="最低积分"/></span>
			<span class="line"></span>
			<span class="inp-balck"><input sstype="price" type="text" id="points_to" pattern="[0-9]*" class="inp" placeholder="最高积分"/></span>
		</dd>
	</dl>
	<dl>
		<dt>商品所在地</dt>
		<dd><span class="inp-balck add"><select id="district_id">
					<option value="">不限</option>
    				<% for (i = 0; i < area.length; i++) { %>
    				<option value="<%=area[i]['district_id']%>"><%=area[i]['district_name']%></option>
    				<% } %>
    				</select>
					<i></i>
			</span>
		</dd>
	</dl>
	<dl>
		<dt>商品类型</dt>
		<dd>
			<a href="javascript:void(0);" sstype="items" id="gift" class="">赠品</a>
			<a href="javascript:void(0);" sstype="items" id="groupbuy">抢购</a>
			<a href="javascript:void(0);" sstype="items" id="xianshi">限时折扣</a>
			<a href="javascript:void(0);" sstype="items" id="virtual">虚拟</a>
		</dd>
	</dl>
	<dl>
		<dt>店铺类型</dt>
		<dd>
			<a href="javascript:void(0);" sstype="items" id="selfsupport" class="">平台自营</a>
		</dd>
	</dl>
	<dl>
		<dt>店铺服务</dt>
		<dd>
    	<% for (i = 0; i < contract.length; i++) { %>
    	<a href="javascript:void(0);" sstype="items" name="ci" value="<%=contract[i]['contract_type_id']%>"><%=contract[i]['contract_type_name']%></a>
    	<% } %>
		</dt>
	</dl>
	<div class="bottom">
	<a href="javascript:void(0);" class="btn-l" id="search_submit">筛选商品</a>
	</div>
</div>
</script> 
<!--筛选部分-->
</body>
<script type="text/html" id="home_body">
	<% var goods_list = data.items; %>
	<% if(goods_list.length >0){%>
			<%for(i=0;i<goods_list.length;i++){%>
			<li class="goods-item" item_id="<%=goods_list[i]['item_color'][0].item_id;%>">
				<span class="goods-pic">
					<a id="goods_pic<%= goods_list[i]['item_color'][0].item_id %>" href="supplier_product_detail.html?item_id=<%=goods_list[i]['item_color'][0].item_id;%>">
						<img src="<%=$image_thumb(goods_list[i].product_image, 360) ;%>"/>
					</a>
				</span>
				<dl class="goods-info">
					<dt class="goods-name">
						<a href="supplier_product_detail.html?item_id=<%=goods_list[i]['item_color'][0].item_id;%>">
							<h4><%=goods_list[i].product_name;%></h4>
							<h6><%=goods_list[i].product_tips;%></h6>
						</a>
					</dt>
					

					<dd class="goods-profix">
						<a href="supplier_product_detail.html?item_id=<%=goods_list[i]['item_color'][0].item_id;%>">
							<span class="goods-profix-text">
								<span style="color: #999;font-size: 0.5rem">利润率&nbsp;</span>
								<em> <%=goods_list[i].product_retail_min_rate;%>%</em> ~ <em><%=goods_list[i].product_retail_max_rate;%>%</em>
							</span>
						</a>

					</dd>

					<dd class="goods-assist">
						<span class="goods-price" style="color: #ff6700;">
							<span style="color: #999;font-size: 0.5rem">批发价</span>
							<% if (goods_list[i].product_unit_price) {%>￥<em><%=goods_list[i].product_unit_price%></em><% } %><% if (goods_list[i].product_unit_points) {%><em>+<%=goods_list[i].product_unit_points%></em>积分<% } %>
							<%
								if (goods_list[i].sole_flag) {
							%>
								<span class="phone-sale"><i></i>手机专享</span>
							<%
								}
							%>
						</span>

						
						<div class="goods-store multishop-enable">
						<%
							if (goods_list[i].store_is_selfsupport == '1') {
						%>
							<span class="icon-mall">自营</span>
						<%
							} else {
						%>
							<a class="hide" href="javascript:void(0);" data-id='<%=goods_list[i].store_id;%>'><%=goods_list[i].store_name;%><i></i></a>
						<%
							}
						%>
							<div class="sotre-creidt-layout" style="display: none;"></div>
						</div>
					</dd>
				</dl>
			</li>
			<%}%>
			<% if (data.hasmore) {%>
			<li class="loading"><div class="spinner"><i></i></div>商品数据读取中...</li>
			<% } %>
	<%
	   }else {
	%>
		<div class="sstouch-norecord search">
			<div class="norecord-ico"><i></i></div>
				<dl>
					<dt>没有找到任何相关信息</dt>
					<dd>选择或搜索其它商品分类/名称...</dd>
				</dl>
			<a href="javascript:history.go(-1)" class="btn">重新选择</a>
		</div>
	<%
	   }
	%>
</script>
<script> var navigate_id ="2";</script> 
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/supplier_product_list.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>

<script type="text/javascript" src="../../js/tmpl/addcart.js"></script>
</html>

<?php
include __DIR__ . '/../includes/footer.php';
?>