jQuery(document).ready(function ($) {
    goodsCombo.init();
});
var goodsCombo = {
    init: function () 
	{
        var obj = this;

        obj.getTable();
        obj.event();
    },
    event: function () {
        var obj = this;
		
		$('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-add'>"+__('新增')+" <i class='fa fa-plus'></i></button>&nbsp;&nbsp;");
 
        $('#form-btn').append("<button class='btn btn-default waves-effect m-b-15 m-r-10' id='btn-refresh'>"+__('刷新')+"</button>");
 
        $("#btn-query").bind('click', function () {
            obj.refresh();
        });
        $("#btn-refresh").bind('click', function () {
            obj.refresh();
        });
        $("#btn-add").bind('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=comboManage&typ=e';
        });

		$("#combo_code").focus();
        $("#combo_code").on('keydown', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                obj.refresh();
            }
        });
    },
    refresh: function () {
        var obj = this;
        obj.getTable();
    },
    getTable: function () {
        var obj = this;
        var pageSize = 10;
        $("#tableWrapper").bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=lists&typ=json',
            method: 'get',
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {   
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize,
                    combo_code: $("#combo_code").val().trim()
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: pageSize,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "combo_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getColmuns(),
			formatLoadingMessage: function(){return "";},
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			}
        });
    },
    getColmuns: function () {
        var colmuns = [
            { field: 'combo_code', title: __('套餐编号'), align: 'left', halign: 'left', width: "15%" },
            { field: 'combo_name', title: __('套餐名称'), align: 'left', halign: 'left', width: "15%" },
            { field: 'combo_goods_number', title: __('产品种数'), align: 'left', halign: 'left', width: "15%" },
            {
                field: 'combo_price', title: __('销售价格'), align: 'left', halign: 'left', width: "15%", formatter: function (value, Index, field) {
                    return '<font style="color:red">'+__('￥') + value + '</font>';
                }
            },
            {
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, row, index) {
                    var fo = '';
                    fo += ' <button onclick="goodsCombo.editCombo(\'' + row.combo_id + '\')"  class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"> <i class="fa fa-pencil"></i></button>';
               
                    fo += '<button onclick="goodsCombo.deleteCombo(\'' + row.combo_id + '\',\'' + row.combo_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs"> <i class="fa fa-trash-o"></i></button>';
                    return fo;
                }
            }];
        return colmuns;
    },
    editCombo: function (id) {
        window.location.href = SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=comboManage&typ=e&combo_id='+id;
    },
    deleteCombo: function (id, name) {
        var obj = this;
        Layer.confirm({ message: __('是否确定删除：') + name + '？' }).on(function (e) {
            if (!e) 
			{
                return;
            }
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Goods_Combo&met=remove&typ=json',
                data: {
                    combo_id: id
                },
                type: "post",
                async: true,
				dataType: 'json',
                success: function (data) 
				{
                    if (data && data.status == 200) 
					{
                        alertMessage(__("删除成功"));
                        obj.refresh();
                    }
                    else {
                        alertError(__("删除失败：") + data.lastErr);
                    }
                }
            });
        });
    }
}