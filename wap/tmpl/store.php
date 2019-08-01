<?php
include __DIR__ . '/../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1"/>
    <title><?=__('店铺首页')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_store.css">

    <!-- loadcss 不完美-->
    <link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
</head>
<body>
<header id="header" class="sstouch-store-header fixed-Width appshow">
    <div class="header-wrap">
        <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
        <a class="header-inp" id="goods_search" href=""><i class="zc zc-search-thin icon"></i><span
                class="search-input"><?=__('搜索店铺内商品')?></span></a>
        <div class="header-r"><a id="store_categroy" href="" class="store-categroy"><i class="zc zc-categroy-3"></i>
        </a> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a></div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"><span class="arrow"></span>
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
<div class="sstouch-main-layout fixed-Width mb25">
    <div id="store-wrapper" class="sstouch-store-con">
        <!-- banner -->
        <div class="sstouch-store-top" id="store_banner"></div>
        <!-- 导航条 -->
        <div id="nav_tab_con" class="sstouch-single-nav sstouch-store-nav">
            <ul id="nav_tab">
                <li class="selected"><a href="javascript: void(0);" data-type="storeindex"><i class="store"></i><?=__('店铺首页')?></a>
                </li>
                <li><a href="javascript: void(0);" data-type="allgoods"><i class="goods"></i><?=__('全部商品')?></a></li>
                <li><a href="javascript: void(0);" data-type="newgoods"><i class="new"></i><?=__('商品上新')?></a></li>
                <li><a href="javascript: void(0);" data-type="storeactivity"><i class="sale"></i><?=__('店铺活动')?></a></li>
            </ul>
        </div>

        <!-- 首页s -->
        <div id="storeindex_con" style="position: relative; z-index: 1;">
            <!-- 轮播图 -->
            <div class="sstouch-store-block">
                <div id="store_sliders" class="sstouch-store-wapper sstouch-store-sliders"></div>
            </div>
            <!-- 店铺排行榜 -->
            <div class="sstouch-store-block sstouch-store-ranking">
                <div class="title"><?=__('店铺排行榜')?></div>
                <div class="sstouch-single-nav">
                    <ul id="goods_rank_tab">
                        <li><a href="javascript: void(0);" data-type="product_favorite_num"><?=__('收藏排行')?></a></li>
                        <li><a href="javascript: void(0);" data-type="product_sale_num"><?=__('销量排行')?></a></li>
                    </ul>
                </div>
                <div class="top-list" shopsuite_type="goodsranklist" id="goodsrank_product_favorite_num"></div>
                <div class="top-list" shopsuite_type="goodsranklist" id="goodsrank_product_sale_num"></div>
            </div>
            <!-- 店主推荐 -->
            <div class="sstouch-store-block">
                <div class="title"><?=__('店主推荐')?></div>
                <div class="sstouch-store-goods-list" id="goods_recommend"></div>
            </div>
        </div>
        <!-- 首页e -->
        <!-- 全部宝贝 -->
        <div id="allgoods_con"></div>
        <!-- 商品上新 -->
        <div id="newgoods_con" class="sstouch-store-goods-list">
            <ul id="newgoods"></ul>
        </div>
        <!-- 店铺活动 -->
        <div id="storeactivity_con"></div>
    </div>
</div>
<div class="fix-block-r">
    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<div id="store_voucher_con"></div>
<div class="sstouch-store-bottom fixed-Width">
    <ul>
        <li><a id="store_intro" href="javascript:void(0);"><?=__('店铺介绍')?></a></li>
        <li class="store_voucher hide"><a id="store_voucher" href="javascript: void(0);"><?=__('店铺分类')?></a></li>
        <li class="store_pay_url"><a id="store_pay_url" href="./store_favorable.html?store_id="><?=__('优惠买单')?></a></li>
        <li><a id="store_kefu" href="javascript: void(0);"><?=__('联系客服')?></a></li>
    </ul>
</div>
<!-- banner tpl -->
<script type="text/html" id="store_banner_tpl">
    <div class="store-top-bg"><span class="img" shopsuite_type="store_banner_img"></span></div>
    <div class="store-top-mask"></div>
    <div class="store-avatar"><img src="<%=base.store_logo %>"/></div>
    <div class="store-name"><%= base.store_name %></div>
    <div class="store-favorite">
        <a href="javascript:void(0);" id="store_collected" class="added"><?=__('已收藏')?></a><a href="javascript:void(0);"
                                                                                   id="store_notcollect"><?=__('收藏')?></a><span
            class="num"><input type="hidden" id="store_favornum_hide" value="<%= analytics.store_collect %>"/><em
            id="store_favornum"><%= analytics.store_favorite_num %></em><p><?=__('粉丝')?></p></span>
    </div>
</script>
<!-- 轮播图 tpl -->
<script type="text/html" id="store_sliders_tpl">
    <ul class="swipe-wrap">
        <% for (var i=0;i< info.store_slide.length ;i++) {
        var s = info.store_slide[i];
        %>
        <li class="item">
            <% if(s.img) {%>
            <% if (s.item >0) { %>
            <a href="product_detail.html?item_id=<%= s.item %>"><img alt="" src="<%= s.img %>"/></a>
            <% } else{ %>
            <a href="<%= s.url %>"><img alt="" src="<%= s.img %>"/></a>
            <% } %>
            <% } %>
        </li>
        <% } %>
    </ul>
</script>
<!-- 店铺排行榜_收藏排行 tpl -->
<script type="text/html" id="goodsrank_product_favorite_num_tpl">
    <% for (var i in items) { var v = items[i]; %>
    <dl class="goods-item" style="width:20%;">
        <a href="product_detail.html?product_id=<%= v.product_id %>">
            <dt><img alt="<%= v.product_name %>" src="<%= $image_thumb(v.product_image, 360) %>"/></dt>
            <dd><span><?=__('已售')?><em><%= v.product_sale_num %></em></span><% if (v.product_unit_price){%><span>￥<em><%= v.product_unit_price %></em></span><%
                } %><% if (v.product_unit_points){%><span> + <em><%= v.product_unit_points %></em><?=__('积分')?></span><% } %>
            </dd>
        </a>
    </dl>
    <% } %>
</script>
<!-- 店铺排行榜_销量排行 tpl -->
<script type="text/html" id="goodsrank_product_sale_num_tpl">
    <% for (var i in items) { var v = items[i]; %>
    <dl class="goods-item" style="width:20%;">
        <a href="product_detail.html?product_id=<%= v.product_id %>">
            <dt><img alt="<%= v.product_name %>" src="<%= $image_thumb(v.product_image, 360) %>"/></dt>
            <dd><span><?=__('已售')?><em><%= v.product_sale_num %></em></span><% if (v.product_unit_price){%><span>￥<em><%= v.product_unit_price %></em></span><%
                } %><% if (v.product_unit_points){%><span> + <em><%= v.product_unit_points %></em><?=__('积分')?></span><% } %>
            </dd>
        </a>
    </dl>
    <% } %>
</script>
<!-- 店主推荐 tpl -->
<script type="text/html" id="goods_recommend_tpl">
    <ul>
        <% for (var i in rec_items) { var g = rec_items[i]; %>
        <li class="goods-item" style="width:20%;">
            <a href="product_detail.html?product_id=<%= g.product_id %>">
                <div class="goods-item-pic">
                    <img alt="" src="<%= $image_thumb(g.product_image, 360) %>"/>
                </div>
                <div class="goods-item-name"><%= g.product_name %></div>
                <div class="goods-item-price"><% if (g.product_unit_price){%>￥<em><%= g.product_unit_price %></em><% }
                    %><% if (g.product_unit_points){%> + <em><%= g.product_unit_points %></em><?=__('积分')?><% } %>
                </div>
            </a>
        </li>
        <% } %>
    </ul>
</script>
<!-- 商品上新 tpl -->
<script type="text/html" id="newgoods_tpl">
    <% if(items.length >0){%>
    <% for (var i in items) { var v = items[i]; %>
    <% if(v.product_sale_time){ %>
    <li class="addtime hide" addtimetext='<%=v.product_sale_time %>'>
        <time style="color:#999;"><%=v.product_sale_time %></time>
    </li>
    <% } %>
    <li class="goods-item" style="width:20%;" style="width: 100%;">
        <a href="product_detail.html?product_id=<%= v.product_id %>">
            <div class="goods-item-pic">
                <img alt="" src="<%= $image_thumb(v.product_image, 360) %>"/>
            </div>
            <div class="goods-item-name"><%= v.product_name %></div>
            <div class="goods-item-price">￥<em><%= v.product_unit_price %></em></div>
        </a>
    </li>
    <% } %>
    <li class="loading">
        <div class="spinner"><i></i></div>
        <?=__('商品数据读取中')?>...
    </li>
    <% }else { %>
    <div class="sstouch-norecord search">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('商铺最近没有新品上架')?></dt>
            <dd><?=__('收藏店铺经常来逛一逛')?></dd>
        </dl>
    </div>
    <% } %>
</script>
<!-- 店铺活动 tpl -->
<script type="text/html" id="storeactivity_tpl">
    <% var StateCode = getStateCode();%>
    <% if(activity_rows.length <= 0){ %>
    <div class="sstouch-norecord search">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('商铺最近没有促销活动')?></dt>
            <dd><?=__('收藏店铺经常来逛一逛')?></dd>
        </dl>
    </div>
    <% } %>

    <% for (var id in activity_rows) { var activity = activity_rows[id]  %>
    <% if(activity.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN || activity.activity_type_id == getStateCode().ACTIVITY_TYPE_GIFT ||
    activity.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION){%>
    <div class="store-sale-block">
        <div class="store-sale-tit">
            <h3><%=activity.activity_name %></h3>
            <time><?=__('活动时间')?>：<%=activity.activity_starttime%> <?=__('至')?> <%=activity.activity_endtime%></time>
        </div>

        <!-- 活动商品 -->
        <li class="sotre-sale-con grid">
            <p style="padding: .2rem .4rem;font-size: .8rem;"><?=__('活动商品')?>：</p>
            <ul class=" goods-secrch-list">
                <% if(activity.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN || activity.activity_type_id ==
                getStateCode().ACTIVITY_TYPE_GIFT ||
                activity.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION ) { %>
                <% for (var i=0;activity.activity_rule.requirement.buy.item.length > i; i++){ var item_id =
                activity.activity_rule.requirement.buy.item[i];%>
                <li class="goods-item" item_id="<%= item_id%>">
                    <span class="goods-pic">
                        <a id="goods_pic<%= item_id%>" href="product_detail.html?item_id=<%= item_id%>">
                            <img src="<%= activity_item_rows[item_id].product_image%>!100x100.jpg">
                        </a>
                    </span>
                    <dl class="goods-info">
                        <dt class="goods-name">
                            <a href="product_detail.html?item_id=<%= item_id%>">
                                <h4><%= activity_item_rows[item_id].product_item_name%></h4>
                                <h6></h6>
                            </a>
                        </dt>
                        <dd class="goods-sale">
                            <a href="product_detail.html?item_id=<%= item_id%>">
                                <span class="goods-price">￥<em><%= activity_item_rows[item_id].item_unit_price%></em>
                                </span>
                            </a>
                        </dd>
                    </dl>
                </li>
                <% } %>
                <% } %>
            </ul>
            <p style="padding: .2rem .4rem;font-size: .8rem;"><?=__('活动规则')?>：</p>
            <% if (activity.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN
            || activity.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION
            || activity.activity_type_id == getStateCode().ACTIVITY_TYPE_GIFT){ %>
            <% for(var j=0; activity.activity_rule.rule.length > j; j++){ var rule = activity.activity_rule.rule[j];
            %>

            <div class="store-sale-tit">
                <% if (activity.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN){ %>
                <span><?=__('购买同一加价购活动商品消费满')?><em>¥<%= rule.total %></em><?=__('可换购最多')?> <em><%= rule.max_num %></em>
                                <?=__('件（0为不限）以下优惠商品')?>:</span>
                <% } else if (activity.activity_type_id == getStateCode().ACTIVITY_TYPE_REDUCTION){ %>
                <span><?=__('购买活动商品消费满')?><em>¥<%= rule.total %></em>，<?=__('可立减')?><em>¥<%= rule.max_num %></em>。</span>
                <% } else if (activity.activity_type_id == getStateCode().ACTIVITY_TYPE_GIFT){ %>
                <span><?=__('购买活动商品消费满')?><em>¥<%= rule.total %></em>，<?=__('可最多赠送')?><em><%= rule.max_num %></em>
                                <?=__('件以下活动商品。')?></span>
                <% } %>
            </div>

            <ul class="goods-secrch-list">
                <% if (activity.activity_type_id == getStateCode().ACTIVITY_TYPE_BARGAIN || activity.activity_type_id ==
                getStateCode().ACTIVITY_TYPE_REDUCTION){ %>
                <% for (item_id in rule.item){ %>

                <li class="goods-item" style="width: 48%;">
                            <span class="goods-pic">
                                <a id="goods_pic<%= item_id%>" href="product_detail.html?item_id=<%= item_id%>">
                                    <img src="<%= activity_item_rows[item_id].product_image%>!100x100.jpg">
                                </a>
                            </span>
                    <dl class="goods-info">
                        <dt class="goods-name">
                            <a href="product_detail.html?item_id=<%=item_id%>">
                                <h4><%= activity_item_rows[item_id].product_item_name%></h4>
                                <h6></h6>
                            </a>
                        </dt>
                        <dd class="goods-sale">
                            <a href="product_detail.html?item_id=<%= item_id%>">
                                <span class="goods-price">￥<em><%= rule.item[item_id] %></em></span>
                                <span class="goods-price"
                                      style="display: inline-block;font-size: .55rem;text-decoration: line-through;color: #999;line-height: .9rem;vertical-align: baseline">￥<%= activity_item_rows[item_id].item_unit_price%></span>
                            </a>
                        </dd>
                    </dl>
                </li>
                    <% } %>
                    <% } else { %>
                        <% for ( var n=0; n < rule.item.length ;n++){ var item_id=rule.item[n]; %>
                <li class="goods-item">
                        <span class="goods-pic">
                                    <a id="goods_pic<%= item_id%>" href="product_detail.html?item_id=<%= item_id%>">
                                        <img src="<%= activity_item_rows[item_id].product_image%>!100x100.jpg">
                                    </a>
                                </span>
                        <dl class="goods-info">
                            <dt class="goods-name">
                                <a href="product_detail.html?item_id=<%= item_id%>">
                                    <h4><%= activity_item_rows[item_id].product_item_name%></h4>
                                    <h6></h6>
                                </a>
                            </dt>
                            <dd class="goods-sale">
                                <a href="product_detail.html?item_id=<%= item_id%>">
                                        <span class="goods-price">￥<em><%= activity_item_rows[item_id].item_unit_price%></em>
                                        </span>
                                </a>
                            </dd>
                        </dl>
                </li>
                        <% } %>
                </ul>
            <% } %>
            <% } %>

            <% } else { %>
            <div>
                <span><?=__('活动商品限时打折。')?></span>
            </div>
            <% for ( var n=0;n < activity.activity_rule.discount.length ; n++) { var
            discount=activity.activity_rule.discount[n];%>

            <span class="goods-pic">
                        <a id="goods_pic<%= discount.item_id%>"
                           href="product_detail.html?item_id=<%= discount.item_id%>">
                            <img src="<%= activity_item_rows[discount.item_id].product_image%>!100x100.jpg">
                        </a>
                    </span>
            <dl class="goods-info">
                <dt class="goods-name">
                    <a href="product_detail.html?item_id=<%= discount.item_id%>">
                        <h4><%= activity_item_rows[discount.item_id].product_item_name%></h4>
                        <h6></h6>
                    </a>
                </dt>
                <dd class="goods-sale">
                    <a href="product_detail.html?item_id=<%= discount.item_id%>">
                        <?=__('原价：')?><span
                            class="goods-price">￥<em><%= activity_item_rows[discount.item_id].item_unit_price%></em></span>
                        <?=__('折扣价')?>：<span class="goods-price">￥<em><%= discount.price %></em></span>
                    </a>
                </dd>
            </dl>
            <% } %>
            <% } %>
        </li>
    </div>
    <% } %>
    <% } %>
</script>

<script type="text/html" id="store_voucher_con_tpl">
    <div class="sstouch-bottom-mask">
        <div class="sstouch-bottom-mask-bg"></div>
        <div class="sstouch-bottom-mask-block">
            <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
            <div class="sstouch-bottom-mask-top store-voucher">
                <i class="icon-store"></i><?=__('领取店铺优惠券')?><a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
            </div>
            <div class="sstouch-bottom-mask-rolling">
                <div class="sstouch-bottom-mask-con">
                    <ul class="sstouch-voucher-list">
                        <% if(items.length > 0){ %>
                        <% for (var i=0; i < items.length; i++) { var v = items[i]; %>
                        <li>
                            <dl>
                                <dt class="money"><?=__('面额')?><em><%=v.activity_rule.voucher_price %></em><?=__('元')?></dt>
                                <dd class="need"><?=__('需消费')?><%=v.activity_rule.requirement.buy.subtotal
                                    %><?=__('元使用，消耗')?><%=v.activity_rule.requirement.points.needed%><?=__('积分可领取')?>
                                </dd>
                                <dd class="time"><?=__('至')?><%=v.activity_endtime %><?=__('前使用')?></dd>
                            </dl>
                            <a href="javascript:void(0);" shopsuite_type="getvoucher" class="btn"
                               data-tid="<%=v.activity_id%>"><%= v.if_gain ? "<?=__('领取')?>" : "<?=__('已经领取')?>"%></a>
                        </li>
                        <% } %>
                        <% }else{ %>
                        <div class="sstouch-norecord voucher"
                             style="position: relative; margin: 3rem auto; top: auto; left: auto; text-align: center;">
                            <div class="norecord-ico"><i></i></div>
                            <dl style="margin: 1rem 0 0;">
                                <dt style="color: #333;"><?=__('暂无优惠券可以领取')?></dt>
                                <dd><?=__('店铺优惠券可享受商品折扣')?></dd>
                            </dl>
                        </div>
                        <% } %>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>


<script type="text/javascript" src="../js/tmpl/store.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>