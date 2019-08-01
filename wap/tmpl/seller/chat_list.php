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
<title><?=__('消息列表')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_chat.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="app-no-fixed">
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
				        <li><a href="seller.html"><i class="zc zc-home home"></i><?=__('商家中心')?></a></li>
				        <li><a href="seller_address_list.html"><i class="zc zc-peisongdizhi"></i><?=__('发货地址')?></a></li>
				        <li><a href="seller_express.html"><i class="zc zc-wuliukuaidi"></i><?=__('物流公司')?></a></li>
				        <li><a href="seller_account.html"><i class="zc zc-yonghushezhi1"></i><?=__('店铺设置')?><sup></sup></a></li>
				        <li><a href="chat_list.html"><i class="zc zc-message message"></i>IM <?=__('客服')?><sup></sup></a></li>
				        <li id="logoutbtn"><a href="javascript:void(0);"><i class="zc zc-logout"></i><?=__('退出登录')?><sup></sup></a></li>
				    </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout">
  <ul class="sstouch-message-list" id="messageList">
  </ul>
</div>
<footer id="footer"></footer>

<script type="text/html" id="messageListScript">
    <% if (!isEmpty(items)) { %>
    <% for (var k in items) { %>
    <li> <a href="chat_info.html?user_other_id=<%=items[k].user_other_id%>&user_other_nickname=<%=items[k].user_other_nickname%>">
        <div class="avatar">
            <img src="<%=items[k].user_other_avatar%>"/>
            <% if (items[k].message_is_read == 0) {%>
            <sup></sup>
            <%}%>
        </div>
        <dl>
            <dt><%=items[k].user_other_nickname%></dt>
            <dd><%=items[k].message_content%></dd>
        </dl>
        <time><%=items[k].message_time%></time>
    </a>
        <a href="javascript:void(0)" user_other_id="<%=items[k].user_other_id%>" class="msg-list-del"></a>
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
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/chat_list.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
