$(function(){
    var key = getLocalStorage('ukey');
    var return_id = getQueryString("refund_id");
    $.getJSON(ApiUrl+'/index.php?act=member_return&op=ship_form', {return_id:return_id}, function(result){
        //checkLogin(result.login);
        $('#delayDay').html(result.data.return_delay);
        $('#confirmDay').html(result.data.return_confirm);
        for (var i=0; i<result.data.express_list.length; i++) {
            $('#express').append('<option value="'+result.data.express_list[i].express_id+'">'+result.data.express_list[i].express_name+'</option>');
        }
        

        $('.btn-l').click(function(){
            var _form_param = $('form').serializeArray();
            var param = {};
            param.key = key;
            param.return_id = return_id;
            for (var i=0; i<_form_param.length; i++) {
                param[_form_param[i].name] = _form_param[i].value;
            }
            if (param.invoice_no == '') {
                $.sDialog({
                    skin:"red",
                    content:__('请填写快递单号'),
                    okBtn:false,
                    cancelBtn:false
                });
                return false;
                
            }
            // 发货表单提交
            $.request({
                type:'post',
                url:ApiUrl+'/index.php?act=member_return&op=ship_post',
                data:param,
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