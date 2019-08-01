jQuery(document).ready(function ($) {
    GiftAdd.init();
});
var points_gift_id = GetQueryString('points_gift_id')*1;
var GiftAdd = {
    init: function () {
        var obj = this;
        $("#points_gift_code").focus();
        obj.event();
 
        $("#points_gift_code").on("keyup change", function () {
            if ($(this).val().trim() != "") {
                $("button[type='submit']").removeAttr('disabled');
            }
        });
		
		obj.bindData();
    },
    event: function () {
        var obj = this;
        $("#points_gift_name").on('keyup', function () {
            var str = document.getElementById("points_gift_name").value.trim();
        });

        $("#btn-reset").on('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=gift&typ=e';
        });
		
        $("#giftForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                points_gift_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("礼品名称不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 20,
                                message: __('礼品名称长度为1~20位')
                            }
                        }
                },
                points_gift_price: {
                    validators:
                        {
                            notEmpty: {
                                message: __("礼品价值不能为空")
                            },
                            regexp: {
                                regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                                message: __('请输入数字并且小数点后2位')
                            },
                            between: {
                                min: 0,
                                max: sysParameter.unit_price * 10000,
                                message: __('礼品价值最低为0且不能超过') + sysParameter.unit_price + __('万')
                            }
                        }
                },
                points_gift_points: {
                    validators: {
                        notEmpty: {
                            message: __("兑换所需积分不能为空")
                        },
                        regexp: {
                            regexp: /^[0-9]*[1-9][0-9]*$/,
                            message: __('请输入正整数')
                        }
                    }
                },
                points_gift_stock: {
                    validators: {
                        notEmpty: {
                            message: __("礼品库存不能为空")
                        },
                        regexp: {
                            regexp: /^[0-9]*[1-9][0-9]*$/,
                            message: __('请输入正整数')
                        }
                    }
                }
            }
        }).on("success.form.bv", function (e) {
            en = e;
            e.preventDefault();

            var data = $("#giftForm").serializeObject();
            var isSubmit = true;
            var pointsGiftNumber = $("#points_gift_code").val().trim();
            if (pointsGiftNumber == "") {
                alertError(__("请输入礼品编号"));
                $("#points_gift_code").focus();
                return false;
            }
            var reg = /[0-9A-Za-z]/;
            if (pointsGiftNumber.search(reg) == -1) {
                alertError(__("礼品编号只能为数字和字母,且1到18位"));
                return false;
            }
            if (pointsGiftNumber.length < 1 || pointsGiftNumber.length > 19) {
                alertError(__("礼品编号只能1到18位"));
                return false;
            }
 
            if (isSubmit) 
			{
                if(points_gift_id)
                {
                    var url = SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=edit&typ=json';
                    data.points_gift_id = points_gift_id;
                }else{
                    var url = SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=add&typ=json';
                }

				$.ajax({
					url: url,
					type: 'post',
					data: data,
					dataType: "json",
					success: function (data) 
					{
						if (data && data.status == 200) 
						{
							alertMessage(__("操作成功"));
							setTimeout(function () {
								window.location.href = SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=gift&typ=e';
							}, 1000);				   
						} else {
							alertError(data.msg);
						}
					}
				});
            }
        });
    },
	bindData: function()
	{
		if (points_gift_id) 
		{
			$.ajax({
				url: SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=manage&typ=json',
				type: 'post',
				data: {points_gift_id:points_gift_id},
				dataType: "json",
				success: function (data) 
				{
					if (data && data.status == 200) 
					{
						var res = data.data;
						$("#giftForm").setForm(res);
					} else {
						alertError(data.msg);
					}
				}
			});
		}
	}
}