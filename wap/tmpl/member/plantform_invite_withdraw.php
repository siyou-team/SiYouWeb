<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
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
    <title><?=__('佣金提现')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">

</head>

<body>

<header id="header" class="app-no-fixed">

    <div class="header-wrap">
        <div class="header-l"><a href="plantform_invite.html"><i class="zc zc-back back"></i></a></div>
        <div class="header-title">
            <h1><?=__('佣金提现')?></h1>
        </div>
        <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a></div>
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
    <div id="pd_count" class="sstouch-asset-info">
        <div class="container pre">
            <i class="icon"></i>
            <dl>
                <dt><?=__('佣金提现')?></dt>
                <dd>￥<em id="user_money"> -- </em></dd>
            </dl>
        </div>
    </div>
    <div id="fixed_nav" class="sstouch-single-nav">
        <div class="register-mobile-tip"><?=__('小提示：佣金需要大于')?> <span id="min_money">0.00</span> <?=__('才可进行提现。')?></div>
    </div>
</div>

<div class="fix-block-r">
    <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>



<div class="sstouch-inp-con" style="padding-top: 20px;">

    <form action="" method="" id="form_name">
        <div class="error-tips"></div>
        <div class="form-btn hide"><a href="javascript:void(0);" class="btn" id="saveform"><?=__('提现')?></a></div>
        <div class="form-btn"><a href="javascript:void(0);" class="btn" id="withdraw"><?=__('转入余额')?></a></div>
    </form>
</div>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script>

    $(function ()
    {

        if (!ifLogin()){return;}
        //获取预存款余额
        $.getJSON(SYS.URL.fx.withdraw, {}, function (result)
        {
            $('#user_money').html(result.data.user_commission_now.toFixed(2));
            $('#min_money').html(result.data.min_withdraw.toFixed(2));
            if (result.data.user_commission_now >= result.data.min_withdraw && result.data.user_commission_now > 0) {
                $('.form-btn').addClass("ok");
            }
        });

        $("#withdraw").click(function() {

            if (!$(this).parent().hasClass("ok")) {
                return false;
            }
            var form_data = $('#form_name').serialize();

            $.request({
                type: "post",
                url: SYS.URL.fx.doWithdraw,
                data:form_data,
                dataType: "json",
                success:function(result){
                    if(result.status==200){
                        $.sDialog({
                            content: <?=__('成功转入余额')?>,
                            okBtn:false,
                            cancelBtn:false
                        });
                        window.location.reload();
                    }else{
                        errorTipsHide(result.msg);
                    }
                }

            });
        });

    });

</script>

</body>

</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
