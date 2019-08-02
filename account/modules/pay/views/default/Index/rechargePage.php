<?php
$value = f("recharge_amount", 0);
if ($value <= 0 ) {
    $value = 1;
}
?>
<style>


    .pay-tab {
    }

    .pay-strategy {
        width: 300px;
        margin-bottom: 50px;
    }

    .pay-strategy .unit-pay-card {
        height: 70px;
        line-height: 70px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0 50px;
        margin-bottom: 20px;
    }

    .pay-strategy .unit-pay-card img {
        vertical-align: middle;

        width:150px;
        height: auto;
    }

    .unit-pay-card.pay-checked {
        border-color: #ff7300;
    }

    .unit-pay-card.pay-checked {
        background: url(../img/sn-checked.png) no-repeat top right;
        background-size: 27px;
    }

    /*
    .unit-pay-card .pay-container {
      position: relative;
      z-index: 2;
      border: 1px solid #ddd;
      width: 354px;
      height: 145px;
      -webkit-perspective: 1000;
      -moz-perspective: 1000;
      -ms-perspective: 1000;
      perspective: 1000;
    }

    */
    .unit-pay-card.active{
        border:1px solid #3399ff
    }
    .pay-wallet {
        margin-bottom: 50px;
    }

    .pay-wallet .unit-line dt {
        float: left;
        width: 66px;
        text-align: left;
        line-height: 50px;
        font-size: 13px;
        margin-right: 12px;
    }

    .pay-wallet .unit-line dd {
        float: left;
        width: 366px;
        text-align: left;
        line-height: 50px;
        font-size: 13px;
    }

    .pay-wallet .unit-line .amount {
        font-size: 18px;
        line-height: 50px;
        font-weight: 700;
    }

    .pay-wallet .unit-line dd .recharge {
        color: #797979;
        font-size: 13px;
    }

    .pay-wallet .unit-line dd .recharge a,
    .pay-wallet .unit-line .recharge-pwd {
        margin-left: 12px;
        color: #3399ff;
    }

    .pay-wallet .unit-line dd .findpwd {
        margin-left: 12px;
        color: #797979;
    }

    .wallet-button {
        margin-left: 78px;
    }

    .bank-info {
        padding: 80px 0;
    }

    .bank-info .title {
        font-size: 13px;
        line-height: 50px;
    }

    .pay-bank .bank-info .company {
        width: 450px;
        border: 1px solid #ddd;
    }

    .pay-bank .bank-info .company h2 {
        padding: 10px 20px;
        background: #feedc6;
        border-bottom: 1px solid #ddd;
        font-size: 13px;
    }

    .pay-bank .bank-info .company .content {
        padding: 20px;
    }

    .pay-bank .bank-info .company .content p {
        line-height: 30px;
        font-size: 13px;
    }
</style>
<div class="content-main pay">
    <div class="layout">
        <div class="pay-order">
            <div class="order-content">
                <span class="bal-price"> <?=__('充值金额')?>：<span id="stress" class="stress" data-price="<?= sprintf("%.2f", $value)?>"> <?= sprintf("%.2f", $value)?></span> <?=__('元')?></span>
            </div>
        </div>
    </div>
    <div class="layout sn-clr">
        <div class="pay-tab">
            <!--tab-->
            <div class="table_card">
                <ul class="tab">
<!--                    <li class="activ">快捷支付 </li>-->
                    <!--<li>余额支付</li>-->
                </ul>
                <div class="tabCon">
                    <div class="item on">
                        <div class="pay-strategy">
                            <div class="unit-pay-card" data-type="alipay" data-channel_id="1401">
                                <img src="<?= $this->img("zhifubao.png") ?>" alt="" >
                            </div>
                            <div class="unit-pay-card" data-channel_id="1403" data-type="wx_native">
                                <img src="<?= $this->img("weixin.png") ?>" alt="" >
                            </div>
                        </div>
                        <a href="" class="pay-button btn btn-primary"><?=__('确认付款')?></a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<?php

$id = s("id", 0);
$js = <<<JS
$(function(){
    var material_id = "{$id}";
    $(".pay-strategy .unit-pay-card").click(function() {
      $(this).addClass("active").siblings()
                .removeClass("active");
      $(".pay-button").addClass("activ")
    });
    $(".tab li").on("click", function(event) {
        $(".tab li")
            .eq($(this).index())
            .addClass("activ")
            .siblings()
            .removeClass("activ");
        $(".tabCon .item")
            .hide()
            .eq($(this).index())
            .show();
        $(".pay-button").removeClass("activ")
    });
    $(".pay-button").click(function(e) {
        e.preventDefault();
        if (!$(this).hasClass("activ")) {
            return false;
        }
        var params = {
            pdr_amount: $("#stress").data("price")
        };
        var callback = toPay;
        addRechargeOrder(params, callback);
    })

    function addRechargeOrder(params, callback) {
        $.ajax({
            url: SYS.CONFIG.index_url + "?mdu=pay&ctl=Index&met=recharge&typ=json",
            method: 'POST',
            dataType: 'json',
            type: 'POST',
            data: params,

            error: function () {
                alert(__('抱歉！网络错误，请刷新重试！'));
            },
            success: function (res) {
                if (res && res.status == 200) {
                    callback(res.data.pay_sn);
                } else {
                    alert(res.msg);
                }
            }
        });

    }


    function toPay(order_id) {
        var params = {
            pay_sn: order_id,
            payment_channel_code: $(".unit-pay-card.active").data("type"),
            payment_channel_id: $(".unit-pay-card.active").data("channel_id")
        };

        var toUrl = SYS.CONFIG.index_url + "?mdu=pay&ctl=Index&met=pay&typ=e&" + $.param(params)
        window.location.href = toUrl

        /*if ( confirm("支付成功了？")) {
            window.location.href = SYS.CONFIG.index_url + "?mdu=pay&ctl=Index&met=paySuccess&typ=json";
        }*/

    }
})
JS;
$this->lazyJsString($js);
?>