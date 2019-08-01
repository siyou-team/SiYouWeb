;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    marketList = {
        config: function () {

        },
        init: function () {
            var t = this;
            t.config(), t.runMethod();
        },
        data: {
            page: 1,
            ispage: !1,
            flag: !0,
            Info: [],
            windowHeight: 0
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
        onLoad: function () {
            var t = this;
            var apx = new Vue({
                el: '#body',
                data: t.data
            });
            console.info(t.data)
            this.getActivitylist()
        },
        getActivitylist: function () {
            var params = {
                page: this.data.page,
                //store_id: app.globalData.shopInfo.store_id
            }, t = this;
            $.request({
                url: SYS.URL.user.listsMarketing,
                data: params,
                success: function (result) {
                    if (200 == result.status && result.data.items.length > 0) {
                        t.data.flag = !1;
                        t.data.ispage = !0;
                        t.data.Info = t.data.Info.concat(result.data.items);
                    } else {
                        t.data.flag = !1;
                        t.data.ispage = !0;
                    }
                }
            });
        },
        scrollbottom: function () {
            var t = this;
            if (t.data.flag) {
                t.data.flag = !1;
                clearTimeout(clear);
                var clear = setTimeout(function () {
                    t.data.page = parseInt(t.data.page) + 1;
                    t.data.rows = 10;
                    t.getActivitylist();
                }, 500)
            }
        },
    },
        $(function () {
            marketList.init()
        })
}));