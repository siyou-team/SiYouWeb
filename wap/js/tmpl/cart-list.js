$(function ()
{

    var key = getLocalStorage('ukey');
    if (!key)
    {
        var goods_cart = getLocalStorage('goods_cart');
        if (goods_cart == null)
        {
            var goods = '';
        }
        else
        {
            var goods = decodeURIComponent(goods_cart);
        }

        if (goods != null)
        {
            var goodsarr = goods.split('|');
        }
        else
        {
            goodsarr = {};
        }

        console.info(goodsarr);
        var rData = getCookieGoods(goods);
        /*
         var store_row = new Array();
         var sum = 0;
         if(goodsarr.length>0){
         for(var i=0;i<goodsarr.length;i++){
         var info = goodsarr[i].split(',');
         if (isNaN(info[0]) || isNaN(info[1])) continue;
         data = getGoods(info[0], info[1]);
         if ($.isEmptyObject(data)) continue;
         if (store_row.length > 0) {
         var has = false
         for (var j=0; j<store_row.length; j++) {
         if (store_row[j].store_id == data.store_id) {
         store_row[j].items.push(data);
         has = true
         }
         }
         if (!has) {
         var datas = {};
         datas.store_id = data.store_id;
         datas.store_name = data.store_name;
         datas.item_id = data.item_id;
         var goods = new Array();
         goods = [data];
         datas.items = goods;
         store_row.push(datas);
         }
         } else {
         var datas = {};
         datas.activitys = [];
         datas.bargainDiv = [];
         datas.bargains = [];
         datas.giftsDiv = [];
         datas.coudan_items = [];

         datas.store_id = data.store_id;
         datas.store_name = data.store_name;
         datas.item_id = data.item_id;
         var goods = new Array();
         goods = [data];
         datas.items = goods;
         store_row.push(datas);
         }

         sum += parseFloat(data.goods_sum);
         }
         }
         var rData = {items:store_row, sum:sum.toFixed(2), cart_count:goodsarr.length, check_out:false};
         */
        // console.info(rData);

        rData.WapSiteUrl = WapSiteUrl;
        rData.check_out = false;

        var html = template.render('cart-list', rData);
        $('#cart-list').addClass('no-login');

        if (rData.items && rData.items.length == 0)
        {
            get_footer();
        }
        else
        {
            $('footer').css('padding-top', '0');
        }

        $("#cart-list-wp").html(html);

        $('.goto-settlement,.goto-shopping').parent().hide();
        //删除购物车
        $(".goods-del").click(function ()
        {
            var $this = $(this);
            $.sDialog({
                skin: "red",
                content: __('确认删除吗？'),
                okBtn: true,
                cancelBtn: true,
                okFn: function ()
                {
                    var item_id = $this.attr('cart_id');
                    for (var i = 0; i < goodsarr.length; i++)
                    {
                        var info = goodsarr[i].split(',');
                        if (info[0] == item_id)
                        {
                            goodsarr.splice(i, 1);
                            break;
                        }
                    }
                    setLocalStorage('goods_cart', goodsarr.join('|'));
                    // 更新cookie中商品数量
                    setLocalStorage('cart_count', goodsarr.length - 1);
                    location.reload();
                }
            });
        });
        //购买数量，减
        $(".minus").click(function ()
        {
            var sPrents = $(this).parents(".cart-litemw-cnt");
            var item_id = sPrents.attr('cart_id');
            for (var i = 0; i < goodsarr.length; i++)
            {
                var info = goodsarr[i].split(',');
                if (info[0] == item_id)
                {
                    if (info[1] == 1)
                    {
                        return false;
                    }
                    info[1] = parseInt(info[1]) - 1;
                    goodsarr[i] = info[0] + ',' + info[1];
                    //sPrents.find('.buy-num').val(info[1]);

                    if (parseInt(sPrents.find('.buy-num').val()) > 0)
                    {
                        sPrents.find('.buy-num').val(parseInt(sPrents.find('.buy-num').val()) - 1);
                    }

                    break;

                }
            }
            setLocalStorage('goods_cart', goodsarr.join('|'));
        });
        //购买数量加
        $(".add").click(function ()
        {
            var sPrents = $(this).parents(".cart-litemw-cnt");
            var item_id = sPrents.attr('cart_id');

            for (var i = 0; i < goodsarr.length; i++)
            {
                var info = goodsarr[i].split(',');
                if (info[0] == item_id)
                {
                    info[1] = parseInt(info[1]) + 1;
                    goodsarr[i] = info[0] + ',' + info[1];
                    sPrents.find('.buy-num').val(parseInt(sPrents.find('.buy-num').val()) + 1);

                    break;
                }
            }

            setLocalStorage('goods_cart', goodsarr.join('|'));
        });
    }
    else
    {
        //初始化页面数据
        window.initCartData = function (result)
        {
            if (result.data.items.length == 0)
            {
                setLocalStorage('cart_count', 0);
            }

            var rData = result.data;

            rData.WapSiteUrl = WapSiteUrl;
            rData.check_out = true;
            var html = template.render('cart-list', rData);
            var activity_html = template.render('activity_list', rData);


            $("#J_choosePro").html(activity_html);

            if (rData.items.length == 0)
            {
                get_footer();
            }
            else
            {

                $('footer').css('padding-top', '0');
            }

            $("#cart-list-wp").html(html);
            //删除购物车
            $(".goods-del").click(function ()
            {
                var cart_id = $(this).attr("cart_id");
                $.sDialog({
                    skin: "red",
                    content: __('确认删除吗？'),
                    okBtn: true,
                    cancelBtn: true,
                    okFn: function ()
                    {
                        delCartList(cart_id);
                    }
                });
            });
            //购买数量，减
            $(".minus").click(minusBuyNum);
            //购买数量加
            $(".add").click(addBuyNum);
            $(".buynum").blur(buyNumer);
            // 从下到上动态显示隐藏内容
            for (var i = 0; i < result.data.items.length; i++)
            {
                $.animationUp({
                    valve: '.animation-up' + i,          // 动作触发，为空直接触发
                    wrapper: '.sstouch-bottom-mask' + i,    // 动作块
                    scroll: '.sstouch-bottom-mask-rolling' + i,     // 滚动块，为空不触发滚动
                });
            }

            // 从下到上动态显示隐藏内容
            $.each($('.J_bargainsItem') ,function (i,e) {
                var actid = $(this).data('actid');
                $.animationUp({
                    valve: '#J_activityItem-' + actid,          // 动作触发
                    wrapper: '#J_animationBox',    // 动作块
                    scroll: '.goods-detail',     // 滚动块，为空不触发滚动
                    start: function ()
                    {       // 开始动作触发事件
                        $('#J_choosePro').children('ul').addClass('hide');
                        $('#J_choosePro').children('ul.activity-items-list-' + actid).removeClass('hide');;
                    },
                    close: function ()
                    {        // 关闭动作触发事件
                        //$('.goods-detail-foot').removeClass('hide').addClass('block');
                    }
                });
            });

            //选择活动商品
            var $chooseProBtn = $('.add-cart');
            $chooseProBtn.off().on("click", function ()
            {

                var item_id = $(this).children('a').attr("item_id");
                var activity_item_id = $(this).data("activity_item_id");
                var activity_id = $(this).data("actid");
                var type = $(this).attr("data-type");
                var cart_quantity = $(this).attr("cart_quantity") ? $(this).attr("cart_quantity") : 1;

                addActivityItemToCart(item_id, activity_id, type, activity_item_id, cart_quantity);
                return 1
            })


            // 领店铺优惠券
            $('.sstouch-voucher-list').on('click', '.btn', function ()
            {
                getFreeVoucher($(this).attr('data-tid'));
            });
            $('.store-activity').click(function ()
            {
                $(this).css('height', 'auto');
            });
        }

        initCartList(false, true);

        //添加活动商品到购物车
        function addActivityItemToCart(item_id, act_id, type, activity_item_id, cart_quantity)
        {
            var i = SYS.URL.cart.add;
            $.ajax({
                url: i,
                dataType: "json",
                data: "item_id=" + item_id + "&activity_id=" + act_id + "&cart_type=" + type + "&activity_item_id=" + activity_item_id + "&cart_quantity=" + cart_quantity,
                jsonp: "jsonp_callback",
                timeout: 1e4,
                error: function ()
                {
                    parent.Public.tips({type: 1, content: __('网络请求超时')})
                },
                success: function (result)
                {
                    200 === result.status ? (initCartList(true, true),$('#J_animationBox').removeClass('up').addClass('down')) : parent.Public.tips({type: 1, content: result.msg});
                }
            })
        }
        //删除购物车
        function delCartList(cart_id)
        {
            $.request({
                url: SYS.URL.cart.remove,
                type: "post",
                data: {cart_id: cart_id},
                dataType: "json",
                success: function (res)
                {
                    if (res.status == 200)
                    {
                        delLocalStorage('cart_count');

                        // 更新购物车中商品数量
                        getCartCount(key, 60, true, true);

                        //initCartList(true);
                    }
                    else
                    {
                        parent.Public.tips({type: 1, content: res.msg});
                    }
                }
            });
        }

        //购买数量减
        function minusBuyNum()
        {
            var self = this;
            editQuantity(self, "minus");
        }

        //购买数量加
        function addBuyNum()
        {
            var self = this;
            editQuantity(self, "add");
        }

        //购买数量增或减，请求获取新的价格
        function editQuantity(self, type)
        {
            var sPrents = $(self).parents(".cart-litemw-cnt");
            var cart_id = sPrents.attr("cart_id");
            var numInput = sPrents.find(".buy-num");
            var goodsPrice = sPrents.find(".goods-price");
            var buynum = parseInt(numInput.val());
            var quantity = 1;
            var step = 0;

            if (type == "add")
            {
                step = 1;
                quantity = parseInt(1);
            }
            else
            {
                step = 1;

                if (buynum > 1)
                {
                    quantity = parseInt(-1);
                }
                else
                {
                    return false;
                }
            }

            $('.pre-loading').show();

            $.request({
                url: SYS.URL.cart.quantity,
                type: "post",
                data: {cart_id: cart_id, cart_quantity: quantity, step:step},
                dataType: "json",
                success: function (res)
                {
                    if (res.status == 200)
                    {
                        initCartData(res);
                        initCartList(true, false);
                        /*
                         numInput.val(quantity);
                         goodsPrice.html('￥<em>' + res.datas.item_unit_price + '</em>');
                         calculateTotalPrice();
                         */
                    }
                    else
                    {
                        $.sDialog({
                            skin: "red",
                            content: res.msg,
                            okBtn: false,
                            cancelBtn: false
                        });
                    }

                    $('.pre-loading').hide();
                }
            });
        }

        //去结算
        $('#cart-list-wp').on('click', ".check-out > a", function ()
        {
            if (!$(this).parent().hasClass('ok'))
            {
                return false;
            }
            //购物车ID
            var cartIdArr = [];
            $('.cart-litemw-cnt').each(function ()
            {
                if ($(this).find('input[name="cart_id"]').prop('checked'))
                {
                    var cartId = $(this).find('input[name="cart_id"]').val();
                    var cartNum = parseInt($(this).find('.value-box').find("input").val());
                    var cartIdNum = cartId + "|" + cartNum;
                    cartIdArr.push(cartIdNum);
                }
            });
            var cart_id = cartIdArr.toString();
            window.location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id=" + cart_id;
        });

        //验证
        $.sValid.init({
            rules: {
                buynum: "digits"
            },
            messages: {
                buynum: __("请输入正确的数字")
            },
            callback: function (eId, eMsg, eRules)
            {
                if (eId.length > 0)
                {
                    var errorHtml = "";
                    $.map(eMsg, function (idx, item)
                    {
                        errorHtml += "<p>" + idx + "</p>";
                    });
                    $.sDialog({
                        skin: "red",
                        content: errorHtml,
                        okBtn: false,
                        cancelBtn: false
                    });
                }
            }
        });
        function buyNumer()
        {
            $.sValid();
        }
    }

    // 店铺全选
    $('#cart-list-wp').on('click', '.store_checkbox', function ()
    {
        $(this).parents('.sstouch-cart-container').find('input[name="cart_id"]').prop('checked', $(this).prop('checked'));

        var store_id = $(this).val();;
        var cart_select = $(this).prop('checked') ? 1 : 0;


        $.request({
            url: SYS.URL.cart.sel,
            type: "post",
            data: {store_id: store_id, cart_select: cart_select},
            dataType: "json",
            success: function (res)
            {
                if (res.status == 200)
                {
                    initCartData(res);
                    initCartList(true, false);
                }
                else
                {
                    $.sDialog({
                        skin: "red",
                        content: res.msg,
                        okBtn: false,
                        cancelBtn: false
                    });
                }
            }
        });


        //calculateTotalPrice();
    });
    // 所有全选
    $('#cart-list-wp').on('click', '.all_checkbox', function ()
    {
        $('#cart-list-wp').find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));


        var cart_id = [];
        var cart_select = $(this).prop('checked') ? 1 : 0;

        $('#cart-list-wp').find('input[type="checkbox"][name="cart_id"]').each(function(){cart_id.push($(this).val())})



        $.request({
            url: SYS.URL.cart.sel,
            type: "post",
            data: {cart_id: cart_id, cart_select: cart_select},
            dataType: "json",
            success: function (res)
            {
                if (res.status == 200)
                {
                    initCartData(res);
                    initCartList(true, false);
                }
                else
                {
                    $.sDialog({
                        skin: "red",
                        content: res.msg,
                        okBtn: false,
                        cancelBtn: false
                    });
                }
            }
        });

        //calculateTotalPrice();

    })

    $('#cart-list-wp').on('click', 'input[name="cart_id"]', function ()
    {
        var cart_id = $(this).val();;
        var cart_select = $(this).prop('checked') ? 1 : 0;


        $.request({
            url: SYS.URL.cart.sel,
            type: "post",
            data: {cart_id: cart_id, cart_select: cart_select},
            dataType: "json",
            success: function (res)
            {
                if (res.status == 200)
                {
                    initCartData(res);
                    initCartList(true, false);
                }
                else
                {
                    $.sDialog({
                        skin: "red",
                        content: res.msg,
                        okBtn: false,
                        cancelBtn: false
                    });
                }
            }
        });

        //calculateTotalPrice();
    });


});

function calculateTotalPrice()
{
    var totalPrice = parseFloat("0.00");
    $('.cart-litemw-cnt').each(function ()
    {
        if ($(this).find('input[name="cart_id"]').prop('checked'))
        {cart_selectcart_select
            totalPrice += parseFloat($(this).find('.goods-price').find('em').html()) * parseInt($(this).find('.value-box').find('input').val());
        }
    });
    $(".total-money").find('em').html(totalPrice.toFixed(2));
    check_button();
    return true;
}


function getCookieGoods(cart_id)
{
    var data = {};
    $.request({
        type: 'get',
        url: SYS.URL.cart.cookie + '&cart_id=' + cart_id,
        dataType: 'json',
        async: false,
        success: function (result)
        {
            if (result.status != 200)
            {
                return false;
            }

            data = result.data
            /*
             var pic = result.data[item_id].product_image;
             data.cart_id = 0;
             data.store_id = result.data[item_id].store_id;
             data.store_name = result.data[item_id].store_name;
             data.item_id = item_id;
             data.product_item_name = result.data[item_id].product_item_name;
             data.item_unit_price = result.data[item_id].item_unit_price;
             data.cart_quantity = goods_num;
             data.product_image = pic;
             data.goods_sum = (parseInt(goods_num)*parseFloat(result.data[item_id].item_unit_price)).toFixed(2);

             data.activity_item_row = []
             data.activity_type_id = []
             data.elementsGoods = []
             data.item_image_row = []
             data.item_name = []
             data.item_spec = []
             data.product_spec = []
             data.product_uniqid = []
             data.properties = []
             data.pulse_bargains = []
             data.pulse_bargains_cart = []
             */
        }
    });
    return data;
}


function getGoodsbbb(item_id, goods_num)
{
    $('.pre-loading').show();

    var data = {};
    $.request({
        type: 'get',
        url: SYS.URL.get + '&item_id=' + item_id,
        dataType: 'json',
        async: false,
        success: function (result)
        {
            $('.pre-loading').hide();

            if (result.status != 200)
            {
                return false;
            }

            var pic = result.data[item_id].product_image;
            data.cart_id = 0;
            data.store_id = result.data[item_id].store_id;
            data.store_name = result.data[item_id].store_name;
            data.item_id = item_id;
            data.product_item_name = result.data[item_id].product_item_name;
            data.item_unit_price = result.data[item_id].item_unit_price;
            data.cart_quantity = goods_num;
            data.product_image = pic;
            data.goods_sum = (parseInt(goods_num) * parseFloat(result.data[item_id].item_unit_price)).toFixed(2);

            data.activity_item_row = []
            data.activity_type_id = []
            data.elementsGoods = []
            data.item_image_row = []
            data.item_name = []
            data.item_spec = []
            data.product_spec = []
            data.product_uniqid = []
            data.properties = []
            data.pulse_bargains = []
            data.pulse_bargains_cart = []
        }
    });
    return data;
}

function get_footer()
{
    footer = true;
    $.request({
        type:'get',
        url: WapSiteUrl + '/js/tmpl/footer.js',
        dataType: "script",
        type:'get',
        cache:true
    });
}

function check_button()
{
    var _has = false
    $('input[name="cart_id"]').each(function ()
    {
        if ($(this).prop('checked'))
        {
            _has = true;
        }
    });
    if (_has)
    {
        $('.check-out').addClass('ok');
    }
    else
    {
        $('.check-out').removeClass('ok');
    }
}
//v5.2 添加登录后，返回购物车
function car_login()
{
    setLocalStorage('redirect_uri', '/tmpl/cart_list.html');
    window.location.href = '../tmpl/member/login.html';
}
function car_register()
{
    setLocalStorage('redirect_uri', '/tmpl/cart_list.html');
    window.location.href = '../tmpl/member/register.html';
}