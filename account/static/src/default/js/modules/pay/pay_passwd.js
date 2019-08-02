;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {

    payPassword = {
        config: {},
        init: function () {
            var that = this;
            that.runMethod();
            /*$.request({
                type: 'get',
                url: sprintf("%s/account.php?mdu=pay&ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'Index', 'getPayPasswd'),
                data: {},
                dataType: 'json',
                success: function (result) {
                    if (result.status == 250) {
                        $('#paypwd_tips').html('设置支付密码');
                    } else {
                        $('#paypwd_tips').html('修改支付密码');
                    }
                }
            });*/
        },
        runMethod: function () {
            var that = this;
            that.eventClick();
        },

        eventClick: function () {
            $.request({
                type: 'get',
                url: sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'index'),
                data: {},
                dataType: 'json',
                success: function (result) {
                    if (result.status == 200) {
                        if (-1 != $.inArray(1, result.data.bind_type_row)) {
                            $('#mobile').html(result.data[1]);
                            $('.not-bind-mobile-tip').addClass('hide').siblings().removeClass('hide');
                            verifyUtils.imageVerifyCode($('#codeimage'), $('#codekey'));
                            verifyUtils.smsVerifyCode($('#mobile').html(), $('#pay_passwd_mobile_btn'), $('#captcha').val());
                        } else {
                            $('.not-bind-mobile-tip').removeClass('hide').siblings().addClass('hide');
                        }
                    }
                },
                error: function () {
                    alert("failure");
                },
            });


            $('body').on('click', '#J_nextStep:not(.disabled)', function (e) {
                e.preventDefault();
                //$.fancybox.close();
                $.request({
                    type: 'post',
                    url: sprintf("%s/account.php?mdu=pay&ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'checkMobile'),
                    data: {code: $('#code').val()},
                    dataType: 'json',
                    error: function () {
                        Public.showInfoModal(__('抱歉！网络错误，请刷新重试！'));
                    },
                    success: function (res) {
                        if (res && res.status == 200) {
                            $('.step1').addClass('hide');
                            $('.step2').removeClass('hide');
                        } else {
                            Public.showInfoModal(__('验证码错误，请重试！'));
                        }
                    }
                });
            });

            //重置支付密码
            $('body').on('click', '#J_resetPayPsw', function (e) {
                e.preventDefault();
                $.request({
                    type: 'post',
                    url: sprintf("%s/account.php?mdu=pay&ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'Index', 'resetPayPassword'),
                    data: {password: $('#user_pay_psw').val()},
                    dataType: 'json',
                    error: function () {
                        Public.showInfoModal(__('抱歉！网络错误，请刷新重试！'));
                    },
                    success: function (res) {
                        if (res && res.status == 200) {
                            $.fancybox.close();
                            Public.showInfoModal(__('支付密码设置成功！'));
                        } else {
                            $.fancybox.close();
                            Public.showInfoModal(__('支付密码设置失败！'));
                        }

                    }
                });
            });

        }
    },

        $(function () {
            payPassword.init()
        });
}));
