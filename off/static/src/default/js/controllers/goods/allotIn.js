$(function () {
    AllotIn.init();
});
var AllotIn = {
    init: function ()
    {
        var obj = this;
 
        $('#formBtn').append("<button class='btn btn-default waves-effect m-b-15' id='btn-refresh'>"+__('刷新')+"</button>");
 
		obj.bindDate();
        obj.getTable();
        obj.event();
    },
    //点击事件
    event: function () 
	{
        var obj = this;
 
        //刷新按钮
        $("#btn-refresh").on('click', function (e) {
            obj.refresh();
        });
		
		//查询
        $("#btn-query,#btn-search").click(function () {
            obj.refresh();
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
            $("#inventory_id").val("");
            obj.refresh();
        });
    },
    getTable: function () 
	{
        var obj = this;
		
		$("#tableWrapper").bootstrapTable('destroy').bootstrapTable({
            url:SYS.CONFIG.index_url + '?ctl=Goods_Allot&met=lists&typ=json',
			method:'post',
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
			queryParams: function queryParams(params) {
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize,
					inventory_id: $('#inventory_id').val(),
                    inventory_type:$("#inventory_type").val() - 0,
					beginDate:$("#rangetime").val().split(__(' 至 '))[0] == undefined ? "" : $("#rangetime").val().split(__(' 至 '))[0],
					endDate:$("#rangetime").val().split(__(' 至 '))[1] == undefined ? "" : $("#rangetime").val().split(__(' 至 '))[1]
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "inventory_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getColumns(),
            formatLoadingMessage: function(){return "";},
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			},
			onDblClickRow: function (data) {
                obj.showDetail(data);
            },
        });
    },
    getColumns: function () 
	{
        var obj = this;
        var columns = [
            { field: 'inventory_id', title: __('订单号'), align: 'left', halign: 'left', width: '8%' },
            { field: 'inventory_number', title: __('数量'), align: 'left', halign: 'left', width: '5%' },
			{ field: 'inventory_amount', title: __('金额'), align: 'left', halign: 'left', width: '5%' },
			{ field: 'inventory_add_time', title: __('创建时间'), align: 'left', width: "8%", halign: 'left' },
			{
				field: '', title:__('操作') , align: 'left', halign: 'left', width: '12%', formatter: function (value, row, index) {
					var fo = '<button type="button" onclick="AllotIn.confirmOrder(\'' + row.inventory_id + '\''+ ',\'' + 0 + '\')" class="btn b-racius3 btn-default waves-effect btn-xs m-r-5"><i class="fa fa-chain"></i> <span>'+__('到货确认')+'</span></button>';

					return fo;
				}
			}
        ];
        return columns;
    },
    refresh: function () {
        var obj = this;
        obj.getTable();
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
	//订单详情
	showDetail: function (data) {
        var obj = this;
 
        $("#orderGoodsForm").setForm(data);
        $("#orderModal").modal({ backdrop: 'static', keyboard: false });
        $('#orderGoods').bootstrapTable('destroy');
        obj.getOrderGoods(data.inventory_id);
		if(data.supplier_id)
		{
			$('#supplier').show();
			obj.getSupplierInfo(data.supplier_id);
		}else{
			$('#supplier').hide();
		}
		
		if(data.order_id)
		{
			$('#seller_order_id').show();
		}else{
			$('#seller_order_id').hide();
		}
    },
    //点击显示商品getOrderGoods
    getOrderGoods: function (id) {
        var obj = this;
        $('#orderGoods').bootstrapTable({
			ajax : function (request) {
				$.ajax({
					type : "GET",
					url : SYS.CONFIG.index_url + '?ctl=Goods_Inventory&met=inventoryDetail&typ=json',
					contentType: "application/json;charset=utf-8",
					dataType:"json",
					data:{ inventory_id: id},
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
			formatLoadingMessage: function(){
                return "";
            }
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
            field: 'goods_price', title: __('进货价'), align: 'left', halign: 'left', width: '15%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
        columns.push({
            field: 'goods_quantity', title: __('数量'), align: 'left', halign: 'left', width: '15%'
        });
        columns.push({
            field: 'goods_amount', title: __('总费用'), align: 'left', halign: 'left', width: '15%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
        return columns;
    },
    //获取会员状态信息
    getSupplierInfo: function (supplier_id) {
        var obj = this;
         $.ajax({
            type: "post",
            url: SYS.CONFIG.index_url + '?ctl=Goods_Supplier&met=manage&typ=json',
            data: { supplier_id: supplier_id},
            async: false,
            dataType:'json',
            success: function (res) {
                var data = res.data;
                if (data.supplier_id) 
				{
                    $("#supplier_name").val(data.supplier_name);  
					$("#supplier_code").val(data.supplier_code);                 
                }
            }
        });
    },
	//调拨确认
	confirmOrder: function(id){
		var obj = this;
		var postData = {};
		postData.inventory_id = id;
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Allot&met=allotConfirm&typ=json',
            type: 'post',
            dataType: "json",
            data: postData,
            success: function (data) {
                if (data && data.status == 200) 
				{
                    alertMessage(__("操作成功"));         
                }
                else {
                    alertError(json.msg);
                }
            }
        });
	}
}