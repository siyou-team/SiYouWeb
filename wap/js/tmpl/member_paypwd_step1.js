$(function() {
    if (!ifLogin()){return}


    verifyUtils.imageVerifyCode($('#codeimage'), $('#codekey'));


    $.request({
        type:'get',
        url:SYS.URL.account.get_mobile_info,
        data:{},
        dataType:'json',
        success:function(result){

            if(result.status == 200){
                if (-1 != $.inArray(User_BindConnectModel.MOBILE, result.data.bind_type_row)) {
                    $('#mobile').html(result.data[User_BindConnectModel.MOBILE]);
                } else {
                    location.href = WapSiteUrl+'/tmpl/member/member_mobile_bind.html';
                }
            }
        }
    });

    $('#send').click(function(){
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            var mobile = $.trim($("#mobile").html());

            $.request({
                type:'post',
                url:SYS.URL.account.get_mobile_checkcode,
                data:{image_value:captcha,image_key:codekey, mobile:mobile},
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                    	$('#send').hide();
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
                            } else {
                                em.html(t);
                            }
                        },1000);
                    }else{
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            });
    });

    $('#nextform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var auth_code = $.trim($("#auth_code").val());
        if (auth_code) {
            $.request({
                type:'post',
                url:SYS.URL.account.check_mobile_code,
                data:{code:auth_code},
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                        $.sDialog({
                            skin:"block",
                            content:__('手机验证成功，正在跳转'),
                            okBtn:false,
                            cancelBtn:false
                        });
                    	setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_paypwd_step2.html'",1000);
                    }else{
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            });
        }
    });
});
