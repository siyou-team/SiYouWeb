$(function () {
    memGrade.init();
});

var memGrade = {
	member_grade_id:0,
	init: function(){
		var obj = this;
		obj.getTableData();
        obj.event();
	},
	event: function(){
		var obj = this;
		
		$("#btn-refresh").bind('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Member_Grade&met=index&typ=e';
        });
		
		//新增
        $("#btn-add").bind('click', function () {
           obj.manage(0,'');
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
            $("#searchForm")[0].reset();
            $("#edt_CardID").val("");
            obj.refresh();
        })
		
		$("#memlevelsForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                member_grade_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("等级名称不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 6,
                                message: __('等级名称长度为1~6位')
                            }
                        }

                },
                member_grade_discountrate: {
                    validators: {
                        notEmpty: {
                            message: __("折扣比例不能为空")
                        },
                        regexp: {
                            regexp: /^(0\.(?!0+$)\d{1,2}|1(\.0{1,2})?)$/,
                            message: __("折扣输入不正确，请输入大于0小于等于1的数字 且最多2位小数")
                        }
                    }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var param = $('#memlevelsForm').serializeObject();
            param.member_grade_id = obj.member_grade_id;

			if(obj.member_grade_id)
			{
				var met = 'edit';
			}else{
				var met = 'add';
			}
			
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Member_Grade&met='+met+'&typ=json',
                data: param,
                dataType: "json",
                type: "POST",
                async: true,
                success: function (data) {
                    if (data && data.status == 200) 
					{
                        alertMessage(data.msg);
                        $('#memlevelsForm').data('bootstrapValidator').resetForm(true);//验证重置
                        obj.refresh();
                        $('#editMemlevelModel').modal('hide');
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
            url: SYS.CONFIG.index_url + '?ctl=Member_Grade&met=lists&typ=json',
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
            uniqueId: "member_grade_id",
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
                field: 'member_grade_name', align: 'left', title: __('等级名称'), halign: 'left', width: "5%"
            },
            {
                field: 'member_grade_discountrate', title: __('等级折扣'), align: 'left', halign: 'left', width: "5%"
            },
            { field: 'member_grade_pointsrate', title: __('积分兑换比例'), align: 'left', halign: 'left', width: "5%" },
            { field: 'member_grade_desc', title: __('等级描述'), align: 'left', halign: 'left', width: "5%" },
			{
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, rows, index) {
                    var fo = '';
                    
                    fo += '<button type="button" onclick="memGrade.manage(\'' + rows.member_grade_id + '\',\'' + rows.member_grade_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa-pencil"></i></button>';
                    fo += '<button type="button" onclick="memGrade.remove(\'' + rows.member_grade_id + '\',\'' + rows.member_grade_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs"><i class="fa fa-trash-o"></i> </button>';
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
		var obj = this;
		
        if(id) 
		{
			obj.member_grade_id = id;
			
			var row = $("#tableWrapper").bootstrapTable('getRowByUniqueId', id);
			alert('3');
			console.log(row);
			$("#memlevelsForm").setForm(row);
			
            $("#myModalLabel").html(__("修改"));
        }
        else {
            $("#myModalLabel").html(__("新增"));
            $("form")[0].reset();
        }
        $('#editMemlevelModel').modal({ backdrop: 'static', keyboard: false });
	},
	remove: function(id,name)
	{
		var obj = this;
        Layer.confirm({ message: __('是否确定删除等级：') + name + '？' }).on(function (e)
		{
            if (!e) {return;}
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Member_Grade&met=remove&typ=json',
                data: {
                    member_grade_id: id
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
	}
}