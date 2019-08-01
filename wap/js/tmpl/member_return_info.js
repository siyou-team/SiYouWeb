$(function(){
    var key = getLocalStorage('ukey');
    var return_id = getQueryString("return_id") ? getQueryString("return_id") : -1;

    $.getJSON(sprintf("%s?ctl=%s&met=%s&typ=json", SYS.CONFIG.index_url, 'User_Return', 'get'), {return_id:return_id}, function(result){
        $('#return-info-div').html(template.render('return-info-script', result.data));

        $('.cancel-return').click(function(){
            // 发货表单提交
            $.request({
                type:'post',
                url: ApiUrl+'/index.php?ctl=User_Return&met=cancel&typ=json',
                data:{return_id:return_id},
                dataType:'json',
                async:false,
                success:function(result){
                    //checkLogin(result.login);
                    if (result.status != 200) {
                        $.sDialog({
                            skin:"red",
                            content:result.msg,
                            okBtn:false,
                            cancelBtn:false
                        });
                        return false;
                    }
                    window.location.href = WapSiteUrl + '/tmpl/member/member_return.html';
                }
            });
        });
        $('.confirm-refund').click(function(){
            // 发货表单提交
            $.request({
                type:'post',
                url: ApiUrl+'/index.php?ctl=User_Return&met=cancel&typ=json',
                data:{return_id:return_id},
                dataType:'json',
                async:false,
                success:function(result){
                    //checkLogin(result.login);
                    if (result.status != 200) {
                        $.sDialog({
                            skin:"red",
                            content:result.msg,
                            okBtn:false,
                            cancelBtn:false
                        });
                        return false;
                    }
                    window.location.href = WapSiteUrl + '/tmpl/member/member_return.html';
                }
            });
        });
    });
});