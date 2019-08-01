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
<title><?=__('积分明细')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
    <div class="header-title">
      <h1><?=__('积分明细')?></h1>
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
<div class="sstouch-main-layout" style="margin-top: 2rem;">
    <div id="fixed_nav1" class="sstouch-single-nav hide">
        <ul id="filtrate_ul" class="w33h">
            <li style="width: 20%;" class="selected"><a href="./pointslog_list.html"><?=__('积分记录')?></a></li>
            <li style="width: 20%;" ><a href="points_transfer.html"><?=__('好友转让')?></a></li>
        </ul>
    </div>
  <div id="pointscount" class="sstouch-asset-info"></div>
  <ul id="pointsloglist" class="sstouch-log-list">
  </ul>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="pointscount_model">
	<div class="container point">
		<i class="icon"></i>
			<dl>
				<dt><?=__('我的积分')?></dt>
				<dd><em><%=user_points;%></em></dd>
			</dl>
	</div>
</script>
<script type="text/html" id="list_model">
        <% if(items.length >0){%>
        <% for (var k in items) { var v = items[k]; %>
            <li><dl class="detail"><dt><%=v.points_type_desc;%></dt>
                <dd><%=v.points_log_desc;%></dd>
				</dl>
                <% if(v.points_kind_id == 1){%>
                <div class="money add">+<%=v.points_log_points;%></div>
                <%}else{%>
                <div class="money reduce"><%=v.points_log_points;%></div>
                <%}%>
                <time class="date"><%=v.points_log_time;%></time>
            </li>
        <%}%>
        <li class="loading"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>
        <%
        }else {
        %>
       <div class="sstouch-norecord signin" style="top: 70%;">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您还没有任何积分记录')?></dt>
			<dd><?=__('每日签到或购买商品可获取积分')?></dd>
        </dl>
    	</div>
        <%
        }
        %>
    </script>
	<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script>
    $(function(){
        if (!ifLogin()){return}


        //渲染list
        var load_class = new ssScrollLoad();
        load_class.loadInit({'url':SYS.URL.user.points,'getparam':{},'tmplid':'list_model','containerobj':$("#pointsloglist"),'iIntervalId':true});

        //获取我的积分
        $.getJSON(SYS.URL.pay.asset, {'fields':'point'}, function(result){
            var html = template.render('pointscount_model', result.data);
            $("#pointscount").html(html);
        });
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
