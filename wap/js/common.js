/* 公共JS
 * @copyright  Copyright (c) 2007-2017 QianyiNetwork Inc. (http://www.shopsuite.cn)
 * @license    http://www.shopsuite.cn
 * @link       http://www.shopsuite.cn
*/
function getAppQrcode(data){
    alert(data);
}

$(document).on('click', 'a',function(e){
    //tap
    var that = $(this);

    //判断连接是否需要登录， 目前只针对A连接，JS中跳转，单独处理或者封装成A连接。
    //1、判断连接地址

    var url = that.attr('href');
    console.info(url);
    var url_row = itemUtil.parseURL(url);

    var path = url_row['path'];
    var path_row =path.split("wap/");

    var file = path_row[path_row.length-1];

    console.info(file);

    //2、连接是否需要登录
    var need_login_row = [
        'tmpl/member/signin.html',
        'tmpl/points_shop.html',                   // 积分商城
        'tmpl/member/order_list.html',             // 订单列表
        'tmpl/member/member_account.html',         // 用户信息
        'tmpl/member/views_list.html',             // 浏览历史记录
        'tmpl/order/buy_step1.html',               // 立即购买或提交订单前一步
        'tmpl/member/chat_list.html',              // 聊天消息列表
        'tmpl/member/chat_info.html',              // 聊天页面
        'tmpl/cart_list.html',                     // 购物车
        'tmpl/member/order_list.html',             // 订单列表
        'tmpl/member/member_mobile_bind.html',     // 绑定手机
        'tmpl/member/redpacket_pwex.html',         // 红包
        'tmpl/member/vr_order_list.html',          // 订单
        'tmpl/member/member_password_step1.html',  // 设置密码
        'tmpl/member/member_password_step2.html',  // 设置密码
        'tmpl/member/member_paypwd_step1.html',    // 支付密码
        'tmpl/member/member_paypwd_step2.html',    // 支付密码
        'tmpl/member/vr_order_detail.html',        // 订单详情
        'tmpl/member/rechargecard_add.html',       // 充值卡
        'tmpl/member/rechargecardlog_list.html',   // 充值卡
        'tmpl/member/voucher_pw_list.html',        // 优惠券列表
        'tmpl/member/pdcashinfo.html',             //
        'tmpl/member/member_invite.html',          // 分销
        'tmpl/member/member_invite3.html',         // 分销
        'tmpl/member/member_invite2.html',         // 分销
        'tmpl/member/member_invite1.html',         // 分销
        'tmpl/member/member_mobile_modify.html',   // 修改电话
        'tmpl/member/red_packet.html',             // 红包
        'tmpl/member/return.html',                 // 红包
        'tmpl/member/red_packet.html',             // 红包
        'tmpl/member/voucher_pwex.html',           // 红包
        'tmpl/member/order_detail.html',           // 订单详情
        'tmpl/member/refund_all.html',             // 退款
        'tmpl/member/pdrecharge_list.html',        // 预存款
        'tmpl/member/voucher_list.html',           // 优惠券列表
        'tmpl/member/views_list.html',             // 浏览历史
        'tmpl/member/refund.html',                 // 退款申请
        'tmpl/member/predepositlog_list.html',     // 预存款
        'tmpl/member/pointslog_list.html',         // 积分列表
        'tmpl/member/member_asset.html',           // 全部财产
        'tmpl/member/address_list.html',           // 地址列表
        'tmpl/member/member_feedback.html',        // 用户反馈
        'tmpl/member/member_evaluation_again.html',// 追加评价
        'tmpl/member/vr_order_indate_code_list.html',// 兑换码列表
        'tmpl/member/product_detail.html',         // 商品详情
        'tmpl/member/member_vr_evaluation.html',   // 商品评价
        'tmpl/member/order_delivery.html',         // 订单地址
        'tmpl/member/pdcash_add.html',             // 余额
        'tmpl/member/pdcashlist.html',             // 账户余额
        'tmpl/member/member_evaluation.html',      // 评价
        'tmpl/member/favorites.html',              // 收藏
        'tmpl/member/login.html',              // 登录重映射

        //商家中心
    ];

    if ($.inArray(file, need_login_row) != -1)
    {
        //存在，判断是否登录
        var $callback = path;

        if ('tmpl/member/login.html' == file)
        {
            $callback = window.location.href;
        }

        if (!ifLogin($callback))
        {
            e.preventDefault();
        }
    }
});


function isSupportStorage()
{
    if (typeof window.localStorage == 'object')
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isNull(arg1)
{
    return !arg1 && arg1!==0 && typeof arg1!=="boolean"?true:false;
}

function getQueryString(name){
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);

    if (name == 'store_id')
    {
        if (!SYS.MULTISHOP_ENABLE)
        {
            return SYS.STORE_ID;
        }
    }

    if (r!=null) return r[2]; return '';
}

function addCookie(name,value,expireHours){
    //判断是否设置过期时间
    if(expireHours>0){
        var date=new Date();
        date.setTime(date.getTime()+expireHours*3600*1000);

        $.cookie(name, value, { expires: expireHours/24, path:'/'});
        //$.cookie(name, value, date.toGMTString());
    }
    else
    {
        $.cookie(name, value);
    }
}

function getCookie(name){
    return  $.cookie(name);
}

function delCookie(name){//删除cookie
    $.cookie(name, null, {path:'/'});
}


//登录窗口
function checkLogin(state, $callback){

    if (typeof $callback == 'undefined')
    {
        //用户中心会默认跳转到passport首页
        $callback = window.location.href;
    }

    if(state == 0){
        /*if (isWeixin())
        {
            location.href = SYS.URL.wx.mplogin + '&callback=' + encodeURIComponent($callback);//暂时注释
        }
        else
        {*/

            location.href = WapSiteUrl+'/tmpl/member/login.html' + '?callback=' + encodeURIComponent($callback);


            /*$.fancybox.open({
                //src  : WapSiteUrl+'/tmpl/member/login.html',
                src  : SYS.URL.login_box + '&callback=' + encodeURIComponent($callback),
                //src  : SYS.URL.wx.mplogin,
                type : 'iframe',
                iframe : {
                    css : {
                        width : '600px',
                        height : '600px',
                    }
                },
                opts : {
                    afterShow : function( instance, current ) {
                        console.info( 'done!' );
                    }
                }
            });*/
        /*}*/

        return false;
    }else {
        return true;
    }
}

//检测是否登录
function ifLogin($callback){
    var key = getLocalStorage('ukey');
    if (!key) {
        checkLogin(0, $callback);
        return false;
    }
    else {
        return key;
    }
}



function contains(arr, str) {
    var i = arr.length;
    while (i--) {
        if (arr[i] === str) {
            return true;
        }
    }
    return false;
}

function buildUrl(type, data) {
    switch (type) {
        case 'keyword':
            return WapSiteUrl + '/tmpl/product_list.html?keyword=' + encodeURIComponent(data);
        case 'special':
            return WapSiteUrl + '/special.html?page_id=' + data;
        case 'goods':
            return WapSiteUrl + '/tmpl/product_detail.html?item_id=' + data;
        case 'url':
            return data;
        case 'shop':
            return WapSiteUrl + '/tmpl/store_list.html?keyword=' + encodeURIComponent(data);
    }
    return WapSiteUrl;
}

function errorTipsShow(html) {
    $(".error-tips").html(html).show();
    setTimeout(function(){
        errorTipsHide();
    }, 3000);
}

function errorTipsHide() {
    $(".error-tips").html("").hide();
}

function writeClear(o) {
    if (o.val().length > 0) {
        o.parent().addClass('write');
    } else {
        o.parent().removeClass('write');
    }
    btnCheck(o.parents('form'));
}

function btnCheck(form) {
    var btn = true;
    form.find('input').each(function(){
        if ($(this).hasClass('no-follow')) {
            return;
        }
        if ($(this).val().length == 0) {
            btn = false;
        }
    });
    if (btn) {
        form.find('.btn').parent().addClass('ok');
    } else {
        form.find('.btn').parent().removeClass('ok');
    }
}

/**
 * 取得默认系统搜索关键词
 * @param cmd
 */
function getSearchName(refresh) {
    var keyword = decodeURIComponent(getQueryString('keyword'));

    if (typeof refresh == 'undefined')
    {
        refresh = false
    }

    //不考虑cookie，考虑localStore
    if (keyword == '' || refresh) {
        if(getLocalStorage('deft_key_value') == null || refresh) {

            $.getJSON(SYS.URL.search_hot_info, function(result) {
                var data = result.data.suggest_search_words;
                if(data && typeof data.default_search_label != 'undefined' && data.default_search_label) {
                    // $('#keyword').attr('placeholder',data.default_search_label);
                    // $('#keyword').html(data.default_search_label);
                    setLocalStorage('deft_key_name',data.default_search_label,1);
                    setLocalStorage('deft_key_value',data.default_search_words,1);
                } else {
                    setLocalStorage('deft_key_name','',1);
                    setLocalStorage('deft_key_value','',1);
                }
            }, {
                timeout: SYS.CACHE_EXPIRE,
                forceRefresh: refresh
            })

        } else {
            // $('#keyword').attr('placeholder',getLocalStorage('deft_key_name'));
            // $('#keyword').html(getLocalStorage('deft_key_name'));
        }
    }
}
// 免费领优惠券
function getFreeVoucher(tid) {
    if (!ifLogin()){return}

    $.request({
        type:'post',
        url:SYS.URL.user.voucher_add,
        data:{activity_id:tid},
        dataType:'json',
        success:function(result){
            //checkLogin(result.login);
            var msg = __('领取成功');
            var skin = 'green';
            if(result.status != 200) {
                msg = __('领取失败：') + result.msg;
                skin = 'red';
            }
            $.sDialog({
                skin:skin,
                content: msg,
                okBtn:false,
                cancelBtn:false
            });
        }
    });
}

// 登陆后更新购物车
function updateCookieCart(key) {
    var cartlist = decodeURIComponent(getLocalStorage('goods_cart'));
    if (cartlist && cartlist != "null") {
        $.request({
            type:'post',
            url: SYS.URL.cart.add,
            data:{ cookie_list:cartlist},
            dataType:'json',
            async:false
        });

        delLocalStorage('goods_cart');
    }
}
/**
 * 查询购物车中商品数量
 * @param key
 * @param expireHours
 */
function getCartCount(key, expireHours, refresh, render) {
    var cart_count = 0;
    if (getLocalStorage('ukey') !== null && getLocalStorage('cart_count') === null) {
        var key = getLocalStorage('ukey');

        if (typeof refresh == 'undefined')
        {
            refresh = false
        }

        if (typeof render == 'undefined')
        {
            render = false
        }

        $.request({
            type:'post',
            url:SYS.URL.user.cart_count,
            data:{},
            dataType:'json',
            ajaxCache: {
                cacheValidate: function (res, options) {
                    return res.status === 200;
                },

                timeout: 60 * 1,
                forceRefresh: refresh
            },

            async:false,
            success:function (result) {
                if (typeof(result.data.cart_count) != 'undefined') {
                    setLocalStorage('cart_count',result.data.cart_count,expireHours);
                    cart_count = result.data.cart_count;
                }

                if (refresh)
                {
                    window.initCartList(refresh, render);
                }
            },
            error : function(err,ms){
                $('.pre-loading').hide();
            }
        });
    } else {
        cart_count = getLocalStorage('cart_count');
    }
    if (cart_count > 0 && $('.sstouch-nav-menu').has('.cart').length > 0) {
        $('.sstouch-nav-menu').has('.cart').find('.cart').parents('li').find('sup').show();
        $('#header-nav').find('sup').show();
    }
}

/**
 * 读取购物车数据
 */
window.initCartList = function (refresh, render)
{
    if (typeof refresh == 'undefined')
    {
        refresh = false
    }

    if (typeof render == 'undefined')
    {
        render = false
    }

    if (render && typeof initCartData == 'function')
    {
        $('.pre-loading').show();
    }

    $.request({
        url: SYS.URL.cart.lists,
        type: "post",
        dataType: "json",
        data: {},
        ajaxCache: {
            cacheValidate: function (res, options) {
                return res.status === 200;
            },

            timeout: SYS.CACHE_EXPIRE,
            forceRefresh: refresh
        },
        success: function (result)
        {

            if (render && typeof initCartData == 'function')
            {
                $('.pre-loading').hide();

                if (result.status == 200)
                {
                    initCartData(result);
                }
                else
                {
                    parent.Public.tips({type: 1, content: result.msg});
                }
            }
        }
    });
}

/**
 * 查询是否有新消息
 */
function getChatCount(refresh) {
    if ($('#header').find('.message').length > 0) {
        var key = getLocalStorage('ukey');
        if (key !== null) {

            if (typeof refresh == 'undefined')
            {
                refresh = false
            }

            $.request({
                url: SYS.URL.user.msg_count,
                type: 'get',
                dataType: 'json',

                ajaxCache: {
                    cacheValidate: function (res, options) {
                        return res.status === 200;
                    },

                    timeout: 60 * 1,
                    forceRefresh: refresh
                },

                success: function(result) {
                    if (result.status==200 && result.data.num > 0) {
                        $('#header').find('.message').parent().find('sup').show();
                        $('#header-nav').find('sup').show();
                    }
                },
                error : function(err,ms){
                    $('.pre-loading').hide();
                }
            });
        }
        $('#header').find('.message').parent().click(function(){
            window.location.href = WapSiteUrl+'/tmpl/member/chat_list.html';
        });
    }
}

function getSiteInfo(refresh)
{
    if (typeof refresh == 'undefined')
    {
        refresh = false
    }

    $.getJSON(SYS.URL.info, function(result) {
        if (result.status == 200)
        {
            //设置标题等等信息
            document.title = sprintf('%s %s', document.title, result.data.name);

            //
            if (window.localStorage) {
                var version = result.data.version;
                localStorage.setItem("version", version);

                if (version)
                {
                    SYS.VER   = version;
                }
            } else {
            }
        }
    }, {timeout: SYS.CACHE_EXPIRE, forceRefresh: refresh})

}


$(function() {
    getSiteInfo();
});

$(function() {
    $('.input-del').click(function(){
        $(this).parent().removeClass('write').find('input').val('').trigger('empty');
        btnCheck($(this).parents('form'));
    });

    // radio样式
    $('body').on('click', 'label', function(){
        if ($(this).has('input[type="radio"]').length > 0) {
            $(this).addClass('checked').siblings().removeAttr('class').find('input[type="radio"]').removeAttr('checked');
        } else if ($(this).has('[type="checkbox"]')) {
            if ($(this).find('input[type="checkbox"]').prop('checked')) {
                $(this).addClass('checked');
            } else {
                $(this).removeClass('checked');
            }
        }
    });
    // 滚动条通用js
    if ($('body').hasClass('scroller-body')) {
        new IScroll('.scroller-body', { mouseWheel: true, click: true });
    }

    // 右上侧小导航控件
    $('#header').on('click', '#header-nav', function(){
        if ($('.sstouch-nav-layout').hasClass('show')) {
            $('.sstouch-nav-layout').removeClass('show');
        } else {
            $('.sstouch-nav-layout').addClass('show');
        }
    });
    $('#header').on('click', '.sstouch-nav-layout',function(){
        $('.sstouch-nav-layout').removeClass('show');
    });
    $(document).scroll(function(){
        $('.sstouch-nav-layout').removeClass('show');
    });


    getSearchName();
    getCartCount();
    getChatCount();// 导航右侧消息

    //回到顶部
    $(document).scroll(function(){
        set();
    });
    $('.fix-block-r,footer').on('click', ".gotop",function (){
        btn = $(this)[0];
        this.timer=setInterval(function(){
            $(window).scrollTop(Math.floor($(window).scrollTop()*0.8));
            if($(window).scrollTop()==0) clearInterval(btn.timer,set);
        },10);
    });
    function set(){$(window).scrollTop()==0 ? $('#goTopBtn').addClass('hide') : $('#goTopBtn').removeClass('hide');}
});



function loadSeccode(){
    $("#codekey").val('');

    verifyUtils.imageVerifyCode($("#codeimage"), $("#codekey"));

    return ;

    //加载验证码
    $.request({
        type:'get',
        url: SYS.CONFIG.index_url + '?ctl=VerifyCode&met=getRandKey&typ=json',
        async : false,
        dataType: 'json',
        success:function(result){
            $("#codekey").val(result.data.codekey);
        }
    });

    $("#codeimage").attr('src',ApiUrl+'/index.php?act=seccode&op=makecode&k='+$("#codekey").val()+'&t=' + Math.random());
}
/**
 * 收藏店铺
 */
function favoriteStore(store_id){
    if (!ifLogin()){return}
    if (store_id <= 0) {
        $.sDialog({skin: "green", content: '参数错误', okBtn: false, cancelBtn: false});
        return false;
    }
    var return_val = false;
    $.request({
        type: 'post',
        url: SYS.URL.user.wish_store_add,
        data: {store_id: store_id},
        dataType: 'json',
        async: false,
        success: function(result) {
            if (result.status == 200) {
                // $.sDialog({skin: "green", content: "收藏成功！", okBtn: false, cancelBtn: false});
                return_val = true;
            } else {
                $.sDialog({skin: "red", content: result.msg, okBtn: false, cancelBtn: false});
            }
        }
    });
    return return_val;
}
/**
 * 取消收藏店铺
 */
function dropFavoriteStore(favorites_store_id){
    if (!ifLogin()){return}

    if (favorites_store_id <= 0) {
        $.sDialog({skin: "green", content: '参数错误', okBtn: false, cancelBtn: false});
        return false;
    }
    var return_val = false;
    $.request({
        type: 'post',
        url: SYS.URL.user.wish_store_remove,
        data: {store_id: favorites_store_id},
        dataType: 'json',
        async: false,
        success: function(result) {
            if (result.status == 200) {
                // $.sDialog({skin: "green", content: "已取消收藏！", okBtn: false, cancelBtn: false});
                return_val = true;
            } else {
                $.sDialog({skin: "red", content: result.msg, okBtn: false, cancelBtn: false});
            }
        }
    });
    return return_val;
}
/**
 * 收藏商品
 */
function favoriteGoods(item_id){
    if (!ifLogin()){return}

    if (item_id <= 0) {
        $.sDialog({skin: "green", content: __('参数错误'), okBtn: false, cancelBtn: false});
        return false;
    }
    var return_val = false;
    $.request({
        type: 'post',
        url: SYS.URL.user.wish_item_add,
        data:{item_id:item_id},
        dataType: 'json',
        async: false,
        success: function(result) {
            if (result.status == 200) {
                // $.sDialog({skin: "green", content: "收藏成功！", okBtn: false, cancelBtn: false});
                return_val = true;
            } else {
                $.sDialog({skin: "red", content: result.msg, okBtn: false, cancelBtn: false});
            }
        }
    });
    return return_val;
}
/**
 * 取消收藏商品
 */
function dropFavoriteGoods(favorites_item_id, item_id){
    if (!ifLogin()){return}

    if (favorites_item_id <= 0 && item_id<=0) {
        $.sDialog({skin: "green", content: __('参数错误'), okBtn: false, cancelBtn: false}); return false;
    }
    var return_val = false;
    $.request({
        type: 'post',
        url: SYS.URL.user.wish_item_remove,
        data: {favorites_item_id: favorites_item_id, item_id:item_id},
        dataType: 'json',
        async: false,
        success: function(result) {
            if (result.status == 200) {
                // $.sDialog({skin: "green", content: "已取消收藏！", okBtn: false, cancelBtn: false});
                return_val = true;
            } else {
                $.sDialog({skin: "red", content: result.msg, okBtn: false, cancelBtn: false});
            }
        }
    });
    return return_val;
}


window.footer = false;
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

$ajaxCache.config({
    // 业务逻辑判断请求是否缓存， res为ajax返回结果, options 为 $.ajax 的参数
    cacheValidate: function (res, options) {    //选填，配置全局的验证是否需要进行缓存的方法,“全局配置” 和 ”自定义“，至少有一处实现cacheValidate方法

        //return true;  // 所有情况都缓存

        //return res.status === 200; // 满足某个条件才缓存

        return false; // 不缓存
    },
    storageType: 'localStorage', //选填，‘localStorage’ or 'sessionStorage', 默认‘localStorage’
    timeout: SYS.CACHE_EXPIRE, //选填， 单位秒。默认1小时
});

// create WebStorageCache instance.
var wsCache = new WebStorageCache();

function getLocalStorage(key)
{
    if (wsCache.isSupported())
    {
        var d = wsCache.get(key);

        if (!d)
        {
            d = getCookie(key);
        }

        return d;
        //return window.localStorage.getItem(key)
    }
    else
    {
        return getCookie(key);
    }
}

function setLocalStorage(key, value, h)
{
    if (typeof h == 'undefined')
    {
        h = 24 * 365 * 5;
    }

    if (wsCache.isSupported())
    {
        return wsCache.set(key, value, {exp : 3600*h});
        //return window.localStorage.setItem(key, value)
    }
    else
    {
        return addCookie(key, value, h);
    }
}


function delLocalStorage(key)
{
    if (wsCache.isSupported())
    {
        return wsCache.delete(key);
    }
    else
    {
        return delCookie(key);
    }
}

function updateLocalStorage(key, value, h)
{
    if (wsCache.isSupported())
    {
        return wsCache.replace(key, value, {exp : 3600*h});
        //return window.localStorage.setItem(key, value)
    }
    else
    {
        return addCookie(key, value, h);
    }
}


function isWeixin(){
    var ua = navigator.userAgent.toLowerCase();
    if (ua.match(/micromessenger/i) == "micromessenger") {
        return true;
    }
    return false;
}

/**
 * 动态加载js文件
 * @param script_filename js文件路径
 */
function loadJs(script_filename) {
    var script = document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.setAttribute('src', script_filename);
    script.setAttribute('id', 'auto_script_id');
    script_id = document.getElementById('auto_script_id');
    if (script_id) {
        document.getElementsByTagName('head')[0].removeChild(script_id);
    }
    document.getElementsByTagName('head')[0].appendChild(script);
}


function userBrowser(){
    var browserName=navigator.userAgent.toLowerCase();
    if(/SuteshopCode/i.test(browserName)){

        return true;
    }else{
        //是否微信打开
        return isWeixin();
    }

}


window.suteshopApp = userBrowser();
//window.suteshopApp = true;

if (window.suteshopApp)
{
    //修正顶部菜单，微信中底部出现菜单，在footer.js中控制
    if (isWeixin())
    {
        //默认显示顶部菜单
        $('header').show();

        //todo 单独优化再开发。
        /*
        $('header.appshow').show();
        $('header.fixed').show();
        $('header.transparent').show();

        if ($('header:not(.appshow) .back').hide().parents('.header-l').length > 0)
        {
            $('header .back').hide().parents('.header-l').remove();
            $('header .header-inp').css({'margin-left': 10});
        }

        if (!$('header').is(':hidden') || $('header').is(':visible'))
        {
        }
        else
        {
            $('.sstouch-main-layout').css({'margin-top': 0});
        }

        $('#fixed_nav.fixed').css({'margin-top': 0});
         */
    }
    else
    {
        $('header.appshow').show();
        $('header.fixed').show();
        $('header.transparent').show();

        if ($('header .back').hide().parents('.header-l').length > 0)
        {
            $('header .back').hide().parents('.header-l').remove();
            $('header .header-inp').css({'margin-left': 10});
        }

        if (!$('header').is(':hidden') || $('header').is(':visible'))
        {
        }
        else
        {
            $('.sstouch-main-layout').css({'margin-top': 0});
        }

        $('#fixed_nav.fixed').css({'margin-top': 0});
    }
}
else
{
    //默认显示顶部菜单
    $('header').show();
}

$(function (){

    if($.isFunction($.fn.waypoint))
    {

        $("#fixed_nav").waypoint(function() {
                $("#fixed_nav").toggleClass("fixed")

                if (window.suteshopApp)
                {
                    $('#fixed_nav.fixed').css({'top': 0});


                    //修正订单列表页面搜索问题
                    $('.sstouch-main-layout.mt2rem').css({'margin-top': '2rem'});
                }
                else
                {
                }
            },
            {
                offset: "50"
            });

        //店铺导航
        $('#nav_tab').waypoint(function() {
            $("#nav_tab_con").toggleClass('fixed');

            if (window.suteshopApp)
            {
                //如果没有header
                //$('.sstouch-single-nav.fixed').css({'top': 0});

                $('.sstouch-single-nav.fixed').css({'top': '2rem'});
            }
            else
            {
                $('.sstouch-single-nav.fixed').css({'top': '2rem'});
            }

        }, {
            offset: '50'
        });
    }

})



$.common = {
    initEvent: function ($dom)
    {
        if (SYS.VIRTUAL_ENABLE)
        {
            $('.virtual-enable', $dom).show()
        }
        else
        {
            $('.virtual-enable', $dom).hide()
        }

        if (SYS.O2O_ENABLE)
        {
            $('.o2o-enable', $dom).show()
        }
        else
        {
            $('.o2o-enable', $dom).hide()
        }

        if (SYS.PLANTFORM_FX_ENABLE)
        {
            $('.plantform-fx-enable', $dom).show()
        }
        else
        {
            $('.plantform-fx-enable', $dom).hide()
        }

        if (SYS.STORE_FX_ENABLE)
        {
            $('.store-fx-enable', $dom).show()
        }
        else
        {
            $('.store-fx-enable', $dom).hide()
        }


        if (SYS.EVALUATION_ENABLE)
        {
            $('.evaluation-enable', $dom).show()
        }
        else
        {
            $('.evaluation-enable', $dom).hide()
        }


        if (SYS.MULTISHOP_ENABLE)
        {
            $('.multishop-enable', $dom).show()
        }
        else
        {
            $('.multishop-enable', $dom).hide()
        }

        if ('multi' == SYS.SYS_TYPE)
        {
        }
        else
        {
        }

        if (SYS.EVALUATION_ENABLE)
        {
            $('#goodsEvaluation', $dom).parent().removeClass('hide');
        }
        else
        {
            $('#goodsEvaluation', $dom).parent().addClass('hide');
        }


        if (SYS.MULTISHOP_ENABLE)
        {
            $('.goods-detail-store', $dom).show();
        }
        else
        {
            $('.goods-detail-store', $dom).hide();
        }

        if (SYS.SAAS_STATUS)
        {
        }
        else
        {
        }

        if (SYS.REDPACKET_ENABLE)
        {
            $('.redpacket-enable', $dom).removeClass('hide');
            $('.redpacket-enable', $dom).show();
        }
        else
        {
            $('.redpacket-enable', $dom).hide();
        }

        if (SYS.CREDIT_ENABLE)
        {
            $('.credit-enable', $dom).removeClass('hide');
            $('.credit-enable', $dom).show();
        }
        else
        {
            $('.credit-enable', $dom).hide();
        }


        if (SYS.POINT_ENABLE)
        {
            $('.point-enable', $dom).removeClass('hide');
            $('.point-enable', $dom).show();
        }
        else
        {
            $('.point-enable', $dom).hide();
        }

        //$("img", $dom).lazyload();

        /*
         $("img.lazy").lazyload({
         skip_invisible: false,
         effect:'fadeIn',
         failure_limit: 20,
         threshold: 200
         });
         */

        // Poppup video
        if ($('.video-btn', $dom).length > 0)
        {
            $('.video-btn', $dom).fancybox();
        }

        if($.isFunction($.fn.iCheck))
        {
            // Styles
            $('input.icheck', $dom).iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red'
            });
        }
    }
};





//全局修正
$(function (){
    var chain = window.location.href.split("#CH");
    var chain_id = chain[1];

    if(chain_id){
        if (chain_id.indexOf("CH") == 0) {
            addCookie("chid", "0", 24 * 7);
        }else {
            addCookie("chid", chain_id, 24 * 7);
        }
    }


    //推广员
    var uid = chain[0].split("#FX");
    var fragment = uid[1];
    if(fragment){
        if (fragment.indexOf("FX") == 0) {
            addCookie("fxid", "0", 24 * 7);
        }else {
            addCookie("fxid", fragment, 24 * 7);
        }
    }
})



//全局修正
$(function (){
    $.common.initEvent($(document));
})

if (window.applicationCache)
{
    // Check if a new cache is available on page load.
    window.addEventListener('load', function(e) {
        window.applicationCache.addEventListener('updateready', function(e) {
            if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
                // Browser downloaded a new app cache.
                // Swap it in and reload the page to get the new hotness.
                window.applicationCache.swapCache();

                localStorage.clear();

                $(document).dialog({
                    type : 'confirm',
                    closeBtnShow: true,
                    content: __('有最新版本可用. 是否加载?'),
                    onClickConfirmBtn: function(){
                        window.location.reload();
                    },
                    onClickCancelBtn : function(){
                    },
                    onClickCloseBtn  : function(){
                    }
                });

                /* if (confirm('有最新版本可用. 是否加载?')) {
                     window.location.reload();
                 }*/
            } else {
                // Manifest didn't changed. Nothing new to server.
            }
        }, false);
    }, false);
}


function cleanStorage() {
    //判断运行环境
    if (window.suteshopApp)
    {

    }
    else
    {
    }

    $(document).dialog({
        type : 'confirm',
        closeBtnShow: true,
        content: __('确认清除缓存？'),
        onClickConfirmBtn: function(){

            //Local Storage
            localStorage.clear();

            //Cache Storage sw需要注销
            /*
            caches.keys().then(function(keys) {
                return Promise.all(
                    keys.map(function(key, i) {
                        // 清除旧版本缓存
                        // 如果当前版本和缓存版本不一致
                        //alert(key)
                        return caches.delete(key);
                    })
                );
            })
            */

            //Application Cache
            var appCache = window.applicationCache;
            appCache.update(); // Attempt to update the user's cache. //manifest文件必须修改 此处用处不大
        },
        onClickCancelBtn : function(){
        },
        onClickCloseBtn  : function(){
        }
    });
}

$.extend($.fn,{
    TimeCount:function(d){
        this.each(function(){
            var $this = $(this);
            var o = {
               
                sec: $this.find(".sec"),
                mini: $this.find(".mini"),
                hour: $this.find(".hour"),
                day: $this.find(".day")
              
            };
            var f = {
                zero: function(n){
                    var _n = parseInt(n, 10);//解析字符串,返回整数
                    if(_n > 0){
                        if(_n <= 9){
                            //_n = "0" + _n
                            _n = _n
                        }
                        return String(_n);
                    }else{
                        return "0";
                    }
                },
                dv: function(){
                    //d = d || Date.UTC(2050, 0, 1); //如果未定义时间，则我们设定倒计时日期是2050年1月1日
                    var _d = $this.data("end") || d;
                    
                    var now = new Date(),
                        endDate = new Date(Date.parse(_d.replace(/-/g, "/")));
                        if(endDate < now)
                            return false;
                   
                    var dur = (endDate - now.getTime()) / 1000 , mss = endDate - now.getTime() ,pms = {
                        sec: "0",
                        mini: "0",
                        hour: "0",
                        day: "0"
                    };
                    if(mss > 0)
                    {
                        pms.sec = f.zero(dur % 60);
                        pms.mini = Math.floor((dur / 60)) > 0? f.zero(Math.floor((dur / 60)) % 60) : "0";
                        pms.hour = Math.floor((dur / 3600)) > 0? f.zero(Math.floor((dur / 3600)) % 24) : "0";
                        pms.day = Math.floor((dur / 86400)) > 0? f.zero(Math.floor((dur / 86400))) : "0"; 
                    }
                    else
                    {
                        pms.day=pms.hour=pms.mini=pms.sec="0";
                        //alert('结束了');
                        return;
                    }
                    return pms;
                },
                //给一位数前面补零，使其符合显示时间的格式，如 8:28:9 变为 08:28:09
                ao:function(num)
                {
                    var a = num.toString().split(""),
                        str = '';
                    if(a.length == 1){
                        str = '0'+ num;
                    }
                    else{
                        str +=num;
                    }
                    return str;
                },
                ui: function(){
                    if(o.sec){
                        o.sec.html(f.ao(f.dv().sec));
                    }
                    if(o.mini){
                        o.mini.html(f.ao(f.dv().mini));
                    }
                    if(o.hour){
                        o.hour.html(f.ao(f.dv().hour));
                    }
                    if(o.day){
                        o.day.html(f.ao(f.dv().day));
                    }
                    setTimeout(f.ui, 1);
                }
            };
            f.ui();
        });
    },
});


(function($) {
    $.extend($, {
        /**
         * 滚动header固定到顶部
         */
        scrollTransparent: function(options) {
            var defaults = {
                    valve : '#header',          // 动作触发
                    scrollHeight : 50
            }
            var options = $.extend({}, defaults, options);
            function _init() {
                $(window).scroll(function(){
                    if ($(window).scrollTop() <= options.scrollHeight) {
                        $(options.valve).addClass('transparent').removeClass('posf');
                    } else {
                        $(options.valve).addClass('posf').removeClass('transparent');
                    }
                });

            }
            return this.each(function() {
                _init();
            })();
        },

        /**
         * 选择地区
         * 
         * @param $
         */
        areaSelect: function(options) {
            var defaults = {
                    success : function(data){},
                    hideThirdLevel: false
                }
            var options = $.extend({}, defaults, options);
            var ASID = 0;
            var ASID_1 = 0;
            var ASID_2 = 0;
            var ASID_3 = 0;
            var ASNAME = '';
            var ASINFO = '';
            var ASDEEP = 1;
            var ASINIT = true;
            function _init() {
                if ($('#areaSelected').length > 0) {
                    $('#areaSelected').remove();
                }
                var thirdLevelHtml = options.hideThirdLevel ? "" : '<li><a href="javascript:void(0);" >三级地区</a></li>';
                var html = '<div id="areaSelected">'
                    + '<div class="sstouch-full-mask left">'
                    + '<div class="sstouch-full-mask-bg"></div>'
                    + '<div class="sstouch-full-mask-block">'
                    + '<div class="header absolute">'
                    + '<div class="header-wrap">'
                    + '<div class="header-l"><a href="javascript:void(0);"><i class="back"></i></a></div>'
                    + '<div class="header-title">'
                    + '<h1>选择地区</h1>'
                    + '</div>'
                    + '<div class="header-r"><a href="javascript:void(0);"><i class="close"></i></a></div>'
                    + '</div>'
                    + '</div>'
                    + '<div class="sstouch-main-layout">'
                    + '<div class="sstouch-single-nav">'
                    + '<ul id="filtrate_ul" class="area">'
                    + '<li class="selected"><a href="javascript:void(0);">一级地区</a></li>'
                    + '<li><a href="javascript:void(0);" >二级地区</a></li>'
                    + thirdLevelHtml
                    + '</ul>'
                    + '</div>'
                    + '<div class="sstouch-main-layout-a"><ul class="sstouch-default-list"></ul></div>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '</div>';
                $('body').append(html);
                _getAreaList();
                _bindEvent();
                _close();
            }

            function _getAreaList() {
                $.ajax({//获取区域列表
                    type:'get',
                    url:SYS.URL.district,
                    data:{pid:ASID},
                    dataType:'json',
                    async:false,
                    success:function(result){
                        if (result.data.items.length == 0) {
                            _finish();
                            return false;
                        }
                        if (ASINIT) {
                            ASINIT = false
                        } else {
                            ASDEEP++;
                        }
                        $('#areaSelected').find('#filtrate_ul').find('li').eq(ASDEEP-1).addClass('selected').siblings().removeClass('selected');
                        checkLogin(result.login);
                        var data = result.data;
                        var area_li = '';
                        for(var i=0;i<data.items.length;i++){
                            area_li += '<li><a href="javascript:void(0);" data-id="' + data.items[i].district_id + '" data-name="' + data.items[i].district_name + '"><h4>' + data.items[i].district_name + '</h4><span class="arrow-r"></span> </a></li>';
                        }
                        $('#areaSelected').find(".sstouch-default-list").html(area_li);
                        if (typeof(myScrollArea) == 'undefined') {
                            if (typeof(IScroll) == 'undefined') {
                                $.ajax({
                                    url: WapSiteUrl+'/js/iscroll.js',
                                    dataType: "script",
                                    async: false
                                  });
                            }
                            myScrollArea = new IScroll('#areaSelected .sstouch-main-layout-a', { mouseWheel: true, click: true });
                        } else {
                            myScrollArea.destroy();
                            myScrollArea = new IScroll('#areaSelected .sstouch-main-layout-a', { mouseWheel: true, click: true });
                        }
                    }
                });
                return false;
            }
            
            function _bindEvent() {
                $('#areaSelected').find('.sstouch-default-list').off('click', 'li > a');
                var onceClick = true;
                $('#areaSelected').find('.sstouch-default-list').on('click', 'li > a', function(){

                    if (onceClick === false) {
                        return false;
                    }

                    ASID = $(this).attr('data-id');
                    eval("ASID_"+ASDEEP+"=$(this).attr('data-id')");
                    ASNAME = $(this).attr('data-name');
                    ASINFO += ASNAME + ' ';
                    var _li = $('#areaSelected').find('#filtrate_ul').find('li').eq(ASDEEP);
                    _li.prev().find('a').attr({'data-id':ASID, 'data-name':ASNAME}).html(ASNAME);
                    if (options.hideThirdLevel && ASDEEP == 2) {
                        _finish();
                        onceClick = false;
                        return false;
                    }
                    if (ASDEEP == 3) {
                        _finish();
                        onceClick = false;
                        return false;
                    }
                    _getAreaList();
                });
                $('#areaSelected').find('#filtrate_ul').off('click', 'li > a');
                $('#areaSelected').find('#filtrate_ul').on('click', 'li > a', function(){
                    if ($(this).parent().index() >= $('#areaSelected').find('#filtrate_ul').find('.selected').index()) {
                        return false;
                    }
                    ASID = $(this).parent().prev().find('a').attr('data-id');
                    ASNAME = $(this).parent().prev().find('a').attr('data-name');
                    ASDEEP = $(this).parent().index();
                    ASINFO = '';
                    for (var i=0; i<$('#areaSelected').find('#filtrate_ul').find('a').length; i++) {
                        if (i < ASDEEP) {
                            ASINFO += $('#areaSelected').find('#filtrate_ul').find('a').eq(i).attr('data-name') + ' ';
                        } else {
                            var text = '';
                            switch (i) {
                            case 0:
                                text = '一级地区'
                                break;
                            case 1:
                                text = '二级地区'
                                break;
                            case 2:
                                text = '三级地区';
                                break;
                            }
                            $('#areaSelected').find('#filtrate_ul').find('a').eq(i).html(text);
                        }
                    }
                    _getAreaList();
                });
            }
            
            function _finish() {
                var data = {area_id:ASID,area_id_1:ASID_1,area_id_2:ASID_2,area_id_3:ASID_3,area_name:ASNAME,area_info:ASINFO};
                options.success.call('success', data);
                if (!ASINIT) {
                    $('#areaSelected').find('.sstouch-full-mask').addClass('right').removeClass('left');
                }
                return false;
            }
            
            function _close() {
                $('#areaSelected').find('.header-l').off('click', 'a');
                $('#areaSelected').find('.header-l').on('click', 'a',function(){
                    $('#areaSelected').find('.sstouch-full-mask').addClass('right').removeClass('left');
                });
                return false;
            }
            
            return this.each(function() {
                return _init();
            })();
        },
        
    });
})(jQuery);
(function($) {
    $.extend($, {
        sTip: function(options) {
            var opts = $.extend({}, $.sTip.defaults, options);
            return this.each(function() {
                var dTmpl = '<div class="ui-center-mask" style="position:fixed;z-index:9999;top:0;left:0;right:0;bottom:0;"><div class="ui-center-mask-bg" style="display:block;position:absolute;z-index: 21;top: 0;left: 0;right: 0;bottom: 0;background: rgba(0,0,0,0.65);"></div><div class="ui-center-mask-block" style="position: absolute;  z-index:22;bottom:0;left:0;right:0;top:0;box-sizing:border-box;display:-webkit-box;display:-webkit-flex;display:flex;  -webkit-box-pack:justify;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;align-items:center;"><div class="ui-center-mask-main" style="position:relative;display:inline-block;width:80%;padding:30px;background:#f8f5f0;border-radius:3px;box-sizing:border-box;border:1px solid #a9a5a2;max-height: 70%;overflow-y: scroll;"><div class="ui-center-mask-close" style="position:absolute;z-index:10;top:5px;right:5px;width:14px;height:14px;opacity:.7;display:none;"><i style="display:block;width:100%;height: 100%;background-repeat: no-repeat;  background-size: contain;"></i></div><div class="ui-center-mask-header" style="font-size:16px;color:#3d3936;text-align:center;font-weight: 600;">' + opts.title+ '</div><div class="ui-center-scroll" style="margin:.5rem 0;max-height:250px;overflow: hidden;"><div class="ui-center-mask-content" style="font-size:12px;color:#b0b1ac;line-height:18px;">' + opts.content+ '</div></div>';
                if( opts.confirmBtn ) {
                    dTmpl += '<div class="ui-center-mask-execute" style="font-size:14px;text-align: center;display: flex;"><a href="javascript:;" class="ui-center-mask-btn ui-center-mask-confirm" style="display: block;flex:1;height:30px;line-height:30px;background:#d0b482;color:#fff !important;border-radius: 2px;">' + opts.confirmBtnText+ '</a></div>';
                }
                if( opts.cancelBtn ) {
                    dTmpl += '<div class="ui-center-mask-execute" style="font-size:14px;text-align: center;display: flex;"><a href="javascript:;" class="ui-center-mask-btn ui-center-mask-cancle" style="display: block;flex:1;height:30px;line-height:30px;background:black;color:#fff !important;border-radius:2px;">' + opts.cancelBtnText+ '</a></div>';
                }
                dTmpl += '</div></div></div>'
                $("body").append(dTmpl);
                //绑定事件
                _bind();
            })();

            function _bind() {

                var confirmBtn = $(".ui-center-mask-confirm");
                var cancelBtn  = $(".ui-center-mask-cancel");
                var closeBtn   = $(".ui-center-mask-close");
                confirmBtn.click(_confirmFn);
                cancelBtn.click(_cancelFn);
                closeBtn.click(_close);

                if(opts.scroll) {
                    new IScroll('.ui-center-scroll', {mouseWheel: true,click:true})
                }


                //窗口外点击事件  
                $(document).click(function(e){

                    var popup = $(".ui-center-mask-main");

                    //判断事件对象不是弹窗对象  并且  弹窗对象不包含事件对象  

                    if (!popup.is(e.target) && popup.has(e.target).length === 0) {

                        e.stopPropagation();
                        //则隐藏弹窗  
                        // popup.hide(500);

                        _close();
                    }

                });

            }

            function _confirmFn() {
                opts.confirmFn();
                _close();
            }

            function _cancelFn() {
                opts.cancelFn();
                _close();
            }

            function _close() {
                $(".ui-center-mask").remove();
            }


        },
    });
    //sTip
    $.sTip.defaults = {
        "title": '标题',
        "content": "内容",
        "confirmBtn": true,
        "cancelBtn": false,
        "confirmBtnText": "确定",
        "cancelBtnText": "取消",
        "scroll":true,
        "confirmFn": function() {},
        "cancelFn": function() {}
    };

})(jQuery);
if( getQueryString('lang') ){
    var language = getQueryString('lang');
} else if( getCookie('language') ){
    var language = getCookie('language');
} else {
    var language = 'it';
}
addCookie('language',language,1);
console.log(getLocalStorage('language'));
function __( $str ){
    if( language.toLowerCase() != 'zh-cn') {
        
        if( lang_package[$str] ){
            return lang_package[$str];
        } else {
            // $.request({
            //     type:'get',
            //     url:WapSiteUrl + '/lang/' + language + '.json',
            //     dataType:'json',
            //     success:function(res){
            //        lang_arr = res;
            //        console.log( lang_arr );
            //     }
            // })

            return $str;
        }
    }
    return $str;
}
var isApp = false;
isApp =  getQueryString('isapp') ? getQueryString('isapp') : getCookie('isapp');

// var u = navigator.userAgent, app = navigator.appVersion;
// var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //g
// var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
isAndroid = (isApp && isApp == 'android') ? true : false;
isIOS     = (isApp && isApp == 'ios')     ? true : false;
isApp && addCookie('isapp',isApp,3600*24*3600);

var appApi = {
    login : function( userId,userKey ){
        if( isAndroid ){
            android.login( userId,userKey );
        }

        if( isIOS ){
            var str = {"user_id":userId,"user_key":userKey };
            //var params = {"user_id":userId,"user_key":userKey };

            var params = JSON.stringify(str);
            window.webkit.messageHandlers.login.postMessage(params);
        }

        return true;
    },
    logout : function(){
        if( isAndroid ){
            android.logout();
        }

        if( isIOS ){
            window.webkit.messageHandlers.logout.postMessage('');
        }
    },
    setWXOrderId : function( orderId ){
        if( isAndroid ){
            android.setWXOrderId( orderId );
        }

        if( isIOS ){
            var str    = {"order_id":orderId };
            var params = JSON.stringify(str);
            window.webkit.messageHandlers.setWXOrderId.postMessage(orderId);
        }
    },
    setAliOrderId : function( orderId ){
        if( isAndroid ){
            android.setAliOrderId( orderId );
        }

        if( isIOS ){
            var str    = {"order_id":orderId };
            var params = JSON.stringify(str);
            window.webkit.messageHandlers.setAliOrderId.postMessage(orderId);
        }
    },
    share : function( title,describe,url,imgUrl ){
        if( isAndroid ){
            android.share( title,describe,url,imgUrl )
        }

        if( isIOS ){
            var str    = {"title":title,"describe":describe,"url":url,"imgUrl":imgUrl };
            var params = JSON.stringify(str);
            window.webkit.messageHandlers.share.postMessage( params );
        }
    },
    scanQRCode : function(){
        if( isAndroid ){
            android.scanQRCode();
        }

        if( isIOS ){
            window.webkit.messageHandlers.scanQRCode.postMessage('');
        }

    },
    qqLogin : function(){

        if( isAndroid ){
            android.qqLogin();
        }

        if( isIOS ){
            window.webkit.messageHandlers.qqLogin.postMessage();
        }
    },
    wxLogin : function(){

        if( isAndroid ){
            android.wxLogin();
        }

        if( isIOS ){
            window.webkit.messageHandlers.wxLogin.postMessage('');
        }
    },
    openMap : function( location,title,content ){
        if( isAndroid ){
            android.openMap( location,title,content );
        }

        if( isIOS ){
            var str    = {"location":location,"title":title,"content":content };
            var params = JSON.stringify(str);
            //console.log( params );
            window.webkit.messageHandlers.openMap.postMessage( params );
        }
    },
};


if(isApp)
{
    var app_perm_key = getLocalStorage('ukey');
    if(app_perm_key)
    {
        var app_perm_uid = getLocalStorage('uid');
        isApp && appApi.login(app_perm_uid,app_perm_key);
    }
}
function getAppQrcode(data){
    window.location.href=data;
}
$('#nav-menu').click(function(){
    if($('.nav-layout').hasClass('hide'))
    {
        $('.nav-layout').removeClass('hide');
    }
    else
    {
        $('.nav-layout').addClass('hide');
    }
});
