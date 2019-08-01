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
<title><?=__('发货')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<style type="text/css">
.ncsc-default-table {
	line-height: 20px;
	width: 100%;
	border-collapse: collapse;
	clear: both;
	font-size: 0.65rem
}
.ncsc-default-table thead th {
	line-height: 20px;
	color: #999;
	background-color: #FFF;
	text-align: center;
	height: 20px;
	padding: 8px 0;
	border-bottom: solid 1px #DDD;
}
.ncsc-default-table thead td,  .ncsc-default-table tfoot th {
	background-color: #FFF;
	height: 22px;
	padding: 5px 0;
	border-bottom: solid 1px #E6E6E6;
}
.ncsc-default-table tfoot th {
	border-top: solid 1px #E6E6E6;
}
.ncsc-default-table thead td label, .ncsc-default-table tfoot th label {
	color: #555;
	display: inline;
	float: left;
	margin-right: 10px;
	cursor: pointer;
}
.ncsc-default-table tbody th {
	background-color: #FAFAFA;
	border: solid #E6E6E6;
	border-width: 1px 0;
	padding: 4px 0;
}
.ncsc-default-table tbody th span {
	display: inline-block;
	vertical-align: middle;
	margin-right: 30px;
}
.ncsc-default-table tbody th span.goods-name {
	text-overflow: ellipsis;
	white-space: nowrap;
	width: 240px;
	height: 20px;
	overflow: hidden;
}
.ncsc-default-table tbody td {
	color: #999;
	background-color: #FFF;
	text-align: center;
	padding: 5px 0;
}
.ncsc-default-table tbody td strong {
	color: #666;
}
.ncsc-default-table input {
	border: 1px solid #e0dddd;
	outline: none;
	height: 28px;
	text-indent: 5px;
	-webkit-appearance: none;
	width: 72%;
	border-radius: 5px;
	background: #fff;
    float: left;
}
.sstouch-oredr-detail-block .message input {
	display: block;
	width: 91%;
	height: 0.9rem;
	padding: 2%;
	margin: 0 2.5%;
	background-color: #F0F0F0;
	border: none;
	border-radius: 0.2rem;
	line-height: 0.9rem;
	font-size: 0.6rem;
}
.sstouch-oredr-detail-add .icon_edit {
	width: 2rem;
	height: 1rem;
	display: inline-block;
	position: absolute;
	right: 0.65rem;
	top: 0.1rem;
	font-size: 0.58rem
}
.sstouch-oredr-detail-add .icon_edit i {
	width: 0.6rem;
	height: 0.6rem;
	display: inline-block;
	vertical-align: middle;
	background: url(../../images/edit_b.png) no-repeat center center;
	background-size: 100% 100%;
	top: -0.1rem;
	position: relative;
	opacity: 0.7;
}
.tabBox {
	margin: 0auto;
}
.tabBox .hd {
	height: 40px;
	line-height: 40px;
	font-size: 0.7rem;
	overflow: hidden;
	border-bottom: solid 0.05rem #EEE;
	padding: 0 10px;
}
.tabBox .hd h3 span {
	color: #ccc;
	font-family: Georgia;
	margin-left: 10px;
}
.tabBox .hd ul {
	float: left;
}
.tabBox .hd ul li {
	float: left;
	padding: 0 15px;
	vertical-align: top;
}
.tabBox .hd ul li a {
	color: #676b70;
}
.tabBox .hd ul li.on a {
	color: #e44d4d;
	display: block;
	height: 38px;
	line-height: 38px;
	border-bottom: 2px solid #e44d4d;
}
.tabBox .bd ul {
	padding: 10px;
}
.tabBox .bd ul li {
	border-bottom: 1px dotted #ddd;
}
.tabBox .bd li a {
	-webkit-tap-highlight-color: rgba(0,0,0,0);
}
</style>
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="store_orders_list.html?data-state=2010"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('发货')?></h1>
    </div>
  </div>
</header>
<div class="sstouch-main-layout mb20">
  <div class="sstouch-oredr-detail-block">
    <h3><b style="color:orange"><?=__('第一步')?></b> <?=__('选择出库单')?>
        <span class='inp-black' style="padding: 0.1rem 0.5rem">
            <select id="order_step1">
            </select>
        </span>
    </h3>

  </div>
  <div class="sstouch-oredr-detail-block ">
      <div id="stock_bill"  class="sstouch-order-item" style="border-bottom:0px;"></div>
  </div>
  <div class="sstouch-oredr-detail-block mt5">
    <h3><b style="color:orange"><?=__('第二步')?></b> <?=__('确认发货信息')?></h3>
  </div>
  <div class="sstouch-oredr-detail-block ">
    <div class="sstouch-oredr-detail-add">
      <dl id="address_list">

      </dl>
      <!--<div class="icon_edit" id="select_daddress"><a href="seller_address_list.html"><i></i>更换</a></div>-->
    </div>
  </div>

  <!-- 选择物流服务 -->
  <div class="sstouch-oredr-detail-block mt5">
    <h3><b style="color:orange"><?=__('第三步')?></b> <?=__('选择物流服务')?></h3>
  </div>
  <div class="sstouch-oredr-detail-block ">

    <!-- Tab切换（高度自适应示范） -->

    <div id="tabBox1" class="tabBox">
      <div class="hd">
        <ul>
          <li class="on"><a href="javascript:void(0)"><?=__('物流运输')?></a></li>
          <li class=""><a href="javascript:void(0)"><?=__('无需物流运输')?></a></li>
        </ul>
      </div>

        <div class="bd" id="tabBox1-bd"><!-- 添加id，js用到 -->

          <div class="con" id="shipping_list"><!-- 高度自适应需添加外层 -->
              <form id="logistic">

                  <input type="text" id="stock_bill_id" name="stock_bill_id" hidden type="text"/>
                  <input type="text"  id="order_id" name="order_id" hidden type="text"/>

                  <table class="ncsc-default-table order" id="texpress1">
                      <tbody>
                      <tr>
                          <td class="w250"><?=__('发货时间')?></td>
                          <td class="bdl"><input name="logistics_time" id="logistics_time" type="text" class="text w200 tip-r" maxlength="20" name="sc"  value="2016-01-11T16:00:00"/></td>
                      </tr>
                      <tr>
                          <td class="w250"><?=__('物流单号')?></td>
                          <td class="bdl"><input name="order_tracking_number" id="order_tracking_number" type="text" class="text w200 tip-r" maxlength="20" name="sc" /></td>
                      </tr>
                      <tr>
                          <td class="w250"><?=__('物流公司')?></td>
                          <td class="bdl">
                              <span class='inp-black' style="float: left;"><select name='logistics_id' id="logistics_id" class='text w200 tip-r'></select></span>
                          </td>
                      </tr>
                      <tr>
                          <td class="w250"><?=__('备注')?></td>
                          <td class="bdl"><input name="logistics_explain" id="logistics_explain" type="text" class="text w200 tip-r" maxlength="20" name="sc" /></td>
                      </tr>
                      <tr>
                          <td class="bdl" colspan="2"><a href="javascript:void(0);"  class=" btn-l send-order"><?=__('确认')?></a></td>
                      </tr>
                      </tbody>
                  </table>
              </form>
          </div>
          <div class="con"><!-- 高度自适应需添加外层 -->

            <table class="ncsc-default-table order" id="texpress2" style="">
              <tbody>
                <tr>
                  <td colspan="1"></td>
                </tr>
                <tr>
                  <td class="bdl tr"><?=__('如果订单中的商品无需物流运送，您可以直接点击确认')?></td>
                </tr>
                <tr>
                    <td class="bdr tl w400">&emsp;<a shopsuite_type="eb" shopsuite_value="e1000" href="javascript:void(0);" class="send-order btn-l"><?=__('无需物流')?></a></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>

</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="orderstep1">
      <option data-index="-1"><?=__('选择出库单')?></option>
    <% for(var i=0; i< stock_bill.length; i++ ) { %>
    <option data-index="<%= i %>" data-stock_bill_id="<%= stock_bill[i].stock_bill_id%>"
        <% if (stock_bill[i].logistics && stock_bill[i].logistics.order_logistics_id && stock_bill[i].logistics.logistics_enable == 0) { %>
      disabled> <%= stock_bill[i].stock_bill_id%> <?=__('已作废记录')?>
        <% } else if (stock_bill[i].logistics && stock_bill[i].logistics.logistics_enable == 1) { %>
      disabled> <%= stock_bill[i].stock_bill_id%> <?=__('已发货')?>
        <% } else {%>
      > <%= stock_bill[i].stock_bill_id%> <?=__('未发货')?>
        <% } %>
    </option>
    <% } %>
</script>
<script type="text/html" id="product_detail">
    <div class="sstouch-order-item-head">
        <a class="store"><i class="icon"></i><%=order_detail.order_id %></a>
        <span class="state"> <span class="ot-cancel"><%=$getLocalTime(order_detail.order_time) %>
        </span> </span>
    </div>
    <div class="sstouch-order-item-con">
        <%
        for (i in order_detail.items){%>
        <div class="goods-block detail"> <a href="#">
            <div class="goods-pic"> <img src="<%=order_detail.items[i].order_item_image %>"> </div>
            <dl class="goods-info">
                <dt class="goods-name"><%=order_detail.items[i].item_name %></dt>
                <dd class="goods-type"></dd>
            </dl>
            <div class="goods-subtotal">
                <span class="goods-price">￥<em><%=order_detail.items[i].order_item_unit_price %></em></span>
                <span class="goods-num">x<%=order_detail.items[i].order_item_quantity %></span>
            </div>
        </a> </div>
        <% } %>

    </div>
</script>
<script type="text/html" id="orderstep2">
<dt>
        <input type="hidden" id="shippingid" value="<%=daddress_row.ud_id%>">
        <?=__('发货人')?>：<span><%=daddress_row.seller_name%></span><span><%=daddress_row.telphone%></span></dt>
        <dd><?=__('发货地址')?>：<%=daddress_row.ud_address%>&nbsp;<%=daddress_row.district_info%></dd>
</script>
<script type="text/html" id="saddress_list">
    <div class="sstouch-oredr-detail-add">
        <i class="icon-add"></i>
        <dl>
            <dt><?=__('收货人')?>：<span><%=delivery.da_name %></span><span><%=delivery.da_mobile %></span></dt>
            <dd><?=__('收货地址')?>：<%=delivery.da_province %>/<%=delivery.da_city %>/<%=delivery.da_county %>&nbsp;<%=delivery.da_address %></dd>
        </dl>
        <!--<div class="icon_edit" id="shr_edit" order_id="<?php echo $output['order_info']['order_id']; ?>"><i></i><?=__('编辑')?></div>-->
    </div>
</script>

<script type="text/html" id="sshipping_list">
				 <table class="ncsc-default-table order" id="texpress1">
              <tbody>
				<tr>
                  <td class="bdl w150"><?=__('公司名称')?></td>
                  <td class="w250"><?=__('物流单号')?></td>
                  <td class="bdr w90 tc"><?=__('操作')?></td>
                </tr>
                <% var expresslist = datas.express_array; %>
      <% for (i in expresslist){%>
      <tr>
        <td class="bdl"><%=expresslist[i].e_name %></td>
        <td class="bdl"><input name="shipping_code" type="text" class="text w200 tip-r" maxlength="20" shopsuite_type='eb' shopsuite_value="<input type="text" name="sc" id="sc<%=expresslist[i].id%>" /></td>
        <td class="bdl bdr tc"><a href="javascript:void(0);" express_id="<%=expresslist[i].id%>" class="ncbtn btn send-order"><?=__('确认')?></a></td>
      </tr>
      <%}%>
	   </tbody>
            </table>
	  </script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/TouchSlide.1.1.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_send_order.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
