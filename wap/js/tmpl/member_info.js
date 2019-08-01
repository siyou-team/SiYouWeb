$(function() {
    var showtype=getQueryString("showtype");
    if (!ifLogin()){return}
    //取数据

    $.request({
        type: "post",
        url: SYS.URL.user.overview,
        data: {},
        dataType: "json",
        success: function(res) {
            if(res.status==250){

                return;
            }

            $("#user_id").val(res.data.base.user_id);
            $("#user_account").val(res.data.base.user_account);
            $("#user_nickname").val(res.data.base.user_nickname);

            var avatar = res.data.member_info.user_avatar.replace(/http:\/\//, "\/\/").replace(/https:\/\//, "\/\/");

            $("#user_avatar").val(res.data.member_info.user_avatar).prev('a').append('<div class="pic-thumb"><img src="'+ avatar +'"/></div>');
            $("#user_sign").val(res.data.member_info.user_sign);
            $("#user_birthday").val(res.data.member_info.user_birthday);

        }
    });

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

    $("#header-nav").click(function() {
        $(".btn").click()
    });

    $(".btn").click(function() {

        var user_nickname = $("#user_nickname").val();
        var user_avatar = $("#user_avatar").val();
        var user_sign = $("#user_sign").val();
        var user_birthday = $("#user_birthday").val();

        $.request({
            type: "post",
            url: SYS.URL.account.edit_user_info,
            data: {
                user_nickname: user_nickname,
                user_avatar: user_avatar,
                user_sign:user_sign,
                user_birthday: user_birthday
            },
            dataType: "json",
            success: function(a) {
                if (a&&a.status==200) {
                    $.sDialog({
                        skin: "red",
                        content: __("编辑成功"),
                        okBtn: true,
                        cancelBtn: false,
                        okFn:function(){localStorage.clear();window.location.href = WapSiteUrl + "/tmpl/member/member.html";},
                        cancelBtn: false
                    });
                } else {
                    $.sDialog({
                        skin: "red",
                        content: __("编辑失败")+JSON.stringify(a),
                        okBtn: false,
                        cancelBtn: false
                    });
                }
            }
        })

    });

});