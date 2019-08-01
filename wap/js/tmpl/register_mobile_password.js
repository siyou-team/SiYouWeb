$(function(){
    var mobile = getQueryString("mobile");
    var captcha = getQueryString("captcha");
    
    // 显示密码
    $('#checkbox').click(function(){
        if ($(this).prop('checked')) {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });

    $.sValid.init({//注册验证
        rules:{
            password:"required"
        },
        messages:{
            password:__("密码必填!")
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide()
            }
        }  
    });
    
    $('#completebtn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var password = $("#password").val();
        if($.sValid()){
            $.request({
                type:'post',
                url:ApiUrl+"/index.php?act=connect&op=sms_register",  
                data:{phone:mobile, captcha:captcha, password:password, client:'wap'},
                dataType:'json',
                success:function(result){
                    if(result.status==200){
                        setLocalStorage('username',result.data.user_nickname);
                        setLocalStorage('ukey',result.data.key);
                        location.href = WapSiteUrl + '/tmpl/member/member.html';
                    }else{
                        errorTipsShow("<p>"+result.msg+"</p>");
                    }
                }
            });         
        }
    });
});


