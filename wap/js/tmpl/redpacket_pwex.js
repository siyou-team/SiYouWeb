$(function() {
    if (!ifLogin()){return}


    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });
    
    $.sValid.init({
        rules:{
            pwd_code:"required",
            captcha:"required"
        },
        messages:{
            pwd_code:__("请填写红包卡密"),
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
            var pwd_code = $.trim($("#pwd_code").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            $.request({
                type:'post',
                url:ApiUrl+"/index.php?act=member_redpacket&op=rp_pwex",
                data:{pwd_code:pwd_code,captcha:captcha,codekey:codekey},
                dataType:'json',
                success:function(result){
                    if(result.status == 200){
                        location.href = WapSiteUrl+'/tmpl/member/redpacket_list.html';
                    }else{
                        loadSeccode();
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            });
        }
    });
});
