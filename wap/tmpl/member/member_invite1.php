<?phpinclude __DIR__ . '/../../includes/header.php';?><!DOCTYPE html><html lang="zh-CN" ><head>  <meta charset="UTF-8"/>  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>  <meta name="apple-mobile-web-app-capable" content="yes"/>  <meta name="apple-touch-fullscreen" content="yes"/>  <meta name="format-detection" content="telephone=no"/>  <meta name="apple-mobile-web-app-status-bar-style" content="black"/>  <meta name="format-detection" content="telephone=no"/>  <meta name="msapplication-tap-highlight" content="no"/>  <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1"/>  <title><?=__('我的分销')?></title>  <link rel="stylesheet" type="text/css" href="../../css/base.css"/>  <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css"/></head><body><header id="header" class="app-no-fixed" style="display: block">       <div class="header-wrap">          <div class="header-l">            <a href="plantform_invite.html"><i class="zc zc-back back"></i></a>          </div>          <span class="header-tab"><a href="member_invite.html"><?=__('邀请获取奖励')?></a><a href="javascript:void(0);" class="cur"><?=__('推广收入')?></a></span>          <div class="header-r">            <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>          </div>        </div>        <div class="sstouch-nav-layout">          <div class="sstouch-nav-menu">            <span class="arrow"></span>            <ul>                <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>                <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>                <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>                <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>                <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>            </ul>           </div>          </div></header>         <div class="sstouch-main-layout">          <div id="fixed_nav1" class="sstouch-single-nav">            <ul id="filtrate_ul" class="w33h">              <li class="l-1" style="width: 16.5%"><a href="member_invite1.html?level=1"><?=__('粉丝贡献')?></a></li>              <li class="l-11"  style="width: 16.5%"><a href="member_invite1.html?level=11"><?=__('区代理')?></a></li>              <li class="l-10"  style="width: 16.5%"><a href="member_invite1.html?level=10"><?=__('市代理')?></a></li>              <li class="l-6"  style="width: 16.5%"><a href="member_invite1.html?level=6"><?=__('销售奖')?></a></li>              <li class="l-21"  style="width: 16.5%"><a href="member_invite1.html?level=21"><?=__('区代理')?></a></li>              <li class="l-20"  style="width: 16.5%"><a href="member_invite1.html?level=20"><?=__('市代理')?></a></li>            </ul>          </div>          <ul id="pointsloglist" class="sstouch-log-list">            </ul>          </div><div class="fix-block-r">            <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>          </div><footer id="footer" class="bottom"></footer><script type="text/html" id="list_model">  <% if(items.length >0){%>    <% for (var k in items) { var v = items[k]; %>    <li>        <dl class="detail"><dt><?=__('会员')?>：<%=v.user_nickname;%></dt>            <dd><?=__('购买的订单数量')?>：<%=v.ugc_num;%></dd>        </dl>        <div class="money add"><%=v.ugc_amount;%></div>        <time class="date"><?=__('奖励')?></time>    </li>    <%}%>    <li class="loading">        <div class="spinner"><i></i></div>        <?=__('数据读取中')?>    </li>    <%}else {%>    <div class="sstouch-norecord pdre">        <div class="norecord-ico"><i></i></div>        <dl>            <dt><?=__('您还没有粉丝哦')?></dt>            <dd><?=__('点击下面链接去邀请好友吧')?></dd>            <a href="member_invite.html" class="btn"><?=__('我要去推广')?></a>        </dl>    </div>    <%}%></script><script type="text/javascript" src="../../js/config.js"></script><script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script><script type="text/javascript" src="../../js/tmpl/footer.js"></script><script>    $(function () {        if (!ifLogin()) {            return        }        //渲染list      var ugc_level = getQueryString('level')      if (!ugc_level)      {        ugc_level = 1;      }      var class_name = '.l-' + ugc_level;        $(class_name).addClass('selected');        var load_class = new ssScrollLoad();        load_class.loadInit({            'url': SYS.URL.fx.lists_commission,            'getparam': {ugc_level: ugc_level},            'tmplid': 'list_model',            'containerobj': $("#pointsloglist"),            'iIntervalId': true        });    });</script></body></html><?phpinclude __DIR__ . '/../../includes/footer.php';?>