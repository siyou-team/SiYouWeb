var order_id,order_item_id,goods_pay_price,goods_num;
$(function(){
    if (!ifLogin()){return}

    $.getJSON(SYS.URL.user.return_item,{order_id:getQueryString('order_id'),order_item_id:getQueryString('order_item_id')}, function(result) {

        //result.data.WapSiteUrl = WapSiteUrl;
        $('#order-info-container').html(template.render('order-info-tmpl',result.data));

        order_id = result.data.order.order_id;
        order_item_id = result.data.goods.order_item_id;

        // 退款原因
        var _option = '';
        for (var k in result.data.reason_list) {
            _option += '<option value="' + result.data.reason_list[k].return_reason_id + '">' + result.data.reason_list[k].return_reason_name + '</option>'
        }
        $('#refundReason').append(_option);

        // 可退金额
        order_item_payment_amount = result.data.goods.order_item_payment_amount;
        $('input[name="refund_amount"]').val(order_item_payment_amount);
        $('#returnAble').html('￥'+order_item_payment_amount);

        // 可退数量
        order_item_quantity = result.data.goods.order_item_quantity;
        $('input[name="goods_num"]').val(order_item_quantity);
        $('#goodsNum').html(__('最多') + order_item_quantity + __('件'));



        // 图片上传
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


        $('.btn-l').click(function(){
            var _form_param = $('form').serializeArray();
            var param = {};
            param.key = getLocalStorage('ukey');
            param.order_id = order_id;
            param.order_item_id = order_item_id;
            param.refund_type = 2;
            for (var i=0; i<_form_param.length; i++) {
                param[_form_param[i].name] = _form_param[i].value;
            }
            if (isNaN(parseFloat(param.return_refund_amount)) || parseFloat(param.return_refund_amount) > parseFloat(order_item_payment_amount) || parseFloat(param.return_refund_amount) == 0) {
                $.sDialog({
                    skin:"red",
                    content:__('退款金额不能为空，或不能超过可退金额'),
                    okBtn:false,
                    cancelBtn:false
                });
                return false;
            }
            if (param.return_buyer_message.length == 0) {
                $.sDialog({
                    skin:"red",
                    content:__('请填写退款说明'),
                    okBtn:false,
                    cancelBtn:false
                });
                return false;
            }

            // 退货申请提交
            $.request({
                type:'post',
                url: SYS.URL.user.return_add_one,
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