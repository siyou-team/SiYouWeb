//site-setting-form
$(function ()
{
    if ($('#site-setting-form').length > 0)
    {
        var defaultPage = Public.getDefaultPage();


        if(defaultPage.SYSTEM.categoryInfo) {
        } else {
            defaultPage.SYSTEM.categoryInfo = {};
        }

        if(defaultPage.SYSTEM.categoryInfo && defaultPage.SYSTEM.categoryInfo['language']) {
        } else {
            defaultPage.SYSTEM.categoryInfo['language'] = language_row;
        }

        if(defaultPage.SYSTEM.categoryInfo && defaultPage.SYSTEM.categoryInfo['theme']) {
        } else {
            defaultPage.SYSTEM.categoryInfo['theme'] = theme_row;
        }

        var timeZoneCombo = Business.categoryCombo($('#date_default_timezone_set_wrap'), {
            editable: false,
            extraListHtml: '',
            //addOptions: {value: -1, text: '选择类别'},
            defaultSelected: ['id', date_default_timezone_set],//默认选中的项。如为数字或转为数字的字符串，视为索引，选中该索引项；如果为数组，第一项视为Key,第二项视为value，匹配对应项
            trigger: true,
            width: 120 * 3,
            callback: {
                onChange: function (data)
                {
                    $('#date_default_timezone_set').val(this.getValue());
                }
            }
        }, 'time_zone');

        //timeZoneCombo.selectByValue(date_default_timezone_set);


        var dateFormatCombo = Business.categoryCombo($('#date_format_wrap'), {
            editable: false,
            extraListHtml: '',
            //addOptions: {value: -1, text: '选择类别'},
            defaultSelected: ['id', date_format_combo],
            trigger: true,
            width: 120 * 3,
            callback: {
                onChange: function (data)
                {
                    //alert(this.getText());
                    $('#date_format').val(this.getValue());
                }
            }
        }, 'date_format');

        //dateFormatCombo.selectByValue(date_format_combo);

        var timeFormatCombo = Business.categoryCombo($('#time_format_wrap'), {
            editable: false,
            extraListHtml: '',
            //addOptions: {value: -1, text: '选择类别'},
            defaultSelected: ['id', time_format_combo],
            trigger: true,
            width: 120 * 3,
            callback: {
                onChange: function (data)
                {
                    //alert(this.getText());
                    $('#time_format').val(this.getValue());
                }
            }
        }, 'time_format');

        //timeFormatCombo.selectByValue(time_format_combo);



        var languageCombo = Business.categoryCombo($('#language_id_wrap'), {
            editable: false,
            extraListHtml: '',
            //addOptions: {value: -1, text: '选择类别'},
            defaultSelected:  ['id', language_id],
            trigger: true,
            width: 120 * 3,
            callback: {
                onChange: function (data)
                {
                    //alert(this.getText());
                    $('#language_id').val(this.getValue());
                }
            }
        }, 'language');

        //languageCombo.selectByValue(language_id);


        var themeCombo = Business.categoryCombo($('#theme_id_wrap'), {
            editable: false,
            extraListHtml: '',
            //addOptions: {value: -1, text: '选择类别'},
            defaultSelected: ['id', theme_id],
            trigger: true,
            width: 120 * 3,
            callback: {
                onChange: function (data)
                {
                    //alert(this.getText());
                    $('#theme_id').val(this.getValue());
                }
            }
        }, 'theme');

        //themeCombo.selectByValue(theme_id);


        $('#site-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                //'icp_number': 'required;email;'
            },
            valid: function (form)
            {
                var me = this;
                // 提交表单之前，hold住表单，防止重复提交
                me.holdSubmit();

               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#site-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }

                            // 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
                            me.holdSubmit(false);
                        });
                    },
                    function ()
                    {
                        me.holdSubmit(false);
                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});


//email  msg
$(function ()
{
    if ($('#activity-setting-form').length > 0)
    {
        $('#activity-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'activity[cutprice_banner]': 'required;',
                'activity[groupbook_banner]': 'required;',
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#activity-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {
                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });

    }
});

//防灌水
$(function ()
{
    if ($('#dump-setting-form').length > 0)
    {
        $('#dump-setting-form').on("click", "a#submit-btn", function (e)
        {
           $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                {
                    Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#dump-setting-form').serialize(), function (data)
                    {
                        if (data.status == 200)
                        {
                            parent.Public.tips({content: __('修改操作成功！')});
                        }
                        else
                        {
                            parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                        }
                    });
                },
                function ()
                {
                });
        });
    }
});

//upload
$(function ()
{
    if ($('#upload-setting-form').length > 0)
    {
        $('#upload-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'upload[image_max_filesize]': 'required;integer[+];range[0~' + max_upload_file_size + ']',
                'upload[image_allow_ext]': 'required;'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#upload-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {
                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }
});

//shop api


$(function ()
{
    if ($('#shop_api-setting-form').length > 0)
    {

        $('#shop_api-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'shop_api[shop_app_url]': 'required;',
                'shop_api[shop_app_key]': 'required;'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=editShopApi&typ=json', $('#shop_api-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {
                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });


        $('#ucenter-shop_api-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'passport_api[passport_app_url]': 'required;',
                'passport_api[passport_app_key]': 'required;'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=editPassportApi&typ=json', $('#ucenter-shop_api-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {
                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }
});

//email  msg
$(function ()
{
    if ($('#email_msg-setting-form').length > 0)
    {
        $('#email_msg-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'email[email_host]': 'required;',
                'email[email_addr]': 'required;',
                'email[email_pass]': 'required;'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#email_msg-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {
                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });


        $('#send_test_email').click(function ()
        {
            $.ajax({
                type: 'POST',
                url: SYS.CONFIG.index_url + '?ctl=Config&met=testEmail&typ=json',
                data: $('#email_msg-setting-form').serialize(),
                error: function ()
                {
                    alert(__('测试邮件发送失败，请重新配置邮件服务器'));
                },
                success: function (html)
                {
                    alert(html.msg);
                },
                dataType: 'json'
            });
        });

    }
});

//消息模板

//促销设置
$(function ()
{
    if ($('#promotion-setting-form').length > 0)
    {
        $('#promotion-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            /* fields: {
                'voucher[promotion_voucher_price]': 'required;integer[+];',
                'voucher[promotion_voucher_storetimes_limit]': 'required;integer[+];',
                'voucher[promotion_voucher_buyertimes_limit]': 'required;integer[+];range[1~20]'
            }, */
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#promotion-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});


//优惠券设置
$(function ()
{
    if ($('#voucher-setting-form').length > 0)
    {
        $('#voucher-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'voucher[promotion_voucher_price]': 'required;integer[+];',
                'voucher[promotion_voucher_storetimes_limit]': 'required;integer[+];',
                'voucher[promotion_voucher_buyertimes_limit]': 'required;integer[+];range[1~20]'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#voucher-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});


//满送设置
$(function ()
{
    if ($('#mansong-form').length > 0)
    {
        $('#mansong-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'mansong[promotion_mansong_price]': 'required;integer[+0];'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#mansong-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//满送设置


//限时活动
$(function ()
{
    if ($('#discount-form').length > 0)
    {
        $('#discount-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'discount[promotion_discount_price]': 'required;integer[+0];'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#discount-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//限时活动


//加价购
$(function ()
{
    if ($('#increase-form').length > 0)
    {
        $('#increase-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'increase[promotion_increase_price]': 'required;integer[+0];'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#increase-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});

//团购
$(function ()
{
    if ($('#groupbuy-setting-form').length > 0)
    {
        $('#groupbuy-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'groupbuy[groupbuy_price]': 'required;integer[+0];',
                'groupbuy[groupbuy_review_day]': 'required;integer[+0];'
            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#groupbuy-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});

//二级域名
$(function ()
{
    if ($('#shop_domain_form').length > 0)
    {
        $('#shop_domain_form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
                'domain[domain_modify_frequency]': 'required;integer[+];',

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#shop_domain_form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});

//商城设置
$(function ()
{
    if ($('#setting-setting-form').length > 0)
    {

        $('#setting-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
               'setting[setting_email]': 'email;'

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {

                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#setting-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//商城防灌水
$(function ()
{
    if ($('#dumps-setting-form').length > 0)
    {
	//console.log($('#dumps-setting-form').serialize());
        $('#dumps-setting-form').on("click", "a#submit-btn", function (e)
        {
           $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                {
                    Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#dumps-setting-form').serialize(), function (data)
                    {
                        if (data.status == 200)
                        {
                            parent.Public.tips({content: __('修改操作成功！')});
                        }
                        else
                        {
                            parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                        }
                    });
                },
                function ()
                {
                });
        });
    }
});

//运营设置
$(function ()
{
    if ($('#operation-setting-form').length > 0)
    {
        $('#operation-setting-form').on("click", "a#submit-btn", function (e)
        {
           $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                {
                    Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#operation-setting-form').serialize(), function (data)
                    {
                        if (data.status == 200)
                        {
                            parent.Public.tips({content: __('修改操作成功！')});
                        }
                        else
                        {
                            parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                        }
                    });
                },
                function ()
                {
                });
        });
    }
});
//seo设置 首页
$(function ()
{
    if ($('#seo-setting-form').length > 0)
    {
        $('#seo-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#seo-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});

//seo设置 团购
$(function ()
{
    if ($('#tg-setting-form').length > 0)
    {
        $('#tg-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#tg-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//seo设置 品牌
$(function ()
{
    if ($('#brand-setting-form').length > 0)
    {
        $('#brand-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#brand-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//seo设置 积分
$(function ()
{
    if ($('#point-setting-form').length > 0)
    {
        $('#point-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#point-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//seo设置 文章
$(function ()
{
    if ($('#article-setting-form').length > 0)
    {
        $('#article-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#article-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//seo设置 店铺
$(function ()
{
    if ($('#store-setting-form').length > 0)
    {
		console.log($('#store-setting-form').serialize());
        $('#store-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#store-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//seo设置 商品
$(function ()
{
    if ($('#product-setting-form').length > 0)
    {
        $('#product-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#product-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//seo设置 商品分类
$(function ()
{
    if ($('#category-setting-form').length > 0)
    {
        $('#category-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#category-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//seo设置 sns
$(function ()
{
    if ($('#sns-setting-form').length > 0)
    {
        $('#sns-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#sns-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});

//会员积分设置
$(function ()
{
    if ($('#points-setting-form').length > 0)
    {
        $('#points-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
               'points[points_reg]': 'integer[+0];',
               'points[points_login]': 'integer[+0];',
               'points[points_evaluate]': 'integer[+0];',
               'points[points_recharge]': 'integer[+0];',
               'points[points_order]': 'integer[+0];'

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#points-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//会员经验值设置
$(function ()
{
    if ($('#grade-setting-form').length > 0)
    {
        $('#grade-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {
               'grade[grade_login]': 'integer[+0];',
               'grade[grade_evaluate]': 'integer[+0];',
               'grade[grade_recharge]': 'integer[+0];',
               'grade[grade_order]': 'integer[+0];'

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#grade-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//图片管理-上传参数
$(function ()
{
    if ($('#parameters-setting-form').length > 0)
    {
        $('#parameters-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#parameters-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//图片管理-默认图片
$(function ()
{
    if ($('#acquiesce-setting-form').length > 0)
    {
        $('#acquiesce-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#acquiesce-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});
//搜索管理-默认搜索词
$(function ()
{
    if ($('#search-setting-form').length > 0)
    {
        $('#search-setting-form').validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (form)
            {
               $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#search-setting-form').serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {

                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }

});


//
$(function ()
{
    if ($('#shop-sphinx-form').length > 0)
    {
        $('#shop-sphinx-form').on("click", "a#submit-btn", function (e)
        {
           $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                {
                    Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#shop-sphinx-form').serialize(), function (data)
                    {
                        if (data.status == 200)
                        {
                            parent.Public.tips({content: __('修改操作成功！')});
                        }
                        else
                        {
                            parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                        }
                    });
                },
                function ()
                {
                });
        });
    }
});


//热门搜索
/*
$(function ()
{
    if ($('#hot-search-setting-form').length > 0)
    {
        $('#hot-search-setting-form').on("click", "a#submit-btn", function (e)
        {
            $.dialog.confirm('修改立马生效,是否继续？', function ()
                {
                    Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $('#hot-search-setting-form').serialize(), function (data)
                    {
                        if (data.status == 200)
                        {
                            parent.Public.tips({content: '修改操作成功！'});
                        }
                        else
                        {
                            parent.Public.tips({type: 1, content: data.msg || '操作无法成功，请稍后重试！'});
                        }
                    });
                },
                function ()
                {
                });
        });
    }
});
*/

$(function ()
{
    var form_row = [];


    form_row = form_row.concat(
        ['#suggest-search-setting-form', '#hot-search-setting-form'],   //搜索设置
        ['#site-seo-setting-form', '#product-seo-setting-form', '#category-seo-setting-form', '#store-seo-setting-form', '#point-seo-setting-form', '#brand-seo-setting-form', '#article-seo-setting-form', '#gb-seo-setting-form', '#sns-seo-setting-form'],     //seo
        ['#email-setting-form', '#sms-setting-form'],
        ['.setting-form']
    );

    $.each($.unique(form_row), function(index, data){
        var $form_row = $(data);
        if ($form_row.length > 0)
        {
            $form_row.each(function(i){
                var $form = $(this);

                console.info($form)
                $form.validator({
                    ignore: ':hidden',
                    theme: 'yellow_bottom',
                    timely: 1,
                    stopOnError: true,
                    fields: {

                    },
                    valid: function (e)
                    {
                        $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                            {

                                console.info($form)
                                console.info($form.serialize())
                                Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=save&typ=json', $form.serializeAll(), function (data)
                                {
                                    if (data.status == 200)
                                    {
                                        parent.Public.tips({content: __('修改操作成功！')});
                                    }
                                    else
                                    {
                                        parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                                    }
                                });
                            },
                            function ()
                            {
                            });
                    },
                }).on("click", "a#submit-btn", function (e)
                {
                    $(e.delegateTarget).trigger("validate");
                });
            });

        }
    });

    var $form = $('#site-passport-setting-form');
    if ($form.length > 0)
    {

        $form.validator({
            ignore: ':hidden',
            theme: 'yellow_bottom',
            timely: 1,
            stopOnError: true,
            fields: {

            },
            valid: function (e)
            {
                $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?mdu=plantform&ctl=Config&met=editPassportApi&typ=json', $form.serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: __('修改操作成功！')});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                            }
                        });
                    },
                    function ()
                    {
                    });
            },
        }).on("click", "a#submit-btn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }
    /*
    $.each($.unique(form_row), function(index, data){
        $form = $(data);
        if ($form.length > 0)
        {
            $form.on("click", "a#submit-btn", function (e)
            {
                $.dialog.confirm('修改立马生效,是否继续？', function ()
                    {
                        Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', $(e.delegateTarget).serialize(), function (data)
                        {
                            if (data.status == 200)
                            {
                                parent.Public.tips({content: '修改操作成功！'});
                            }
                            else
                            {
                                parent.Public.tips({type: 1, content: data.msg || '操作无法成功，请稍后重试！'});
                            }
                        });
                    },
                    function ()
                    {
                    });
            });
        }
    });
    */


    $('#send_test_email').click(function ()
    {
        $.ajax({
            type: 'POST',
            url: SYS.CONFIG.index_url + '?ctl=Config&met=testEmail&typ=json',
            data: $('#email-setting-form').serialize(),
            error: function ()
            {
                alert(__('测试邮件发送失败，请重新配置邮件服务器'));
            },
            success: function (html)
            {
                alert(html.msg);
            },
            dataType: 'json'
        });
    });
});


//搜索默认次
$(function ()
{
    var curRow, curCol;
    var itemHandle = {
        del: function (t)
        {
            $.dialog.confirm(__("请确认是否删除？"), function ()
            {
                parent.parent.Public.tips({content: __("属性删除成功！")});
                $("#grid").jqGrid("delRowData", t)
            })
        },

        //操作项格式化，适用于有“修改、删除”操作的表格
        operFormatter: function (val, opt, row)
        {
            var html_con = '<div class="operating" data-id="' + opt.rowId + '"><span class="ui-icon ui-icon-plus" title="'+__("新增行")+'">&#xe605;</span><span class="ui-icon ui-icon-trash" title="'+__('删除行')+'"></span></div>';
            return html_con;
        }
    };


    function initDefaultSearchWordsGrid()
    {
        var grid_row = Public.setGrid();
        var colModel = [{
            "name": "operate",
            "label": __("操作"),
            "width": 80,
            "sortable": false,
            "search": false,
            "resizable": false,
            "fixed": true,
            "align": "center",
            "title": false,
            "formatter": itemHandle.operFormatter
        }, {
            "name": "default_search_words",
            "index": "default_search_words",
            "label": __("搜索词"),
            "classes": "ui-ellipsis",
            "align": "center",
            "title": false,
            "width": 40, editable: !0
        }, {
            "name": "default_search_label",
            "index": "default_search_label",
            "label": __("搜索显示词"),
            "classes": "ui-ellipsis",
            "align": "center",
            "title": false,
            "width": 60, editable: !0
        }];

        $('#grid').jqGrid({
            data: suggest_search_data,
            datatype: 'local',
            autowidth: true,
            shrinkToFit: true,
            forceFit: true,
            cellEdit: true,
            cellsubmit : 'clientArray',
            cellurl : SYS.CONFIG.index_url + '?ctl=Base_ProductAssistDefaultSearchWords&met=edit&typ=json',
            width: grid_row.w,
            height: 200,
            altRows: true,
            gridview: true,
            onselectrow: false,
            multiselect: false, //多选
            colModel: colModel,
            cmTemplate: {
                sortable: true
            },
            sortname: "default_search_words", //指定默认排序的列
            sortorder: "asc", //指定默认排序方式
            //pager: '#grid-pager',
            viewrecords: false,
            rowNum: 100,
            rowList: [100, 200, 500],
            prmNames: { //向后台传递的参数,重新命名
                //page:"page.currentPage",
                //rows:"page.pageSize"
            },
            //scroll: 1,
            jsonReader: {
                root: "data.items",
                records: "data.records",
                total: "data.total",
                repeatitems: false,
                id: "default_search_words_id"
            },
            beforeEditCell:function(rowid,cellname,v,iRow,iCol){
                curRow = iRow;
                curCol = iCol;

            },
            resizeStop: function (newwidth, index)
            {
            }
        });

    }

    if ($(".grid-wrap").length > 0)
    {
        initDefaultSearchWordsGrid();
    }

    _self = {
        newId: -1
    };

    //新增分录
    $("#grid").on('click', '.ui-icon-plus', function (e)
    {
        var rowId = $(this).parent().data('id');
        var newId = $('#grid tbody tr').length;
        var datarow = {id: _self.newId};
        //$("#grid").jqGrid('resetSelection');
        //$("#grid").jqGrid("restoreCell",curRow,curCol);
        $('#grid').jqGrid('saveCell', curRow, curCol);

        var su = $("#grid").jqGrid('addRowData', _self.newId, datarow, 'before', rowId);
        if (su)
        {
            $(this).parents('td').removeAttr('class');
            $(this).parents('tr').removeClass('selected-row ui-state-hover');
            $("#grid").jqGrid('resetSelection');
            _self.newId--;
        }
    });

    $('#grid').on("click", ".operating .ui-icon-trash", function (t)
    {
        t.preventDefault();

        var e = $(this).parent().data("id");

        itemHandle.del(e)
    });


    if ($('#default-search-setting-form').length > 0)
    {
        $('#default-search-setting-form').on("click", "a#submit-btn", function (e)
        {
            $.dialog.confirm(__('修改立马生效,是否继续？'), function ()
                {

                    $('#grid').jqGrid('saveCell', curRow, curCol);

                    var por = $('#grid').jqGrid('getRowData');
                    var default_search_rows = {};

                    $.each(por,function(name, value){
                        var array = {};
                        array['default_search_label'] = value.default_search_label;
                        array['default_search_words'] = value.default_search_words;
                        //array['default_search_words_id']  = $(value.operate).data('id');
                        default_search_rows[name] = array;
                    });

                    var params = {
                        "config_type[]": 'search',
                        "search[suggest_search_words]": default_search_rows,
                    };

                    Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=edit&typ=json', params, function (data)
                    {
                        if (data.status == 200)
                        {
                            parent.Public.tips({content: __('修改操作成功！')});
                        }
                        else
                        {
                            parent.Public.tips({type: 1, content: data.msg || __('操作无法成功，请稍后重试！')});
                        }
                    });
                },
                function ()
                {
                });
        });
    }
});
