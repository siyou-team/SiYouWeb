$(function(){
    var key = getLocalStorage('ukey');
    if (key){
        location.href = WapSiteUrl+'/tmpl/member/member.html'
    }
    var channel = getQueryString("channel");
    var channel_verify_key = getQueryString("channel_verify_key");
    var channel_verify_code = getQueryString("channel_verify_code");

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
                url: SYS.URL.set_pwd,
                data: {
                    channel            : channel,
                    channel_verify_key : channel_verify_key,
                    channel_verify_code: channel_verify_code,
                    pwd           : password,
                    client             : 'wap'
                },
                dataType: 'json',
                success : function (result) {
                    if (result.status == 200) {
                        setLocalStorage('username', result.data.user_nickname);
                        setLocalStorage('ukey', result.data.key);
                        errorTipsShow("<p>" + ('重设密码成功，正在跳转...') + "</p>");
                        setTimeout("location.href = WapSiteUrl+'/tmpl/member/member.html'", 3000);
                    } else {
                        errorTipsShow("<p>" + result.msg + "</p>");
                    }
                }
            });         
        }
    });
});
