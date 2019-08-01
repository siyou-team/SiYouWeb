$(function () {
    OnlineOrder.init();
});
var OnlineOrder = {
    init: function ()
    {
        var obj = this;
        obj.bindDate();
        obj.getTable();
 
        //筛选更多div显示时 隐藏查询按钮
        $("#btn-all").click(function (){
            if (document.getElementById("ScreenDiv").className == "collapse") {
                $("#btn-query").hide();
            } else {
                $("#btn-query").show();
            }
        });
		
		//查询
        $("#btn-query,#btn-search").click(function () {
            obj.refresh(""); 
        });
		
        //重置
        $("#btn-reset").bind('click', function () {
            $("#order_id").val("");
            obj.refresh("");
        });    
    },
    //绑定table数据
    getTable: function () 
	{
        var obj = this;
        $('#tableWrapper').bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.admin_url + '?mdu=seller&ctl=Order_Base&met=lists&typ=json',
            striped: true,
            pagination: false,
            toolbar: "#toolbar",
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {
                var param = {
                    page: params.pageNumber,
                    rows: params.pageSize,
                    order_id: $('#order_id').val(),
                    order_state_id:$("#order_state_id").val() - 0,
					beginDate:$("#reservationtime").val().split(__(' 至 '))[0] == undefined ? "":$("#reservationtime").val().split(__(' 至 '))[0],
					endDate:$("#reservationtime").val().split(__(' 至 '))[1] == undefined ? "":$("#reservationtime").val().split(__(' 至 '))[1]					
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
            columns: obj.getColumns(),
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			},
			formatLoadingMessage: function(){return "";}
        });
    },
    //绑定table列
    getColumns: function () {
        var obj = this;
        var columns = [];
        columns.push({
            field: 'order_id', title: __('订单号'), align: 'left', halign: 'left', width: '15%'
        });
        columns.push({
            field: 'order_time', title: __('消费时间'), align: 'left', halign: 'left', width: '12%',formatter: function(val,row){
				return obj.getMyDate(row.order_time);
			}
        });
        columns.push({
            field: 'order_state_id', title:__('订单状态') , align: 'left', halign: 'left', width: '8%', formatter: function(val, opt, row) {
				var r = {
					"2010": __("待付款"),
					"2011": __("待订单审核"),
					"2013": __("待财务审核"),
					"2020": __("待配货/待出库审核"),
					"2030": __("待发货"),
					"2040": __("已发货/待收货确认"),
					"2060": __("已完成/已签收"),
					"2070": __("已取消/已作废")
				};
				return r[val];
			}
        });
        columns.push({
            field: 'buyer_user_name', title: __('会员名称'), align: 'left', halign: 'left', width: '8%'
        });
        columns.push({
            field: 'order_payment_amount', title: __('消费金额'), align: 'left', halign: 'left', width: '6%', formatter: function (value)
            { return MoneyPrecision((value - 0).toFixed(2)); }
        });
		
        return columns;
    },
    //绑定时间
    bindDate: function () {
        var obj = this;
        $('#reservationtime').daterangepicker({
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
	getMyDate: function(str)
	{  
		var obj = this;
        var oDate = new Date(1000*parseInt(str)),  
        oYear  = oDate.getFullYear(),  
        oMonth = oDate.getMonth()+1,  
        oDay   = oDate.getDate(),  
        oHour  = oDate.getHours(),  
        oMin   = oDate.getMinutes(),  
        oSen   = oDate.getSeconds(),  
        oTime  = oYear +'-'+ obj.getzf(oMonth) +'-'+ obj.getzf(oDay) +' '+ obj.getzf(oHour) +':'+ obj.getzf(oMin) +':'+ obj.getzf(oSen);//最后拼接时间 
        return oTime;  
    },
    //补0操作
    getzf: function(num){  
        if(parseInt(num) < 10){  
            num = '0'+num;  
        }  
        return num;  
    }
}