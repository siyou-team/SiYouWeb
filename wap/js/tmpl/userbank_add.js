$(function(){

    $.sValid.init({
        rules:{
            user_bank_card_address:"required",
            user_bank_card_code:"required",
            user_bank_card_name:"required",
            user_bank_card_mobile:"required"
        },
        messages:{
            user_bank_card_address:__("开户行地址必填！"),
            user_bank_card_code:__("银行卡卡号必填！"),
            user_bank_card_name:__("持卡人姓名必填！"),
            user_bank_card_mobile:__("手机号必填！")
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
    $('#header-nav').click(function(){
        $('.btn').click();
    });

    $.ajax({
        type: 'post',
        url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=UserBank&typ=json',
        dataType: 'json',
        success: function(result) {

            var option = '<option value="">'+__('请选择绑定银行') + '</option>';
            $.each(result.data.bank_list,function(k,v){
                option+='<option value="'+v.bank_id+'" id="bank_name">'+v.bank_name+'</option>';
            });
            $("#bank_id").html(option);
        }
    })

    $('#J_submit').on('click', function(e) {
        if ($.sValid()) {
            var bank_id   = $('#bank_id').val();
            var bank_name = $("#bank_id option:selected").text();
            var user_bank_card_address = $('#user_bank_card_address').val();
            var user_bank_card_code    = $('#user_bank_card_code').val();
            var user_bank_card_name    = $('#user_bank_card_name').val();
            var user_bank_card_mobile  = $('#user_bank_card_mobile').val();

            $.request({
                type: 'post',
                url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=addUserBank&typ=json',
                data: {
                    bank_id: bank_id,
                    bank_name: bank_name,
                    user_bank_card_address: user_bank_card_address,
                    user_bank_card_code: user_bank_card_code,
                    user_bank_card_name: user_bank_card_name,
                    user_bank_card_mobile: user_bank_card_mobile
                },
                dataType: 'json',
                success: function (result) {
                    if (result.status == 200) {

                        window.location.href = WapSiteUrl + '/tmpl/member/userbank_list.html';
                    } else {
                        window.location.href = WapSiteUrl + '/tmpl/member/userbank_list.html';
                    }
                }
            });
        }
    })
});