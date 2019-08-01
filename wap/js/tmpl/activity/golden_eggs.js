;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    goldenEggs = {
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
            click: !1,
            clickmsk: !1,
            clickshare: !1,
            drawdesc: [],
            DrawInfo: {},
            RemainingCount: 0,
            PrizeResult: {},
            rows: [],
            Coupons: [],
            isCancelSuccess: !0,
            isCancel: !0,
            CouponAmount: 0,
            IsNewUser: 0,
            isPage: !1,
            outdated: !1,
            ImgPath: "",
            animationData: {},
            selectImg: 0,
            move: !1
        },
        onLoad: function (options) {
            var t = this;
            t.initData();
            var apx = new Vue({
                el: '#container',
                data: t.data
            });
        },
        onShow: function () {
            var t = this;
             var animation = wx.createAnimation({duration: 500, timingFunction: "ease"});
                t.animation = animation, t.animation.top(0).left(0).step();
            setData(t, {animationData: t.animation.export()})
        },
        knock: function (obj) {
            var t = this;
            if (!t.data.click) {
                setData(t, {click: !0});
                if (t.data.RemainingCount > 0) {
                    t.getPosition();
                } else if (t.data.RemainingCount == 0) {
                    setData(t, {clickshare: !0});
                    return
                }
                t.animation.top(obj.changedTouches[0].pageY - 375).left(obj.changedTouches[0].pageX - 75).step();
                setData(t, {animationData: t.animation.export()});
                setTimeout(function () {
                    t.animation.translateX(-25).rotate(-120).step();
                    setData(t, {animationData: t.animation.export()});
                }.bind(this), 500);

                setTimeout(function () {
                    t.animation.translateX(25).rotate(60).step();
                    setData(t, {animationData: t.animation.export()});
                }.bind(this), 1e3);

                setTimeout(function () {
                    setData(t, {selectImg: obj.target.dataset.num})

                }.bind(this), 1200)
            }
        },
        onShareAppMessage: function () {
            var t = this;
            return setData(t, {clickshare: !1, click: !1}), {
                title: __("我已经中奖啦，你也赶紧来砸金蛋吧~"),
                desc: __("幸运砸金蛋，快来参与吧~"),
                path: ApiUrl + "/wap/tmpl/activity/golden_eggs.html?uid=" + t.data.uid,
                success: function (t) {
                    t.sharefriend()
                }
            }
        },
        shareQRCode: function (e) {
            var t = this;
            n = {
                path: ApiUrl + "/wap/tmpl/activity/golden_eggs.html?uid=" + t.data.uid,
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
            setData(t, {PageQRCodeInfo: {Path: "", IsShare: !0, IsShareBox: !0, IsJT: !1}})
        },
        sharefriend: function () {
            var params = {Category: 2},
                t = this;
            $.xsr1($.makeUrl(activityapi.ShareLuckyDraw, params), function (e) {
                console.log("分享----》", e), e.Code == 0 && e.Info != null && (setData(t, {RemainingCount: t.data.RemainingCount}), t.initData())
            })
        },
        initData: function () {
            // 2砸金蛋，1大转盘
            var t = this;

            var params = {
                    activity_type: 2,
                    activity_type_id: StateCode.ACTIVITY_TYPE_LOTTERY,
                    store_id: 1001//app.globalData.shopInfo.store_id
                };
            // 等级规则
            $.request({
                url: SYS.URL.user.listsLottery,
                data: params,
                success: function (result) {
                    setData(t, {isPage: !0, ImgPath: SYS.STATIC_IMAGE_PATH});
                    if (result.status == 200) {
                        setData(t, {
                            DrawInfo: result.data,
                            RemainingCount: result.data.remaining_count,
                            outdated: result.data.outdated,
                            activity_id: result.data.activity_id
                        });
                        if (t.data.DrawInfo.winner_rows.items.length > 0) {
                            var n = t.data.DrawInfo.winner_rows.items.length % 5 > 0 ? parseInt(t.data.DrawInfo.winner_rows.items.length / 5 + 1) : t.data.DrawInfo.winner_rows.items.length / 5,
                                r = [];
                            for (var i = 0; i < n; i++) {
                                r.push(i);
                            }
                            setData(t, {rows: r})
                        }
                        // isNull(result.data.activity_rule.activity_intro) || WxParse.wxParse("drawdesc", "html", data.activity_rule.activity_intro, t)
                    }
                    else {
                        setData(t, {outdated: !1})
                    }

                }
            });
        },
        getPosition: function () {
            var t = this;
            var params = {activity_id: t.data.activity_id};
            // 等级规则
            $.request({
                url: SYS.URL.user.doLottery,
                data: params,
                success: function (result) {
                    if (result.status == 200) {
                        setData(t, {
                            PrizeResult: result.data
                        })
                        setTimeout(function () {
                                setData(t, {
                                    clickmsk: !0
                                });
                            },
                            2e3);
                    } else {
                        $.sDialog({
                            skin:"green",
                            content: __('抽奖失败'),
                            okBtn:false,
                            cancelBtn:false
                        });
                        setData(t, {
                            click: !1
                        });
                    }
                }
            });

        },
        cancelprize: function () {
            var t = this;
            /*t.animation.top(0).left(0).translateX(0).rotate(0).step();*/
            setData(t, {
                clickmsk : !1,
                selectImg: 0,
                move     : !0
            });
            /*setData(t, {
                animationData: t.animation.export()
            });*/
            setTimeout(function () {
                    setData(t, {move: !1})
                },
                1e3), setTimeout(function () {
                    setData(t, {click: !1})
                },
                1200), t.initData()
        },
        cancelshare: function () {
            var t = this;
            setData(t, {clickshare: !1});
            setData(t, {prize: -1, times: 0, click: !1})
        },
        nothing: function () {
        },
        doReceive: function () {
            var t = this;
            t.cancel(), t.userReceiveCoupon()
        },
        cancel: function () {
            var t = this;
            setData(t, {isCancel: !1})
        },
        cancelsuccess: function () {
            var t = this;
            setData(t, {isCancelSuccess: !0})
        },
        innertouch: function () {
        },
        userReceiveCoupon: function () {
            var t = this;
            var params = {
                activity_id: t.data.activity_id,
                activity_type: 2,
                activity_type_id: StateCode.ACTIVITY_TYPE_LOTTERY
            };
            var t = this;
            $.request({
                url: SYS.URL.user.listsLotteryHistory,
                data: params,
                success: function (result) {
                    if (result.status == 200) {
                        setData(t, {
                            isCancelSuccess: !1,
                            Coupons: result.data.items
                        });
                    } else {
                        $.sDialog({
                            skin:"green",
                            content: result.msg,
                            okBtn:false,
                            cancelBtn:false
                        });
                    }
                }
            });
        }
    },
        $(function () {
            goldenEggs.init()
        })
}));