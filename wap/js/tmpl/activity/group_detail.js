;


var _wap_wx = 0;

if (isWeixin())
{
    _wap_wx = 1;
    loadJs("https://res.wx.qq.com/open/js/jweixin-1.2.0.js");
}



;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {

    var endTime = "0000:00:00";

    groupDeatil = {
        config: function () {
        },
        init: function () {
            var t = this;
            t.config(), t.runMethod();
        },

        runMethod: function () {
            var t = this,
                urlArgs = getUrlParams();
            t.clickEvent();
            t.onLoad(urlArgs);

            var apx = new Vue({
                el     : '#container',
                data   : t.data,
            });
            
            // setInterval(function(){t.takeCount()}, 1000);
            setInterval(function(){
                var _timeCount = $(".count-time");
                _timeCount.TimeCount();
                 //初始化分享机制
             },500)
            // 推荐商品轮播
            var myKjSwiper = new Swiper('#swiper_container_tj', {
                slidesPerView: 2,//'auto'
                freeMode: false,
            });
            setInterval(function(){
                var scroll = new BScroll(document.querySelector('.avatar-warp'), {
                    probeType: 3,
                    click: true,
                    scrollX: true
                })
            },1000);
            return t;
        },

        clickEvent: function () {
            var t = this;
            $(document).on('click', '[bindtap]', function (ele) {
                var callback = ele.currentTarget.attributes.bindtap.value;
                t[callback](ele);
            });
            $(document).on('click', '[bindinput]', function (ele) {
                var callback = ele.target.attributes.bindinput.value;
                t[callback](ele);
            });
        },

        data: {
            Photo          : "",
            UserName       : "",
            splistStr      : [],
            ispaysuccess   : !1,
            IsOwner        : !1,
            order_id       : "",
            isfg           : !1,
            GbInfo         : {
                activity_rule: {}
            },
            RecGoods       : [],
            remain_quantity: 0,
            GroupUsers     : [],
            isPage         : !0,
            page           : 1,
            Coupons        : [],
            isCancelSuccess: !0,
            isCancel       : !0,
            CouponAmount   : 0,
            IsNewUser      : 0,
            userInfoId     : 0,
            show           : !0,
            groupIsEnd     : !1
        },

        onLoad: function (options) {
            var t = this;
            var userInfo = getUserInfo();
            setData(t, {
                userInfo: userInfo
            });
            t.InitData(options);
            // notice.addNotification("RefreshFG", t.RefreshFG, t)
        },

        onUnload: function () {
            // 离开页面，注销事件
            var t = this
            notice.removeNotification("RefreshFG", t);
        },

        InitData: function (options) {
            var t = this;
            setData(t, {
                Photo   : t.data.userInfo.user_avatar,
                UserName: t.data.userInfo.user_nickname,
                isfg    : options.isfg || !1
            });

            var params = {gb_id: options.gb_id || "", order_id: options.on || ""};

            //todo 详情
            $.request({
                url    : SYS.URL.user.getUserGroupbooking,
                data   : params,
                success: function (res) {
                    if (res.status == 200) {
                        res.data.gbh_rows.forEach(function (e) {
                            e.user_id == t.data.userInfo.user_id && (setData(t, {userInfoId: e.user_id}));

                            //判断是否团长
                            if (e.user_id == t.data.userInfo.user_id) {
                                e.user_id == t.data.userInfo.user_id && setData(t, {
                                    ispaysuccess: e.gbh_flag,
                                    IsOwner     : e.user_id == res.data.user_id,
                                    order_id    : e.order_id
                                })
                            }
                        });
                        endTime =  res.data.gb_endtime ? res.data.gb_endtime : "0000:00:00";


                        var $now = (new Date).getTime();
                        var $end = (new Date(res.data.gb_endtime)).getTime();
                        var $activityEnd = (new Date(res.data.activity_rule.activity_endtime)).getTime();
                        if (res.data.endTime <= 0) {
                            setData(t, {
                                groupIsEnd: !0
                            });
                        }
                        if ($activityEnd - $now <= 0) {
                            setData(t, {
                                show: !1
                            });
                        }
                        var remain_quantity = parseInt((res.data.gb_quantity) > 8 ? (8 - res.data.gb_amount_quantity) : (res.data.gb_quantity - res.data.gb_amount_quantity));
                        setData(t, {
                            GbInfo         : res.data,
                            remain_quantity: remain_quantity,
                            GroupUsers     : res.data.gbh_rows,
                            RecGoods       : res.data.hot_goods,
                        });

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
                }
            });
        },

        onShareAppMessage: function () {
            var t = this;
            var differ = t.data.GbInfo.gb_quantity - t.data.GbInfo.gb_amount_quantity,
                title = differ > 0 ? "【还差" + (t.data.GbInfo.gb_amount_quantity - t.data.GbInfo.gb_quantity) + "人】" + t.data.userInfo.user_nickname + "邀请您参加拼团！立省" + (t.data.GbInfo.ItemSalePrice - t.data.GbInfo.PreferentialPrice).toFixed(2) + "元！" : t.data.userInfo.user_nickname + "拼团成功！他已节省" + (t.data.GbInfo.ItemSalePrice - t.data.GbInfo.PreferentialPrice).toFixed(2) + "元！赶快来拼团吧!";
            return {
                title: title,
                desc : t.data.GbInfo.item_name,
                path : "/pages/fightgroupsdetail/fightgroupsdetail?gb_id=" + t.data.GbInfo.gb_id + "&pid=" + t.data.GbInfo.activity_rule.item_id + "&uid=" + t.data.userInfo.user_id
            }
        },
        RefreshFG        : function () {
            var t = this;
            var params = {gb_id: t.data.GbInfo.gb_id};
            t.InitData(params)
        },

        takeCount:function ()
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
        },

        immediatelyOffered: function () {
            var t = this;
            /*var param = {
            Amount: 1,
            ProductId: t.data.proId,
            orderType: 1,
            activity_id: t.data.MEID,
            isOwner: "true",
            isFightGroup: "2",
            item_id: t.data.skuid,
            AddTime: getNowFormatDate(),
            ownGroupId: 0,
            ProductSaleName: t.data.pname,
            UserAccount: t.data.userInfo.user_account,
            speStr: JSON.stringify(t.data.splistStr).replace("[", "").replace("]", "").replace(/\,/g, "  ").replace(/\"/g, "")
        };*/
            window.location.href = "../../tmpl/order/buy_step1.html?ifcart=0&item_id=" + t.data.GbInfo.activity_rule.item_id + "&buynum=" + 1 + "&activity_id=" + t.data.GbInfo.activity_id + "&gb_id=" + t.data.GbInfo.gb_id;
            wx.navigateTo({url: "../checkout/checkout?ifcart=0&cart_id=" + t.data.GbInfo.activity_rule.item_id + "|" + 1 + "&activity_id=" + t.data.GbInfo.activity_id + "&gb_id=" + t.data.GbInfo.gb_id})
        },

        doReceive        : function () {
            var t = this;
            t.cancel(), t.userReceiveCoupon()
        },
        cancel           : function () {
            var t = this;
            setData(t, {isCancel: !1})
        },
        cancelsuccess    : function () {
            var t = this;
            setData(t, {isCancelSuccess: !0})
        },
        innertouch       : function () {
        },
        userReceiveCoupon: function () {
            var t = this;

            var params = {
                CouponIds: "",
                IsNewUser: t.data.IsNewUser
            };
            console.log(params);
            $.xsr($.makeUrl(userapi.UserReceiveCoupon, params), function (e) {
                e.Code == 0 ? setData(t, {isCancelSuccess: !1, Coupons: e.Info}) : $.alert(e.Msg)
            })
        },
        fightPage        : function (e) {
            var t = this;
            if (t.data.isPage) {
                setData(t, {isPage: !1});
                clearTimeout(n);
                var n = setTimeout(function () {
                        var e = {
                            gb_id  : t.data.GbInfo.gb_id,
                            EventId: t.data.GbInfo.MarketingEventId,
                            page   : parseInt(t.data.page) + 1
                        };
                        /*$.xsr($.makeUrl(fgapi.GetGroupMarketingEventUsersByPage, e), function (n) {
                            if (n.Info.length > 0)
                            {
                                var r = t.data.GbInfo;
                                r.gbh_rows = r.gbh_rows.concat(n.Info), setData(t, {
                                    isPage: !0,
                                    page: e.page,
                                    GbInfo: r
                                })
                            }
                            else
                            {
                                setData(t, {isPage: !1})
                            }
                        })*/
                    },
                    500)
            }
        },
        shareQRCode      : function (e) {
            var t = this;
            var params = {

                Path              : ApiUrl + "/wap/tmpl/activity/group_detail.html?gb_id=" + t.data.GbInfo.gb_id + "&pid=" + t.data.GbInfo.activity_rule.item_id + "&uid=" + t.data.userInfo.user_id,
                MainImg           : t.data.GbInfo.ProductPic,
                MainTitle         : t.data.GbInfo.item_name,
                item_id           : t.data.GbInfo.activity_rule.item_id,
                MarketingEventId  : t.data.GbInfo.MarketingEventId,
                ItemSalePrice     : t.data.GbInfo.ItemSalePrice,
                OriginalPrice     : t.data.GbInfo.PreferentialPrice,
                GroupPersonAmout  : t.data.GbInfo.gb_quantity,
                CutPrice          : "",
                user_id           : t.data.userInfoId,
                MarketingEventTime: t.data.GbInfo.EndTimeStr
            };


            //生成二维码并返回地址。 - 需要修改调整为小程序地址
            $.request({
                url    : SYS.URL.wx.getMiniAppQRCode,
                data   : params,
                success: function (res) {
                    setData(t, {PageQRCodeInfo: {Path: res.data.url, IsShare: !0, IsShareBox: !1, IsJT: !0}})
                }
            });
        },
        shareBox         : function () {
            var t = this;
            if (isWeixin())
            {
                //立即分享到微信朋友圈点击事件
                $("#shareit").show();
            }
            else
            {
                alert(__('通过浏览器分享机制分享本链接给好友'));
            }

            return;

            setData(t, {PageQRCodeInfo: {Path: "", IsShare: !0, IsShareBox: !0, IsJT: !1}})
        },
        cancelShare      : function () {
            var t = this;

            $("#shareit").hide();

            return;


            setData(t, {PageQRCodeInfo: {Path: "", IsShare: !1, IsShareBox: !1, IsJT: !1}})
        },
        saveImg          : function () {
            var t = this;
            $.showLoading(), wx.downloadFile({
                url    : t.data.PageQRCodeInfo.Path,
                success: function (t) {
                    $.hideLoading(), wx.saveImageToPhotosAlbum({
                        filePath: t.tempFilePath, success: function () {
                            setData(t, {
                                PageQRCodeInfo: {
                                    Path      : "",
                                    IsShare   : !1,
                                    IsShareBox: !1,
                                    IsJT      : !1
                                }
                            }), $.alert(__("保存图片成功！"))
                        },
                        fail    : function (e) {
                            $.hideLoading();
                        }
                    })
                },
                fail   : function (e) {
                    $.hideLoading()
                }
            })
        },
        showCodeImg      : function () {
            var t = this;
            console.log(t.data.PageQRCodeInfo.Path), wx.previewImage({
                current: t.data.PageQRCodeInfo.Path,
                urls   : [t.data.PageQRCodeInfo.Path]
            })
        }
    },
        $(function () {
            groupDeatil.init();
        })


}));