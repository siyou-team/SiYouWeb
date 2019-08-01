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
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../css/integral.css">
</head>
<body>
<header id="header" class="sstouch-product-header fixed">
    <div class="header-wrap">
        <div class="header-l">
            <a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a>
        </div>
        <div class="header-title">
            <h1><?=__('优惠券')?></h1>
        </div>
        <div class="header-r">
            <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>
        </div>
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

<div id="page_diy_contents" style="margin-top: 2rem;margin-bottom:0.5rem;"></div>

<div class="integral-part mb20">

</div>
<footer id="footer" class="bottom"></footer>
</body>
<script type="text/html" id="voucher_body">
    <% var voucher_list = data.items;var StateCode = getStateCode(); %>
    <% if(voucher_list && voucher_list.length >0){%>
    <div class="integral-02">
        <ul class="integral-list">
            <%for(i=0;i<voucher_list.length;i++){ var voucher = voucher_list[i];%>
            <li activity_id="<%=voucher.activity_id%>" voucher_price="<%=voucher.activity_rule.voucher_price%>">
                <div class="top-title">
                    <h1 class="fl"><b><%=voucher.store_name%></b>&nbsp;&nbsp;<%= voucher.activity_name%></h1>
                    <% if(false){ %>
                    <h2 class="fr"><i class="red-word"><?=__('等级要求')?></i>&nbsp;<span class="level">Lv.<b><%="1"%></b></span></h2>
                    <% } %>
                </div>
                <div class="top-content">
                    <img class="fl" src="<%= voucher.activity_rule.voucher_image %>"/>
                    <div class="fl">
                        <span class="red-word">&yen;<b><%= voucher.activity_rule.voucher_price %></b></span>
                        <span class="red-word"><?=__('购物满')?><%= voucher.activity_rule.voucher_price %><?=__('元可用')?></span>
                        <span class="gray-word"><?=__('有效期至')?><%= voucher.activity_endtime%></span>
                        <% if (voucher.activity_type == getStateCode().GET_VOUCHER_BY_POINT) { %>
                        <span class="red-word" style="font-size:0.7rem"><?=__('需')?><%=  voucher.activity_rule.requirement.points.needed %><?=__('积分')?></span>
                        <% } else { %>
                        <span class="red-word" style="font-size:0.7rem"><?=__('免费兑换')?></span>
                        <% }  %>
                        <span class="gray-word"><%= voucher.activity_rule.voucher_quantity_use ? voucher.activity_rule.voucher_quantity_use : 0 %><?=__('人已兑换')?></span>
                    </div>
                    <% if(voucher.if_gain) { %>
                    <a class="btn key integral-more get_voucher" href="javascript:void(0);"><?=__('立即兑换')?></a>
                    <% } else { %>
                    <a href="javascript:void(0)" class="btn integral-more"><?=__('已经兑换')?></a>
                    <% } %>
                </div>
            </li>
            <%}%>
            <% if (hasmore) {%>
            <li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?>...</li>
            <% } %>
        </ul>
        <div class="clear"></div>
    </div>
    <%
    }else {
    %>
    <div class="sstouch-norecord search">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('没有找到任何相关信息')?></dt>
        </dl>
    </div>
    <%}%>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/points_list_voucher.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>

<script type="text/javascript" src="../js/tmpl/addcart.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>