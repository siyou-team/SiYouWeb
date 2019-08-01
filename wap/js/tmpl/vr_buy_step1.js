var key = getLocalStorage('ukey');
var item_id = getQueryString("item_id");
var quantity = getQueryString("quantity");
var data = {};
var addressFlag = true;
data.ifcart = (!isNull(getQueryString('ifcart')) && getQueryString('ifcart') != "0") ? 1 : 0;
data.key = key;
if(data.ifcart==1){
    data.cart_id = getQueryString('cart_id');
}else{
    data.cart_id = item_id+'|'+quantity;
}

data.ud_id       = 0;
data.chain_id    = !isNull(getQueryString('chain_id')) ? getQueryString('chain_id') : 0;
data.if_chain    = !isNull(getQueryString('if_chain')) ? getQueryString('if_chain') : 0;
data.activity_id = !isNull(getQueryString('activity_id')) ? getQueryString('activity_id') : 0;
data.ac_id       = !isNull(getQueryString('ac_id')) ? getQueryString('ac_id') : 0;
data.gb_id       = !isNull(getQueryString('gb_id')) ? getQueryString('gb_id') : 0;

Number.prototype.toFixed = function(d)
{
    var s=this+"";if(!d)d=0;
    if(s.indexOf(".")==-1)s+=".";s+=new Array(d+1).join("0");
    if (new RegExp("^(-|\\+)?(\\d+(\\.\\d{0,"+ (d+1) +"})?)\\d*$").test(s))
    {
        var s="0"+ RegExp.$2, pm=RegExp.$1, a=RegExp.$3.length, b=true;
        if (a==d+2){a=s.match(/\d/g); if (parseInt(a[a.length-1])>4)
        {
            for(var i=a.length-2; i>=0; i--) {a[i] = parseInt(a[i])+1;
            if(a[i]==10){a[i]=0; b=i!=1;} else break;}
        }
        s=a.join("").replace(new RegExp("(\\d+)(\\d{"+d+"})\\d$"),"$1.$2");
    }if(b)s=s.substr(1);return (pm+s).replace(/\.$/, "");} return this+"";
};

var p2f = function(f) {
    return (parseFloat(f) || 0).toFixed(2);
};

$(function() {
    $.request({
        type:'post',
        url: SYS.URL.cart.checkout,
        dataType:'json',
        data: window.data,
        success:function(result){
            var data = result.data;
            if (result.status != 200) {
                location.href = WapSiteUrl;
                return;
            }
            data.WapSiteUrl = WapSiteUrl;
            var html = template.render('goods_list', data);
            $("#deposit").html(html);

            //initInputDatePlaceholder('#virtual_service_time', 'datetime-local');
            $('#virtual_service_time').focus(function(){
                var obj = $(this);
                obj.prop('type','datetime-local');
                //obj.focus();
                //obj.click();
                setTimeout(function(){obj.trigger('click');},10);
            });

            $('#virtual_service_time').blur(function(){
                var obj = $(this);
                if(!obj.val()){
                    obj.prop('type','text');
                }
            });

            if (data.address_row.length > 0) {
                $('[name="buyerPhone"]').val(data.address_row[0].ud_mobile ? data.address_row[0].ud_mobile : "");
            }
            $('#totalPrice,#onlineTotal').html(data.orderSelMoneyAmount.toFixed(2));
            if (result.data.items[0].items[0].is_virtual) {
                if (result.data.items[0].items[0].product_valid_type == 1001) {
                    addressFlag = false;
                } else {
                    addressFlag = true;
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

            // 输入地址数据
            insertHtmlAddress(result.data.address_row[0]);
        }
    });
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



    $('#add_address_form').find(' .btn').click(function () {
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
                        insertHtmlAddress(param);
                        $('#new-address-wrapper,#list-address-wrapper').find('.header-l > a').click();
                    }
                }
            });
        }
    });
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
                data.ud_id = window.data.ud_id;
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

    // 插入地址数据到html
    var insertHtmlAddress = function (address_row) {
        window.data.ud_id = address_row.ud_id;

        $('#true_name').html(address_row.ud_name);
        $('#mob_phone').html(address_row.ud_mobile);
        if (addressFlag) {
            $('#address').html(address_row.district_info + "&nbsp;&nbsp;" + address_row.ud_address);
        }
        district_id = address_row.ud_city_id;

        province_id = address_row.ud_province_id;
        city_id = address_row.ud_city_id;
        county_id = address_row.ud_county_id;
        var params = window.data;
        params.district_id = district_id;
        $.request({
            type: 'post',
            url: SYS.URL.cart.checkDelivery,
            data: params,
            dataType: 'json',
            success: function (e) {

                if (e && 200 == e.status) {
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
                    //可配送，有货物
                    if (e.data.can_delivery && !e.data.show_oos) {
                        $('#ToBuyStep2').html("立即下单").val("立即下单").parent().addClass('ok');
                    }

                    //可配送，没有货
                    if (e.data.can_delivery) {
                        if (e.data.show_oos) {
                            $('#ToBuyStep2').html("该地区暂时缺货").val("该地区暂时缺货").parent().removeClass('ok');
                        }
                    } else {
                        //不可配送
                        $('#ToBuyStep2').html("暂时缺货").val("暂时缺货").parent().removeClass('ok');
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
    // 支付
    $('#ToBuyStep2').click(function(){
        var that = $(this);
        var buyer_phone = $('#mob_phone').html();

        if ($(this).hasClass('isCheckout')){
            toPay(order_id, 'member_buy', 'pay');
        } else {
            if ($(this).parent().hasClass('ok')) {
                var msg = $('#storeMessage').val();
                var params = {
                    mobile: buyer_phone,
                    ifcart: window.data.ifcart,
                    cart_id: window.data.cart_id,
                    ud_id: window.data.ud_id,
                    ac_id: window.data.ac_id,
                    gb_id: window.data.gb_id,
                    chain_id: window.data.chain_id,
                    if_chain: window.data.if_chain,
                    activity_id: window.data.activity_id,
                    user_invoice_id: 0,
                    user_voucher_ids: [],
                    payment_type_id: StateCode.PAYMENT_TYPE_ONLINE,
                    password: password,
                    fcode: '',
                    pm_recharge_card: 0,
                    rpt: '',
                    pay_message         : msg,
                    checkout_row: {
                        payment_type_id: StateCode.PAYMENT_TYPE_ONLINE,
                        //delivery_type_id: if_chain ? 5 : 10,
                        delivery_type_id: 10,
                        delivery_time_id: 1,
                        invoice_type_id: 1,
                        order_invoice_title: $('#invContent').html(),
                    }
                };
                if ($('#virtual_service_time').val()) {
                    params.virtual_service_date = $('#virtual_service_time').val().split(" ")[0];
                    params.virtual_service_time = $('#virtual_service_time').val();
                }
                $('input[name="user_voucher_ids[]"]').each(function(){
                    params.user_voucher_ids.push($(this).val())
                });
                $.request({
                    type:'post',
                    url: SYS.URL.user.order_add,
                    data: params,
                    dataType:'json',
                    success: function(result){
                        //checkLogin(result.login);
                        if (result.status != 200) {
                            if (result.data.mobile_is_bind == false){
                                $(document).dialog({
                                    type : 'confirm',
                                    closeBtnShow: true,
                                    content: '未绑定手机，去绑定？',
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
                        if (result.data.payment_channel_code == 'offline'  || result.data.is_paid) {
                            window.location.href = WapSiteUrl + '/tmpl/member/vr_order_list.html';
                        } else {
                            delLocalStorage('cart_count');
                            order_id = result.data.order_id;
                            toPay(result.data.order_id, 'member_vr_buy', 'pay');
                        }


                    }
                });
            }
        }
    });
});