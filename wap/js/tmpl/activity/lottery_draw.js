;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    lotteryDraw = {
        config    : function () {

        },
        init      : function () {
            var t = this;
            t.config(), t.runMethod();
        },
        runMethod : function () {
            var t       = this,
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
            index          : -1,
            count          : 13,
            timer          : 0,
            speed          : 20,
            times          : 0,
            cycle          : 50,
            prize          : -1,
            click          : !1,
            clickmsk       : !1,
            clickshare     : !1,
            drawdesc       : [],
            PrizeList      : [],
            DrawInfo       : {},
            RemainingCount : 0,
            PrizeResult    : {},
            rows           : [],
            Coupons        : [],
            isCancelSuccess: !0,
            isCancel       : !0,
            CouponAmount   : 0,
            IsNewUser      : 0,
            isPage         : !1,
            outdated       : !1
        },
        onLoad: function (options) {
            var t = this;
            t.initData();
            var apx = new Vue({
                el: '#container',
                data: t.data
            });
        },

        onShareAppMessage: function () {
            var t = this;
            return setData(t,{clickshare: !1, click: !1}), {
                title  : __("我已经中奖啦，你也赶紧来抽奖吧~"),
                desc   : __("幸运大抽奖，快来参与吧~"),
                path   : "/pages/luckydraw/luckydraw?uid=" + app.globalData.userInfo.user_id,
                success: function (res) {
                    t.sharefriend()
                }
            }
        },

        sharefriend: function () {
            var e = {Category: 1},
                t = this;
            /*$.xsr1($.makeUrl(activityapi.ShareLuckyDraw, e), function (e) {
                e.Code == 0 && e.Info != null && (setData(t,{RemainingCount: t.data.RemainingCount}), t.initData())
            })*/
        },

        initData: function () {
            // 2砸金蛋，1大转盘
            var params = {
                    activity_type   : 1,
                    activity_type_id: StateCode.ACTIVITY_TYPE_LOTTERY,
                    store_id        : 1001//app.globalData.shopInfo.store_id
                },
                t      = this;
            // 等级规则
            $.request({
                url    : SYS.URL.user.listsLottery,
                data   : params,
                success: function (result) {
                    setData(t,{isPage: !0, ImgPath: SYS.STATIC_IMAGE_PATH});
                    if (result.status == 200) {
                        setData(t,{
                            DrawInfo      : result.data,
                            RemainingCount: result.data.remaining_count,
                            outdated      : result.data.outdated,
                            PrizeList     : result.data.items,
                            activity_id   : result.data.activity_id
                        });
                        if (t.data.DrawInfo.winner_rows.items.length > 0) {
                            var n = t.data.DrawInfo.winner_rows.items.length % 5 > 0 ? parseInt(t.data.DrawInfo.winner_rows.items.length / 5 + 1) : t.data.DrawInfo.winner_rows.items.length / 5,
                                r = [];
                            for (var i = 0; i < n; i++) {
                                r.push(i);
                            }
                            setData(t,{rows: r})
                        }
                        //$.isNull(data.activity_rule.activity_intro) || WxParse.wxParse("drawdesc", "html", data.activity_rule.activity_intro, t)
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
                url    : SYS.URL.user.doLottery,
                data   : params,
                success: function (result) {
                    if (result.status == 200) {
                        setData(t,{
                            prize      : result.data.index,
                            PrizeResult: result.data
                        });
                        t.roll();
                    } else {
                        setData(t,{
                            prize: -1,
                            times: 0,
                            click: !1
                        });
                    }
                }
            });
        },

        LuckDraw: function () {
            var t = this;
            t.data.click || (setData(t,{
                speed: 100,
                click: !0
            }), t.data.RemainingCount > 0 ? t.getPosition() : setData(t,{clickshare: !0,RemainingCount : 0}))
        },

        luckRoll: function () {
            var t = this;
            var index = t.data.index, count = t.data.count;
            index += 1, index > count - 1 && (index = 0), setData(t,{index: index})
        },

        roll: function () {
            var t = this;
            setData(t,{times: t.data.times + 1}), t.luckRoll();
            if (t.data.times > t.data.cycle + 10 && t.data.prize == t.data.index) {
                clearTimeout(t.data.timer), setData(t,{prize: -1, times: 0, click: !1}), t.initData();
                setTimeout(function () {
                        setData(t,{clickmsk: !0})
                    },
                    800)
            }
            else {
                if (t.data.times < t.data.cycle) {
                    setData(t,{speed: t.data.speed - 10});
                }
                else if (t.data.times == t.data.cycle) {
                    var prize = t.data.prize + 1;
                    setData(t,{prize: prize})
                }
                else {
                    t.data.times > t.data.cycle + 10 && (t.data.prize == 0 && t.data.index == 7 || t.data.prize == t.data.index + 1) ? setData(t,{speed: t.data.speed + 110}) : setData(t,{speed: t.data.speed + 20});
                }
                t.data.speed < 40 && setData(t,{speed: t.data.speed + 40});
                t.data.timer = setTimeout(function () {
                        t.roll()
                    }, t.data.speed)
            }
            return !1
        },
        cancelprize: function () {
            var t = this;
            setData(t, {clickmsk: !1})
        },
        cancelshare: function () {
            var t = this;
            setData(t, {clickshare: !1}), setData(t, {prize: -1, times: 0, click: !1})
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
                activity_type: 1,
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
            lotteryDraw.init()
        })
}));