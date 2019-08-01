;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    myActivity = {
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
            tapindex     : 1,
            page         : 1,
            rows         : 10,
            flag         : !0,
            ispage       : !1,
            userType     : 1,
            orderlist    : [],
            width        : 100,
            sponsorId    : 0,
            participantId: 0
        },

        onLoad: function () {
            var t        = this;
            setData(t, {
                is_sponsor   : 1,
            }), t.GetUserCutPriceActivityList();
            var apx = new Vue({
                el: '#container',
                data: t.data
            });
        },

        allOrders: function () {
            var t = this;
            setData(t, {
                tapindex     : 1,
                page         : 1,
                rows         : 10,
                orderlist    : [],
                is_sponsor    : 1,
            }), t.GetUserCutPriceActivityList()
        },

        toBePaid: function () {
            var t = this;
            setData(t, {
                tapindex     : 2,
                page         : 1,
                rows         : 10,
                orderlist    : [],
                is_sponsor    : 0,
            }), t.GetUserCutPriceActivityList()
        },

        GetUserCutPriceActivityList: function () {
            var t = this;

            var params = {
                //store_id  : app.globalData.shopInfo.store_id,
                is_sponsor: t.data.is_sponsor ? 1 : 0,
                page      : t.data.page,
                rows      : t.data.rows
            };
            $.request({
                url    : SYS.URL.user.listsUserCutPriceHistory,
                data   : params,
                success: function (res) {
                    if (200 == res.status && res.data.items.length > 0) {
                        if (res.data.page >= res.data.total) {
                            setData(t, {
                                flag     : !1,
                                ispage   : !1,
                                orderlist: t.data.orderlist.concat(res.data.items)
                            })
                        } else {
                            setData(t, {
                                ispage: !0,
                                flag: !0,
                                orderlist: t.data.orderlist.concat(res.data.items)
                            })
                        }
                    } else {
                        setData(t, {
                            flag  : !1,
                            ispage: !1
                        })
                    }
                }
            });

        },

        scrollbottom: function () {
            var t = this;
            if (this.data.flag) {
                setData(t, {flag: !1, ispage: !0}), clearTimeout(clear);
                var clear = setTimeout(function () {
                        setData(t, {page: t.data.page + 1}), t.GetUserCutPriceActivityList()
                    },
                    500)
            }
        }

    },
        $(function () {
            myActivity.init()
        })
}));
