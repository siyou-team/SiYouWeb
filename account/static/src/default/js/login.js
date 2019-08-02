E_ACCOUNT    = 1001;
E_PASSWORD   = 1002;
E_VERIFYCODE = 1003;
console.log( SYS.URL.login );

jQuery(document).ready(function ($)
{
    if (window.parent!=window)
    {
        $('.external-login').hide();
    }
    else
    {
    }

  $('#user_address').on("cp:updated", function () {
    var code = $(this).data('citypicker').getCode();

    var code_row = code.split("/");

    $('#user_province_id').val(code_row[0]);
    $('#user_city_id').val(code_row[1]);
    $('#user_county_id').val(code_row[2]);

  });

    // Login Reg Form Label Focusing
    $(".login-form .form-group:has(label)").each(function(i, el)
    {
        var $this = $(el),
            $label = $this.find('label'),
            $input = $this.find('.form-control');

        $input.on('focus', function()
        {
            $this.addClass('is-focused');
        });

        $input.on('keydown', function()
        {
            $this.addClass('is-focused');
        });

        $input.on('blur', function()
        {
            $this.removeClass('is-focused');

            if($.trim($input.val()).length > 0)
            {
                $this.addClass('is-focused');
            }
        });

        $label.on('click', function()
        {
            $input.focus();
        });

        if($.trim($input.val()).length > 0)
        {
            $this.addClass('is-focused');
        }
    });

    //end

    // Reveal Login form
    setTimeout(function ()
    {
        $(".fade-in-effect").addClass('in');
    }, 1);


    // Validation and Ajax action
    $("form#login").validate({
        rules: {
            user_account: {
                required: true
            },

            user_password: {
                required: true
            }
        },

        messages: {
            user_account: {
                required: 'Please enter your user_account.'
            },

            user_password: {
                required: 'Please enter your password.'
            }
        },

        // Form Processing via AJAX
        submitHandler: function (form)
        {
            show_loading_bar(70); // Fill progress bar to 70% (just a given value)

            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-full-width",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            $.ajax({
                url: SYS.URL.login,
                method: 'POST',
                dataType: 'json',
                data: {
                    do_login: true,
                    user_account: $(form).find('#user_account').val(),
                    user_password: $(form).find('#user_password').val(),
                    bind_type: $.getUrlVar('bind_type'),
                    t: $.getUrlVar('t'),
                    from: $.getUrlVar('from'),
                    callback: $(form).find('#callback').length>0 ? $(form).find('#callback').val(): $.getUrlVar('callback'),
                },
                success: function (resp)
                {
                    show_loading_bar({
                        delay: .5,
                        pct: 100,
                        finish: function ()
                        {

                            // Redirect after successful login page (when progress bar reaches 100%)
                            if (200 == resp.status)
                            {
                                if (window.parent!=window)
                                {
                                    //
                                    if (resp.data.callback_url)
                                    {
                                        window.parent.location.href = decodeURIComponent(resp.data.callback_url);
                                    }
                                    else
                                    {
                                        window.parent.location.reload();
                                    }
                                }
                                else
                                {
                                    window.location.href = decodeURIComponent(resp.data.callback_url);
                                }
                            }
                        }
                    });


                    // Remove any alert
                    $(".errors-container .alert").slideUp('fast');
                    // Show errors
                    showErrorMsg(form, resp.code, resp.status, resp.msg);
                }
            });

        }
    });

    // Set Form focus
    //$("form#login .form-group:has(.form-control):first .form-control").focus();


    // register Form Label Focusing

    // 注册账号的验证
    $("form#register").validate({
        rules: {
            user_account: {
                required: true
            },

            user_password: {
                required: true
            },

            user_password_b:{
                equalTo:"#user_password"
            },

            verify_code: {
                required: true
            },

          user_address: {
            required: true
          }
        },

        messages: {
            user_account: {
                required: '请输入注册账号.'
            },

            user_password: {
                required: '请输入注册密码.'
            },

            user_password_b:{
                equalTo:"两次密码输入不一致"
            },

            verify_code: {
                required: ''
            }
        },

        // Form Processing via AJAX
        submitHandler: function (form)
        {
            show_loading_bar(70); // Fill progress bar to 70% (just a given value)

            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-full-width",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            $.ajax({
                url: SYS.URL.register,
                type: 'POST',
                dataType: 'json',
                data: {
                    do_register: true,
                    user_account: $(form).find('#user_account').val(),
                    user_password: $(form).find('#user_password').val(),
                    rand_key: $(form).find('#rand_key').val(),
                    verify_code: $(form).find('#verify_code').val(),
                    bind_type: $.getUrlVar('bind_type'),


                  user_province_id: $(form).find('#user_province_id').val(),
                  user_city_id: $(form).find('#user_city_id').val(),
                  user_county_id: $(form).find('#user_county_id').val(),

                    t: $.getUrlVar('t'),
                    from: $.getUrlVar('from'),
                    callback: $(form).find('#callback').length>0 ? $(form).find('#callback').val(): $.getUrlVar('callback'),
                },
                success: function (resp)
                {
                    console.info(resp);

                    show_loading_bar({
                        delay: .5,
                        pct: 100,
                        finish: function ()
                        {
                            if (200 == resp.status)
                            {
                                window.location.href = decodeURIComponent(resp.data.callback_url);
                            }
                        }
                    });
                    $(".errors-container .alert").slideUp('fast');

                    alert(resp.msg);
                    showErrorMsg(form, resp.code, resp.status, resp.msg);
                }
            });

        }
    });

    $.validator.addMethod("isPhone", function(value, element) {
        var length = value.length;
        var mobile = /^3[\d]{9}/;
        return this.optional(element) || (length == 10 && mobile.test(value));
    }, "请填写正确的手机号码");//可以自定义默认提示信息

    $("form#register_mobile").validate({
        rules: {
            user_account: {
                required:true
            },
            user_phone: {
                isPhone:true
            },
            channel_verify_code: {
                required: true
            },
        },
        messages: {
            user_account: {
                required: '请输入账号.'
            },
            user_phone: {
                required: '请输入手机号!.'
            },
            channel_verify_code: {
                required: ''
            }
        },
        submitHandler: function (form)
        {
            show_loading_bar(70); // Fill progress bar to 70% (just a given value)
            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-full-width",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            $.ajax({
                url: SYS.URL.register,
                type: 'POST',
                dataType: 'json',
                data: {
                    do_register: true,
                    user_phone: $(form).find('#user_phone').val(),
                    user_account: $(form).find('#user_account').val(),
                    user_password:  $(form).find('#user_password').val(),//$(form).find('#user_password').val(),
                    channel_verify_code: $(form).find('#channel_verify_code').val(),
                    bind_type: $.getUrlVar('bind_type'),
                    t: $.getUrlVar('t'),
                    from: $.getUrlVar('from'),
                    callback: $(form).find('#callback').length>0 ? $(form).find('#callback').val(): $.getUrlVar('callback'),
                },
                success: function (resp)
                {
                    console.info(resp);
                    show_loading_bar({
                        delay: .5,
                        pct: 100,
                        finish: function ()
                        {
                            if (200 == resp.status)
                            {
                                window.location.href = decodeURIComponent(resp.data.callback_url);
                            }
                        }
                    });
                    $(".errors-container .alert").slideUp('fast');
                    alert(resp.msg);
                    // showErrorMsg(form, resp.code, resp.status, resp.msg);
                }
            });
        }
    });

    $("form#findpwd_step1").validate({
        rules: {
            user_account: {
                required: true
            },
            verify_code: {
                required: true
            }
        },
        messages: {
            user_account: {
                required: '请输入注册账号.'
            },
            verify_code: {
                required: ''
            }
        },
        submitHandler: function (form)
        {
            var verify_code = $('#verify_code').val();
            var user_account = $('#user_account').val();
            var rand_key =  $(form).find('#rand_key').val();
            var channel = $('button[type="submit"]').data('channel');
            var step2 = itemUtil.getUrl(SYS.URL.find_pwd_s2, {step:2,user_account:user_account,verify_code:verify_code,rand_key:rand_key,channel:channel});
            $(form).attr('action', step2);
            $(form).onsubmit();
        }
    });

    $("#J_exchangeChannel").on('click', function () {
        var that = $(this);
        var channel = that.prev().data('channel');
        if (channel == 'mobile'){
            that.children('span').html("手机");
            that.siblings('button').children('span').html("邮件");
            that.siblings('button').data('channel' , 'email');
        } else {
            that.children('span').html("邮件");
            that.siblings('button').children('span').html("手机");
            that.siblings('button').data('channel' , 'mobile');
        }
    })

    // Validation and Ajax action
    $("form#findpwd_step2").validate({
        rules: {
            sms_code: {
                required: true
            }
        },

        messages: {
            sms_code: {
                required: ''
            },

        },
        submitHandler: function (form)
        {
            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-full-width",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            $.ajax({
                url: SYS.URL.check_mobile_or_email,
                method: 'POST',
                dataType: 'json',
                type: 'POST',
                data: {
                    user_id: $('#user_id').val(),
                    channel_verify_key: $('#channel_verify_key').val(),
                    channel_verify_code: $('#channel_verify_code').val(),
                    channel: $('#channel').val(),
                },
                error: function () {
                    alert(__('抱歉！网络错误，请刷新重试！'));
                    showErrorMsg(form, E_ACCOUNT, 250, __('抱歉！网络错误，请刷新重试！'));
                },
                success: function (res) {
                    if (res && res.status == 200) {
                        var channel_verify_key = $('#channel_verify_key').val();
                        var channel_verify_code = $('#channel_verify_code').val();
                        var channel = $('#channel').val();
                        var step3 = itemUtil.getUrl(SYS.URL.find_pwd_s3, {channel_verify_key:channel_verify_key,channel_verify_code:channel_verify_code,channel:channel});
                        window.location.href = step3;
                    } else {
                        alert(res.msg);
                        showErrorMsg(form, res.code, res.status, res.msg);
                        //Public.showInfoModal(__('验证码错误，请重试！'));
                    }
                }
            });
        }
    });

    // Validation and Ajax action
    $("form#findpwd_step3").validate({
        rules: {
            pwd: {
                required: true
            },
            confirm_pwd: {
                required: true,
                equalTo: "#pwd"
            }
        },

        messages: {
            pwd: {
                required: '请输入密码'
            },
            confirm_pwd: {
                required: '请输入密码',
                equalTo: '两次输入的密码不一致',
            }

        },


        // Form Processing via AJAX
        submitHandler: function (form)
        {
            show_loading_bar(70); // Fill progress bar to 70% (just a given value)

            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-full-width",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            $.ajax({
                type: 'POST',
                url: SYS.URL.set_pwd,
                data: {
                    channel_verify_code: $('#channel_verify_code').val(),
                    channel_verify_key : $('#channel_verify_key').val(),
                    pwd                : $('#pwd').val(),
                    channel            : $('#channel').val()
                },
                dataType: 'json',
                error: function () {
                    alert( __('抱歉！网络错误，请刷新重试！'));

                    showErrorMsg(form, E_ACCOUNT, 250, __('抱歉！网络错误，请刷新重试！'));
                    //Public.showInfoModal(__('抱歉！网络错误，请刷新重试！'));
                },
                success: function (res) {
                    if (res && res.status == 200) {
                        window.location.href = SYS.URL.login;
                    } else {
                        alert(res.msg);
                        showErrorMsg(form, res.code, res.status, res.msg);
                        //Public.showInfoModal(__('密码修改失败，请重试！'));
                    }
                }
            });
        }
    });


    //短信验证码获取
    var verify_key = $("#channel_verify_key").val();
    verifyUtils.smsVerifyCodeNew(verify_key, $('#pay_passwd_mobile_btn'));

    //邮件
    verifyUtils.emailVerifyCode(verify_key, $('#email_code_btn'));


    //错误提示
    function showErrorMsg(form, code, status, msg) {
        // Show errors
        if (status == 250) {
            alert(msg);
            $(".errors-container").html('<div class="alert alert-danger">\
                                <button type="button" class="close" data-dismiss="alert">\
                                    <span aria-hidden="true">&times;</span>\
                                    <span class="sr-only">Close</span>\
                                </button>\
                                ' + msg + '\
                            </div>');


            $(".errors-container .alert").hide().slideDown();

            if (code == E_ACCOUNT) {
                $(form).find('#user_account').select();
            }
            else if (code == E_PASSWORD) {
                $(form).find('#user_password').select();
            }
            else if (code == E_VERIFYCODE) {
                $(form).find('#verify_code').select();
            }
        }
    }

});
