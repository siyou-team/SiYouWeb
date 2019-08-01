$(function(){
    if (!ifLogin()){return}



    $.request({
        type: 'post',
        url: SYS.URL.user.msg_user_lists,
        data: {recent:1},
        dataType:'json',
        success: function(result){
            var data = result.data;

            //渲染模板
            $("#messageList").html(template.render('messageListScript', data));

            $('.msg-list-del').click(function(){
                var user_other_id = $(this).attr('user_other_id');
                $.request({
                    type: 'post',
                    url: SYS.URL.user.msg_remove_user,
                    data: {user_other_id:user_other_id},
                    dataType:'json',
                    success: function(result){
                        if (result.status == 200) {
                            location.reload();
                        } else {
                            $.sDialog({
                                skin:"red",
                                content:result.msg,
                                okBtn:false,
                                cancelBtn:false
                            });
                            return false;
                        }
                    }
                });
            });
        }
    });
});