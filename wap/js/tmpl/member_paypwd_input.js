$(function() {
    if (!ifLogin()){return}

    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });

    $.request({
        type:'get',
        url:ApiUrl+"/index.php?act=member_account&op=get_paypwd_info",
        data:{},
        dataType:'json',
        success:function(result){
            if(result.status == 200){
            	if(!result.data.state){
            		errorTipsShow('<p>'+__('请先设置支付密码')+'</p>');
            		setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_paypwd_step1.html'",2000);
            	}
            }
        }
    });

    $.sValid.init({
        rules:{
            password: {
            	required:true,
            	minlength:6,
            	maxlength:20
            },
            captcha: {
            	required:true,
            	minlength:4
            }
        },
        messages:{
        	password: {
            	required : __("请填写支付密码"),
            	minlength : __("请正确填写支付密码"),
            	maxlength : __("请正确填写支付密码")
            },
            captcha: {
            	required : __("请填写图形验证码"),
            	minlength : __("图形验证码不正确")
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

    $('#nextform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        if($.sValid()){
            var password = $.trim($("#password").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            $.request({
                type:'post',
                url:ApiUrl+"/index.php?act=member_account&op=check_paypwd",
                data:{password:password,captcha:captcha,codekey:codekey},
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                    	location.href = WapSiteUrl+'/tmpl/member/member_mobile_bind.html';
                    }else{
                        errorTipsShow('<p>' + result.msg + '</p>');
                        $("#codeimage").attr('src',ApiUrl+'/index.php?act=seccode&op=makecode&k='+$("#codekey").val()+'&t=' + Math.random());
                        $('#captcha').val('');
                    }
                }
            });
        }

    });
});
