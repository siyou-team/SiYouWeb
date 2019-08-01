var page = pagesize;
var curpage = 1;
var hasMore = true;
var footer = false;
var reset = true;
var orderKey = '';

$(function(){
    if (!ifLogin()){return}


    if (getQueryString('data-state') != '') {
	    $('#filtrate_ul').find('li').has('a[data-state="' + getQueryString('data-state')  + '"]').addClass('selected').siblings().removeClass("selected");
	}

    var readytopay = false;
    var readytopayWx = false;

    $('#search_btn').click(function(){
        reset = true;
    	initPage();
    });


	function initPage(){
	    if (reset) {
	        curpage = 1;
	        hasMore = true;
	        $('#footer').html('');
	    }
        $('.loading').remove();
        if (!hasMore) {
            return false;
        }
        hasMore = false;
	    var state_type = $('#filtrate_ul').find('.selected').find('a').attr('data-state');
	    var orderKey = $('#order_key').val();
		$.request({
			type:'post',
			url: SYS.CONFIG.URL.user.order_lists,
			data:{ "state_type":state_type, "order_key" : orderKey, "kind_id":1202},
			dataType:'json',
			success:function(result){
				//checkLogin(result.login);//检测是否登录了
				curpage++;
                hasMore = result.hasmore;
                if (!hasMore) {
                    get_footer();
                }
                if (result.data.items.length <= 0) {
                    $('#footer').addClass('posa');
                }
				var data = result.data;
				data.WapSiteUrl = WapSiteUrl;//页面地址
				data.ApiUrl = ApiUrl;
				data.key = getLocalStorage('ukey');
				template.helper('$getLocalTime', function (nS) {
                    var d = new Date(parseInt(nS) * 1000);
                    var s = '';
                    s += d.getFullYear() + '年';
                    s += (d.getMonth() + 1) + '月';
                    s += d.getDate() + '日 ';
                    s += d.getHours() + ':';
                    s += d.getMinutes();
                    return s;
				});
                template.helper('p2f', function(s) {
                    return (parseFloat(s) || 0).toFixed(2);
                });
                template.helper('parseInt', function(s) {
                    return parseInt(s);
                });
				var html = template.render('order-list-tmpl', data);
				if (reset) {
				    reset = false;
				    $("#order-list").html(html);
				} else {
                    $("#order-list").append(html);
                }
			}
		});

	}

    /*$.request({
        type:'get',
        url:ApiUrl+"/index.php?act=member_payment&op=payment_list",
        data:{},
        dataType:'json',
        success:function(result){
            var validPayments = {};
            $.each((result && result.data && result.data.payment_list) || [], function(k, v) {
                validPayments[v] = true;
            });

            var m = navigator.userAgent.match(/MicroMessenger\/(\d+)\./);
            if (parseInt(m && m[1] || 0) >= 5) {
                // in WX
                if (validPayments.wx_native) {
                    readytopayWx = true;
                }
            } else {
                if (validPayments.alipay) {
                    readytopay = true;
                }
            }

        }
    });*/
    //初始化页面
    initPage(page,curpage);

    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
            initPage();
        }
    });

    $('#order-list').on('click','.check-payment',function() {
        var pay_sn = $(this).attr('data-paySn');
        toPay(pay_sn,'member_vr_buy','pay');
        return false;
    });

    // 取消
    $('#order-list').on('click','.cancel-order', cancelOrder);

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
                if(result.data && result.data == 1){
                    reset = true;
                    initPage(page,curpage);
                } else {
                    $.sDialog({
                        skin:"red",
                        content:result.msg,
                        okBtn:false,
                        cancelBtn:false
                    });
                }
            }
        });
    }
    //删除订单
    function deleteOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: __('是否移除订单？<h6>电脑端订单回收站可找回订单！</h6>'),
            okFn: function() { deleteOrderId(order_id); }
        });
    }

    function deleteOrderId(order_id) {
        $.request({
            type:"post",
            url: SYS.CONFIG.URL.user.order_remove,
            data:{order_id:order_id},
            dataType:"json",
            success:function(result){
                if(result.data && result.data == 1){
                    reset = true;
                    initPage();
                } else {
                    $.sDialog({
                        skin:"red",
                        content:result.msg,
                        okBtn:false,
                        cancelBtn:false
                    });
                }
            }
        });
    }

    //确认订单
    function sureOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: __('确定收到了货物吗？'),
            okFn: function() { sureOrderId(order_id); }
        });
    }

    function sureOrderId(order_id) {
        $.request({
            type:"post",
            url:SYS.CONFIG.URL.user.order_receive,
            data:{order_id:order_id},
            dataType:"json",
            success:function(result){
                if(result.data && result.data == 1){
                    reset = true;
                    initPage();
                } else {
                    $.sDialog({
                        skin:"red",
                        content:result.msg,
                        okBtn:false,
                        cancelBtn:false
                    });
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

    function viewOrderDelivery() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/order_delivery.html?order_id=' + orderId;
    }


    function returnOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/return.html?order_id=' + orderId;
    }

// 取消
    $('#order-list').on('click','.cancel-order', cancelOrder);
    // 删除
    $('#order-list').on('click','.delete-order',deleteOrder);
    // 收货
    $('#order-list').on('click','.sure-order',sureOrder);
    // 评价
    $('#order-list').on('click','.evaluation-order',evaluationOrder);
    // 追评
    $('#order-list').on('click','.evaluation-again-order', evaluationAgainOrder);

    $('#order-list').on('click','.viewdelivery-order',viewOrderDelivery);

    //退货
    $('#order-list').on('click','.return-order',returnOrder);

    // 评价
    $('#order-list').on('click','.evaluation-order', function(){
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/member_vr_evaluation.html?order_id=' + orderId;
    });

    $('#filtrate_ul').find('a').click(function(){
        $('#filtrate_ul').find('li').removeClass('selected');
        $(this).parent().addClass('selected').siblings().removeClass("selected");
        reset = true;
        window.scrollTo(0,0);
        initPage();
    });
});
function get_footer() {
    if (!footer) {
        footer = true;
        $.request({
            type:'get',
            cache:true,
            url: WapSiteUrl+'/js/tmpl/footer.js',
            dataType: "script"
          });
    }
}