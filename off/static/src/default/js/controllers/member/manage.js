var CompID = 0;
var member_id = GetQueryString('id')*1;
$(function () 
{
    addMem.init();
});

var addMem = 
{
    flag: 0,
    data: {},
	member_id:0,
    FormatDate: function (strTime) 
	{
        var date = new Date(strTime);
        return date.getFullYear() + "-" + ((date.getMonth() + 1) < 10 ? ("0" + (date.getMonth() + 1)) : (date.getMonth() + 1)) + "-" + (date.getDate() < 10 ? ("0" + date.getDate()) : (date.getDate()));
    },
    init: function () 
	{
        var obj = this; 
        obj.flag = GetQueryString("flag")*1;
		
        $("#edt_Male").attr("checked", true);
        $("#edt_CardID").focus();
		
        if (!member_id) 
		{
            //新增
            $("#nav-title").text(__("新增会员"));
            obj.member_id = 0;
            var birthdayDate = new Date();
            $("#edt_birthday").val(obj.FormatDate(birthdayDate));
        }
        else 
		{
           //新增
           $("#nav-title").text(__("修改会员信息"));
        }
        //obj.bindSelect();
        obj.event();
 
        $("#frm_AddMem").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                member_card: {
                    validators: {
                        regexp: {
                            regexp: /^[A-Za-z0-9]+$/,
                            message: __("会员卡号不正确")
                        },
                        stringLength: {
                            min: 3,
                            max: 20,
                            message: __('会员卡号长度为3~20位')
                        }
                    }
                },
                user_account: {
                    validators: {
                        notEmpty: {
                                message: __("不能为空")
                        },
                        regexp: {
                            regexp: /^[\w\s]+$/,
                            message: __("只能为字母和数字")
                        },
                        stringLength: {
                            min: 2,
                            max: 50,
                            message: __('长度为2~50位')
                        }
                    }
                },
                user_realname: {
                    validators: {
                        regexp: {
                            regexp: /^[\u4e00-\u9fa5a-zA-Z0-9]+$/,
                            message: __("会员姓名只能为数字、英文、汉字")
                        },
                        stringLength: {
                            min: 1,
                            max: 20,
                            message: __('会员姓名长度为1~20位')
                        }
                    }
                },
                /* user_mobile: {
                    validators: {
                        notEmpty: {
                            message: __("手机号码不能为空")
                        },
                        regexp: {
                            regexp: /^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,11}$|^1(3|4|5|6|7|8|9)\d{9}$|^([6|9])\d{7}$|^[6]([8|6])\d{5}$/,
                            message: __('请输入正确格式的联系电话')
                        }
                    }
                }, */
                member_grade_id: {
                    validators: {
                        notEmpty: {
                            message: __("请选择会员等级")
                        }
                    }
                },
                /* user_idcard: {
                    validators: {
                        regexp: {
                            regexp: /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/,
                            message: __("身份证号输入有误!")
                        }
                    }
                }, */
                user_email: {
                    validators: {
                        regexp: {
                            regexp: /^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/,
                            message: __("邮箱输入有误!")
                        },
                        stringLength: {/*长度提示*/
                            min: 5,
                            max: 50,
                            message: __('邮箱长度必须在5到50之间')
                        }
                    }
                }
            }
        }).on("success.form.bv", function (e) 
		{
            e.preventDefault();
            var submitData = $("#frm_AddMem").serializeObject();//Staff
 
            if (submitData.user_account == "") 
			{
                submitData.user_account = submitData.user_mobile;
            }
            if (submitData.user_realname == "") 
			{
                submitData.user_realname = __("会员") + obj.str(submitData.user_mobile);
            }

            submitData.Level = $("#edt_Level").val();
            submitData.CardMoney = $("#edt_CardMoney").val();
            var isSubmit = true;
 
            if (isSubmit) 
			{
                $("button[type='submit']").attr('disabled', 'disabled');
                submitData.Id = obj.memID;
				
				if(member_id)
				{
					var url = SYS.CONFIG.index_url + '?ctl=Member_Info&met=edit&typ=json';
					submitData.member_id = member_id;
				}else{
					var url = SYS.CONFIG.index_url + '?ctl=Member_Info&met=add&typ=json';
				}
				
                $.ajax({
					url: url,
					type: 'post',
					data: submitData,
					dataType: "json",
					success: function (data) 
					{
						if (data && data.status == 200) 
						{
							alertMessage(__("操作成功"));
							setTimeout(function () 
							{
								window.location.href = SYS.CONFIG.index_url + '?ctl=Member_Info&met=index&typ=e';
							}, 1000);
					   
						}else 
						{
                            alertError(data.msg);//失败
                            submitData = {};
                            $("button[type='submit']").removeAttr('disabled');
                        }
					}
				});
            }
        });
		
        $("#edt_Cancel").on('click', function () 
		{
            if (obj.flag == 1) 
			{
                window.location.href = SYS.CONFIG.index_url + '?ctl=Cashier_Goods&met=index&typ=e'; //产品收银  
            }else 
			{
				window.location.href = SYS.CONFIG.index_url + '?ctl=Member_Info&met=index&typ=e';   //会员管理
            }
        });
		
		$('#user_birthday').datetimepicker({
            format: "yyyy-mm-dd",
            endDate: new Date(),
            language: 'zh-CN',
            minView: 2,
            autoclose: true,          // 设置timepicker最小的限制时间   如：08:00
            todayHighlight: true,
        }).on('changeDate hide', function (event) {
            event.preventDefault();
            event.stopPropagation();
        });
    },
    event: function () 
	{
        var obj = this;   
    },
    // 截取
    str: function (str) {
        var s = str.substr(str.length - 4, str.length);
        return s;
    }
}