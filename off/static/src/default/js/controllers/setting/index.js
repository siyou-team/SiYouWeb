jQuery(document).ready(function ($) {
    Setting.init();
});

var Setting = {
    init: function () 
	{
        var obj = this;
        obj.event();
    },
    event: function () {
        var obj = this;
        $("#settingForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                point_precision: {
                    validators:
                    {
                        notEmpty: {
                            message: __("消费折算积分比例不能为空")
                        },
                        regexp: {
                            regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                            message: __('请输入大于0数字并且小数点后2位')
                        }
                    }
                },
                stock_warning: {
                    validators:
                    {
                        notEmpty: {
                            message: __("库存预警数量不能为空")
                        },
                        regexp: {
                            regexp: /^[0-9]{1,8}$/,
                            message: __('请输入数字')
                        }
                    }
                },
                /* member_password: {
                    validators:
                    {
                        notEmpty: {
                            message: "会员原始密码不能为空"
                        },
                        regexp: {
                            regexp: /^[0-9]{6,20}$/,
                            message: '请输入6-20数字'
                        }
                    }
                }, */
                unit_price: {
                    validators:
                    {
                        notEmpty: {
                            message: __("限制产品单价不能为空")
                        },
                        regexp: {
                            regexp: /^\+?[1-9]\d*$/,
                            message: __('请输入数字')
                        },
                        stringLength: {
                            min: 1,
                            max: 8,
                            message: __('限制产品单价长度为1~8位')
                        }
                    }
                },
                total_price: {
                    validators:
                    {
                        notEmpty: {
                            message: __("限制单笔消费总额不能为空")
                        },
                        regexp: {
                            regexp: /^\+?[1-9]\d*$/,
                            message: __('请输入数字')
                        }, stringLength: {
                            min: 1,
                            max: 8,
                            message: __('限制产品单价长度为1~8位')
                        }
                    }
                },
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var data = $("#settingForm").serializeObject();
 
			$.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Setting_Index&met=edit&typ=json',
                data: data,
                dataType: "json",
                type: "post",
                async: true,
                success: function (data) {
                    if (data && data.status == 200) 
					{
                        parent.location.reload();
                    }
                    else {
                        alertError(data.msg);
                    }
                }
            });
        });
    }
};