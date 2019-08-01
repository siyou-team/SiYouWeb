$(function(){
    var key = getLocalStorage('ukey');
    if (key){
        location.href = WapSiteUrl+'/tmpl/member/member.html'
    }
    // 发送手机验证码
    var $user_account = getQueryString("user_account");
    var $verify_code = getQueryString("captcha");
    var $rand_key = getQueryString("codekey");
    window.channel_verify_key = 0;
    window.channel = "", window.user_id = 0;


    getUserBindChannel($user_account, $verify_code, $rand_key);
    $('#send').click(function(){
        console.info(window.channel)
        if (window.channel == 'mobile') {
            send_mobile(window.channel_verify_key);
        }
        if (window.channel == 'email') {
            send_email(window.channel_verify_key);
        }
    });
    
    $('#find_password_code').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var captcha = $('#mobilecode').val();
        if (captcha.length == 0) {
            errorTipsShow('<p>'+__('请填写验证码')+'<p>');
        }
        check_sms_captcha(channel_verify_key, captcha);
        return false;
        
    });

    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });
});
function getUserBindChannel($user_account, $verify_code, $rand_key) {
    $.getJSON(ApiUrl+'/account.php?ctl=Login&met=findpwdStepTwo&typ=json', {step:2,verify_code:$verify_code,rand_key:$rand_key,user_account:$user_account}, function(result){
        if (result.status == 200) {
            window.channel_verify_key = result.data.channel_verify_key;
            window.channel = result.data.channel;
            window.user_id = result.data.user_id;
            if (result.data.channel == 'mobile') {
                $("#user_mobile").removeClass('hide').find('em').html(result.data.channel_verify_key);
            } else if (result.data.channel == 'email') {
                $("#user_email").removeClass('hide').find('em').html(result.data.channel_verify_key);
            } else {
                $("#user_not_bind").removeClass('hide');
            }
        } else {
            loadSeccode();
            errorTipsShow('<p>' + result.msg + '<p>');
        }
    });
}
// 发送手机验证码
function send_mobile(channel_verify_key) {
    var mobile = channel_verify_key;
    $.request({
        type:'post',
        url:SYS.URL.account.get_mobile_checkcode,
        data:{mobile:mobile},
        dataType:'json',
        success:function(result){
            if(result.status == 200) {
                $('#send').hide();
                $('#auth_code').removeAttr('readonly');
                $('.code-countdown').show().find('em').html(result.data.sms_time);
                $.sDialog({
                    skin:"block",
                    content:__('短信验证码已发出'),
                    okBtn:false,
                    cancelBtn:false
                });
                var times_Countdown = setInterval(function(){
                    var em = $('.code-countdown').find('em');
                    var t = parseInt(em.html() - 1);
                    if (t == 0) {
                        $('#send').show();
                        $('.code-countdown').hide();
                        clearInterval(times_Countdown);
                        //$("#codeimage").attr('src',ApiUrl+'/index.php?act=seccode&op=makecode&k='+$("#codekey").val()+'&t=' + Math.random());
                        //$('#captcha').val('');
                    } else {
                        em.html(t);
                    }
                },1000);
            }
            else
            {
                errorTipsShow('<p>' + result.msg + '</p>');
                //$("#codeimage").attr('src',ApiUrl+'/index.php?act=seccode&op=makecode&k='+$("#codekey").val()+'&t=' + Math.random());
                //$('#captcha').val('');
            }
        }
    });
}

// 发送手机验证码
function send_email(channel_verify_key) {
    var email = channel_verify_key;
    $.request({
        type    : 'post',
        url     : SYS.URL.account.get_email_checkcode,
        data    : {email: email},
        dataType: 'json',
        success:function(result){
            if(result.status == 200) {
                $('#send').hide();
                $('#auth_code').removeAttr('readonly');
                $('.code-countdown').show().find('em').html(result.data.sms_time);
                $.sDialog({
                    skin:"block",
                    content:__('邮箱验证码已发出'),
                    okBtn:false,
                    cancelBtn:false
                });
                var times_Countdown = setInterval(function(){
                    var em = $('.code-countdown').find('em');
                    var t = parseInt(em.html() - 1);
                    if (t == 0) {
                        $('#send').show();
                        $('.code-countdown').hide();
                        clearInterval(times_Countdown);
                        //$("#codeimage").attr('src',ApiUrl+'/index.php?act=seccode&op=makecode&k='+$("#codekey").val()+'&t=' + Math.random());
                        //$('#captcha').val('');
                    } else {
                        em.html(t);
                    }
                },1000);
            }
            else
            {
                errorTipsShow('<p>' + result.msg + '</p>');
                //$("#codeimage").attr('src',ApiUrl+'/index.php?act=seccode&op=makecode&k='+$("#codekey").val()+'&t=' + Math.random());
                //$('#captcha').val('');
            }
        }
    });
}

function check_sms_captcha(channel_verify_key, channel_verify_code) {
    $.getJSON(SYS.URL.check_mobile_or_email, {user_id: window.user_id,channel:window.channel,channel_verify_key:channel_verify_key,channel_verify_code:channel_verify_code }, function(result){
        if (result.status==200) {
            window.location.href = 'find_password_password.html?channel=' + window.channel + '&channel_verify_key=' + channel_verify_key + '&channel_verify_code=' + channel_verify_code;
        } else {
            loadSeccode();
            errorTipsShow('<p>' + result.msg + '<p>');
        }
    });
}