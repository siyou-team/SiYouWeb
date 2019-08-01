
var address = []; //地址
var address_id  = 0;
var ac_id = getQueryString('ac_id');
var address = [];
var ct_data;
 var _wap_wx = 0;
//alert(wxopenid);
$(function()
{
    if (isWeixin())
    {
        _wap_wx = 1;
        loadJs("https://res.wx.qq.com/open/js/jweixin-1.2.0.js");
    }
    get_list();
    addAddress();
    eventBind();

});

function get_list()
{   
    var params = {
        ac_id:ac_id,
    };
    $.request({
        url: SYS.URL.user.getCutPriceActivityDetail,
        data:{ac_id:ac_id},
        type: 'post',
        dataType: 'json',
        success: function(e) {
            if(e.status == 200 ){
                ct_data = e.data;
                //渲染页面
                var r = template.render('detail_main', e);
                $(".page-content").html( r );

                //渲染收货地址
                if( e.data.address ){
                    //保留收货地址数据 选择收货地址时使用
                    for( var i = 0 ; i < e.data.address.length; i++ ){
                        address[e.data.address[i].ud_id] = e.data.address[i];
                    }
                    renderAddress( e.data );
                }

                //如果是新用户砍价 弹出分享多砍一刀对话框
                if( e.data.user_is_initiator && e.data.cut_down_share_price * 1 > 0 ){
                    var r = template.render("share_main", e );
                    $("#share_rolling").html( r );
                    showBottom('share_box');
                }

                //活动规则
                if( e.data.cutprice_rules ){
                    $('#activity_rules').html( e.data.cutprice_rules );
                }
                //信息提示1
                $('#message_tip1').find('.user-img-ab').children('img').attr('src',e.data.user_avatar);
                //倒计时
                var _timeCount = $(".timeCount");
                _timeCount.TimeCount();
                 //初始化分享机制
                 
                if (_wap_wx) {
                    $.ajax({
                        url: SYS.URL.wx.config,
                        data: {
                            href: location.href, item_name: e.data.activity_rule.item_name, product_image:e.data.activity_rule.product_image, product_tips:e.data.activity_rule.activity_intro, _pjax:1, fancybox:1, 'body_class_none':1
                        },
                        dataType: 'script',
                        success: function (res) {
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

                                if(e.data.activity_rule.product_image.indexOf("https") == 0 || e.data.activity_rule.product_image.indexOf("http"))
                                {
                                    img_url = e.data.activity_rule.product_image;
                                }
                                else
                                {
                                    if(SYS.HTTPS)
                                    {
                                        img_url = "http:" + e.data.activity_rule.product_image;
                                    }
                                    else
                                    {
                                        img_url = "https:" + e.data.activity_rule.product_image;
                                    }
                                }

                                var a_title = __('来砍价了！') + '-';

                                wx.onMenuShareTimeline({
                                    title: a_title + e.data.activity_rule.item_name, //分享标题
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                        shareCallBack();
                                    },
                                    cancel: function () {
                                    }
                                });

                                wx.onMenuShareAppMessage({
                                    title: a_title + e.data.activity_rule.item_name, //分享标题
                                    desc: e.data.activity_rule.activity_intro, //分享描述
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    type: 'link',
                                    dataUrl: '',
                                    success: function () {
                                        shareCallBack();
                                    },
                                    cancel: function () {
                                    }
                                });

                                wx.onMenuShareQQ({
                                    title: a_title + e.data.activity_rule.item_name, //分享标题
                                    desc: e.data.activity_rule.activity_intro, //分享描述
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                        shareCallBack();
                                    },
                                    cancel: function () {
                                    }
                                });

                                wx.onMenuShareWeibo({
                                    title: a_title + e.data.activity_rule.item_name, //分享标题
                                    desc: e.data.activity_rule.activity_intro, //分享描述
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                        shareCallBack();
                                    },
                                    cancel: function () {
                                    }
                                });

                                wx.onMenuShareQZone({
                                    title: a_title + e.data.activity_rule.item_name, //分享标题
                                    desc: e.data.activity_rule.activity_intro, //分享描述
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                        shareCallBack();
                                    },
                                    cancel: function () {
                                    }
                                });

                            });

                            _wap_wx = 0;
                        }
                    });
                }
               
                //分享回调函数
                function shareCallBack(){
                    $('#mask_help').removeClass('on');
                    if( e.data.user_is_initiator && e.data.cut_down_share_price * 1 > 0 ){
                        var cut_down_share_price = e.data.cut_down_share_price;
                        var ac_id = e.data.ac_id;
                        $.request({
                            url: SYS.URL.user.editUserCutPriceActivity,
                            data: {cut_down_share_price:cut_down_share_price,ac_id:ac_id},
                            type: 'post',
                            dataType: 'json',
                            success:function( e ){
                                if( e.status == 200 ){
                                    $('#cut_tips').html( __('已砍') + '<span class="c5">' + e.data.cut_price + '</span> ' + __('元') + '，'+ __('只差') + ' <span class="c5">'+e.data.rest_price+'</span> ' + __('元了') );
                                    $('#help_list').children('li:last-child').find('.help_price').html( e.data.ach_price );
                                    $('#help_list').children('li:last-child').find('.help_cut').html( '<span class="icon icon-killfbg"></span><span class="icon icon-killfbg"></span>' );
                                    if( e.data.ac_status == '4') {
                                        var bind_main = '<a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="javascript:;" onclick="confirm()"> ' + __('砍价完成，立即出手') +'  </a>';
                                        $('#bind_main').html( bind_main );
                                    }
                                } else {
                                    $.sDialog({
                                        skin: "red",
                                        content: e.msg,
                                        okBtn: false,
                                        cancelBtn: false
                                    });
                                }
                            }
                        });
                    }
                }
            } else {
                $.sDialog({
                    skin: "red",
                    content: e.msg,
                    okBtn: false,
                    cancelBtn: false
                });
                setTimeout(function(){
                    window.location.href = 'cutprice_list.html';
                return;
                },500)
                
            }
        }
    });
}

//事件绑定
function eventBind(){
    //找人帮砍
    $('.help_pic').on('click', function(){
        $('#mask_help').removeClass('on');
    });

    $(document).on('click','.share_btn',function(){
        hiddenBottom('share_box');
        $('#mask_help').addClass('on');
    })

    //关闭地址
    $(document).on('click','.header-back',function(){
        $('#new-address-wrapper').removeClass('left').addClass('right');
    })
}

function shareBox(){
    $('#mask_help').addClass('on');
}

//渲染收货地址
function renderAddress( data ){
    var r = template.render("address_main", data);

    $("#address_list").append(r);
}


// 选择收获地址
function showAddress() {
    showBottom('select_address');
}


//显示新增收货地址页
function showAddressAddWrap(){
    hiddenBottom('select_address');
    $('#new-address-wrapper').removeClass('hide').removeClass('right').addClass('left');
}

//选择收货地址
function selectAddress( id ){
    var address_data = address[id];
    console.log( address_data );
    var r = template.render("address_dialog", address_data);
    $("#confirm_address").html(r);

    hiddenBottom('select_address');
    showCenter('popup_address');
}

//新增收货地址
function addAddress(){
    $.sValid.init({
        rules:{
            true_name:"required",
            mob_phone:"required",
            district_info:"required",
            address:"required"
        },
        messages:{
            true_name:__("姓名必填！"),
            mob_phone:__("手机号必填！"),
            district_info:__("地区必填！"),
            address:__("街道必填！")
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide();
            }
        }  
    });

    $('.main-btn').click(function(){
        if($.sValid()){
            var true_name = $('#true_name').val();
            var mob_phone = $('#mob_phone').val();
            var ud_address = $('#address').val();
            var ud_postalcode = $('#ud_postalcode').val();
            var county_id = $('#district_info').attr('data-areaid2');
            var city_id = $('#district_info').attr('data-areaid1');
            var province_id = $('#district_info').attr('data-areaid');
            var district_id = $('#district_info').attr('data-areaid');
            var district_info = $('#district_info').val();
            var is_default = $('#is_default').attr("checked") ? 1 : 0;

            $.request({
                type:'post',
                url: SYS.URL.user.address_edit,
                data:{
                    ud_name :  true_name,
                    ud_mobile :  mob_phone,
                    ud_address :  ud_address,
                    ud_county_id : county_id,
                    ud_city_id :  city_id,
                    ud_province_id:  province_id,
                    ud_district_id :  district_id,
                    district_info : district_info,
                    ud_postalcode : ud_postalcode,
                    ud_is_default :  is_default,
                },
                dataType:'json',
                success: function (a) {
                    if (a)
                    {   
                        $('#new-address-wrapper').addClass('hide').addClass('right').removeClass('left');
                        address[a.data.ud_id] = a.data;
                        selectAddress( a.data.ud_id )
                    }
                }
            });
        }
    });
}

//帮好友砍一刀
function helpCutprice( ac_id ){

    var ua = navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i)=="micromessenger" && false )
    {

    } else {
        //判断用户是否登录
        if(!getLocalStorage('ukey') ){
            setLocalStorage('redirect_uri', '/tmpl/cutprice_detail.html?ac_id=' + ac_id );
            checkLogin(0);
            return false;
        }
    }
    postData( ac_id );
}

function postData( ac_id ){
    $.request({
        type:'post',
        url: SYS.URL.user.helpUserCutPriceActivity,
        data:{ac_id : ac_id},
        dataType:'json',
        success: function (e) {
            if(e.status == 250)
            {
                $.sDialog({
                    content: __('帮砍失败！'),
                    okBtn:false,
                    cancelBtnText:__('返回'),
                    cancelFn: function() { /*history.back();*/ }
                });
            }else{
                switch(e.status)
                {
                    case 200: //成功帮砍
                        var cutprice_txt = '<div class="f2 c9 pd2">' + __('成功帮好友砍价') +e.data.ach_price+__('元')+ '</div>'+
                    '<div class="f6">' + __('你也可以砍价免费拿哦，快去挑选心仪的商品吧')~ + '</div>';
                        break;
                    case 220: //活动结束
                        var cutprice_txt = '<div class="f6">' + __('本次砍价活动已经结束了哦，感谢您的参与~') + '</div>';
                        break;
                    case 240: //已经帮砍
                        var cutprice_txt = '<div class="f6">' + __('您已经帮助好友砍过价了哦，我也要砍价试试~') + '</div>';
                        break;
                }

                $('#message_tip1').find('.content-message').html(cutprice_txt);
                showCenter('message_tip1');

                if(e.status == 200)
                {
                    $('#bind_main').html( '<a class="flex-center ptb21 f7 cf bg5 bor-r60" href="cutprice_list.html" >'+__('我也要砍价')+'</a>');
                    $('#cut_tips').html( __('已砍') + '<span class="c5">' + e.data.cut_price + '</span> ' + __('元') + '，' + __('只差') + '<span class="c5">'+e.data.rest_price+'</span> ' + __('元了') );
                    var r = template.render('help_item', e);
                    $("#help_list").prepend( r );
                }
            }
        }
    });
}

//返回
function goBack(){
    window.location.href = 'cutprice_list.html';
}

//点击收货地址确定按钮 执行回调函数 进行砍价
function addressCallback( ud_id ){
    $.request({
        type:'post',
        url: SYS.URL.user.editCutPriceActivityAddress,
        data:{ac_id:ac_id,ud_id,ud_id},
        dataType:'json',
        success: function (e) {
            if( e.status == 200 ){
                ct_data.ac_ud_id = e.data.ac_ud_id;
                hiddenCenter();
                postConfirm();
            } else {
                alert( '操作失败' );
            }
        }
    })
}


//砍价完成 确认付款
function confirm(){
    if(!getLocalStorage('ukey') ){
        setLocalStorage('redirect_uri', '/tmpl/cutprice_detail.html?ac_id=' + ac_id );
        checkLogin(0);
        return false;
    }
    //确定收货地址
    if( ct_data.ac_ud_id*1 <= 0 ){
        showBottom('select_address');
        return;
    } else {
        postConfirm();
    }
}

function postConfirm(){
    $.request({
        type:'post',
        url: SYS.URL.user.order_add,
        data:{
            cart_id: ct_data.item_id+'|'+1,
            ifcart : 0,
            ud_id  : ct_data.ac_ud_id,
            if_chain : 0,
            activity_id : ct_data.activity_id,
            ac_id : ct_data.ac_id
        },
        dataType:'json',
        success: function(e)
        {
            if( e.status = 200 ){
                var data = e.data;

                //砍价0元得的商品 直接修改订单状态为已付款
                if( data.orderSelMoneyAmount * 1 == 0 ) {
                    window.location.href = itemUtil.getUrl(SYS.URL.pay.payed, {key:getLocalStorage('ukey'),order_id:e.data.order_id[0]});
                    
                } else {
                    order_id = e.data.order_id;
                    toPay(e.data.order_id, 'member_buy', 'pay');
                }

            } else {
                if(a.msg != 'failure')
                {
                   /* Public.tips.error(a.msg);*/
                    $.sDialog({
                        content: a.msg,
                        okBtn:false,
                        cancelBtnText:__('返回'),
                        cancelFn: function() { /*history.back();*/ }
                    });
                }else
                {
                    /*Public.tips.error('订单提交失败！');*/
                    $.sDialog({
                        content: __('订单提交失败！'),
                        okBtn:false,
                        cancelBtnText:__('返回'),
                        cancelFn: function() { /*history.back();*/ }
                    });
                }
            }
        },
        failure:function(a)
        {
            $.sDialog({
                content: __('操作失败！'),
                okBtn:false,
                cancelBtnText:__('返回'),
                cancelFn: function() { /*history.back();*/ }
            });
        }
    })
}



