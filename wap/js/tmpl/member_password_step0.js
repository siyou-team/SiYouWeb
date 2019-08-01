$(function() {
    if (!ifLogin()){return}

    $.sValid.init({
        rules:{
            old_password: {
                required:true
            },
            new_password: {
                required:true,
                minlength:6,
                maxlength:20
            },
            password1: {
                required:true,
                equalTo : '#new_password'
            }
        },
        messages:{
            old_password: {
                required : __("请填写原登录密码")
            },
            new_password: {
                required : __("请填写新登录密码"),
                minlength : __("登录密码长度必须大于6为"),
                maxlength : __("登录密码长度必须小于20")
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
            var params = $('#form-name').serialize()


            $.request({
                type:'post',
                url:SYS.URL.account.change_password,
                data:params,
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
