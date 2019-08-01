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
<title><?=__('订单详情')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
</head>
<body>
<header id="header" class="appshow">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('订单详情')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
        <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
        <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
        <li><a href="../cart_list.html"><i class="zc zc-cart cart"></i><?=__('购物车')?><sup></sup></a></li>
        <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout mb20" id="order-info-container"> </div>
<footer id="footer"></footer>
<script type="text/html" id="order-info-tmpl">
    <% var StateCode = getStateCode();%>
    <div class="sstouch-oredr-detail-block">
        <h3><i class="orders"></i><?=__('交易状态')?>&nbsp;<div class="order-state">
            <%if (2 == cart_type_id){%>
            <?=__('积分换购')?>
            <%}%>
        </div></h3>
        <div class="order-state"><%=order_is_paid_name%> <%=order_state_name%></div>
    </div>
    <div class="sstouch-oredr-detail-block">
        <h3><i class="phone"></i><?=__('买家手机')?></h3>
        <span class="msg-phone"><%=delivery.da_mobile%></span>
        <% if(if_resend){ %>
        <a href="javascript:void(0);" id="resend" class="msg-again"><?=__('重新发送兑换码')?></a>
        <%}%>
    </div>
    <%if (order_tips != ''){%>
    <div class="sstouch-oredr-detail-block">
        <h3><i class="msg"></i><?=__('买家留言')?></h3>
        <div class="info"><%=order_tips%></div>
    </div>
    <%}%>
    <%if (chain_code){ %>
    <div class="sstouch-vr-order-codes">
        <div class="tit">
            <h3><i></i><?=__('虚拟兑换码')?></h3>
            <span><?=__('有效期至')?><%=virtual_service_time%></span>
        </div>
        <ul>
            <li class="<%=chain_code_status == 2?'lose':''%>"><em><%=chain_code_status == 2?'<?=__('失效')?>':'<?=__('有效')?>'%></em><%= chain_code %></li>
        </ul>
    </div>
    <% } %>
    <div class="sstouch-vr-order-location">
        <div class="tit">
            <h3><i class="msg"></i><?=__('商家信息')?></h3>
        </div>
        <div class="default" id="goods-detail-o2o">
        </div>
        <div class="more-location">
            <a href="javascript:void(0);" id="store_addr_list"><%= store_name%></a>
            <i class="zc zc-arrow-r arrow-r"></i>
        </div>
        <div class="default" id="goods-detail-o2o">
        </div>

    </div>
    <div class="sstouch-order-item mt5">
        <div class="sstouch-order-item-head">
            <a href="javascript:void(0);" class="store"><i class="icon"></i><?=__('订单商品')?></a>
        </div>
        <div class="sstouch-order-item-con">
            <%for(i=0; i<items.length; i++){%>
            <div class="goods-block detail">
                <a href="../../tmpl/product_detail.html?item_id=<%=items[i].item_id%>">
                    <div class="goods-pic">
                        <img src="<%=items[i].order_item_image%>">
                    </div>
                    <dl class="goods-info">
                        <dt class="goods-name"><%=items[i].item_name%></dt>
                        <dd class="goods-type"><%=items[i].spec_info%></dd>
                    </dl>
                    <div class="goods-subtotal">

                        <%if (2 == cart_type_id || items[i].order_item_points_fee){%>
                        <span class="goods-price"><em><%=items[i].order_item_points_fee/items[i].order_item_quantity%></em><?=__('积分')?></span>
                        <%} else {%>
                            <%if (items[i].order_item_unit_price){%>
                            <span class="goods-price">￥<em><%=items[i].order_item_unit_price%></em></span>
                            <%}%>

                            <%if (items[i].item_unit_points){%>
                            <span class="goods-price"><em><%=items[i].item_unit_points%></em><?=__('积分')?></span>
                            <%}%>
                        <%}%>

                        <span class="goods-num">x<%=items[i].order_item_quantity%></span>
                    </div>

                    <% if (items[i].if_return) {%>
                    <!--<a href="javascript:void(0)" order_id="<%=order_id%>" order_item_id="<%=items[i].order_item_id%>" class="goods-refund"><?=__('退款')?></a>-->
                    <a href="javascript:void(0)" order_id="<%=order_id%>" order_item_id="<%=items[i].order_item_id%>" class="goods-return"><?=__('退货')?></a>
                    <%}%>
                </a>
            </div>
            <%}%>
            <%
            zengpin_list = [];
            if (zengpin_list.length > 0){%>
            <div class="goods-gift">
                <%for(i=0; i<zengpin_list.length; i++){%>
                <span><em><?=__('赠品')?></em>%=zengpin_list[i].goods_name%> x <%=zengpin_list[i].goods_num%</span>
                <%}%>
            </div>
            <%}%>
            <div class="goods-subtotle">
                <%
                promotion= [];
                if (promotion.length > 0){%>
                <dl>
                    <dt><?=__('优惠')?></dt>
                    <dd><%for (var ii in promotion){%><span><%=promotion[ii][1]%></span><%}%></dd>
                </dl>
                <%}%>
                <dl>
                    <dt><?=__('配送费')?></dt>
                    <dd><?=__('￥')?><em><%=order_shipping_fee%></em></dd>
                </dl>
                <dl class="t">
                    <dt><?=__('实付款（含配送费）')?></dt>
                    <%if (2 == cart_type_id){%>
                    <dd><em><%=order_points_fee%></em>积分</dd>
                    <%} else {%>
                        <%if (order_payment_amount){%>
                        <dd>￥<em><%=order_payment_amount%></em></dd>
                        <%}%>
                        &nbsp;&nbsp;
                        <%if (order_resource_ext1){%>
                        <dd><em><%=order_resource_ext1%></em><?=__('积分')?></dd>
                        <%}%>
                    <%}%>
                </dl>
            </div>
            <div class="sstouch-order-item-bottom">
                <span>
                    <% if (im_chat) {%>
                    <a href="chat_html?t_id=<%=store_member_id%>"><i class="im"></i><?=__('联系客服')?></a>
                    <%}else{%>
                    <% if (chain_id) {%>
                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<%=chain_qq%>&site=qq&menu=yes"><i class="im"></i><?=__('联系客服')?></a>
                    <%} else { %>
                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<%=store_qq%>&site=qq&menu=yes"><i class="im"></i><?=__('联系客服')?></a>
                    <%}%>
                    <%}%>
                </span>
                <span><a href="tel:<%= chain_id ? chain_mobile : store_phone%>"><i class="tel"></i><?=__('拨打电话')?></a></span>
            </div>
        </div>
    </div>
    <div class="sstouch-oredr-detail-block mt5">
        <ul class="order-log">
            <li><?=__('订单编号')?>：<%=order_id%></li>
            <li><?=__('创建时间')?>：<%=order_time%></li>
            <% if(payment_time && order_is_paid == getStateCode().ORDER_PAID_STATE_YES){%>
            <li><?=__('付款时间')?>：<%=payment_time%></li>
            <%}%>
            <% if(shipping_time && order_is_shipped == getStateCode().ORDER_SHIPPED_STATE_YES){%>
            <li><?=__('发货时间')?>：<%=shipping_time%></li>
            <%}%>
            <% if(order_settlement_time && order_state_id == getStateCode().ORDER_STATE_FINISH){%>
            <li><?=__('完成时间')?>：<%=order_settlement_time%></li>
            <%}%>
        </ul>
    </div>

</script>

<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/vr_order_detail.js"></script>
<script type="text/html" id="list-address-script">
    <% for (var i=0;i<items.length;i++) {%>
    <li>
        <dl>
            <a href="javascript:void(0)" index_id="<%=i%>">
                <dt><%=items[i].chain_name%><span><i></i><?=__('查看地图')?></span></dt>
                <dd><%=items[i].chain_district_info%></dd>
            </a>
        </dl>
        <span class="tel"><a href="tel:<%=items[i].chain_mobile %>"></a></span>
    </li>
    <% } %>
</script>
<!--o2o分店地址Begin-->
<div id="list-address-wrapper" class="sstouch-full-mask hide">
  <div class="sstouch-full-mask-bg"></div>
  <div class="sstouch-full-mask-block">
    <div class="header">
      <div class="header-wrap">
        <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
          <h1><?=__('商家信息')?></h1>
        </div>
      </div>
    </div>
    <div class="sstouch-main-layout">
    	<div class="sstouch-o2o-tip"><a href="javascript:void(0);" id="map_all"><i></i><?=__('全部实体分店')?><?=__('共')?><em></em><?=__('家')?><span></span></a></div>
	    <div class="sstouch-main-layout-a" id="list-address-scroll">
	      <ul class="sstouch-o2o-list" id="list-address-ul">
	      </ul>
	    </div>
    </div>
  </div>
</div>
<!--o2o分店地址End-->
<!--o2o分店地图Begin-->
<div id="map-wrappers" class="sstouch-full-mask hide">
  <div class="sstouch-full-mask-bg"></div>
  <div class="sstouch-full-mask-block">
    <div class="header transparent-map">
      <div class="header-wrap">
        <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
      </div>
    </div>
    <div class="sstouch-map-layout">
		<div id="baidu_map" class="sstouch-map"></div>
	</div>
  </div>
</div>
<!--o2o分店地图End-->
<!--底部总金额固定层End-->
<div class="sstouch-bottom-mask">
  <div class="sstouch-bottom-mask-bg"></div>
  <div class="sstouch-bottom-mask-block">
    <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
    <div class="sstouch-bottom-mask-top"><a class="sstouch-bottom-mask-close" href="javascript:void(0);"><i></i></a>
    <div class="msg-again-layout">
    <h4><?=__('如果您没有收到虚拟商品兑换码或更改其它手机接收信息，请正确输入接收用手机号码并确认发送。')?></h4>
    <h5><?=__('系统最多可重新发送5次兑换码提示信息。')?></h5>
        <input type="tel" name="buyer_phone" class="inp-tel" id="buyer_phone" autocomplete="off" maxlength="11" />
        </div>
        <p class="rpt_error_tip"></p>
    </div><a href="javascript:void(0);" id="tosend" class="btn-l mt10"><?=__('确认发送')?></a>
  </div>
</div>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
