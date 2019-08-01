$(function() {
    var showtype=getQueryString("showtype");
    if (!ifLogin()){return}

    $("#header-nav .scan").click(function() {
        $("#scan_btn").click()
    });

/*    $("#scan_btn").click(function() {
        alert('环境暂不支持扫码操作！')
    });*/

    $(".J_search").click(function() {
        if ($(this).parent().hasClass('ok'))
        {
            var pickup_code = $("#pickup_code").val();
            $.request({
                type: "post",
                url: SYS.CONFIG.URL.seller.order_get_by_pickupcode,
                data: {
                    chain_code: pickup_code
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 200)
                    {
                        var order_data = jQuery.extend({}, res);

                        order_data['pickup_code'] = pickup_code;


                        var html = template.render("order-detail-tmpl", order_data);

                        $('#order-detail').html(html);

                    }
                    else
                    {
                        Public.tips({type: 2, content: __('货物不存在！')});
                    }
                },
                error: function (err, status)
                {
                    Public.tips({type: 2, content: __('操作无法成功，请稍后重试！')});
                }
            })
        }

    });


    function scanPickupCode(pickupcode)
    {
        $('#pickup_code').val(pickupcode);
        $('.form-btn').addClass('ok');
        $(".J_search").click()
    }

    //初始化扫描二维码按钮
    Qrcode.init($('#scan_btn'), scanPickupCode);



    $("#order-detail").on("click", ".J_pickup", doPickup);
    $("#order-detail").on("click", ".add-fund", addFund);


    function doPickup() {
        var order_id = $(this).attr("order_id");
        var pickup_code = $(this).attr("pickup_code");


        $(document).dialog({
            type : 'confirm',
            closeBtnShow: true,
            content: __('确认核销？'),
            onClickConfirmBtn: function(){
                //
                var chain_code = $("#chain_code").val();
                $.request({
                    type: "post",
                    url: SYS.URL.seller.do_pickup,
                    data: {
                        order_id: [order_id],
                        chain_code: pickup_code,
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200)
                        {

                            Public.tips({type: 2, content:  __('核销成功')});

                            //
                            $(".J_search").click();
                        }
                        else
                        {
                            Public.tips({type: 2, content:  res.msg});
                        }
                    },
                    error: function (err, status)
                    {
                        Public.tips({type: 2, content: __('操作无法成功，请稍后重试！')});
                    }
                })
            },
            onClickCancelBtn : function(){
            },
            onClickCloseBtn  : function(){
            }
        });
    }

    function addFund() {
        var order_id = $(this).attr("order_id");
        var params = {};
        params.order_id = order_id
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.admin.pay.orderRecord,
            data: {
                order_id:order_id
            },
            dataType: "json",
            success: function(e) {
                if (e.status == 200) {

                    var orderRecord = e.data;
                    listsPayment(orderRecord, params);

                } else {
                    $.sDialog({
                        skin: "red",
                        content: e.msg,
                        okBtn: true,
                        cancelBtn: false
                    })
                }
            }
        })

    }

});
