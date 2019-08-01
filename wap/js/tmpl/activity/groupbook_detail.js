
;$(function(){
    //todo 详情
    var gb_id    = !isNull(getQueryString('gb_id')) ? getQueryString('gb_id') : '';
    var order_id = !isNull(getQueryString('order_id')) ? getQueryString('order_id') : '';
    var params = {gb_id: gb_id, order_id: order_id};
    $.request({
        url    : SYS.URL.user.getUserGroupbooking,
        data   : params,
        success: function (res) {
            if (res.status == 200) {
                //初始化分享机制
                if (_wap_wx) {
                    $.ajax({
                        url: SYS.URL.wx.config,
                        data: {
                            href: location.href, item_name: res.data.activity_rule.item_name, product_image:res.data.activity_rule.product_image, product_tips:res.data.activity_rule.activity_intro, _pjax:1, fancybox:1, 'body_class_none':1
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


                                if(res.data.activity_rule.product_image.indexOf("https") == 0 || res.data.activity_rule.product_image.indexOf("http"))
                                {
                                    img_url = res.data.activity_rule.product_image;
                                }
                                else
                                {
                                    if(SYS.HTTPS)
                                    {
                                        img_url = "http:" + res.data.activity_rule.product_image;
                                    }
                                    else
                                    {
                                        img_url = "https:" + res.data.activity_rule.product_image;
                                    }
                                }

                                var need_num = res.data.gb_amount_quantity - res.data.gb_quantity;
                                var a_title = '【还差' + need_num + '人】邀请您参加拼团！ - ';

                                wx.onMenuShareTimeline({
                                    title: a_title + res.data.activity_rule.item_name, //分享标题
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                    },
                                    cancel: function () {
                                    }
                                });

                                wx.onMenuShareAppMessage({
                                    title: a_title + res.data.activity_rule.item_name, //分享标题
                                    desc: res.data.activity_rule.activity_intro, //分享描述
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
                                    title: a_title + res.data.activity_rule.item_name, //分享标题
                                    desc: res.data.activity_rule.activity_intro, //分享描述
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                    },
                                    cancel: function () {
                                    }
                                });

                                wx.onMenuShareWeibo({
                                    title: a_title + res.data.activity_rule.item_name, //分享标题
                                    desc: res.data.activity_rule.activity_intro, //分享描述
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                    },
                                    cancel: function () {
                                    }
                                });

                                wx.onMenuShareQZone({
                                    title: a_title + res.data.activity_rule.item_name, //分享标题
                                    desc: res.data.activity_rule.activity_intro, //分享描述
                                    link: link, //分享链接
                                    imgUrl: img_url, //分享图标
                                    success: function () {
                                    },
                                    cancel: function () {
                                    }
                                });
                            });

                            _wap_wx = 0;
                        }
                    });
                }

            }
        }
    });
})


function takeCount()
{
    $(".count-time").each(function ()
    {
        var obj = $(this);
        var tms = obj.attr("count_down");
        var match = tms.match(/^\d+(\.\d+)?$/);   //考虑小数写法 ^\d+(\.\d+)?$
        if(!match) {
            var date = new Date(tms);
            // 如果传递的不是小数或数字，则认为是传的结束时间
            // 对结束时间进行转换成时间戳
            tms = (date.getTime() - new Date().getTime()) / 1e3;
        }
        if (tms > 0) {
            tms = parseInt(tms) - 1;
            var days = Math.floor(tms / (1 * 60 * 60 * 24));
            var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
            var minutes = Math.floor(tms / (1 * 60)) % 60;
            var seconds = Math.floor(tms / 1) % 60;

            if (days < 0) {
                days = "00";
            }
            if (hours < 0) {
                hours = "00";
            }
            if (minutes < 0) {
                minutes = "00";
            }
            if (seconds < 0) {
                seconds = "00";
            }
            obj.find("[time_id='d']").html(days > 10 ? days : '0' + days);
            obj.find("[time_id='h']").html(hours > 10 ? hours : '0' + hours);
            obj.find("[time_id='m']").html(minutes > 10 ? minutes : '0' + minutes);
            obj.find("[time_id='s']").html(seconds > 10 ? seconds : '0' + seconds);
            obj.attr("count_down", tms);
        }
    });
}
