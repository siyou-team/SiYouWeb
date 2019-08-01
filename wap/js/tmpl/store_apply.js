$(function() {

    if (!ifLogin()){return}

    var address_id = getQueryString('address_id');
    var ud_id = address_id;
    var key = getLocalStorage('ukey');

    $.request({
        type: 'post',
        url: SYS.URL.user.joinIn.replace(/typ=e/, "typ=json"),
        data: {
        },
        dataType: 'json',
        success: function(result) {

            if (result.status != 200)
            {
                $.sDialog({
                    skin: "red",
                    content: result.msg,
                    okBtn: false,
                    cancelBtn: false
                });
            }

            var obj = $('#store_category_id');

            $.each(result.data.store_category_rows, function (i, v) {

                if (result.data.store.store_category_id)
                {
                    obj.append(new Option(v.store_category_name, v.store_category_id, true, true));
                }
                else
                {
                    obj.append(new Option(v.store_category_name, v.store_category_id, false, true));
                }

                //添加一个选项
                //obj.options.add(new Option(v.store_category_name, v.store_category_id)); //这个兼容IE与firefox
            })


            $('#store_name').val(result.data.store.store_name);
            $('#store_o2o_flag').val(result.data.store.store_o2o_flag);
            $('#store_category_id').val(result.data.store.store_category_id);


            $('#company_name').val(result.data.company.company_name);
            $('#bank_account_name').val(result.data.company.bank_account_name);
            $('#bank_name').val(result.data.company.bank_name);
            $('#bank_account_number').val(result.data.company.bank_account_number);
            $('#contacts_name').val(result.data.company.contacts_name);
            $('#contacts_phone').val(result.data.company.contacts_phone);
            $('#company_address').val(result.data.company.company_address);

            $("#business_license_electronic").val(result.data.company.business_license_electronic).prev('a').append('<div class="pic-thumb"><img src="'+result.data.company.business_license_electronic+'"/></div>');
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

    $.sValid.init({
        rules:{
            store_o2o_flag:"required",
            store_name:"required",
            store_category_id:"required",
            company_name:"required",
            //bank_account_name:"required",
            bank_name:"required",
            bank_account_number:"required",
            contacts_name:"required",
            contacts_phone:"required",
            company_address:"required"
        },
        messages:{

            store_o2o_flag:__("入驻类型必填！"),
            store_name:__("店铺名称必填！"),
            company_name:__("公司名称必填！"),
            store_category_id:__("经营类目必填！"),
            //bank_account_name:"公司名称必填！",
            bank_name:__("开户银行必填！"),
            bank_account_number:__("银行账户必填！"),
            contacts_name:__("企业联系人必填！"),
            contacts_phone:__("联系人手机必填！"),
            company_address:__("企业地址必填！")
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
    $('.btn').click(function() {
        if($.sValid()){
            var params = $('#form-name').serialize()

            var business_license_electronic = $("#business_license_electronic").val();


            if (!business_license_electronic)
            {
                $.sDialog({
                    skin: "red",
                    content: __('营业执照不能为空！'),
                    okBtn: false,
                    cancelBtn: false
                });
                return
            }


            $.request({
                type: 'post',
                url: SYS.URL.store.add,
                data: params,
                dataType: 'json',
                success: function(result) {
                    if (result && result.status == 200) {
                        delLocalStorage('username');
                        delLocalStorage('uid');
                        delLocalStorage('ukey');
                        delLocalStorage('rid');
                        delLocalStorage('cart_count');
                        delLocalStorage('as');

                        delCookie('username');
                        delCookie('uid');
                        delCookie('ukey');
                        delCookie('rid');
                        delCookie('cart_count');
                        delCookie('as');


                        location.href = WapSiteUrl + '/tmpl/member/member.html';
                    } else {
                        //location.href = WapSiteUrl;
                        $.sDialog({
                            skin: "red",
                            content: result.msg,
                            okBtn: false,
                            cancelBtn: false
                        });
                    }
                }
            });
        }
    });
});