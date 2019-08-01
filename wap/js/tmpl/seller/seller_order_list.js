var page = pagesize; 
var curpage = 1;
var hasMore = true;
var footer = false;
var reset = true;
var orderKey = "";
var showtype=getQueryString("showtype");
var myexpresslist="";
var sendorderid=0;
var chain_id = getLocalStorage('chain_id')

$(function() {
    if (!ifLogin()){return}

    if (getQueryString("data-state") != "") {
        $("#filtrate_ul").find("li").has('a[data-state="' + getQueryString("data-state") + '"]').addClass("selected").siblings().removeClass("selected")
    }
    $("#search_btn").click(function() {
        reset = true;
        t()
    });
    $("#fixed_nav").waypoint(function() {
        $("#fixed_nav").toggleClass("fixed")
            if (window.suteshopApp)
            {
                $('#fixed_nav.fixed').css({'top': 0});
            }
            else
            {
            }
    },
    {
        offset: "50"
    });
    function t() {
        if (reset) {
            curpage = 1;
            hasMore = true
        }

        if (!hasMore) {
            return false
        }

        var t = $("#filtrate_ul").find(".selected").find("a").attr("data-state");
        t = t.split(",");

        var r = $("#order_key").val();
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.seller.order_lists,
            data: {
                order_state_id: t,
                order_id: r,
                sidx: 'order_time',
                sord: 'desc',
                page: curpage,
                chain_id:chain_id

            },
            dataType: "json",
            success: function(res) {
                //checkLogin(res.login);
                curpage++;
                hasMore = (res.data.page < res.data.total) ? true : false;
                if (!hasMore) {
                    get_footer()
                }
			 
                if (res.data.items.length <= 0) {
                    $("#footer").addClass("posa")
                } else {
                    $("#footer").removeClass("posa")
                }
                var t = res;
                t.WapSiteUrl = WapSiteUrl;
                t.ApiUrl = ApiUrl;
                t.key = getLocalStorage('ukey');
                t.hasmore = hasMore;

                template.helper("$getLocalTime", function(e) {
                    var t = new Date(parseInt(e) * 1e3);
                    var r = "";
                    r += t.getFullYear() + __("年");
                    r += t.getMonth() + 1 + __("月");
                    r += t.getDate() + __("日");
                    r += t.getHours() + ":";
                    r += t.getMinutes();
                    return r
                });
				 
                template.helper("p2f", function(e) {
                    return (parseFloat(e) || 0).toFixed(2)
                });
                template.helper("parseInt", function(e) {
                    return parseInt(e)
                });


                $(".loading").remove();
                var r = template.render("order-list-tmpl", t);
				 
                if (reset) {
                    reset = false;
                    $("#order-list").html(r)
                } else {
                    $("#order-list").append(r)
                }
            }
        })


 

    }
    $("#order-list").on("click", ".cancel-order", cancel);
    $("#order-list").on("click", ".edit-order-fee", editFee);
    $("#order-list").on("click", ".send-order", n);  
    $("#order-list").on("click", ".review-order", reviewOrder);
    $("#order-list").on("click", ".add-fund", addFund);


    function addFund() {
        var order_id = $(this).attr("order_id");
        var params = {};
        params.order_id = order_id
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.admin.pay.orderRecord,
            data: {
                order_id:order_id,chain_id:chain_id
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

    function listsPayment(orderRecord, params) {
        $.request({
            type    : "post",
            url     : SYS.CONFIG.URL.admin.lists.payment_channel,
            data    : {chain_id:chain_id},
            dataType: "json",
            success : function (e) {
                if (e.status == 200) {
                    dialogPayment(orderRecord, params, e.data.items)
                } else {
                    $.sDialog({
                        skin     : "red",
                        content  : e.msg,
                        okBtn    : true,
                        cancelBtn: false
                    })
                }
            }
        })
    }

    function dialogPayment(orderRecord, params, paymentList) {
        var opera_name = $('.add-fund').attr("opera_name");
        var buyer_name = $('.add-fund').parent(".handle").attr("buyer_name");
        var order_id = params.order_id
        var optionStr = "<option value='0'>" + __("请选择支付方式") + "</option>";
        for (var i=0; i< paymentList.length; i++) {
            optionStr += "<option value='" + paymentList.payment_channel_id + "'>" + paymentList.payment_channel_name + "</option>";
        }
        $.sDialog({
            skin: "red",
            content: "<div style='text-align:left'>" + opera_name+ "<h6>买&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家："+buyer_name+"</h6><h6>订&nbsp;&nbsp;单&nbsp;&nbsp;号："+order_id+"</h6>" +
            "<h6 style='margin: 5px;'>收款时间：<input type='text' name='deposit_notify_time' id='deposit_notify_time' style='height:1rem;IME-MODE:disabled;'></h6>" +
            "<h6 style='margin: 5px;'>金&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;额：<input type='number'  max='" + orderRecord.trade_payment_amount + "' value='" + orderRecord.trade_payment_amount + "'  name='deposit_total_fee' id='deposit_total_fee' style='height:1rem;IME-MODE:disabled;'></h6>" +
            "<h6 style='margin: 5px;'>支付凭证：<input type='text' name='deposit_trade_no' id='deposit_trade_no' style='height:1rem;IME-MODE:disabled;'></h6>" +
            "<h6 style='margin: 5px;'>支付方式：<span class='inp-black'><select name='payment_channel_id' style='min-width: 2rem'>" + optionStr+ "</select></span></h6>" +
            "<h6 style='margin: 5px;'>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：<input type='text' name='trade_remark' id='trade_remark' style='height:1rem;IME-MODE:disabled;'></h6>" +
            "</div>",
            okFn: function() {
                params.deposit_notify_time = $("#deposit_notify_time").val();
                params.trade_remark = $("#trade_remark").val();
                params.deposit_trade_no = $("#deposit_trade_no").val();
                params.deposit_total_fee = $("#deposit_total_fee").val();
                params.payment_channel_id = $("#payment_channel_id").val();
                params.pm_money = 0;
                params.pm_recharge_card = 0;
                if (orderRecord.trade_payment_amount < params.deposit_total_fee || params.deposit_total_fee <= 0) {

                    $.sDialog({
                        skin: "red",
                        content: __("收款金额错误"),
                        okBtn: true,
                        cancelBtn: false
                    })
                } else if (!params.deposit_trade_no){
                    $.sDialog({
                        skin: "red",
                        content: __("输入收款凭证号"),
                        okBtn: true,
                        cancelBtn: false
                    })
                } else {
                    _addFund(params);
                }
            }
        })
    }
    function _addFund(params) {
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.admin.pay.offline,
            data: params,
            dataType: "json",
            success: function(e) {
                if (e.status == 200) {
                    $.sDialog({
                        skin: "red",
                        content: __("收款成功！"),
                        okBtn: true,
                        okFn: function() {
                            reset = true;
                            t();
                        },
                        cancelBtn: false
                    })
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

    function reviewOrder() {
        var order_id = $(this).attr("order_id");
        var opera_name = $(this).attr("opera_name");
        var buyer_name = $(this).parent(".handle").attr("buyer_name");
        var order_state_id = $(this).parent(".handle").attr("order_state_id");
        $.sDialog({
            skin: "red",
            content: "<div style='text-align:left'>" + opera_name+ "<h6>买家："+buyer_name+"</h6><h6>订单号："+order_id+"</h6></div>",
            okFn: function() {
                _reviewOrder(order_id, order_state_id);
            }
        })
    }
    function _reviewOrder(order_id, order_state_id) {
        var _url = "";
        if (order_state_id == StateCode.ORDER_STATE_WAIT_REVIEW){
            _url = SYS.CONFIG.URL.seller.review;
        }
        if (order_state_id == StateCode.ORDER_STATE_WAIT_FINANCE_REVIEW){
            _url = SYS.CONFIG.URL.seller.review_finance;
        }
        if (order_state_id == StateCode.ORDER_STATE_PICKING){
            _url = SYS.CONFIG.URL.seller.review_picking;
        }

        $.request({
            type: "post",
            url: _url,
            data: {
                order_id: order_id.split(" "),
            },
            dataType: "json",
            success: function(e) {
                if (e.status == 200) {
                    $.sDialog({
                        skin: "red",
                        content: __("修改状态成功！"),
                        okBtn: true,
                        okFn: function() {
                            reset = true;
                            t();
                        },
                        cancelBtn: false
                    })
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
    function cancel() {
        var order_id = $(this).attr("order_id");
        var _content = "<div style='text-align:left;'>";
        _content += "<h6>订&nbsp;&nbsp;单&nbsp;&nbsp;号："+order_id+"</h6><h6>取消原因：";
        _content += "<span class='inp-black'><select name='cancelreason'>";
        _content += "<option value='无法备齐货物'>无法备齐货物</option>";
        _content += "<option value='买家主动要求'>买家主动要求</option>";
        _content += "<option value='不是有效的订单'>不是有效的订单</option>";
        _content += "<option value='其他原因'>其他原因</option>";
        _content += "</select></h6></span>";
        _content += "</div>";
        $.sDialog({
            content: _content,
            okFn: function() {
                var rt=$("select[name='cancelreason'] option:selected").val();
                _cancelOrder(order_id, rt);
            }
        })
    }
    function _cancelOrder(r, rt) {
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.seller.cancel_order,
            data: {
                order_id: new Array(r),
				reason:rt,
            },
            dataType: "json",
            success: function(e) {
                if (e && e.status == 200) {
					$.sDialog({
                        skin: "red",
                        content: "订单取消成功",
                        okBtn: true,
                        okFn:function(){
                         reset = true;
                         t();
                        },
                        cancelBtn: false
                    })
                } else {
                    $.sDialog({
                        skin: "red",
                        content: e.msg,
                        okBtn: false,
                        cancelBtn: false
                    })
                }
            }
        })
    }

    function editFee() {
        var order_id = $(this).attr("order_id");
        var buyer_name = $(this).parent(".handle").attr("buyer_name");
        $.sDialog({
            skin: "red",
            content: "<div style='text-align:left'><h3 style='text-align:center;font-size:0.8rem;margin:0.2rem 0rem;'>修改订单价格</h3><h6>买&nbsp;&nbsp;&nbsp;家："+buyer_name+"</h6><h6>订单号："+order_id+"</h6><h6>新邮费：<input type='tel' name='newprice' id='newprice' style='height:1rem;IME-MODE:disabled;border: solid 1px #ccc;'></h6></div>",
            okFn: function() {
               var price=$("#newprice").val();
               if(price!=""&&(/^\d+$/.test(price))){
                   _editFee(order_id,price);
               }else{
                  alert("输入数字价格");
                  return false;
               }
            }
        })
    }
    /* 修改邮费ajax操作 */
    function _editFee(orderid, price) {
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.seller.edit_fee,
            data: {
                order_id: orderid,
                fee_amount:price,

            },
            dataType: "json",
            success: function(e) {
                if (e && e.data.status == 200) {
                    $.sDialog({
                        skin: "red",
                        content: __("修改邮费成功！"),
                        okBtn: true,
                        okFn: function() {
                            reset = true;
                            t();
                        },
                        cancelBtn: false
                    })
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
    function n() {
        sendorderid = $(this).attr("order_id");
        $.sDialog({
			autoTime: '30000',
			skin: "red", 
            content: "无需物流，商家自行发货<br/>确认发货？",
            okBtn: true,
			okFn:function(){
                $.request({
                    type: "post",
                    url: ApiUrl + "/index.php?act=seller_order&op=order_deliver_send",
                    data: {
                        order_id: sendorderid,
                    },
                    dataType: "json",
                    success: function(e) {
                        if (e && e.data.status == 200) {
                            $.sDialog({
                                skin: "block",
                                content: "发货成功!",
                                okBtn: true,
                                cancelBtn: true,
                                okFn: function() {
                                    window.location.href="store_orders_list.html?data-state=2040";
                                }
                            })
                        }else{
                            $.sDialog({
                                skin: "block",
                                content: "发货失败!",
                                okBtn: true,
                                cancelBtn: true
                            })
                        }
                    }
                  })
			},
            cancelBtn: true
        })
    }
   
    

    $("#filtrate_ul").find("a").click(function() {
        $("#filtrate_ul").find("li").removeClass("selected");
        $(this).parent().addClass("selected").siblings().removeClass("selected");
        reset = true;
        window.scrollTo(0, 0);
        t()
    });

    t();
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
            t()
        }
    })
});
function get_footer() {
    if (!footer) {
        footer = true;
        $.request({
            type:'get',
            cache:true,
            url: WapSiteUrl + "/js/tmpl/seller/seller_footer.js",
            dataType: "script"
        })
    }
}