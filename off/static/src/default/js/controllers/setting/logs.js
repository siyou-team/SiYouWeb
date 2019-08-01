jQuery(document).ready(function ($) {
    Log.init();
})
var Log = {
    init: function () {
        var obj = this;
        obj.bindDate();

        //最近一周
        var today = new Date();
        var getDate = today.getTime();
        var LastWeek = new Date(getDate).format("yyyy-MM-dd");
        var Today = today.format("yyyy-MM-dd");
        $('#reservationtime').val(LastWeek + __('至') + Today);
        obj.getTable();

        $("#btnReset").click(function () 
		{
            $("#reservationtime").val(LastWeek + __('至') + Today);
            obj.Refresh();
        });
        $("#btnSelect").click(function () {
            obj.Refresh();
        });
    },
    //绑定时间控件
    bindDate: function () {
        $('#reservationtime').daterangepicker({
            format: 'yyyy-MM-DD',
            separator: __('至'),
            start: "", //开始时间，在这时间之前都不可选
            end: "",//结束时间，在这时间之后都不可选
            showDropdowns: true,
        });
    },
    //绑定table数据
    getTable: function () {
        var obj = this;
        var pageSize = 10;
        $('#tableWrapper').bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Setting_Log&met=lists&typ=json',         //请求后台的URL（*）
            method: 'get',                      //请求方式（*）
            toolbar: "#toolbar",                //工具按钮用哪个容器
            striped: true,                      //是否显示行间隔色
            pagination: true,                   //是否显示分页（*）
            singleSelect: true,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {   
				//查询参数
                var param = {
                    bTime: $("#reservationtime").val().split(__('至'))[0] == "" ? "" : $("#reservationtime").val().split(__('至'))[0],
                    eTime: $("#reservationtime").val().split(__('至'))[1] == undefined ? "" : $("#reservationtime").val().split(__('至'))[1],
                    PageIndex: params.pageNumber,
                    PageSize: params.pageSize
                };
                return param;
            },
            sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                       //初始化加载第一页，默认第一页
            pageSize: pageSize,                       //每页的记录行数（*）
            pageList: [10, 20, 50, 100],        //可供选择的每页的行数（*）
            showColumns: false,                  //是否显示所有的列
            minimumCountColumns: 2,             //最少允许的列数
            uniqueId: "log_id",                     //每一行的唯一标识，一般为主键列
            editable: true,
            clickToSelect: true,
            columns: obj.getColumns(),
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
    //绑定table列
    getColumns: function () {
        var obj = this;
        var columns = [];
        columns.push({
            field: 'user_name', title: __('帐号'), align: 'left', halign: 'left', width: '5%'
        });
        columns.push({
            field: 'log_id', title: __('操作员'), align: 'left', halign: 'left', width: '5%'
        });
        columns.push({
            field: 'log_ip', title: __('IP地址'), align: 'left', halign: 'left', width: '5%'
        });
        columns.push({
            field: 'log_time', title: __('创建时间'), align: 'left', halign: 'left', width: '5%'
        });
        columns.push({
            field: 'log_content', title: __('操作日志'), align: 'left', halign: 'left', width: '20%'
        });
        return columns;
    },
    //刷新table
    Refresh: function () {
        $("#tableWrapper").bootstrapTable('refresh');
    }
}