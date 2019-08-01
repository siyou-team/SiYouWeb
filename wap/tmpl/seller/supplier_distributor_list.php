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
<title><?=__('分销申请')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>

 <header id="header" class="app-no-fixed">
    <div class="header-wrap">
        <div class="header-l">
            <a href="javascript:history.go(-1)">
                <i class="zc zc-back back"></i>
            </a>
        </div>
        <div class="header-title">
            <h1><?=__('我的客户')?></h1>
        </div>
        <div class="header-r">
            <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>
        </div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu">
            <span class="arrow"></span>
            <ul>
                <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
                <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
                <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
                <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
                <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
            </ul>
        </div>
    </div>
</header>

<!-- <header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="member.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-tab"><a href="javascript:void(0);" class="cur">客户列表</a><a href="supplier_apply_list.html">客户申请</a></div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../../index.html"><i class="zc zc-home home"></i>首页</a></li>
        <li><a href="../search.html"><i class="zc zc-search search"></i>搜索</a></li>
        <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i>分类</a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i>消息<sup></sup></a></li>
        <li><a href="../cart_list.html"><i class="zc zc-cart cart"></i>购物车<sup></sup></a></li>
        <li><a href="../member/member.html"><i class="zc zc-member member"></i>我的商城</a></li>
      </ul>
    </div>
  </div>
</header> -->
<div class="sstouch-main-layout mb20">
  <div class="sstouch-address-list" id="address_list"></div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="saddress_list">
<%if(items.length>0){%>
	<ul>
	<%for(var i=0;i<items.length;i++){%>
        <li>
            <dl class="clearfix">
              <dt style="font-size: 0.8rem;float: left;color: #666"><%=items[i].distributor_name %></dt>
              <dd style="font-size: 0.6rem;float: right;line-height: 1.3rem;color: #ff6700;">
                  <% if( items[i].distributor_enable == 1 ) { %>
                      <?=__('审核通过')?>
                  <% } else if( items[i].distributor_enable == 2 ){ %>
                      <?=__('审核拒绝')?>
                  <% } else { %>
                      <?=__('等待审核')?>
                  <% } %>
              </dd>
            </dl>
            <div class="handle">
           		<span>
          <% if( items[i].distributor_enable ) { %>
          <a href="javascript:;" class="del" data-id = '<%=items[i].store_distributor_id%>' ><?=__('删除')?></a>
          <% } else { %>
          <a href="javascript:;" class="oper" data-status = '1' data-id = '<%=items[i].store_distributor_id%>' ><?=__('通过')?></a><a href="javascript:;" data-status = '2' data-id="<%=items[i].store_distributor_id%>" class="oper"><?=__('拒绝')?></a>
          <% } %>
					
				</span>
            </div>
        </li>
	<%}%>
    </ul>
	
<%}else{%>
    <div class="sstouch-norecord address">
		<div class="norecord-ico"><i></i></div>
			<dl>
				<dt><?=__('您还没有分销商申请')?></dt>
			</dl>
		</div>
	</div>
<%}%>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/supplier_distributor_list.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script> 
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
