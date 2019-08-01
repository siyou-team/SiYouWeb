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
<title><?=__('发货地址管理')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="seller.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('发货地址管理')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="seller_address_opera.html"><i class="add"></i></a> </div>
  </div>
</header>
<div class="sstouch-main-layout mb20">
  <div class="sstouch-address-list" id="address_list"></div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="saddress_list">
<%
var address_list = items;
if(address_list.length>0){%>
	<ul>
	<%for(var i=0;i<address_list.length;i++){%>
        <li>
            <dl>
                <dt>
					<span class="name"><%=address_list[i].ss_name %></span>
					<span class="phone"><%=address_list[i].ss_mobile %></span>
				</dt>
                <dd><%=address_list[i].ss_province %>/<%=address_list[i].ss_city %>/<%=address_list[i].ss_county %>&nbsp;<%=address_list[i].ss_address %></dd>
            </dl>
            <div class="handle">
				<% if (address_list[i].ss_is_default == 1) { %>
				<?=__('默认地址')?>
				<% } %>
           		<span>
					<a href="seller_address_opera_edit.html?address_id=<%=address_list[i].ss_id %>"><i class="edit"></i><?=__('编辑')?></a><a href="javascript:;" data-ss_id="<%=address_list[i].ss_id %>" class="deladdress"><i class="del"></i><?=__('删除')?></a>
				</span>
            </div>
        </li>
	<%}%>
    </ul>
	<a class="btn-l mt5" href="seller_address_opera.html"><?=__('添加新地址')?></a>
<%}else{%>
    <div class="sstouch-norecord address">
		<div class="norecord-ico"><i></i></div>
			<dl>
				<dt><?=__('您还没有过添加收货地址')?></dt>
				<dd><?=__('正确填写常用收货地址方便购物')?></dd>
			</dl>
			<a href="seller_address_opera.html" class="btn"><?=__('添加新地址')?></a>
		</div>
	</div>
<%}%>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/seller_address_list.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
