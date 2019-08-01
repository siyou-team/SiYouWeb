$(function () {
    GiftManager.init();
});
var GiftManager = {
    init: function ()
    {
        var obj = this;

        $('#formBtn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-add'>"+__('新增')+" <i class='fa fa-plus'></i></button>&nbsp;&nbsp;");
        $('#formBtn').append("<button class='btn btn-default waves-effect m-b-15' id='btn-refresh'>"+__('刷新')+"</button>");
 
        $("#gift_code").focus();
        obj.getTable();
        obj.event();
    },
    //点击事件
    event: function () 
	{
        var obj = this;

        //新增
        $("#btn-add").on('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=manage&typ=e';
        });
		
        //查询
        $("#btn-query").on('click', function () {
            obj.refresh();
        });

		//礼品编号
        $("#gift_code").on('keydown', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                obj.refresh();
            }
        });
		
        //刷新按钮
        $("#btn-refresh").on('click', function (e) {
            obj.refresh();
        });
    },
    getTable: function () 
	{
        var obj = this;
		
		$("#tableWrapper").bootstrapTable('destroy').bootstrapTable({
            url:SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=lists&typ=json',
			method:'post',
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
			queryParams: function queryParams(params) {
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize,
                    gift_code: $('#gift_code').val()
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
            { field: 'points_gift_code', title: __('礼品编号'), align: 'left', halign: 'left', width: '10%' },
            { field: 'points_gift_name', title: __('礼品名称'), align: 'left', halign: 'left', width: '15%' },
            { field: 'points_gift_stock', title: __('库存数量'), align: 'left', halign: 'left', width: '5%' },
            {
                field: 'points_gift_points', title: __('兑换积分'), align: 'left', halign: 'left', width: '15%', formatter: function (value)
            { return PointPrecision(value); }
            },
            {
                field: '', title: __('操作'), align: 'left', halign: 'left', width: '15%', formatter: function (value, row, index) {
                var _fm = "";
                _fm += '<button onclick="GiftManager.manage(\'' + row.points_gift_id + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"> <i class="fa fa-pencil"></i></button>';

                _fm += '<button onclick="GiftManager.remove(\'' + row.points_gift_id + '\',\'' + row.points_gift_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"> <i class="fa fa-trash-o"></i> </button>';
                return _fm;
            }
            }
        ];
        return columns;
    },
    manage: function (points_gift_id) {
        window.location.href = SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=manage&typ=e&points_gift_id=' + points_gift_id;
    },
    remove: function (points_gift_id, points_gift_name) {
        var obj = this;
        Layer.confirm({ message: __('是否确定删除礼品：') + points_gift_name + '？' }).on(function (e) {
            if (!e) {
                return;
            }
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=remove&typ=json',
                data: {
                    points_gift_id: points_gift_id
                },
                type: "post",
                async: true,
                dataType: 'json',
                success: function (data) {
                    if (data && data.status == 200) {
                        alertMessage(__("删除成功"));
                        obj.refresh();
                    }
                    else {
                        alertError(__("删除失败：") + data.msg);
                    }
                }
            });
        });
    },
    refresh: function () {
        var obj = this;
        obj.getTable();
    }
}