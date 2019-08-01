<?php
include __DIR__ . '/../includes/header.php';
?>
<!doctype html>
<html>
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
    <meta name="author" content="ShopNC">
    <meta name="copyright" content="ShopNC Inc. All Rights Reserved">
    <title><?=__('门店详情')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_chain.css">
    <style type="text/css">
        .s-dialog-btn-wapper a {width: 98%;}
    </style>
</head>
<body>
<header id="header" class="fixed">
    <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('门店详情')?></h1>
        </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
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
<div class="sstouch-main-layout" style="overflow:hidden">
    <div class="sstouch-home-block">
        <div class="item-pic" id="chain_banner"><a><img src=""></a></div>
    </div>
    <div style="background: rgb(255, 255, 255);" class="chain_info">
    </div>
    <div style="background: rgb(255, 255, 255);" id="show_voucher">
        <div class="animation-up detail-item" style="border-top-width: 0.05rem; border-top-style: solid; border-top-color: rgb(238, 238, 238);">
            <div>
                <div class="item-name"><?=__('领券')?></div>
                <div class="item-con">
                    <dl>
                        <dt>
                            <ul class="detail-coupon">
                            </ul>
                        </dt>
                    </dl>
                </div>
                <a href="javascript:void(0);" class="item-more"></a> </div>
        </div>
    </div>
    <div style="background: rgb(255, 255, 255);">
        <div class="detail-item" style="border-top-width: 0.05rem; border-top-style: solid; border-top-color: rgb(238, 238, 238);" id="show_map">
            <div>
                <div class="item-name"><?=__('地图')?></div>
                <div class="item-con">
                    <dl>
                        <dt><i></i><?=__('查看地图')?></dt>
                    </dl>
                </div>
                <a href="javascript:void(0);" class="animation-left item-more"></a> </div>
        </div>
    </div>
    <div class="sstouch-main-layout mt5 mb20">
        <div id="product_list" class="list">
        </div>
    </div>
</div>
<div id="main-container" class="nctouch-bottom-mask">
    <div class="goods-detail-foot">
        <div class="nctouch-bottom-mask-bg"></div>
        <div class="nctouch-bottom-mask-block">
            <div class="nctouch-bottom-mask-top mask-coupons">
                <div class="nctouch-bottom-mask-close"><i class="closed"></i><?=__('优惠券')?></div>
            </div>
            <div class="coupons-options">
                <h4><?=__('可领优惠券')?></h4>
                <div class="coupons-content" id="voucher_list">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/html" id="chain_goods_tpl">
    <% var goods_list = items;%>
    <% if(items.length >0){%>
    <ul class="goods-secrch-list">
        <%for(var j=0;j<goods_list.length;j++){%>
        <li class="goods-item" goods_id="<%=goods_list[j].item_id%>">
          <span class="goods-pic">
            <a href="product_detail.html?item_id=<%=goods_list[j].item_id%>">
              <img src="<%=goods_list[j].product_image%>">
            </a>
          </span>
            <dl class="goods-info">
                <dt class="goods-name">
                    <a href="product_detail.html?item_id=<%=goods_list[j].item_id%>">
                        <h4><%=goods_list[j].product_name%></h4>
                        <h6><%=goods_list[j].item_name%></h6>
                    </a>
                </dt>
                <dd class="goods-sale"><span class="goods-price">￥<em><%=goods_list[j].chain_item_unit_price%></em> </span></dd>
                <dd class="goods-assist"><span class="goods-sold"><?=__('销量')?> <em><%=goods_list[j].chain_item_sale_num%></em> </span>
                    <div class="btn-share J-btn-share buy-now" data-valid_type="<%= goods_list[j].product_valid_type %>" data-kind_id="<%= goods_list[j].kind_id %>" data-storage="<%=goods_list[j].chain_item_quantity%>"><i><?=__('立即购买')?></i></div>
                </dd>
            </dl>
        </li>
        <% } %>
    </ul>
    <% }else{%>
    <div class="sstouch-norecord search" style="margin-top: 3.8rem; height: 5.2rem;">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('没有找到任何商品信息')?></dt>
        </dl>
    </div>
    <% } %>
</script>
<script type="text/html" id="chain_voucher_tpl">
    <% if(items.length >0){%>
    <ul style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
        <%for(i=0;i<items.length;i++){%>
        <li class="coupons-item" t_id="<%=items[i].activity_id%>">
            <a href="javascript:;" class="item">
                <div class="item-left"><span class="decorate"></span>
                    <div class="price"><b>¥</b><em><%=items[i].activity_rule.voucher_price%></em></div>
                    <div class="condition"><?=__('满')?><%=items[i].activity_rule.requirement.buy.subtotal%><?=__('元可用')?></div>
                </div>
                <div class="item-right">
                    <p class="coupons-name"><i><%=items[i].activity_rule.voucher_price%><?=__('元优惠券')?></i></p>
                    <div class="coupons-text"><span class="time"><?=__('有效期至')?><%=items[i].activity_rule.voucher_end_date%></span></div>
                    <div class="coupons-text"> <span class="goto-receive"><%=items[i].if_gain ? '<?=__('点')?><?=__('击领取')?>' : '<?=__('优惠券')?>'%></span></div>
                </div>
            </a>
        </li>
        <% } %>
    </ul>
    <% } %>
</script>

<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/chain.js"></script>
</body>
</html>
<script type="text/javascript">
    $.animationUp({
        valve: '.animation-up',
        wrapper: '#main-container',
        scroll: '',
        start: function () {
            $('.goods-detail-foot').addClass('block').removeClass('hide');
        },
        close: function () {
            $('.goods-detail-foot').removeClass('block').addClass('hide');
        }
    });
    $('#show_map').on('click', function(){
        window.location.href=WapSiteUrl+"/tmpl/chain_map.html?chain_id="+chain_id;
    });
</script>
<?php
include __DIR__ . '/../includes/footer.php';
?>