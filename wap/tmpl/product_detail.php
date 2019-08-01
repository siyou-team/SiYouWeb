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
<script type="text/html" id="product_title"><title><%=item_row.product_name%></title></script>
<link rel="stylesheet" type="text/css" href="../css/base.css" />
<link rel="stylesheet" type="text/css" href="../css/sstouch_common.css" />
<link rel="stylesheet" type="text/css" href="../css/sstouch_products_detail.css" />
<!--<link rel="stylesheet" type="text/css" href="../css/public.css" />-->
<link rel="stylesheet" type="text/css" href="../css/swiper.min.css">
<script type="text/javascript" src="../js/swiper.min.js"></script>
<style type="text/css">
	.sstouch-nav-menu li a i.share { background-image: url(../images/share.png); }
</style>
</head>
<body>
<header id="header" class="transparent">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <ul class="header-nav">
      <li class="cur"><a href="javascript:void(0);"><?=__('商品')?></a></li>
      <li><a href="javascript:void(0);" id="goodsBody"><?=__('详情')?></a></li>
      <li><a href="javascript:void(0);" id="goodsEvaluation"><?=__('评价')?></a></li>
    </ul>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc more"></i><sup></sup></a> </div>
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
	<div class="round pd-share"><i></i></div>
	<div class="<% if (is_favorite) { %>favorite<% } %> round pd-collect"><i></i></div>

	<div class="round pd-collect puzzle-collect hide"><i></i></div>
	<% if (item_row.activity_id && item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GROUPBOOKING) { %>
	<div class="goods-puzzle">
		<span class="puzzle-title"><%= item_row.activity_item_row.activity_rule.group_quantity %><?=__('人拼团价')?></span>
		<div class="puzzle-price">￥<em><%= item_row.activity_item_row.activity_rule.group_sale_price%></em></div>
		<div class="puzzle-count">
			<p class="count-text"><?=__('距活动结束还剩余')?></p>

			<p class="count-time" data-end="<%=item_row.activity_item_row.activity_endtime%>">
                <em class="day" >00</em><?=__('天')?>
                <em class="hour">00</em><?=__('时')?>
                <em class="mini">00</em><?=__('分')?>
                <em class="sec" >00</em><?=__('秒')?>
             </p>

		</div>
	</div>
	<% } %>
</div>
<div class="goods-detail-cnt">
	<div class="goods-detail-name">
		<dl>
			<dt><%if(item_row.is_virtual == '1'){%><span><?=__('虚拟')?></span><%}%><% if (item_row.is_presell == '1') { %><span><?=__('预售')?></span><% } %><% if (item_row.is_fcode == '1') { %><span><?=__('F码')?></span><% } %><%=item_row.product_name%></dt>
			<dd><%=item_row.product_tips%></dd>
		</dl>
	</div>
	<div class="goods-detail-price">
		<% if (item_row.activity_type_id) { %>
		<dl>
			<dt>
				<% if (item_row.item_sale_price) { %>
				￥<em><%=item_row.item_sale_price%></em>
				<% } %>

				<% if (item_row.item_unit_points) { %>
				<em> + </em><em><%=item_row.item_unit_points%></em><?=__('积分')?>
				<% } %>
			</dt>

			<% if (max(item_row.item_unit_price, item_row.item_market_price)) { %>
			<dd><?=__('市场价')?> ￥<%=max(item_row.item_unit_price, item_row.item_market_price)%></dd>
			<% } %>

		</dl>
		<% if (item_row.activity_type_id == 'sole') { %>
			<span class="activity"><i></i><?=__('手机专享')?></span>
			<% } %>
		<% } else { %>
			<dl>
				<% if (item_row.item_unit_points) {%><dt class="hide">￥<em><%=item_row.item_sale_price+item_row.item_unit_points%></em>&nbsp;&nbsp;<?=__('或')?></dt><% } %>
				<dt>
					<% if (item_row.item_sale_price) { %>
					￥<em><%=item_row.item_sale_price%></em>
					<% } %>

					<% if (item_row.item_unit_points) { %>
					<em> + </em><em><%=item_row.item_unit_points%></em><?=__('积分')?>
					<% } %>
				</dt>
			</dl>
		<% } %>


		<% if (item_row.item_fx_commission) { %>
		<span style="font-size: .5rem;" class="hide"><?=__('佣金￥')?><%=item_row.item_fx_commission;%></span>
		<% } %>

		<!-- item_consume_points -->
		<% if (item_row.item_consume_points){ %>
		<span class="hide"  style="
		height: .7rem;
		padding: .1rem;
		margin-top: .1rem;
		font-size: .45rem;
		color: #FFF;
		line-height: .7rem;
		background: #ff6700;
		border-radius: .15rem;"><?=__('送')?><%=item_row.item_consume_points;%><?=__('积分')?></span>
		<%}%>

		<!-- item_consume_jb -->
		<% if (item_row.item_consume_jb){ %>
		<span class=""  style="
		height: .7rem;
		padding: .1rem;
		margin-top: .1rem;
		font-size: .45rem;
		color: #FFF;
		line-height: .7rem;
		background: #e50001;
		border-radius: .15rem;"><?=__('送')?><%=item_row.item_consume_jb;%><?=__('金宝')?></span>
		<%}%>


		<% if (!isEmpty(item_row.analytics_row)){ %>
			<span class="sold"><?=__('销量')?>：<%=item_row.analytics_row.product_sale_num;%> <?=__('件')?></span>
		<%}%>

	</div>

    <% if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GROUPBOOKING) { %>
    <!--<div class="htmleaf-container">
        <h4><?=__('拼团倒计时')?>：</h4>
        <div class="htmleaf-content">
            <div class="clearfix">
                <div class="group_count_down autosize"></div>
            </div>
        </div>
    </div>-->
    <% } %>


	<% if (item_row.activity_id && (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION || item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_DISCOUNT_PACKAGE || item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GIFT || item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN || item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_LIMITED_DISCOUNT || item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_DIY_PACKAGE  || (mansong_info != null && mansong_info.rules) || (gift_array && !isEmpty(gift_array)))) { %>
	<div class="goods-detail-item">
		<div class="itme-name"><?=__('促销')?></div>
		<div class="item-con">
			<% var activity_rule = item_row['activity_item_row'].activity_rule; %>


			<% if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION) { %>
			<dl class="goods-detail-sale">
				<dt>
					<i><%=item_row.activity_type_name%></i>
				</dt>
				<% if (activity_rule != null && activity_rule.rule.length) { for (var i =0;i<activity_rule.rule.length;i++){ %>
				<dd class="mansong-rule">
					<?=__('单笔订单满')?><em><%=activity_rule.rule[i].total%></em><?=__('元')?>
					<% if (activity_rule.rule[i].max_num > 0) { %>
					，<?=__('立减')?><em><%=activity_rule.rule[i].max_num%></em><?=__('元')?>
					<% } %>
				</dd>
				<%}}%>
			</dl>
			<% } %>
			<% if (item_row.activity_id && item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GROUPBOOKING) { %>
            <dl class="goods-detail-sale">
                <dt>
                    <i><%= item_row.activity_type_name %></i>
                </dt>
                <dd class="mansong-rule">
                    <%= item_row.activity_item_row.activity_rule.group_quantity %><?=__('人成团')?>&nbsp;&nbsp;
                    <% if (item_row.activity_item_row.activity_rule.group_buy_limit) { %>
                        <?=__('限购')?><%=item_row.activity_item_row.activity_rule.group_buy_limit%><?=__('件')?>&nbsp;&nbsp;
                    <% } %>
                    <% if (item_row.activity_item_row.activity_rule.group_discount_type == getStateCode().ACTIVITY_GROUPBOOKING_SALE_PRICE) { %>
                        <?=__('特价￥')?><%= item_row.activity_item_row.activity_rule.group_sale_price %>！
                    <% } else if(item_row.activity_item_row.activity_rule.group_discount_type == getStateCode().ACTIVITY_GROUPBOOKING_FIXED_AMOUNT) { %>
                        <?=__('立减￥')?><%= item_row.activity_item_row.activity_rule.group_fixed_amount %>！
                    <% } else if(item_row.activity_item_row.activity_rule.group_discount_type == getStateCode().ACTIVITY_GROUPBOOKING_FIXED_DISCOUNT) { %>
                        <?=__('打')?><%= item_row.activity_item_row.activity_rule.group_fixed_discount %><?=__('折')?>！
                    <% } %>
                </dd>
            </dl>
			<% } %>

			<% if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN) { %>
			<dl class="goods-detail-sale">
				<dt>
					<i><%=item_row.activity_type_name%></i>
				</dt>
				<% if (activity_rule != null && activity_rule.rule.length) { for (var i =0;i<activity_rule.rule.length;i++){ %>
				<dd class="mansong-rule">
					<?=__('单笔订单满')?><em><%=activity_rule.rule[i].total%></em><?=__('元')?>, <?=__('可加价购')?> <%=activity_rule.rule[i].max_num%> <?=__('件')?><?=__('商品')?>：

					<% for (var v in activity_rule.rule[i].item) { %>
					<% if (activity_rule.item_rows[v]){  %>
					<span><img src="<%=activity_rule.item_rows[v].product_image%>"/></span>
					<% } %>
					<% } %>
				</dd>
				<%}}%>
			</dl>
			<% } %>
			<% if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GIFT) { %>
			<dl class="goods-detail-sale">
				<dt>
					<i><%=item_row.activity_type_name%></i>
				</dt>
				<% if (activity_rule != null && activity_rule.rule.length) { for (var i =0;i<activity_rule.rule.length;i++){ %>
				<dd class="mansong-rule">
					<?=__('单笔订单满')?><em><%=activity_rule.rule[i].total%></em><?=__('元')?>, <?=__('可选择如下')?> <%=activity_rule.rule[i].max_num%> <?=__('件')?><?=__('礼品')?>：

					<% if (activity_rule.rule[i].item.length) { for (var j =0;j<activity_rule.rule[i].item.length;j++){  %>
					<% if (activity_rule.item_rows[activity_rule.rule[i].item[j]]){  %>
					<span><img src="<%=activity_rule.item_rows[activity_rule.rule[i].item[j]].product_image%>"/></span>
					<% }}} %>
				</dd>
				<%}}%>
			</dl>
			<% } %>
			<% if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_LIMITED_DISCOUNT) { %>
			<dl class="goods-detail-sale">
				<dt><i><%=item_row.activity_type_name%></i></dt>
				<dd>
					<% for (var i =0;i<activity_rule.discount.length;i++){ %>
					<% if (activity_rule.discount[i].item_id == item_row.item_id) { %>
					<?=__('直降')?>￥<%=(item_row.item_unit_price - activity_rule.discount[i].price)%>
					<% } %>
					<% } %>

					<% if( item_row['activity_item_row'].lower_limit ) { %>
					<?=__('最低')?><%=item_row['activity_item_row'].lower_limit%>件起，<%=item_row['activity_item_row'].explain%>
						<%  } %>
				<dd>
			</dl>
			<% } %>
			<% if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_DIY_PACKAGE) { %>
			<dl class="goods-detail-sale">
				<dt><i><%=item_row['activity_item_row'].activity_title%></i></dt>
				<dd>
				<% if (item_row['activity_item_row'].upper_limit) { %>
				<?=__('最多限购')?><%=item_row['activity_item_row'].upper_limit%><?=__('件')?>
					<%  } %>
				<%=item_row['activity_item_row'].remark%>
				<dd>
			</dl>
			<% } %>
			<% if (mansong_info != null && mansong_info.rules) { %>
			<dl class="goods-detail-sale">
				<dt>
					<i><?=__('满即送')?></i>
				</dt>
				<% if (mansong_info != null && mansong_info.rules) { for (var i =0;i<mansong_info.rules.length;i++){ %>
				<dd class="mansong-rule">
						<?=__('单笔订单满')?><em><%=mansong_info.rules[i].price%></em><?=__('元')?>
						<% if (mansong_info.rules[i].discount > 0) { %>
						，<?=__('立减')?><em><%=mansong_info.rules[i].discount%></em><?=__('元')?>
						<% } %>
						<% if (mansong_info.rules[i].item_row.item_image_row_url) { %>
						，<?=__('送礼品')?>：<span><img src="<%=mansong_info.rules[i].product_image%>"/></span>
						<% } %>
				</dd>
				<%}}%>
			</dl>
			<% } %>
			<% if (gift_array && !isEmpty(gift_array)) { %>
			<dl class="goods-detail-sale">
				<dt>
					<i><?=__('赠品')?></i>
				</dt>
				<% for (var k in gift_array) { var v = gift_array[k]; %>
				<dd class="gift-item">
					<a href="?item_id=<%= v.gift_goodsid %>"><%= v.gift_goodsname %></a>
					<em>&#215; <%= v.gift_amount %></em>
				</dd>
				<% } %>
			</dl>
			<% } %>
		</div>
	</div>
	<% } %>
	<% if (voucher) { %>
	<div class="goods-detail-voucher"><a href="javascript:void(0);" id="getVoucher"><i><?=__('券')?></i><?=__('点击领取店铺优惠券')?></a></div>
	<%}%>
	<div class="goods-detail-item">
		<div class="itme-name"><?=__('送至')?></div>
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
	<div class="goods-detail-item goods-detail-o2o mt5 mb5">
		<div class="o2o-enable multishop-enable">
			<div class="tit">
				<h3><?=__('商家信息')?></h3>
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
            <h3><?=__('门店信息（各个门店价格可能会不一样）')?></h3>
        </div>
        <div class="default" id="goods-detail-chain">
        </div>
        <div class="more-location"><a href="javascript:void(0);" id="store_chain_list"></a><i class="zc zc-arrow-r"></i></div>
    </div>



	<div class="goods-detail-item" id="goods_spec_selected">
		<div class="itme-name"><?=__('已选')?></div>
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
					<span><?=__('默认')?></span>
					<% } %>
				</dt>
			</dl>
		</div>
		<div class="item-more"><i class="zc zc-arrow-r arrow-r"></i></div>
	</div>
	<% if (!isEmpty(item_row.contractlist)) { %>
	<div class="goods-detail-item">
		<div class="itme-name"><?=__('服务')?></div>
		<div class="item-con">
			<dl class="goods-detail-contract">
				<dt><?=__('由')?>“<%= store_info.store_name %>”<?=__('销售和发货，并享受售后服务')?></dt>
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
			<a id="goodsEvaluation1" href="javascript:void(0);"><?=__('商品评价')?><span class="rate"><?=__('好评率')?><em><%=item_row.analytics_row.evaluation_percent%>%</em></span><span class="rate-num">（<%=item_row.analytics_row.product_evaluation_num%><?=__('人评价')?>）</span><div class="item-more"></div></a>
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

	<% if (item_row.activity_id && item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GROUPBOOKING && !isEmpty(item_row.activity_item_row) && !isEmpty(item_row.activity_item_row['group_rows'])){ %>
	<div class="group-book-list pd65 bgf mb05 mt50">
        <div class="f4 c1"><?=__('1人正在拼单')?></div>
        <div class="swiper-container">
	        <div class="swiper-wrapper">
	        	<% for( var j = 0; j < item_row.activity_item_row['group_rows'].length; j++ ) { %>
	        	<% var group_row = item_row.activity_item_row['group_rows'][j]; %>
	        	<% var activity_row = item_row.activity_item_row; %>
	        	<div class="swiper-slide">
			        <div class="ptb21 flex-sb flex-ycenter" href="javascript:;">
			            <div class="flex-xsycenter">
			                <div class="wh148 flex-fb148 img-w100 mr40 avatar-r100">
			                    <img src="<%=group_row['user_avatar']%>" alt="">
			                </div>
			                <div class="f4 c26" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 4rem;"><%=group_row['user_name']%></div>
			            </div>
			            <div class="flex-sb ">
			                <div class="flex-sb flex-dc mr40">
			                    <div class="f4 c26"><?=__('还差')?><%=(group_row['gb_quantity']*1 - group_row['gb_amount_quantity']*1)%><?=__('人拼单')?></div>
			                    <div class="f4 c26 "><?=__('剩余')?>：
			                    	<span class="c5 timeCount" data-end="<%=group_row.gb_endtime%>">
						                <em class="day" >00</em><?=__('天')?><em class="hour">00</em>:<em class="mini">00</em>:<em class="sec" >00</em>
						            </span>
			                    </div>
			                </div>
			                <div class="f6 c26 flex-ycenter">
			                	<a class="list-main-btn" href="./activity/groupbook_detail.html?gb_id=<%=group_row.gb_id%>&pid=<%=activity_row
.activity_rule.item_id%>&on=<%=group_row.order_id%>&isfg=true&type="><?=__('去拼单')?></a>
			                </div>
			            </div>
			        </div>
			    </div>
			    <% } %>
	    	</div>
	    </div>
    </div>
    <%}%>

	<% if (!isEmpty(store_info)){ %>
	<div class="goods-detail-store multishop-enable">
		<a href="store.html?store_id=<%= store_info.store_id %>">
			<div class="store-name"><i class="icon-store"></i><%= store_info.store_name %>
			<% if (store_info.store_is_selfsupport == '1') {%>
				<span class="icon-mall"><?=__('自营')?></span>
			<% } %></div>
			<% if (store_info.store_is_selfsupport != 1) {%>
			<% if (store_info.store_credit) { %>
			<div class="store-rate">
				<span class="<%= store_info.store_credit.store_desccredit.percent_class %>"><?=__('描述相符')?>
					<em><%= sprintf('%.1f', store_info.store_credit.store_desccredit.credit) %></em>
					<!--<i><%= store_info.store_credit.store_desccredit.percent_text %></i>-->
				</span>
				<span class="<%= store_info.store_credit.store_servicecredit.percent_class %>"><?=__('服务态度')?>
					<em><%= sprintf('%.1f', store_info.store_credit.store_servicecredit.credit) %></em>
					<!--<i><%= store_info.store_credit.store_servicecredit.percent_text %></i>-->
				</span>
				<span class="<%= store_info.store_credit.store_deliverycredit.percent_class %>"><?=__('发货速度')?>
					<em><%= sprintf('%.1f', store_info.store_credit.store_deliverycredit.credit) %></em>
					<!--<i><%= store_info.store_credit.store_deliverycredit.percent_text %></i>-->
				</span>
			</div>
			<% } %>
			<% } %>
			<div class="item-more"></div>
		</a>
	</div>
	<%}%>

	<% if (!isEmpty(goods_commend_list)){ %>
	<div class="goods-detail-recom">
		<h4><?=__('店铺推荐')?></h4>
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

	<div class="goods-detail-bottom"><a href="javascript:void(0);" id="goodsBody1"><?=__('点击查看商品详情')?></a></div>
	<div class="goods-detail-foot">
		<div class="otreh-handle">
			<a href="javascript:void(0);" class="kefu"><i></i><p><?=__('客服')?></p></a>
			<a href="../tmpl/cart_list.html" class="cart"><i></i><p><?=__('购物车')?></p><span id="cart_count"></span></a>
		</div>
	<%if(is_had_bought==0){ %>
		<div class="buy-handle <%if(!product_freight_info.if_store){%>no-buy<%}%>">
			<% if (item_row.activity_item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GROUPBOOKING) { %>
                <a href="javascript:void(0);" class="<%if(product_freight_info.if_store){%>animation-up<%}%> alone-now"><?=__('单独购买')?></a>
                <% if(!is_join) { %>
                    <a href="javascript:void(0);" class="<%if(product_freight_info.if_store){%>animation-up<%}%> group-now"><?=__('立即拼单')?></a>
                <% } else {%>
                    <a href="javascript:void(0);" class="<%if(product_freight_info.if_store){%>animation-up<%}%> group-now"><?=__('立即参团')?></a>
                <% } %>
			<% } else { %>
				<% if (!item_row.is_virtual) { %>
					<% if (item_row.if_cart == '1') { %>
					<a href="javascript:void(0);" class="<%if(product_freight_info.if_store){%>animation-up<%}%> add-cart"><?=__('加入购物车')?></a>
					<% } %>
					<a href="javascript:void(0);" class="<%if(product_freight_info.if_store){%>animation-up<%}%> buy-now"><?=__('立即购买')?></a>
				<% } else { %>
					<a href="javascript:void(0);" class="<%if(product_freight_info.if_store){%>animation-up<%}%> buy-now"><?=__('立即预约')?></a>
				<% } %>
			<% } %>
		</div>
	<% } else {%>
		 <div class="buy-handle no-buy">
			<a href="javascript:void(0);" class="buy-now"><?=__('您已参加本商品抢购活动')?></a>
		</div>
	<% } %>

</div>
</script>

<script type="text/html" id="product_detail_sepc">
<% var StateCode = getStateCode(); %>
<div class="sstouch-bottom-mask-bg"></div>
<div class="sstouch-bottom-mask-block">
	<div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
	<div class="sstouch-bottom-mask-top goods-options-info">
		<div class="goods-pic">
		<img src="<%=item_row.item_image_row[0]%>"/>
	</div>
	<dl>
		<dt><%=item_row.product_item_name%></dt>
		<dd class="goods-price">
			<% if (item_row.activity_type_id) {
			var promo;

			if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_DIY_PACKAGE)
			{
			promo = '<?=__('抢购')?>';
			}
			else if (item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN || item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION || item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_DIY_PACKAGE
			|| item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_LIMITED_DISCOUNT)
			{
			promo = '<?=__('限时折扣')?>';

			}
			else
			{
			promo = '<?=__('手机专享')?>';
			}

			%>
			<% } else { %>
			<% } %>

			<% if (item_row.item_unit_points) {%><!--￥<em><%=item_row.item_sale_price+item_row.item_unit_points%></em>&nbsp;&nbsp;或 --><% } %>

			<% if (item_row.item_sale_price) { %>
			￥<em><%=item_row.item_sale_price%></em>
			<% } %>

			<% if (item_row.item_unit_points) { %>
			<em> + </em><em><%=item_row.item_unit_points%></em><?=__('积分')?>
			<% } %>
			<span class="goods-storage"><?=__('库存')?>：<%=item_row.item_quantity%><?=__('件')?></span>
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
			<dt><?=__('提货方式')?>：</dt>
			<dd><a href="javascript:void(0);" class="current"><?=__('v电子兑换券')?></a></dd>
		</dl>
        <% if (item_row.product_validity_end != '0000-00-00') { %>
		<dl class="spec-promotion">
			<dt><?=__('有效期')?>：</dt>
			<dd><a href="javascript:void(0);" class="current"><?=__('即日起')?> <?=__('到')?> <%= item_row.product_validity_end %></a>
				<% if (item_row.product_buy_limit && item_row.product_buy_limit > 0) { %>
				（<?=__('每人次限购')?> <%= item_row.product_buy_limit %> <?=__('件')?>）
				<% } %>
				</dd>
		</dl>
        <% } %>
	<% } else { %>
		<% if (item_row.is_presell == '1') { %>
		<dl class="spec-promotion">
			<dt><?=__('预售')?>：</dt>
			<dd><a href="javascript:void(0);" class="current"><%= item_row.presell_deliverdate_str %> <?=__('日发货')?></a></dd>
		</dl>
		<% } %>
		<% if (item_row.is_fcode == '1') { %>
		<dl class="spec-promotion">
			<dt><?=__('购买类型')?>：</dt>
			<dd><a href="javascript:void(0);" class="current"><?=__('F码优先购买')?></a>（<?=__('每个F码优先购买一件商品）')?></dd>
		</dl>
		<% } %>
		<% } %>
	</div>
</div>
<div class="goods-option-value"><?=__('购买数量')?>
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
			<p><?=__('客服')?></p>
		</a>
		<a href="../tmpl/cart_list.html" class="cart">
			<i></i>
			<p><?=__('购物车')?></p>
			<span id="cart_count1"></span>
		</a>
	</div>

	<%if(is_had_bought==0){ %>
	<div class="buy-handle <%if(!product_freight_info.if_store){%>no-buy<%}%>">
        <% if (item_row.activity_item_row.activity_type_id == getStateCode().ACTIVITY_TYPE_GROUPBOOKING) { %>
            <a href="javascript:void(0);" class="alone-now" type="alone" id="alone-now"><?=__('单独购买')?></a>
            <% if(!is_join) { %>
                <a href="javascript:void(0);" class="group-now" type="group" id="group-now"><?=__('立即拼团')?></a>
            <% } else {%>
                <a href="javascript:void(0);" class="group-now" type="group" id="group-now"><?=__('立即拼团')?></a>
            <% } %>
        <% } else { %>
            <% if (!item_row.is_virtual) { %>
                <% if (item_row.if_cart == '1') { %>
                    <a href="javascript:void(0);" class="add-cart" id="add-cart"><?=__('加入购物车')?></a>
                <% } %>
                <a href="javascript:void(0);" class="buy-now" type="buy" id="buy-now"><?=__('立即购买')?></a>
            <% } else { %>
                <a href="javascript:void(0);" class="buy-now" type="buy" id="buy-now"><?=__('立即预约')?></a>
            <% } %>
        <% } %>

	</div>
	<% } else {%>
		 <div class="buy-handle no-buy">
			<a href="javascript:void(0);" class="buy-now"><?=__('您已参加本商品抢购活动')?></a>
		</div>
	<% } %>
</div>
</script>
<script type="text/html" id="voucher_script">
<% if (voucher) { %>
	<div class="sstouch-bottom-mask-bg"></div>
	<div class="sstouch-bottom-mask-block">
		<div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
		<div class="sstouch-bottom-mask-top store-voucher">
			<i class="icon-store"></i>
			<%=store_info.store_name%>&nbsp;&nbsp;<?=__('领取店铺优惠券')?>
			<a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
		</div>
		<div class="sstouch-bottom-mask-rolling" id="voucher_roll">
			<div class="sstouch-bottom-mask-con">
				<ul class="sstouch-voucher-list">
				<% for (var i=0; i<voucher.length; i++) { %>
				<li>
					<dl>
						<dt class="money"><?=__('面额')?><em><%=voucher[i].voucher_t_price%></em><?=__('元')?></dt>
						<dd class="need"><?=__('需消费')?><%=voucher[i].voucher_t_limit%><?=__('使用')?></dd>
						<dd class="time"><?=__('至')?><%=voucher[i].voucher_t_end_date%><?=__('前使用')?></dd>
					<dl>
					<a href="javascript:void(0);" class="btn" data-tid=<%=voucher[i].voucher_t_id%>><?=__('领取')?></a>
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
			<dt><%=items[i].chain_name%><span><i></i><?=__('查看地图')?></span></dt>
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
				<dt><%=items[i].chain_name%> <span><?=__('查看')?></span></dt>
				<dd><?=__('门店价格')?>：￥<%=items[i].chain_item_unit_price%></dd>
				<dd><?=__('门店地址')?>：<%=items[i].chain_address%>，<?=__('电话')?>：<%=items[i].chain_mobile%></dd>
			</a>
		</dl>
		<span class="chain"><a href="javascript:chain_buy('<%=items[i].chain_id%>');"><i class="zc zc-cart-fill"></i></a></span>
	</li>
	<% } %>
</script>

<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>

<script type="text/javascript" src="../js/libs/swipe.js"></script>
<script type="text/javascript" src="../js/countdown/raphael.js"></script>
<script type="text/javascript" src="../js/countdown/jquery.classyled.min.js"></script>
<script type="text/javascript" src="../js/tmpl/product_detail.js"></script>



<!--o2o分店地址Begin-->
<div id="list-address-wrapper" class="sstouch-full-mask hide">
  <div class="sstouch-full-mask-bg"></div>
  <div class="sstouch-full-mask-block">
    <div class="header transparent" style="display: block;">
      <div class="header-wrap">
        <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
          <h1><?=__('商家信息')?></h1>
        </div>
      </div>
    </div>
    <div class="sstouch-main-layout">
        <div class="sstouch-o2o-tip"><a href="javascript:void(0);" id="map_all"><i></i><?=__('全部实体分店共')?><em></em><?=__('家')?><span></span></a></div>
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
					<h1><?=__('商家门店信息')?></h1>
				</div>
			</div>
		</div>
		<div class="sstouch-main-layout">
			<div class="sstouch-o2o-tip"><i></i><?=__('全部门店共')?><em id="chain_all"></em><?=__('家')?>
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