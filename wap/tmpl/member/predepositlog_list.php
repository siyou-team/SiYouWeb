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

<header id="header" class="app-no-fixed">

  <div class="header-wrap">

    <div class="header-l"><a href="member.html"><i class="zc zc-back back"></i></a></div>

    <div class="header-title">

      <h1><?=__('余额账户')?></h1>

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

<div class="sstouch-main-layout">

    <div id="pd_count" class="sstouch-asset-info">
        <div class="container pre">
            <i class="icon"></i>
            <dl>
                <dt><?=__('预存款余额')?></dt>
                <dd>￥<em id="user_money"> -- </em></dd>
            </dl>
        </div>
    </div>
  <div id="fixed_nav" class="sstouch-single-nav">

    <ul id="filtrate_ul" class="w33h">
        <li style="width: 20%;"><a href="recharge.html"><?=__('账户充值')?></a></li>
        <li class="selected" style="width: 20%;"><a href="javascript:void(0);"><?=__('账户余额')?></a></li>
        <li style="width: 20%;"><a href="pdrecharge_list.html"><?=__('充值明细')?></a></li>
        <li style="width: 20%;"><a href="pdcashlist.html"><?=__('提现列表')?></a></li>
        <li style="width: 20%;"><a href="pdcash_add.html"><?=__('余额提现')?></a></li>
    </ul>

  </div>

  <ul id="pointsloglist" class="sstouch-log-list">

  </ul>

</div>

<div class="fix-block-r">

    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>

</div>

<footer id="footer" class="bottom"></footer>

<script type="text/html" id="pd_count_model">

        <div class="container pre">

			<i class="icon"></i>

		    <dl>

				<dt><?=__('预存款余额')?></dt>

				<dd>￥<em id="user_money"><%=user_money;%></em></dd>

			</dl>

		</div>

    </script>

<script type="text/html" id="list_model">

        <% if(items.length >0){%>

        <% for (var k in items) { var v = items[k]; %>

            <li>

				<div class="detail"><%=v.record_title;%>  <% if(v.record_total >0){%> + <%=v.record_total;%><%}%></div>

                <% if(v.record_money >0){%>

                <div class="money add">+<%=v.record_money;%></div>

                <%}else{%>

                <div class="money reduce"><%=v.record_money;%></div>

                <%}%>

                <time class="date"><%=v.record_time;%></time>

            </li>

        <%}%>

        <li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>

        <%}else {%>

        <div class="sstouch-norecord pdre">

            <div class="norecord-ico"><i></i></div>

            <dl>

                <dt><?=__('您尚无预存款收支信息')?></dt>

				<dd><?=__('使用商城预存款结算更方便')?></dd>

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

        load_class.loadInit({

            'url': SYS.URL.pay.consume_record,

            'getparam':{},

            'tmplid':'list_model',

            'containerobj':$("#pointsloglist"),

            'iIntervalId':true

        });



        $.getJSON(SYS.URL.pay.asset, {'fields':'predepoit'}, function(result){

            $('#user_money').html(result.data.user_money);
            /*
             var html = template.render('pd_count_model', result.data);

             $("#pd_count").html(html);
             */

        });

    });

</script>

</body>

</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
