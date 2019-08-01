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
    <title><?=__('店铺首页')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_o2o.css">
    <style type="text/css">
        .zmt{color: #47b34f;}
    </style>
</head>
<body>
<div class="store-box stb">
    <div class="st-top clearfix">
        <div id="chain_info"></div>
    </div>
    <div class="coupon-box">
        <div id="show_voucher">
            <div class="store-new-coupon">
                <div class="store-new-txt">
                    <h2><?=__('店铺优惠券')?></h2>
                </div>
            </div>
            <div class="coupon-new">
                <div class="coupon-inner">
                    <ul class="coupon-ul">
                    </ul>
                </div>
            </div>
        </div>
        <div class="coupon-rated">
            <div class="store-new-txt">
                <h2><?=__('店铺信息')?></h2>
            </div>
            <ul class="z2 a2" id="chain_more_info"></ul>
        </div>
    </div>
    <div class="zh" id="going_shopping"><i class="yz zi"></i><span><?=__('点击继续购物')?></span></div>
</div>
<div class="tc-box tc" id="main_content">
    <div class="tc-search ts">
        <div class="w8"><span class="wg"><?=__('搜索店内商品')?></span></div>
    </div>
    <div class="tc-list clearfix">
        <ul class="classify-tc" id="goods_class_list">
        </ul>
        <div class="tt0 tt1 curr_class">
            <div class="tt-title"><?=__('全部分类(0)')?></div>
        </div>
        <div class="tc-con-list tt">
            <div class="tt-list tl">
                <div class="zz qk" id="goods_list">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sc-box">
    <div class="sc-box-line"></div>
    <a cart_goods_show="1" onclick="show_cart(1)" href="javascript:void(0);" class="sx1 show"></a>
    <div id="chain_cart_total" class="sx2">
        <div class="sx3"><?=__('购物车是空的')?></div>
    </div>
    <a id="chain_cart_buy" onclick="cart_buy()" class="sx4 dib" href="javascript:void(0);"><?=__('去结算')?></a>
    <div id="chain_cart_content" class="minicart-content" style="display: none;transform: translateY(-100%);">
        <a cart_goods_show="2" onclick="show_cart(0)" href="javascript:void(0);" class="sx1 incart-con light show"></a>
        <i class="a3m"></i>
        <div class="a3n"><span id="chain_cart_checked" onclick="show_cart_checked(0)" class="a4q a4r"><?=__('全选')?></span>
            <p id="chain_cart_selected" class="a4t"></p>
            <a onclick="chain_del_cart(0)" href="javascript:void(0);" class="a3o"><?=__('清空购物车')?></a></div>
        <div class="a3q" style="height: auto;">
            <div class="a41 single">
                <ul id="chain_cart_items" class="minicart-goods-list single">
                </ul>
            </div>
        </div>
        <div style="height:49px;"></div>
    </div>
    <div id="chain_cart_mask" onclick="show_cart(0)" class="a3f" style="display: none;"></div>
</div>

<div class="nav-r-box bothvisible" style="bottom: 117px;">
    <div class="nav-r">
        <a class="fl" href="../../dhome.html"><?=__('首页')?></a>
        <a class="yp" href="./category.html"><?=__('分类')?></a>
        <a class="yr" href="../member/order_list.html?chain=1"><?=__('订单')?></a>
        <a class="wd" href="../member/member.html"><?=__('我的')?></a>
        <i class="wds"></i>
    </div>
</div>
<div class="fix-block-box"><a id="goTop" class="fix-block-btn"  href="javascript:void(0);" style="bottom: 23px;"><i></i></a></div>
<script type="text/html" id="chain_goods_tpl">
    <% var items = data.items;%>
    <% if(items.length >0){%>
    <ul>
        <% for(i=0;i<items.length;i++){%>
        <% for(j=0;j<items[i].item_color.length;j++){%>
        <li>
            <a class="links-goods a2" href="goods_detail.html?item_id=<%=items[i].item_color[j].item_id%>&store_id=<%=items[i].store_id%>">
        <span class="tt-span">
          <img src="<%=items[i].item_color[j].color_image%>" class="pic">
        </span>
                <dl>
                    <dt><%=items[i].product_name%> <%=items[i].item_color[j].item_name%></dt>
                    <dd class="aan">
                        <strong class="line_pre"><?=__('已售')?><%=items[i].analytics_row.product_sale_num%><?=__('件')?></strong>
                    </dd>
                    <dd></dd>
                    <dd class="a1g">
                        <label><em>￥</em><%=items[i].item_color[j].item_sale_price%></label>
                    </dd>
                </dl>
            </a>
            <div class="Box check_number" chain_item_id="<%=items[i].item_color[j].item_id%>">
                <span onclick="del_cart('<%=items[i].item_color[j].item_id%>')" class="reduce hide"></span>
                <label goods_num_id="<%=items[i].item_color[j].item_id%>" goods_stock="<%=items[i].stock%>" class="hide">0</label>
                <span onclick="add_cart('<%=items[i].item_color[j].item_id%>')" class="add storeSearchCart"></span>
            </div>
        </li>
        <% } %>
        <% } %>
    </ul>
    <% }else{%>
    <div class="store-warp a2">
        <?=__('没有找到任何商品信息')?>
    </div>
    <% } %>
</script>
<script type="text/html" id="chain_cart_goods">
    <% for(i=0;i<items.length;i++){%>
    <li chain_item_id="<%=items[i].item_id%>" class="a43 <% if(items[i].stock>0) { %>single<% } else { %>inval<% } %> ">
        <span chain_goods_checked="<%=items[i].item_id%>" <% if(items[i].stock>0) { %>onclick="show_cart_checked(<%=items[i].item_id%>)"<% } %> class="a4q a44 <% if(items[i].goods_selected>0) { %>checked<%}%>"></span>
        <a class="a47" href="goods_detail.html?item_id=<%=items[i].item_id%>&store_id=<%=items[i].store_id%>">
            <table class="a48">
                <tbody>
                <tr>
                    <td style=" width:62px; ">
                        <img src="<%=items[i].goods_image_url%>" class="a49">
                        <% if(items[i].stock<1) { %><i class="a50"><?=__('无货')?></i><% } %>
                    </td>
                    <td><div class="a4c"><%=items[i].product_name%></div>
                        <div class="a4l">
                            <div class="a45">￥<%=items[i].chain_price%></div>
                        </div></td>
                </tr>
                </tbody>
            </table>
        </a>
        <% if(items[i].stock>0) { %>
        <a onclick="del_cart('<%=items[i].item_id%>')" class="a4a"></a>
        <em goods_num_id="<%=items[i].item_id%>" goods_stock="<%=items[i].stock%>" class="a4d"><%=items[i].goods_num%></em>
        <a onclick="add_cart('<%=items[i].item_id%>')" class="a4b"></a>
        <% } else { %>
        <a onclick="chain_del_cart('<%=items[i].item_id%>')" class="a4a"></a>
        <em class="a4d">0</em>
        <a class="a4b"></a>
        <% } %>
    </li>
    <% } %>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>


<script type="text/javascript" src="../js/tmpl/dhome/uptop.js"></script>
<script type="text/javascript" src="../js/tmpl/dhome/store.js"></script>
<script type="text/javascript" src="../js/tmpl/dhome/buy.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>