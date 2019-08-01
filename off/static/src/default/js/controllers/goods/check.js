$(function () {
    CheckGoods.init();
});
var CheckGoods = {
    goodsData: [],     //选择的产品
    checkList: [],     //跨页选择的数据  
    checkIdsList: [],  //跨页选择的ID
    init: function () {
        var obj = this;
        obj.event();
        obj.checkTable();
    },
    event: function () {
        var obj = this;
        
		//库存盘点事件-点击弹出Modal
        $('#btn-check').on('click', function () {
            obj.goodsData = [];
            $("#over_qty").html("0");
            $("#over_amount").html("0");
            $("#loss_qty").html("0");
            $("#loss_amount").html("0");
            obj.GetTable();
            $("#table-check").bootstrapTable('load', obj.goodsData);
            $('#checkModal').modal({ backdrop: 'static', keyboard: false });
        });

		//初始化库存盘点Modal
        $('#checkModal').on('hide.bs.modal', function () {
            $("#check-form")[0].reset();
            $('#check-form').data('bootstrapValidator').resetForm(true);
        });
		
        //库存盘点 选择产品 Modal        
        $('#show-check').on('click', function () {
            $('#InventoryModal').modal({ backdrop: 'static', keyboard: false });
            $("#InventoryModal").on("shown.bs.modal", function () {});
        });
		
        //库存盘点 选择产品 文本框搜索
        $("#InventoryCode").bind('keydown', function () {
            e = arguments.callee.caller.arguments[0] || window.event
            if (e.keyCode == 13) {
                e.preventDefault();
                $("#tbl_Inventory").bootstrapTable('refresh');
                $("#InventoryCode").val("");
            }
        });
		
        //库存盘点 选择产品 搜索按钮
        $('#InventorySearch').on('click', function () {
            $('#tbl_Inventory').bootstrapTable('refresh');
        });
		
        //选择要盘点的产品
        $('#btn_Inventory').on('click', function () {
            obj.loadCartData();
        });

        //库存盘点 关闭Modal
        $(".check-close").on('click', function () {
            obj.goodsData = [];
            obj.checkList = [];
            obj.checkIdsList = [];
        });
		
        //产品信息列表关闭 Modal
        $("#InventoryModal").on('hide.bs.modal', function () {
            //关闭
            $("#InventoryForm")[0].reset();
            obj.checkList = [];
            obj.checkIdsList = [];
            $("#tbl_Inventory").bootstrapTable('refresh');
        });


        //提交库存盘点功能
        $("#check-form").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                remark: {
                    validators: {
                        notEmpty: {
                            message: __("盘点备注不能为空")
                        },
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
            var istrue = obj.validatePdNum(0);
            if (!istrue) {
                return false;
            }
            var goodsList = obj.goodsData;
            $.each(goodsList, function (index, item) {
                if (item.checkQty == item.goods_stock) {
                    alertError("【" + item.goods_name + "】"+__("库存数和盘点数一致，不需要盘点！"));
                    istrue = false;
                    return;
                }
            });
            if (istrue) {
                var checkGoods = [];
                $.each(goodsList, function (index, item) {
                    var goodsInfo = {
                        goods_id: item.goods_id,
                        goods_code: item.goods_code,
                        goods_name: item.goods_name,
                        goods_price: item.goods_cost,
                        overflow_quantity: item.overflow_quantity,
                        loss_quantity: item.loss_quantity,
						goods_quantity: item.checkQty,
						goods_pre_stock: item.goods_stock
                    };
                    checkGoods.push(goodsInfo);
                });
                postData.loss_amount = $('#loss_amount').text(); //报损金额
                postData.loss_quantity = $('#loss_qty').text(); //报损数量
                postData.overflow_amount = $('#over_amount').text(); //报溢金额
                postData.overflow_quantity = $('#over_qty').text(); //报溢数量
                postData.remark = $('#remark').val(); //备注
                postData.checkGoods = checkGoods; //产品数据
 
                $("#btn-check-save").attr('disabled', true);
                $.ajax({
                    url: SYS.CONFIG.index_url +'?ctl=Goods_Check&met=add&typ=json',
                    type: 'post',
                    dataType: "json",
                    data: postData,
                    success: function (res) {
                        $("#btn-check-save").attr('disabled', false);
                        if (res.status && res.status == 200) {
                            alertMessage(__("盘点完成"));
                            obj.goodsData = [];
                            obj.checkList = [];
                            obj.checkIdsList = [];
                            $("#check-form")[0].reset();
                            $('#check-form').data('bootstrapValidator').resetForm(true);//验证重置
                            $('#checkModal').modal('hide');
                            $("#table-check").bootstrapTable('refresh');
                            $("#datatable-responsive").bootstrapTable('refresh');
                            $("#tbl_Inventory").bootstrapTable('refresh');
                        }
                        else {
                            alertError(res.msg);
                        }
                    }
                });
            }
        });

    },
    //库存盘点TABLE
    checkTable: function () {
        var obj = this;
        $("#table-check").bootstrapTable({
            clickToSelect: false,
            uniqueId: "goods_id",
            data: [],
            columns: obj.checkColumns(),
			formatLoadingMessage: function(){return "";}
        });
    },
    checkColumns: function () {
        var colmuns = [
            { field: 'goods_code', title: __('产品编号'), align: 'left', halign: 'left', width: "8%" },
            { field: 'goods_name', title: __('产品名称'), align: 'left', halign: 'left', width: "10%" },
            { field: 'goods_stock', title: __('库存数量'), align: 'left', halign: 'left', width: "5%" },
            {
                field: 'checkQty', title: __('盘点数量'), align: 'left', halign: 'left', width: "10%", formatter: function (value, row, index) {
                    return '<input type="text"  value="' + value + '" onkeyup="clearNoNum(this)" changeValue="checkQty"  goods_id="' + row.goods_id + '" onblur="CheckGoods.validator(this,' + index + ',' + 0 + ',' + row.goods_stock + ')" class="form-control"/>';
                }
            },
            {
                field: 'overflow_quantity', title: __('报溢数'), align: 'left', halign: 'left', width: "5%", formatter: function (value, row, index) {
                    if (row.checkQty - row.goods_stock > 0) {
                        return Math.round((row.checkQty - row.goods_stock) * 1000) / 1000;
                    } else {
                        return 0;
                    }
                }
            },
            {
                field: 'loss_quantity', title: __('报损数'), align: 'left', halign: 'left', width: "5%", formatter: function (value, row, index) {
                    if (row.goods_stock - row.checkQty > 0) {
                        return Math.round((row.goods_stock - row.checkQty) * 1000) / 1000;
                    } else {
                        return 0;
                    }

                }
            },
             {
                 field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, row, index) {
                     var fo = '';
                     fo += '<span style="cursor:pointer"  class="remove" onclick="CheckGoods.removeRow(\'' + row.goods_id + '\',\'' + index + '\')"> <i class="fa fa-trash-o"></i> '+__('删除')+'</span>';
                     return fo;
                 }
             }
        ];
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
        $("#table-check").bootstrapTable('load', obj.goodsData);
        $("#tbl_Inventory").bootstrapTable('refresh');
        obj.validatePdNum(1);
    },
    //绑定库存 Table
    GetTable: function () {
        var obj = this;
        $("#tbl_Inventory").bootstrapTable('destroy');
        $("#tbl_Inventory").bootstrapTable({
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
            responseHandler: function (res) {
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
            },
			formatLoadingMessage: function(){
                return "";
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
                field: 'goods_cost', title: __('成本价'), edit: false, align: 'left', halign: 'left', width: '15%', formatter: function (value, rows, index) {
                    return '<font style="color:red">'+__('￥') + returnFloat(value) + '</font>';
                }
            }
        ];
        return colmums;
    },
    //刷新库存 Table
    Refresh: function () {
        var obj = this;
        $("#tbl_Inventory").bootstrapTable('refresh');
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
                var Indexs = obj.contains(obj.checkList, rows[item].goods_id);
                if (index != -1) {
                    obj.goodsData[index].Qty += 1;
                    //obj.checkList[Indexs].checkQty += 1;
                    obj.checkList[Indexs].checkQty = "";
                    obj.checkList[Indexs].overflow_quantity = obj.checkList[Indexs].checkQty - obj.checkList[Indexs].goods_stock < 0 ? 0 : obj.checkList[Indexs].checkQty - obj.checkList[Indexs].goods_stock;
                    obj.checkList[Indexs].loss_quantity = obj.checkList[Indexs].goods_stock - obj.checkList[Indexs].checkQty < 0 ? 0 : obj.checkList[Indexs].goods_stock - obj.checkList[Indexs].checkQty;
                }
                else {
                    rows[item].Qty = 1;
                    obj.goodsData.push(rows[item]);
                    obj.checkList[Indexs].checkQty = "";
                    obj.checkList[Indexs].overflow_quantity = obj.checkList[Indexs].checkQty - obj.checkList[Indexs].goods_stock < 0 ? 0 : obj.checkList[Indexs].checkQty - obj.checkList[Indexs].goods_stock;
                    obj.checkList[Indexs].loss_quantity = obj.checkList[Indexs].goods_stock - obj.checkList[Indexs].checkQty < 0 ? 0 : obj.checkList[Indexs].goods_stock - obj.checkList[Indexs].checkQty;
                }
            }
        }
        else {
            $.each(rows, function (i, t) {
                t.Qty = 1;
                obj.goodsData.push(t);
                obj.checkList[i].checkQty = "";
                obj.checkList[i].overflow_quantity = obj.checkList[i].checkQty - obj.checkList[i].goods_stock < 0 ? 0 : obj.checkList[i].checkQty - obj.checkList[i].goods_stock;
                obj.checkList[i].loss_quantity = obj.checkList[i].goods_stock - obj.checkList[i].checkQty < 0 ? 0 : obj.checkList[i].goods_stock - obj.checkList[i].checkQty;
            });
        }
        $("#table-check").bootstrapTable('load', obj.goodsData);
        obj.load();
        $("#InventoryModal").modal('hide');
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

    //盘点修改行数
    validator: function (val, index, regType, d) {
        var obj = this;
        var regStr = "";
        switch (regType) {
            case 0:
                //regStr = /^[0-9]*[1-9][0-9]*$/;
                regStr = /^0\.([0-9]|\d[0-9])$|^[0-9]\d{0,8}\.\d{0,3}$|^[0-9]\d{0,8}$/;
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

                $("#table-check").bootstrapTable('updateCell', { index: index, field: $(val).attr('changeValue'), value: $(val).val() });
                $("#table-check").bootstrapTable('updateCell', {
                    index: index, field: 'overflow_quantity', value:
                        $(val).val() - d > 0 ? Math.round(($(val).val() - d) * 1000) / 1000 : 0
                });
                $("#table-check").bootstrapTable('updateCell', { index: index, field: 'loss_quantity', value: d - $(val).val() > 0 ? Math.round((d - $(val).val()) * 1000) / 1000 : 0 });
                for (var item in obj.checkList) {
                    var Indexs = VerifyData($(val).attr("goods_id"), obj.checkList);
                    if (Indexs > -1) {
                        obj.checkList[Indexs].checkQty = $(val).val();
                        obj.checkList[Indexs].overflow_quantity = $(val).val() - d > 0 ? Math.round(($(val).val() - d) * 1000) / 1000 : 0;
                        obj.checkList[Indexs].loss_quantity = d - $(val).val() > 0 ? Math.round((d - $(val).val()) * 1000) / 1000 : 0;
                    }
                }

                obj.load();
                $(val).removeAttr('style');
                obj.validatePdNum(1);
                return true;
            }
            else {
                InventoryGoods.valitorStart++;
                $(val).attr('style', 'border:1px solid red');
                $('#btn-check-save').attr('disabled', true);
                return false;
            }
        }
    },
    validatePdNum: function (type) {
        var istrue = true;//判断是否为false 是 返回
        $("#table-check input[type='text']").each(function () {
            if ($.trim($(this).val()) == "") {
                $(this).attr('style', 'border:1px solid red');
                istrue = false;
            }
        });
        if (type == 1) {
            if (!istrue) {
                $('#btn-check-save').attr('disabled', true);
            } else {
                $('#btn-check-save').attr('disabled', false);
            }
        }
        return istrue;
    },
    //盘点改变值
    load: function () {
        var obj = this;
        var data = obj.goodsData;
        var loss_qty = 0;
        var loss_amount = 0;
        var over_qty = 0;
        var over_amount = 0;
        for (var item in data) {
            loss_qty += parseFloat(data[item].loss_quantity);
            over_qty += parseFloat(data[item].overflow_quantity);
            loss_amount += data[item].goods_cost * data[item].loss_quantity;
            over_amount += data[item].goods_cost * data[item].overflow_quantity;
        }
        $('#loss_amount').text(loss_amount.toFixed(2));
        $('#over_amount').text(over_amount.toFixed(2));
        $('#loss_qty').text(loss_qty);
        $('#over_qty').text(over_qty);
    },

}