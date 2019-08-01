$(function() {
    if (!ifLogin()){return}


    $.request({
        type:'get',
        url:SYS.URL.pay.get_pay_passwd,
        data:{},
        dataType:'json',
        success:function(result){
            if(result.status == 250){
                //url直接直接设置为非手机验证修改密码
                $('#old_pay_password_box').remove();
            }else{
            }
        }
    });


    $.sValid.init({
        rules:{
            old_pay_password: {
                required:true
            },
            new_pay_password: {
                required:true,
                minlength:6,
                maxlength:20
            },
            password1: {
                required:true,
                equalTo : '#new_pay_password'
            }
        },
        messages:{
            old_pay_password: {
                required : __("请填写原支付密码")
            },
            new_pay_password: {
                required : __("请填写新支付密码"),
                minlength : __("支付密码长度必须大于6为"),
                maxlength : __("支付密码长度必须小于20")
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
                url:SYS.URL.pay.change_paypasswd,
                data:params,
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                        $.sDialog({
                            skin:"block",
                            content:__('支付密码修改成功'),
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
