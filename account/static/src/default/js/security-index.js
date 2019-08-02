$(document).on('click', '.tip_btns .btn_back', function ()
{
    $.fancybox.close();
    return false;
})

$(document).on('click', '.end', function ()
{
    $.fancybox.close();
    return false;
})

$(document).on('click', '.btn-close', function (e)
{

    $.fancybox.close();
    return false;
})

//修改密码
$(document).on('click', '.tip_btns .password', function (e)
{
    e.preventDefault();

    $('.err_tip').css('display', 'none');
    var old_password = $('#old_password').val();
    var new_pass1 = $('#new_pass1').val();
    var new_pass2 = $('#new_pass2').val();
    var verify_code = $('#verify_code').val();
    var rand_key = $('#rand_key').val();

    if(old_password.length == 0)
    {
        $('.grpOldPass .empty_pwd').css('display', 'block');

        return false;
    }
    if(new_pass1.length == 0)
    {
        $('.grpNewPass .empty_pwd').css('display', 'block');

        return false;
    }
    if(new_pass2.length == 0)
    {
        $('.grpNewPass .empty_pwd2').css('display', 'block');

        return false;
    }

    if(new_pass1 != new_pass2)
    {
        $('.pwd_mismatch').css('display', 'block');

        return false;
    }

    if(old_password == new_pass1)
    {
        $('.same_pwd').css('display', 'block');

        return false;
    }

    if(verify_code.length == 0)
    {
        $('.empty_capt').css('display', 'block');

        return false;
    }

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'changePassword'),
        data:{old_password:old_password, new_password:new_pass2, verify_code:verify_code, rand_key:rand_key},
        dataType:'json',
        async: false,
        error: function() {
            alert("发生错误！");
        },
        success: function(data) {

            if (250 == data.status)
            {
                alert(data.msg);
            }
            else
            {
                $.fancybox.close();
                window.location.reload();
            }

        }
    });

    return false;
})
//修改邮箱
$(document).on('click', '#email-next', function ()
{

    $('.err_tip').css('display', 'none');

    var bind_id = $('#bind_id').val();
    var verify_code = $('#verify_code').val();
    var rand_key = $('#rand_key').val();
    var bind_type = 2;

    if (bind_id.length == 0)
    {

        $('.empty_email').css('display', 'block');

        return false;
    }

    if(verify_code.length == 0)
    {

        $('.empty_capt').css('display', 'block');

        return false;
    }

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'checkVerify'),
        data:{bind_id:bind_id, verify_code:verify_code, rand_key:rand_key, bind_type:bind_type},
        dataType:'json',
        async: false,
        error: function() {
            //alert("failure");
        },
        success: function(data) {

            if(data.status == 200)
            {
                var result = data.data;
                $('.email .mailstep1').css('display', 'none');
                $('.email .verify').css('display', 'block');
                $('#bind_id_email').html(result.bind_id);
                $('#bind_id').val(result.bind_id);
                $('#email_bind_id').val(result.bind_id);
                $('.tabbar_panel .mailtab1').removeClass('now');
                $('.tabbar_panel .mailtab2').addClass('now');

            }
            else
            {
                $('.' + data.msg).css('display', 'block');

            }


        }
    });

    return false;
})

//邮箱绑定验证
$(document).on('click', '.verify .email', function ()
{

    $('.err_tip').css('display', 'none');

    var bind_access_token = $('#bind_access_token').val();
    var email_bind_id = $('#email_bind_id').val();

    if(bind_access_token.length == 0)
    {
        $('.empty_capt').css('display', 'block');

        return false;
    }

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'checkBindEmail'),
        data:{bind_access_token:bind_access_token, email_bind_id:email_bind_id},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {
                var result = data.data;

                str = result.bind_id;
                $('#email_span_unbind').css('display', 'none');
                $('#email_unbind').css('display', 'none');

                $('#email_span_bind').css('display', 'inline-block').html(str);


                $('#email_bind').css('display', 'block');

                $('.email .verify').css('display', 'none');
                $('.email .success').css('display', 'block');
                $('.tabbar_panel .mailtab2').removeClass('now');
                $('.tabbar_panel .mailtab3').addClass('now');

            }
            else
            {
                if(data.msg == 'checkMobile')
                {
                    $.fancybox.close();

                    $('#verity-change-mobile').click();
                }
                 else if(data.msg == 'checkEmail')
                {
                    $.fancybox.close();

                    $('#verity-change-email').click();
                }
                else
                {
                    $('.' + data.msg).css('display', 'block');
                }
            }
        }
    });

    return false;
})


//手机绑定验证
$(document).on('click', '.verify .mobile', function ()
{
    $('.err_tip').css('display', 'none');

    var bind_access_token = $('#bind_access_token').val();

    var mobile_bind_id = $('#mobile_bind_id').val();

    if(bind_access_token.length == 0)
    {
        $('.empty_capt').css('display', 'block');

        return false;
    }

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'checkBindMobile'),
        data:{bind_access_token:bind_access_token, mobile_bind_id:mobile_bind_id},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {
                var result = data.data;

                    str = result.bind_id;

                    $('#mobile_span_unbind').css('display', 'none');
                    $('#mobile_unbind').css('display', 'none');
                    $('#mobile_span_bind').css('display', 'inline-block').html(str);
                    $('#mobile_bind').css('display', 'block');

                    $('.mobile .verify').css('display', 'none');
                    $('.mobile .success').css('display', 'block');
                    $('.tabbar_panel .phonetab2').removeClass('now');
                    $('.tabbar_panel .phonetab3').addClass('now');

            }
            else
            {
                if(data.msg == 'checkMobile')
                {
                    $.fancybox.close();

                    $('#verity-change-mobile').click();
                }
                else if(data.msg == 'checkEmail')
                {
                    $.fancybox.close();

                    $('#verity-change-email').click();
                }
                else
                {
                    $('.' + data.msg).css('display', 'block');
                }
            }
        }
    });

    return false;
})

//修改手机
$(document).on('click', '#mobile-next', function ()
{

    $('.err_tip').css('display', 'none');

    var bind_id = $('#bind_id').val();
    var verify_code = $('#verify_code').val();
    var rand_key = $('#rand_key').val();
    var bind_type = 1;

    if (bind_id.length == 0)
    {
        $('.empty_phone').css('display', 'block');
        return false;
    }

    if(verify_code.length == 0)
    {
        $('.empty_capt').css('display', 'block');

        return false;
    }

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'checkVerify'),
        data:{bind_id:bind_id, verify_code:verify_code, rand_key:rand_key, bind_type:bind_type},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {
                var result = data.data;
                $('.mobile .phonestep1').css('display', 'none');
                $('.mobile .verify').css('display', 'block');
                $('#mobile_id').html(result.bind_id);
                $('#bind_id').val(result.bind_id);
                $('#mobile_bind_id').val(result.bind_id);
                $('.tabbar_panel .phonetab1').removeClass('now');
                $('.tabbar_panel .phonetab2').addClass('now');
            }
            else
            {
                $('.' + data.msg).css('display', 'block');
            }
        }
    });

    return false;
})

//发送短信
$(document).on('click', '.verify-sendbtn-mobile', function ()
{

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'message'),
        data:{},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {

                $('#verify-mod-sendTicketTip').css('display', 'none');
                $('#verify-mod-container').css('display', 'block');

                resetVerify();

            }
        }

    });

    return false;
})
//重新发送短信
$(document).on('click', '.verify-sendbtn-mobile-again', function ()
{

    var mobile_bind_id = $('#mobile_bind_id').val();
    var bind_type = 1;
    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'resend'),
        data:{bind_id:mobile_bind_id, bind_type:bind_type},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {
                 resetVerify();
            }
        }

    });

    return false;
})
//重新发送邮件
$(document).on('click', '.verify-sendbtn-email-again', function ()
{

    var email_bind_id = $('#email_bind_id').val()
    var bind_type = 2;

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'resend'),
        data:{bind_id:email_bind_id, bind_type:bind_type},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {
                resetVerify();
            }
        }

    });

    return false;
})

//短信确定
$(document).on('click', '#verify-mod-container .btn-submit', function(){

    var code = $('#mobile-check-code').val();

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'checkMobile'),
        data:{code:code},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {
                $.fancybox.close();

                if(data.msg == 'manageEmail')
                {
                    $('#email-manage').click();
                }
                else if (data.msg == 'managePasswd')
                {
                    $('#passwd-manage').click();
                }
                else
                {
                    $('#mobile-manage').click();
                }

            }
            else
            {
                //
                Public.tipMsg(data.msg);
            }
        }
    });

    return false;


});

//发送邮件

$(document).on('click', '.verify-sendbtn-email', function ()
{
    resetVerify();

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'email'),
        data:{},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {

                $('#verify-mod-sendTicketTip-email').css('display', 'none');
                $('#verify-mod-container-email').css('display', 'block');



            }
        }
    });


    return false;
})


//邮件确定
$(document).on('click', '#verify-mod-container-email .btn-submit', function(){

    var code = $('#email-check-code').val();

    $.ajax({
        type: "POST",
        url:sprintf("%s/account.php?ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Security', 'checkEmail'),
        data:{code:code},
        dataType:'json',
        async: false,
        error: function() {

        },
        success: function(data) {
            if(data.status == 200)
            {
                $.fancybox.close();
                if(data.msg == 'manageEmail')
                {
                    $('#email-manage').click();
                }
                else
                {
                    $('#mobile-manage').click();
                }
            }
            else
            {
                //
                Public.tipMsg(data.msg);
            }
        }
    });

    return false;

});

//换为邮件验证
$(document).on('click', '#verify-mobile', function()
{

    $.fancybox.close();

    $('#verity-change-email').click();

    return false;

});
//换为短信验证
$(document).on('click', '#verify-email', function()
{

    $.fancybox.close();

    $('#verity-change-mobile').click();

    return false;

});

function resetVerify()
{

    $('#send-verify-again').show();
    $('#send-verify').hide();

    var second = 60;
    var timer = null;

    timer = setInterval(function(){
        second -= 1;
        if(second >0 ){
            $('#send-again-span').html(second);
        }else{
            clearInterval(timer);
            $('#send-verify').show();
            $('#send-verify-again').hide();
        }
    },1000);

}





