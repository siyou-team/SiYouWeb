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
<title><?=__('确认订单')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('确认订单')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
      <ul>
        <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
        <li><a href="../../tmpl/search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
        <li><a href="../../tmpl/member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
        <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
      </ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout mb20">

  <!--<div class="sstouch-cart-block posr pb5">
    <h3><i class="mobile"></i>接收方式</h3>
    <div class="tip-con">虚拟订单兑换码将在付款后以短信形式发送至买家手机</div>
    <input type="tel" class="inp-tel" name="buyerPhone" id="buyerPhone" placeholder="请输入接收手机号码" autocomplete="off" maxlength="11"/>
  </div>-->
    <div class="sstouch-cart-block">
        <!--正在使用的默认地址Begin-->
        <div class="sstouch-cart-add-default"><a href="javascript:void(0);" id="list-address-valve"><i class="icon-add"></i>
            <dl>
                <dt><?=__('收货人')?>：
                    <span id="true_name"></span>
                    <span id="mob_phone"></span>
                </dt>
                <dd><span id="address"></span></dd>
            </dl>
            <i class="icon-arrow"></i></a></div>
        <!--正在使用的默认地址End-->
    </div>
    <!--选择收货地址Begin-->
    <div id="list-address-wrapper" class="sstouch-full-mask hide">
        <div class="sstouch-full-mask-bg"></div>
        <div class="sstouch-full-mask-block">
            <div class="header">
                <div class="header-wrap">
                    <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
                    <div class="header-title">
                        <h1><?=__('收货地址管理')?></h1>
                    </div>
                </div>
            </div>
            <div class="sstouch-main-layout" id="list-address-scroll">
                <ul class="sstouch-cart-add-list" id="list-address-add-list-ul">
                </ul>
                <div id="addresslist" class="mt10"> <a href="javascript:void(0);" class="btn-l" id="new-address-valve"><?=__('新增收货地址')?></a> </div>
            </div>
        </div>
    </div>
    <!--选择收货地址End-->
    <!--新增收货地址Begin-->
    <div id="new-address-wrapper" class="sstouch-full-mask hide">
        <div class="sstouch-full-mask-bg"></div>
        <div class="sstouch-full-mask-block">
            <div class="header">
                <div class="header-wrap">
                    <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
                    <div class="header-title">
                        <h1><?=__('新增收货地址')?></h1>
                    </div>
                </div>
            </div>
            <div class="sstouch-main-layout" id="new-address-scroll">
                <div class="sstouch-inp-con">
                    <form id="add_address_form">
                        <ul class="form-box">
                            <li class="form-item">
                                <h4><?=__('收货人姓名')?></h4>
                                <div class="input-box">
                                    <input type="text" class="inp" name="true_name" id="vtrue_name" autocomplete="off" oninput="writeClear($(this));"/>
                                    <span class="input-del"></span> </div>
                            </li>
                            <li class="form-item">
                                <h4><?=__('联系手机')?></h4>
                                <div class="input-box">
                                    <input type="tel" class="inp" name="mob_phone" id="vmob_phone" autocomplete="off" oninput="writeClear($(this));"/>
                                    <span class="input-del"></span> </div>
                            </li>
                            <li class="form-item">
                                <h4><?=__('地区选择')?></h4>
                                <div class="input-box">
                                    <input name="district_info" type="text" class="inp" id="vdistrict_info" autocomplete="off" onchange="btn_check($('form'));" readonly/>
                                </div>
                            </li>
                            <li class="form-item">
                                <h4><?=__('详细地址')?></h4>
                                <div class="input-box">
                                    <input type="text" class="inp" name="vaddress" id="vaddress" autocomplete="off" oninput="writeClear($(this));"/>
                                    <span class="input-del"></span> </div>
                            </li>
                        </ul>
                        <div class="error-tips"></div>
                        <div class="form-btn"><a href="javascript:void(0);" class="btn"><?=__('保存地址')?></a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--新增收货地址End-->
  <!--商品列表Begin-->
  <div id="goodslist_before" class="mt5">
    <div id="deposit"> </div>
  </div>
  <!--商品列表End-->

  <!--底部总金额固定层Begin-->
  <div class="sstouch-cart-bottom">
    <div class="total"><span id="online-total-wrapper"></span>
      <dl class="total-money">
        <dt><?=__('合计总金额：')?></dt>
        <dd>￥<em id="totalPrice"></em></dd>
      </dl>
    </div>
    <div class="check-out ok"><a href="javascript:void(0);" id="ToBuyStep2"><?=__('提交订单')?></a></div>
  </div>
  <!--底部总金额固定层End-->
  <div class="sstouch-bottom-mask">
    <div class="sstouch-bottom-mask-bg"></div>
    <div class="sstouch-bottom-mask-block">
      <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
      <div class="sstouch-bottom-mask-top">
        <p class="sstouch-cart-num"><?=__('本次交易需在线支付')?><em id="onlineTotal">0.00</em><?=__('元')?>元</p>
        <p style="display:none" id="isPayed"></p>
        <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a> </div>
      <div class="sstouch-inp-con sstouch-inp-cart">
        <ul class="form-box" id="internalPay">
          <p class="rpt_error_tip" style="display:none;color:red;"></p>
          <li class="form-item" id="wrapperUseRCBpay">
            <div class="input-box pl5">
              <label>
                <input type="checkbox" class="checkbox" id="useRCBpay" autocomplete="off" />
                <?=__('充值卡支付')?> <span class="power"><i></i></span> </label>
              <p> <?=__('可用余额')?>￥<em id="availableRcBalance"></em></p>
            </div>
          </li>
          <li class="form-item" id="wrapperUsePDpy">
            <div class="input-box pl5">
              <label>
                <input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
                  <?=__('预存款支付')?> <span class="power"><i></i></span> </label>
              <p>  <?=__('可用余额')?> ￥<em id="availablePredeposit"></em></p>
            </div>
          </li>

            <li class="form-item" id="wrapperUsePoints">
                <div class="input-box pl5">
                    <label>

                        <input type="checkbox" class="checkbox" id="usePoints" autocomplete="off" />
                        <?=__('积&nbsp;&nbsp;分&nbsp;&nbsp;')?>积&nbsp;&nbsp;分&nbsp;&nbsp; <?=__('支付')?><span class="power"><i></i></span>
                    </label>
                    <p> <?=__('可抵资金')?> ￥<em id="availablePointsMoney"></em>  <?=__('当前积分')?>  <em id="availablePoints"></em></p>
                </div>
            </li>


            <li class="form-item" id="wrapperUseCredit">
                <div class="input-box pl5">
                    <label>
                        <input type="checkbox" class="checkbox" id="useCredit" autocomplete="off" />
                         <?=__('信 用 支 付')?> <span class="power"><i></i></span>
                    </label>
                    <p> <?=__('可用信用余额')?> ￥<em id="availableCredit"></em></p>
                </div>
            </li>
          <li class="form-item" id="wrapperPaymentPassword" style="display:none">
            <div class="input-box"> <span class="txt"><?=__('输入支付密码')?></span>
              <input type="password" class="inp" id="paymentPassword" autocomplete="off" />
              <span class="input-del"></span> </div>
            <a href="../member/member_paypwd_step1.html" class="input-box-help" style="display:none"><i>i</i><?=__('尚未设置')?></a> </li>
        </ul>
        <div class="sstouch-pay">
          <div class="spacing-div"><span><?=__('在线支付方式')?></span></div>
          <div class="pay-sel">
            <label style="display:none">
              <input type="radio" name="payment_channel_code" class="checkbox" id="alipay" autocomplete="off" />
              <span class="alipay"><?=__('支付宝')?></span></label>
            <label style="display:none">
              <input type="radio" name="payment_channel_code" class="checkbox" id="wx_native" autocomplete="off" />
              <span class="wxpay"><?=__('微信')?></span></label>
          </div>
        </div>
        <div class="pay-btn"> <a href="javascript:void(0);" id="toPay" class="btn-l"><?=__('确认支付')?></a> </div>
      </div>
    </div>
  </div>
</div>
<script type="text/html" id="goods_list">
    <% var StateCode = getStateCode();%>
    <% for (var k in items) { %>
    <div class="sstouch-cart-container">
        <dl class="sstouch-cart-store store" data-store_id="<%=items[k].store_id%>">
            <dt><i class="icon-store"></i><%=items[k].store_name%><span data-store_id="<%=items[k].store_id%>" class="store-cod-supported" style="display:none;">（<?=__('该店铺不支持选定收货地址的货到付款）')?></span>
            </dt>
            <!-- start 店铺的活动商品 -->
            <% if(items[k].store_mansong_rule_list != null && items[k].store_mansong_rule_list.desc != null){ %>
            <dd class="store-activity">
                <em><?=__('满即送')?></em>
                <span><%=items[k].store_mansong_rule_list.desc.desc%><%if (items[k].store_mansong_rule_list.desc.url) {%>，<?=__('送')?><img src="<%=items[k].store_mansong_rule_list.desc.url%>"><%}%></span>
            </dd>
            <% } %>
            <!-- end 店铺的活动信息 -->
        </dl>
        <ul class="sstouch-cart-item">
            <li class="buy-item">
                <!-- start 店铺活动 -->

                <!-- 店铺礼品 start -->
                <% if (items[k].activitys.gift) { %>
                <%for(var n in items[k].activitys.gift){ var v1 = items[k].activitys.gift[n]; %>
                <div class="goods-gift">
                    <span><em><%= v1.actName%></em><%=v1.product_item_name%>&nbsp;&nbsp;x&nbsp;&nbsp;<%= v1.num%></span>
                </div>
                <% } %>
                <% } %>

                <!-- 满减 -->
                <% if (items[k].activitys.reduction) { %>
                <%for(var n in items[k].activitys.reduction){ var v1 = items[k].activitys.reduction[n];%>
                <div class="goods-gift">
                    <span><em><?=__('满减')?></em><%= v1.actName %>&nbsp;&nbsp;-<%= v1.reduceMoneySingle %><?=__('元')?>&nbsp;&nbsp;x&nbsp;&nbsp;<%= v1.times%></span>
                </div>
                <% } %>
                <% } %>

                <!-- 优惠券活动 -->
                <% if (items[k].activitys.coupons) { %>
                <%for(var n in items[k].activitys.coupons){ var v1 = items[k].activitys.coupons[n];%>
                <div class="goods-gift">
                    <span><em><%= v1.actName%></em><%=v1.coupon_type_name%>&nbsp;&nbsp;x&nbsp;&nbsp;<%= v1.coupon_num%></span>
                </div>
                <% } %>
                <% } %>

                <!-- 店铺邮费优惠 -->
                <% if (items[k].activitys.coupons) { %>
                <%for(var n in items[k].activitys.coupons){ var v1 = items[k].activitys.coupons[n];%>
                <div class="goods-gift">
                    <span><em><?=__('免邮费')?></em><%= v1.actName%></span>
                </div>
                <% } %>
                <% } %>

                <!-- end 店铺活动 -->
            </li>
            <% for (var l in items[k].items) { var v1 = items[k].items[l]%>
            <% if(v1.is_on_sale) { %>
            <li class="buy-item">
                <div class="goods-pic">
                    <a href="../../tmpl/product_detail.html?item_id=<%=v1.item_id%>">
                        <img src="<%=v1.product_image%>"/>
                    </a>
                </div>
                <dl class="goods-info">
                    <dt class="goods-name"><a href="../../tmpl/product_detail.html?item_id=<%=v1.item_id%>"><%=v1.product_item_name%></a></dt>
                    <dd class="goods-type"><%=v1.item_name%></dd>
                </dl>
                <div class="goods-subtotal">
                    <span class="goods-sale">
                        <% if (v1.show_typename != ''){ %>
                            <em><%=v1.show_typename%></em>
                        <% } %>

                        <% if (v1.show_type === 'bigtap'){ %>
                            <em><?=__('开放购买活动商品')?></em>
                        <% } %>

                        <% if (v1.cart_type_id == getStateCode().CART_GET_TYPE_POINT){ %>
                            <em><?=__('积分兑换')?></em>
                        <% }else if (v1.cart_type_id == getStateCode().CART_GET_TYPE_GIFT){ %>
                            <em><?=__('赠品')?></em>
                        <% }else if (v1.cart_type_id == getStateCode().CART_GET_TYPE_BARGAIN){ %>
                            <em><i></i><?=__('活动促销')?></em>
                        <% } %>
                    </span>
                    <span class="goods-price">￥<em><%=v1.item_sale_price%></em></span>
                </div>
                <div class="goods-num">
                    x<em><%=v1.cart_quantity%></em>
                </div>

                <!-- start 商品的活动商品 -->
                <!-- 赠品 -->
                <% if (v1.pulse_gift_cart) { %>
                <%for(var m in v1.pulse_gift_cart){ var v2 = v1.pulse_gift_cart[m];%>
                <div class="goods-gift">
                    <span><em><%= v2.actName %></em><%=v2.product_item_name%>&nbsp;&nbsp;x&nbsp;&nbsp;<%= v2.num%></span>
                </div>
                <% } %>
                <% } %>

                <!-- 加价购 -->
                <% if (v1.pulse_gift_cart) { %>
                <%for(var m in v1.pulse_bargains_cart){ var v2 = v1.pulse_bargains_cart[m];%>
                <div class="goods-gift">
                    <span><em><%= v2.actName %></em><%= v2.product_item_name %>&nbsp;&nbsp;<%= v2.item_sale_price%>&nbsp;&nbsp;x&nbsp;&nbsp;<%= v2.num%></span>
                </div>
                <% } %>
                <% } %>

                <!-- 满减 -->
                <% if (v1.pulse_reduction) { %>
                <%for(var m in v1.pulse_reduction){ var v2 = v1.pulse_reduction[m];%>
                <div class="goods-gift">
                    <span><em><?=__('满减')?></em><%= v2.actName %>&nbsp;&nbsp;-<%= v2.reduceMoneySingle %><?=__('元')?>&nbsp;&nbsp;x&nbsp;&nbsp;<%= v2.times%></span>
                </div>
                <% } %>
                <% } %>

                <!-- end 商品的活动商品 -->
                <div class="notransport transportId<%=v1.transport_type_id%>" style="display:none;"><p><?=__('该商品不支持配送')?></p></div>
            </li>
            <% } %>
            <% } %>
        </ul>


        <div class="sstouch-cart-subtotal">
            <!-- start 店铺优惠券优惠 -->
            <% if (items[k].items[0].product_service_date_flag) { %>
            <dl>
                <dt><?=__('选择服务时间')?></dt>
                <dd>
                    <input type="text"  class="default-input" placeholder="<?=__('选择服务时间')?>" name="virtual_service_time" id="virtual_service_time"
                           data-msg-required="<?=__('服务时间不能为空')?>" required="required" />
                </dd>
            </dl>
            <% } %>
            <dl class="hide">
                <dt><?=__('店铺优惠券')?></dt>
                <dd><?=__('节省')?><em id="storeVoucher<%=items[k].store_id%>">0</em><?=__('元')?></dd>
                <input type="hidden" id="voucher_input<%=items[k].store_id%>" name="user_voucher_ids[]" value="0" />
            </dl>
            <!-- end 店铺优惠券优惠 -->
            <dl>
                <dt><?=__('物流配送')?></dt>
                <dd><?=__('配送费：')?><em id="storeFreight<%=items[k].store_id%>"><%=items[k].freight ? items[k].freight : 0 %></em><?=__('元')?></dd>
            </dl>
            <div class="message">
                <input type="text" placeholder="<?=__('店铺订单留言：')?>" id="storeMessage"  name="storeMessage">
            </div>
            <div class="store-total">
                <?=__('本店合计')?><span><em id="storeTotal<%=items[k].store_id%>" ><%=items[k].order_money_select_items.toFixed(2)%></em></span><?=__('元')?>
            </div>
        </div>
        <% } %>
</script>
<script type="text/html" id="list-address-add-list-script">
    <% for (var i=0; i<items.length; i++) { %>
    <li <% if (ud_id == items[i].ud_id) { %>class="selected"<% } %> data-param="{ud_id:'<%=items[i].ud_id%>',ud_name:'<%=items[i].ud_name%>',ud_mobile:'<%=items[i].ud_mobile%>',district_info:'<%=items[i].district_info%>',ud_address:'<%=items[i].ud_address%>',ud_province_id:'<%=items[i].ud_province_id%>',ud_city_id:'<%=items[i].ud_city_id%>'}"> <i></i>
    <dl>
        <dt><?=__('收货人：')?><span id=""><%=items[i].ud_name%></span><span id=""><%=items[i].ud_mobile%></span><% if (items[i].ud_is_default == 1) { %><sub><?=__('默认')?></sub><% } %></dt>
        <dd><span id=""><%=items[i].district_info %>&nbsp;&nbsp;<%=items[i].ud_address %></span></dd>
    </dl>
    </li>
    <% } %>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/order_payment_common.js"></script>
<script type="text/javascript" src="../../js/tmpl/vr_buy_step1.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
