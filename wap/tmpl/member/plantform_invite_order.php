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
    <title><?=__('实物订单')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">
</head>
<body>
<header id="header" class="app-no-fixed">
    <div class="header-wrap">
        <div class="header-l"><a href="plantform_invite.html"><i class="zc zc-back back"></i></a></div>
        <div class="header-title">
            <h1><?=__('推广订单')?></h1>
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
<div class="sstouch-main-layout mt2rem">
    <div class="sstouch-order-search">
        <form>
      <span><input type="text" autocomplete="on" maxlength="50" placeholder="输入商品标题或订单号进行搜索" name="order_key" id="order_key" oninput="writeClear($(this));" >
      <span class="input-del"></span></span>
            <input type="button" id="search_btn" value="&nbsp;">
        </form>
    </div>
    <div id="fixed_nav" class="sstouch-single-nav hide">
        <ul id="filtrate_ul" class="w20h">
            <li class="selected"><a href="javascript:void(0);" data-state=""><?=__('全部')?></a></li>
            <li><a href="javascript:void(0);" data-state="2010"><?=__('待付款')?></a></li>
            <li><a href="javascript:void(0);" data-state="2016"><?=__('已付款')?></a></li>
            <li><a href="javascript:void(0);" data-state="2060"><?=__('已完成')?></a></li>
            <li><a href="javascript:void(0);" data-state="2070"><?=__('已取消')?></a></li>
            <!--待处理 已完成  已取消 -->
        </ul>
    </div>
    <div class="sstouch-order-list">
        <ul id="order-list">
        </ul>
    </div>
    <!--底部总金额固定层End-->
    <div class="sstouch-bottom-mask">
        <div class="sstouch-bottom-mask-bg"></div>
        <div class="sstouch-bottom-mask-block">
            <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
            <div class="sstouch-bottom-mask-top">
                <p class="sstouch-cart-num"><?=__('本次交易需在线支付')?><em id="onlineTotal">0.00
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
                            <p><?=__('可用充值卡余额')?> ￥<em id="availableRcBalance"></em></p>
                        </div>
                    </li>
                    <li class="form-item" id="wrapperUsePDpy">
                        <div class="input-box pl5">
                            <label>
                                <input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
                              <?=__('预存款支付')?>   <span class="power"><i></i></span> </label>
                            <p><?=__('可用预存款余额')?> ￥<em id="availablePredeposit"></em></p>
                        </div>
                    </li>

                    <li class="form-item" id="wrapperUsePoints">
                        <div class="input-box pl5">
                            <label>

                                <input type="checkbox" class="checkbox" id="usePoints" autocomplete="off" />
                                <?=__('积&nbsp;&nbsp;分&nbsp;&nbsp;支付')?> <span class="power"><i></i></span>
                            </label>
                            <p> <?=__('可抵资金')?>￥<em id="availablePointsMoney"></em>   <?=__('当前积分')?><em id="availablePoints"></em></p>
                        </div>
                    </li>


                    <li class="form-item" id="wrapperUseCredit">
                        <div class="input-box pl5">
                            <label>
                                <input type="checkbox" class="checkbox" id="useCredit" autocomplete="off" />
                                <?=__('信 用 支 付')?> <span class="power"><i></i></span>
                            </label>
                            <p><?=__('可用信用余额')?> ￥<em id="availableCredit"></em></p>
                        </div>
                    </li>
                    <li class="form-item" id="wrapperPaymentPassword" style="display:none">
                        <div class="input-box"> <span class="txt"><?=__('输入支付密码')?></span>
                            <input type="password" class="inp" id="paymentPassword" autocomplete="off" />
                            <span class="input-del"></span></div>
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
<div class="fix-block-r">
    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="order-list-tmpl">
    <% var order_list = data.items; %>
    <% if (order_list.length > 0){%>
    <% for(var i = 0;i<order_list.length;i++){
    var orderlist = order_list[i];
    orderlist.ownshop = 0;
    orderlist.zengpin = 0;
    var count = 0;
    var StateCode = getStateCode();
    %>
    <li class="<%if(order_list[i].order_pay_amount){%>green-order-skin<%}else{%>gray-order-skin<%}%> <%if(i>0){%>mt10<%}%>">

        <div class="sstouch-order-item">
            <div class="sstouch-order-item-head">
                <%if (orderlist.self_support){%>
                <a class="store"><i class="icon"></i><%=orderlist.store_name%></a>
                <%}else{%>
                <a href="../../tmpl/store.html?store_id=<%=orderlist.store_id%>" class="store"><i class="icon"></i><%=orderlist.store_name%> <i class="zc zc-arrow-r arrow-r"></i> </a>
                <%}%>
                <span class="state">
							<%
								var stateClass ="ot-finish";
								var orderstate = orderlist.order_state_id;
								if(orderstate == getStateCode().ORDER_STATE_FINISH){
									stateClass = stateClass;
								}else if(orderstate == getStateCode().ORDER_STATE_CANCEL) {
									stateClass = "ot-cancel";
								}else {
									stateClass = "ot-nofinish";
								}
							%>

							<span class="<%=stateClass%>"><%=orderlist.order_state_name%></span>
						</span>
                <span  class="state"><%=orderlist.order_id%>
                        &nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>

            <div class="sstouch-order-item-con">
                <% for(var j = 0;j<orderlist.item.length;j++){
                var order_goods = orderlist.item[j];
                count += order_goods.order_item_quantity;
                %>
                <div class="goods-block">
                    <a href="../../tmpl/member/order_detail.html?order_id=<%=orderlist.order_id%>">
                        <div class="goods-pic">
                            <img src="<%=order_goods.order_item_image%>"/>
                        </div>
                        <dl class="goods-info">
                            <dt class="goods-name"><%=order_goods.item_name%></dt>
                            <dd class="goods-type"><%=order_goods.activity_type_name%></dd>
                        </dl>
                        <div class="goods-subtotal">
                            <span class="goods-price"><?=__('￥')?><em><%=order_goods.order_item_unit_price%></em></span>
                            <span class="goods-num">x<%=order_goods.order_item_quantity%></span>
                        </div>
                    </a>
                </div>
                <%}%>
            </div>
            <%if (orderlist.zengpin){%>
            <div class="goods-gift">
							<span><em><?=__('赠品')?></em>
								<%for (k in orderlist[j].zengpin_list){%><%=orderlist[j].zengpin_list[k].goods_name%><%}%>
							</span>
            </div>
            <%}%>
            <%orderlist.if_evaluation_again = 1;%>
            <div class="sstouch-order-item-footer">
                <div class="store-totle">
                    <span>共<em><%=count%></em><?=__('件')?><?=__('商品，')?><?=__('合计')?></span><span class="sum">￥<em><%=orderlist.order_payment_amount%></em></span><span class="freight">(<?=__('含运费')?><?=__('￥')?><%=orderlist.order_shipping_fee%>)</span>
                </div>
                <div class="handle">
                    <!--<a href="javascript:void(0)" order_id="<%=orderlist.order_id%>" class="btn evaluation-again-order"><?=__('无用测试字段')?></a>-->
                    <%if(orderlist.order_state_id==getStateCode().ORDER_STATE_FINISH || orderlist.order_state_id==getStateCode().ORDER_STATE_CANCEL){%>
                    <a href="javascript:void(0)" order_id="<%=orderlist.order_id%>" class="del delete-order"><i></i><?=__('移除')?></a>
                    <%}%>

                    <%if(orderlist.order_lock_status){%>
                    <p><?=__('退款/退货中')?>...</p>
                    <%}%>

                    <%if(orderlist.if_buyer_cancel){%>
                    <a href="javascript:void(0)" order_id="<%=orderlist.order_id%>" class="btn cancel-order"><?=__('取消订单')?></a>
                    <%}%>
                    <%if(orderlist.if_logistics){%>
                    <a href="javascript:void(0)" order_id="<%=orderlist.order_id%>" class="btn viewdelivery-order"><?=__('查看物流')?></a>
                    <%}%>
                    <%if(orderlist.order_state_id == getStateCode().ORDER_STATE_SHIPPED){%>
                    <a href="javascript:void(0)" order_id="<%=orderlist.order_id%>" class="btn key sure-order"><?=__('确认收货')?></a>
                    <%}%>
                    <%if(orderlist.order_buyer_evaluation_status == 0 && orderlist.order_state_id == getStateCode().ORDER_STATE_FINISH){%>
                    <a href="javascript:void(0)" order_id="<%=orderlist.order_id%>" class="btn key evaluation-order"><?=__('评价订单')?></a>
                    <%}%>
                    <!--<%if(orderlist.order_buyer_evaluation_status && orderlist.if_evaluation_again){%>
                    <a href="javascript:void(0)" order_id="<%=orderlist.order_id%>" class="btn evaluation-again-order"><?=__('追加评价')?></a>
                    <%}%>-->
                </div>
            </div>
        </div>

        <%if(orderlist.order_is_paid != getStateCode().ORDER_PAID_STATE_YES && orderlist.order_state_id!=getStateCode().ORDER_STATE_CANCEL){%>
        <a href="javascript:void(0)" data-paySn="<%=orderlist.order_id%>" class="btn-l check-payment"><?=__('订单支付')?><em>（￥<%=orderlist.order_payment_amount%>）</em></a>
        <%}%>

    </li>
    <%}%>
    <% if (hasmore) {%>
    <li class="loading"><div class="spinner"><i></i></div><?=__('订单数据读取中')?>...</li>
    <% } %>
    <%}else {%>
    <div class="sstouch-norecord order">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您还没有相关的订单')?></dt>
            <dd><?=__('可以去看看哪些想要买的')?></dd>
        </dl>
        <a href="../../index.html" class="btn"><?=__('随便逛逛')?></a>
    </div>
    <%}%>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/order_payment_common.js"></script>
<script type="text/javascript" src="../../js/tmpl/plantform_invite_order.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
