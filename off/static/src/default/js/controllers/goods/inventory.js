$(function () {
    $('[data-toggle="popover"]').popover();
    InventoryGoods.init();
});

//验证数据是否存在
function VerifyData(goods_id, List) 
{
    var obj = this;
    var Index = -1;
    $.each(List, function (index, item) {
        if (item.goods_id == goods_id) {
            Index = index;
        }
    });
    return Index;
}
 
//产品入库
var InventoryGoods = {
    total: 0,            //总数量
    inventory_amount: 0, //总价格
    valitorStart: 0,     //记录当前修改行的 值
    goodsList: [],       //选择的产品 入库
    GoodsSelectData: [], //跨页选择的数据
    GoodsSelectselectionIds: [],//跨页选择的ID
    init: function () {
        var obj = this;
        obj.event();
		obj.inventoryTable();
		obj.getSupplier();
        obj.getStockTable();
    },
    event: function () {
        var obj = this;

        //产品入库
        $('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10 modal-trigger' id='btn-add' type='button'>"+__('产品入库')+" <i class='fa fa-plus'></i></button>&nbsp;&nbsp;");
        
        //产品调拨
        //$('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-allot' type='button'>"+__('产品调拨')+"</button>&nbsp;&nbsp;");

        //库存盘点
        $('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-check' type='button'>"+__('库存盘点')+"</button>&nbsp;&nbsp;");

        $('#form-btn').append("<button class='btn btn-default waves-effect m-b-15 m-r-10' id='btn-refresh' type='button'>"+__('刷新')+"</button>&nbsp;&nbsp;");
        
		//$('#form-btn').append("<button class='btn btn-default waves-effect m-b-15' data-toggle='collapse' href='#ScreenDiv' type='button'>"+__('筛选产品')+"</button>");
		
		//产品入库事件
        $('#btn-add').on('click', function () {
            obj.inventory();
        });
		
		//选择商品加载商品列表
		$('#check-goods').on('click',function() {
			obj.goodsListModal();	
		})
		
		//选择产品 确定
        $("#confirm-goods").on('click', function () {
            obj.loadCartData();
        });
		
		//产品信息列表关闭 Modal
        $("#GoodsModal").on('hide.bs.modal', function () {
            //关闭
            $("#tbl_Goods").bootstrapTable('refresh');
            $("#GoodsForm")[0].reset();
            obj.GoodsSelectData = [];
            obj.GoodsSelectselectionIds = [];
        });
		
		$("#inventoryModal").on('hide.bs.modal', function () {
            $("#GoodsFormModel")[0].reset();
            $('#inventoryModal').data('bootstrapValidator').resetForm(true);//验证重置
        });
		
		//产品入库 文本框搜索
        $("#goodsCode").bind('keydown', function () {
            e = arguments.callee.caller.arguments[0] || window.event
            if (e.keyCode == 13) {
                e.preventDefault();
                $("#tbl_Goods").bootstrapTable('refresh');
                $("#goodsCode").val("");
            }
        });
		
		//产品入库 搜索按钮
        $('#btn-gquery').on('click', function () {
            $("#tbl_Goods").bootstrapTable('refresh');
        });
		
		//产品入库 搜索按钮
        $('#btn-query').on('click', function () {
			obj.refresh();
        });
		
		//提交入库 Form表单
        $("#inventoryModal").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                supplier: {
                    validators: {
                        notEmpty: {
                            message: __('请选择供应商')
                        }
                    }
                },
                inventory_remark: {
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
            
            var postData = {};
            var data = $("#tbl_GoodsCombo").bootstrapTable('getData');
            if (obj.goodsList.length < 1) {
                alertError(__('请添加入库产品'));
                return false;
            }
            if (obj.inventory_amount.toFixed(2) > sysParameter.total_price * 10000) {
                alertError(__('单笔消费限额不能超过') + sysParameter.total_price * 10000 + __('万'));
                return false;
            }
            var goodsList = obj.goodsList;
            var inventoryGoods = [];
            $.each(goodsList, function (index, item) {
                var goodsInfo = {
                    goods_id:   item.goods_id,
                    goods_code: item.goods_code,
                    goods_name: item.goods_name,
                    goods_cost: item.goods_cost,
                    goods_quantity: item.quantity,
					goods_amount: item.goods_amount,
					goods_pre_stock:item.goods_stock
                };
                inventoryGoods.push(goodsInfo);
            });
			/* console.log(goodsList);return false; */
            postData.supplier = $('#supplier').val();
            postData.inventory_amount = obj.inventory_amount;
            postData.inventory_number = $('#inventory_number').text();
            postData.remark = $('#inventory_remark').val();
            postData.inventoryGoods = inventoryGoods;
 
            $("#btn-save").attr("disabled", true); 
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Goods_Inventory&met=add&typ=json',
                type: 'post',
                dataType: "json",
                data: postData,
                success: function (data) {
                    $("#btn-save").attr("disabled", false); 
                    if (data.status && data.status == 200) 
					{
                        alertMessage(__('入库成功'));
                        obj.refresh();
                    }
                    else {
                        alertError(data.msg);
                    }
                }
            });
        });
    },
	inventory: function(){
		var obj = this;
        obj.goodsList = [];
        $("#tbl_GoodsList").bootstrapTable('load', obj.goodsList);
        obj.reload();
        $('#supplier').val("");
        $('#Remark').val("");
        $('#inventoryModal').modal({ backdrop: 'static', keyboard: false });
	},
	//产品入库Table
    inventoryTable: function () {
        var obj = this;
        $("#tbl_GoodsList").bootstrapTable({
            editable: true,
            clickToSelect: false,
            uniqueId: "goods_id",
            data: [],
            columns: obj.inventoryColmuns(),
			formatLoadingMessage: function(){return "";}
        });
    },
	inventoryColmuns: function () {
        var obj = this;
        var colmuns = [
            {
               field: 'goods_code', title: __('产品编号'), align: 'left', halign: 'left', width: "11%"
            },
            { field: 'goods_name', title: __('产品名称'), align: 'left', halign: 'left', width: "11%" },
            {
				field: 'quantity', title: __('数量'), align: 'left', halign: 'left', width: "20%", formatter: function (value, row, index) {
                   return '<input type="number"  value="' + value + '" changeValue="quantity"    onchange="InventoryGoods.validatorText(this,0,' + index + ')" class="form-control"/>';
				}
            },
            {
				field: 'goods_cost', title: __('进价'), align: 'left', halign: 'left', width: "20%", formatter: function (value, row, index) {
                   return '<input type="number" min="0" value="' + value + '"  step="0.01"  changeValue="goods_cost" onchange="InventoryGoods.validatorText(this,1,' + index + ')" class="form-control"/>';
				}
            },
            {
				field: 'goods_amount', title: __('金额'), align: 'left', halign: 'left', width: "20%", formatter: function (value, row, index) {
                   return '<font style="color:red">' + __('￥') + returnFloat(value) + '</font>';
				}
            },
			{
				field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "8%", formatter: function (value, row, index) {
                   var fo = '';
                   fo += '<span style="cursor:pointer"  class="remove" onclick="InventoryGoods.removeRow(\'' + row.goods_id + '\',\'' + index + '\')"> <i class="fa fa-trash-o"></i> '+__('删除')+'</span>';
                   return fo;
				}
			}];
        return colmuns;
    },
    //删除选择的产品
    removeRow: function (goods_id, index) {
        var obj = this;
        var delIndex = obj.contains(obj.goodsList, "" + goods_id + "");
        if (delIndex == -1) {
            alertError(__('未找到数据,删除失败'));
            return false;
        }
        obj.goodsList.splice(delIndex, 1);
        $("#tbl_GoodsList").bootstrapTable('load', obj.goodsList);
        obj.reload();
    },
	goodsListModal: function () {
        var obj = this;
        obj.loadGoods();
        $('#GoodsModal').modal({ backdrop: 'static', keyboard: false });
    },
	loadGoods: function(){
		//加载商品信息
		var obj = this;
        $("#tbl_Goods").bootstrapTable('destroy');
        $("#tbl_Goods").bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=lists&typ=json',
            method: 'get',
            toolbar: "#toolbar",
            striped: true,
            pagination: true,
            singleSelect: false,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) 
			{
                var param = {
                    pageIndex: params.pageNumber,
                    pageSize: params.pageSize,
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
            editable: true,
            clickToSelect: true,
            checkboxHeader: true,
            columns: obj.GetGoodsColumns(), //分页选中不会取消
            responseHandler: function (res) 
			{
                var obj = this;
				
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
				
                $.each(tableData.rows, function (i, row) {
                    row.checkStatus = $.inArray(row.goods_id, InventoryGoods.GoodsSelectselectionIds) != -1;  //判断当前行的数据id是否存在与选中的数组，存在则将多选框状态变为true
                });
                return tableData;
            },
            onCheck: function (data) {  //选中               
                obj.GoodsSelectselectionIds.push(data.goods_id);
                obj.GoodsSelectData.push(data);
            },
            onUncheck: function (data) { //取消选中
                var Index = $.inArray(data.goods_id, obj.GoodsSelectselectionIds);
                if (Index > -1) {
                    obj.GoodsSelectselectionIds.splice(Index, 1);  //删除数组中的元素                    
                }
                var Indexs = VerifyData(data.goods_id, obj.GoodsSelectData);
                if (Indexs > -1) {
                    obj.GoodsSelectData.splice(Indexs, 1);
                }
            },
            onCheckAll: function (data) { //全选
                $.each(data, function (index, item) {
                    var Index = $.inArray(item.goods_id, obj.GoodsSelectselectionIds);
                    if (Index == -1) {
                        obj.GoodsSelectselectionIds.push(item.goods_id);
                    }

                    var Indexs = VerifyData(item.goods_id, obj.GoodsSelectData);
                    if (Indexs == -1) {
                        obj.GoodsSelectData.push(item);
                    }
                });
            },
            onUncheckAll: function (data) { //取消全选
                $.each(data, function (index, item) {
                    var Index = $.inArray(item.goods_id, obj.GoodsSelectselectionIds);
                    if (Index > -1) {
                        obj.GoodsSelectselectionIds.splice(Index, 1);  //删除数组中的元素                    
                    }

                    var Indexs = VerifyData(item.goods_id, obj.GoodsSelectData);
                    if (Indexs > -1) {
                        obj.GoodsSelectData.splice(Indexs, 1);
                    }
                });
            },
			formatLoadingMessage: function(){
                return "";
            }
        });
	},
	GetGoodsColumns: function () {
        var colmums = [
            { field: "checkStatus", checkbox: true, disabled: false, width: "1%" },
            { field: 'goods_code', title: __('产品编号'), edit: false, align: 'left', halign: 'left', width: '15%' },
            { field: 'goods_name', title: __('产品名称'), edit: false, align: 'left', halign: 'left', width: '25%' },
            {
                field: 'goods_cost', title: __('进价'), edit: false, align: 'left', halign: 'left', width: '10%'
            },
            {
                field: 'goods_price', title: __('单价'), edit: false, align: 'left', halign: 'left', width: '10%', formatter: function (value, rows, index) {
                    return '<font style="color:red">' + __('￥') + returnFloat(value) + '</font>';
                }
            }
        ];
        return colmums;
    },
    //选择产品 确定 
    loadCartData: function () {
        var obj = this;
        var rows = obj.GoodsSelectData;
        if (rows.length < 1) {
            alertError(__('请选择产品'));
            return false;
        };
        if (obj.goodsList.length > 0) {
            for (var item in rows) {
                var index = obj.contains(obj.goodsList, rows[item].goods_id);
                if (index != -1) {
                    obj.goodsList[index].quantity = obj.goodsList[index].quantity - 0.00 + 1;
                    obj.goodsList[index].goods_amount = obj.goodsList[index].quantity * obj.goodsList[index].goods_cost;
                }
                else {
                    rows[item].quantity = 1;
                    rows[item].goods_amount = rows[item].quantity * rows[item].goods_cost;
                    obj.goodsList.push(rows[item]);
                }
            }
        }
        else {
            $.each(rows, function (i, t) {
                t.quantity = 1;
                t.goods_amount = t.quantity * t.goods_cost;
                obj.goodsList.push(t);
            });
        }
        $("#tbl_GoodsList").bootstrapTable('load', obj.goodsList);
        obj.GoodsSelectData = [];
        obj.GoodsSelectselectionIds = [];
        obj.reload();
        $("#GoodsModal").modal('hide');
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
    validatorText: function (val, regType, index) {
        var obj = this;
        if (regType == 1) {
            if ($(val).val() > sysParameter.unit_price * 10000) {
                $(val).val(-1);
                alertError(__('价格不能超过') + sysParameter.unit_price  + __('万'));
            }
        }
        var regStr = "";
        switch (regType) {
            case 0:
                regStr = /^0\.([1-9]|\d[1-9])$|^[1-9]\d{0,8}\.\d{0,3}$|^[1-9]\d{0,8}$/;
                break;
            case 1:
                regStr = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
                break;
            case 2:
                regStr = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;///^(0|[1-9]\d*)(\.\d{1,3})?$/;
                break;
            default:
                regStr = regType;
                break;
        }
        if (regStr == regType) {
            alertError(__('参数异常'))
            return false;
        }
        else {
            if (regStr.test($(val).val())) {
                if (InventoryGoods.valitorStart > 0) {
                    InventoryGoods.valitorStart--;
                }
                var rows = $("#tbl_GoodsList").bootstrapTable('getData');
                switch (regType) {
                    case 0:
                        $("#tbl_GoodsList").bootstrapTable('updateCell', { index: index, field: 'quantity', value: $(val).val() });
                        $("#tbl_GoodsList").bootstrapTable('updateCell', { index: index, field: 'goods_amount', value: returnFloat($(val).val() * rows[index].goods_cost) });
                        break;
                    case 1:
                        $("#tbl_GoodsList").bootstrapTable('updateCell', { index: index, field: 'goods_cost', value: $(val).val() });
                        $("#tbl_GoodsList").bootstrapTable('updateCell', { index: index, field: 'goods_amount', value: returnFloat($(val).val() * rows[index].quantity) });
                        break;
                    case 2:
                        $("#tbl_GoodsList").bootstrapTable('updateCell', { index: index, field: 'goods_amount', value: $(val).val() });
                        $("#tbl_GoodsList").bootstrapTable('updateCell', { index: index, field: 'goods_cost', value: returnFloat($(val).val() / rows[index].quantity) });
                        break;
                }
                obj.reload();
                $(val).removeAttr('style');
                $('#btn-save').attr('disabled', false);
                return true;
            }
            else {
                InventoryGoods.valitorStart++;
                $('#btn-save').attr('disabled', true);
                $(val).attr('style', 'border:1px solid red');
                return false;
            }
        }
    },
    //计算总数量和总金额
    reload: function () {
        var obj = this;
        var data = $("#tbl_GoodsList").bootstrapTable('getData');
        obj.total = 0;
        obj.inventory_amount = 0;
        for (var item in data) {
            obj.total += parseFloat(data[item].quantity);
            obj.inventory_amount += data[item].goods_cost * data[item].quantity;
        }
        $('#inventory_amount').text(obj.inventory_amount.toFixed(2));
        $('#inventory_number').text(obj.total);
    },
    //刷新库存 Table
    refresh: function () {
        var obj = this;
        $('#formModel')[0].reset();
        $('#inventoryModal').modal('hide');
        $("#datatable-responsive").bootstrapTable('refresh');
    },
	//获取供应商列表
	getSupplier: function(){
		var obj = this;
        $.get(SYS.CONFIG.index_url+'?ctl=Goods_Supplier&met=lists&typ=json', function (data){
			var data = data.data;
            for (var item in data.items) {
                $("#supplier").append("<option value=" + data.items[item].supplier_id + ">" + data.items[item].supplier_name + "</option>");
            }
        },'json');
	},
    getStockTable: function () {
        var obj = this;

        var pageSize = 10;
        $("#datatable-responsive").bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Inventory&met=stockLists&typ=json',
            method: 'get',
            striped: true,
            pagination: true,
            singleSelect: false,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {
                var param = {
                    page: params.pageNumber,
                    rows: params.pageSize,
					goodsKey: $('#goodsKey').val()
                    /* goodsStock: {
                        GoodsName: $('#edtGoodsKey').val(),
                        GoodsClass: $('#edtGoodsClass').val(),
                        ShopID: $("#edtShopId").val(),
                        StockNum: $('#LogicStockNum').val(),
                        AveragePrice: $('#LogicAveragePrice').val(),
                    },
                    LogicStockNum: $('#Sel_StockNum').val(),
                    LogicAveragePrice: $('#Sel_Price').val() */
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: pageSize,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "goods_id",
            columns: obj.getStockColumns(),
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			},
			formatLoadingMessage: function(){
                return "";
            }
        });
    },
    getStockColumns: function () {
        var colmuns = [
            {
                field: 'goods_code', title: __('产品编号'), align: 'left', halign: 'left', width: "8%"
            },
            { field: 'goods_name', title: __('产品名称'), align: 'left', halign: 'left', width: "10%" },
            {
                field: 'goods_stock', title: __('库存数量'), align: 'left', halign: 'left', width: "5%", footerFormatter: function (data) {
                    var count = 0.00;
                    for (var i in data) {
                        count = count - 0.00 + (data[i].goods_stock - 0.00);
                    }
                    return count.toFixed(2);
                }
            }/* ,
            {
                field: 'Operator', title: __('记录'), align: 'left', halign: 'left', width: '8%', formatter: function (value, row, index) {
                    var fo = '<button type="button" onclick="InventoryGoods.checkLog(\'' + row.goods_id + '\',\'' + row.goods_name + '\',\'' + 0 + '\')" class="btn b-racius3 btn-default waves-effect btn-xs m-r-5"><i class="fa fa-heart"></i> <span>'+__('详情')+'</span></button>';

					return fo;
                }
            } */
        ];
        return colmuns;
    },
    //盘点记录 table
    checkLog: function (goods_id, goods_name, log_type) {
        var obj = this;
        $('#tbl_GoodsLog').bootstrapTable('destroy');
        $("#tbl_GoodsLog").bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Inventory&met=inventoryLog&typ=json',
            method: 'get',
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
            sortName: 'Id',
            sortOrder: 'desc',
            queryParams: function queryParams(params) 
			{
                var param = {
                    page: params.pageNumber,
                    rows: params.pageSize,
                    goods_id: goods_id,
					log_type: log_type
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "Id",
            editable: true,
            clickToSelect: true,
            columns: obj.getLogColmuns(),
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			},
			formatLoadingMessage: function(){
                return "";
            }
        });
        $('#LogTitle').html(goods_name + __('库存变更记录'));
        $('#DetailModal').modal({ backdrop: 'static', keyboard: false });
    },
    getLogColmuns: function () {
        var colmuns = [
            { field: 'inventory_id', title: __('单据号'), align: 'left', halign: 'left', width: "13%" },
            { field: 'goods_pre_stock', title: __('变更前'), align: 'left', halign: 'left', width: "7%" },
            {
                field: 'goods_quantity', title: __('变更数量'), align: 'left', halign: 'left', width: "7%", formatter: function (value, row, index) {
                    return value < 0 ? value * -1 : value;
                }
            },
            { field: 'inventory_type_text', title: __('操作类型'), align: 'left', halign: 'left', width: "15%" },
            { field: 'goods_add_time', title: __('记录时间'), align: 'left', halign: 'left', width: "20%" }
        ];
        return colmuns;
    }
}