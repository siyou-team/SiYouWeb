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
<title><?=__('充值卡余额')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="member.html"><i class="zc zc-back back"></i></a></div>
    <div class="header-tab"><a href="javascript:void(0);" class="cur"><?=__('充值卡余额')?></a> <a href="rechargecard_add.html"><?=__('充值卡充值')?></a></div>
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
<div class="sstouch-main-layout">
  <div id="rcb_count" class="sstouch-asset-info"></div>
  <ul id="rcbloglist" class="sstouch-log-list">
  </ul>
</div>
<div class="fix-block-r">
    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="rcb_count_model">
	<div class="container rcard">
			<i class="icon"></i>
		    <dl>
				<dt><?=__('充值卡余额')?></dt>
				<dd><?=__('￥')?><em><%=user_recharge_card;%></em></dd>
			</dl>
		</div>
</script>
<script type="text/html" id="list_model">
        <% if(items.length >0){%>
        <% for (var k in items) { var v = items[k]; %>
            <li><div class="detail"><%=v.card_history_remark;%></div>
                <time class="date"><%=v.card_history_time;%></time>
                <% if(v.user_recharge_card >0){%>
                <div class="money add">+<%=v.user_recharge_card;%></div>
                <%}else{%>
                <div class="money reduce"><%=v.user_recharge_card;%></div>
                <%}%>
            </li>
        <%}%>
        <li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>
        <%}else {%>
        <div class="sstouch-norecord recharge">
            <div class="norecord-ico"><i></i></div>
            <dl>
                <dt><?=__('您尚无充值卡使用信息')?></dt>
				<dd><?=__('使用充值卡充值余额结算更方便')?></dd>
            </dl>
        </div>
        <%}%>
    </script>
	<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script>
    $(function(){
        if (!ifLogin()){return}


        //渲染list
        var load_class = new ssScrollLoad();
        load_class.loadInit({'url':SYS.URL.pay.cardHistory,'getparam':{},'tmplid':'list_model','containerobj':$("#rcbloglist"),'iIntervalId':true});

        //获取预存款余额
        $.getJSON(SYS.URL.pay.asset, {'fields':'available_rc_balance'}, function(result){
            var html = template.render('rcb_count_model', result.data);
            $("#rcb_count").html(html);
        });
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
