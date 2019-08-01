jQuery(document).ready(function ($) 
{
    Company.init();
});
var Company = {
    init: function () 
	{
        var obj = this;		
        obj.event();
    },
    event: function () 
	{
        var obj = this;

        $("#btnReset").on('click', function () {
            window.location.href = SYS.CONFIG.index_url + "?ctl=Setting_Company&met=index&typ=e";
        });
		
        $("#companyForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                company_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("企业名称不能为空")
                            },
                            stringLength: {
                                min: 2,
                                max: 50,
                                message: __('产品编号长度为2~50位')
                            }
                        }
                },
                company_area: {
                    validators:
                        {
                            notEmpty: {
                                message: __("公司所在区域不能为空")
                            }
                        }
                },
                company_address: {
                    validators:
                        {
                            notEmpty: {
                                message: __("公司所在详细地址不能为空")
                            }
                        }
                },
                company_taxnum: {
                    validators:
                    {
                        regexp: {
                            regexp: /^[\w\s]+$/,
                            message: __("纳税人识别号只能为字母和数字")
                        }
                    }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var isSubmit = true;
            var data = $("#companyForm").serializeObject();
            var isSubmit = true;
            if ($("#company_name").val() == "") {
                alertError(__("公司全称不能输入为空"));
                isSubmit = false;
                return;
            }
 
            if (isSubmit) 
			{              
				var url = SYS.CONFIG.index_url + '?ctl=Setting_Company&met=edit&typ=json';
	
                $.ajax({
					url: url,
					type: 'post',
					data: data,
					dataType: "json",
					success: function (data) 
					{
						if (data && data.status == 200) 
						{
							alertMessage(data.msg);
							setTimeout(function () 
							{
								window.location.href = SYS.CONFIG.index_url + '?ctl=Setting_Company&met=index&typ=e';
							}, 1000);
					   
						} else {
							alertError(data.msg);
						}
					}
				});
            }
        });
    }
}