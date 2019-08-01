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
<meta name="apple-mobile-web-app-status-bar-style"
 content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title><?=__('签到领积分')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<style type="text/css">
.s-dialog-wrapper { width: 12rem; height: 14.5rem; top: 50%; left: 50%; margin-top: -7.25rem; margin-left: -6rem; }
.s-dialog-content h4 { font-size: 0.7rem; line-height: 1rem; }
.s-dialog-content ul { margin-top: 0.5rem; }
.s-dialog-content li { font-size: 0.55rem; line-height: 0.8rem; margin-bottom: 0.2rem; text-align: left; }
.s-dialog-btn-wapper a { width: 100%; }
</style>
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
    <div class="header-title"><h1><?=__('签到领积分')?></h1></div>
    <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a></div>
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
<div class="member-top">
  <div class="my-pointnum"> <?=__('我的积分')?><span id="pointnum"></span> </div>
  <div class="sign-box" id="signdiv" >
    <div id="signinbtn" class="sign-btn" style="display:none;">
      <h2><?=__('签到')?></h2>
      <h6>+<span id="points_signin">5</span> <?=__('积分')?></h6>
    </div>
    <div id="completedbtn" class="sign-btn" style="display:none;">
      <h2><?=__('已签到')?></h2>
      <h6><?=__('坚持哦！')?></h6>
    </div>
  </div>
  <div id="description_link" class="signin-help"><?=__('活动说明')?><i>i</i></div>
  <div id="description_info" style="display: none;">
    <h4><?=__('活动说明')?></h4>
    <ul>
      <li>1、<?=__('每人每天最多签到一次，签到后有机会获得积分。')?></li>
      <li>2、<?=__('网站可根据活动举办的实际情况，在法律允许的范围内，对本活动规则变动或调整。')?></li>
      <li>3、<?=__('对不正当手段（包括但不限于作弊、扰乱系统、实施网络攻击等）参与活动的用户，网站有权禁止其参与活动，取消其获奖资格（如奖励已发放，网站有权追回）。')?></li>
      <li>4、<?=__('活动期间，如遭遇自然灾害、网络攻击或系统故障等不可抗拒因素导致活动暂停举办，网站无需承担赔偿责任或进行补偿。')?></li>
    </ul>
  </div>
</div>
<div class="signin-list">
  <h3><?=__('签到日志')?><a href="pointslog_list.html"><?=__('查看我的积分')?></a></h3>
  <ul id="loglist" class="sstouch-default-list">
  </ul>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="loglist_tpl">
    <% if(items.length >0){%>
    <% for (var k in items) { var v = items[k]; %>
    <% if(v.points_type_id ==2){%>
    <li class="signin-c">
       <?=__('会员积分')?><em>+<%=v.points_log_points %></em><span><%=v.points_log_time %><?=__('日签到获得')?></span>
    </li>
    <%}%>
    <%}%>
    <li class="loading hide"><div class="spinner"><i></i></div><?=__('数据读取中')?></li>
    <% }else { %>
    <div class="sstouch-norecord signin" style="top: 70%;">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您还没有任何签到记录')?></dt>
			<dd><?=__('每日签到可获得会员积分奖励')?></dd>
        </dl>
    </div>
    <% } %>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>


<script>
    ifLogin()

    function showSignin(){
        //检验是否能签到
        $.getJSON(SYS.URL.user.signState, {}, function(result){
            var data = result.data;
            if(data.state == 200){
//                $("#points_signin").html(result.datas.points_signin);
                $("#signinbtn").show();
                $("#completedbtn").hide();
            }else{
                if (result.state == 'isclose') {//如果关闭了签到功能，则不显示签到按钮
                    location.href = WapSiteUrl;
                }else{//如果已经签到完成，则显示已签到
                    $("#signinbtn").hide();
                    $("#completedbtn").show();
                }
            }
        });
    }
    //加载签到日志
    var load_class = new ssScrollLoad();
    function getSigninLog(){
        load_class.loadInit({
            'url':SYS.URL.user.points,
            'getparam':{},
            'tmplid':'loglist_tpl',
            'containerobj':$("#loglist"),
            'iIntervalId':true
        });
    }

    $(function(){
        showSignin();
        //获取会员积分
        $.getJSON(SYS.URL.pay.asset, {'fields':'point'}, function(result){
            $("#pointnum").html(result.data.user_points);
        });
        getSigninLog();
        $("#signinbtn").click(function(){
            if ($("#signinbtn").hasClass('loading')) {
                return false;
            }
            $("#signinbtn").addClass('loading');
            //获取详情
            $.getJSON(SYS.URL.user.signIn, {points_type_id:2,points_log_points:15,points_log_desc:'<?=__('会员登录')?>'}, function(result){

                if(result.status == 200){
                    $("#pointnum").html(result.data.resource.user_points);
                    $("#completedbtn").show();
                    $("#signinbtn").hide();
                    getSigninLog();
                }
                $("#signinbtn").removeClass('loading');
            });
        });
        $("#description_link").click(function(){
            var con = $("#description_info").html();
            $.sDialog({
                content: con,
                "width": 100,
                "height": 100,
                "cancelBtn": false,
                "lock": true
            });
        });
        //加载专题页
        /*$('#special_div').load('../../special.html',function(){
            loadSpecial(1);
        });*/
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
