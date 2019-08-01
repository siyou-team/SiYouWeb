;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    bargainList = {
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
                el: '#container',
                data: t.data
            });
            console.log( t.data );
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
            page: 1,
            rows: 10,
            Info: [],
            flag: !0,
            isdata: !0,
            ispage: !1,
            scposition: 0,
            cutprice_banner:'',
            cutprice_banner_url:'',
            address:[],
            user_info:{},
            success_list : [],
        },

        onLoad: function () {
            var t = this;
            t.GetVendorCutPriceEventList();
            t.GetVendorCutPricePage();
        },
        GetVendorCutPricePage: function () {
            var t = this;
            $.request({
                url    : SYS.URL.user.pageCutPriceActivity,
                data   : {},
                success: function (result)
                {
                    if ( 200 == result.status ) {
                        setData(t, {
                            cutprice_banner     : result.data.cutprice_banner,
                            cutprice_banner_url : result.data.cutprice_banner_url,
                            address             : result.data.address,
                            user_info           : result.data.user_row,
                            success_list        : result.data.cutprice_success_list,
                        });
                    } else {
                        setData(t, {
                            cutprice_banner     : '',
                            cutprice_banner_url : '',
                            address             : [],
                            user_info           : {},
                            success_list        : [],
                        });
                    }
                }
            });
        },

        GetVendorCutPriceEventList: function () {
            var t = this;
            var params = {
                // store_id: app.globalData.shopInfo.store_id,
                page: t.data.page,
                rows: t.data.rows,
                // sponsorId: app.globalData.userInfo.user_id
            };
            $.request({
                url    : SYS.URL.user.listsCutPriceActivity,
                data   : params,
                success: function (result)
                {
                    if (200 == result.status && result.data.items.length > 0) {
                        if (result.data.page >= result.data.total) {
                            setData(t, {
                                flag  : !1,
                                ispage: !1,
                                isdata: !0,
                                Info: t.data.Info.concat(result.data.items)
                            });
                        } else {
                            setData(t, {
                                flag  : !0,
                                ispage: !0,
                                isdata: !0,
                                Info: t.data.Info.concat(result.data.items)
                            });
                        }
                    } else {
                        setData(t, {flag: !1, ispage: !0})
                    }
                }
            });
        },

        scrollbottom: function () {
            var t = this;
            if (t.data.flag)
            {
                var e = this;
                e.setData({flag: !1, ispage: !0}), clearTimeout(t);
                var t = setTimeout(function () {
                        e.setData({page: e.data.page + 1}), e.GetVendorCutPriceEventList()
                    },
                    500)
            }
        }
    },
        $(function () {
            bargainList.init()
        })
}));