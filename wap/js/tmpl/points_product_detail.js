var activity_item_id = getQueryString("activity_item_id");
var key = getLocalStorage("ukey");
var cartCount = 0;
var ud_id = getQueryString("ud_id", 0);
var rows = pagesize;
var page = 1;
var hasmore = true;

$(function () {
    $.request({
        url: SYS.URL.point.product_detail,
        type: "get",
        data: {activity_item_id: activity_item_id, key: key},
        dataType: "json",
        success: function (result) {
            if (result && result.status == 200) {
                //渲染模板
                var html = template.render('pgoods_body', result);
                $("#pgoods_info").html(html);

                var x_html = template.render('product_detail_sepc', result);
                $("#product_detail_spec_html").html(x_html);


                if (result.data.activity_points_product_num > 0) {
                    $("#add-cart").addClass('ok animation-up');
                }

                $.request({
                    url: SYS.URL.user.address_lists,
                    type: "get",
                    data: {},
                    dataType: "json",
                    success:function (address_res) {
                        var res = {};
                        res.address_list = address_res.data.items;
                        if (!isNull(ud_id)) {
                            $("#add-cart").trigger("click");
                            for (var i = 0; i < address_res.data.items.length; i++) {
                                if(address_res.data.items[i].ud_id == ud_id) {
                                    res.ud_id = address_res.data.items[i].ud_id
                                    insertHtmlAddress(address_res.data.items[i]);
                                }
                            }
                        } else {
                            for (var i = 0; i < address_res.data.items.length; i++) {
                                if(address_res.data.items[i].ud_is_default) {
                                    res.ud_id = address_res.data.items[i].ud_id
                                    insertHtmlAddress(address_res.data.items[i]);
                                }
                            }
                        }

                        var d_html = template.render('list-address-add-list-script', res);
                        $("#list-address-add-list-ul").html(d_html);
                    }
                });

                //购买数量减
                $(".minus").click(function (e)
                {
                    e.preventDefault();
                    var buynum = $("#buynum").val();
                    if (buynum > 1)
                    {
                        $("#buynum").val(parseInt(buynum - 1));
                    }
                });
                //购买数量加
                $(".add").click(function (e)
                {
                    e.preventDefault();
                    var buynum = parseInt($("#buynum").val());
                    if (buynum < result.data.activity_points_product_num)
                    {
                        $("#buynum").val(parseInt(buynum + 1));
                    }
                });

                // 修改
                $("#buynum").change(function (e) {
                    e.preventDefault();
                    var buynum = parseInt($("#buynum").val());
                    if (buynum > result.data.activity_points_product_num)
                    {
                        $("#buynum").val(result.data.activity_points_product_num);
                    }
                });

                $.animationLeft({
                    valve : '#list-address-valve',
                    wrapper : '#list-address-wrapper',
                    scroll : '#list-address-scroll'
                });

                // 地区选择
                $(document).on('click', '#list-address-add-list-ul li',function(){
                    var param = eval('address_info = ' + $(this).data("param")) ;

                    $(this).addClass('selected').siblings().removeClass('selected');
                    insertHtmlAddress(param);
                    $('#list-address-wrapper').find('.header-l > a').click();
                });

                // 从下到上动态显示隐藏内容
                $.animationUp({
                    valve: '.animation-up,#goods_spec_selected',          // 动作触发
                    wrapper: '#product_detail_spec_html',    // 动作块
                    scroll: '',     // 滚动块，为空不触发滚动
                    start: function ()
                    {       // 开始动作触发事件
                        $('.goods-detail-foot').addClass('hide').removeClass('block');
                    },
                    close: function ()
                    {        // 关闭动作触发事件
                        $('.goods-detail-foot').removeClass('hide').addClass('block');
                    }
                });

                // 添加地址 btn-add-address
                $(document).on("click", ".btn-add-address", function () {
                    var callback = encodeURIComponent(window.location.href);
                    window.location.href = WapSiteUrl + '/tmpl/member/address_opera.html?callback=' + callback;
                });


                // 生成积分订单
                $(document).on("click", "#add-point-order", function () {
                    var params = {};
                    params.ud_id = ud_id;
                    params.buynum = $("#buynum").val();
                    params.activity_item_id = activity_item_id;
                    if (verifyData(params)) {
                       $.request({
                           url: SYS.URL.user.add_point_shopping_order,
                           type: "get",
                           data: params,
                           dataType: "json",
                           success: function (result) {
                               if (result && result.status == 200) {
                                   $.sDialog({
                                       skin: "red",
                                       content: __("兑换成功"),
                                   });
                                   window.location.href = WapStaticUrl + '/tmpl/member/order_detail.html?order_id=' + result.order_id[0];
                               } else {
                                   $.sDialog({
                                       skin: "red",
                                       content: result.msg,
                                   });
                               }
                           },
                           error: function () {
                               $.sDialog({
                                   skin: "red",
                                   content: __("网络连接错误，请稍后重试！"),
                               });
                           }
                       })
                    }
                });
                
            } else {
                $.sDialog({
                    content: result.msg + __('！<br>请返回上一页继续操作…'),
                    okBtn: false,
                    cancelBtnText: __('返回'),
                    cancelFn: function () {
                        history.back();
                    }
                });
            }
        }
    });



    function insertHtmlAddress(address_info) {
        ud_id = address_info.ud_id;
        $('#ud_name').html(address_info.ud_name);
        $('#ud_mobile').html(address_info.ud_mobile);
        console.info(address_info.district_info + " " + address_info.ud_address)
        console.info(address_info)
        $('#district_info').html(address_info.district_info + " " + address_info.ud_address);
    }
    
    function verifyData(params) {
        if (!params.ud_id) {
            $.sDialog({
                skin: "red",
                content: __("请选择收货地址！"),
            });
            return false;
        }

        if (!params.buynum) {
            $.sDialog({
                skin: "red",
                content: __("兑换数量不可等于0！"),
            });
            return false;
        }

        return true;
    }
});

//加入兑换车
$("#add-cart").click(function () {
    if ($(this).hasClass("ok")) {
        if (!key) {
            $.sDialog({
                skin: "red",
                content: __("请先登录"),
                okBtn: false,
                cancelBtn: true,
                cancelBtnText: __("确定"),
                cancelFn: function () {
                    window.location.href = WapSiteUrl + '/tmpl/member/login.html';
                    return;
                }
            });
        }
    } else {
        $.sDialog({
            skin: "red",
            content: __("库存不足"),
        });
    }

});

