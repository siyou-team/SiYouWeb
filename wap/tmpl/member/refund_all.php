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
<title><?=__('订单退款')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('订单退款')?></h1>
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
<div class="sstouch-main-layout mb20">
  <div class="sstouch-order-list" id="order-info-container"></div>
	<div class="special-tips">
	<p><?=__('特别提示：退款凭证选择直接拍照或从手机相册上传图片时，请注意图片尺寸控制在1M以内，超出请压缩裁剪后再选择上传！')?></p>
	</div>
  <form>
    <div class="sstouch-inp-con">
      <ul class="form-box">
      <li class="form-item">
          <h4><?=__('退款原因')?></h4>
          <div class="input-box">
            <input type="text" class="inp" value="<?=__('取消订单，全部退款')?>" readonly="readonly">
          </div>
        </li>
        <li class="form-item">
          <h4><?=__('退款金额')?></h4>
          <div class="input-box">
            <input id="allow_refund_amount" type="text" class="inp" value="" readonly="readonly">
          </div>
        </li>
        <li class="form-item">
          <h4><?=__('退款说明')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="buyer_message" placeholder="<?=__('申请原因！')?>">
          </div>
        </li>
        <li class="form-item upload-item">
          <h4><?=__('退款凭证')?></h4>
          <div class="input-box">
            <div class="sstouch-upload"> <a href="javascript:void(0);"> <span>
              <input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id="">
              </span>
              <p><i class="icon-upload"></i></p>
              </a>
              <input type="hidden" name="refund_pic[0]" value="" />
            </div>
            <div class="sstouch-upload"> <a href="javascript:void(0);"> <span>
              <input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id="">
              </span>
              <p><i class="icon-upload"></i></p>
              </a>
              <input type="hidden" name="refund_pic[1]" value="" />
            </div>
            <div class="sstouch-upload"> <a href="javascript:void(0);"> <span>
              <input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id="">
              </span>
              <p><i class="icon-upload"></i></p>
              </a>
              <input type="hidden" name="refund_pic[2]" value="" />
            </div>
          </div>
        </li>
      </ul>
      <div class="error-tips"></div>
      <div class="form-btn"><a href="javascript:;" class="btn-l"><?=__('提交')?></a></div>
    </div>
  </form>
</div>
<footer id="footer"></footer>
<script type="text/html" id="order-info-tmpl">
	<div class="sstouch-order-item mt5">
		<div class="sstouch-order-item-head">
			<a href="../../tmpl/store.html?store_id=<%=order.store_id%>" class="store"><i class="icon"></i><%=order.store_name%><i class="zc zc-arrow-r arrow-r"></i></a>
		</div>
		<div class="sstouch-order-item-con">
			<%for(i=0; i<goods_list.length; i++){%>
			<div class="goods-block detail">
				<a href="../../tmpl/product_detail.html?item_id=<%=goods_list[i].item_id%>">
				<div class="goods-pic">
					<img src="<%=goods_list[i].goods_img_360%>">
				</div>
				<dl class="goods-info">
					<dt class="goods-name"><%=goods_list[i].goods_name%></dt>
					<dd class="goods-type"><%=goods_list[i].goods_spec%></dd>
				</dl>
				<div class="goods-subtotal">
					<span class="goods-price">￥<em><%=goods_list[i].item_unit_price%></em></span>
					<span class="goods-num">x<%=goods_list[i].goods_num%></span>
				</div>
			</a>
			</div>
			<%}%>
			<% if (gift_list.length > 0){%>
				<div class="goods-gift">
				<%for(i=0; i<gift_list.length; i++){%>
					<span><em><?=__('赠品')?></em><%=gift_list[i].goods_name%> x <%=gift_list[i].goods_num%></span>
				<%}%>
				</div>
			<%}%>
		</div>
	</div>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/refund_all.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
