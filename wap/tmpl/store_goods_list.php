<?php
include __DIR__ . '/../includes/header.php';
?>
<script>
    window.load = loadCss(WapSiteUrl+"/css/sstouch_products_list.css");
    window.load = loadCss(WapSiteUrl+"/css/sstouch_common.css");
</script>

<div class="goods-search-list-nav">
<ul id="nav_ul">
  <li><a href="javascript:void(0);" class="current" id="sort_default"><?=__('综合排序')?><i></i></a></li>
  <li><a href="javascript:void(0);" id="sort_salesnum"><?=__('销量优先')?></a></li>
  <li><a href="javascript:void(0);" id="search_filter"><?=__('筛选')?><i></i></a></li>
</ul>
<div class="browse-mode"><a href="javascript:void(0);" id="show_style"><span class="browse-list"></span></a></div>
</div>
<div id="sort_inner" class="goods-sort-inner hide">
  <span><a href="javascript:void(0);" class="cur"  onclick="get_list({'order_val':'0','order_key':'0'})"><?=__('综合排序')?><i></i></a></span>
  <span><a href="javascript:void(0);" onclick="get_list({'order_val':'DESC','order_key':'product_unit_price'})"><?=__('价格从高到低')?><i></i></a></span>
  <span><a href="javascript:void(0);" onclick="get_list({'order_val':'ASC','order_key':'product_unit_price'})"><?=__('价格从低到高')?><i></i></a></span>
  <span><a href="javascript:void(0);" onclick="get_list({'order_val':'DESC','order_key':'product_favorite_num'})"><?=__('人气排序')?><i></i></a></span>
</div>
<div class="list" shopsuite_type="product_content">
  <ul class="goods-secrch-list" id="product_list"></ul>
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
    <div class="sstouch-main-layout secreen-layout" id="list-items-scroll">
      <dl>
        <dt><?=__('价格区间')?></dt>
        <dd>
          <span class="inp-balck"><input type="text" id="price_from" sstype="price" pattern="[0-9]*" class="inp" placeholder="<?=__('最低价')?>"/></span><span class="line"></span><span class="inp-balck"><input sstype="price" type="text" id="price_to" pattern="[0-9]*" class="inp" placeholder="<?=__('最高价')?>"/></span>
        </dd>
      </dl>
      <div class="bottom"> <a href="javascript:void(0);" class="btn-l" id="search_submit"><?=__('筛选商品')?></a> </div>
    </div>
  </div>
</div>

<script type="text/html" id="goods_list_tpl">
	<% if(items.length >0){%>
		<% for (var k in items) { var v = items[k];%>
			<li class="goods-item" item_id="<%=v.item_id;%>">
				<span class="goods-pic">
					<a href="product_detail.html?item_id=<%=v.item_id;%>">
						<img src="<%=$image_thumb(v.product_image, 360) ;%>"/>
					</a>
				</span>
				<dl class="goods-info">
					<dt class="goods-name">
						<a href="product_detail.html?item_id=<%=v.item_id;%>">
							<h4><%=v.product_name;%></h4><h6><%=v.product_tips;%></h6>
						</a>
					</dt>
					<dd class="goods-sale">
						<a href="product_detail.html?item_id=<%=v.item_id;%>">
							<span class="goods-price">
								<% if (v.product_unit_price){%>￥<em><%=v.product_unit_price;%></em><% } %><% if (v.product_unit_points){%> + <em><%= v.product_unit_points %></em><?=__('积分')?></span><% } %>

								<%
									if (v.sole_flag) {
								%>
									<span class="phone-sale"><i></i><?=__('手机专享')?></span>
								<%
									}
								%>
							</span>

							<% if (v.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN) { %>
							<span class="sale-type"><?=__('加')?></span>
							<% }%>


							<% if (v.activity_type_id == getStateCode().ACTIVITY_TYPE_GIFT) { %>
							<span class="sale-type"><?=__('赠')?></span>
							<% }%>


							<% if (v.activity_type_id == getStateCode().ACTIVITY_TYPE_LIMITED_DISCOUNT) { %>
							<span class="sale-type"><?=__('降')?></span>
							<% }%>


							<% if (v.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION) { %>
							<span class="sale-type"><?=__('减')?></span>
							<% }%>



							<% if (v.is_virtual == '1') { %>
								<span class="sale-type"><?=__('虚拟')?></span>
							<% } else { %>
								<% if (v.is_presell == '1') { %>
								<span class="sale-type"><?=__('预')?></span>
								<% } %>
								<% if (v.is_fcode == '1') { %>
								<span class="sale-type"><?=__('F')?></span>
								<% } %>
							<% } %>

							<% if(v.group_flag || v.xianshi_flag){ %>
								<span class="sale-type"><?=__('降')?></span>
							<% } %>
							<% if(v.have_gift == '1'){ %>
								<span class="sale-type"><?=__('赠')?></span>
							<% } %>
							</a>
						</dd>
						<dd class="goods-assist">
							<% if(!isEmpty(v.analytics_row)){%>
							<a href="product_detail.html?item_id=<%=v.item_id;%>">
								<span class="goods-sold"><?=__('销量')?>&nbsp;<em><%=v.product_sale_num;%></em></span>
							</a>
							<%}%>
							<div class="goods-store">
								<a href="javascript:void(0);" shopsuite_type="goods_more_link" param_id="<%=v.item_id;%>"><i></i></a>
								<div class="sotre-favorites-layout" id="goods_more_<%=v.item_id;%>">
									<div shopsuite_type="goods_more_con" param_id="<%=v.item_id;%>" class="sotre-favorites-bg"></div>
									<div shopsuite_type="goods_addfav" param_id="<%=v.item_id;%>" class="add"><i></i><h5><?=__('加收藏')?></h5></div>
									<div shopsuite_type="goods_cancelfav" param_id="<%=v.item_id;%>" class="add added"><i></i><h5><?=__('已收藏')?></h5></div>
								</div>
							</div>
						</dd>
					</dl>
			</li>
			<%}%>
			<li class="loading"><div class="spinner"><i></i></div><?=__('商品数据读取中')?>...</li>
	<% }else { %>
		<div class="sstouch-norecord search">
			<div class="norecord-ico"><i></i></div>
				<dl>
					<dt><?=__('没有找到任何相关信息')?></dt>
					<dd><?=__('搜索其它商品名称或筛选项')?>...</dd>
				</dl>
				<a href="javascript:void(0);" onclick="get_list({'order_val':'<%=order%>','order_key':'<%=key%>'},true)" class="btn"><?=__('查看全部商品')?></a>
		</div>
	<% } %>
</script>

<script>
	window.load = loadJs(WapSiteUrl+"/js/tmpl/store_goods_list.js");
</script>
<?php
include __DIR__ . '/../includes/footer.php';
?>