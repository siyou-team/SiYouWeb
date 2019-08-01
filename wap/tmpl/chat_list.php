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
<title><?=__('消息列表')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_chat.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('消息列表')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more  bgc-t"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
        <li><a href="search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
        <li><a href="product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
        <li><a href="member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout">
  <ul class="sstouch-message-list" id="messageList">
  </ul>
</div>
<script type="text/html" id="messageListScript">
<% if (!isEmpty(list)) { %>
<% for (var k in list) { %>
    <li> <a href="chat_info.html?t_id=<%=k%>&t_name=<%=list[k].u_name%>">
      <div class="avatar">
		<img src="<%=list[k].avatar%>"/>
		<% if (list[k].r_state == 2) {%>
		<sup></sup>
		<%}%>
	</div>
      <dl>
        <dt><%=list[k].u_name%></dt>
        <dd><%=list[k].t_msg%></dd>
      </dl>
      <time><%=list[k].time%></time>
      </a>
	  <a href="javascript:void(0)" t_id="<%=k%>" class="msg-list-del"></a>
	  </li>
<% } %>
<% } else { %>
        <div class="sstouch-norecord talk">
			<div class="norecord-ico"><i></i></div>
				<dl>
                 <dt><?=__('您还没有和任何人联系过')?></dt>
				<dd><?=__('对话后可在此找到最近联系的客服')?></dd>
			</dl>
     	</div>
<% } %>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/chat_list.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>