;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    receivePrize = {

        config: function () {

        },

        init: function () {
            var t = this;
            t.config(), t.runMethod();
        },

        runMethod: function () {
            var t       = this,
                urlArgs = getUrlParams();
            t.clickEvent();
            t.onLoad(urlArgs);
            var apx = new Vue({
                el  : '#container',
                data: t.data
            });
        },

        clickEvent: function () {
            var t = this;
            $(document).on('click', '[bindtap]', function (ele) {
                var callback = ele.target.attributes.bindtap.value;
                t[callback](ele);
            });
            $(document).bind('input propertychange', '[bindinput]', function (ele) {
                console.info(ele)
                var callback = ele.target.attributes.bindinput.value;
                t[callback](ele);
            });
        },
        data      : {
            UserName         : "",
            UserPhone        : "",
            UserAddress      : "",
            isPhone          : !0,
            isName           : !0,
            isAddress        : !0,
            LuckyDrawId      : "",
            LuckyDrawPrizeId : "",
            LuckyDrawUniqueId: ""
        },

        onLoad: function (options) {
            var t = this;
            setData(t, {
                LuckyDrawId      : options.activity_id,
                LuckyDrawPrizeId : options.id,
                LuckyDrawUniqueId: options.alh_item_id
            }), t.RecipientInfo()
        },

        RecipientInfo: function () {
            var t      = this;
            var params = {
                activity_id: t.data.LuckyDrawId,
                alh_id     : t.data.LuckyDrawPrizeId,
                alh_item_id: t.data.LuckyDrawUniqueId
            };
            $.request({
                url    : SYS.URL.user.getLotteryHistory,
                data   : params,
                success: function (result) {
                    if (result.status == 200) {
                        setData(t, {
                            UserName   : result.data.user_name,
                            UserPhone  : result.data.user_phone,
                            UserAddress: result.data.user_address
                        })
                    } else {
                        $.alert(result.msg);
                    }
                }
            });
        },

        inputname: function (e) {
            var t = this;
            setData(t, {UserName: e.target.value}), isNull(e.target.value) ? setData(t, {isName: !1}) : setData(t, {isName: !0})
        },

        inputphone: function (e) {
            var t = this;
            if (e.target.value.length > 11) {
                setData(t, {UserPhone: e.target.value.slice(0, 11)});
                return
            }
            setData(t, {UserPhone: e.target.value}), isNull(e.target.value) ? setData(t, {isPhone: !1}) : /^1[34578]\d{9}$/.test(e.target.value) ? setData(t, {isPhone: !0}) : setData(t, {isPhone: !1})
        },

        inputaddress: function (e) {
            var t = this;
            setData(t, {UserAddress: e.target.value}), isNull(e.target.value) ? setData(t, {isAddress: !1}) : setData(t, {isAddress: !0})
        },

        submit: function (e) {
            e.preventDefault();
            var t = this;
            console.info(t.data)
            isNull(t.data.UserName) && setData(t, {isName: !1}), isNull(t.data.UserPhone) && setData(t, {isPhone: !1}), isNull(t.data.UserAddress) && setData(t, {isAddress: !1});
            if (t.data.isName && t.data.isPhone && t.data.isAddress) {
                var params = {
                    user_name   : t.data.UserName,
                    user_phone  : t.data.UserPhone,
                    user_address: t.data.UserAddress,
                    activity_id : t.data.LuckyDrawId,
                    alh_id      : t.data.LuckyDrawPrizeId,
                    alh_item_id : t.data.LuckyDrawUniqueId
                };
                $.request({
                    url    : SYS.URL.user.updateLotteryAddress,
                    data   : params,
                    success: function (result) {
                        if (result.status == 200) {
                            setTimeout(function () {
                                    t.goback()
                                },
                                1e3)
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

            }
        },

        goback: function () {
            $.sDialog({
                skin     : "green",
                content  : __('提交信息成功'),
                okBtn    : false,
                cancelBtn: false
            });
            history.go(-1);
        }
    },
        $(function () {
            receivePrize.init()
        })
}));
