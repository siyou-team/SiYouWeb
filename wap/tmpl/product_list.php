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
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<meta name="format-detection" content="telephone=no" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title><?=__('商品列表')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
</head>
<body>
<header id="header" class="sstouch-product-header fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-inp"> <i class="zc zc-search-thin icon"></i> <span class="search-input" id="keyword"><?=__('请输入关键词')?></span> </div>
    <div class="header-r"> <a href="../tmpl/product_first_categroy.html"><i class="zc zc-categroy categroy"></i>
      </a> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
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
<div class="goods-search-list-nav">
    <ul id="nav_ul">
      <li><a href="javascript:void(0);" class="current ellipsis" id="sort_default"><?=__('综合排序')?><i></i></a></li>
      <li><a href="javascript:void(0);" class="ellipsis" onclick="init_get_list('DESC', 'product_sale_num')"><?=__('销量优先')?></a></li>
      <li><a href="javascript:void(0);" class="ellipsis" id="search_filter"><?=__('筛选')?><i></i></a></li>
    </ul>
    <div class="browse-mode"><a href="javascript:void(0);" id="show_style"><span class="browse-list"></span></a></div>
  </div>
<div id="sort_inner" class="goods-sort-inner hide"> <span><a href="javascript:void(0);" class="cur"  onclick="init_get_list('', '')"><?=__('综合排序')?><i></i></a></span> <span><a href="javascript:void(0);" onclick="init_get_list('DESC', 'product_unit_price')"><?=__('价格从高到低')?><i></i></a></span> <span><a href="javascript:void(0);" onclick="init_get_list('ASC', 'product_unit_price')"><?=__('价格从低到高')?><i></i></a></span> <span><a href="javascript:void(0);" onclick="init_get_list('DESC', 'product_favorite_num')"><?=__('人气排序')?><i></i></a></span> </div>
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
          <h1><?=__('商品筛选')?></h1>
        </div>
        <div class="header-r"><a href="javascript:void(0);" id="reset" class="text"><?=__('重置')?></a> </div>
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
		<dt><?=__('价格区间')?></dt>
		<dd>
			<span class="inp-balck"><input type="text" id="price_from" sstype="price" pattern="[0-9]*" class="inp" placeholder="<?=__('最低价')?>"/></span>
			<span class="line"></span>
			<span class="inp-balck"><input sstype="price" type="text" id="price_to" pattern="[0-9]*" class="inp" placeholder="<?=__('最高价')?>"/></span>
		</dd>
	</dl>
	<dl>
		<dt><?=__('积分区间')?></dt>
		<dd>
			<span class="inp-balck"><input type="text" id="points_from" sstype="price" pattern="[0-9]*" class="inp" placeholder="<?=__('最低积分')?>"/></span>
			<span class="line"></span>
			<span class="inp-balck"><input sstype="price" type="text" id="points_to" pattern="[0-9]*" class="inp" placeholder="<?=__('最高积分')?>"/></span>
		</dd>
	</dl>
	<dl>
		<dt><?=__('商品所在地')?></dt>
		<dd><span class="inp-balck add"><select id="district_id">
					<option value=""><?=__('不限')?></option>
    				<% for (i = 0; i < area.length; i++) { %>
    				<option value="<%=area[i]['district_id']%>"><%=area[i]['district_name']%></option>
    				<% } %>
    				</select>
					<i></i>
			</span>
		</dd>
	</dl>
	<dl>
		<dt><?=__('商品类型')?></dt>
		<dd>
			<a href="javascript:void(0);" sstype="items" id="gift" class=""><?=__('赠品')?></a>
			<a href="javascript:void(0);" sstype="items" id="groupbuy"><?=__('抢购')?></a>
			<a href="javascript:void(0);" sstype="items" id="xianshi"><?=__('限时折扣')?></a>
			<a href="javascript:void(0);" sstype="items" id="virtual"><?=__('虚拟')?></a>
		</dd>
	</dl>
	<dl>
		<dt><?=__('店铺类型')?></dt>
		<dd>
			<a href="javascript:void(0);" sstype="items" id="selfsupport" class=""><?=__('平台自营')?></a>
		</dd>
	</dl>
	<dl>
		<dt><?=__('店铺服务')?></dt>
		<dd>
    	<% for (i = 0; i < contract.length; i++) { %>
    	<a href="javascript:void(0);" sstype="items" name="ci" value="<%=contract[i]['contract_type_id']%>"><%=contract[i]['contract_type_name']%></a>
    	<% } %>
		</dt>
	</dl>
	<div class="bottom">
	<a href="javascript:void(0);" class="btn-l" id="search_submit"><?=__('筛选商品')?></a>
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
					<a id="goods_pic<%= goods_list[i]['item_color'][0].item_id %>" href="product_detail.html?item_id=<%=goods_list[i]['item_color'][0].item_id;%>">
						<img src="<%=$image_thumb(goods_list[i].product_image, 360) ;%>"/>
					</a>
				</span>
				<dl class="goods-info">
					<dt class="goods-name">
						<a href="product_detail.html?item_id=<%=goods_list[i]['item_color'][0].item_id;%>">
							<h4><%=goods_list[i].product_name;%></h4>
							<h6><%=goods_list[i].product_tips;%></h6>
						</a>
					</dt>
					<dd class="goods-sale">
						<a href="product_detail.html?item_id=<%=goods_list[i]['item_color'][0].item_id;%>">

								<% if (goods_list[i].product_unit_points) {%><span class="goods-price hide">￥<em><%=goods_list[i].product_unit_price+goods_list[i].product_unit_points%></em> &nbsp;&nbsp;<?=__('或')?>&nbsp;&nbsp;</span><% } %>


							<span class="goods-price" style="color: red;">
								<% if (goods_list[i].product_unit_price) {%>￥<em><%=goods_list[i].product_unit_price%></em><% } %><% if (goods_list[i].product_unit_points) {%><em>+<%=goods_list[i].product_unit_points%></em><?=__('积分')?><% } %>
								<%
									if (goods_list[i].sole_flag) {
								%>
									<span class="phone-sale"><i></i><?=__('手机专享')?></span>
								<%
									}
								%>
							</span>


							<% if (goods_list[i].activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN) { %>
							<span class="sale-type"><?=__('加')?></span>
							<% }%>


							<% if (goods_list[i].activity_type_id == getStateCode().ACTIVITY_TYPE_GIFT) { %>
							<span class="sale-type"><?=__('赠')?></span>
							<% }%>


							<% if (goods_list[i].activity_type_id == getStateCode().ACTIVITY_TYPE_LIMITED_DISCOUNT) { %>
							<span class="sale-type"><?=__('降')?></span>
							<% }%>


							<% if (goods_list[i].activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION) { %>
							<span class="sale-type"><?=__('减')?></span>
							<% }%>



							<% if (goods_list[i].is_virtual == '1') { %>
								<span class="sale-type"><?=__('虚拟')?></span>
							<% } else { %>
								<% if (goods_list[i].is_presell == '1') { %>
								<span class="sale-type"><?=__('预')?></span>
								<% } %>
								<% if (goods_list[i].is_fcode == '1') { %>
								<span class="sale-type"><?=__('F')?></span>
								<% } %>
							<% } %>

							<% if(goods_list[i].group_flag || goods_list[i].xianshi_flag){ %>
								<span class="sale-type"><?=__('降')?></span>
							<% } %>
							<% if(goods_list[i].have_gift == '1'){ %>
								<span class="sale-type"><?=__('赠')?></span>
							<% } %>
							</a>
						</dd>
						<dd class="goods-assist">
							<% if (goods_list[i].analytics_row){ %>
							<a href="product_detail.html?item_id=<%=goods_list[i]['item_color'][0].item_id;%>">
								<span class="goods-sold"><?=__('销量')?>
									<em><%=goods_list[i].analytics_row.product_sale_num;%></em>
								</span>
							</a>
							<%}%>
                            <div class="add-cart">
                            	<a item_id="<%=goods_list[i]['item_color'][0].item_id;%>" onclick="javacript:addcart(this);" href="javascript:void(0);"><i></i></a>
                            </div>
							<div class="goods-store multishop-enable">
							<%
								if (goods_list[i].store_is_selfsupport == '1') {
							%>
								<span class="icon-mall"><?=__('自营')?></span>
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
			<li class="loading"><div class="spinner"><i></i></div><?=__('商品数据读取中')?>...</li>
			<% } %>
	<%
	   }else {
	%>
		<div class="sstouch-norecord search">
			<div class="norecord-ico"><i></i></div>
				<dl>
					<dt><?=__('没有找到任何相关信息')?></dt>
					<dd><?=__('选择或搜索其它商品分类/名称')?>...</dd>
				</dl>
			<a href="javascript:history.go(-1)" class="btn"><?=__('重新选择')?></a>
		</div>
	<%
	   }
	%>
</script>
<script> var navigate_id ="2";</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/product_list.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>

<script type="text/javascript" src="../js/tmpl/addcart.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>