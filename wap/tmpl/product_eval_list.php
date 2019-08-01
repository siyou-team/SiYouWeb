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
<title><?=__('商品列表')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_products_detail.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
</head>
<body>
<header id="header" class="posf appshow">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <ul class="header-nav">
      <li><a href="javascript:void(0);" id="goodsDetail"><?=__('商品')?></a></li>
      <li><a href="javascript:void(0);" id="goodsBody"><?=__('详情')?></a></li>
      <li class="cur"><a href="javascript:void(0);" id="goodsEvaluation"><?=__('评价')?></a></li>
    </ul>
    <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
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
<div class="sstouch-main-layout">
  <div class="sstouch-tag-nav">
    <ul>
      <li class="selected"><a href="javascript:void(0);" data-state=""><?=__('全部评价')?></a></li>
      <li><a href="javascript:void(0);" data-state="1"><?=__('好评')?></a></li>
      <li><a href="javascript:void(0);" data-state="2"><?=__('中评')?></a></li>
      <li><a href="javascript:void(0);" data-state="3"><?=__('差评')?></a></li>
      <li><a href="javascript:void(0);" data-state="4"><?=__('晒图')?></a></li>
      <!--<li><a href="javascript:void(0);" data-state="5">追加评价</a></li>-->
    </ul>
  </div>
  <div id="product_evaluation_html" class="product-eval-list"></div>
</div>
<footer id="footer" class="bottom"></footer>
</body>
<script type="text/html" id="product_ecaluation_script">
		<% if (items.length > 0) { %>
		<ul>
			<% for (var i=0; i<items.length; i++) { %>
        	<li>
				<div class="eval-user">
					<div class="user-avatar"><img src="<%=items[i].user_avatar%>" /></div>
					<span class="user-name"><%=items[i].user_name%></span>
					<time><%=items[i].comment_time%></time>
				</div>
				<div class="goods-raty"><i class="star<%=items[i].comment_scores%>"></i></div>
				<dl class="eval-con">
					<dt><%=items[i].comment_content%></dt>
					<%if(items[i].comment_image.length) {%>
					<dd class="goods_geval">
						<%for (var j=0; j<items[i].comment_image.length; j++) {%>
							<a href="javascript:void(0);"><img src="<%=items[i].comment_image[j]%>" /></a>
						<%}%>
						<div class="sstouch-bigimg-layout hide">
							<div class="close"></div>
							<div class="pic-box">
								<ul>
								<%for (var j=0; j<items[i].comment_image.length; j++) {%>
									<li style="background-image: url(<%=items[i].comment_image[j]%>)"></li>
								<%}%>
								</ul>
							</div>
							<div class="sstouch-bigimg-turn">
								<ul>
								<%for (var j=0; j<items[i].comment_image.length; j++) {%>
									<li class="<% if(j == 0) { %>cur<%}%>"></li>
								<%}%>
								</ul>
							</div>
						</div>
					</dd>
					<%}%>
				</dl>
				<%if(items[i].comment_reply && items[i].comment_reply != '') {%>

				<%for (var j=0; j<items[i].comment_reply.length; j++) {%>
				<div class="eval-explain">
					<%=items[i].comment_reply[j].user_name%> ： <%=items[i].comment_reply[j].comment_reply_content%>   -   <%=items[i].comment_reply[j].comment_reply_time%>
				</div>
				<%}%>

				<%}%>
				<% if (items[i].comment_content_again) {%>
				<div class="again-eval"><time><%=items[i].geval_addtime_again_date%><time><?=__('追加评价')?></div>
				<dl class="eval-con">
					<dt><%=items[i].comment_content_again%></dt>
					<%if(items[i].geval_image_again_240) {%>
					<dd class="goods_geval">
						<%for (var j=0; j<items[i].geval_image_again_240.length; j++) {%>
							<a href="javascript:void(0);"><img src="<%=items[i].geval_image_again_240[j]%>" /></a>
						<%}%>
						<div class="sstouch-bigimg-layout hide">
							<div class="close"></div>
							<div class="pic-box">
								<ul>
								<%for (var j=0; j<items[i].geval_image_again_240.length; j++) {%>
									<li style="background-image: url(<%=items[i].geval_image_again_1024[j]%>)" ></li>
								<%}%>
								</ul>
							</div>
							<div class="sstouch-bigimg-turn">
								<ul>
								<%for (var j=0; j<items[i].geval_image_again_240.length; j++) {%>
									<li class="<% if(j == 0) { %>cur<%}%>"></li>
								<%}%>
								</ul>
							</div>
						</div>
					</dd>
					<%}%>
				</dl>
				<%if(items[i].comment_reply_again && items[i].comment_reply_again != '') {%>
					<div class="eval-explain"><?=__('解释')?>：<%=items[i].comment_reply_again%></div>
					<%}%>
				<% } %>
        	</li>
			<% } %>
			<li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>
		</ul>
        <%}else {%>
        <div class="sstouch-norecord eval">
            <div class="norecord-ico"><i></i></div>
            <dl>
                <dt><?=__('该商品未收到任何评价')?></dt>
				<dd><?=__('期待您的购买与评论！')?></dd>
            </dl>
        </div>
        <%}%>
	</div>
</div>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>

<script type="text/javascript" src="../js/tmpl/product_eval_list.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>