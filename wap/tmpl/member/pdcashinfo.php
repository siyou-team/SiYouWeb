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
<title><?=__('账户余额')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
    <div class="header-title">
      <h1><?=__('提现详情')?></h1>
    </div>
  </div>
</header>
<div class="sstouch-main-layout" id="pdcashinfo"> </div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="info_model">

    <%
    var state_name = ["<?=__('申请中')?>","<?=__('提现通过')?>"];
    %>

        <ul class="sstouch-default-list">
            <li><h4><?=__('申请单号')?></h4><span class="num"><%=withdraw_id %></span></li>
            <li><h4><?=__('提现金额')?></h4><span class="num"><%=withdraw_amount %></li>
            <li><h4><?=__('收款银行')?></h4><span class="num"><%=withdraw_bank %></li>
            <li><h4><?=__('收款账号')?></h4><span class="num"><%=withdraw_account_no %></li>
            <li><h4><?=__('开户人姓名')?></h4><span class="num"><%=withdraw_account_name %></li>
            <li><h4><?=__('联系手机')?></h4><span class="num"><%=withdraw_mobile %></li>
            <li><h4><?=__('账创建时间户余额')?></h4><span class="num"><%=withdraw_time %></li>
            <li><h4><?=__('提现状态')?></h4><span class="num"><%=state_name[withdraw_state] %></span></li>
            <% if(withdraw_state == 1){%>
			<li><h4><?=__('通过时间')?></h4><span class="num"><%=withdraw_opertime %></span></li>
			<%}%>
        </ul>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script>
    $(function(){
        if (!ifLogin()){return}


        //获取详情
        $.getJSON(SYS.URL.pay.consume_withdraw_info, {'withdraw_id':getQueryString('withdraw_id')}, function(result){
            var html = template.render('info_model', result.data);
            $("#pdcashinfo").html(html);
        });
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
