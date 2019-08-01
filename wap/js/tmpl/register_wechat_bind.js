$(function() {
    var key = getLocalStorage('ukey');
    if (!key) {
        checkLogin(0, $callback);
        return false;
    }
    else {
        //判断是否绑定的确
        var as = getLocalStorage('as');

        if (as && parseInt(as))
        {
            //进入绑定页面
            window.location.href = WapSiteUrl

        }
        else
        {
        }
    }

    //加载验证码
    //loadSeccode();
    $("#refreshcode").bind('click',function(){
        //loadSeccode();
    });

    $('#mobile').on('blur',function(){
        if ($(this).val() != '' && ! /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {
            $(this).val(/\d+/.exec($(this).val()));
        }
    });


    verifyUtils.imageVerifyCode($('#codeimage'), $('#codekey'));

    /*
    $.request({
        type:'get',
        url:SYS.URL.account.get_mobile_info,
        data:{},
        dataType:'json',
        success:function(result){
            if(result.status == 200){

                if (-1 != $.inArray(User_BindConnectModel.MOBILE, result.data.bind_type_row)) {
                    $.request({
                        type:'get',
                        url:SYS.URL.account.check_security_change,
                        data:{},
                        dataType:'json',
                        success:function(result){
                            if(result.status != 200){
                                errorTipsShow('<p>权限不足或操作超时</p>');
                                setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_mobile_modify.html'",2000);
                            }
                        }
                    });
                } else {
                    $('#mobile').val(result.data[User_BindConnectModel.MOBILE]);
                }
            }
        }
    });
    */

    $.sValid.init({
        rules:{
            /*captcha: {
            	required:true,
            	minlength:4
            },
			*/
            mobile: {
                required:true,
                mobile:true
            }
        },
        messages:{
            /*
            captcha: {
                required : "请填写图形验证码",
                minlength : "图形验证码不正确"
            },
            */
            mobile: {
                required : __("请填写手机号"),
                mobile : __("手机号码不正确")
            }
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

    $('#send').click(function(){
        if($.sValid()){
            var mobile = $.trim($("#mobile").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            $.request({
                type:'post',
                url:SYS.URL.account.get_mobile_checkcode,
                data:{mobile:mobile,image_value:captcha,image_key:codekey},
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
    });
    $('#nextform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }


        var params = $('#form-name').serialize()

        var mobile = $.trim($("#mobile").val());
        var auth_code = $.trim($("#auth_code").val());
        if (auth_code) {
            $.request({
                type:'post',
                url:SYS.URL.register_wechat_account,
                data:params,
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                        $.sDialog({
                            skin:"block",
                            content:__('绑定成功'),
                            okBtn:false,
                            cancelBtn:false
                        });
                        setTimeout("location.href = '" + WapSiteUrl + "/tmpl/member/member_account.html'",2000);
                    }else{
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            });
        }
    });


    // 选择地区
    $('#district_info').on('click', function(){
        $.areaSelected({
            success : function(data){
                $('#district_info').val(data.district_info).attr({'data-areaid':data.district_id, 'data-areaid1':data.district_id_1,  'data-areaid2':data.district_id_2});

                $('#user_province_id').val(data.district_id_1)
                $('#user_city_id').val(data.district_id_2)
                $('#user_county_id').val(data.district_id_3)

                writeClear($('#district_info'));
            }
        });
    });
});
