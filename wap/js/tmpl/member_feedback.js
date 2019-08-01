$(function(){
    if (!ifLogin()){return}

    $('#feedbackbtn').click(function(){
        var feedback = $('#feedback').val();
        if (feedback == '') {
            $.sDialog({
                skin:"red",
                content:__('请填写反馈内容'),
                okBtn:false,
                cancelBtn:false
            });
            return false;
        }
        $.request({
            url:ApiUrl+"/index.php?act=member_feedback&op=feedback_add",
            type:"post",
            dataType:"json",
            data:{ feedback:feedback},
            success:function (result){
                if(checkLogin(result.login)){
                    if(result.status==200){
                        errorTipsShow('<p>' + __('提交成功') + '</p>');

                        setTimeout(function(){
                            window.location.href = WapSiteUrl + '/tmpl/member/member.html';
                        }, 3000);
                    }else{
                        errorTipsShow('<p>' + result.msg + '</p>');
                    }
                }
            }
        });
    });
});