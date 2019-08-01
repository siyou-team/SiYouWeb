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
    <style>
        .sstouch-cart-chain-list { background: #FFF;}
        .sstouch-cart-chain-list li { position: relative; z-index: 1; display: block; border-bottom: solid #EEE 0.05rem;}
        .sstouch-cart-chain-list li i { position: absolute; z-index: 1; top: 0.8rem; left: 0.5rem; display: none; width: 0.7rem; height: 0.7rem; background-image: url(../../images/ok.png); background-repeat: no-repeat; background-position: 50% 50%; background-size: 100%;}
        .sstouch-cart-chain-list li.selected i { display: block;}
        .sstouch-cart-chain-list dl { margin: 0 0 0 0.5rem; padding: 0.5rem 0; color: #666;}
        .sstouch-cart-chain-list li.selected dl { margin-left: 1.8rem}
        .sstouch-cart-chain-list dt { display: block; height: 0.9rem; margin-bottom: 0.2rem; font-size: 0.6rem; line-height: 0.9rem;}
        .sstouch-cart-chain-list dt span { margin-right: 0.3rem; font-size: 0.7rem; color: #111;}
        .sstouch-cart-chain-list dt span:last-child { font-weight: 600;}
        .sstouch-cart-chain-list dt sub { display: inline-block; background-color: #DB4453; font-size: 0.45rem; line-height: 0.6rem; padding: 0 0.1rem; margin-left: 0.1rem; border-radius: 0.1rem; color: #FFF;}
        .sstouch-cart-chain-list dd { display: block; min-height: 0.7rem; max-height: 1.4rem; font-size: 0.55rem; line-height: 0.7rem;}




        .sstouch-receive-list label { position: relative; z-index: 1; height: 0.9rem; padding: 0.5rem 0; margin: 0 0.5rem; font-size: 0.6rem; line-height: 0.9rem;}
        .sstouch-receive-list label input[type="radio"] { display: none;}
        .sstouch-receive-list label i { position: relative; display: inline-block; width: 0.75rem; height: 0.75rem; margin-right: 0.2rem; background-color: #F5F5F5; border: 0.05rem solid #CCC; -webkit-border-radius: 50%; border-radius: 50%; vertical-align: middle;}
        .sstouch-receive-list label.checked i { border-color: #ED5564; background-color: #ED5564; }
        .sstouch-receive-list label.checked i:after { content: ''; position: absolute; left: 0.1rem; top: 0.175rem; width: 0.4rem; height: 0.2rem; border-left: 0.065rem solid #fff; border-bottom: 0.065rem solid #fff; -webkit-transform: rotate(-45deg); -ms-transform: rotate(-45deg); transform: rotate(-45deg); }

    </style>
</head>
<body>
<header id="header" class="app-no-fixed">
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
<div id="container-fcode" class="hide">
  <div class="fcode-bg">
    <div class="con">
      <h3><?=__('您正在购买“F码”商品')?></h3>
      <h5><?=__('请输入所知的F码序列号并提交验证')?><br/>
        <?=__('系统效验后可继续完成下单')?></h5>
      <input type="text" name="fcode" id="fcode" placeholder="" />
      <p class="fcode_error_tip" style="display:none;color:red;"></p>
      <a href="javascript:void(0);" class="submit"><?=__('提交验证')?></a> </div>
  </div>
</div>
<div class="sstouch-main-layout mb20">
  <div class="sstouch-cart-block">
    <!--正在使用的默认地址Begin-->
    <div class="sstouch-cart-add-default"><a href="javascript:void(0);" id="list-address-valve"><i class="icon-add"></i>
      <dl>
        <dt><?=__('收货人：')?>
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


    <div id="chain-address" class="sstouch-cart-block" style="display:none;">
        <div class="sstouch-cart-add-default"><a href="javascript:void(0);" id="list-chain-valve"><i class="icon-add"></i>
            <dl>
                <dd><span id="chain_address"><?=__('未选择门店')?></span></dd>
            </dl>
            <i class="icon-arrow"></i></a></div>
    </div>
    <!--门店地址Begin-->
    <div id="new-chain-wrapper" class="sstouch-full-mask hide">
        <div class="sstouch-full-mask-bg"></div>
        <div class="sstouch-full-mask-block">
            <div class="sstouch-main-layout">
                <div class="sstouch-inp-con">
                    <!--<ul class="form-box">
                        <li class="form-item">
                            <h4>地区选择</h4>
                            <div class="input-box">
                                <input name="area_info" type="text" class="inp" id="chain_area_info" autocomplete="off" readonly/>
                            </div>
                        </li>
                    </ul>-->
                    <div class="error-tips"></div>
                    <div id="chain-list-scroll" style="display: block; position: absolute; top: 2rem; right: 0; left: 0; bottom:2rem; overflow: hidden;">
                        <ul id="chain-list" class="sstouch-cart-chain-list">
                        </ul>
                    </div>
                    <div class="form-btn"><a href="javascript:void(0);" class="btn-l mt10" style="position: absolute;bottom:0.8rem;"><?=__('确定')?></a></div>
                </div>
            </div>
        </div>
    </div>
    <!--门店地址End-->

    <!--配送方式Begin-->
    <div class="sstouch-cart-block mt5 hide">
        <a href="javascript:void(0);" class="posr" id="receive-valve">
            <h3><i class="ps"></i><?=__('配送方式')?>：</h3>
            <div class="current-con sstouch-receive-list">
                <label class="checked"><i></i>
                    <input type="radio" name="chain" value="0">
                    <span chain="0"><?=__('快递到家')?></span>
                </label>
                <label id="receive-chain"><i></i>
                    <input type="radio" name="chain" value="1">
                    <span chain="1"><?=__('门店自提')?></span>
                </label>
            </div>
        </a>
    </div>
    <!--配送方式End-->


    <!--付款方式Begin-->
  <div class="sstouch-cart-block mt5"> <a href="javascript:void(0);" class="posr" id="select-payment-valve">
    <h3><i class="pay"></i><?=__('支付方式：')?></h3>
    <div class="current-con"><?=__('在线付款')?></div>
    <i class="icon-arrow"></i> </a> </div>
  <!--付款方式End-->

  <!--选择付款方式Begin-->
  <div id="select-payment-wrapper" class="sstouch-full-mask hide">
    <div class="sstouch-full-mask-bg"></div>
    <div class="sstouch-full-mask-block">
      <div class="header">
        <div class="header-wrap">
          <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
          <div class="header-title">
            <h1><?=__('选择支付方式')?></h1>
          </div>
        </div>
      </div>
      <div class="sstouch-main-layout">
        <div class="sstouch-sel-box">
          <h4 class="tit"><?=__('支付方式')?></h4>
          <div class="sel-con"> <a href="javascript:void(0);" class="sel" id="payment-online"><?=__('在线支付')?></a> <a href="javascript:void(0);" style="display:none;" id="payment-offline"><?=__('货到付款')?></a></div>
        </div>
      </div>
    </div>
  </div>
  <!--选择付款方式End-->

  <!--发票信息Begin-->
  <div class="sstouch-cart-block mt5"> <a href="javascript:void(0);" class="posr" id="invoice-valve">
    <h3><i class="invoice"></i><?=__('发票信息')?>：</h3>
    <div class="current-con">
      <p id="invContent"><?=__('不需要发票')?></p>
    </div>
    <i class="icon-arrow"></i> </a> </div>
  <!--发票信息End-->

  <!--管理发票信息Begin-->
  <div id="invoice-wrapper" class="sstouch-full-mask hide">
    <div class="sstouch-full-mask-bg"></div>
    <div class="sstouch-full-mask-block">
      <div class="header">
        <div class="header-wrap">
          <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
          <div class="header-title">
            <h1><?=__('管理发票信息')?></h1>
          </div>
        </div>
      </div>
      <div class="sstouch-main-layout">
        <div class="sstouch-sel-box">
          <h4 class="tit"><?=__('是否开据发票')?></h4>
          <div class="sel-con"> <a href="javascript:void(0);" class="sel" id="invoice-noneed"><?=__('不需要发票')?></a> <a href="javascript:void(0);" id="invoice-need"><?=__('需要并填写发票信息')?></a></div>
        </div>
        <div id="invoice-div" class="">
          <ul id="invoice-list" class="sstouch-sel-list">
          </ul>
          <div class="sstouch-inp-con" id="invoice_add" style="display:none">
            <ul class="form-box">
              <li class="form-item">
                <h4><?=__('发票类型')?></h4>
                <div class="input-box btn-style">
                  <label class="checked">
                    <input type="radio" checked="checked" name="invoice_type" value="person" id="person" >
                    <?=__('个人')?> </label>
                  <label>
                    <input type="radio" name="invoice_type" value="company" id="company">
                    <?=__('单位')?> </label>
                </div>
              </li>
              <li class="form-item" id="inv-title-li" style="display:none;">
                <h4><?=__('发票抬头')?></h4>
                <div class="input-box">
                  <input type="text" class="inp" name="invoice_title" placeholder="<?=__('输入个人或企业名称')?>">
                  <span class="input-del"></span> </div>
              </li>
              <li class="form-item">
                <h4><?=__('发票内容')?></h4>
                <div class="input-box">
                  <select id="inc_content" name="invoice_content" class="select">
                  </select>
                  <i class="arrow-down"></i> </div>
              </li>
            </ul>
          </div>
          <a href="javascript:void(0);" class="btn-l mt10"><?=__('确定')?></a> </div>
      </div>
    </div>
  </div>
  <!--管理发票信息End-->

    <!-- start 店铺优惠券列表 -->
    <div class="sstouch-cart-block mt5" id="useVoucher" >
        <a href="javascript:void(0);" class="posr" id="voucher-valve">
            <h3><i class="voucher"></i><?=__('使用优惠券')?></h3>
            <div class="current-con">
                <p>&nbsp;</p>
                <input type="hidden" name="voucher_id[]" value="0" />
            </div>
            <i class="icon-arrow"></i>
        </a>
    </div>
    <!-- start 店铺优惠券列表 -->

    <!-- start 选择优惠券 -->
    <div id="list-voucher-wrapper" class="sstouch-full-mask hide">
        <div class="sstouch-full-mask-bg"></div>
        <div class="sstouch-full-mask-block">
            <div class="header">
                <div class="header-wrap">
                    <div class="header-l"> <a href="javascript:void(0);"> <i class="zc zc-back back"></i> </a> </div>
                    <div class="header-title">
                        <h1><?=__('优惠券列表')?></h1>
                    </div>
                </div>
            </div>
            <div class="sstouch-main-layout" id="list-voucher-scroll">
                <div id="list-voucher-list-ul"></div>
                <div class="mt10"> <a href="javascript:void(0);" class="btn-l" id="voucher-back"><?=__('返回')?></a> </div>
            </div>
        </div>
    </div>
    <!-- end 选择优惠券 -->

  <!--商品列表Begin-->
  <div id="goodslist_before" class="mt5">
    <div id="deposit"> </div>
  </div>
  <!--商品列表End-->

  <!--红包使用Begin-->
  <div id="rptVessel" class="sstouch-cart-block mt5">
    <div class="input-box">
      <label>
        <input type="checkbox" class="checkbox" id="useRPT"/>
        <?=__('平台红包')?> <span class="power"><i></i></span> </label>
      <p id="rptInfo"></p>
    </div>
  </div>
  <!--红包使用End-->

  <!--底部总金额固定层Begin-->
  <div class="sstouch-cart-bottom">
    <div class="total"><span id="online-total-wrapper"></span>
      <dl class="total-money">
        <dt><?=__('合计总金额')?>：</dt>
        <dd><span class="price_box" style="display: none;">￥<em id="totalPrice"></em></span>  <span class="point_box" style="display: none;"> + <em id="totalPointsPrice"></em><?=__('积分')?></span> </dd>
      </dl>
    </div>
    <div class="check-out"><a href="javascript:void(0);" id="ToBuyStep2"><?=__('提交订单')?></a></div>
  </div>
  <!--底部总金额固定层End-->
  <div class="sstouch-bottom-mask">
    <div class="sstouch-bottom-mask-bg"></div>
    <div class="sstouch-bottom-mask-block">
      <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
      <div class="sstouch-bottom-mask-top">
        <p class="sstouch-cart-num"><?=__('本次交易需在线支付')?><em id="onlineTotal">0.00</em><?=__('元')?></p>
        <p style="display:none" id="isPayed"></p>
        <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a>
      </div>
      <div class="sstouch-inp-con sstouch-inp-cart">
        <ul class="form-box" id="internalPay">
          <p class="rpt_error_tip" style="display:none;color:red;"></p>
          <li class="form-item" id="wrapperUseRCBpay">
            <div class="input-box pl5">
              <label>
                <input type="checkbox" class="checkbox" id="useRCBpay" autocomplete="off" />
                <?=__('充值卡支付')?> <span class="power"><i></i></span>
              </label>
              <p><?=__('可用充值卡余额')?> <?=__('￥')?><em id="availableRcBalance"></em></p>
            </div>
          </li>
          <li class="form-item" id="wrapperUsePDpy">
            <div class="input-box pl5">
              <label>
                <input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
                <?=__('预存款支付')?> <span class="power"><i></i></span>
              </label>
              <p><?=__('可用预存款余额')?> <?=__('￥')?><em id="availablePredeposit"></em></p>
            </div>
          </li>

            <li class="form-item" id="wrapperUsePoints">
                <div class="input-box pl5">
                    <label>

                        <input type="checkbox" class="checkbox" id="usePoints" autocomplete="off" />
                        <?=__('积&nbsp;&nbsp;分&nbsp;&nbsp;支付')?> <span class="power"><i></i></span>
                    </label>
                    <p><?=__('可抵资金')?> <?=__('￥')?><em id="availablePointsMoney"></em>   <?=__('当前积分')?><em id="availablePoints"></em></p>
                </div>
            </li>


            <li class="form-item" id="wrapperUseCredit">
                <div class="input-box pl5">
                    <label>
                        <input type="checkbox" class="checkbox" id="useCredit" autocomplete="off" />
                        <?=__('信 用 支 付')?> <span class="power"><i></i></span>
                    </label>
                    <p><?=__('可用信用余额')?> <?=__('￥')?><em id="availableCredit"></em></p>
                </div>
            </li>
          <li class="form-item" id="wrapperPaymentPassword" style="display:none">
            <div class="input-box"> <span class="txt"><?=__('输入支付密码')?></span>
              <input type="password" class="inp" name="paymentPassword" id="paymentPassword" autocomplete="off" />
              <span class="input-del"></span> </div>
            <a href="../member/member_paypwd_step1.html" class="input-box-help" style="display:none"><i>i</i><?=__('尚未设置')?></a>
          </li>
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
                    <span><em><?=__('满减')?></em><%= v1.actName %>&nbsp;&nbsp;-<%= v1.reduceMoneySingle %>元&nbsp;&nbsp;x&nbsp;&nbsp;<%= v1.times%></span>
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
                    <span class="goods-price"><% if(v1.item_sale_price) { %>￥<em><%=v1.item_sale_price%></em><% } %> <% if(v1.item_unit_points) { %><em>+ <%=v1.item_unit_points%></em><?=__('积分')?><% } %></span>
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
                    <span><em>满减</em><%= v2.actName %>&nbsp;&nbsp;-<%= v2.reduceMoneySingle %>元&nbsp;&nbsp;x&nbsp;&nbsp;<%= v2.times%></span>
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
            <dl class="hide">
                <dt><?=__('店铺优惠券')?></dt>
                <dd><?=__('节省')?><em id="storeVoucher<%=items[k].store_id%>">0</em><?=__('元')?></dd>
                <input type="hidden" id="voucher_input<%=items[k].store_id%>" name="user_voucher_ids[]" value="0" />
            </dl>
            <!-- end 店铺优惠券优惠 -->
            <dl>
                <dt><?=__('物流配送')?></dt>
                <dd><?=__('运费')?><em id="storeFreight<%=items[k].store_id%>"><%=items[k].freight ? items[k].freight : 0 %></em><?=__('元')?></dd>
            </dl>
            <div class="message">
                <input type="text" placeholder="<?=__('店铺订单留言')?>：" id="storeMessage<%=items[k].store_id%>"  name="storeMessage<%=items[k].store_id%>">
            </div>
            <div class="store-total">
                
            </div>
        </div>
    <% } %>
</script>
<script type="text/html" id="list-address-add-list-script">
<% for (var i=0; i<items.length; i++) { %>
<li <% if (ud_id == items[i].ud_id) { %>class="selected"<% } %> data-param="{ud_id:'<%=items[i].ud_id%>',ud_name:'<%=items[i].ud_name%>',ud_mobile:'<%=items[i].ud_mobile%>',district_info:'<%=items[i].district_info%>',ud_address:'<%=items[i].ud_address%>',ud_province_id:'<%=items[i].ud_province_id%>',ud_city_id:'<%=items[i].ud_city_id%>'}"> <i></i>
  <dl>
    <dt><?=__('收货人')?>：<span id=""><%=items[i].ud_name%></span><span id=""><%=items[i].ud_mobile%></span><% if (items[i].ud_is_default == 1) { %><sub><?=__('默认')?></sub><% } %></dt>
    <dd><span id=""><%=items[i].district_info %>&nbsp;&nbsp;<%=items[i].ud_address %></span></dd>
  </dl>
</li>
<% } %>
</script>
<!--门店价格：￥<span><%=chain_list[i].chain_item_unit_price %></span> ，-->
<script type="text/html" id="list-chain-script">
    <% for (var i=0; i<chain_list.length; i++) {  %>
    <li chain_id="<%=chain_list[i].chain_id%>" <% if (i==0) {%>class="selected"<% } %>> <i></i>
    <dl>
        <dt><?=__('门店名称')?>：<span><%=chain_list[i].chain_name%></span></dt>
        <dd><?=__('地址')?>：<span><%=chain_list[i].chain_address %></span></dd>
    </dl>
    </li>
    <% } %>
</script>
<script type="text/html" id="invoice-list-script">
<% if (items.length > 0) {%>
<% for (var i=0; i<items.length; i++) { %>
<label><i></i>
    <input type="radio" name="invoice" <% if (i==0) {%>checked="checked"<% } %> value="<%=items[i].user_invoice_id%>"/>
        <span id="inv_<%=items[i].user_invoice_id%>"><%=items[i].invoice_title%>&nbsp;&nbsp;<%=items[i].invoice_content%></span>
        <a class="del-invoice" href="javascript:void(0);" user_invoice_id="<%=items[i].user_invoice_id%>"></a>
</label>
<% } %>
<% } %>
<label id="invoiceNew"><i></i>
    <input type="radio" name="invoice" <% if (items.length == 0) { %>checked="checked"<% } %> value="0"/><span><?=__('新增发票内容')?></span>
</label>
</script>
<script type="text/html" id="voucher-list-script">
    <% if (items.length > 0) { %>
    <% for (var m=0; m<items.length; m++) { %>
        <dl class="sstouch-cart-store store">
            <dt><i class="icon-store"></i><%= items[m].store_name%>
            </dt>
        </dl>
        <ul class="sstouch-cart-add-list" data-store_id="<%= items[m].store_id %>">
            <li class="<%if(used_voucher[items[m].store_id] == 0){%> selected <%}%>" data-voucher_id="0"> <i></i>
                <dl>
                    <dt><?=__('不使用优惠券')?></dt>
                </dl>
            </li>
        <% if (voucher_items.length > 0) { %>
        <% for (var i=0; i<voucher_items.length; i++) { %>
            <li class="store-voucher-<%= voucher_items[i].store_id %>  <%if(used_voucher[items[m].store_id] == voucher_items[i].user_voucher_id){%> selected <%}%>" data-voucher_id="<%= voucher_items[i].user_voucher_id %>"> <i></i>
                <dl>
                    <dt><?=__('优惠券')?>：<?=__('满')?><span><%=voucher_items[i].voucher_subtotal%></span><?=__('减')?><span><%=voucher_items[i].voucher_price%></span></dt>
                    <dd><?=__('有效期至')?>：<%=voucher_items[i].voucher_end_date %></span></dd>
                </dl>
            </li>
        <% } %>
        <% } %>
        </ul>
    <% } %>
    <% } %>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/order_payment_common.js"></script>
<script type="text/javascript" src="../../js/tmpl/buy_step1.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
