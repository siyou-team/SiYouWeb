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
<title><?=__('订单管理')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">
    <style>
        .w20h li{width:33%}
        .footnav ul li p{
            color:white;
        }
        .footnav{
            background-color: #ae2323;
        }
        .sstouch-order-item-head{
            border-bottom:0;
        }
        .order_lists{
            display: flex;
            justify-content: space-between;
            font-size: .7rem;
            line-height: 2rem;
            white-space: nowrap;
        }
        .order_time{
            max-width: 50%;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .order_num{
            min-width: 15%;
        }
        .order_amount{
            min-width: 25%;
        }
        #filtrate_ul li a{
            display:inline-block !important;
            line-height: 1.9rem !important;
        }
        .sstouch-order-item-head .store{
            width:80% !important;
            overflow: hidden;
        }
    </style>
</head>
<body>
<header id="header" class="app-no-fixed">
 <div class="header-wrap">
    <div class="header-l"> <a href="seller.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('店内订单管理')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>
  </div>
  <div class="sstouch-nav-layout">
    <div class="sstouch-nav-menu"> <span class="arrow"></span>
		<ul>
			<li><a href="seller.html"><i class="zc zc-home home"></i><?=__('商家中心')?></a></li>
			<li><a href="seller_address_list.html"><i class="zc zc-peisongdizhi"></i><?=__('发货地址')?></a></li>
			<li><a href="seller_express.html"><i class="zc zc-wuliukuaidi"></i><?=__('物流公司')?></a></li>
			<li><a href="seller_account.html"><i class="zc zc-yonghushezhi1"></i><?=__('店铺设置')?><sup></sup></a></li>
			<li><a href="chat_list.html"><i class="zc zc-message message"></i>IM <<?=__('客服')?>sup></sup></a></li>
			<li id="logoutbtn"><a href="javascript:void(0);"><i class="zc zc-logout"></i><?=__('退出登录')?><sup></sup></a></li>
		</ul>
    </div>
  </div>
</header>
<div class="sstouch-main-layout">
  <div class="sstouch-order-search">
    <form>
      <span><input type="text" autocomplete="on" maxlength="50" placeholder="<?=__('日期查询')?>" name="order_key" id="order_key" oninput="writeClear($(this));" >
      <span class="input-del"></span></span>
      <input type="button" id="search_btn" value="&nbsp;">
    </form>
  </div>
  <div id="fixed_nav" class="sstouch-single-nav">
        <ul id="filtrate_ul" class="w20h">
            <li class="selected">
                <a href="javascript:void(0);" data-state="today"><?=__('今日')?></a>
            </li>
            <li style="border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <a href="javascript:void(0);" data-state="yesterday" ><?=__('昨日')?></a>
            </li>
            <li>
                <a href="javascript:void(0);" data-state="all"><?=__('所有日期')?></a>
            </li>
        </ul>
  </div>
  <div class="sstouch-order-list">
    <ul id="order-list">
    </ul>
  </div>
</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="order-list-tmpl">
	<%
		var orderlist = data.items;
        var StateCode = getStateCode();

	%>
		<li class="green-order-skin mt10">
			<%
			 for (j in orderlist){
				 var order_goods = orderlist[j].item;
			%>
				<div class="sstouch-order-item">
					<div class="sstouch-order-item-head">
					    <a class="store" href="../../tmpl/member/order_detail_store.html?order_id=<%=orderlist[j].order_id%>">
                            <img src="../../images/app_new/order.png" style="width:.9rem;height:.9rem;">
                            &nbsp;&nbsp;&nbsp;
                            <?=__('订单号')?>: <span style="color:red;"><%=orderlist[j].order_id%></span>
                        </a>
						<span class="state">
							<span class="<%=stateClass%>"><img src="../../images/app_new/point_left.png" alt="" style="width: .9rem;height: 1rem;"></span>
						</span>
					</div>
                    <div class="order_lists">
                        <% var count = 0;%>
                        <% for (k in order_goods){
                            count += parseInt(order_goods[k].order_item_quantity);
                        }%>
                        <div class="order_time">时间:<%=orderlist[j].order_time%></div>
                        <div class="order_num">产品总数:<%= count %></div>
                        <div class="order_amount">总金额:<%=orderlist[j].order_payment_amount%></div>
                    </div>

				</div>
			<%}%>

		</li>
	<% if (hasmore) {%>
	<li class="loading"><div class="spinner"><i></i></div><?=__('订单数据读取中')?>...</li>
	<% } %>

</script>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_order_list_chain.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
<script type="text/javascript" src="../../js/datePicker.js"></script>
<script>
    var calendar = new datePicker();
    calendar.init({
        'trigger': '#order_key', /*按钮选择器，用于触发弹出插件*/
        'type': 'date',/*模式：date日期；datetime日期时间；time时间；ym年月；*/
        'minDate':'1950-1-1',/*最小日期*/
        'maxDate':'2100-12-31',/*最大日期*/
        'onSubmit':function(){/*确认时触发事件*/
            var theSelectData=calendar.value;
        },
        'onClose':function(){/*取消时触发事件*/
        }
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
