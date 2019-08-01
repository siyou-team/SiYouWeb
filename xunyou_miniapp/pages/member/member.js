var app = getApp(),
    $ = require("../../helpers/util.js");
Page({
    data: {
        message: "",
        signMsg: "",
        UserInfo: "",
        flag: !1,
        flag1: !1,
        isSign: !0
    },
    onLoad: function () {
        var that = this;
        this.setData({UserInfo: app.globalData.userInfo});

        $.isNull(app.globalData.userInfo) ? app.getUserInfo(function (user) {
                if (user)
                {

                    that.load()
                }
        }, options.uid) : that.load()
    },
    load: function () {
        var that = this,
            params = {
                user_id: app.globalData.userInfo.user_id,
            };

        $.request({
            url: app.Config.URL.user.signState,
            data: params,
            success: function (data, status, msg, code) {
                that.setData({
                    isSign: data.state == 250 ? 1 : 0
                })
            }
        });
        app.getUserData(function (user_data) {
            app.getUserResource(function (resource) {
                resource['user_level_name'] = user_data.member_info.user_level_name
                resource['user'] = user_data

                if ($.isNull(resource.user_growth))
                {
                    resource.user_growth = 0;
                }

                that.setData({message: resource})
            });
        });


    },

    click: function () {
        var that = this, param = {user_id: app.globalData.userInfo.user_id, store_id: app.globalData.shopInfo.store_id};

        $.request({
            url: app.Config.URL.user.signIn,
            data: param,
            success: function (data, status, msg, code) {

                that.setData({
                    flag: !$.isNull(data)
                });
                that.setData({
                    signMsg: msg
                });
                if (200 == status) {
                    that.setData({
                        flag: !0
                    });
                    setTimeout(function () {
                        that.setData({
                            flag: !1
                        })
                    }, 2e3)
                } else {
                    that.setData({
                        flag1: !0
                    });
                    setTimeout(function () {
                        that.setData({
                            flag1: !1
                        })
                    }, 2e3);
                }

                that.load()
            }
        });
    }
});