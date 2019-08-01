<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1"/>
    <title><?=__('好友转让积分')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="app-no-fixed">
    <div class="header-wrap">
        <div class="header-l"><a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a></div>
        <div class="header-title">
            <h1><?=__('好友转让积分')?></h1>
        </div>
        <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i
                class="zc zc-more more"></i><sup></sup></a></div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"><span class="arrow"></span>
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
    <div id="fixed_nav1" class="sstouch-single-nav">
        <ul id="filtrate_ul" class="w33h">
            <li style="width: 20%;"><a href="./pointslog_list.html"><?=__('积分记录')?></a></li>
            <li style="width: 20%;" class="selected"><a href="points_transfer.html"><?=__('好友转让')?></a></li>
        </ul>
    </div>

    <div id="pointscount" class="sstouch-asset-info"></div>
    <div class="sstouch-inp-con">
        <form action="" method ="">
            <ul class="form-box">
                <li class="form-item">
                    <h4><?=__('可转积分')?></h4>
                    <div class="input-box">
                        <input type="text" id="user_points" name="user_points" class="inp" maxlength="100" placeholder="<?=__('当前可转积分数量')?>" readonly />
                        <span class="input-del"></span>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('转出数量')?></h4>
                    <div class="input-box">
                        <input type="text" id="points_num" name="points_num" class="inp" maxlength="100" placeholder="<?=__('请输入兑换的积分数量')?>" oninput="writeClear($(this));" onfocus="writeClear($(this));"/>
                        <span class="input-del"></span> </div>
                </li>

                <li class="form-item">
                    <h4><?=__('好友ID')?></h4>
                    <div class="input-box">
                        <input type="text" id="user_nickname" name="user_nickname" class="inp" maxlength="100" placeholder="<?=__('请输入转入好友ID')?>" oninput="writeClear($(this));" onfocus="writeClear($(this));"/>
                        <span class="input-del"></span> </div>
                </li>
                <!--<li class="form-item">-->
                <!--<h4>验&nbsp;证&nbsp;码</h4>-->
                <!--<div class="input-box">-->
                <!--<input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="输入4位验证码" oninput="writeClear($(this));"/>-->
                <!--<span class="input-del code"></span> <a href="javascript:void(0)" id="refreshcode" class="code-img"><img border="0" id="codeimage" name="codeimage"></a>-->
                <!--<input type="hidden" id="codekey" name="codekey" value="">-->
                <!--</div>-->
                <!--</li>-->
            </ul>
            <div class="error-tips"></div>
            <div class="form-btn"><a href="javascript:void(0);" class="btn" id="saveform"><?=__('确认提交')?></a></div>
        </form>
    </div>
</div>
<div class="fix-block-r">
    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
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
        <div class="detail"><%=v.points_log_desc;%></div>
        <% if(v.points_log_points >0){%>
        <div class="money add">+<%=v.points_log_points;%></div>
        <%}else{%>
        <div class="money reduce"><%=v.points_log_points;%></div>
        <%}%>
        <time class="date"><%=v.points_log_date;%></time>
    </li>
    <%}%>
    <li class="loading">
        <div class="spinner"><i></i></div>
        <?=__('数据读取中')?>
    </li>
    <%}else {%>
    <div class="sstouch-norecord pdre">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您尚无积分收支信息')?></dt>
            <dd></dd>
        </dl>
    </div>
    <%}%>
</script>
<script> var navigate_id = "5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script>$(function() {
    if (!ifLogin()){return}

  //获取我的积分
  $.getJSON(SYS.URL.pay.asset, {'fields':'point'}, function(result){
    var html = template.render('pointscount_model', result.data);
    $("#pointscount").html(html);
  });


    $.getJSON(SYS.URL.exchange.point_transfer, {'fields': 'predepoit'}, function (result) {
        $('#transfer_desc').html(result.data.transfer_desc);
        $('#user_points').val(result.data.user_points);
    });

    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });

    $.sValid.init({
        rules:{
            points_num:"required",
            user_nickname:"required",
            captcha:"required"
        },
        messages:{
            points_num:"<?=__('请输入兑换的积分数量')?>",
            user_nickname:"<?=__('请输入兑换的积分数量')?>",
            captcha:"<?=__('请填写验证码')?>"
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide();
            }
        }
    });

    $('#saveform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }

        if($.sValid()){
            var points_num = $.trim($("#points_num").val());
            var user_nickname = $.trim($("#user_nickname").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            $.request({
                type:'post',
                url:SYS.URL.exchange.do_point_transfer,
                data:{points_num:points_num,user_nickname:user_nickname,captcha:captcha,codekey:codekey},
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                        location.href = WapSiteUrl+'/tmpl/member/pointslog_list.html';
                    }else{
                        loadSeccode();
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            });
        }
    });
});

</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
