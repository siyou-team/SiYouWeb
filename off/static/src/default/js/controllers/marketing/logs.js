$(function () {
    PointsLogs.init();
});
var PointsLogs = {
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
            $("#order_id").val("");
            obj.refresh();
        });
    },
    getTable: function () 
	{
        var obj = this;
		
		$("#tableWrapper").bootstrapTable('destroy').bootstrapTable({
            url:SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=logsList&typ=json',
			method:'post',
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
			queryParams: function queryParams(params) {
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize,
					order_id: $('#order_id').val(),
                    points_type:$("#points_type").val() - 0,
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
            uniqueId: "points_gift_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getColumns(),
            formatLoadingMessage: function(){return "";},
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			}
        });
    },
    getColumns: function () 
	{
        var obj = this;
        var columns = [
            { field: 'points_order_id', title: __('订单号'), align: 'left', halign: 'left', width: '8%' },
            { field: 'user_name', title: __('会员账号'), align: 'left', halign: 'left', width: '5%' },
            { field: 'points', title: __('变动积分'), align: 'left', halign: 'left', width: '5%' },
			{ field: 'points_pre_amount', title: __('变动前积分'), align: 'left', halign: 'left', width: '5%' },
            {
                field: 'points_type_txt', title: __('变动类型'), align: 'left', halign: 'left', width: '5%'
            },
			{ field: 'points_log_time', title: __('变动时间'), align: 'left', width: "8%", halign: 'left' }
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
    }
}