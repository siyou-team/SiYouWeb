var goods_id = GetQueryString('goods_id')*1;
jQuery(document).ready(function ($) 
{
    Manage.init();
});
var Manage = {
    init: function () 
	{
        var obj = this;
        
		$("#goods_code").focus();
		$('#up_image').attr('src',SYS.CONFIG.static_url+'/images/default_goods.png');
		
        obj.event();	
        obj.bindData();
		obj.getSupplier();
		imgUpload(obj);
    },
    event: function () {
        var obj = this;

        $("#btn-reset").on('click', function () {
            window.location.href = SYS.CONFIG.index_url + "?ctl=Goods_Base&met=index&typ=e";
        });
		
        $("#goodsForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                goods_code: {
                    validators:
                        {
                            notEmpty: {
                                message: __("产品编号不能为空")
                            },
                            regexp: {
                                regexp: /^[\w\s]+$/,
                                message: __("产品编号只能为字母和数字")
                            },
                            stringLength: {
                                min: 2,
                                max: 50,
                                message: __('产品编号长度为2~50位')
                            }
                        }
                },
                goods_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("产品名称不能为空")
                            }/* ,
                            stringLength: {
                                min: 1,
                                max: 20,
                                message: __('产品名称长度为1~20位')
                            } */
                        }
                },
                goods_price: {
                    validators:
                        {
                            notEmpty: {
                                message: __("零售价格不能为空")
                            },
                            regexp: {
                                regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                                message: __('请输入数字并且小数点后2位')
                            },
                            between:
                            {
                                min: 0,
                                max: sysParameter.unit_price*10000,
                                message: __('零售价格最低为0且不能超过') + sysParameter.unit_price + __('万')
                            }
                        }
                },
                goods_cost: {
                    validators:
                        {
                            regexp: {
                                regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                                message: __('请输入数字并且小数点后2位')
                            },
                            between:
                            {
                                min: 0,
                                max: sysParameter.unit_price * 10000,
                                message: __('参考进价最低为0且不能超过' )+ sysParameter.unit_price+ __('万')
                            }
                        }
                },
                goods_vip_price: {
                    validators:
                        {
                            regexp: {
                                regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                                message: __('请输入数字并且小数点后2位')
                            },
                            between:
                            {
                                min: 0,
                                max: sysParameter.unit_price * 10000,
                                message: __('产品会员价最低为0且不能超过') + sysParameter.unit_price+ __('万')
                            }
                        }
                },
                goods_stock: {
                    validators:
                        {
                            regexp: {
								min: 0,
                                regexp: /^[0-9]*[1-9][0-9]*$/,
								message: __('请输入正整数')
                            }
                        }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var isSubmit = true;
            var data = $("#goodsForm").serializeObject();
            var isSubmit = true;
            if ($("#goods_code").val() == "") {
                alertError(__("产品编号不能输入为空"));
                isSubmit = false;
                return;
            }

            //是否积分
            if ($("#is_points").prop("class") == "active") 
			{
                data.goods_is_points = 1;
            }
            else {
                data.goods_is_points = 0;
            }
            
			//是否折扣
            if ($("#is_discount").prop("class") == "active") 
			{
                data.goods_is_discount = 1;
            }
            else {
                data.goods_is_discount = 0;
            }
			
            //验证积分
            isSubmit = obj.changeFun(1);
            if (!isSubmit) {
                if (data.goods_is_points == 0) 
				{
                    return false;
                }
            }
			
            //验证折扣
            isSubmit = obj.changeFun(2);
            if (!isSubmit) {
                if (data.goods_is_discount == 0) 
				{
                    return false;
                }
            }

            if ($("#goods_cat").val() == null) 
			{
                alertError(__("请先添加产品类别"));
                isSubmit = false;
                return;
            }
			
            if (isSubmit) 
			{             
                if (($("#is_discount").prop("class") == "active") && $("#goods_vip_price").val() > 0) {                   
					alertError(__("【产品会员价】和【最低折扣】,只允许选择一种折扣方式,请重新输入!"));
                }else 
				{
					if(goods_id)
					{
						var url = SYS.CONFIG.index_url + '?ctl=Goods_Base&met=edit&typ=json';
						data.goods_id = goods_id;
					}else{
						var url = SYS.CONFIG.index_url + '?ctl=Goods_Base&met=add&typ=json';
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
								setTimeout(function () 
								{
									window.location.href = SYS.CONFIG.index_url + '?ctl=Goods_Base&met=index&typ=e';
								}, 1000);
						   
							} else {
								alertError(data.msg);
							}
						}
					});
                }
            }
        });
    },
	//是否积分 是否打折验证
    changeFun: function (o) 
	{
        var regStr = "";
        if (o == 1) {//积分
            regStr = /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/;
            if (regStr.test($("#goods_points_type").val())) {
                $("#goods_points_type,#points_type").removeAttr('style');
                $("#points_tips").hide();
                return true;
            } else {
                $("#points_type").attr("style", "color:rgb(169, 68, 66)");
                $("#points_tips").show();
                $("#goods_points_type").attr('style', 'border:1px solid red');
                return false;
            }
        } else if (o == 2) {//折扣
            regStr = /^0(\.[0-9]+)?$/;
            if (regStr.test($("#goods_min_rate").val())) {
                $("#discount_tips").hide();
                $("#goods_min_rate,#min_rate").removeAttr('style');
                return true;
            } else {
                $("#discount_tips").show();
                $("#min_rate").attr("style", "color:rgb(169, 68, 66)");
                $("#goods_min_rate").attr('style', 'border:1px solid red');
                return false;
            }

        }
    },
    blurFun: function (o) 
	{
        if ($('#goods_points_type').val() == ''&&o==1)
        {
            $('#goods_points_type').val(0);
            $('#goods_points_type,#points_type').removeAttr('style');
            $('#points_tips').hide();
        } else if ($('#goods_min_rate').val() == '' && o == 2) {
            $('#goods_min_rate').val(0);
            $("#discount_tips").hide();
            $("#goods_min_rate,#min_rate").removeAttr('style');
        }
    },
    bindData: function () 
	{
        var obj = this;
		if (goods_id) 
		{
			$("#nav-title").text(__("修改产品信息"));
			$('#supplier').hide();
			$('#stocks').hide();
			
			$.ajax({
				url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=manage&typ=json',
				type: 'post',
				data: {goods_id:goods_id},
				dataType: "json",
				success: function (data) 
				{
					if (data && data.status == 200) 
					{
						var res = data.data;
						$("#goodsForm").setForm(res);
						if(res.goods_image)
						{
							$("#up_image").attr('src',res.goods_image);
						} 
						
						var goods_cat_id = res.goods_cat_id;
						getCatTree('goods_cat',goods_cat_id);
 
						obj.isDiscount(res.goods_is_discount);
						obj.isPoints(res.goods_is_points);
					} else {
						alertError(data.msg);
					}
				}
			});
		}else{
			$("#nav-title").text(__("新增产品"));
			$('#supplier').show();
			$('#stocks').show();
			
			getCatTree('goods_cat');
			obj.isPoints(0);
			obj.isDiscount(0);
		}
    },
    //是否积分
    isPoints: function (va) 
	{		
		if (va == 1) {
            $("#no_points").removeClass("active");
            $("#is_points").addClass("active");
            $("#goods_points_type").attr("disabled", false);
            $('#span_point').toggle(true);
        } else {
            $("#goods_points_type").removeAttr('style');
            $("#points_tips").hide();
            $("#is_points").removeClass("active");
            $("#no_points").addClass("active");
            $("#goods_points_type").val(0);
            $("#goods_points_type").attr("disabled", true);
            $('#span_point').toggle(false);
            $("#points_type").removeAttr("style");
        }
    },
    //是否打折
    isDiscount: function (va) 
	{
        if (va == 1) {
            $("#no_discount").removeClass("active");
            $("#is_discount").addClass("active");
            $("#goods_min_rate").attr("disabled", false);
            $('#span_discount').toggle(true);
        } else {
            $("#is_discount").removeClass("active");
            $("#no_discount").addClass("active");
            $("#goods_min_rate").val(0);
            $("#goods_min_rate").attr("disabled", true);
            $('#span_discount').toggle(false);
            $("#goods_min_rate").removeAttr('style');
            $("#discount_tips").hide();
            $("#min_rate").removeAttr("style");
        }
    },
	//获取供应商列表
	getSupplier: function(){
		var obj = this;
        $.get(SYS.CONFIG.index_url+'?ctl=Goods_Supplier&met=lists&typ=json', function (data){
			var data = data.data;
            for (var item in data.items) {
                $("#supplier_id").append("<option value=" + data.items[item].supplier_id + ">" + data.items[item].supplier_name + "</option>");
            }
        },'json');
	}
}