jQuery(document).ready(function ($) 
{
    Department.init();
});
var Department = {
	department_id:0,
	init: function(){
		var obj = this;
		obj.getTableData();
        obj.event();
	},
	event: function(){
		var obj = this;
		
		$('#formBtn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-add'>"+__('新增')+" <i class='fa fa-plus'></i></button>&nbsp;&nbsp;");
		
		$('#formBtn').append("<button class='btn btn-default waves-effect m-b-15 m-r-10' id='btn-refresh'>"+__('刷新')+"</button>");
		
		//刷新页面
		$("#btn-refresh").bind('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Setting_Department&met=index&typ=e';
        });
		
		//新增会员
        $("#btn-add").bind('click', function () {
           obj.manage(0,'');
        });
		
		$("#departmentForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                department_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("部门名称不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 20,
                                message: __('部门名称长度为1~20位')
                            }
                        }

                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var param = $('#departmentForm').serializeObject();
            param.department_id = obj.department_id;

			var met = obj.department_id ? 'edit':'add'; 
			if ($('#department_enable').is(':checked')) {
				var department_enable = 1;
			}else{
				var department_enable = 0;
			}
			param.department_enable = department_enable;
			
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Setting_Department&met='+met+'&typ=json',
                data: param,
                dataType: "json",
                type: "POST",
                async: true,
                success: function (data) {
                    if (data && data.status == 200) 
					{
                        alertMessage(data.msg);
                        $('#departmentForm').data('bootstrapValidator').resetForm(true);//验证重置
                        obj.refresh();
                        $('#editModel').modal('hide');
                    }
                    else {
                        alertError(data.msg);
                    }
                }
            });
        });
	},
	//获取数据
	getTableData: function()
	{
		var obj = this;
 
		$("#tableWrapper").bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Setting_Department&met=lists&typ=json',
			method: 'post',
            striped: true, 
            pagination: true,
            singleSelect: false,
            queryParamsType: "undefined",
			queryParams: function queryParams(params) {   
                var param = {
                    PageIndex: params.pageNumber,
                    PageSize: params.pageSize
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "department_id",
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
                field: 'department_id', align: 'left', title: __('部门编号'), halign: 'left', width: "5%"
            },
            {
                field: 'department_name', title: __('部门名称'), align: 'left', halign: 'left', width: "5%"
            },
            {
                field: 'department_enable', title: __('是否启用'), align: 'left', halign: 'left', width: "3%", formatter: function (value, rows, index)
				{
                    switch (value) {
                        case 0:
                            return __("禁用");
                        case 1:
                            return __("启用");
                    }
                }
            },
            {
                field: 'department_add_time', title: __('创建时间'), align: 'left', halign: 'left', width: "5%"
            },
			{
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, rows, index) {
                    var fo = '';
                    
                    fo += '<button type="button" onclick="Department.manage(\'' + rows.department_id + '\',\'' + rows.department_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa-pencil"></i></button>';
                    fo += '<button type="button" onclick="Department.remove(\'' + rows.department_id + '\',\'' + rows.department_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs"><i class="fa fa-trash-o"></i> </button>';
                    return fo;
                }
            }];
        return columns;
    },
    //刷新
    refresh: function () {
        var obj = this;
        obj.getTableData();
    },
	remove: function(id,name)
	{
		var obj = this;
        Layer.confirm({ message: __('是否确定删除：') + name + '？' }).on(function (e)
		{
            if (!e) {return;}
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Setting_Department&met=remove&typ=json',
                data: {
                    department_id: id
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
	manage: function(id,state)
	{
		var obj = this;
		
        if(id) 
		{
			obj.department_id = id;		
			var row = $("#tableWrapper").bootstrapTable('getRowByUniqueId', id);
			$("#departmentForm").setForm(row);
			
            $("#myModalLabel").html(__("修改"));
        }
        else {
            $("#myModalLabel").html(__("新增"));
            $("form")[0].reset();
        }
        $('#editModel').modal({ backdrop: 'static', keyboard: false });
	}
}