;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    activity = {
        config: function () {

        },
        init: function () {
            var t = this;
            t.config(), t.runMethod();
        },
        runMethod: function () {
            var t = this;
            var urlParams = getUrlParams();
            t.clickEvent();
            t.onLoad(urlParams);
            t.onShow();
        },
        clickEvent: function () {
            var t = this;
            $(document).on('click', "#J_sign", function () {
               t.signinnow();
            });
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
            Info: [],
            id: 0,
            activity_id: 0,
            user_id: 0,
            isVip1: !0,
            isVip2: !0,
            isVip3: !0,
            isVip4: !0,
            isVip5: !0,
            isEventDetail: !0,
            isEventMainPic: !0,
            isAgendaPlan: !0,
            isPage: !1,
            isGray: !0,
            content: "",
            activitydetail: [],
            activityagenda: []
        },
        onLoad: function (options) {
            if (!ifLogin()) { return }
            var t = this;
            setData(t,{activity_id: options.id});
            var apx = new Vue({
                el: '#container',
                data: t.data
            });


        },
        onShareAppMessage: function () {
            return {
                title: this.data.Info.Title,
                desc: this.data.Info.EventDesc,
                path: "/pages/activity/activity.html?id=" + this.data.activity_id + "&uid=" + app.globalData.userinfo.user_id
            }
        },
        onShow: function () {
            var e = this;
            e.initData();
        },
        initData: function () {
            var  t = this;
            var params = {
                activity_id: t.data.activity_id
            };

            $.request({
                url: SYS.URL.user.getMarketing,
                data: params,
                success: function (result) {
                    if (200 == result.status) {
                        setData(t,{
                            Info: result.data,
                            isVip1: isNull(result.data.VipGuestPic1),
                            isVip2: isNull(result.data.VipGuestPic2),
                            isVip3: isNull(result.data.VipGuestPic3),
                            isVip4: isNull(result.data.VipGuestPic4),
                            isVip5: isNull(result.data.VipGuestPic5),
                            isEventDetail: isNull(result.data.activity_rule.activity_detail_intro),
                            isEventMainPic: isNull(result.data.activity_rule.activity_image),
                            isAgendaPlan: isNull(result.data.activity_rule.activity_process),
                            isPage: !0,
                            isSignIn: result.data.is_join,
                            ifJoin: result.data.if_join,
                        });
                        console.info(t.data)
                        // t.result.data.isEventDetail || WxParse.wxParse("activitydetail", "html", result.data.activity_rule.activity_detail_intro, t);
                        // t.isAgendaPlan || WxParse.wxParse("activityagenda", "html", result.data.activity_rule.activity_process, t);
                        if (result.data.if_join && !result.data.is_join) {
                            // 可以报名且未报名
                            setData(t,{
                                isGray: !1,
                                content: __("立即报名")
                            });
                        } else {
                            // 不可报名
                            if (result.data.is_join) {
                                // 由于已报名不可报名
                                setData(t,{
                                    isGray: !0, content: __("已报名")
                                });
                            } else {
                                // 活动已截止报名，导致的不可报名
                                setData(t,{
                                    isGray: !0,
                                    content: __("报名已截止")
                                });
                            }
                        }
                    } else {
                        setData(t,{isPage: !1})
                    }
                }
            });
        },
        // 参加报名
        signinnow: function () {
            var t = this;
            if (t.data.isGray) {
                return;
            }
            var e = {
                img: t.data.Info.activity_rule.activity_image,
                title: t.data.Info.activity_name,
                time: t.data.Info.activity_rule.start_join_time,
                id: t.data.Info.activity_id
            };
            window.location =  "../activity/activity_sign.html?val=" + JSON.stringify(e) + "&source=" + StateCode.MARKRTING_ACTIVITY_JOIN
        }
    },
        $(function () {
            activity.init()
        })
}));