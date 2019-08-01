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
    <title><?=__('商品列表')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../css/integral.css">
</head>
<body>
<header id="header" class="sstouch-product-header fixed">
    <div class="header-wrap">
        <div class="header-l">
            <a href="points_shop.html"><i class="zc zc-back back"></i></a>
        </div>
        <div class="header-title">
            <h1><?=__('精选礼品')?></h1>
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
<script type="text/html" id="pgoods_body">
    <% var points_product_list = data.items; %>
    <% if(points_product_list.length >0){%>
    <div class="integral-02">
        <ul class="integral-list">
            <%for(i=0,c=points_product_list.length;i<c;i++){%>
            <li>
                <a href="points_detial.html?activity_item_id=<%=points_product_list[i].activity_item_id%>">
                    <div class="top-content">
                        <img class="fl" src="<%= points_product_list[i].product_image %>" alt=""/>
                        <div class="fl">
                            <span class="black-word"><strong><%= points_product_list[i].product_item_name %></strong></span>
                            <span class="gray-word line-t" style="margin-top:0.6rem">&yen;<b style="font-weight:normal"><%=points_product_list[i].product_unit_price%></b></span>
                            <span class="red-word" style="font-size:0.7rem;margin-top:0.4rem"><?=__('需')?><%=points_product_list[i].activity_points_num%><?=__('积分')?></span>
                        </div>
                        <% if(points_product_list[i].activity_level_limits > 0){ %>
                        <div class="level-b"><i class="red-word"><?=__('等级要求')?></i>&nbsp;<span class="level">Lv.<b><%= points_product_list[i].activity_level_limits %></b></span></div>
                        <% } %>
                    </div>
                </a>
            </li>
            <% } %>
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
    <%
    }
    %>
</script>
<script> var navigate_id ="2";</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/points_list_item.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>