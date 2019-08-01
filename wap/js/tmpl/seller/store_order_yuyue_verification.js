$(function() { 
    var a = getLocalStorage('ukey');

    $("#header-nav .scan").click(function() {
        $("#scan_btn").click()
    });

    $("#scan_btn").click(function() {
        alert(__('环境暂不支持扫码操作！'))
    });

    $(".btn").click(function() {
            if ($(this).parent().hasClass('ok'))
            {
                var chain_code = $("#chain_code").val();
                $.request({
                    type: "post",
                    url: SYS.URL.seller.order_get_by_pickupcode,
                    data: {
                        chain_code: chain_code
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200)
                        {
                            $.sDialog({skin: "red", content: __('预约不存在'), okBtn: false, cancelBtn: false});
                        }
                        else
                        {
                            Public.tips({type: 2, content: __('预约不存在！')});
                        }
                    },
                    error: function (err, status)
                    {
                        Public.tips({type: 2, content: __('操作无法成功，请稍后重试！')});
                    }
                })
            }
         
    });
    
});