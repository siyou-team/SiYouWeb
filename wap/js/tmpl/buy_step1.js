var key = getLocalStorage('ukey');
// buy_stop2使用变量
var ifcart = (!isNull(getQueryString('ifcart')) && getQueryString('ifcart') != "0") ? 1 : 0;
if (ifcart == 1) {
    var cart_id = getQueryString('cart_id');
} else {
    var cart_id = getQueryString("item_id") + '|' + getQueryString("buynum");
}
var pay_name        = 'online';
var user_invoice_id = 0;

var ud_id,
    vat_hash,
    offpay_hash,
    activity_id,
    offpay_hash_batch,
    voucher,
    payment_type_id,
    password,
    fcode = '',
    pm_recharge_card,
    rpt,
    payment_channel_code,
    gb_id,
    ac_id,
    order_id,
    chain_id,
    if_chain,
    chain_store_id,
    chain_init;

chain_id        = !isNull(getQueryString('chain_id')) ? getQueryString('chain_id') : 0;
if_chain        = !isNull(getQueryString('if_chain')) ? getQueryString('if_chain') : 0;
activity_id     = !isNull(getQueryString('activity_id')) ? getQueryString('activity_id') : 0;
ac_id           = !isNull(getQueryString('ac_id')) ? getQueryString('ac_id') : 0;
gb_id           = !isNull(getQueryString('gb_id')) ? getQueryString('gb_id') : 0;


var message         = {};
// change_address 使用变量
var freight_hash, province_id, county_id, city_id, district_id
// 其他变量
var district_info;
var item_id = getQueryString("item_id");

//GEO
window.addressStr = '';
window.coordinate = null;

function initialize()
{
    // 百度地图API功能
    var geolocation = new BMap.Geolocation();
    var geoc = new BMap.Geocoder();

    geolocation.getCurrentPosition(function (r) {
        if (this.getStatus() == BMAP_STATUS_SUCCESS)
        {
            var mk = new BMap.Marker(r.point);
            //alert('您的位置：'+r.point.lng+','+r.point.lat);

            window.coordinate = {'lng': r.point.lng, lat: r.point.lat};
            //判断是否需要读取门店
            //执行附近的门店。
            $.request({
                type: 'post',
                url: SYS.URL.store.getNearChain,
                data: {key: key, 'lng': r.point.lng, lat: r.point.lat, item_id: item_id},
                dataType: 'json',
                async: false,
                success: function (result) {
                    if (result.data.items == null) {
                        return false;
                    }
                    result.data.chain_list = result.data.items;
                    var html = template.render('list-chain-script', result.data);
                    $("#chain-list").html(html);
                    if (result.data.items.length == 0) $("#chain-list").html('<li><dt style="padding:0.65rem 0 0 0.65rem">' + __('该地区没有门店') + '</dt></li>');
                }
            });
        }
        else
        {
            $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));
        }
    }, {enableHighAccuracy: true})


}
$(function () {
    // 地址列表
    $('#list-address-valve').click(function () {
        $.request({
            type: 'post',
            url: SYS.URL.user.address_lists,
            data: {},
            dataType: 'json',
            async: false,
            success: function (result) {
                //checkLogin(result.login);
                if (result.status != 200) {
                    return false;
                }
                var data = result.data;
                data.ud_id = ud_id;
                var html = template.render('list-address-add-list-script', data);
                $("#list-address-add-list-ul").html(html);
            }
        });
    });
    $.animationLeft({
        valve: '#list-address-valve',
        wrapper: '#list-address-wrapper',
        scroll: '#list-address-scroll'
    });

    // 地区选择
    $('#list-address-add-list-ul').on('click', 'li', function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        eval('address_row = ' + $(this).attr('data-param'));
        //_init(address_row.ud_id);
        //todo地址邮费校验  insertHtmlAddress(result.data.address_row[0], result.data.address_api);
        var address_api = {};
        address_api.content = '';
        address_api.allow_offpay = 1
        insertHtmlAddress(address_row);
        $('#list-address-wrapper').find('.header-l > a').click();
    });
    $('#new-chain-wrapper .btn-l').click(function(){
        var errorHtml = "";

        var obj = $('#chain-list').find('.selected');
        if(obj.length == 0) errorHtml += "<p>" + __('请选择门店') + "</p>";
        if(errorHtml) {
            errorTipsShow(errorHtml);
            return ;
        }
        chain_id = obj.attr("chain_id");
        console.info(chain_id)
        $("#chain_address").html('[门店]'+obj.find("dt span").html()+' '+obj.find("dd span").html());
        $('#new-chain-wrapper').find('.header-l > a').click();
        $('#receive-chain').attr("chain_id", chain_id);
        $('#new-chain-wrapper').removeClass('left').addClass('hide');
        _init(ud_id);
    });

    // 地址新增
    $.animationLeft({
        valve: '#new-address-valve',
        wrapper: '#new-address-wrapper',
        scroll: ''
    });
    // 支付方式
    $.animationLeft({
        valve: '#select-payment-valve',
        wrapper: '#select-payment-wrapper',
        scroll: ''
    });
    // 地区选择
    $('#new-address-wrapper').on('click', '#vdistrict_info', function () {
        $.areaSelected({
            success: function (data) {
                county_id = data.district_id_3;
                city_id = data.district_id_2;
                province_id = data.district_id_1;
                district_id = data.district_id;
                district_info = data.district_info;
                $('#vdistrict_info').val(data.district_info);
            }
        });
    });

    $(document).on('click', '#list-chain-valve', function () {
        loadScript();
    });
    // 门店地区选择
    $.animationLeft({
        valve: '#list-chain-valve',
        wrapper: '#new-chain-wrapper',
        scroll: '',
    });
    $('#chain-list').on('click', 'li', function () {
        $(this).addClass('selected').siblings().removeClass('selected');
    });
    $('#new-chain-wrapper').on('click', '#chain_area_info', function () {
        $.areaSelected({
            success: function (data) {
                $('#chain_area_info').val(data.district_info);
                var chain_district_id = data.district_id_1 + '/' + data.district_id_2 + '/' + data.district_id_3;
                $.request({
                    type: 'post',
                    url: SYS.URL.store.getNearChain,
                    data: {key: key, chain_district_id: chain_district_id, item_id: item_id},
                    dataType: 'json',
                    async: false,
                    success: function (result) {
                        if (result.data.items == null) {
                            return false;
                        }
                        result.data.chain_list = result.data.items;
                        var html = template.render('list-chain-script', result.data);
                        $("#chain-list").html(html);
                        if (result.data.items.length == 0) $("#chain-list").html('<li><dt style="padding:0.65rem 0 0 0.65rem">' + __('该地区没有门店') + '</dt></li>');
                    }
                });

            }
        });
    });


    function loadScript()
    {
        var script = document.createElement("script");
        script.src = "//api.map.baidu.com/api?v=3.0&ak=Yi9XWlwa7sUGSuKGDiPBrS261bMeu6YF&callback=initialize";//此为v2.0版本的引用方式
        // //api.map.baidu.com/api?v=1.4&ak=您的密钥&callback=initialize"; //此为v1.4版本及以前版本的引用方式
        document.body.appendChild(script);
    }

    $('.sstouch-receive-list input').click(function(){
        if (if_chain == 1) {
            //渲染list

            $('#cart-address').hide();
            $('#chain-address').show();
            $('#payment-chain').show();
            $('#address').hide();
            $('#storeFreight' + chain_store_id).html('0.00');
            if (chain_id == '') {
                $('#list-chain-valve').click();
            }
            if (chain_init == 1) {//初始化
                $('#list-chain-valve').click();
                chain_id = '';
            }
            if ($('#receive-chain').attr("chain_id")) {
                chain_id = $('#receive-chain').attr("chain_id");
                _init(0);
            }
        } else {
            $('#chain-address').hide();
            $('#payment-chain').hide();
            $('#cart-address').show();
            $('#address').show();
            if (ud_id) {
                _init(ud_id);
            } else {
                $('#list-address-valve').click();
            }
            chain_init = 0;
        }
    });


    $('#list-voucher-wrapper').on('click', '#voucher-back', function () {
        $('#list-voucher-wrapper .back').trigger('click');
    });

    //使用优惠券
    $('#list-voucher-list-ul').on('click', '.sstouch-cart-add-list li', function () {
        if (!$(this).hasClass('selected')) {
            var store_id = $(this).parent('.sstouch-cart-add-list').data('store_id');
            $(this).addClass('selected').siblings('li').removeClass('selected');
            $.request({
                type: 'post',
                url: SYS.URL.user.voucher_used,
                data: {voucher_id: $(this).data('voucher_id'), store_id: store_id},
                dataType: 'json',
                async: false,
                success: function (result) {
                    for (var i = 0; i < result.data.items.length; i++) {
                        renderVoucher(result.data.items[i]);
                    }
                }
            });
        }
    });

    //优惠券使用
    var renderVoucher = function (v) {
        var voucher_price = v.voucher_price, store_id = v.store_id;
        if (voucher_price < 0) {
            voucher_price = 0;
            $('#voucher_input' + store_id).val(0);
        } else {
            $('#voucher_input' + store_id).val(v.voucher_id);
        }

        var old_voucher_price = $('#storeVoucher' + store_id).html();
        $('#storeVoucher' + store_id).html(voucher_price);

        var old_totalPrice = $('#totalPrice').html();
        var new_totalPrice = old_totalPrice - (voucher_price - old_voucher_price);
        $('#totalPrice,#onlineTotal').html(new_totalPrice.toFixed(2));

        var old_storeTotal = $("#storeTotal" + store_id).html();
        var new_storeTotal = old_storeTotal - (voucher_price - old_voucher_price);
        $("#storeTotal" + store_id).html(new_storeTotal.toFixed(2));

        if (voucher_price == 0) {
            $('#storeVoucher' + store_id).parent('dd').parent('dl').addClass('hide');
        } else {
            $('#storeVoucher' + store_id).parent('dd').parent('dl').removeClass('hide');
        }
        $("#list-voucher-wrapper i.back").trigger("click");
    }

    // 发票
    $.animationLeft({
        valve: '#invoice-valve',
        wrapper: '#invoice-wrapper',
        scroll: ''
    });


    var _init = function (ud_id) {
        var totals = 0;
        // 购买第一步 提交
        $.request({//提交订单信息
            type: 'post',
            url: SYS.URL.cart.checkout,
            dataType: 'json',
            data: {
                cart_id        : cart_id,
                ifcart         : ifcart,
                ud_id          : ud_id,
                chain_id       : chain_id,
                if_chain       : if_chain,
                activity_id    : activity_id,
                ac_id          : ac_id,
                gb_id          : gb_id,
            },
            success: function (result) {
                if (result.status != 200) {
                    $.sDialog({
                        skin: "red",
                        content: result.msg,
                        okBtn: false,
                        cancelBtn: false
                    });

                    return false;
                }

                var data = result.data;
                data.used_voucher = [];
                for (var i = 0; i < result.data.items.length; i++) {
                    data.used_voucher[result.data.items[i].store_id] = 0;
                }
                chain_store_id = result.data.items[0].store_id
                var html = template.render('voucher-list-script', data);
                $("#list-voucher-list-ul").html(html);

                // 商品数据
                result.data.WapSiteUrl = WapSiteUrl;
                var html = template.render('goods_list', result.data);
                $("#deposit").html(html);
                if (fcode == '') {
                    // F码商品
                    for (var k in result.data.store_cart_list) {
                        if (result.data.store_cart_list[k].goods_list[0].is_fcode == '1') {
                            $('#container-fcode').removeClass('hide');
                            item_id = result.data.store_cart_list[k].goods_list[0].item_id;
                        }
                        break;
                    }
                }
                // 验证F码
                $('#container-fcode').find('.submit').click(function () {
                    fcode = $('#fcode').val();
                    if (fcode == '') {
                        $.sDialog({
                            skin: "red",
                            content: __('请填写F码'),
                            okBtn: false,
                            cancelBtn: false
                        });
                        return false;
                    }
                    /*$.request({//提交订单信息
                        type: 'post',
                        url: ApiUrl + '/index.php?act=member_buy&op=check_fcode',
                        dataType: 'json',
                        data: {item_id: item_id, fcode: fcode},
                        success: function (result) {
                            if (result.status != 200) {
                                $.sDialog({
                                    skin: "red",
                                    content: result.msg,
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return false;
                            }

                            $.sDialog({
                                autoTime: '500',
                                skin: "green",
                                content: '验证成功',
                                okBtn: false,
                                cancelBtn: false
                            });
                            $('#container-fcode').addClass('hide');
                        }
                    });*/
                });

                if (result.data.if_chain) {//商品支持门店自提
                    $('#receive-valve').parent().removeClass('hide');
                    var chain_store_id = result.data.chain_store_id;
                    var c_id = getQueryString('chain_id');
                    if (window.if_chain == '1' && c_id > 0 && typeof(result.data.chain_info) != 'undefined') {//初始化门店地址
                        $('#storeFreight' + chain_store_id).html('0.00');
                        if ($("#receive-valve input:selected").val()) {
                            $('#receive-chain').click();
                        }
                        $("#chain_address").html(__('[门店]') + result.data.chain_info.chain_name + " " + result.data.chain_info.chain_address);
                        var chain_info = result.data.chain_info;
                        $('#chain_area_info').val(chain_info.chain_district_info);
                        var chain_list = [];
                        chain_list[0] = chain_info;
                        result.data.chain_list = chain_list;
                        var html = template.render('list-chain-script', result.data);
                        $("#chain-list").html(html);
                    }
                }

                // 默认地区相关
                if ($.isEmptyObject(result.data.address_row)) {
                    $.sDialog({
                        skin: "block",
                        content: __('请添加地址'),
                        okFn: function () {
                            $('#new-address-valve').click();
                        },
                        cancelFn: function () {
                            history.go(-1);
                        }
                    });
                    return false;
                }

                if (typeof(result.data.inv_info.user_invoice_id) != 'undefined') {
                    user_invoice_id = result.data.inv_info.user_invoice_id;
                }
                // 发票
                $('#invContent').html(result.data.inv_info.content);
                vat_hash = result.data.vat_hash;

                freight_hash = result.data.freight_hash;

                // 输入地址数据
                insertHtmlAddress(result.data.address_row[0]);




                // 优惠券
                voucher = '';
                voucher_temp = [];
                for (var k in result.data.store_cart_list) {
                    voucher_temp.push([result.data.store_cart_list[k].store_voucher_info.voucher_t_id + '|' + k + '|' + result.data.store_cart_list[k].store_voucher_info.voucher_price]);

                    if (result.data.if_chain == '1') {
                        if (result.data.store_cart_list[k].store_voucher_info.voucher_price) shopnc_voucher_price = result.data.store_cart_list[k].store_voucher_info.voucher_price;
                        shopnc_totals_price = parseFloat(result.data.store_cart_list[k].store_goods_total) + parseFloat(shopnc_voucher_price);
                    }
                }
                voucher = voucher_temp.join(',');

                totals = result.data.orderSelMoneyAmount;

                for (var k in result.data.store_final_total_list) {
                    // 总价
                    $('#storeTotal' + k).html(result.data.store_final_total_list[k]);

                    //totals += parseFloat(result.data.store_final_total_list[k]);

                    // 留言
                    message[k] = '';
                    $('#storeMessage' + k).on('change', function () {
                        message[k] = $(this).val();
                    });
                }

                // 红包
                pm_recharge_card = 0;
                rpt = '';
                var rptPrice = 0;
                if (!$.isEmptyObject(result.data.rpt_info)) {
                    $('#rptVessel').show();
                    var rpt_info = ((parseFloat(result.data.rpt_info.rpacket_limit) > 0) ? '满' + parseFloat(result.data.rpt_info.rpacket_limit).toFixed(2) + '元，' : '') + '优惠' + parseFloat(result.data.rpt_info.rpacket_price).toFixed(2) + '元'
                    $('#rptInfo').html(rpt_info);
                    pm_recharge_card = 1;
                } else {
                    $('#rptVessel').hide();
                }


                password = '';

                $('#useRPT').click(function () {
                    if ($(this).prop('checked')) {
                        rpt = result.data.rpt_info.rpacket_t_id + '|' + parseFloat(result.data.rpt_info.rpacket_price);
                        rptPrice = parseFloat(result.data.rpt_info.rpacket_price);
                        var total_price = totals - rptPrice;
                    } else {
                        rpt = '';
                        var total_price = totals;
                    }
                    if (total_price <= 0) {
                        total_price = 0;
                    }
                    $('#totalPrice,#onlineTotal').html(total_price.toFixed(2));
                });

                // 计算总价
                var total_price = totals - rptPrice;
                if (total_price <= 0) {
                    total_price = 0;
                }

                $('#totalPrice,#onlineTotal').html(total_price.toFixed(2));


                if (total_price)
                {
                    $('.price_box').show();
                }

                //积分
                if (result.data.orderSelPointsAmount)
                {
                    $('.point_box').show();
                    $('#totalPointsPrice').html((parseFloat(result.data.orderSelPointsAmount)).toFixed(0));
                }

                // 优惠券
                $.animationLeft({
                    valve: '#useVoucher',
                    wrapper: '#list-voucher-wrapper',
                    scroll: ''
                });
            }


        });
    }

    pm_recharge_card = 0;
    payment_type_id = StateCode.PAYMENT_TYPE_ONLINE;
    // 初始化
    _init();

    // 插入地址数据到html
    var insertHtmlAddress = function (address_row) {
        //console.info(address_row)
        ud_id = address_row.ud_id;

        $('#true_name').html(address_row.ud_name);
        $('#mob_phone').html(address_row.ud_mobile);
        $('#address').html(address_row.district_info + "&nbsp;&nbsp;" + address_row.ud_address);
        district_id = address_row.ud_city_id;

        province_id = address_row.ud_province_id;
        city_id = address_row.ud_city_id;
        county_id = address_row.ud_county_id;

        $.request({//获取发票内容
            type: 'post',
            url: SYS.URL.cart.checkDelivery,
            data: {
                cart_id        : cart_id,
                ifcart         : ifcart,
                ud_id          : ud_id,
                chain_id       : chain_id,
                if_chain       : if_chain,
                activity_id    : activity_id,
                ac_id          : ac_id,
                gb_id          : gb_id,
                district_id    : district_id
            },
            dataType: 'json',
            success: function (e) {

                if (e && 200 === e.status) {
                    /*if (e.data.address.need_edit)
                    //地址信息是否齐全
                        return void a.find(".J_addressModify").trigger("click");*/
                    var total_diff_freight = 0;
                    for (var i = 0; i < e.data.items.length; i++) {
                      for (var j = 0; j < e.data.items[i].items.length; j++) {
                        var store_id = e.data.items[i].items[j].store_id;
                        var old_storeFreight = $('#storeFreight' + store_id).html();
                        var diff_freight = e.data.items[i].items[j].freight - old_storeFreight;
                        $('#storeFreight' + store_id).html(e.data.items[i].items[j].freight);

                      }

                      var old_storeTotal = $("#storeTotal" + store_id).html();
                      $("#storeTotal" + store_id).html(parseFloat(e.data.items[i].productMoneySelGoods).toFixed(2));
                    }

                    var old_totalPrice = $('#totalPrice').html() ? $('#totalPrice').html() : e.data.orderSelMoneyAmount;
                    $('#totalPrice,#onlineTotal').html((parseFloat(old_totalPrice) + parseFloat(total_diff_freight)).toFixed(2));

                    if (parseFloat(old_totalPrice) + parseFloat(total_diff_freight))
                    {
                        $('.price_box').show();
                    }

                    //积分
                    if (e.data.orderSelPointsAmount)
                    {
                        $('.point_box').show();
                        $('#totalPointsPrice').html((parseFloat(e.data.orderSelPointsAmount)).toFixed(0));
                    }

                    //可配送，有货物
                    if (e.data.can_delivery && !e.data.show_oos) {
                        $('#ToBuyStep2').html(__("立即下单")).val(__("立即下单")).parent().addClass('ok');
                    }

                    //可配送，没有货
                    if (e.data.can_delivery) {
                        if (e.data.show_oos) {
                            $('#ToBuyStep2').html(__("该地区暂时缺货")).val(__("该地区暂时缺货")).parent().removeClass('ok');
                        }
                    } else {
                        //不可配送
                        $('#ToBuyStep2').html(__("暂时缺货")).val(__("暂时缺货")).parent().removeClass('ok');
                    }
                }
            }
        });

        /*if (address_api.content) {
            for (var k in address_api.content) {
                $('#storeFreight' + k).html(parseFloat(address_api.content[k]).toFixed(2));
            }
        }
        offpay_hash = address_api.offpay_hash;
        offpay_hash_batch = address_api.offpay_hash_batch;
        if (address_api.allow_offpay == 1) {
            $('#payment-offline').show();
        }
        if (!$.isEmptyObject(address_api.no_send_tpl_ids)) {
            $('#ToBuyStep2').parent().removeClass('ok');
            for (var i=0; i<address_api.no_send_tpl_ids.length; i++) {
                $('.transportId' + address_api.no_send_tpl_ids[i]).show();
            }
        } else {
            $('#ToBuyStep2').parent().addClass('ok');
        }*/
    }

    // 支付方式选择
    // 在线支付
    $('#payment-online').click(function () {
        pay_name = 'online';
        payment_type_id = StateCode.PAYMENT_TYPE_ONLINE;
        $('#select-payment-wrapper').find('.header-l > a').click();
        $('#select-payment-valve').find('.current-con').html(__('在线支付'));
        $(this).addClass('sel').siblings().removeClass('sel');
    })

    // 货到付款
    $('#payment-offline').click(function () {
        pay_name = 'offline';
        payment_type_id = StateCode.PAYMENT_TYPE_DELIVER;

        $('#select-payment-wrapper').find('.header-l > a').click();
        $('#select-payment-valve').find('.current-con').html(__('货到付款'));
        $(this).addClass('sel').siblings().removeClass('sel');
    })

    // 门店支付
    $('#payment-chain').click(function () {
        pay_name = 'chain';
        $('#select-payment-wrapper').find('.header-l > a').click();
        $('#select-payment-valve').find('.current-con').html(__('门店支付'));
        $(this).addClass('sel').siblings().removeClass('sel');
    })
    
    // 地址保存
    $.sValid.init({
        rules: {
            vtrue_name: "required",
            vmob_phone: "required",
            vdistrict_info: "required",
            vaddress: "required"
        },
        messages: {
            vtrue_name: __("姓名必填！"),
            vmob_phone: __("手机号必填！"),
            vdistrict_info: __("地区必填！"),
            vaddress: __("街道必填！")
        },
        callback: function (eId, eMsg, eRules) {
            if (eId.length > 0) {
                var errorHtml = "";
                $.map(eMsg, function (idx, item) {
                    errorHtml += "<p>" + idx + "</p>";
                });
                errorTipsShow(errorHtml);
            } else {
                errorTipsHide();
            }
        }
    });
    $('#add_address_form').find('.btn').click(function () {
        if ($.sValid()) {
            var param = {};
            param.key = key;
            param.ud_name = $('#vtrue_name').val();
            param.ud_mobile = $('#vmob_phone').val();
            param.ud_address = $('#vaddress').val();
            param.ud_county_id = county_id;
            param.ud_city_id = city_id;
            param.ud_province_id = province_id;
            param.ud_district_id = district_id;
            param.district_info = $('#vdistrict_info').val();
            param.ud_is_default = 0;


            $.request({
                type: 'post',
                url: SYS.URL.user.address_edit,
                data: param,
                dataType: 'json',
                success: function (result) {
                    if (result.status == 200) {
                        param.ud_id = result.data.ud_id;
                        // $('#add_address_form').reset();
                        _init(param.ud_id);
                        $('#new-address-wrapper,#list-address-wrapper').find('.header-l > a').click();
                    }
                }
            });
        }
    });
    // 发票选择
    $('#invoice-noneed').click(function () {
        $(this).addClass('sel').siblings().removeClass('sel');
        $('#invoice_add,#invoice-list').hide();
        user_invoice_id = 0;
    });
    $('#invoice-need').click(function () {
        $(this).addClass('sel').siblings().removeClass('sel');
        $('#invoice-list').show();
        $.request({//获取发票内容
            type: 'post',
            url: SYS.URL.user.invoice_type,
            data: {},
            dataType: 'json',
            success: function (result) {
                //checkLogin(result.login);
                var data = result.data;
                var html = '';
                $.each(data.items, function (k, v) {
                    html += '<option value="' + v + '">' + v + '</option>';
                });
                $('#inc_content').append(html);
            }
        });
        //获取发票列表
        $.request({
            type: 'post',
            url: SYS.URL.user.invoice_lists,
            data: {},
            dataType: 'json',
            success: function (result) {
                //checkLogin(result.login);
                var html = template.render('invoice-list-script', result.data);
                $('#invoice-list').html(html)
                if (result.data.items.length > 0) {
                    user_invoice_id = result.data.items[0].user_invoice_id;
                }
                $('.del-invoice').click(function () {
                    var $this = $(this);
                    var user_invoice_id = $(this).attr('user_invoice_id');
                    $.request({
                        type: 'post',
                        url: SYS.URL.user.invoice_remove,
                        data: {user_invoice_id: user_invoice_id},
                        success: function (result) {
                            if (result) {
                                $this.parents('label').remove();
                            }
                            return false;
                        }
                    });
                });
            }
        });
    })
    // 发票类型选择
    $('input[name="invoice_type"]').click(function () {
        if ($(this).val() == 'person') {
            $('#inv-title-li').hide();
        } else {
            $('#inv-title-li').show();
        }
    });
    $('#invoice-div').on('click', '#invoiceNew', function () {
        user_invoice_id = 0;
        $('#invoice_add,#invoice-list').show();
    });
    $('#invoice-list').on('click', 'label', function () {
        user_invoice_id = $(this).find('input').val();
    });
    // 发票添加
    $('#invoice-div').find('.btn-l').click(function () {
        if ($('#invoice-need').hasClass('sel')) {
            if (user_invoice_id == 0) {
                var param = {};
                param.key = key;
                param.invoice_type = $('input[name="invoice_type"]:checked').val();
                param.invoice_title = $("input[name=invoice_title]").val();
                param.invoice_content = $('select[name=invoice_content]').val();
                $.request({
                    type: 'post',
                    url: SYS.URL.user.invoice_add,
                    data: param,
                    dataType: 'json',
                    success: function (result) {
                        if (result.data.user_invoice_id > 0) {
                            user_invoice_id = result.data.user_invoice_id;
                        }
                    }
                });
                $('#invContent').html(param.invoice_title + ' ' + param.invoice_content);
            } else {
                $('#invContent').html($('#inv_' + user_invoice_id).html());
            }
        } else {
            $('#invContent').html(__('不需要发票'));
        }
        $('#invoice-wrapper').find('.header-l > a').click();
    });


    // 支付
    $('#ToBuyStep2').click(function () {
        var that = $(this);
        if ($(this).hasClass('isCheckout')) {
            toPay(order_id, 'member_buy', 'pay');
        } else {
            if ($(this).parent().hasClass('ok')) {
                var msg = '';
                for (var k in message) {
                    msg += k + '|' + message[k] + ',';
                }
                var data = {
                    cart_id          : cart_id,
                    ifcart           : ifcart,
                    ud_id            : ud_id,
                    chain_id         : chain_id,
                    if_chain         : if_chain,
                    activity_id      : activity_id,
                    ac_id            : ac_id,
                    gb_id            : gb_id,
                    vat_hash         : vat_hash,
                    offpay_hash      : offpay_hash,
                    offpay_hash_batch: offpay_hash_batch,
                    pay_name         : pay_name,
                    user_invoice_id  : user_invoice_id,
                    user_voucher_ids : [],
                    payment_type_id  : payment_type_id,
                    password         : password,
                    fcode            : fcode,
                    pm_recharge_card : pm_recharge_card,
                    rpt              : rpt,
                    pay_message      : msg,

                    checkout_row: {
                        payment_type_id    : payment_type_id,
                        //
                        delivery_type_id   : $('[name="chain"]:radio:checked').val() == 1 ? 5 : 10,
                        delivery_time_id   : 1,
                        invoice_type_id    : 1,
                        order_invoice_title: $('#invContent').html(),
                    }
                };
                if (if_chain) {
                    if (chain_id) {
                        data.chain_id = chain_id;
                    } else {
                        $.sDialog({
                            skin: "red",
                            content: __('请选择自提门店'),
                            okBtn: false,
                            cancelBtn: false
                        });
                        return false;
                    }
                }
                $('input[name="user_voucher_ids[]"]').each(function () {
                    data.user_voucher_ids.push($(this).val())
                });
                $.request({
                    type: 'post',
                    url: SYS.URL.user.order_add,
                    data: data,
                    dataType: 'json',
                    success: function (result) {
                        //checkLogin(result.login);
                        if (result.status != 200) {
                            if (result.data.mobile_is_bind == false){
                                $(document).dialog({
                                    type : 'confirm',
                                    closeBtnShow: true,
                                    content: __('未绑定手机，去绑定？'),
                                    onClickConfirmBtn: function(){
                                        window.location.href = WapSiteUrl + "/tmpl/member/member_mobile_bind.html";
                                    },
                                    onClickCancelBtn : function(){
                                    },
                                    onClickCloseBtn  : function(){
                                    }
                                });
                                return;
                            }
                            $.sDialog({
                                skin: "red",
                                content: result.msg,
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }
                        that.addClass('isCheckout');
                        if (result.data.payment_channel_code == 'offline' || result.data.is_paid) {
                            window.location.href = WapSiteUrl + '/tmpl/member/order_list.html';
                        } else {
                            delLocalStorage('cart_count');
                            order_id = result.data.order_id;
                            toPay(result.data.order_id, 'member_buy', 'pay');
                        }

                    }
                });
            }
        }
    });
});