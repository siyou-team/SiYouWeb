var combo_id = GetQueryString('combo_id')*1;
var b = [];
var a = [];
var returnUrl = SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=index&typ=e';

jQuery(document).ready(function ($) {
    addGoodsCombo.init();
});

var addGoodsCombo = 
{
    goodsData: [],
    init: function () 
	{
        var obj = this;
        $("#combo_code").focus();

        obj.bindCat();
        obj.getTable();
        obj.event();
		
		if(combo_id)
		{
			$("#nav-title").text(__("修改套餐"));
		}else{
			$("#nav-title").text(__("新增套餐"));
		}
    },
    event: function () 
	{
        var obj = this;
		
		//返回
        $("#btn-return").bind('click', function () {
            window.location.href = returnUrl;
        });
		
		//添加套餐产品
		$("#btn-goods").bind('click', function () {
            obj.showGoodsModal();
        });
		
		$("#goodsModal").on('hide.bs.modal', function () {
            $("#goodsTable").bootstrapTable('refresh');
        });
		
		//产品编号搜索
        $("#btn-query").bind('click', function () {
            $("#goodsTable").bootstrapTable('refresh');
        });

		//确定按钮
        $("#goods-confirm").bind('click', function () {
            obj.loadCartData();
        });
 
		//积分方式
        $("#combo_is_points").on("click", function () {
            if ($("#combo_is_points").prop("checked")) {
                $("#combo_points_amount").attr("disabled", false);
            } else {
                $("#combo_points_amount").val(0);
                $("#combo_points_amount").attr("disabled", true);
            }
        });
		
		//折扣方式
        $("#combo_is_discount").on("click", function () {
            if ($("#combo_is_discount").prop("checked")) {
                $("#combo_min_discount").attr("disabled", false);
            } else {
                $("#combo_min_discount").val(0);
                $("#combo_min_discount").attr("disabled", true);
            }
        });
 
		//表单验证
        $("#comboForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                combo_code: {
                    validators: {
                        notEmpty: {
                            message: __("套餐编号不能为空")
                        },
                        regexp: {
                            regexp: /^[\w\s]+$/,
                            message: __("套餐编号不正确")
                        },
                        stringLength: {
                            min: 1,
                            max: 20,
                            message: __('套餐编号长度为1~20位')
                        }
                    }
                },
                combo_name: {
                    validators: {
                        notEmpty: {
                            message: __("套餐名称不能为空")
                        },
                        stringLength: {
                            min: 1,
                            max: 20,
                            message: __('套餐名称长度为1~20位')
                        }
                    }
                },
                combo_min_discount: {
                    validators: {
                        regexp: {
                            regexp: /^0(\.[0-9]+)?$/,
                            message: __("折扣输入不正确，请输入大于0小于等于1的数字 且最多2位小数")
                        }
                    }
                },
                combo_points_amount: {
                    validators: {
                        regexp: {
                            regexp: /^(([1-9]\d*)|0)(\.\d{1,2})?$/,
                            message: __('积分方式应为非负数,且最多两位小数')
                        }
                    }
                },
                combo_price: {
                    validators: {
                        notEmpty: {
                            message: __("销售金额不能为空")
                        },
                        regexp: {
                            regexp: /^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$/,
                            message: __('请输入大于0的数字且最多两位小数')
                        },
                        between:
                        {
                            min: 0,
                            max: sysParameter.total_price * 10000,
                            message: __('请输入0~') + sysParameter.total_price + __('万的销售金额')
                        }
                    }
                },
                combo_remark: {
                    validators: {

                        stringLength: {
                            min: 1,
                            max: 50,
                            message: __('备注长度为1~50位')
                        }
                    }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var submitData = $("#comboForm").serializeObject();
            
			var data = $("#tableCombo").bootstrapTable('getData');
            if (data.length < 1 || obj.goodsData.length < 1) {
                alertError(__("请添加套餐产品"));
                $("#save").removeAttr("disabled");
                return false;
            }
			
            var isSubmit = true;
            var num = 0;
            $.each(data, function (index, item) {
                var regex = new RegExp(/^[0-9]*[1-9][0-9]*$/);
                if (regex.test(item.quantity) == false) {
                    alertError(__("数据格式不正确"));
                    $("#save").removeAttr("disabled");
                    isSubmit = false;
                    return false;
                }
                num = num + item.quantity;
                var i = obj.contains(obj.goodsData, item.Id);
                if (i != -1) {
                    obj.goodsData[i].quantity = item.quantity;
                }
            });
			
            if (num < 2) {
                alertError(__("套餐中的产品数必须大于1"));
                $("#save").removeAttr("disabled");
                return false;
            }
			
            if (isSubmit) {
                var comboDetail = obj.goodsData;
                var submitComboDetail = [];
                $.each(comboDetail, function (index, item) {
                    var comboGoods = {
                        goods_id: item.goods_id,
                        goods_code: item.goods_code,
                        goods_name: item.goods_name,
                        goods_price: item.goods_price,
						goods_cost: item.goods_cost,
                        quantity: item.quantity

                    };
                    submitComboDetail.push(comboGoods);
                });
                
                submitData.goods_number = submitComboDetail.length;  //商品种数
                submitData.combo_detail = JSON.stringify(submitComboDetail);
                if (submitData.combo_detail.length < 1) {
                    alertError(__("请添加套餐产品"));
                    $("#save").removeAttr("disabled");
                    return false;
                }
                 
                if ($("#combo_is_points").is(':checked')) 
				{
                    submitData.combo_is_points = 1;
                }
                else {
                    submitData.combo_is_points = 0;
                }
                if ($("#combo_is_discount").is(':checked')) {
                    submitData.combo_is_discount = 1;
                }
                else {
                    submitData.combo_is_discount = 0;
                }
				
				if(combo_id)
				{
					var url = SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=editCombo&typ=json';
					submitData.combo_id = combo_id;
				}else{
					var url = SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=addCombo&typ=json';
				}

                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: "json",
                    data: submitData,
                    success: function (data) 
					{
                        if (data && data.status == 200)
						{
                            alertMessage(data.msg);
                            setTimeout(function () 
							{
                                window.location.href = returnUrl;
                            }, 1000);
                        }
                        else {
                            alertError(data.msg);
                        }
                    }
                });

            }
        });
    },
    //过滤数组重复辅助方法
    check: function (arr, item) {
        var obj = this;
		
        var index = -1;
        for (var i = 0; i < arr.length; ++i) {
            if (arr[i].goods_id == item.goods_id) {
                index = i;
                break;
            }
        }
        return index;
    },
    //产品数量计算辅助方法
    contains: function (arr, obj) {
        var i = arr.length;
        var index = -1;
        while (i--) {
            if (arr[i].goods_id == obj) {
                index = i;
                return index;
            }
        }
        return index;
    },
    getTable: function () {
        var obj = this;
        $("#tableCombo").bootstrapTable({
            editable: true,
            clickToSelect: false,
            uniqueId: "goods_id",
            data: [],
            columns: obj.getColmuns(),
			formatLoadingMessage: function(){return "";}
        });
    },
    getColmuns: function () {
        var colmuns = [
			{ field: 'goods_code', title: __('产品编号'), align: 'left', halign: 'left', width: "15%", edit: false },
			{ field: 'goods_name', title: __('产品名称'), align: 'left', halign: 'left', width: "15%", edit: false },
			{ field: 'goods_price', title: __('单价'), align: 'left', halign: 'left', width: '15%', edit: false },
		    {
				field: 'quantity', title: __('数量'), align: 'left', halign: 'left', width: "20%", formatter: function (value, row, index) {
                   return '<input type="number" min="1" value="' + value + '" onchange="addGoodsCombo.validatorText(this,' + index + ')"  class="form-control bdkd" />';
               }
			},
			{
               field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", edit: false, formatter: function (value, row, index) {
                   var fo = '';
                   fo += '<span class="remove" onclick="addGoodsCombo.removeRow(\'' + row.goods_id + '\',\'' + index + '\')"> <i class="fa fa-trash-o"></i> '+__('删除')+'</span>';
                   return fo;
               }
			}];
        return colmuns;
    },
    removeRow: function (goods_id, index) {
        var obj = this;
        var delIndex = obj.contains(obj.goodsData, "" + goods_id + "");
        if (delIndex == -1) {
            alertError(__("未找到数据,删除失败"));
            return false;
        }
        obj.goodsData.splice(delIndex, 1);
        $("#tableCombo").bootstrapTable('load', obj.goodsData);
    },
    bindCat: function () {
        var obj = this;
		
		var url = SYS.CONFIG.admin_url + "?ctl=Base_ProductCategory&met=tree&typ=json";
        $.get(url, function (data) {
            var optionhtml = '';
            var ParentF = new Array();
			
            for (var item in data.data.items) {
                if (data.data.items[item].parent_id === null || data.data.items[item].parent_id === ""  || data.data.items[item].parent_id === 0) {
                    ParentF.push(data.data.items[item].id);
                }
				
            }
			
            for (var i in ParentF) {
                optionhtml += obj.selectLoops(ParentF[i], data.data.items);
            }
            $("#goods_cat").html(optionhtml);
 
			if (combo_id) 
			{
                $.get(SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=comboManage&typ=json', { combo_id: combo_id}, function (data) 
				{
					if (data && data.status == 200)
					{
						var res = data.data;
						var combo_cat_id = res.combo_cat_id;
						$("#goods_cat").find("option[value='"+combo_cat_id+"']").attr("selected",true);		
						
						$("#comboForm").setForm(res);
 
						if (res.combo_is_points == 0) 
						{
                            $("#combo_is_points").prop("checked", false);
                        }
                        else {
                            $("#combo_is_points").prop("checked", true);
                            $("#combo_points_amount").attr("disabled", false);

                        }
						
                        if (res.combo_is_discount == 0) 
						{
                            $("#combo_is_discount").prop("checked", false);
                        }
                        else {
                            $("#combo_is_discount").prop("checked", true);
                            $("#combo_min_discount").attr("disabled", false);
                        }
						
                        $("#combo_code").attr("readOnly", true);
                        obj.goodsData = res.combo_detail;
                        $("#tableCombo").bootstrapTable('load', obj.goodsData);
                    }
                    else {
                        alertError(data.msg);
                    }
                },'json');
            }
			
        },'json');
    },
    //判断产品分类是父类还是子类
    selectLoops: function (Id, list) 
	{
		
        var html = "";
        var i = 0;
        for (var item in list) {
            if (Id == list[item].id) {
                i++;
                if (i == 2) {
                    break;
                }
                html += "<optgroup label='" + list[item].name + "'>";
                continue;
            } else if (Id == list[item].parent_id) {
                html += "<option value='" + list[item].id + "'>" + list[item].name + "</option>";
                continue;
            }
        }
        html += "</optgroup>"
        return html;
    }
	,//文本框change事件
    validatorText: function (val, index) {
        var obj = this;
        if (/^[0-9]*[1-9][0-9]*$/.test($(val).val())) {
            $("#tableCombo").bootstrapTable('updateCell', { index: index, field: 'quantity', value: $(val).val() });
            //obj.reload();
            $(val).removeAttr('style');
            obj.flag = 1;
        }
        else {
            $(val).attr('style', 'border:1px solid red');
            obj.flag = 0;
        }
    },
    showGoodsModal: function () {
        var obj = this;
        $("#goodsTable").bootstrapTable('destroy');
        obj.loadGoods();
        $('#goodsModal').modal({ backdrop: 'static', keyboard: false });
    },
    loadGoods: function () {
        var obj = this;
        var $table;
        var selectionIds = [];

        $table = $("#goodsTable").bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=lists&typ=json',
            method: 'get',
            toolbar: "#Goods_toolbar",
            striped: true,
            pagination: true,
            singleSelect: false,
            clickToSelect: true,
            maintainSelected: true,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize,
                    goodsCode: $("#goodsCode").val()
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "goods_id",
            idField: "goods_id",
            editable: true,
            checkboxHeader: false,
            columns: obj.getGoodsColumns(),
			formatLoadingMessage: function(){return "";},
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				
				$.each(tableData.rows, function (i, row) {
					row.checkStatus = $.inArray(row.goods_id, selectionIds) != -1;  //判断当前行的数据id是否存在与选中的数组，存在则将多选框状态变为true  
				});
				
				return tableData;
			}
        });
        //选中事件操作数组  
        var union = function (array, ids) {
            $.each(ids, function (i, Id) {
                if ($.inArray(Id, array) == -1) {
                    array[array.length] = Id;
                    b = array;
                }
            });
            return array;
        };
        //取消选中事件操作数组
        var difference = function (array, ids) {
            $.each(ids, function (i, Id) {
                var index = $.inArray(Id, array);
                if (index != -1) {
                    array.splice(index, 1);
                    b = array;
                }
            });
            return array;
        };
        var chack = { "union": union, "difference": difference };
        $table.on('check.bs.table uncheck.bs.table ', function (e, rows) {
            var ids = $.map(!$.isArray(rows) ? [rows] : rows, function (row) {
                return row.goods_id;
            });
            func = $.inArray(e.type, ['check']) > -1 ? 'union' : 'difference';
            selectionIds = chack[func](selectionIds, ids);
        });
    },
    getGoodsColumns: function () {
        var colmums = [
            { field: 'checkStatus', checkbox: true, disabled: false, width: "1%" },
            { field: 'goods_code', title: __('产品编号'), edit: false, align: 'left', halign: 'left', width: '15%' },
            { field: 'goods_name', title: __('产品名称'), edit: false, align: 'left', halign: 'left', width: '15%' },
			{ field: 'goods_cost', title: __('成本价'), edit: false, align: 'left', halign: 'left', width: '15%', visible: false},
            {
                field: 'goods_price', title: __('单价'), edit: false, align: 'left', halign: 'left', width: '15%', formatter: function (value, rows, index) {
                    a.push(rows);
                    return '<font style="color:red">'+__('￥') + returnFloat(value) + '</font>';
                }
            }
        ];
        return colmums;
    },
    loadCartData: function () {
        var obj = this;
        var rows = a;
        var row = [];
        var arrs = []
		
        $.each(b, function (index, value) {
            $.each(rows, function (i, t) {
				
                if (t.goods_id == value) {
                    row.push(t);
                }
            });
        });
 
        for (var i = 0; i < row.length; ++i) {
            if (obj.check(arrs, row[i]) == -1) arrs.push(row[i])
        }
        row = arrs;
        if (row.length < 1) {
            alertError(__("请选择产品"));
            return false;
        };
		
        if (obj.goodsData.length > 0) {
            for (var item in row) {
                var index = obj.contains(obj.goodsData, row[item].goods_id);
                if (index != -1) {
                    obj.goodsData[index].quantity =obj.goodsData[index].quantity-0+ 1;
                }
                else {
                    row[item].quantity = 1;
                    obj.goodsData.push(row[item]);
                }
            }
        }
        else {
            $.each(row, function (i, t) {
                t.quantity = 1;
                obj.goodsData.push(t);
            });
        }
		
        $("#tableCombo").bootstrapTable('load', obj.goodsData);
        $("#goodsModal").modal('hide');
    }
}