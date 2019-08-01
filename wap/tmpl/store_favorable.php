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
<title><?=__('付款金额')?></title>
<link rel="stylesheet" type="text/css" href="../css/base.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_cart.css">
<link rel="stylesheet" type="text/css" href="../css/sstouch_store.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1);"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('付款金额')?></h1>
    </div>
    <div class="header-r"> <a href="javascript:void(0);" id="header-nav"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
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
<div class="sstouch-main-layout fixed-Width">
  <div class="sstouch-main-layout" id="store_intro"> </div>

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
							<p><?=__('可用充值卡余额')?> ￥<em id="availableRcBalance"></em></p>
						</div>
					</li>
					<li class="form-item" id="wrapperUsePDpy">
						<div class="input-box pl5">
							<label>
								<input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
								<?=__('预存款支付')?> <span class="power"><i></i></span>
							</label>
							<p><?=__('可用预存款余额')?> ￥<em id="availablePredeposit"></em></p>
						</div>
					</li>

					<li class="form-item" id="wrapperUsePoints">
						<div class="input-box pl5">
							<label>

								<input type="checkbox" class="checkbox" id="usePoints" autocomplete="off" />
								<?=__('积&nbsp;&nbsp;分&nbsp;&nbsp;')?><?=__('支付')?> <span class="power"><i></i></span>
							</label>
							<p><?=__('可抵资金')?> ￥<em id="availablePointsMoney"></em>   <?=__('当前积分')?><em id="availablePoints"></em></p>
						</div>
					</li>


					<li class="form-item" id="wrapperUseCredit">
						<div class="input-box pl5">
							<label>
								<input type="checkbox" class="checkbox" id="useCredit" autocomplete="off" /> <?=__('信 用 支 付 ')?>
								<span class="power"><i></i></span>
							</label>
							<p><?=__('可用信用余额')?> ￥<em id="availableCredit"></em></p>
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
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
</body>
<script type="text/html" id="store_intro_tpl">
	<div class="sstouch-store-info">
		<div class="store-avatar"><img src="<%= base.store_logo %>" /></div>
		<dl class="store-base">
			<dt><%= base.store_name %></dt>
			<dd class="class"><% if(!store_is_selfsupport){%><?=__('类型')?>：<%= store_category_name %><% } %></dd>
			<dd class="type">
				<% if(base.store_is_selfsupport){%><?=__('平台自营')?><% }else{%><?=__('普通店铺')?><% } %>
			</dd>
		</dl>
	</div>


	<form>
	<div class="sstouch-inp-con" style="margin-top:0.5rem">
		<ul class="form-box">
			<li class="form-item">
				<h4><?=__('消费总额')?></h4>
				<div class="input-box">
					<input type="text" class="inp" name="amount" id="amount" autocomplete="off" oninput="writeClear($(this));" placeholder="<?=__('请输入金额')?>"/>
					<span class="input-del"></span> </div>
			</li>
			<li>
				<h4><?=__('实付金额')?></h4>
				<div class="input-box">
					<a href="tel:<%= info.store_tel %>" style="display: block;position: absolute;
    z-index: 1;top: .5rem;right: .5rem;opacity: .8"><span class="goods-price" style="color: #ff6700;font-size: .55rem;font-weight: 600"> <em id="real_amount">0.00</em> <?=__('元')?></span></a>
				</div>
			</li>
		</ul>
		<div class="error-tips"></div>
		<div class="form-btn ok"><a class="btn" href="javascript:;" id="save_btn"><?=__('确定')?></a></div>
	</div>
	</form>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/order_payment_common.js"></script>
<script type="text/javascript" src="../js/tmpl/store_favorable.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>