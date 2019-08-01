;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    myGroup = {
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
            t.onShow(urlArgs);

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
            tapindex : 1,
            page     : 1,
            rows     : 10,
            ispage   : !0,
            flag     : !0,
            gb_enable: -1,
            orderlist: []
        },

        onShow: function () {
            var t = this;
            var apx = new Vue({
                el  : '#container',
                data: t.data
            });
            setData(t, {page: 1, rows: 10, orderlist: []}), t.getOrderlist();
        },

        allOrders: function () {
            var t = this;
            setData(t, {tapindex: 1, page: 1, rows: 10, orderlist: [], gb_enable: -1}), t.getOrderlist();
        },

        toBePaid: function () {
            var t = this;
            setData(t, {tapindex: 2, page: 1, rows: 10, orderlist: [], gb_enable: 2}), t.getOrderlist();
        },

        receiptOfGoods: function () {
            var t = this;
            setData(t, {tapindex: 3, page: 1, rows: 10, orderlist: [], gb_enable: 1}), t.getOrderlist();
        },

        toBeEvaluated: function () {
            var t = this;
            setData(t, {tapindex: 4, page: 1, rows: 10, orderlist: [], gb_enable: 0}), t.getOrderlist();
        },

        scrollbottom: function () {
            var t = this;
            if (t.data.flag) {
                t.setData({flag: !1}), clearTimeout(clear)
                var clear = setTimeout(function () {
                        t.setData({
                            type: t.data.type,
                            page: parseInt(t.data.page) + 1,
                            rows: 10
                        }), t.getOrderlist()
                    },
                    500)
            }
        },

        getOrderlist: function () {
            var t = this;
            var params = {
                //UserInfoId: app.globalData.userInfo.user_id,
                rows      : t.data.rows,
                page      : t.data.page,
                gb_enable : t.data.gb_enable
            };

            $.request({
                url    : SYS.URL.user.listsUserGroupbooking,
                data   : params,
                success: function (res) {
                    if (res.status == 200) {
                        if (res.data.items.length <= 10) {
                            setData(t, {
                                flag  : !1,
                                ispage: !1
                            });
                            setData(t, {orderlist: t.data.orderlist.concat(res.data.items)})
                        } else {
                            setData(t, {orderlist: t.data.orderlist.concat(res.data.items)})
                        }
                    } else {
                        setData(t, {
                            flag  : !1,
                            ispage: !1
                        })
                    }
                }
            })
        },

        gotopay: function (obj) {
            var order_id = obj.currentTarget.dataset.on;
            toPay(order_id,'member_buy','pay');
            /*var t = this;
            var param = {
                order_id            : obj.currentTarget.dataset.on,
                openid              : app.globalData.userInfo.openId,
                store_id            : app.globalData.shopInfo.store_id,
                typ                 : 'json',
                payment_channel_code: 'wx_native',
                mp_flag         : 1
            };

            $.request({
                url    : SYS.URL.pay.pay,
                data   : param,
                success: function (res) {
                    if (res.status == 200) {
                        wx.requestPayment({
                            timeStamp: res.data.timeStamp,
                            nonceStr : res.data.nonceStr,
                            'package': res.data.package,
                            signType : res.data.signType,
                            paySign  : res.data.paySign,
                            success  : function (e) {
                                $.alert('支付成功！', function () {
                                    setData(t, {orderlist: [], currentPage: 1}), t.getOrderlist()
                                })
                            },
                            fail     : function (e) {
                                console.log('支付失败：', e)
                            }
                        })
                    }
                    else {
                        $.sDialog({
                            skin     : "green",
                            content  : res.msg,
                            okBtn    : false,
                            cancelBtn: false
                        });
                    }

                },

                fail: function (err) {
                }
            })*/

        }

    },
        $(function () {
            myGroup.init()
        })
}));
