$(function(){
    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });
    
    $.sValid.init({//注册验证
        rules:{
            user_account:{
                required:true,
            }
        },
        messages:{
            user_account:{
                required:__("请输入用户名！"),
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
    
	$('#find_password_btn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
	    if ($.sValid()) {
	        $(this).attr('href', 'find_password_code.html?user_account=' + $('#user_account').val() + '&captcha=' + $('#captcha').val() + '&codekey=' + $('#codekey').val());
	    } else {
	        return false;
	    }
	});
});