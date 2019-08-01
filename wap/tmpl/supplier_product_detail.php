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
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<script type="text/html" id="product_title"><title><%=item_row.product_name%></title></script>
<link rel="stylesheet" type="text/css" href="../../css/base.css" />
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css" />
<link rel="stylesheet" type="text/css" href="../../css/sstouch_products_detail.css" />
<style type="text/css">
	.goods-detail-profix {
	    position: relative;
	    z-index: 1;
	    display: block;
	    padding: 0 .5rem;
	    background-color: #FFF;
	}
	.goods-detail-profix .goods-profix-rate {
		font-size: 0.6rem;
		color: #ff6700;
	}
</style>
</head>
<body>
<header id="header" class="transparent">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <ul class="header-nav">
      <li class="cur"><a href="javascript:void(0);">商品</a></li>
      <li><a href="javascript:void(0);" id="goodsBody">详情</a></li>
      <li><a href="javascript:void(0);" id="goodsEvaluation">评价</a></li>
    </ul>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
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
<div id="product_detail_html" style="position: relative; z-index: 1;"></div>
<div id="product_detail_spec_html" class="sstouch-bottom-mask"></div>
<div id="voucher_html" class="sstouch-bottom-mask"></div>
<script type="text/html" id="product_detail">
<% var StateCode = getStateCode(); %>
<div class="goods-detail-top">
	<div class="goods-detail-pic" id="mySwipe">
		<ul>
			<% for (var i =0;i<item_row.item_image_row.length;i++){ %>
			<li><img src="<%=$image_thumb(item_row.item_image_row[i], 420) %>"/></li>
			<% } %>
		</ul>
	</div>
	<div class="goods-detail-turn">
		<ul><% for (var i =0;i<item_row.item_image_row.length;i++){ %>
			<li class="<% if(i == 0) { %>cur<%}%>"></li>
			<% } %>
		</ul>
	</div>
	<!--<div class="round pd-share"><i></i></div>-->
    <% if (user_is_pt && user_is_pt) { %>
    <div class="round add-small-shop" id="add_small_shop" style="margin-bottom: 90px;"><i class="zc zc-add" style="
    line-height: 35px;
    margin-left: 4px;
    color: red;
    font-size: 0.7rem;
    opacity: 0.75;
"></i></div>
    <% } %>
	<div class="<% if (is_favorite) { %>favorite<% } %> round pd-collect" style="margin-bottom: 50px;"><i></i></div>

	<div class="round pd-collect puzzle-collect hide"><i></i></div>

</div>
<div class="goods-detail-cnt">
	<div class="goods-detail-name">
		<dl> 
			<dt><%if(item_row.is_virtual == '1'){%><span>虚拟</span><%}%><% if (item_row.is_presell == '1') { %><span>预售</span><% } %><% if (item_row.is_fcode == '1') { %><span>F码</span><% } %><%=item_row.product_name%></dt>
			<dd><%=item_row.product_tips%></dd>
		</dl>
	</div>
	<div class="goods-detail-profix">
		<dl> 
			<span class="goods-profix-rate">
				利润率
				<em><%=item_row.product_retail_min_rate%>%</em> ~ <em><%=item_row.product_retail_max_rate%>%</em>
			</span>
		</dl>
	</div>

	<div class="goods-detail-price">
		<dl>
			<% if (item_row.item_unit_points) {%><dt class="hide">￥<em><%=item_row.item_sale_price+item_row.item_unit_points%></em>&nbsp;&nbsp;或</dt><% } %>
			<dt>
				<% if (item_row.item_sale_price) { %>
				￥<em><%=item_row.item_sale_price%></em>
				<% } %>

				<% if (item_row.item_unit_points) { %>
				<em> + </em><em><%=item_row.item_unit_points%></em>积分
				<% } %>
			</dt>
		</dl>


		<% if (item_row.item_fx_commission) { %>
		<span style="font-size: .5rem;" class="hide">佣金￥<%=item_row.item_fx_commission;%></span>
		<% } %>

		<!-- item_consume_points -->
		<% if (item_row.item_consume_points){ %>
		<span class="hide"  style="
		height: .7rem;
		padding: .0.7rem;
		margin-top: .0.7rem;
		font-size: .45rem;
		color: #FFF;
		line-height: .7rem;
		background: #ff6700;
		border-radius: .15rem;">送<%=item_row.item_consume_points;%>积分</span>
		<%}%>

		<!-- item_consume_jb -->
		<% if (item_row.item_consume_jb){ %>
		<span class="hide"  style="
		height: .7rem;
		padding: .1rem;
		margin-top: .1rem;
		font-size: .45rem;
		color: #FFF;
		line-height: .7rem;
		background: #e50001;
		border-radius: .15rem;">送<%=item_row.item_consume_jb;%>金宝</span>
		<%}%>


		<% if (!isEmpty(item_row.analytics_row)){ %>
			<span class="sold">销量：<%=item_row.analytics_row.product_sale_num;%> 件</span>
		<%}%>

	</div>

	<div class="goods-detail-item">
		<div class="itme-name">送至</div>
		<div class="item-con">
			<a href="javascript:void(0);" id="get_area_selected">
			<dl class="goods-detail-freight">
				<dt><span id="get_area_selected_name"><%=product_freight_info.district_info%></span><strong id="get_area_selected_whether" class="hide"><%=product_freight_info.if_store_cn%></strong> <%=html_decode(product_freight_info.content)%></dt>
				<dd class="hide" id="get_area_selected_content"></dd>
			</dl>
			</a>
		</div>
		<div class="item-more"><i class="zc zc-shouhuodizhi1"></i></div>
	</div>

	<% if (!isEmpty(wholesale_policy_rows)) { %>
	<div class="goods-detail-item" style="padding-bottom: 0.2rem">
		<div class="px-border1">
			<div class="m-detail-price ">
				<div class="d-content fd-clr">
					<!-- 无线代销 -->
					<div data-type="rangePrice">
						<dl class="d-price-rangecount" data-index="1">
							<dd><%=wholesale_policy_rows[0].item_quantity_str%> 起批</dd>
							<dd><%=wholesale_policy_rows[1].item_quantity_str%></dd>
							<dd><%=wholesale_policy_rows[2].item_quantity_str%></dd>
						</dl>
						<dl class="d-price-discount  ">
							<dd><span class="fd-cny">¥</span><%=wholesale_policy_rows[0].policy_wholesale_price%></dd>
							<dd><span class="fd-cny">¥</span><%=wholesale_policy_rows[1].policy_wholesale_price%></dd>
							<dd><span class="fd-cny">¥</span><%=wholesale_policy_rows[2].policy_wholesale_price%></dd>
						</dl>
						<dl class="d-price-original hide">
							<dd><span class="fd-cny">¥</span><del><%=wholesale_policy_rows[0].policy_wholesale_price%></del></dd>
							<dd><span class="fd-cny">¥</span><del><%=wholesale_policy_rows[1].policy_wholesale_price%></del></dd>
							<dd><span class="fd-cny">¥</span><del><%=wholesale_policy_rows[2].policy_wholesale_price%></del></dd>
						</dl>
					</div>
				</div>
				<div class="offer-mark">
				</div>
			</div>
		</div>
	</div>
	<%}%>

	<div class="goods-detail-item goods-detail-o2o mt5 mb5">
		<div class="o2o-enable multishop-enable">
			<div class="tit">
				<h3>商家信息</h3>
			</div>
			<div class="default" id="goods-detail-o2o">
			</div>
			<div class="more-location">
				<a href="javascript:void(0);" id="store_items"><%= store_info.store_name%></a>
				<i class="zc zc-arrow-r"></i>
			</div>
		</div>
	</div>

    <div class="goods-detail-item goods-detail-chain mt5 mb5 hide">
        <div class="tit">
            <h3>门店信息（各个门店价格可能会不一样）</h3>
        </div>
        <div class="default" id="goods-detail-chain">
        </div>
        <div class="more-location"><a href="javascript:void(0);" id="store_chain_list"></a><i class="zc zc-arrow-r"></i></div>
    </div>



	<div class="goods-detail-item" id="goods_spec_selected">
		<div class="itme-name">已选</div>
		<div class="item-con">
			<dl class="goods-detail-sel">
				<dt>
					<% if (!isEmpty(item_row['product_spec'])) { %>
					<% if(item_row['product_spec'].length>0){%>
						<% for(var i =0;i<item_row['product_spec'].length;i++){%>
							<span>
							<%=item_row['product_spec'][i].name%>
							<%for(var j = 0;j<item_row['product_spec'][i].item.length;j++){%>
								<%if (item_row['item_spec'][i]['item'].id == item_row['product_spec'][i].item[j].id){%>
									<em><%=item_row['product_spec'][i].item[j].name%></em>
								<%}%>
							<%}%>
							</span>
						<%}%>
					<%}} else { %>
					<span>默认</span>
					<% } %>
				</dt>
			</dl>
		</div>
		<div class="item-more"><i class="zc zc-arrow-r arrow-r"></i></div>
	</div>
	<% if (!isEmpty(item_row.contractlist)) { %>
	<div class="goods-detail-item">
		<div class="itme-name">服务</div>
		<div class="item-con">
			<dl class="goods-detail-contract">
				<dt>由“<%= store_info.store_name %>”销售和发货，并享受售后服务</dt>
				<dd>
					<% for (var k in item_row.contractlist) { var v = item_row.contractlist[k]; %>
					<span><i><img src="<%=v.contract_type_icon%>"></i><%=v.contract_type_name%></span>
					<% } %>
				</dd>
			</dl>
		</div>
	</div>
	<% } %>
	<% if (!isEmpty(item_row.analytics_row)){ %>
	<div class="goods-detail-comment evaluation-enable" id="goodsEvaluation1">
		<div class="title">
			<a id="goodsEvaluation1" href="javascript:void(0);">商品评价<span class="rate">好评率<em><%=item_row.analytics_row.evaluation_percent%>%</em></span><span class="rate-num">（<%=item_row.analytics_row.product_evaluation_num%>人评价）</span><div class="item-more"><i class="zc zc-arrow-r arrow-r"></i></div></a>
		</div>
		<div class="comment-info">
			<% if (goods_eval_list.length > 0) { %>
			<% for (var i=0; i<goods_eval_list.length; i++) { %>
			<dl>
				<dt>
				<div class="goods-raty"><i class="star<%=goods_eval_list[i].geval_scores%>"></i></div>
				<time><%=goods_eval_list[i].geval_addtime_date%></time>
				<span class="user-name"><%=goods_eval_list[i].geval_frommembername%></span>
				</dt>
				<dd><%=goods_eval_list[i].geval_content%></dd>
			</dl>
			<% }} %>
		</div>
	</div>
	<%}%>


	<% if (!isEmpty(store_info)){ %>
	<div class="goods-detail-store multishop-enable">
		<a href="store.html?store_id=<%= store_info.store_id %>">
			<div class="store-name"><i class="icon-store"></i><%= store_info.store_name %>
			<% if (store_info.store_is_selfsupport == '1') {%>
				<span class="icon-mall">自营</span>
			<% } %></div>
			<% if (store_info.store_is_selfsupport != 1) {%>
			<% if (store_info.store_credit) { %>
			<div class="store-rate">
				<span class="<%= store_info.store_credit.store_desccredit.percent_class %>">描述相符
					<em><%= sprintf('%.1f', store_info.store_credit.store_desccredit.credit) %></em>
					<!--<i><%= store_info.store_credit.store_desccredit.percent_text %></i>-->
				</span>
				<span class="<%= store_info.store_credit.store_servicecredit.percent_class %>">服务态度
					<em><%= sprintf('%.1f', store_info.store_credit.store_servicecredit.credit) %></em>
					<!--<i><%= store_info.store_credit.store_servicecredit.percent_text %></i>-->
				</span>
				<span class="<%= store_info.store_credit.store_deliverycredit.percent_class %>">发货速度
					<em><%= sprintf('%.1f', store_info.store_credit.store_deliverycredit.credit) %></em>
					<!--<i><%= store_info.store_credit.store_deliverycredit.percent_text %></i>-->
				</span>
			</div>
			<% } %>
			<% } %>
			<div class="item-more"><i class="zc zc-arrow-r arrow-r"></i></div>
		</a>
	</div>
	<%}%>

	<% if (!isEmpty(goods_commend_list)){ %>
	<div class="goods-detail-recom">
		<h4>店铺推荐</h4>
		<ul>
			<%for (var i = 0;i<goods_commend_list.length;i++){%>
			<li>
				<a href="product_detail.html?item_id=<%=goods_commend_list[i].item_id%>">
					<div class="pic"><img src="<%=goods_commend_list[i].product_image%>"></div>
					<dl>
						<dt><%=goods_commend_list[i].product_name%></dt>
						<dd>￥<em><%=goods_commend_list[i].goods_activity_item_price%></em></dd>
					</dl>
				</a>
			</li>
			<%}%>
		</ul>
	</div>
	<%}%>

	<div class="goods-detail-bottom"><a href="javascript:void(0);" id="goodsBody1">点击查看商品详情</a></div>
	<div class="goods-detail-foot">
		<div class="otreh-handle">
			<a href="javascript:void(0);" class="kefu"><i></i><p>客服</p></a>
			<a href="../tmpl/cart_list.html" class="cart"><i></i><p>购物车</p><span id="cart_count"></span></a>
		</div>
		<div class="buy-handle <%if(!product_freight_info.if_store){%>no-buy<%}%>">
			
		<% if( item_row.store_is_distributor ){ %>
			<% if( item_row.product_is_behalf_delivery == StateCode.PRODUCT_BEHALF_DELIVERY_FALSE ) { %>
			<a href="javascript:void(0);" class="add-cart" id="add-cart">加入购物车</a>
			<a href="javascript:void(0);" class="<%if(product_freight_info.if_store){%>animation-up<%}%> buy-now">立即购买</a>
			<% } else { %>
			<% if( item_row.product_is_distributed ) { %>
			<a href="javascript:void(0);" class="add-cart" style="width: 100%;">已上架</a>
			<% } else { %>
			<a href="javascript:void(0);" class="add-cart" id="upload-to" style="width: 100%">一键上架</a>
			<% } %>

			<% } %>
			
		<% } else { %>
			<a href="javascript:void(0);" class="add-cart" id="apply-to" style="width: 100%">申请成为客户</a>
		<% } %>
		    
		</div>
		
	</div>
</div>
</script>

<script type="text/html" id="product_detail_sepc">
<% var StateCode = getStateCode(); %>
<div class="sstouch-bottom-mask-bg"></div>
<div class="sstouch-bottom-mask-block">
	<div class="sstouch-bottom-mask-tip"><i></i>点击此处返回</div>
	<div class="sstouch-bottom-mask-top goods-options-info">
		<div class="goods-pic">
		<img src="<%=item_row.item_image_row[0]%>"/>
	</div>
	<dl>
		<dt><%=item_row.product_item_name%></dt>
		<dd class="goods-price">

			<% if (item_row.item_unit_points) {%><!--￥<em><%=item_row.item_sale_price+item_row.item_unit_points%></em>&nbsp;&nbsp;或 --><% } %>

			<% if (item_row.item_sale_price) { %>
			￥<em class="item_price"><%=item_row.item_sale_price%></em>
			<% } %>

			<% if (item_row.item_unit_points) { %>
			<em> + </em><em><%=item_row.item_unit_points%></em>积分
			<% } %>
			<span class="goods-storage">库存：<%=item_row.item_quantity%>件</span>
		</dd>
	</dl>

	<a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
</div>
<div class="sstouch-bottom-mask-rolling" id="product_roll">
	<div class="goods-options-stock">
		<% if(item_row['product_spec'].length>0){%>
		<% for(var i =0;i<item_row['product_spec'].length;i++){%>
		<dl class="spec">
			<dt spec_id="<%=item_row['product_spec'][i].id%>">
				<%=item_row['product_spec'][i].name%>：
			</dt>
			<dd>
				<%for(var j = 0;j<item_row['product_spec'][i].item.length;j++){%>
					<a href="javascript:void(0);" <%if (item_row['item_spec'][i]['item'].id == item_row['product_spec'][i].item[j].id){%> class="current" <%}%>specs_value_id = "<%=item_row['product_spec'][i].item[j].id%>">
						<%=item_row['product_spec'][i].item[j].name%>
					</a>
				<%}%>
			</dd>
		</dl>
		<%}%>
		<%}%>
		<% if (item_row.is_virtual) { %>
		<dl class="spec-promotion">
			<dt>提货方式：</dt>
			<dd><a href="javascript:void(0);" class="current">电子兑换券</a></dd>
		</dl>
        <% if (item_row.product_validity_end != '0000-00-00') { %>
		<dl class="spec-promotion">
			<dt>有效期：</dt>
			<dd><a href="javascript:void(0);" class="current">即日起 到 <%= item_row.product_validity_end %></a>
				<% if (item_row.product_buy_limit && item_row.product_buy_limit > 0) { %>
				（每人次限购 <%= item_row.product_buy_limit %> 件）
				<% } %>
				</dd>
		</dl>
        <% } %>
	<% } else { %>
		<% if (item_row.is_presell == '1') { %>
		<dl class="spec-promotion">
			<dt>预售：</dt>
			<dd><a href="javascript:void(0);" class="current"><%= item_row.presell_deliverdate_str %> 日发货</a></dd>
		</dl>
		<% } %>
		<% if (item_row.is_fcode == '1') { %>
		<dl class="spec-promotion">
			<dt>购买类型：</dt>
			<dd><a href="javascript:void(0);" class="current">F码优先购买</a>（每个F码优先购买一件商品）</dd>
		</dl>
		<% } %>
		<% } %>
	</div>
</div>
<div class="goods-option-value">购买数量
	<div class="value-box">
		<span class="minus">
			<a href="javascript:void(0);">&nbsp;</a>
		</span>
		<span>
			<input type="text" pattern="[0-9]*" class="buy-num" id="buynum" value="1"/>
		</span>
		<span class="add">
			<a href="javascript:void(0);">&nbsp;</a>
		</span>
	</div>
</div>
<div class="goods-option-foot">
	<div class="otreh-handle">
		<a href="javascript:void(0);" class="kefu">
			<i></i>
			<p>客服</p>
		</a> 
		<a href="../tmpl/cart_list.html" class="cart">
			<i></i>
			<p>购物车</p>
			<span id="cart_count1"></span>
		</a>
	</div>
	
	<%if(is_had_bought==0){ %>
	<div class="buy-handle <%if(!product_freight_info.if_store){%>no-buy<%}%>">
        <% if (item_row.activity_item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GROUPBOOKING) { %>
            <a href="javascript:void(0);" class="add-cart" id="add-cart">普通购买</a>
            <% if(!is_join) { %>
                <a href="javascript:void(0);" class="group-now" id="buy-now">立即开团</a>
            <% } else {%>
                <a href="javascript:void(0);" class="group-now" id="buy-now">立即参团</a>
            <% } %>
        <% } else { %>
            <% if (!item_row.is_virtual) { %>
                <% if (item_row.if_cart == '1') { %>
                    <a href="javascript:void(0);" class="add-cart" id="add-cart">加入购物车</a>
                <% } %>
                <a href="javascript:void(0);" class="buy-now" id="buy-now">立即购买</a>
            <% } else { %>
                <a href="javascript:void(0);" class="buy-now" id="buy-now">立即预约</a>
            <% } %>
        <% } %>

	</div>
	<% } else {%>
		 <div class="buy-handle no-buy">
			<a href="javascript:void(0);" class="buy-now">您已参加本商品抢购活动</a>
		</div>
	<% } %>
</div>
</script> 
<script type="text/html" id="voucher_script">
<% if (voucher) { %>
	<div class="sstouch-bottom-mask-bg"></div>
	<div class="sstouch-bottom-mask-block">
		<div class="sstouch-bottom-mask-tip"><i></i>点击此处返回</div>
		<div class="sstouch-bottom-mask-top store-voucher">
			<i class="icon-store"></i>
			<%=store_info.store_name%>&nbsp;&nbsp;领取店铺优惠券
			<a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
		</div>
		<div class="sstouch-bottom-mask-rolling" id="voucher_roll">
			<div class="sstouch-bottom-mask-con">
				<ul class="sstouch-voucher-list">
				<% for (var i=0; i<voucher.length; i++) { %>
				<li>
					<dl>
						<dt class="money">面额<em><%=voucher[i].voucher_t_price%></em>元</dt>
						<dd class="need">需消费<%=voucher[i].voucher_t_limit%>使用</dd>
						<dd class="time">至<%=voucher[i].voucher_t_end_date%>前使用</dd>
					<dl>
					<a href="javascript:void(0);" class="btn" data-tid=<%=voucher[i].voucher_t_id%>>领取</a>
				</li>
				<% } %>
				</ul>
			</div>
		</div>
	</div>
<% } %>
</script>
<script type="text/html" id="list-address-script">
<% for (var i=0;i<items.length;i++) {%>
<li>
	<dl>
		<a href="javascript:void(0)" index_id="<%=i%>">
			<dt><%=items[i].chain_name%><span><i></i>查看地图</span></dt>
			<dd><%=items[i].chain_district_info%></dd>
		</a>
	</dl>
	<span class="tel"><a href="tel:<%=items[i].chain_mobile %>"></a></span>
</li>
<% } %>
</script>

<script type="text/html" id="list-chain-script">
	<% for (var i=0;i<items.length;i++) {%>
	<li chain_district_id="<%=items[i].chain_district_id%>">
		<dl>
			<a href="chain.html?chain_id=<%=items[i].chain_id%>" chain_district_id="<%=items[i].chain_district_id%>" chain_area_info="<%=items[i].chain_area_info%>">
				<dt><%=items[i].chain_name%> <span>查看</span></dt>
				<dd>门店价格：￥<%=items[i].chain_item_unit_price%></dd>
				<dd>门店地址：<%=items[i].chain_address%>，电话：<%=items[i].chain_mobile%></dd>
			</a>
		</dl>
		<span class="chain"><a href="javascript:chain_buy('<%=items[i].chain_id%>');"><i class="zc zc-cart-fill"></i></a></span>
	</li>
	<% } %>
</script>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>

<script type="text/javascript" src="../../js/libs/swipe.js"></script>
<script type="text/javascript" src="../../js/leftTime/leftTime.min.js"></script>


<script type="text/javascript" src="../../js/tmpl/seller/supplier_product_detail.js"></script>



<!--o2o分店地址Begin-->
<div id="list-address-wrapper" class="sstouch-full-mask hide">
  <div class="sstouch-full-mask-bg"></div>
  <div class="sstouch-full-mask-block">
    <div class="header transparent" style="display: block;">
      <div class="header-wrap">
        <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
          <h1>商家信息</h1>
        </div>
      </div>
    </div>
    <div class="sstouch-main-layout">
        <div class="sstouch-o2o-tip"><a href="javascript:void(0);" id="map_all"><i></i>全部实体分店共<em></em>家<span></span></a></div>
        <div class="sstouch-main-layout-a" id="list-address-scroll">
        <ul class="sstouch-o2o-list" id="list-address-ul">
        </ul>
        </div>
    </div>
  </div>
</div>
<!--o2o分店地址End-->
<!--o2o分店地图Begin-->
<div id="map-wrappers" class="sstouch-full-mask hide">
    <div class="sstouch-full-mask-bg"></div>
    <div class="sstouch-full-mask-block">
      <div class="header transparent"  style="display: block;">
        <div class="header-wrap">
          <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
        </div>
      </div>
      <div class="sstouch-map-layout">
        <div id="baidu_map" class="sstouch-map"></div>
      </div>
    </div>
</div>
<!--o2o分店地图End-->
<!--门店地址Begin-->
<div id="list-chain-wrapper" class="sstouch-full-mask hide">
	<div class="sstouch-full-mask-bg"></div>
	<div class="sstouch-full-mask-block">
		<div class="header">
			<div class="header-wrap">
				<div class="header-l"> <a href="javascript:void(0);"> <i class="back"></i> </a> </div>
				<div class="header-title">
					<h1>商家门店信息</h1>
				</div>
			</div>
		</div>
		<div class="sstouch-main-layout">
			<div class="sstouch-o2o-tip"><i></i>全部门店共<em id="chain_all"></em>家
				<select id="chain_area_info" name="chain_area_info" class="select">
				</select></div>
			<div class="sstouch-main-layout-a" id="list-chain-scroll">
				<ul class="sstouch-o2o-list" id="list-chain-ul">
				</ul>
			</div>
		</div>
	</div>
</div>
<!--门店地址End-->
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>