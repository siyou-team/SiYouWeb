<?php
include __DIR__ . '/includes/header.php';
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
<title>专题</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<header id="header" class="fixed fixed-Width">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1>专题</h1>
    </div>
    <div class="header-r"><a id="header-nav" href="javascript:void(0);" style="width: 0.95rem; height: 0.95rem; padding: 0.5rem 0.75rem;"><i class="zc zc-more more"></i><sup></sup></a></div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="index.html"><i class="zc zc-home home"></i>首页</a></li>
        <li><a href="tmpl/search.html"><i class="zc zc-search search"></i>搜索</a></li>
        <li><a href="tmpl/product_first_categroy.html"><i class="zc zc-categroy categroy"></i>分类</a></li>
        <li><a href="tmpl/cart_list.html"><i class="zc zc-cart cart"></i>购物车<sup></sup></a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i>消息<sup></sup></a></li>
        <li><a href="tmpl/member/member.html"><i class="zc zc-member member"></i>我的商城</a></li>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout sstouch-home-layout fixed-Width" id="main-container"></div>
<footer id="footer"></footer>
<script type="text/html" id="adv_list">
	<div class="adv_list" style="margin-top:2rem;">
		<div class="swipe-wrap">
		<% for (var i in item) { %>
			<div class="item">
				<a href="<%= item[i].url %>">
					<img src="<%= item[i].image %>" alt="">
				</a>
			</div>
		<% } %>
		</div>
	</div>
</script>

<script type="text/html" id="swipe_list">
	<div class="sstouch-home-block">
		<% if (title) { %>
		<div class="tit-bar"><span><%= title %></span></div>
		<% } %>

		<div class="swipe-container">
			<div class="swipe-wrap">
				<% for (var i in item) { %>
				<div class="item">
					<a href="<%= item[i].url %>">
						<img src="<%= $image_thumb(item[i].image, 640, 260) %>" alt="">
					</a>
				</div>
				<% } %>
			</div>
		</div>
	</div>

</script>


<script type="text/html" id="entrance">
	<div class="sstouch-home-nav fixed-Width">
		<ul>
			<% for (var i in item) { %>
			<li class="">
				<a href="<%= item[i].url %>"><span style="background-image: url(<%= item[i].image %>);background-size:cover;"></span>
					<p><%= item[i].name %></p>
				</a>
			</li>
			<% } %>
		</ul>
	</div>
</script>
<script type="text/html" id="home1">
	<div class="sstouch-home-block">
		<% if (title) { %>
		<div class="tit-bar style1"><span><%= title %></span></div>
		<% } %>
		<div class="item-pic">
			<a href="<%= url %>">
				<img src="<%= image %>" alt="">
			</a>
		</div>
	</div>
</script> 
<script type="text/html" id="home2">
	<div class="sstouch-home-block">
		<% if (title) { %>
		<div class="tit-bar style1"><span><%= title %></span></div>
		<% } %>
		<ul class="item-pic-l1-r2">
			<li>
				<a href="<%= square_url %>"><img src="<%= square_image %>" alt=""></a>
			</li>
			<li>
				<a href="<%= rectangle1_url %>"><img src="<%= rectangle1_image %>" alt=""></a>
			</li>
			<li>
				<a href="<%= rectangle2_url %>"><img src="<%= rectangle2_image %>" alt=""></a>
			</li>
		</ul>
	</div>
</script> 
<script type="text/html" id="home3">
	<div class="sstouch-home-block">
		<% if (title) { %>
		<div class="tit-bar style1"><span><%= title %></span></div>
		<% } %>
		<ul class="item-pic-list">
		<% for (var i in item) { %>
			<li>
				<a href="<%= item[i].url %>"><img src="<%= item[i].image %>" alt=""></a>
			</li>
		<% } %>
		</ul>
	</div>
</script>


<script type="text/html" id="item3">
	<div class="sstouch-home-block">
		<% if (title) { %>
		<div class="tit-bar style1"><span><%= title %></span></div>
		<% } %>
		<ul class="item-pic-list-3">
			<% for (var i in item) { %>
			<li <% if (0 == ((i+1)%3)) {%> style="border-right: solid #EEE 0px;" <%} %> >
			<div>
				<a href="<%= item[i].url %>"><img src="<%= $image_thumb(item[i].image, 213, 213) %>" alt=""></a>
			</div>
			</li>
			<% } %>
		</ul>
	</div>
	<div style="height: 0.4rem;clear:both;display: none;"></div>
</script>


<script type="text/html" id="home4">
	<div class="sstouch-home-block">
		<% if (title) { %>
		<div class="tit-bar style2"><span><%= title %></span></div>
		<% } %>
		<ul class="item-pic-l2-r1">
			<li>
				<a href="<%= rectangle1_url %>"><img src="<%= rectangle1_image %>" alt=""></a>
			</li>
			<li>
				<a href="<%= rectangle2_url %>"><img src="<%= rectangle2_image %>" alt=""></a>
			</li>
			<li>
				<a href="<%= square_url %>"><img src="<%= square_image %>" alt=""></a>
			</li>
		</ul>
	</div>
</script> 
<script type="text/html" id="goods">
	<div class="sstouch-home-block item-goods">
		<% if (title) { %>
		<div class="tit-bar style3"><span><%= title %></span></div>
		<% } %>
		<ul class="goods-list" style="background-color: #F0F0F0;">
		<% for (var i in item) { %>
			<li>
				<a href="tmpl/product_detail.html?item_id=<%= item[i].item_id %>">
					<div class="goods-pic"><img src="<%= $image_thumb(item[i].product_image, 360) %>" alt=""></div>
					<dl class="goods-info">
						<dt class="goods-name"><%= item[i].product_name %></dt>
						<dd class="goods-price"><% if(item[i].product_unit_price) {%>￥<em><%= item[i].product_unit_price %></em> <% } %>  <% if(item[i].product_unit_points) {%><em><%= item[i].product_unit_points %></em>积分 <% } %></dd>
					</dl>
				</a>
			</li>
		<% } %>
		</ul>
	</div>
</script>


<script type="text/html" id="goods1">
	<div class="sstouch-home-block style_lc xianshi">
		<% if (title) { %>
		<div class="tit-bar">
			<img src="images/icon_time.png" alt="">
			<span><%= title %></span>
			<span class="stit">限时优惠抓紧</span>
		</div>
		<% } %>
		<div class="xianshi-list">
			<ul class="swipe-wrap">
				<% for (var i in item) { %>
				<div class="item">
					<li>
						<a href="tmpl/product_detail.html?product_id=<%= item[i].product_id %>">
							<div class="goods-pic"><img src="<%= item[i].product_image %>" alt=""></div>
							<dl class="goods-info">
								<dt class="goods-name"><%= item[i].product_name %></dt>
								<dd class="goods-price">￥<em><%= item[i].xianshi_price %></em> <del>￥<%= item[i].product_unit_price %></del></dd>
								<dd class="goods-time">剩余时间:<span class="time-remain" count_down="<%= item[i].time; %>"><em time_id="d"></em>天<em time_id="h"></em>:<em time_id="m"></em>:<em time_id="s"></em></span></dd>
							</dl>
						</a>
					</li></div>
				<% } %>
			</ul></div>
	</div>
</script>
<script type="text/html" id="goods2">
	<div class="sstouch-home-block item-goods">
		<% if (title) { %>
		<div class="tit-bar"><span><%= title %></span></div>
		<div class="desc"><span class="time">精品抢购 有您所选</span></div>
		<% } %>
		<ul class="goods-list">
			<% for (var i in item) { %>
			<li>
				<a href="tmpl/product_detail.html?product_id=<%= item[i].product_id %>">
					<div class="goods-pic"><img src="<%= item[i].product_image %>" alt=""></div>
					<dl class="goods-info">
						<dt class="goods-name"><%= item[i].product_name %></dt>
						<dd class="goods-price">￥<em><%= item[i].product_unit_price %></em><em class="goods-group">抢购</em></dd>
					</dl>
				</a>
			</li>

			<% } %>
		</ul>
	</div>
</script>

<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/libs/lib.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/special.js"></script> 
<script type="text/javascript" src="js/tmpl/footer.js"></script>
</body>
</html>

<?php
include __DIR__ . '/includes/footer.php';
?>
