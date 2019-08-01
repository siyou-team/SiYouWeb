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
<title><?=__('默认物流公司')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="seller.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('选择默认物流')?></h1>
    </div>
	<div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-save save"></i></a> </div>
  </div>
</header>
<div class="sstouch-main-layout mb20">
  <div class="sstouch-address-list" id="address_list">
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="saddress_list">
<%
    var expresslist = items;
 %>
	<ul>
	<%
	for (i in expresslist){%>
        <li>
		    <dl>
              <dt>
             <span class="name"><input name="defaultexpress" value="<%= expresslist[i].logistics_id %>" type="checkbox" <%if(expresslist[i].logistics_is_default==1){%>checked<%}%>></span>
			 <span class="phone"><%=expresslist[i].logistics_name %></span>
		     </dt>
			 </dl>
        </li>
	<%}%>
    </ul>
	<a class="btn-l mt5" href="javascript:void(0)"><?=__('保存设置')?></a>

</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/seller_express.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
