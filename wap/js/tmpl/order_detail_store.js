$(function(){
    if (!ifLogin()){return}

    $.getJSON(SYS.CONFIG.index_url+'?ctl=User_Order&met=detailStore&typ=json',{order_id:getQueryString('order_id')}, function(result) {

        if (result.status == 200)
        {

            //result.data.order_info.WapSiteUrl = WapSiteUrl;
            template.helper("$getLocalTime", function (e) {
                var t = new Date(parseInt(e) * 1e3);
                var r = "";
                r += t.getFullYear() + "-";
                r += t.getMonth() + 1 + "-";
                r += t.getDate() + " ";
                r += t.getHours() + ":";
                r += t.getMinutes();
                return r
            });
            $('#order-info-container').html(template.render('order-info-tmpl',result.data));
            // 取消
            $(".cancel-order").click(cancelOrder);
            // 收货
            $(".sure-order").click(sureOrder);
            // 评价
            $(".evaluation-order").click(evaluationOrder);
            // 追评
            $('.evaluation-again-order').click(evaluationAgainOrder);
            // 全部退款
            $('.all_refund_order').click(allRefundOrder);
            // 部分退款
            $('.goods-refund').click(goodsRefund);
            // 退货
            $('.goods-return').click(goodsReturn);

            $('.viewdelivery-order').click(viewOrderDelivery);


            $.request({
               type: 'post',
               url: SYS.URL.user.order_delivery,
               data:{order_id:getQueryString("order_id")},
               dataType:'json',
               success:function(result) {
                   var data = result && result.data;
                   if (data.deliver_info) {
                       $("#delivery_content").html(data.deliver_info.context);
                       $("#delivery_time").html(data.deliver_info.time);
                   }
               }
            });
        }
    });
    
    //取消订单
    function cancelOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: '确定取消订单？',
            okFn: function() { cancelOrderId(order_id); }
        });
    }

    function cancelOrderId(order_id) {
        $.request({
            type:"post",
            url:SYS.CONFIG.URL.user.order_cancel,
            data:{order_id:order_id},
            dataType:"json",
            success:function(result){
                if(result.data && result.status == 200){
                	window.location.reload();
                }
            }
        });
    }

    //确认订单
    function sureOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: '确定收到了货物吗？',
            okFn: function() { sureOrderId(order_id); }
        });
    }
    function sureOrderId(order_id) {
        $.request({
            type:"post",
            url: SYS.CONFIG.URL.user.order_receive,
            data:{order_id:order_id},
            dataType:"json",
            success:function(result){
                if(result.data && result.data == 1){
                    window.location.reload();
                }
            }
        });
    }
    // 评价
    function evaluationOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/member_evaluation.html?order_id=' + orderId;
        
    }
    // 追加评价
    function evaluationAgainOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/member_evaluation_again.html?order_id=' + orderId;
    }
    // 全部退款
    function allRefundOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/refund_all.html?order_id=' + orderId;
    }
    // 查看物流
    function viewOrderDelivery() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/order_delivery.html?order_id=' + orderId;
    }
    // 退款
    function goodsRefund() {
        var orderId = $(this).attr('order_id');
        var orderGoodsId = $(this).attr('order_item_id');
        location.href = WapSiteUrl + '/tmpl/member/refund.html?order_id=' + orderId +'&order_item_id=' + orderGoodsId;
    }
    // 退货
    function goodsReturn() {
        var orderId = $(this).attr('order_id');
        var orderGoodsId = $(this).attr('order_item_id');
        location.href = WapSiteUrl + '/tmpl/member/return.html?order_id=' + orderId +'&order_item_id=' + orderGoodsId;
    }
});