jQuery(document).ready(function ($) 
{
    Staff.init();
});
var Staff = {
	staff_id:0,
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
            window.location.href = SYS.CONFIG.index_url + '?ctl=Setting_Staff&met=index&typ=e';
        });
		
		//新增会员
        $("#btn-add").bind('click', function () {
           obj.manage(0,'');
        });
		
		$("#staffForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                staff_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("员工姓名不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 50,
                                message: __('员工姓名长度为1~50位')
                            }
                        }
                },
				staff_mobile: {
                    validators:
                        {
                            notEmpty: {
                                message: __("手机号码不能为空")
                            }
                        }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var param = $('#staffForm').serializeObject();
            param.staff_id = obj.staff_id;
			var met = obj.staff_id ? 'edit':'add';
			var staff_gender = 0;
			
			if ($('#edt_Male').is(':checked')) {
				var staff_gender = 1;
			}
			
			if ($('#edt_FeMale').is(':checked')) {
				var staff_gender = 2;
			}
			param.staff_gender = staff_gender;
			
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Setting_Staff&met='+met+'&typ=json',
                data: param,
                dataType: "json",
                type: "POST",
                async: true,
                success: function (data) {
                    if (data && data.status == 200) 
					{
                        alertMessage(data.msg);
                        $('#staffForm').data('bootstrapValidator').resetForm(true);//验证重置
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
            url: SYS.CONFIG.index_url + '?ctl=Setting_Staff&met=lists&typ=json',
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
            uniqueId: "staff_id",
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
                field: 'staff_name', align: 'left', title: __('员工姓名'), halign: 'left', width: "5%"
            },
            {
                field: 'staff_mobile', title: __('手机号码'), align: 'left', halign: 'left', width: "5%"
            },
            {
                field: 'staff_department_name', title: __('所在部门'), align: 'left', halign: 'left', width: "5%"
            },
			{
				field: 'staff_address',title: __('员工地址'),align: 'left',halign: 'left',width: '15%',
				formatter: function (value, row, index) {
					var val = value;
					var valueStr = "";
					var fal = 0;
					if (val.length <= 12) {
						val = val;
					} else {
						valueStr = val;
						val = val.substr(0, 12) + '...';
						fal = 1;
					}
					return ' <a onmouseover="Staff.ShowPopover(this,' + fal + ')"  data-toggle="popover" data-trigger="hover" data-placement="bottom"  data-html="true" data-content="<div class=context_main>' + valueStr + '</div>">' + val + '</a>';
				}
			},
            {
                field: 'staff_add_time', title: __('创建时间'), align: 'left', halign: 'left', width: "5%"
            },
			{
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, rows, index) {
                    var fo = '';
                    
                    fo += '<button type="button" onclick="Staff.manage(\'' + rows.staff_id + '\',\'' + rows.staff_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa-pencil"></i></button>';
                    fo += '<button type="button" onclick="Staff.remove(\'' + rows.staff_id + '\',\'' + rows.staff_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs"><i class="fa fa-trash-o"></i> </button>';
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
                url: SYS.CONFIG.index_url + '?ctl=Setting_Staff&met=remove&typ=json',
                data: {
                    staff_id: id
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
			obj.staff_id = id;		
			var row = $("#tableWrapper").bootstrapTable('getRowByUniqueId', id);
			$("#staffForm").setForm(row);
			
            $("#myModalLabel").html(__("修改"));
        }
        else {
            $("#myModalLabel").html(__("新增"));
            $("form")[0].reset();
        }
        $('#editModel').modal({ backdrop: 'static', keyboard: false });
	},
    ShowPopover: function (ID, fal) {
        if (fal == 1) {
            $(ID).popover("show");
        }
    }
}