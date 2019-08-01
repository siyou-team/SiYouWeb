$(function() {
    if (!ifLogin()){return}


    $.request({
        type:'get',
        url:SYS.URL.account.check_security_change,
        data:{},
        dataType:'json',
        success:function(result){
            if(result.status != 200){
            	errorTipsShow('<p>'+__('权限不足或操作超时')+'</p>');
            	setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_password_step1.html'",2000);
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
            password1: {
            	required:true,
            	equalTo : '#password'
            }
        },
        messages:{
        	password: {
            	required : __("请填写登录密码"),
            	minlength : __("请正确填写登录密码"),
            	maxlength : __("请正确填写登录密码")
            },
            password1 : {
            	required:__("请填写确认密码"),
            	equalTo : __('两次密码输入不一致')
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
            var password1 = $.trim($("#password1").val());
            $.request({
                type:'post',
                url:SYS.URL.account.reset_password,
                data:{password:password,password1:password1},
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                        $.sDialog({
                            skin:"block",
                            content:__('密码修改成功'),
                            okBtn:false,
                            cancelBtn:false
                        });
                    	setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_account.html'",2000);
                    }else{
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            });
        }

    });
});
