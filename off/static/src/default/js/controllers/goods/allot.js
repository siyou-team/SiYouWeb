$(function () {
    AllotGoods.init();
});
//产品调拨
var AllotGoods = {
    goodsData: [],     //选择的产品 调拨
    checkList: [],     //跨页选择的数据
    checkIdsList: [],  //跨页选择的ID
    init: function () {
        var obj = this;
        obj.event();
        obj.GoodsTable();
		obj.getChain();
    },
    event: function () {
        var obj = this;
        
		//产品调拨
        $('#btn-allot').on('click', function () 
		{
            obj.goodsData = [];
            $('#allot_money').text("￥0");
            $('#allot_number').text(0);
            obj.GetTable();
            $("#tbl_GoodsStock").bootstrapTable('load', obj.goodsData);
            $("#AllotRemark").val("");

            $('#AllotModal').modal({ backdrop: 'static', keyboard: false });
        });
		
        //显示 库存信息 Modal
        $('#ShowStocks').on('click', function () {
            $('#tbl_Stocks').bootstrapTable('refresh');
            $('#StockModal').modal({ backdrop: 'static', keyboard: false });
        });
		
        //关闭 库存信息 Modal
        $("#StockModal").on('hide.bs.modal', function () {
            $("#tbl_Stocks").bootstrapTable('refresh');
            obj.checkList = [];
            obj.checkIdsList = [];
        });
        
        //产品调拨 选择产品 文本框搜索
        $("#StockCode").bind('keydown', function () {
            e = arguments.callee.caller.arguments[0] || window.event
            if (e.keyCode == 13) {
                e.preventDefault();
                $("#tbl_Stocks").bootstrapTable('refresh');
                $("#StockCode").val("");
            }
        });
		
        //产品调拨 选择产品 搜索按钮
        $('#StockSearch').on('click', function () {
            $('#tbl_Stocks').bootstrapTable('refresh');
        });
		
        //选择要调拨的产品
        $('#btn_Ok').on('click', function () {
            obj.loadCartData();
        });

        //提交Form表单
        $("#AllotModal").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var postData = {};
            var data = $("#tbl_GoodsStock").bootstrapTable('getData');
            if (data.length < 1) {
                alertError(__("请选择要调拨的产品"));
                return false;
            }

            if ($('#in_chain_id').val() == null) {
                alertError(__("请先添加调入店铺"));
                return false;
            }

            if ($('#out_chain_id').val() == $('#in_chain_id').val()) {
                alertError(__("调入店铺不能与调出店铺相同"));
                return false;
            }
 
            var inventoryGoods = [];
            $.each(data, function (index, item) {
                var goodsLists = {
                    goods_id:   item.goods_id,
                    goods_code: item.goods_code,
                    goods_name: item.goods_name,
                    goods_cost: item.goods_cost,
                    goods_quantity: item.quantity,
					goods_amount: item.goods_amount,
					goods_pre_stock:item.goods_stock
                };
                inventoryGoods.push(goodsLists);
            });
 
            postData.out_chain_id = $('#out_chain_id').val();
            postData.in_chain_id = $('#in_chain_id').val();
            postData.inventory_number = $('#allot_number').text();
            postData.inventory_amount = $('#allot_money').text();
            postData.remark = $('#allot_remark').val();
            postData.inventoryGoods = inventoryGoods;
            $('#btnSub').attr('disabled', true);
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Goods_Allot&met=add&typ=json',
                type: 'post',
                dataType: "json",
                data: postData,
                success: function (data) {
                    $('#btnSub').attr('disabled', false);
                    if (data && data.status == 200) 
					{
                        alertMessage(__("调拨成功"));
                        $('#AllotModal').modal('hide');
                        $('#formModel')[0].reset();
                        $("#datatable-responsive").bootstrapTable('refresh');
                        $("#allot_remark").val("");
                    }
                    else {
                        alertError(json.msg);
                    }
                }
            });
        });
    },
    //选择要调拨的产品 Modal
    GoodsTable: function () {
        var obj = this;
        $("#tbl_GoodsStock").bootstrapTable({
            clickToSelect: false,
            uniqueId: "goods_id",                     //每一行的唯一标识，一般为主键列
            data: [],
            columns: obj.GoodsColmuns(),
			formatLoadingMessage: function(){
                return "";
            }
        });
    },
    GoodsColmuns: function () {
        var obj = this;
        var colmuns = [
           {
               field: 'goods_code', title: __('产品编号'), align: 'left', halign: 'left', width: "15%"
           },
           { field: 'goods_name', title: __('产品名称'), align: 'left', halign: 'left', width: "15%" },
           {
               field: 'quantity', title: __('数量'), align: 'left', halign: 'left', width: "15%", formatter: function (value, row, index) {
                   return '<input type="text"  value="' + value + '" onkeyup="clearNoNum(this)" changeValue="quantity" onchange="AllotGoods.validatorText(this,' + index + ',' + "0" + ',' + row.Price + ')" class="form-control"/>';
               }
           },
           {
               field: 'goods_cost', title: __('成本价'), align: 'left', halign: 'left', width: "15%",
               formatter: function (value, row, index) {
                   return "<font class='text-danger'>￥" + value + "</font>"
               }
           },
           {
               field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, row, index) {
                   var fo = '';
                   fo += '<span style="cursor:pointer"  class="remove" onclick="AllotGoods.removeRow(\'' + row.goods_id + '\',\'' + index + '\')"> <i class="fa fa-trash-o"></i> '+__('删除')+'</span>';
                   return fo;
               }
           }];
        return colmuns;
    },
    //删除选择的产品
    removeRow: function (goods_id, index) {
        var obj = this;
        var delIndex = obj.contains(obj.goodsData, "" + goods_id + "");
        if (delIndex == -1) {
            alertError(__("未找到数据,删除失败"));
            return false;
        }
        obj.goodsData.splice(delIndex, 1);
        $("#tbl_GoodsStock").bootstrapTable('load', obj.goodsData);
        obj.reload();
    },

    //绑定库存 Table
    GetTable: function () {
        var obj = this;
        $("#tbl_Stocks").bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Inventory&met=stockLists&typ=json',
            method: 'get',
            toolbar: "#toolbar",
            striped: true,
            pagination: true,
            singleSelect: false,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {
                var param = {
                    page: params.pageNumber,
                    rows: params.pageSize,
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
            clickToSelect: true,
            checkboxHeader: true,
            columns: obj.GetColumns(),
            responseHandler: function (res) 
			{
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				
                $.each(tableData.rows, function (i, row) {
                    row.checkStatus = $.inArray(row.goods_id, obj.checkIdsList) != -1;  //判断当前行的数据id是否存在与选中的数组，存在则将多选框状态变为true
                });
                return tableData;
            },
            onCheck: function (data) {  //选中               
                obj.checkIdsList.push(data.goods_id);
                obj.checkList.push(data);

            },
            onUncheck: function (data) { //取消选中
                var Index = $.inArray(data.goods_id, obj.checkIdsList);
                if (Index > -1) {
                    obj.checkIdsList.splice(Index, 1);  //删除数组中的元素                    
                }

                var Indexs = VerifyData(data.goods_id, obj.checkList);
                if (Indexs > -1) {
                    obj.checkList.splice(Indexs, 1);
                }

            },
            onCheckAll: function (data) { //全选
                $.each(data, function (index, item) {
                    var Index = $.inArray(item.goods_id, obj.checkIdsList);
                    if (Index == -1) {
                        obj.checkIdsList.push(item.goods_id);
                    }

                    var Indexs = VerifyData(item.goods_id, obj.checkList);
                    if (Indexs == -1) {
                        obj.checkList.push(item);
                    }
                });
            },
            onUncheckAll: function (data) { //取消全选
                $.each(data, function (index, item) {
                    var Index = $.inArray(item.goods_id, obj.checkIdsList);
                    if (Index > -1) {
                        obj.checkIdsList.splice(Index, 1);  //删除数组中的元素                    
                    }

                    var Indexs = VerifyData(item.goods_id, obj.checkList);
                    if (Indexs > -1) {
                        obj.checkList.splice(Indexs, 1);
                    }
                });
            }
        });
    },
    GetColumns: function () {
        var colmums = [
            { field: 'checkStatus', checkbox: true, disabled: false, width: "1%" },
            { field: 'goods_code', title: __('产品编号'), edit: false, align: 'left', halign: 'left', width: '15%' },
            { field: 'goods_name', title: __('产品名称'), edit: false, align: 'left', halign: 'left', width: '15%' },
            { field: 'goods_stock', title: __('库存数量'), edit: false, align: 'left', halign: 'left', width: '15%' },
            {
                field: 'goods_cost', title: __('产品价格'), edit: false, align: 'left', halign: 'left', width: '15%', formatter: function (value, rows, index) {
                    return '<font style="color:red">'+__('￥') + returnFloat(value) + '</font>';
                }
            }
        ];
        return colmums;
    },
    //选择产品 确定 
    loadCartData: function () {
        var obj = this;
        var rows = obj.checkList;
        if (rows.length < 1) {
            alertError(__("请选择产品"));
            return false;
        };
        if (obj.goodsData.length > 0) {
            for (var item in rows) {
                var index = obj.contains(obj.goodsData, rows[item].goods_id);
                if (index != -1) {
                    obj.goodsData[index].quantity = obj.goodsData[index].quantity - 0.00 + 1;
                }
                else {
                    rows[item].quantity = 1;
                    obj.goodsData.push(rows[item]);
                }
            }
        }
        else {
            $.each(rows, function (i, t) {
                t.quantity = 1;
                obj.goodsData.push(t);
            });
        }
        $("#tbl_GoodsStock").bootstrapTable('load', obj.goodsData);
        obj.reload();
        $("#StockModal").modal('hide');
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
    //产品数量和价格 修改
    validatorText: function (val, index, regType, d) {
        var obj = this;
        var regStr = "";
        switch (regType) {
            case 0:
                regStr = /^0\.([1-9]|\d[1-9])$|^[1-9]\d{0,8}\.\d{0,3}$|^[1-9]\d{0,8}$/;
                break;
            default:
                reg = regType;
                break;
        }
        if (regStr == regType) {
            alertError(__("参数异常"))
            return false;
        }
        else {
            if (regStr.test($(val).val())) {
                if (InventoryGoods.valitorStart > 0) {
                    InventoryGoods.valitorStart--;
                }
                $("#tbl_GoodsStock").bootstrapTable('updateCell', { index: index, field: $(val).attr('changeValue'), value: $(val).val() });
                obj.reload();
                $(val).removeAttr('style');
                $('#btnSub').attr('disabled', false);
                return true;
            }
            else {
                InventoryGoods.valitorStart++;
                $('#btnSub').attr('disabled', true);
                $(val).attr('style', 'border:1px solid red');
                return false;
            }
        }
    },
    //计算总金额和总数量
    reload: function () {
        var obj = this;
        var data = $("#tbl_GoodsStock").bootstrapTable('getData');
        obj.total = 0;
        obj.totalmoney = 0;
        for (var item in data) {
            obj.total += parseFloat(data[item].quantity);
            obj.totalmoney += accMul(data[item].goods_cost, data[item].quantity);
        }
        $('#allot_money').text(obj.totalmoney);
        $('#allot_number').text(obj.total);
    },
	getChain: function(){
		//调出、调出店铺
		var url = SYS.CONFIG.index_url + '?ctl=Goods_Inventory&met=chainLists&typ=json';
        $.get(url, function (data) {
			var data = data.data;
            for (var item in data) 
			{
                $("#out_chain_id").append("<option value=" + data[item].chain_id + ">" + data[item].chain_name + "</option>");
				
				$("#in_chain_id").append("<option value=" + data[item].chain_id + ">" + data[item].chain_name + "</option>");
            }
        },'json');
	}
}