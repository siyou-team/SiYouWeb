$(function(){
    if (!ifLogin()){return}
    var order_id = getQueryString('order_id');

    $.getJSON(SYS.URL.user.order_comment_manage, { order_id:order_id}, function(result){
        if (result.status != 200) {
            $.sDialog({
                skin:"red",
                content:result.msg,
                okBtn:true,
                cancelBtn:true,
                okFn: function() {
                    window.location.href = WapSiteUrl + '/tmpl/member/order_list.html';
                },
                cancelFn:function () {
                    window.location.href = WapSiteUrl + '/tmpl/member/order_list.html';
                }
            });
            return false;
        }

        var html = template.render('member-evaluation-script', result.data);
        $("#member-evaluation-div").html(html);
        
        $('input[name="upfile"]').ajaxUploadImage({
            url : SYS.URL.upload,
            data:{},
            start :  function(element){
                element.parent().after('<div class="upload-loading"><i></i></div>');
                element.parent().siblings('.pic-thumb').remove();
            },
            success : function(element, result){
                //checkLogin(result.login);
                if (result.status != 200) {
                    element.parent().siblings('.upload-loading').remove();
                    $.sDialog({
                        skin:"red",
                        content:__('图片尺寸过大！'),
                        okBtn:false,
                        cancelBtn:false
                    });
                    return false;
                }
                element.parent().after('<div class="pic-thumb"><img src="'+result.data.url+'"/></div>');
                element.parent().siblings('.upload-loading').remove();
                element.parents('a').next().val(result.data.url);
            }
        });

        // 星星选择
        $('.star-level').find('i').click(function(){
            var _index = $(this).index();
            for (var i=0; i<5; i++) {
                var _i = $(this).parent().find('i').eq(i);
                if (i<=_index) {
                    _i.removeClass('star-level-hollow').addClass('star-level-solid');
                } else {
                    _i.removeClass('star-level-solid').addClass('star-level-hollow');
                }
            }
            $(this).parent().next().val(_index + 1);
        });
        
        $('.btn-l').click(function(){
            var _form_param = $('form').serializeArray();
            var param = {};
            //param.key = key;
            param.order_id = order_id;
            for (var i=0; i<_form_param.length; i++) {
                param[_form_param[i].name] = _form_param[i].value;
            }
            $.request({//获取区域列表
                type:'post',
                url:SYS.URL.user.order_comment_add,
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

                    window.location.href = WapSiteUrl + '/tmpl/member/order_list.html';
                }
            });
        });
    });
    
});

