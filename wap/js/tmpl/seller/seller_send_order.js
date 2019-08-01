$(function() {
    var showtype=getQueryString("showtype");
    var orderid = getQueryString("orderid");
    var order_data = {};

    if (!ifLogin()){return}


    initInputDatePlaceholder('#logistics_time', 'datetime-local');
    /*
    $('#logistics_time').focus(function(){
        var obj = $(this);
        obj.prop('type','datetime-local');
        //obj.focus();
        //obj.click();
        setTimeout(function(){obj.trigger('click');},10);
    });

    $('#logistics_time').blur(function(){
        var obj = $(this);
        if(!obj.val()){
            obj.prop('type','text');
        }
    });
    */

    // express_id
    function s() {
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.seller.getOrderStock,
            data: {
                order_id:orderid,
            },
            dataType: "json",
            success: function(res) {
                //checkLogin(ed.login);  
                //var t = template.render("sshipping_list", res);
                /* $("#shipping_list").empty();
                $("#shipping_list").append(t);*/
                order_data = res.data;
				
                $("#order_step1").empty();
                $("#order_step1").append(template.render("orderstep1", res.data));

                var g = template.render("saddress_list", res.data.order_detail);
                $("#address_list").empty();
                $("#address_list").append(g);
            } 
        });
    }
    function listsExpress() {
        $.request({
            type    : "post",
            url: itemUtil.getUrl(SYS.CONFIG.URL.seller.lists_express_logistics, {'logistics_is_enable': 1}),
            data    : {},
            dataType: "json",
            success : function (e) {
                if (e.status == 200) {
                    var optionStr = "<option value='-1'>" + __("选择快递公司") + "</option>";
                    for(var i=0; i < e.data.items.length; i++) {
                        var select = e.data.items[i].logistics_is_default ? "selected" : "";
                        optionStr += "<option value='" + e.data.items[i].logistics_id + "' " + select + ">" + e.data.items[i].logistics_name + "</option>";
                    }
                    $("#logistics_id").empty();
                    $("#logistics_id").append(optionStr);
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

    s();
    listsExpress();
    $("#order_step1").change(function () {
        if ($("#selectStockBill option:selected").data("index") != -1) {
            $("#stock_bill_id").val($("#order_step1 option:selected").data("stock_bill_id"))
            $("#stock_bill").empty();
            $("#stock_bill").append(template.render("product_detail", order_data));

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
        } else {
            $("#stock_bill_id").val()
        }
    });


    $("#tabBox1").on("click", ".send-order",function (e) {
        e.preventDefault();
        $("#order_id").val(orderid)
        var params = $("#logistic").serializeArray();
       saveOrderLogistic(params);
    });

    function checkLogisticParams(params) {
        console.info(params)
        for (var i in params) {
            if (params[i].name == "stock_bill_id") {
                return (params[i].value == "" || !params[i].value) ? true : false;
            }
        }
        return true;
    }

    function saveOrderLogistic(params) {
        if (checkLogisticParams(params)) {
            $.sDialog({
                skin: "block",
                content: __("请选择出库单号!"),
                okBtn: true,
                cancelBtn: true,
                okFn: function () {}
            })
        } else {
            $.request({
                type: "post",
                url: SYS.CONFIG.URL.seller.saveOrderLogistics,
                data: params,
                dataType: "json",
                success: function(e) {
                    if (e) {
                        $.sDialog({
                            skin: "block",
                            content: __("发货成功!"),
                            okBtn: true,
                            cancelBtn: true,
                            okFn: function() {
                                window.location.href="store_orders_list.html?data-state=2040";
                            }
                        })

                    }else{
                        $.sDialog({
                            skin: "block",
                            content: __("发货失败!"),
                            okBtn: true,
                            cancelBtn: true
                        })

                    }
                }
            })

        }
    }

});

TouchSlide( { slideCell:"#tabBox1",
	endFun:function(i){ //高度自适应
		var bd = document.getElementById("tabBox1-bd");
		//bd.parentNode.style.height = bd.children[i].children[0].offsetHeight+"px";
		if(i>0)bd.parentNode.style.transition="200ms";//添加动画效果
	}
});