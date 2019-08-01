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
<title><?=__('店铺介绍')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_store.css">
    <style>

        .swipe {
            overflow: hidden;
            visibility: hidden
        }

        .swipe-wrap {
            overflow: hidden
        }

        .swipe-wrap>div {
            float: left;
            width: 100%
        }

        .swipe-wrap img {
            width: 100%
        }

    </style>
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1);"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('店铺介绍')?></h1>
    </div>
    <div class="header-r"> <a href="javascript:void(0);" id="header-nav"><i class="zc zc-more more"></i><sup></sup></a> </div>
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
<div class="sstouch-main-layout fixed-Width">
  <div class="sstouch-main-layout" id="store_intro"> </div>
</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
</body>
<script type="text/html" id="store_intro_tpl">
    <div class="store-banner-list">
        <div class="swipe-wrap">
            <% for (var i in info.store_slide) { %>
            <div class="item">
                <a href="<%= info.store_slide[i].url %>">
                    <img src="<%= info.store_slide[i].img %>g" alt="">
                </a>
            </div>
            <% } %>
        </div>
    </div>

	<div class="sstouch-store-info">
		<div class="store-avatar"><img src="<%= base.store_logo %>" /></div>
		<dl class="store-base">
			<dt><%= base.store_name %></dt>
			<dd class="class"><% if(!store_is_selfsupport){%><?=__('类型')?>：<%= store_category_name %><% } %></dd>
			<dd class="type">
				<% if(base.store_is_selfsupport){%><?=__('平台自营')?><% }else{%><?=__('普通店铺')?><% } %>
			</dd>
		</dl>
		<div class="store-collect">
			<a href="javascript:void(0);" id="store_collected"><?=__('已收藏')?></a>
			<a href="javascript:void(0);" id="store_notcollect"><?=__('收藏')?></a>
			<p><input type="hidden" id="store_favornum_hide" value="<%= analytics.store_collect%>"/>
			<em id="store_favornum"><%= analytics.store_favorite_num %></em><?=__('粉丝')?></p>

		</div>
	</div>
	<% if(!base.store_is_selfsupport){%>
	<div class="sstouch-store-block">
		<ul class="credit">
			<li><!-- span 样式名称可以是high、equal、low -->
				<h4><?=__('描述相符')?></h4>
				<span class="<%=analytics.store_credit.store_desccredit.percent_class %>">
					<strong><%= sprintf('%.1f', analytics.store_credit.store_desccredit.credit) %></strong>
					<% if(analytics.store_credit.store_desccredit.percent_class == 'equal'){%>
					<?=__('与同行业持平')?>
					<% }else{ %>
					<%= analytics.store_credit.store_desccredit.percent_text %><?=__('同行业')?>
					<% } %>
					<em><%= analytics.store_credit.store_desccredit.percent %></em>
				</span>
			</li>
			<li>
				<h4><?=__('服务态度')?></h4>
				<span class="<%=analytics.store_credit.store_servicecredit.percent_class %>">
					<strong><%= sprintf('%.1f',analytics.store_credit.store_servicecredit.credit) %></strong>
					<% if(analytics.store_credit.store_servicecredit.percent_class == 'equal'){%>
					<?=__('与同行业持平')?>
					<% }else{ %>
					<%= analytics.store_credit.store_servicecredit.percent_text> <?=__('同行业')?>
					<% } %>
					<em><%= analytics.store_credit.store_servicecredit.percent %></em>
				</span>
			</li>
			<li>
				<h4><?=__('物流服务')?></h4>
				<span class="<%=analytics.store_credit.store_deliverycredit.percent_class %>">
					<strong><%= sprintf('%.1f',analytics.store_credit.store_deliverycredit.credit) %></strong>
					<% if(analytics.store_credit.store_deliverycredit.percent_class == 'equal'){%>
					<?=__('与同行业持平')?>
					<% }else{ %>
					<%= analytics.store_credit.store_deliverycredit.percent_text %><?=__('同行业')?>
					<% } %>
					<em><%= analytics.store_credit.store_deliverycredit.percent %></em>
				</span>
			</li>
		</ul>
	</div>
	<% } %>
	<div class="sstouch-store-block">
		<ul>
			<% if(company.company_name){%>
			<li>
				<h4><?=__('公司名称')?></h4>
				<span><%= company.company_name %></span>
			</li>
			<% } %>
			<% if(company.company_area){%>
			<li>
				<h4><?=__('所在地')?></h4>
				<span><%= company.company_area %></span>
			</li>
			<% } %>
			<% if(store_time){%>
			<li>
				<h4><?=__('开店时间')?></h4>
				<span><%= info.store_start_time %></span>
			</li>
			<% } %>
			<% if(store_category_name){%>
			<li>
				<h4><?=__('主营商品')?></h4>
				<span><%= store_category_name %></span>
			</li>
			<% } %>
			<% if(base.store_address){%>
			<li>
				<h4><?=__('店铺地址')?></h4>
				<span><i class="zc zc-shouhuodizhi1" style="font-size: 14px;"></i><%= base.store_address %></span>
			</li>
			<% } %>
		</ul>
	</div>
	<div class="sstouch-store-block">
		<ul>
			<% if(info.store_tel){%>
			<li>
				<h4><?=__('联系电话')?></h4>
				<span>
					<%= info.store_tel %>
				</span>
				<a href="tel:<%= info.store_tel %>" class="call"></a>
			</li>
			<% } %>
			<% if(info.store_workingtime){%>
			<li>
				<h4><?=__('工作时间')?></h4>
				<span><%= info.store_workingtime %></span>
			</li>
			<% } %>
			<% if(info.store_qq || info.store_ww){%>
			<li>
				<h4><?=__('联系方式')?></h4>
				<span>
					<% if(info.store_qq){%>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<%= info.store_qq %>&site=qq&menu=yes" target="_blank" class="qq">
						<i></i><?=__('QQ联系')?>
					</a>
					<% }　%>
				</span>
			</li>
			<% } %>
		</ul>
	</div>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="js/libs/swipe.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/store_intro.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>