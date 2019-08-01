$(function() {
    var showtype=getQueryString("showtype");
    if (!ifLogin()){return}
    //取数据



    $.request({
        type: "post",
        url:  SYS.URL.account.certificate.replace(/typ=e/, "typ=json"),
        data: {},
        dataType: "json",
        success: function(res) {
            if(res.status==200){
                $("#user_realname").val(res.data.user_realname);
                $("#user_idcard").val(res.data.user_idcard);
                $("#user_idcard_images_0").val(res.data.user_idcard_images[0]).prev('a').append('<div class="pic-thumb"><img src="'+res.data.user_idcard_images[0]+'"/></div>');
                $("#user_idcard_images_1").val(res.data.user_idcard_images[1]).prev('a').append('<div class="pic-thumb"><img src="'+res.data.user_idcard_images[1]+'"/></div>');


                if (1 == res.data.user_certification)
                {
                    $('.form-btn').removeClass('ok');
                    $('.btn').html(__('审核通过，不可修改'));
                }
                else
                {
                    $('.form-btn').addClass('ok');
                }
            }

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


    $.sValid.init({
        rules:{
            user_realname:"required",
            user_idcard:"required"
            //bank_account_name:"required",
            //user_idcard_images_1:"required"
        },
        messages:{

            user_realname:__("真实姓名必填！"),
            user_idcard:__("身份证号码必填！")
            //bank_account_name:"公司名称必填！",
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


    $(".btn").click(function() {

        if($.sValid())
        {
            var user_realname = $("#user_realname").val();
            var user_idcard = $("#user_idcard").val();

            var user_idcard_images_0 = $("#user_idcard_images_0").val();
            var user_idcard_images_1 = $("#user_idcard_images_1").val();


            if (!user_idcard_images_0)
            {
                $.sDialog({
                    skin: "red",
                    content: __('身份证正面图片不能为空'),
                    okBtn: false,
                    cancelBtn: false
                });
                return
            }


            if (!user_idcard_images_1)
            {
                $.sDialog({
                    skin: "red",
                    content: __('身份证反面图片不能为空'),
                    okBtn: false,
                    cancelBtn: false
                });
                return
            }


            $.request({
                type: "post",
                url: SYS.URL.account.commit_certificate,
                data: {
                    user_realname: user_realname,
                    user_idcard: user_idcard,
                    'user_idcard_images[0]': user_idcard_images_0,
                    'user_idcard_images[1]': user_idcard_images_1
                },
                dataType: "json",
                success: function (a) {
                    if (a && a.status == 200)
                    {
                        $.sDialog({
                            skin: "red",
                            content: __("编辑成功"),
                            okBtn: true,
                            okFn: function () {
                                window.location.href = WapSiteUrl + "/tmpl/member/member.html";
                            },
                            cancelBtn: false
                        });
                    }
                    else
                    {
                        $.sDialog({
                            skin: "red",
                            content: __("编辑失败") + JSON.stringify(a),
                            okBtn: false,
                            cancelBtn: false
                        });
                    }
                }
            })
        }
    });

});