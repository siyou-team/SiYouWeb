;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    myPrize = {
        config       : function () {

        },
        init         : function () {
            var t = this;
            t.config(), t.runMethod();
        },
        runMethod    : function () {
            var t       = this,
                urlArgs = getUrlParams();
            t.clickEvent();
            t.onLoad(urlArgs);
            t.onShow();
            var apx = new Vue({
                el  : '#container',
                data: t.data
            });
        },
        clickEvent   : function () {
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
        data         : {
            Prize      : [],
            Category   : 0,
            tip1       : "",
            tip2       : "",
            isLuckDraw : !0,
            isGoldenEgg: !0
        },
        onLoad       : function (options) {
            if (!ifLogin()) {
                return
            }
            var t = this;
            setData(t, {Category: options.category});

            if (options.category == 1) {
                setData(t, {isGoldenEgg: !1});
                setData(t, {isLuckDraw: !0});
                setNavigationBarTitle({title: __("幸运大抽奖-我的奖品")});
                setData(t, {
                    tip1: __("抽"),
                    tip2: __("抽奖")
                });
            } else {
                setData(t, {isGoldenEgg: !0});
                setData(t, {isLuckDraw: !1})
                setNavigationBarTitle({title: __("幸运砸金蛋-我的奖品")});
                setData(t, {
                    tip1: __("砸"),
                    tip2: __("砸金蛋")
                });
            }
        },
        onShow       : function () {
            var t = this;
            (t.data.isGoldenEgg || t.data.isLuckDraw) && t.getPrizelist()
        },
        getPrizelist : function () {
            var t      = this;
            var params = {
                activity_type   : t.data.Category,
                activity_type_id: StateCode.ACTIVITY_TYPE_LOTTERY,
                // store_id: app.globalData.shopInfo.store_id
            };
            $.request({
                url    : SYS.URL.user.listsLotteryHistory,
                data   : params,
                success: function (result) {
                    if (result.status == 200) {
                        setData(t, {Prize: result.data.items})
                    } else {
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
        buttonclicked: function (ele) {
            if (isNull(ele.target.dataset.alh_is_send)) {return;}
            window.location.href = "../activity/receive_prize.html?id=" + ele.target.dataset.id + "&activity_id=" + ele.target.dataset.activity_id;
        }
    },
        $(function () {
            myPrize.init()
        })
}));
