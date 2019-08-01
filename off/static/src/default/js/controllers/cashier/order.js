$(function () {
    OrderBase.init();
});
var OrderBase = {
    order_id: "",
	GoodsList: [],
    selectionIds: [],
	return_money:0,
    init: function ()
    {
        var obj = this;
 
		//初始绑定
        obj.bindDate();
        obj.getTable();
        
        $("#consume_type").show();
 
		//订单详情Modal
        $('#orderModal').on('hide.bs.modal onmonusover', function () {
            $('.guanbi_close').removeClass('in');
            $(".guanbi_close").addClass("collapse");
            $(".tianjia").addClass("collapsed");
        });
		
        //查询
        $("#btn-query,#btn-search").click(function () {
            obj.refresh("");
        });
 
        //筛选更多div显示时 隐藏查询按钮
        $("#btn-all").click(function () {
            if (document.getElementById("ScreenDiv").className == "collapse") {
                $("#btn-query").hide();
            } else {
                $("#btn-query").show();
            }
        });
		
        //重置
        $("#btn-reset").bind('click', function () {
            $("#searchForm")[0].reset();
            $("#order_id").val("");
            obj.refresh("");
        });
		
		//退货
		$("#btn-return").on('click', function () {
            obj.addReturnOrder();
        });
    },
    //获取订单列表table数据
    getTable: function () {
        var obj = this;
        $('#tableWrapper').bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Cashier_Order&met=lists&typ=json',
            striped: true,
            pagination: true,
            striped: true,
            singleSelect: true,
            queryParamsType: "undefined",
			queryParams: function queryParams(params) {
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize,
                    order_id: $('#order_id').val(),
                    order_type:$("#order_type").val() - 0,
					beginDate:$("#rangetime").val().split(__(' 至 '))[0] == undefined ? "" : $("#rangetime").val().split(__(' 至 '))[0],
					endDate:$("#rangetime").val().split(__(' 至 '))[1] == undefined ? "" : $("#rangetime").val().split(__(' 至 '))[1],
					beginMoney : $('#beginMoney').val(),
					endMoney : $('#endMoney').val()
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "order_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getColumns(),
            onDblClickRow: function (data) {
                obj.showDetail(data);
            },
            formatLoadingMessage: function(){return "";},
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			}
        });
    },
    //绑定订单列表table列
    getColumns: function () {
        var obj = this;
        var columns = [];
        columns.push({
            field: 'order_id', title: __('订单号'), align: 'left', halign: 'left', width: '15%', formatter: function (value, row, index) {
                var result = row.order_id;

                if (row.order_state_id == 7) {
                    result += '<span class="badge badge-pink pull-right">已关闭</span>';
                }
				
				return result;
            }
        });
        columns.push({
            field: 'order_create_time', title: __('消费时间'), align: 'left', halign: 'left', width: '12%'
        });
        columns.push({
            field: 'order_type', title:__('类型') , align: 'left', halign: 'left', width: '8%', formatter: function (val) {
                if (val == 1) {
                    return __("快速消费");
                } else if (val == 2) {
                    return __("商品消费");
                } else {
                    //return "退货";
                }
            }
        });
        columns.push({
            field: 'user_name', title: __('会员卡号'), align: 'left', halign: 'left', width: '12%'
        });
        columns.push({
            field: 'user_realname', title: __('会员姓名'), align: 'left', halign: 'left', width: '8%'
        });
        columns.push({
            field: 'order_pay_amount', title: __('消费金额'), align: 'left', halign: 'left', width: '6%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
        columns.push({
            field: 'order_operator', title:  __('操作员'), align: 'left', halign: 'left', width: '11%'
        });
        columns.push({
            field: '', title:__('操作') , align: 'left', halign: 'left', width: '12%', formatter: function (value, row, index) {
                var _fm = "";
                _fm += "<button onclick='OrderBase.printOrder(\"" + row.order_id + "\"," + row.order_type + ")' class='btn b-racius3 btn-default waves-effect btn-xs m-r-5' title='打印'><i class='fa fa-print fa-lg'></i></button>";
				
				if(row.order_type == 2 && row.order_state_id != 7){
					_fm += "<button onclick='OrderBase.returnOrder(\"" + row.order_id + "\"," + row.order_type + ")' class='btn b-racius3 btn-default waves-effect btn-xs m-r-5' title='退货'><i class='fa fa-undo'></i></button>";
				}
                return _fm;
            }
        });

        return columns;
    },
    //点击显示商品getOrderGoods
    getOrderGoods: function (id) {
        var obj = this;
        $('#orderGoods').bootstrapTable({
			ajax : function (request) {
				$.ajax({
					type : "GET",
					url : SYS.CONFIG.index_url + '?ctl=Cashier_Order&met=orderGoods&typ=json',
					contentType: "application/json;charset=utf-8",
					dataType:"json",
					data:{ order_id: id},
					success : function (res) 
					{			
						request.success({
							row : res.data
						});
						$('#orderGoods').bootstrapTable('load', res.data);
					},
					error:function(){
						alert(__("错误"));
					}
				});
			},
            toolbar:'#toolbar',
			singleSelect:true,
			clickToSelect:true,	
			sortName: "create_time",
			sortOrder: "desc",
			pageSize: 15,
			pageNumber: 1,
			pageList: "[10, 25, 50, 100]",
			showToggle: false,
			showRefresh: false,
			search: false,
			pagination: true,
            columns: obj.orderGoodsColumns(),
			formatLoadingMessage: function(){return "";}
        });
    },
    //按订单号绑定table
    orderGoodsColumns: function () {
        var obj = this;
        var columns = [];
        columns.push({
            field: 'goods_code', title: __('产品编号'), align: 'left', halign: 'left', width: '15%'
        });
        columns.push({
            field: 'goods_name', title: __('产品名称'), align: 'left', halign: 'left', width: '15%'
        });
        columns.push({
            field: 'goods_pay_price', title: __('折后单价'), align: 'left', halign: 'left', width: '15%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
        columns.push({
            field: 'goods_number', title: __('购买数量'), align: 'left', halign: 'left', width: '15%'
        });
		columns.push({
            field: 'goods_return_number', title: __('已退数量'), align: 'left', halign: 'left', width: '15%'
        });
        columns.push({
            field: 'order_goods_payamount', title: __('总费用'), align: 'left', halign: 'left', width: '15%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
        return columns;
    },
    //打印订单 type: 1：快速 2：商品
    printOrder: function (id, type) {
        var obj = this;
        if (id == "" || id.length < 1) {
            alertError(__("请选择收银单据"));
            return false;
        }
 
        $.get(SYS.CONFIG.index_url + '?ctl=Cashier_Order&met=getPrintData&typ=json', {order_id: id, type: type}, function (d)
        {
            if (d && d.status == 200)
            {
                var d = d.data;
				if(type == 2)
				{
					GoodsOrderPrint({}, d.printData, 2, 1);
				}              
            }
            else {
                alertError(d.msg);
            }
        },'json');
    },
    //绑定时间
    bindDate: function () {
        var obj = this;
        $('#rangetime').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: __(' 至 '),
            start: "",
            end: "",
            showDropdowns: true
        });
    },
    //刷新table
    refresh: function (id) {
        var obj = this;
		
        $('#tableWrapper').bootstrapTable('destroy');
        obj.getTable();
    },
    //订单详情预览
    showDetail: function (data) {
        var obj = this;
 
        $("#memberInfoForm,#orderGoodsForm").setForm(data);
        $("#orderModal").modal({ backdrop: 'static', keyboard: false });
        $('#orderGoods').bootstrapTable('destroy');
        obj.getOrderGoods(data.order_id);
        obj.getMemberInfo(data.user_id);
    },
    //获取订单会员信息
    getMemberInfo: function (user_id) {
        var obj = this;
         $.ajax({
            type: "post",
            url: SYS.CONFIG.index_url + '?ctl=Member_Info&met=memberInfo&typ=json',
            data: { user_id: user_id},
            async: false,
            dataType:'json',
            success: function (res) {
                var data = res.data;
                var level = res.data.level;
                if (data.user_id == 0) {
                    $("#member_grade_name").val(__("散客"));
                }
                else {
                    $("#member_grade_name").val(level.member_grade_name);
                }
            }
        });
    },
	//商品退货
    returnOrder: function (order_id,order_type) {
        var obj = this;
        obj.order_id = order_id;
        obj.selectionIds = [];
        obj.getRefundGoods(order_id);
        $("#btn-return").removeAttr('disabled');
 
        //全选  不全选
        $('input[name="btSelectAll"]').click(function () {
            var money = 0;
            if ($('input[name="btSelectAll"]').is(":checked")) {
                var data = $('#orderGoodsList').bootstrapTable('getData', false);
                $.each(data, function (index, item) {
                    money += item.order_goods_payamount;
                    obj.selectionIds.push(item.id);
                    obj.GoodsList.push(item);
                });
            } else {
                var data = $('#orderGoodsList').bootstrapTable('getData');
                $.each(data, function (index, item) {
                    var Index = $.inArray(item.id, obj.selectionIds);
                    if (Index > -1) {
                        obj.selectionIds.splice(Index, 1);
                    }
                    var Indexs = obj.IsContain(obj.GoodsList, item.id);
                    if (Indexs > -1) {
                        obj.GoodsList.splice(Indexs, 1);
                    }
                    money -= item.order_goods_payamount;
                });
            }
            obj.return_money += money;
            $("#returnMoney").html(obj.return_money);
        });
        
        $('#returnModal').modal({ backdrop: 'static', keyboard: false });
        obj.return_money = 0;
        obj.GoodsList = [];
        $("#returnMoney").html(parseFloat(obj.return_money));
    },
    //获取订单商品列表
    getRefundGoods: function (data) {
        var obj = this;
        obj.GoodsNum = [];
        $('#orderGoodsList').bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.index_url+'?ctl=Cashier_Order&met=orderGoods&typ=json',
            method: 'get',
            toolbar: "#toolbar",
            striped: true,
            pagination: false,
            singleSelect: false,
            queryParamsType: "undefined",
            queryParams: function queryParams(params){
                var param = {
                    pageIndex: 0,
                    pageSize: 0,
                    order_id: data,
					goods_status:2
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "order_goods_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getGoodsDetailColumns(),
            responseHandler: obj.responseHandler,  
            onCheck: function (data) { //选中
                obj.checkEvent(data, 1);
            },
            onUncheck: function (data) { //不选中
                obj.checkEvent(data, 2);
            },
        });
        $("input[name='btSelectAll']").hide();
    },
    //按订单号绑定table
    getGoodsDetailColumns: function () {
        var obj = this;
        var columns = [];
        columns.push({ field: 'checkStatus', checkbox: true });
        columns.push({
            field: 'goods_name', title: '产品名称', align: 'left', halign: 'left', width: '20%'
        });
		columns.push({
            field: 'goods_return_number', title: '已退数量', align: 'left', halign: 'left', width: '20%'
        });
        columns.push({
            field: 'return_quantity', title: '可退数量', align: 'left', halign: 'left', width: '20%', formatter: function (value, row, index) {
                if (obj.GoodsNum[index] == undefined) {
                    obj.GoodsNum.push(row.return_quantity);
                }
                var readonly = value < 1 ? "readonly" : "";
                var refundableQty = value;
                if (row.goods_type != 3) {
                    refundableQty = '<input type="text" value="' + row.return_quantity + '" ' + readonly + '  onchange="OrderBase.validatorText(this,' + row.return_quantity + ',' + index + ')" data-Id=' + row.id + ' data-Num=' + row.return_quantity + ' data-Price=' + row.goods_pay_price + '  class="form-control">';
                }
                return refundableQty;
            }
        });
        columns.push({
            field: 'goods_pay_price', title: '折后单价', align: 'left', halign: 'left', width: '20%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
        columns.push({
            field: 'order_goods_payamount', title: '总费用', align: 'left', halign: 'left', width: '20%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
        return columns;
    },
    //分页选中不会取消
    responseHandler: function (res) {
		var tableData = {};
		tableData.rows  = res.data;
		tableData.total = res.data.records;
 
        $.each(tableData.rows, function (i, row) {
            row.checkStatus = $.inArray(row.id, OrderBase.selectionIds) != -1;  //判断当前行的数据id是否存在与选中的数组，存在则将多选框状态变为true  
            var index = OrderBase.IsContain(OrderBase.GoodsList, row.id);
            if (index != -1) {
                row.return_quantity = OrderBase.GoodsList[index].return_quantity;
            }
        });
        return tableData;
    },
    //判断可退数量
    validatorText: function (a, val, index) {
        var obj = this;
        if (!/^\+?[1-9][0-9]*$/.test($(a).val())) {
            $(a).attr('style', 'border:1px solid red');
            $("#btn-return").attr("disabled", "disabled");//退货按钮禁用
            return;
        } else if (parseInt($(a).val()) > obj.GoodsNum[index]) {
            alertError("该产品已达到可退数量上限");
            $(a).attr('style', 'border:1px solid red');
            $("#btn-return").attr("disabled", "disabled");
            return;
        } else {
            $(a).removeAttr('style');
            $("#btn-return").removeAttr('disabled');
            $("#orderGoodsList").bootstrapTable('updateCell', { index: index, field: 'order_goods_payamount', value: MoneyPrecision(parseInt($(a).val()) * parseFloat($(a).data("price"))) });
            $("#orderGoodsList").bootstrapTable('updateCell', { index: index, field: 'return_quantity', value: parseInt($(a).val()) });

            var Indexs = obj.IsContain(obj.GoodsList, $(a).data("id"));
            if (Indexs > -1) {
                if (obj.GoodsList[Indexs].GoodsType != 4) {
                    obj.GoodsList[Indexs].order_goods_payamount = MoneyPrecision(parseInt($(a).val()) * parseFloat($(a).data("price")));

                    obj.GoodsList[Indexs].return_quantity = parseInt($(a).val());
                }
            }
            var money = 0;
            $.each(obj.GoodsList, function (index, item) {
				if(item.return_quantity > 0){
					money += parseFloat(item.order_goods_payamount);
				}
            });
            obj.return_money = money;
 
            $("#returnMoney").html(MoneyPrecision(parseFloat(obj.return_money)));
        }
    },
    //选中  不选中
    checkEvent: function (data, a) {
        var obj = this;
 
        if (a == 1) {
            obj.selectionIds.push(data.id);
            obj.GoodsList.push(data);
			if(data.return_quantity > 0){
				obj.return_money = parseFloat(parseFloat(obj.return_money) + parseFloat(data.order_goods_payamount));
			}

            $("#returnMoney").html(MoneyPrecision(parseFloat(obj.return_money)));

        } else {
            var index = $.inArray(data.id, obj.selectionIds);
            if (index > -1) {
                obj.selectionIds.splice(index, 1);
            }
            var Indexs = obj.IsContain(obj.GoodsList, data.id);
            if (Indexs > -1) {
                obj.GoodsList.splice(Indexs, 1);
            }
			if(data.return_quantity > 0){
				obj.return_money = parseFloat(obj.return_money - parseFloat(data.order_goods_payamount));
			}
            $("#returnMoney").html(MoneyPrecision(parseFloat(obj.return_money)));
        }
    },
    //判断数组里是否有该ID
    IsContain: function (data, id) {
        var Index = -1;
        $.each(data, function (index, item) {
            if (item.id == id) {
                Index = index;
            }
        });
        return Index;
    },
    //退货
    addReturnOrder: function () {
        var obj = this;
        var dataList = [];
        $.each(obj.GoodsList, function (index, item) {
            if (item.return_quantity > 0) {
                item.consume_quantity = item.goods_number;
                dataList.push(item);
            }
        });
        if (dataList.length < 1) {
            alertError("请选择要退货的产品");
            return;
        }
        var postData = {
            order_id: obj.order_id,
            returnData: dataList,
            return_remark: $("#return_remark").val()//退单备注
        };
		
        $.ajax({
            url: SYS.CONFIG.index_url+'?ctl=Cashier_Return&met=add&typ=json',
            type: 'post',
            async: false,
            data: postData,
			dataType:'json',
            success: function (data) {
                if (data && data.status == 200) {
                    alertMessage(data.msg);
					obj.printTicket(data.data.printData);
					
                    $("#returnModal").modal('hide');
                    obj.refresh();
                } else {
                    alertError(data.msg);
                }
            }
        });
    },
	//打印
    printTicket: function (json) 
	{
		ReturnOrderPrint(json);
    }
}