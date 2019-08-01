$(function () {
    memManager.init();
});
var memName = "";
var memManager = {
	init: function(){
		var obj = this;
		obj.getTableData();
		obj.getExcel();
        obj.event();
	},
	event: function(){
		var obj = this;
		
		//刷新页面
		$("#btn-refresh").bind('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Member_Info&met=index&typ=e';
        });
		
		//新增会员
        $("#btn-add").bind('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Member_Info&met=manage&typ=e';
        });
		
		$("#edt_Quick").bind('click', function () {
            memName = $("#edt_CardID").val();
            obj.refresh();
        })

        $("#edt_CardID").bind('keydown', function (event) {
            event = arguments.callee.caller.arguments[0] || window.event
            if (event.keyCode == 13) {
                memName = $("#edt_CardID").val();
                obj.refresh();
            }
        })
        $("#edt_Reset").bind('click', function () {
            $("#edt_CardID").val("");
			$("#edt_Sex").val("");
			$("#edt_Level").val("");
            obj.refresh();
        })
		
		//会员导入
		$('#btn-import').bind('click',function(){
			obj.importModel();
		})
		
		//导入按钮
		$("#Tolead_Submit").bind('click', function () {
			obj.importData();
		});
		
		$("#search").bind('click', function () {
            obj.refresh();
        });
	},
	//获取数据
	getTableData: function()
	{
		var obj = this;
		
		$("#tableWrapper").bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Member_Info&met=lists&typ=json',
			method: 'post',
            striped: true, 
            pagination: true,
            singleSelect: false,
            queryParamsType: "undefined",
			queryParams: function queryParams(params) {   
                var param = {
                    page: params.pageNumber,
                    rows: params.pageSize,
					memName: memName,
					gender: $('#edt_Sex').val(),
					member_grade_id: $('#edt_Level').val()
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "member_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getColumns(),
			formatLoadingMessage: function(){
                return "";
            },
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			}
        });
	},
    getColumns: function () {
        var columns = [
			{
                field: 'member_account', align: 'left', title: __('会员账号'), halign: 'left', width: "5%"
            },
            {
                field: 'member_card', align: 'left', title: __('会员卡号'), halign: 'left', width: "5%"
            },
            {
                field: 'member_name', title: __('会员姓名'), align: 'left', halign: 'left', width: "5%"
            },
            {
                field: 'member_gender', title: __('性别'), align: 'left', halign: 'left', width: "3%", formatter: function (value, rows, index)
				{
                    switch (value) {
                        case 2:
                            return __("女");
                        case 1:
                            return __("男");
                        default:
                            return __("未知");
                    }
                }
            },
            { field: 'member_mobile', title: __('电话号码'), align: 'left', halign: 'left', width: "5%" },
            { field: 'member_grade_name', title: __('会员等级'), align: 'left', halign: 'left', width: "5%" },
			{
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, rows, index) {
                    var fo = '';
                    
                    fo += '<button type="button" onclick="memManager.manage(\'' + rows.member_id + '\',\'' + rows.State + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa-pencil"></i></button>';
                    fo += '<button type="button" onclick="memManager.remove(\'' + rows.member_id + '\',\'' + rows.member_card + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs"><i class="fa fa-trash-o"></i> </button>';
                    return fo;
                }
            }
            ];
        return columns;
    },
    //刷新
    refresh: function () {
        var obj = this;
        obj.getTableData();
    },
	manage: function(id,state)
	{
		window.location.href = SYS.CONFIG.index_url + '?ctl=Member_Info&met=manage&typ=e&id='+id;
	},
	remove: function(id,name)
	{
		var obj = this;
        Layer.confirm({ message: __('是否确定删除会员：') + name + '？' }).on(function (e)
		{
            if (!e) {return;}
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Member_Info&met=remove&typ=json',
                data: {
                    member_id: id
                },
                type: "post",
                async: true,
                dataType: 'json',
                success: function (data) {
                    if (data && data.status == 200) 
					{
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
	//下载Excel模板
	getExcel: function () 
	{
		$.ajax({
			url: SYS.CONFIG.index_url + '?ctl=Member_Excel&met=member&typ=json',
			data: {},
			type: 'get',
			async: false,
			dataType:'json',
			success: function (data) 
			{
				$("#Down").attr('href', data.data.filepath);
			}
		})
	},
	importModel: function()
	{
		$("#ToleadLabel").html(__("会员批量导入"));
		$('#ToleadModal').modal({ backdrop: 'static', keyboard: false });
	},
	//导入事件
	importData: function () 
	{
		var obj = this;
		var t = $('input[name="filedata"]').val();
		if(!t)
		{
			alertError(__('请先上传文件！'));//失败
			return false;
		}		
		var formData = new FormData();
		formData.append('filedata', $('#file-upload')[0].files[0]);
       
		$.ajax({
			url: SYS.CONFIG.index_url + '?ctl=Member_Excel&met=memberImport&typ=json',
			data: formData,
			type: "POST",
			processData : false, 
			contentType : false,
			async: false,
			dataType: 'json',
			success:function(e)
			{
				if(e.status == 200)
				{
					alertMessage(__("操作成功"));
					$('#ToleadModal').modal('hide')
					obj.refresh();
				}else{
					alertError(e.msg);//失败
					return false;
				}	
			}
		});
		
		return false;
	}
}