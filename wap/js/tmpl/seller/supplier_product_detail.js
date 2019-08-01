var item_id = getQueryString("item_id");
var product_id = getQueryString("product_id");
var map_list = [];
var map_index_id = '';
var store_id;
var chain_id = 0;
var chain_map_list = new Array();
var _wap_wx = 0;
var ua = navigator.userAgent.toLowerCase();

localStorage.clear();

if (!ifLogin()){}

if (isWeixin())
{
    _wap_wx = 1;
    loadJs("https://res.wx.qq.com/open/js/jweixin-1.2.0.js");
}

$(function ()
{
    var key = getLocalStorage('ukey');

    var unixTimeToDateString = function (ts, ex)
    {
        ts = parseFloat(ts) || 0;
        if (ts < 1)
        {
            return '';
        }
        var d = new Date();
        d.setTime(ts * 1e3);
        var s = '' + d.getFullYear() + '-' + (1 + d.getMonth()) + '-' + d.getDate();
        if (ex)
        {
            s += ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
        }
        return s;
    };

    var buyLimitation = function (a, b)
    {
        a = parseInt(a) || 0;
        b = parseInt(b) || 0;
        var r = 0;
        if (a > 0)
        {
            r = a;
        }
        if (b > 0 && r > 0 && b < r)
        {
            r = b;
        }
        return r;
    };

    // 图片轮播
    function picSwipe()
    {
        var elem = $("#mySwipe")[0];
        window.mySwipe = Swipe(elem, {
            continuous: false,
            // disableScroll: true,
            stopPropagation: true,
            callback: function (index, element)
            {
                $('.goods-detail-turn').find('li').eq(index).addClass('cur').siblings().removeClass('cur');
            }
        });
    }

    get_detail(window.item_id);
    //点击商品规格，获取新的商品
    function arrowClick(self, myData)
    {
        $(self).addClass("current").siblings().removeClass("current");
        //拼接属性
        var curEle = $(".spec").find("a.current");
        var curSpec = [];
        $.each(curEle, function (i, v)
        {
            // convert to int type then sort
            curSpec.push(parseInt($(v).attr("specs_value_id")) || 0);
        });
        var spec_string = curSpec.sort(function (a, b)
        {
            return a - b;
        }).join("-");
        //获取商品ID
        window.item_id = myData.product_uniqid[spec_string][0];
        get_detail(window.item_id);
    }

    function contains(arr, str)
    {//检测item_id是否存入
        var i = arr.length;
        while (i--)
        {
            if (arr[i] === str)
            {
                return true;
            }
        }
        return false;
    }

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
    //检测商品数目是否为正整数
    function buyNumer()
    {
        $.sValid();
    }


    function get_detail(item_id, refresh)
    {

        if (typeof refresh == 'undefined')
        {
            refresh = false
        }

        //渲染页面
        $.request({
            url: SYS.URL.supplier.item,
            type: "get",
            data: {
                item_id: item_id,
                product_id: product_id,
            },
            dataType: "json",
            ajaxCache: {
                cacheValidate: function (res, options)
                {
                    return res.status === 200;
                },

                timeout: SYS.CACHE_EXPIRE,
                forceRefresh: refresh
            },


            success: function (result)
            {
                if (result.status == 200)
                {
                    var data = result.data;

                    window.item_id      = data.item_row.item_id;
                    window.unit_price   = data.item_row.item_unit_price;
                    window.sale_price   = data.item_row.item_sale_price;
                    window.store_id     = data.store_info.store_id;
                    window.product_id   = data.item_row.product_id;
                   
                    /*
                     //商品图片格式化数据
                     if(data.item_row.product_image){
                     var product_image = data.item_row.product_image.split(",");
                     data.item_row.product_image = product_image;
                     }else{
                     data.product_image = [];
                     }
                     */

                    //商品规格格式化数据
                    if (data.item_row.spec_name)
                    {
                        var goods_map_spec = $.map(data.item_row.spec_name, function (v, i)
                        {
                            var goods_specs = {};
                            goods_specs["goods_spec_id"] = i;
                            goods_specs['goods_spec_name'] = v;
                            if (data.item_row.spec_value)
                            {
                                $.map(data.item_row.spec_value, function (vv, vi)
                                {
                                    if (i == vi)
                                    {
                                        goods_specs['goods_spec_value'] = $.map(vv, function (vvv, vvi)
                                        {
                                            var specs_value = {};
                                            specs_value["specs_value_id"] = vvi;
                                            specs_value["specs_value_name"] = vvv;
                                            return specs_value;
                                        });
                                    }
                                });
                                return goods_specs;
                            }
                            else
                            {
                                data.item_row.spec_value = [];
                            }
                        });
                        data.goods_map_spec = goods_map_spec;
                    }
                    else
                    {
                        data.goods_map_spec = [];
                    }

                    // 虚拟商品限购时间和数量
                    if (data.item_row.is_virtual == '1')
                    {
                        data.item_row.virtual_indate_str = unixTimeToDateString(data.item_row.virtual_indate, true);
                        data.item_row.buyLimitation = buyLimitation(data.item_row.virtual_limit, data.item_row.upper_limit);
                    }

                    // 预售发货时间
                    if (data.item_row.is_presell == '1')
                    {
                        data.item_row.presell_deliverdate_str = unixTimeToDateString(data.item_row.presell_deliverdate);
                    }

                 

                    // console.log(data);return false;

                    //渲染模板
                    var html = template.render('product_detail', data);
                    $("#product_detail_html").html(html);

                    if (data.item_row.is_virtual == '0')
                    {
                        $('.goods-detail-o2o').remove();
                    }
                    else
                    {
                        $('.goods-detail-o2o').hide();
                    }

                    //渲染模板
                    var html = template.render('product_detail_sepc', data);
                    $("#product_detail_spec_html").html(html);

                    //渲染模板
                    var html = template.render('voucher_script', data);
                    $("#voucher_html").html(html);

                    $('.no-buy a').html(__("暂时缺货"));


                    document.title = sprintf("%s  %s", data.item_row.product_item_name, document.title);

                    //var html = template.render('product_title', data);
                    //$("head").append(html);

                    /* $('.group_count_down').ClassyLED({
                         type: 'countdown',
                         format: 'ddd:hh:mm:ss',
                         countTo: result.data.item_row.activity_item_row.activity_endtime ? result.data.item_row.activity_item_row.activity_endtime : "0000:00:00",
                         color: '#ff0000',
                         backgroundColor: '#ffffff',
                         size: 3,
                         fontType: 2
                     });*/
                   

                    if (data.item_row.is_chain == '1')
                    {
                        store_id = data.store_info.store_id;
                        chain();
                    }
                    else
                    {
                        $('.goods-detail-chain').remove();
                    }
                    // 购物车中商品数量
                    if (getLocalStorage('cart_count'))
                    {
                        if (getLocalStorage('cart_count') > 0)
                        {
                            $('#cart_count,#cart_count1').html('<sup>' + getLocalStorage('cart_count') + '</sup>');
                        }
                    }

                    //图片轮播
                    picSwipe();

                    //商品描述
                    $(".pddcp-arrow").click(function ()
                    {
                        $(this).parents(".pddcp-one-wp").toggleClass("current");
                    });
                    //规格属性
                    var myData = {};
                    myData["product_uniqid"] = data.item_row.product_uniqid;
                    $(".spec a").click(function ()
                    {
                        var self = this;
                        arrowClick(self, myData);
                    });
                    //购买数量，减
                    $(".minus").click(function ()
                    {
                        var buynum = $(".buy-num").val();
                        if (buynum > 1)
                        {
                            $(".buy-num").val(parseInt(buynum - 1));
                        }
                    });
                    //购买数量加
                    $(".add").click(function ()
                    {
                        var buynum = parseInt($(".buy-num").val());
                        if (buynum < data.item_row.item_quantity)
                        {
                            $(".buy-num").val(parseInt(buynum + 1));
                        }
                    });
                    // 一个F码限制只能购买一件商品 所以限制数量为1
                    if (data.item_row.is_fcode == '1')
                    {
                        $('.minus').hide();
                        $('.add').hide();
                        $(".buy-num").attr('readOnly', true);
                    }
                    //收藏
                    $(".pd-collect").click(function ()
                    {
                        if ($(this).hasClass('favorite'))
                        {
                            if (dropFavoriteGoods(0, window.item_id))
                            {
                                $(this).removeClass('favorite');
                            }
                        }
                        else
                        {
                            if (favoriteGoods(window.item_id))
                            {
                                $(this).addClass('favorite');
                            }
                        }
                    });
                    //加入购物车
                    $("#add-cart").click(function ()
                    {
                        var key = getLocalStorage('ukey');//登录标记
                        var quantity = parseInt($(".buy-num").val());
                        if (!key)
                        {
                            var goods_cart = getLocalStorage('goods_cart');
                            if (goods_cart == null)
                            {
                                item_row = '';
                            }
                            else
                            {
                                var item_row = decodeURIComponent(goods_cart);
                            }

                            if (window.item_id < 1)
                            {
                                show_tip();
                                return false;
                            }
                            var cart_count = 0;
                            if (!item_row)
                            {
                                item_row = window.item_id + ',' + quantity;
                                cart_count = 1;
                            }
                            else
                            {
                                var goodsarr = item_row.split('|');
                                for (var i = 0; i < goodsarr.length; i++)
                                {
                                    var arr = goodsarr[i].split(',');
                                    if (contains(arr, window.item_id))
                                    {
                                        show_tip();
                                        return false;
                                    }
                                }
                                item_row += '|' + window.item_id + ',' + quantity;
                                cart_count = goodsarr.length;
                            }
                            // 加入cookie
                            setLocalStorage('goods_cart', item_row);
                            // 更新cookie中商品数量
                            setLocalStorage('cart_count', cart_count);
                            show_tip();
                            getCartCount(key, 60, true);
                            $('#cart_count,#cart_count1').html('<sup>' + cart_count + '</sup>');
                            return false;
                        }
                        else
                        {
                            $.request({
                                url: SYS.URL.cart.add,
                                data: {item_id: window.item_id, quantity: quantity},
                                type: "post",
                                success: function (result)
                                {
                                    var rData = result;
                                    if (result.status == 200)
                                    {
                                        show_tip();
                                        // 更新购物车中商品数量
                                        delLocalStorage('cart_count');
                                        getCartCount(key, 60, true);
                                        $('#cart_count,#cart_count1').html('<sup>' + getLocalStorage('cart_count') + '</sup>');
                                    }
                                    else
                                    {
                                        $.sDialog({
                                            skin: "red",
                                            content: rData.msg,
                                            okBtn: false,
                                            cancelBtn: false
                                        });
                                    }
                                }
                            })
                        }
                    });

                    //立即购买
                    if (data.item_row.is_virtual == '1')
                    {
                        $("#buy-now").click(function ()
                        {
                            var key = getLocalStorage('ukey');//登录标记
                            if (!key)
                            {
                                //v5.2 添加登录后，返回商品页
                                setLocalStorage('redirect_uri', '/tmpl/product_detail.html?item_id=' + window.item_id);
                                checkLogin(0);// window.location.href = WapSiteUrl+'/tmpl/member/login.html';
                                return false;
                            }

                            var buynum = parseInt($('.buy-num').val()) || 0;

                            if (buynum < 1)
                            {
                                $.sDialog({
                                    skin: "red",
                                    content: __('参数错误！'),
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return;
                            }
                            if (buynum > data.item_row.item_quantity)
                            {
                                $.sDialog({
                                    skin: "red",
                                    content:  __('库存不足！'),
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return;
                            }

                            // 虚拟商品限购数量
                            if (data.item_row.buyLimitation > 0 && buynum > data.item_row.buyLimitation)
                            {
                                $.sDialog({
                                    skin: "red",
                                    content:  __('超过限购数量！'),
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return;
                            }

                            var json = {};
                            json.key = key;
                            json.cart_id = window.item_id;
                            json.quantity = buynum;
                            $.request({
                                type: 'post',
                                url: SYS.URL.cart.checkout,
                                data: json,
                                dataType: 'json',
                                success: function (result)
                                {
                                    if (result.status != 200)
                                    {
                                        $.sDialog({
                                            skin: "red",
                                            content: result.msg,
                                            okBtn: false,
                                            cancelBtn: false
                                        });
                                    }
                                    else
                                    {
                                        location.href = WapSiteUrl + '/tmpl/order/vr_buy_step1.html?item_id=' + window.item_id + '&quantity=' + buynum;
                                    }
                                }
                            });
                        });
                    }
                    else
                    {
                        $("#buy-now").click(function ()
                        {
                            var key = getLocalStorage('ukey');//登录标记
                            if (!key)
                            {
                                //v5.2 添加登录后，返回商品页
                                setLocalStorage('redirect_uri', '/tmpl/product_detail.html?item_id=' + window.item_id);
                                checkLogin(0);// window.location.href = WapSiteUrl+'/tmpl/member/login.html';
                            }
                            else
                            {
                                var buynum = parseInt($('.buy-num').val()) || 0;

                                if (buynum < 1)
                                {
                                    $.sDialog({
                                        skin: "red",
                                        content:  __('参数错误！'),
                                        okBtn: false,
                                        cancelBtn: false
                                    });
                                    return;
                                }
                                if (buynum > data.item_row.item_quantity)
                                {
                                    $.sDialog({
                                        skin: "red",
                                        content:  __('库存不足！'),
                                        okBtn: false,
                                        cancelBtn: false
                                    });
                                    return;
                                }

                                var json = {};
                                json.key = key;
                                json.cart_id = window.item_id + '|' + buynum;
                                $.request({
                                    type: 'post',
                                    url: SYS.URL.cart.checkout,
                                    data: json,
                                    dataType: 'json',
                                    success: function (result)
                                    {
                                        if (result.status != 200)
                                        {
                                            $.sDialog({
                                                skin: "red",
                                                content: result.msg,
                                                okBtn: false,
                                                cancelBtn: false
                                            });
                                        }
                                        else
                                        {
                                            location.href = WapSiteUrl + '/tmpl/order/vr_buy_step1.html?item_id=' + window.item_id + '&quantity=' + buynum;
                                        }
                                    }
                                });
                            }
                        });

                    }

                   //申请分销商
                    $('#apply-to').click(function(){
                        applyDistritor( store_id );
                    })

                    //一键上架分销商品
                    $('#upload-to').click(function(){
                        uploadDisProduct( product_id );
                    })

                    if (_wap_wx) {
                        $.ajax({
                            url: SYS.URL.wx.config,
                            data: {
                                href: location.href, item_name: data.item_row.product_item_name, product_image:data.item_row.product_image, product_tips:data.item_row.product_tips, _pjax:1, fancybox:1
                            },
                            dataType: 'script',
                            success: function (result) {

                                wx.ready(function () {
                                    var img_url = '';

                                    var uid = getLocalStorage('uid');
                                    var link = location.href;

                                    if (uid)
                                    {
                                        link = link +  '&FX=' + uid;
                                    }
                                    else
                                    {

                                    }


                                    if(data.item_row.product_image.indexOf("https") == 0 || data.item_row.product_image.indexOf("http"))
                                    {
                                        img_url = data.item_row.product_image;
                                    }
                                    else
                                    {
                                        if(SYS.HTTPS)
                                        {
                                            img_url = "http:" + data.item_row.product_image;
                                        }
                                        else
                                        {
                                            img_url = "https:" + data.item_row.product_image;
                                        }
                                    }


                                    wx.onMenuShareTimeline({
                                        title: data.item_row.product_item_name, //分享标题
                                        link: link, //分享链接
                                        imgUrl: img_url, //分享图标
                                        success: function () {
                                        },
                                        cancel: function () {
                                        }
                                    });

                                    wx.onMenuShareAppMessage({
                                        title: data.item_row.product_item_name, //分享标题
                                        desc: data.item_row.product_tips, //分享描述
                                        link: link, //分享链接
                                        imgUrl: img_url, //分享图标
                                        type: 'link',
                                        dataUrl: '',
                                        success: function () {
                                        },
                                        cancel: function () {
                                        }
                                    });

                                    wx.onMenuShareQQ({
                                        title: data.item_row.product_item_name, //分享标题
                                        desc: data.item_row.product_tips, //分享描述
                                        link: link, //分享链接
                                        imgUrl: img_url, //分享图标
                                        success: function () {
                                        },
                                        cancel: function () {
                                        }
                                    });

                                    wx.onMenuShareWeibo({
                                        title: data.item_row.product_item_name, //分享标题
                                        desc: data.item_row.product_tips, //分享描述
                                        link: link, //分享链接
                                        imgUrl: img_url, //分享图标
                                        success: function () {
                                        },
                                        cancel: function () {
                                        }
                                    });

                                    wx.onMenuShareQZone({
                                        title: data.item_row.product_item_name, //分享标题
                                        desc: data.item_row.product_tips, //分享描述
                                        link: link, //分享链接
                                        imgUrl: img_url, //分享图标
                                        success: function () {
                                        },
                                        cancel: function () {
                                        }
                                    });

                                    /*
                                    wx.openAddress({
                                        success : function(result){

                                            //此处获取到地址信息，可做自己的业务操作
                                            alert('收货人姓名' + result.userName);
                                            alert('收货人电话' + result.telNumber);
                                            alert('邮编' + result.postalCode);
                                            alert('国标收货地址第一级地址' + result.provinceName);
                                            alert('国标收货地址第二级地址' + result.cityName);
                                            alert('国标收货地址第三级地址' + result.countryName);
                                            alert('详细收货地址信息' + result.detailInfo);
                                            alert('收货地址国家码' + result.nationalCode);
                                        }
                                    });
                                    */


                                });

                                _wap_wx = 0;
                            }
                        });
                    }
                }
                else
                {

                    $.sDialog({
                        content: result.msg +  __('！<br>请返回上一页继续操作…'),
                        okBtn: false,
                        cancelBtnText:  __('返回'),
                        cancelFn: function ()
                        {
                            history.back();
                        }
                    });
                }

                //验证购买数量是不是数字
                $("#buynum").blur(buyNumer);


                // 从下到上动态显示隐藏内容
                $.animationUp({
                    valve: '.animation-up,#goods_spec_selected',          // 动作触发
                    wrapper: '#product_detail_spec_html',    // 动作块
                    scroll: '#product_roll',     // 滚动块，为空不触发滚动
                    start: function ()
                    {       // 开始动作触发事件
                        $('.goods-detail-foot').addClass('hide').removeClass('block');
                    },
                    close: function ()
                    {        // 关闭动作触发事件
                        $('.goods-detail-foot').removeClass('hide').addClass('block');
                    }
                });

                $.animationUp({
                    valve: '#getVoucher',          // 动作触发
                    wrapper: '#voucher_html',    // 动作块
                    scroll: '#voucher_roll',     // 滚动块，为空不触发滚动
                });

                $('#voucher_html').on('click', '.btn', function ()
                {
                    getFreeVoucher($(this).attr('data-tid'));
                });

                // 联系客服
                $('.kefu').click(function ()
                {
                    if (typeof data.store_info.im_chat != 'undefined' && data.store_info.im_chat)
                    {
                        window.location.href = WapSiteUrl + '/tmpl/member/chat_info.html?item_id=' + window.item_id + '&user_other_id=' + data.store_info.user_id  + '&puid=' + data.store_info.puid;
                    }
                    else
                    {
                        window.location.href = "http://wpa.qq.com/msgrd?v=3&uin=" + result.data.store_info.store_qq + "&site=qq&menu=yes";
                    }


                })
            }
        });
    }

    $.scrollTransparent();
    $('#product_detail_html').on('click', '#get_area_selected', function ()
    {
        $.areaSelected({
            success: function (data)
            {
                $('#get_area_selected_name').html(data.district_info);
                var district_id = data.district_id_2 == 0 ? data.district_id_1 : data.district_id_2;
                $.getJSON(SYS.URL.product.shipping_district, {
                    item_id: window.item_id,
                    district_id: district_id
                }, function (result)
                {
                    $('#get_area_selected_whether').html(result.data.product_freight_info.if_store_cn);
                    $('#get_area_selected_content').html(result.data.product_freight_info.content);
                    if (!result.data.product_freight_info.if_store)
                    {
                        $('.buy-handle').addClass('no-buy');
                    }
                    else
                    {
                        $('.buy-handle').removeClass('no-buy');
                    }
                });
            }
        });
    });

    $('body').on('click', '.general', function(){
        $('.item_price').html(window.unit_price);
    })

    $('body').on('click', '.groupbooking', function(){
        $('.item_price').html(window.sale_price);
    })



    $('body').on('click', '#goodsBody,#goodsBody1', function ()
    {
        window.location.href = WapSiteUrl + '/tmpl/product_info.html?item_id=' + window.item_id;
    });

    $('body').on('click', '#goodsBody2,#goodsBody3', function ()
    {
        window.location.href = WapSiteUrl + '/tmpl/share_product_info.html?item_id=' + window.item_id;
    });

    $('body').on('click', '#goodsEvaluation,#goodsEvaluation1', function ()
    {
        window.location.href = WapSiteUrl + '/tmpl/product_eval_list.html?item_id=' + window.item_id;
    });

    $('#list-address-scroll').on('click', 'dl > a', map);
    $('#map_all').on('click', map);

    $('body').on('click', '#add_small_shop', add_small_shop);
});


function show_tip()
{
    var flyer = $('.goods-pic > img').clone().css({'z-index': '999', 'height': '3rem', 'width': '3rem'});
    flyer.fly({
        start: {
            left: $('.goods-pic > img').offset().left,
            top: $('.goods-pic > img').offset().top - $(window).scrollTop()
        },
        end: {
            left: $("#cart_count1").offset().left + 40,
            top: $("#cart_count1").offset().top - $(window).scrollTop(),
            width: 0,
            height: 0
        },
        onEnd: function ()
        {
            flyer.remove();
        }
    });
}


function map()
{
    $('#map-wrappers').removeClass('hide').removeClass('right').addClass('left');
    $('#map-wrappers').on('click', '.header-l > a', function ()
    {
        $('#map-wrappers').addClass('right').removeClass('left');
    });
    $('#baidu_map').css('width', document.body.clientWidth);
    $('#baidu_map').css('height', document.body.clientHeight);
    map_index_id = $(this).attr('index_id');
    if (typeof map_index_id != 'string')
    {
        map_index_id = '';
    }
    if (typeof(map_js_flag) == 'undefined')
    {
        $.request({
            type:'get',
            cache:true,
            url: WapSiteUrl + '/js/map.js',
            dataType: "script",
            async: false
        });
    }
    if (typeof BMap == 'object')
    {
        baidu_init();
    }
    else
    {
        load_script();
    }
}

function chain_buy(_id)
{
    chain_id = _id;
    $('#buy-now').click();
}

function chain()
{
    $.getJSON(SYS.URL.store.listChainByItem, {store_id: store_id, item_id: item_id}, function (result)
    {
        if (200 == result.status)
        {
            if (result.data.items.length > 0)
            {
                $('.goods-detail-chain').removeClass('hide');

                $('#list-chain-ul').html(template.render('list-chain-script', result.data));
                chain_map_list = result.data.items;
                map_list = chain_map_list;

                var _html = '';
                _html += '<dl  index_id="0" chain_district_id="' + chain_map_list[0].chain_district_id + '" chain_area_info="' + chain_map_list[0].chain_district_info + '">';
                _html += '<dt>' + chain_map_list[0].chain_name + '</dt>';
                _html += '<dd>' + __('门店价格:') + __('￥') + chain_map_list[0].chain_item_unit_price +'</dd>';
                _html += '<dd>' + __('门店地址:') + chain_map_list[0].chain_address + '，'+ __('电话：') + chain_map_list[0].chain_mobile + '</dd>';
                _html += '</dl>';
                _html += '<p><a href="javascript:chain_buy(' + chain_map_list[0].chain_id + ');"><i class="zc zc-cart-fill"></i></a></p>';
                $('#goods-detail-chain').html(_html);


                $('#goods-detail-chain').on('click', 'dl', map);

                if (result.data.records > 1)
                {
                    $('#store_chain_list').html( __('查看全部') + result.data.records +  __('家门店地址'));
                }
                else
                {
                    $('#store_chain_list').html( __('查看门店地址'));
                }
                $('#chain_all').html(result.data.records);
                $('#chain_area_info').html('<option value="">' + __('所有城区') + '</option>');
                $.each(chain_map_list, function (k, v)
                {
                    if ($('#chain_area_info').find("[value='" + v.chain_district_id + "']").length == 0)
                    {
                        $('#chain_area_info').append('<option value="' + v.chain_district_id + '">' + v.chain_district_info + '</option>');
                    }
                });
                $('#chain_area_info').on('change', function ()
                {
                    var chain_district_id = $("#chain_area_info").val();
                    if (chain_district_id == '')
                    {
                        $('#list-chain-ul li').show();
                    }
                    else
                    {
                        $('#list-chain-ul li').hide();
                        $('#list-chain-ul').find("li[chain_district_id='" + chain_district_id + "']").show();
                    }
                });
            }
            else
            {
                $('.goods-detail-chain').addClass('hide');
            }
        }
    });
    $.animationLeft({
        valve: '#store_chain_list',
        wrapper: '#list-chain-wrapper',
        scroll: '#list-chain-scroll'
    });
}

function takeCount()
{
    var obj = $('.count-time');
    $.leftTime(obj.data('end'),function(d){
        if(d.status){
            obj.find("[time_id='d']").text(d.d);
            obj.find("[time_id='h']").text(d.h);
            obj.find("[time_id='m']").text(d.m);
            obj.find("[time_id='s']").text(d.s);
        }
    });
}

// 加入小店
function add_small_shop()
{
    var item_id = window.item_id, store_id = window.store_id, product_id = window.product_id;

    $.ajax({
        url: SYS.URL.product.store_directseller_add,
        type: "get",
        data: {item_id:item_id, store_id:store_id, product_id:product_id},
        dataType: "json",
        success: function (result)
        {
            if(result.status == 200)
            {
                alert(result.msg);
            }
            else
            {
                alert(result.msg);
            }
        }
    })
}

function applyDistritor( store_id ){
    $.request({
        type: "POST",
        url: SYS.URL.distribution.applyDistritor,
        dataType: "json",
        data: {
            store_id: store_id,
        },
        error: function () {
            $.sDialog({
                skin: "red",
                content: e.msg,
                okBtn: false,
                cancelBtn: false
            });
        },
        success: function (res) {
            if( res.status == 200 ){
                $.sDialog({
                    skin: "red",
                    content: __('等待供应商审核'),
                    okBtn: false,
                    cancelBtn: false
                });
                localStorage.clear();
            } else {
                $.sDialog({
                    skin: "red",
                    content: res.msg,
                    okBtn: false,
                    cancelBtn: false
                });
            }
        }
    });
}

function uploadDisProduct( product_id ){
    $.request({
        type: "POST",
        url: SYS.URL.distribution.uploadDisProduct,
        dataType: "json",
        data: {
            product_id: product_id,
        },
        error: function () {
            
        },
        success: function (res) {
            if( res.status == 200 ){
               $('#upload-to').removeAttr('id').html( __('已上架'));
               localStorage.clear();
            } else {
                $.sDialog({
                    skin: "red",
                    content: res.msg,
                    okBtn: false,
                    cancelBtn: false
                });
            }
        }
    });
}