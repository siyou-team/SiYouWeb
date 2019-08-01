$(function() {
    if (!ifLogin()){return}


    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });

    $.sValid.init({
        rules:{
            card_code:"required",
            captcha:"required"
        },
        messages:{
            card_code:__("请输入平台充值卡号"),
            captcha:__("请填写验证码")
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

    $('#saveform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }

        if($.sValid()){
            var card_code = $.trim($("#card_code").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            $.request({
                type:'post',
                url:SYS.URL.pay.addCard,
                data:{card_code:card_code,captcha:captcha,codekey:codekey},
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                        location.href = WapSiteUrl+'/tmpl/member/rechargecardlog_list.html';
                    }else{
                        loadSeccode();
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            });
        }
    });
});
