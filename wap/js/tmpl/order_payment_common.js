var key = getLocalStorage('ukey');
var password,pm_recharge_card,pm_money,pm_points,pm_credit,payment_channel_code,is_set_pay_password=false,_use_password = false;
var onlineTotal = 0;
// 现在支付方式
function toPay(pay_sn,act,op) {
    $.request({
        type:'post',
        url: SYS.URL.pay.lists,
        data:{
            pay_sn:pay_sn
        },
        dataType:'json',
        success: function(result){
            //checkLogin(result.login);
            if (result.status != 200) {
                $.sDialog({
                    skin:"red",
                    content:result.msg,
                    okBtn:false,
                    cancelBtn:false
                });
                return false;
            }
            // 从下到上动态显示隐藏内容
            $.animationUp({valve:'',scroll:''});

            // 需要支付金额
          onlineTotal = result.data.pay_info.pay_amount;
            $('#onlineTotal').html(result.data.pay_info.pay_amount);

            // 是否设置支付密码
            if (!result.data.pay_info.is_pay_passwd) {
                $('#wrapperPaymentPassword').find('.input-box-help').show();
            } else {
                is_set_pay_password = true;
            }

            // 支付密码标记
            //if (parseFloat(result.data.pay_info.payed_amount) <= 0) {
            if (true) {
                if (parseFloat(result.data.pay_info.user_money) == 0 && parseFloat(result.data.pay_info.user_recharge_card) == 0  && parseFloat(result.data.pay_info.user_points) == 0  && parseFloat(result.data.pay_info.user_credit) == 0) {
                    $('#internalPay').hide();
                } else {
                    $('#internalPay').show();
                    // 充值卡
                    if (parseFloat(result.data.pay_info.user_recharge_card) != 0) {
                        $('#wrapperUseRCBpay').show();
                        $('#availableRcBalance').html(parseFloat(result.data.pay_info.user_recharge_card).toFixed(2));
                    } else {
                        $('#wrapperUseRCBpay').hide();
                    }

                    // 预存款
                    if (parseFloat(result.data.pay_info.user_money) != 0) {
                        $('#wrapperUsePDpy').show();
                        $('#availablePredeposit').html(parseFloat(result.data.pay_info.user_money).toFixed(2));
                    } else {
                        $('#wrapperUsePDpy').hide();
                    }

                    // 积分支付
                    if (parseFloat(result.data.pay_info.user_points) != 0) {
                        $('#wrapperUsePoints').show();
                        $('#availablePointsMoney').html(parseFloat(result.data.pay_info.user_points_money).toFixed(2));
                        $('#availablePoints').html(parseFloat(result.data.pay_info.user_points).toFixed(0));
                    } else {
                        $('#wrapperUsePoints').hide();
                    }

                    // 信用支付
                    if (parseFloat(result.data.pay_info.user_credit) != 0) {
                        $('#wrapperUseCredit').show();
                        $('#availableCredit').html(parseFloat(result.data.pay_info.user_credit).toFixed(2));
                    } else {
                        $('#wrapperUseCredit').hide();
                    }
                }
            } else {
                $('#internalPay').hide();
            }

            password = '';
            $('#paymentPassword').bind('input propertychange', function(){
                password = $(this).val();
            });

            pm_recharge_card = 0;
            $('#useRCBpay').click(function(){
                if ($(this).prop('checked')) {
                    _use_password = true;
                    $('#wrapperPaymentPassword').show();
                    pm_recharge_card = 1;
                } else {
                    if (pm_money == 1) {
                        _use_password = true;
                        $('#wrapperPaymentPassword').show();
                    } else {
                        _use_password = false;
                        $('#wrapperPaymentPassword').hide();
                    }
                    pm_recharge_card = 0;
                }
            });

            pm_money = 0;
            $('#usePDpy').click(function(){
                if ($(this).prop('checked')) {
                    _use_password = true;
                    $('#wrapperPaymentPassword').show();
                    pm_money = 1;
                } else {
                    if (pm_money == 1) {
                        _use_password = true;
                        $('#wrapperPaymentPassword').show();
                    } else {
                        _use_password = false;
                        $('#wrapperPaymentPassword').hide();
                    }
                    pm_money = 0;
                }
            });


            pm_credit = 0;
            $('#useCredit').click(function(){
                if ($(this).prop('checked')) {
                    _use_password = true;
                    $('#wrapperPaymentPassword').show();
                    pm_credit = 1;
                } else {
                    if (pm_credit == 1) {
                        _use_password = true;
                        $('#wrapperPaymentPassword').show();
                    } else {
                        _use_password = false;
                        $('#wrapperPaymentPassword').hide();
                    }
                    pm_credit = 0;
                }
            });


            pm_points = 0;
            $('#usePoints').click(function(){
                if ($(this).prop('checked')) {
                    _use_password = true;
                    $('#wrapperPaymentPassword').show();
                    pm_points = 1;
                } else {
                    if (pm_points == 1) {
                        _use_password = true;
                        $('#wrapperPaymentPassword').show();
                    } else {
                        _use_password = false;
                        $('#wrapperPaymentPassword').hide();
                    }
                    pm_points = 0;
                }
            });

            payment_channel_code = '';
            if (!$.isEmptyObject(result.data.pay_info.payment_list)) {
                var readytoWXPay = false;
                var readytoAliPay = false;
                var m = navigator.userAgent.match(/MicroMessenger\/(\d+)\./);
                readytoWXPay = true;
                if (isWeixin()) {
                    // 微信内浏览器
                    readytoWXPay = true;
                } else {
                    readytoAliPay = true;
                }

                for (var i=0; i<result.data.pay_info.payment_list.length; i++) {
                    var _payment_channel_code = result.data.pay_info.payment_list[i].payment_channel_code;
                    if (_payment_channel_code == 'alipay' && readytoAliPay) {
                        $('#'+ _payment_channel_code).parents('label').show();
                        if (payment_channel_code == '') {
                            payment_channel_code = _payment_channel_code;
                            $('#'+_payment_channel_code).attr('checked', true).parents('label').addClass('checked');
                        }
                    }
                    if (_payment_channel_code == 'wx_native' && readytoWXPay) {
                        $('#'+ _payment_channel_code).parents('label').show();
                        if (payment_channel_code == '') {
                            payment_channel_code = _payment_channel_code;
                            $('#'+_payment_channel_code).attr('checked', true).parents('label').addClass('checked');
                        }
                    }
                }
            }

            $('#alipay').click(function(){
                payment_channel_code = 'alipay';
            });

            $('#wx_native').click(function(){
                payment_channel_code = 'wx_native';
            });

            $('#toPay').click(function(){
                if (payment_channel_code == '') {
                    $.sDialog({
                        skin:"red",
                        content:'请选择支付方式',
                        okBtn:false,
                        cancelBtn:false
                    });
                    return false;
                }
                if (_use_password) {
                    // 验证支付密码是否填写
                    if (!is_set_pay_password) {
                        $.sDialog({
                            skin:"red",
                            content:'未设置支付密码',
                            okBtn:false,
                            cancelBtn:false
                        });
                    }
                    // 验证支付密码是否填写
                    if (password == '') {
                        $.sDialog({
                            skin: "red",
                            content: '请填写支付密码',
                            okBtn: false,
                            cancelBtn: false
                        });
                        return false;
                    }
                    // 验证支付密码是否正确
                    $.request({
                        type: 'post',
                        url: SYS.URL.pay.check_pay_passwd,
                        dataType: 'json',
                        data: {password: password},
                        success: function (result) {
                            if (result.status != 200) {
                                $.sDialog({
                                    skin: "red",
                                    content: result.msg,
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return false;
                            }
                            goToPayment(pay_sn, act == 'member_buy' ? 'pay_new' : 'vr_pay_new');
                        }
                    });


                } else {
                    goToPayment(pay_sn,act == 'member_buy' ? 'pay_new' : 'vr_pay_new');
                }
            });
        }
    });
}

function goToPayment(pay_sn, op) {

    if (pm_money)
    {
        pm_money = onlineTotal;
    }

    if (pm_recharge_card)
    {
      pm_recharge_card = onlineTotal;
    }

    if (pm_points)
    {
        pm_points = onlineTotal;
    }

    if (pm_credit)
    {
        pm_credit = onlineTotal;
    }

  var url = itemUtil.getUrl(SYS.URL.pay.pay, {key:key,pay_sn:pay_sn,password:password,pm_recharge_card:pm_recharge_card,pm_money:pm_money,pm_points:pm_points,pm_credit:pm_credit,payment_channel_code:payment_channel_code, mp_flag:isWeixin()?1:0});

    //判断是否微信
    if ('wx_native' == payment_channel_code)
    {
        if (isWeixin())
        {

        }
        else
        {
            $.sDialog({
                content: '请确认微信支付是否完成',
                "okBtnText": "支付完成",
                "cancelBtnText": "重新支付",
                "okFn": function() {
                    location.href = ApiUrl + '/account/modules/pay/api/payment/wx/return_url.php?order_id=' + pay_sn;
                }, //点击确定按钮执行的函数
                "cancelFn": function() {
                    goToPayment(pay_sn, op);
                    //location.href = url;
                } //点击取消按钮执行的函数
            });
        }
    }
    else
    {
    }

    location.href = url;
}
