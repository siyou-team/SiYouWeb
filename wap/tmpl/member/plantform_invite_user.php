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
    <title><?=__('我的粉丝')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>

<body>
<header id="header" class="fixed">
    <div class="header-wrap">
        <div class="header-l"><a href="plantform_invite.html"><i class="zc zc-back back"></i></a></div>
        <div class="header-title">
            <h1><?=__('我的粉丝')?></h1>
        </div>
        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
    </div>

    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"> <span class="arrow"></span>
            <ul>
                <li><a href="../../index.html"><i class="home"></i><?=__('首页')?></a></li>
                <li><a href="../search.html"><i class="search"></i><?=__('搜索')?></a></li>
                <li><a href="../cart_list.html"><i class="cart"></i><?=__('购物车')?></a><sup></sup></li>
                <li><a href="javascript:void(0);"><i class="message"></i><?=__('消息')?><sup></sup></a></li>
            </ul>
        </div>
    </div>

</header>

<div class="sstouch-main-layout">
    <div class="sstouch-order-search hide">
        <form>
                <span>
					<input type="text" autocomplete="on" maxlength="50" placeholder="<?=__('输入会员名称进行搜索')?>" name="user_name" id="user_name" oninput="writeClear($(this));" >
					<span class="input-del"></span>
				</span>
            <input type="button" id="search_btn" value="&nbsp;">
        </form>
    </div>

    <div id="fixed_nav1" class="sstouch-single-nav">
        <ul id="filtrate_ul" class="w20h">
            <li class="selected"><a href="javascript:void(0);" data-state=""><?=__('我的粉丝')?></a></li>
        </ul>
    </div>
    <div class="sstouch-order-list">
        <ul id="order-list"></ul>
    </div>
</div>

<div class="fix-block-r">
    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="order-list-tmpl">
    <% var invitelist = data.items; %>
    <% if (invitelist.length > 0){%>
    <% for(var i = 0;i<invitelist.length;i++)
    {
    var memberinfo = invitelist[i];
    %>
    <li class="<%if(i>0){%>mt10<%}%>">
        <div class="sstouch-order-item">
            <div class="sstouch-order-item-con">
                <div class="goods-block">
                    <a href="javascript:void(0);">
                        <div class="goods-pic"><img src="<%=memberinfo.user_avatar%>" /></div>
                        <dl class="goods-info">
                            <p><?=__('用户名')?>：<%=memberinfo.user_nickname%></p>
                            <p>&nbsp;</p>
                            <!--<p><?=__('手机号')?>：<%=memberinfo.user_mobile%></p>-->
                            <p><?=__('注册时间')?>：<%=$getLocalTime(memberinfo.user_time)%></p>
                        </dl>
                    </a>
                </div>
            </div>
        </div>
    </li>
    <% } %>
    <% if (hasmore) {%>
    <li class="loading">
        <div class="spinner"><i></i></div><?=__('我的粉丝')?>...</li>
    <% } %>
    <%}else {%>
    <div class="sstouch-norecord order">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您还没有相关的会员')?></dt>
            <dd><?=__('可以去看看哪些想要买的')?></dd>
        </dl>
        <a href="<%=WapSiteUrl%>" class="btn"><?=__('随便逛逛')?></a>
    </div>
    <%}%>
</script>



<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/plantform_invite_user.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
