;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    groupBook = {
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
            viewtype: 0,
            pdlist: [],
            fglist: [],
            flag: !0,
            ispage: !0,
            scposition: "",
            page: 1,
            istop: !1,
            isdata: !1,
            tapindex: 1,
            activity_state: StateCode.ACTIVITY_STATE_NORMAL
        },
        onShow: function () {
            var t =this;
            t.InitData()
        },
        InitData: function ()
        {
            var t = this;
            setData(t, {pdlist: []});
            var params = {
                //store_id        : app.globalData.shopInfo.store_id,
                activity_type_id: StateCode.ACTIVITY_TYPE_GROUPBOOKING,
                activity_state  : t.data.activity_state,
                page            : t.data.page
            };
            $.request({
                url    : SYS.URL.store.activity,
                data   : params,
                success: function (res)
                {
                    if (200 == res.status && res.data.items.length > 0) {
                        var $now = (new Date).getTime();
                        res.data.items.forEach(function (v,k) {
                            var $end = (new Date(v.activity_endtime)).getTime();
                            res.data.items[k].Time = $end - $now;
                        })
                        if (res.data.page >= res.data.total) {
                            setData(t, {
                                flag  : !1,
                                ispage: !1,
                                isdata: !0,
                                pdlist: t.data.pdlist.concat(res.data.items)
                            });
                        } else {
                            setData(t, {
                                flag  : !0,
                                ispage: !0,
                                isdata: !0,
                                pdlist: t.data.pdlist.concat(res.data.items)
                            });
                        }
                    } else {
                        setData(t, {
                            flag  : !1,
                            ispage: !1,
                            isdata: !1
                        });
                    }
                }
            });


        },
        groupLists: function () {
            var t =this;
            setData(t, {tapindex: 1, page: 1, rows: 10, orderlist: [], activity_state: StateCode.ACTIVITY_STATE_NORMAL}), t.InitData()
        },
        toBeGroupLists: function () {
            var t =this;
            setData(t, {tapindex: 2, page: 1, rows: 10, orderlist: [], activity_state: StateCode.ACTIVITY_STATE_WAITING}), t.InitPaging()
        },
        //saas,调用当前参与的团
        InitPaging: function () {
            var t = this;
            setData(t, {fglist: []});
            var params = {
                // store_id        : app.globalData.shopInfo.store_id,
                activity_type_id: StateCode.ACTIVITY_TYPE_GROUPBOOKING,
                activity_state  : t.data.activity_state,
                page            : t.data.page
            };


            $.request({
                url: SYS.URL.store.activity,
                data: params,
                success: function (res) {
                    if (200 == res.status && res.data.items.length > 0) {
                        var $now = (new Date).getTime();
                        res.data.items.forEach(function (v,k) {
                            var $end = (new Date(v.activity_endtime)).getTime();
                            res.data.items[k].Time = $end - $now;
                        })
                        if (res.data.page >= res.data.total) {
                            setData(t, {
                                flag: !1,
                                ispage: !1,
                                isdata: !0,
                                fglist: t.data.fglist.concat(res.data.items)
                            })
                        } else {
                            setData(t, {
                                flag: !0,
                                ispage: !0,
                                isdata: !0,
                                fglist: t.data.fglist.concat(res.data.items)
                            })
                        }
                    } else {
                        setData(t, {
                            flag: !1,
                            ispage: !1,
                            isdata: !1,
                        })
                    }
                }
            });
        },
        viewType: function (e) {
            var t =this;
            t.data.viewtype == 0 ? setData(t, {viewtype: 1}) : setData(t, {viewtype: 0})
        },
        scrollbottom: function (e)
        {
            var t = this;
            if (t.data.flag) {
                e.setData({flag: !1}), clearTimeout(n);
                var n = setTimeout(function ()
                    {
                        setData(t, {page: parseInt(t.data.page) + 1});
                        if (t.data.activity_state == StateCode.ACTIVITY_STATE_NORMAL) {
                            t.InitData();
                        }
                        if (t.data.activity_state == StateCode.ACTIVITY_STATE_WAITING) {
                            t.InitPaging();
                        }
                    },
                    500);
            }
        },
        returnTop: function () {
            var t =this;
            setData(t, {scposition: 0})
        }
    },
        $(function () {
            groupBook.init()
        })
}));