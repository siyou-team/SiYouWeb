;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(["jquery"], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {
    signIn = {
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
            $(document).bind('input propertychange', "#inputname", function () {
                t.inputname($('[name="user_name"]').val());
            });
            $(document).bind('input propertychange', "#inputphone", function () {
                t.inputphone($('[name="user_phone"]').val());
            });
            $(document).bind('input propertychange', "#inputfirm", function () {
                t.inputfirm($('[name="user_company"]').val());
            });
            $(document).bind('input propertychange', "#inputjob", function () {
                t.inputjob($('[name="user_position"]').val());
            });
            $(document).on('click', "#signinnow", function (e) {
                e.preventDefault();
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
            EventMainPic: "",
            Title: "",
            EventTime: "",
            EventId: "",
            UserName: "",
            UserPhone: "",
            UserCompany: "",
            UserPosition: "",
            formId: "",
            isPhone: !0,
            isName: !0,
            isFirm: !0,
            isJob: !0,
            source: "",
            isTmplMsg: !0
        },
        onLoad: function (options) {
            if (!ifLogin()) { return }
            var t = this;
            if (options.source == StateCode.MARKRTING_ACTIVITY_JOIN) {
                var val = $.parseJSON(options.val);
                setData(t,{
                    EventMainPic: val.img,
                    Title: val.title,
                    EventTime: val.time,
                    EventId: val.id,
                    source: options.source
                });
                $('title').html(val.title + "报名页")
            } else if (options.source == StateCode.MARKRTING_ACTIVITY_JOIN_BY_QRCODE) {
                var t = this;
                setData(t,{EventId: options.eventId, source: options.source}), t.initData()
            }
            var apx = new Vue({
                el: '#container',
                data: t.data
            });

        },
        initData: function ()
        {
            var  t = this;
            var params = {activity_id: t.data.EventId};

            $.request({
                url    : SYS.URL.user.getMarketing,
                data   : params,
                success: function (result)
                {
                    if (200 == result.status) {
                        setData(t,{
                            EventMainPic: result.data.activity_rule.activity_image,
                            Title       : result.data.activity_name,
                        });
                        $('title').html(t.data.title + __("报名页"))
                        // e.Info.IsJoin != 0 && (e.Info.IsJoin == 1 ? wx.navigateTo({url: "../activitycheckin/activitycheckin?eventId=" + t.data.EventId}) : e.Info.IsJoin == 2 && wx.navigateTo({url: "../activity/activity?id=" + t.data.EventId})))
                    } else {
                        $.alert(__("出错啦"))
                    }
                }
            });
        },
        inputname: function (e) {
            var t = this;
            setData(t, {UserName: e});
            isNull(e) ? setData(t, {isName: !1}) : setData(t, {isName: !0})
        },
        inputphone: function (e) {
            var t = this;
            setData(t, {UserPhone: e});
            isNull(e) ? setData(t, {isPhone: !1}) : /^1[34578]\d{9}$/.test(e) ? setData(t, {isPhone: !0}) : setData(t, {isPhone: !1})
        },
        inputfirm: function (e) {
            var t = this;
            setData(t, {UserCompany: e});
            isNull(e) ? setData(t, {isFirm: !1}) : setData(t, {isFirm: !0})
        },
        inputjob: function (e) {
            var t = this;
            setData(t, {UserPosition: e});
            isNull(e) ? setData(t, {isJob: !1}) : setData(t, {isJob: !0})
        },
        signinnow: function () {

            var t = this;
            isNull(t.data.UserName) && setData(t,{isName: !1}), isNull(t.data.UserPhone) && setData(t,{isPhone: !1}), isNull(t.data.UserCompany) && setData(t,{isFirm: !1}), isNull(t.data.UserPosition) && setData(t,{isJob: !1});
            console.info(t.data)
            if (t.data.isName && t.data.isPhone && t.data.isJob && t.data.isFirm) {
                var params = {
                        activity_id: t.data.EventId,
                        user_name: t.data.UserName,
                        user_phone: t.data.UserPhone,
                        user_company: t.data.UserCompany,
                        user_position: t.data.UserPosition
                    };
                $.request({
                    url: SYS.URL.user.doMarketing,
                    data: params,
                    success: function (result) {
                        if (200 == result.status) {
                            if (result.data.type == StateCode.MARKRTING_ACTIVITY_JOIN) {
                                t.data.isTmplMsg && t.sendMessage();
                                $.sDialog({
                                    skin:"green",
                                    content:__('报名成功'),
                                    okBtn:false,
                                    cancelBtn:false
                                });
                                setTimeout(function () {
                                    window.location = "../activity/activitycheckin.html?eventId=" + n.data.EventId;
                                    //history.go(-1)
                                }, 1e3)
                            } else if (result.data.type == StateCode.MARKRTING_ACTIVITY_JOIN_BY_QRCODE) {
                                $.sDialog({
                                    skin:"green",
                                    content: __('签到成功'),
                                    okBtn:false,
                                    cancelBtn:false
                                });

                                setTimeout(function () {
                                    window.location = "../activity/activitycheckin.html?eventId=" + n.data.EventId;
                                }, 1e3)
                            }

                        } else {
                            $.alert(msg)
                        }
                    }
                });
            }
            return;
        },
        sendMessage: function () {
            /* todo 微信模板消息
            var e = {
                api: activityapi.EventJoinWXMessage,
                pages: "pages/activity/activity?id=" + t.data.EventId,
                formId: t.data.formId,
                WeiXinOpenId: globalData.userInfo.openId,
                value: {
                    EventId: t.data.EventId,
                    user_id: globalData.userInfo.user_id
                }
            };
            $.sendTpl(e)*/
        }
    },
        $(function () {
            signIn.init()
        })
}));
