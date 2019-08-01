function getNowFormatDate() {
    var e = new Date, t = "-", n = e.getMonth() + 1, r = e.getDate();
    n >= 1 && n <= 9 && (n = "0" + n), r >= 0 && r <= 9 && (r = "0" + r);
    var i = e.getFullYear() + t + n + t + r;
    return i
}

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
    bargain = {
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
            t.onShow();
            var apx = new Vue({
                el: '#container',
                data: t.data
            });
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
            Time: "",
            hours: "",
            show: !1,
            showImg: !1,
            showPrice: !1,
            isCut: !0,
            imgPath: "",
            user_nickname: "",
            mid: 0,
            uid: 0,
            pid: 0,
            page: 1,
            rows: 10,
            Info: {
                activity_rule:{}
            },
            end: 0,
            startTime: "",
            endTime: "",
            istrue: !0,
            flag: !0,
            ispage: !0,
            width: 100,
            participantId: "",
            ac_id: 0,
            money: 0,
            List: [],
            hour: 0,
            min: 0,
            sec: 0,
            PageQRCodeInfo: {Path: "", IsShare: !1, IsShareBox: !1, IsJT: !1}
        },

        onLoad: function (e) {
            var t = this;
            var userInfo  = getUserInfo();
            setData(t, {
                userInfo: userInfo
            });
            if (userInfo ) {
                !isNull(e.sid) ? setData(t, {
                    imgPath: userInfo.user_avatar,
                    user_nickname: userInfo.user_nickname,
                    mid: e.mid,
                    uid: e.sid,
                    participantId: userInfo.user_id,
                    pid: e.pid
                }) : setData(t, {
                    imgPath: userInfo.user_avatar,
                    user_nickname: userInfo.user_nickname,
                    mid: e.mid,
                    uid: e.uid || userInfo.user_id,
                    participantId: userInfo.user_id,
                    pid: e.pid
                });
                t.GetVendorCutPriceEventDetail(), t.GetOtherCutPriceActivityList(), t.getTime()
            }

        },

        onShow: function () {
            var t = this;
            t.GetVendorCutPriceEventDetail()
        },

        GetVendorCutPriceEventDetail: function () {
            var t = this,
                params = {
                    activity_id: t.data.mid,
                    user_id: t.data.uid,
                    participant_id: t.data.userInfo.user_id
                };
            params.user_id == params.participant_id ? setData(t, {istrue: !0}) : setData(t, {istrue: !1});
            $.request({
                url    : SYS.URL.user.getCutPriceActivity,
                data   : params,
                success: function (result)
                {
                    if (200 == result.status) {
                        console.info(result.data)
                        result.data.CutPricePercent = (result.data.activity_rule.item_unit_price - result.data.ac_sale_price) / (result.data.activity_rule.item_unit_price - result.data.activity_rule.cut_down_min_limit_price)
                        setData(t, {
                            Info: result.data,
                            ac_id: result.data.ac_id,
                            width: 100 * parseFloat(result.data.CutPricePercent).toFixed(2)
                        });
                        t.getTime();
                        result.data.ac_sale_price - result.data.ac_mix_limit_price <= 0 ? setData(t, {isCut: !1}) : "";


                        //初始化分享机制

                        if (_wap_wx) {
                            $.ajax({
                                url: SYS.URL.wx.config,
                                data: {
                                    href: location.href, item_name: result.data.activity_rule.item_name, product_image:result.data.activity_rule.product_image, product_tips:result.data.activity_rule.activity_intro, _pjax:1, fancybox:1, 'body_class_none':1
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

                                        if(result.data.activity_rule.product_image.indexOf("https") == 0 || result.data.activity_rule.product_image.indexOf("http"))
                                        {
                                            img_url = result.data.activity_rule.product_image;
                                        }
                                        else
                                        {
                                            if(SYS.HTTPS)
                                            {
                                                img_url = "http:" + result.data.activity_rule.product_image;
                                            }
                                            else
                                            {
                                                img_url = "https:" + result.data.activity_rule.product_image;
                                            }
                                        }

                                        var a_title = '来砍价了！ - ';

                                        wx.onMenuShareTimeline({
                                            title: a_title + result.data.activity_rule.item_name, //分享标题
                                            link: link, //分享链接
                                            imgUrl: img_url, //分享图标
                                            success: function () {
                                            },
                                            cancel: function () {
                                            }
                                        });

                                        wx.onMenuShareAppMessage({
                                            title: a_title + result.data.activity_rule.item_name, //分享标题
                                            desc: result.data.activity_rule.activity_intro, //分享描述
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
                                            title: a_title + result.data.activity_rule.item_name, //分享标题
                                            desc: result.data.activity_rule.activity_intro, //分享描述
                                            link: link, //分享链接
                                            imgUrl: img_url, //分享图标
                                            success: function () {
                                            },
                                            cancel: function () {
                                            }
                                        });

                                        wx.onMenuShareWeibo({
                                            title: a_title + result.data.activity_rule.item_name, //分享标题
                                            desc: result.data.activity_rule.activity_intro, //分享描述
                                            link: link, //分享链接
                                            imgUrl: img_url, //分享图标
                                            success: function () {
                                            },
                                            cancel: function () {
                                            }
                                        });

                                        wx.onMenuShareQZone({
                                            title: a_title + result.data.activity_rule.item_name, //分享标题
                                            desc: result.data.activity_rule.activity_intro, //分享描述
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


                    } else {
                        setData(t, {flag: !1, ispage: !0})
                        $.sDialog({
                            skin     : "green",
                            content  : result.msg,
                            okBtn    : false,
                            cancelBtn: false
                        });
                    }
                }
            });
        },

        getTime: function () {
            var t = this, $time = (new Date).getTime(), s = t.data.Info.activity_endtime,n = t.data.Info.activity_starttime;
            var i = (new Date(n)).getTime(),u = (new Date(s)).getTime();
            var diff_time = 0;
            var end = 1;
            if (i >= $time) {
                diff_time = $time - i;
                end = 1;
            }
            if (u <= $time) {
                diff_time = u-$time;
                end = 3;
            }
            if (i < $time < u) {
                diff_time = u - $time;
                end = 2;
            }
            var a = setInterval(function () {
                diff_time  -= 1e3;
                setData(t, {
                    Time: Formattime(diff_time, a),
                    end: end
                }), t.data.Time == undefined && t.getTime()
            }, 1e3);
            return
        },

        GetOtherCutPriceActivityList: function () {
            var t = this;
            var params = {activity_id: t.data.mid, user_id: t.data.uid, page: t.data.page};

            $.request({
                url    : SYS.URL.user.listsCutPriceHistory,
                data   : params,
                success: function (result)
                {
                    if (200 == result.status && result.data.items.length > 0) {
                        setData(t, {flag: !1});
                        setData(t, {
                            ispage: !0,
                            List  : result.data.items
                        });
                    } else {
                        setData(t, {flag: !1, ispage: !0})
                    }
                }
            });
        },

        CutPrice: function () {
            var t = this;

            var params = {
                ac_id  : t.data.ac_id,
                user_id: t.data.userInfo.user_id
            };
            $.request({
                url: SYS.URL.user.doCutPrice,
                data: params,
                success: function (res) {
                    if (200 == res.status) {
                        setData(t, {
                            money: res.data.ach_price,
                            ac_id: res.data.ac_id,
                            show : !0
                        })
                    } else {
                        setData(t, {
                            show: !1
                        });
                        $.sDialog({
                            skin     : "green",
                            content  : res.msg,
                            okBtn    : false,
                            cancelBtn: false
                        });

                        setTimeout(function () {
                            window.location = "../activity/bargain_list.html";
                        }, 2e3)
                    }


                }
            });
            t.GetOtherCutPriceActivityList();
        },

        onShareAppMessage: function () {
            var t = this;
            return {
                title: t.data.Info.activity_rule.item_name,
                path: ApiUrl + "/wap/tmpl/activity/bargain.html?mid=" + t.data.mid + "&uid=" + t.data.uid + "&pid=" + t.data.pid + "&ac_id=" + t.data.ac_id
            }
        },

        bargin: function () {
            var t = this;
            setInterval(function () {
                setData(t, {showImg: !0})
            }, 600), t.CutPrice()
        },

        back: function () {
            var t = this;
            setData(t, {show: !1}), t.GetVendorCutPriceEventDetail(), t.GetOtherCutPriceActivityList()
        },

        more: function (e) {
            var t = this;
            if (t.data.flag) {
                clearTimeout(n);
                var n = setTimeout(function () {
                    setData(t, {page: parseInt(t.data.page) + 1}), t.GetOtherCutPriceActivityList()
                }, 500)
            }
        },

        goshop: function () {
            var t = this;
            var params = {
                amount  : 1,
                item_id : t.data.Info.activity_rule.item_id,
                ac_id   : t.data.Info.ac_id,
                order_id: t.data.Info.order_id,
            };

            if (t.data.Info.order_id == "") {
                window.location = "../order/buy_step1.html?single_activity=1&ifcart=0&item_id=" + params.item_id + "&buynum=" + params.amount + "&cart_id=" + params.item_id + "|"  + "&activity_id=" + t.data.mid + "&ac_id=" + t.data.ac_id;
            } else {
                // wx.navigateTo({url: "../../pages/checkout/checkout?spid=" + JSON.stringify(params) + "&activity_id=" + this.data.mid + "&sponsorId=" + this.data.uid + "&sp=" + this.data.Info.ServicePlaceCode + "&pm=" + this.data.Info.PayMethodCode + "&et=" + this.data.Info.BusinessHoursEnd + "&st=" + this.data.Info.BusinessHoursStart + "&showdate=" + this.data.Info.ReservationTimeEnabled + "&showname=" + this.data.Info.ContactEnabled})
            }
        },

        shareQRCode: function (e) {
            var t = this;
            n = {
                Path: ApiUrl + "/wap/tmpl/activity/bargain.html?mid=" + t.data.mid + "&uid=" + t.data.uid + "&pid=" + t.data.pid + "&ac_id=" + t.data.ac_id,
                MainImg: t.data.Info.activity_rule.product_image,
                MainTitle: t.data.Info.activity_rule.item_name,
                ProductId: t.data.pid,
                MarketingEventId: t.data.mid,
                ItemSalePrice: t.data.Info.activity_rule.item_unit_price,
                OriginalPrice: "",
                GroupPersonAmout: "",
                CutPrice: t.data.Info.activity_rule.item_unit_price - Info.ac_sale_price,
                UserInfoId: t.data.uid,
                MarketingEventTime: t.data.Info.activity_starttime
            };
            //生成二维码并返回地址。 - 需要修改调整为小程序地址
            $.request({
                url: SYS.URL.wx.getQRCode,
                data: params,
                success: function (data, status, msg, code) {
                    that.setData({PageQRCodeInfo: {Path: data.url, IsShare: !0, IsShareBox: !1, IsJT: !0}})
                }
            });
        },

        shareBox: function () {

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

        cancelShare: function () {
            var t = this;

            $("#shareit").hide();

            return;


            setData(t, {PageQRCodeInfo: {Path: "", IsShare: !1, IsShareBox: !1, IsJT: !1}})
        },

        saveImg: function () {
            var t = this;
            $.showLoading();
            wx.downloadFile({
                url    : t.data.PageQRCodeInfo.Path,
                success: function (t) {
                    $.hideLoading();
                    wx.saveImageToPhotosAlbum({
                        filePath: t.tempFilePath,
                        success : function () {
                            setData(t, {
                                PageQRCodeInfo: {
                                    Path      : "",
                                    IsShare   : !1,
                                    IsShareBox: !1,
                                    IsJT      : !1
                                }
                            }), $.alert(__("保存图片成功！"))
                        }, fail : function (e) {
                            $.hideLoading();
                        }
                    })
                },
                fail: function () {
                    $.hideLoading()
                }
            })
        },

        showCodeImg: function () {
            var t = this;
            wx.previewImage({current: t.data.PageQRCodeInfo.Path, urls: [t.data.PageQRCodeInfo.Path]})
        }

    },
        $(function () {
            bargain.init()
        })
}));
