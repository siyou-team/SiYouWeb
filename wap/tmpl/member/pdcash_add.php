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

  <title><?=__('账户余额')?></title>

  <link rel="stylesheet" type="text/css" href="../../css/base.css">

  <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">

</head>

<body>

<header id="header" class="app-no-fixed">

  <div class="header-wrap">

    <div class="header-l"><a href="member.html"><i class="zc zc-back back"></i></a></div>

    <div class="header-title">

      <h1><?=__('余额提现')?></h1>

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
        <dt><?=__('预存款余额')?></dt>
        <dd>￥<em id="user_money"> -- </em></dd>
      </dl>
    </div>
  </div>

  <div id="fixed_nav" class="sstouch-single-nav">

    <ul id="filtrate_ul" class="w33h">
      <li style="width: 20%;"><a href="recharge.html"><?=__('账户充值')?></a></li>
      <li style="width: 20%;"><a href="predepositlog_list.html"><?=__('账户余额')?></a></li>
      <li style="width: 20%;"><a href="pdrecharge_list.html"><?=__('充值明细')?></a></li>
      <li style="width: 20%;"><a href="pdcashlist.html"><?=__('提现列表')?></a></li>
      <li class="selected" style="width: 20%;"><a href="javascript:void(0);"><?=__('余额提现')?></a></li>
    </ul>

  </div>

  <ul id="pdcashlist" class="sstouch-log-list tx">

  </ul>

</div>

<div class="fix-block-r">

  <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>

</div>

<script type="text/html" id="pd_count_model">

  <div class="container pre">

    <i class="icon"></i>

    <dl>

      <dt><?=__('预存款余额')?></dt>

      <dd><?=__('预存款余额')?>￥<em><%=user_money;%></em></dd>

    </dl>

  </div>

</script>

<div class="sstouch-inp-con" style="padding-top: 20px;">
  <form action="" method ="" id="form_name">
    <ul class="form-box">
      <input name="client" value="wap" type="hidden">
      <li class="form-item">
        <h4><?=__('提现金额')?>:</h4>
        <div class="input-box">
          <input type="text" name="withdraw_amount" id="withdraw_amount" style="" class="inp" maxlength="10" placeholder="<?=__('请输入提现金额')?>" oninput="writeClear($(this));" onFocus="writeClear($(this));"/><em style="font-size:16px;position: absolute;right:0.05rem;top:0.7rem;"><?=__('元')?> </em>
          <span class="input-del"></span>
        </div>
      </li>


      <li class="form-item">
        <h4><?=__('收款方式')?>:</h4>
        <div class="input-box">
        <span class='inp-black' style="padding: 0.1rem 0.5rem;height: 100%;line-height: 100%;widows: 16;%;">
            <select id="withdraw_bank" name="withdraw_bank" style="height: 1.75rem;"></select><a href="userbank_list.html" style="font-size:16px;position: absolute;left:6rem;top:0.5rem;white-space:nowrap"> <?=__('添加银行卡')?> </a>
        </span>
        </div>
      </li>


      <li class="form-item">
        <h4><?=__('收款账号')?>:</h4>
        <div class="input-box">
          <input type="text" class="inp" name="withdraw_account_no" id="withdraw_account_no" placeholder="<?=__('例如支付宝、微信号等')?>"  oninput="writeClear($(this));" onFocus="writeClear($(this));" />
          <span class="input-del"></span>
        </div>
      </li>



      <li class="form-item">
        <h4><?=__('收&nbsp;&nbsp;款&nbsp;&nbsp;人')?>:</h4>
        <div class="input-box">
          <input type="text" class="inp" name="withdraw_account_name" id="withdraw_account_name" placeholder="<?=__('请如实填写收款人姓名，否则将会影响到收款')?>"  oninput="writeClear($(this));" onFocus="writeClear($(this));" />
          <span class="input-del"></span>
        </div>
      </li>


      <li class="form-item">
        <h4><?=__('手机号码')?>:</h4>
        <div class="input-box">
          <input type="text" class="inp" name="withdraw_mobile" id="withdraw_mobile" placeholder="?=__('手机号码方便联系您')?>"  oninput="writeClear($(this));" onFocus="writeClear($(this));" />
          <span class="input-del"></span>
        </div>
      </li>


      <li class="form-item">
        <h4><?=__('支付密码')?>:</h4>
        <div class="input-box">
          <input type="text" class="inp" name="password" id="password" placeholder="<?=__('支付密码，确认验证您的身份')?>"  oninput="writeClear($(this));" onFocus="writeClear($(this));" />
          <span class="input-del"></span>
        </div>
      </li>
    </ul>

    <div class="error-tips"></div>

    <div class="form-btn"><a href="javascript:void(0);" class="btn" id="saveform"><?=__('确认提现')?></a></div>

  </form>


</div>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>



<script>

    $(function ()
    {

        if (!ifLogin()){return}


        //获取预存款余额

        $.getJSON(SYS.URL.pay.asset, {'fields': 'predepoit'}, function (result)
        {
            $('#user_money').html(result.data.user_money);
            /*
            var html = template.render('pd_count_model', result.data);

            $("#pd_count").html(html);
            */

        });

        $.ajax({
            type: 'post',
            url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=UserBank&typ=json',
            dataType: 'json',
            success: function(result) {

                var option = '<option value="">请选择付款方式</option>';
                $.each(result.data.items,function(k,v){
                    option+='<option value="'+v.user_bank_id+'">'+v.bank_name+v.user_bank_card_address+'</option>';
                });
                $("#withdraw_bank").html(option);
            }
        })



        $("#saveform").click(function() {

            if (!$(this).parent().hasClass("ok")) {

                return false;

            }


            var form_data = $('#form_name').serialize();

            $.request({

                type: "post",

                url: SYS.URL.pay.consume_withdraw_add,

                data:form_data,

                dataType: "json",
                success:function(result){
                    if(result.status==200){

                        location.href = 'pdcashinfo.html?withdraw_id=' + result.data.withdraw_id;

                    }else{
                        errorTipsShow("<p>"+result.msg+"<p>");
                    }
                }

            });
        });

        $('#withdraw_bank').on('change', function(e) {
            var id = $(this).val();
            $.ajax({
                type: "post",
                url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=getUserBank&typ=json',
                data:{id:id},
                dataType: "json",
                success:function(result){
                    if(result.status==200){
                        $('#withdraw_account_no').val(result.data.user_bank_card_code);
                        $('#withdraw_account_name').val(result.data.user_bank_card_name);
                        $('#withdraw_mobile').val(result.data.user_bank_card_mobile);
                    } else {
                        return;
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
