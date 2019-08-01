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
    <title><?=__('兑换礼品详情')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_cart.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../css/integral.css">
    <link rel="stylesheet" type="text/css" href="../css/points_product_detail.css">
</head>
<body>
<header id="header" class="sstouch-product-header fixed">
    <div class="header-wrap">
        <div class="header-l">
            <a href="points_shop.html"><i class="zc zc-back back"></i></a>
        </div>
        <div class="header-title">
            <h1><?=__('兑换礼品详情')?></h1>
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
<style>
    .goods-detail-item .itme-name{width:2.6rem}
    .goods-detail-item .item-con{margin-left:3rem}
    .goods-detail-item .item-con dd{font-weight:bold}
    .goods-detail-sale{margin-bottom:0}
    .goods-detail-top{position:relative}
    .goods-detail-top .goods-detail-pic img{width:100%;height:auto;display:block}
</style>
<div class="integral-part">
    <div id="pgoods_info"></div>
    <div id="get_list">
        <div class="goods-detail-item hide" style="margin-top:8px;height:18px">
            <div class="itme-name" style="width:90%">
                <i class="integral-record fl"></i>
                <b style="font-size:0.65rem;color:#000;float:left;padding-left:0.3rem"><?=__('兑换记录')?></b>
            </div>
        </div>
        <div class="goods-detail-item" style="padding:0 0.5rem">
            <ul class="ncp-exchangeNote"></ul>
        </div>
        <div style="height:2rem"></div>
    </div>
</div>
<div class="goods-detail-foot">
    <div class="buy-handle" style="width: 100%">
        <a id="add-cart" class="add-cart" style="width:100%;background: #f23030"><?=__('我要兑换')?></a>
    </div>
</div>
<div id="product_detail_spec_html" class="sstouch-bottom-mask"></div>
<!--选择收货地址Begin-->
<div id="list-address-wrapper" style="z-index:9999" class="sstouch-full-mask hide">
    <div class="sstouch-full-mask-bg"></div>
    <div class="sstouch-full-mask-block">
        <div class="header">
            <div class="header-wrap">
                <div class="header-l"> <a href="javascript:void(0);"> <i class="back"></i> </a> </div>
                <div class="header-title">
                    <h1><?=__('收货地址管理')?></h1>
                </div>
            </div>
        </div>
        <div class="sstouch-main-layout" style="display: block; position: absolute; top: 0; right: 0; left: 0; bottom:2rem; overflow: hidden; z-index: 1;" id="list-address-scroll">
            <ul class="sstouch-cart-add-list" id="list-address-add-list-ul">
            </ul>
        </div>
        <div id="addresslist" class="mt10" style="position: absolute; right: 0; left: 0; bottom: 0; z-index: 1;"> <a href="javascript:void(0);" class="btn-l btn-add-address"><?=__('新增收货地址')?></a> </div>
    </div>
</div>
<!--选择收货地址End-->

</body>
<script type="text/html" id="pgoods_body">
    <div class="goods-detail-top">
        <div class="goods-detail-pic" id="mySwipe">
            <img src="<%= data.product_image %>" />
        </div>
    </div>
    <div class="goods-detail-name">
        <dl>
            <dt><%= data.product_item_name %></dt>
        </dl>
    </div>
    <div class="goods-detail-price">
        <dl>
            <dt style="color:#f23030;"><em><%= data.activity_points_num %></em>&nbsp;<?=__('积分')?></dt>
        </dl>
        <span class="sold"><?=__('剩余')?>:&nbsp;<%= data.activity_points_product_num %>&nbsp;<?=__('件')?></span>
    </div>
    <div class="goods-detail-item">
        <div class="itme-name" style="width: 3.5rem;">
            <?=__('市场参考价')?>
        </div>
        <div class="item-con">
            <dl class="goods-detail-sale">
                <dd>&nbsp;&nbsp;<%= data.item_sale_price %>&nbsp;<?=__('元')?></dd>
            </dl>
        </div>
    </div>
    <div class="goods-detail-item" style="margin-top:8px;height:18px">
        <div class="itme-name" style="width:90%">
            <i class="integral-provide fl"></i>
            <b style="font-size:0.65rem;color:#000;float:left;padding-left:0.3rem"><?=__('礼品描述')?></b>
        </div>
    </div>
    <div class="goods-detail-item">
        <div class="itme-name">
          <?=__('礼品编号')?>
        </div>
        <div class="item-con">
            <dl class="goods-detail-sale">
                <dd><%= data.activity_item_id %></dd>
            </dl>
        </div>
    </div>
    <div class="goods-detail-item">
        <div class="itme-name">
          <?=__('添加时间')?>
        </div>
        <div class="item-con">
            <dl class="goods-detail-sale">
                <dd><%= data.activity_item_starttime %></dd>
            </dl>
        </div>
    </div>
    <div class="goods-detail-item hide">
        <div class="itme-name">
              <?=__('浏览人次')?>
        </div>
        <div class="item-con">
            <dl class="goods-detail-sale">
                <dd><%= 1 %>&nbsp;  <?=__('人次')?> </dd>
            </dl>
        </div>
    </div>
</script>

<script type="text/html" id="product_detail_sepc">
    <% var StateCode = getStateCode(); %>
    <div class="sstouch-bottom-mask-bg"></div>
    <div class="sstouch-bottom-mask-block">
        <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
        <div class="sstouch-bottom-mask-top goods-options-info">
            <div class="goods-pic">
                <img src="<%= data.product_image %>" />
            </div>
            <dl>
                <dt><%= data.product_item_name %></dt>
                <dd class="goods-price">
                    <span class="goods-storage"><?=__('剩余')?>:&nbsp;<%= data.activity_points_product_num %>&nbsp;<?=__('件')?></span>
                </dd>
            </dl>
            <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
        </div>

        <div class="sstouch-bottom-mask-rolling" id="address-lists">
            <div class="sstouch-cart-block">
                <!--正在使用的默认地址Begin-->
                <div class="sstouch-cart-add-default">
                    <a href="javascript:void(0);" id="list-address-valve"><i class="icon-add"></i>
                        <dl>
                            <dt>收货人：<span id="ud_name"></span><span id="ud_mobile"></span></dt>
                            <dd><span id="district_info"></span></dd>
                        </dl>
                        <i class="icon-arrow"></i></a>
                </div>
                <!--正在使用的默认地址End-->
            </div>
        </div>

        <div class="goods-option-value"><?=__('兑换数量')?>
            <div class="value-box">
                <span class="minus">
                    <a href="javascript:void(0);">&nbsp;</a>
                </span>
                <span>
                    <input type="text" pattern="[0-9]*" class="buy-num" id="buynum" value="1" />
                </span>
                <span class="add">
                    <a href="javascript:void(0);">&nbsp;</a>
                </span>
            </div>
        </div>

        <div class="goods-option-foot">
            <div class="buy-handle" style="width: 100%">
                <a id="add-point-order" class="add-cart" style="width:100%;background: #f23030"><?=__('我要兑换')?></a>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="pgoods_list">
    <% if(order_list.length > 0){ %>
    <%for(i=0;i<order_list.length;i++){%>
    <li>
        <div class="user-avatar">
            <img src="<%=order_list[i].member_avatar%>">
        </div>
        <div class="user-name">
            <%=order_list[i].member_name%>
        </div>
        <div class="user-log">
            <%=order_list[i].point_addtime%> <?=__('兑换了')?><strong><%=order_list[i].point_goodsnum%></strong><?=__('件')?>
        </div>
    </li>
    <% } %>
    <% } %>
</script>

<script type="text/html" id="list-address-add-list-script">
    <% for (var i=0; i<address_list.length; i++) { %>
    <li <% if (ud_id == address_list[i].ud_id) { %>class="selected"<% } %> data-param="{ud_id:'<%=address_list[i].ud_id%>',ud_name:'<%=address_list[i].ud_name%>',ud_mobile:'<%=address_list[i].ud_mobile%>',district_info:'<%=address_list[i].district_info %>',ud_address:'<%=address_list[i].ud_address%>'}"> <i></i>
    <dl>
        <dt><?=__('收货人')?>：<span><%=address_list[i].ud_name%></span><span><%=address_list[i].ud_mobile%></span><% if (address_list[i].ud_is_default == 1) { %><sub><?=__('默认')?></sub><% } %></dt>
        <dd><span><%=address_list[i].district_info %>&nbsp;<%=address_list[i].ud_address %></span></dd>
    </dl>
    </li>
    <% } %>
</script>

<script> var navigate_id ="2";</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>

<script type="text/javascript" src="../js/tmpl/points_product_detail.js"></script>

</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>