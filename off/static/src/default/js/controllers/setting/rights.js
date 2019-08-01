jQuery(document).ready(function ($) 
{
    Rights.init();
});
var Rights = {
	rights_group_id:0,
	init: function(){
		var obj = this;
		obj.getTableData();
        obj.event();

		obj.zTreeConfig();
		obj.zTreeRightsInit();
	},
	event: function(){
		var obj = this;
		
		$('#formBtn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-add'>"+__('新增')+" <i class='fa fa-plus'></i></button>&nbsp;&nbsp;");
		
		$('#formBtn').append("<button class='btn btn-default waves-effect m-b-15 m-r-10' id='btn-refresh'>"+__('刷新')+"</button>");
		
		//刷新页面
		$("#btn-refresh").bind('click', function () {
            window.location.href = SYS.CONFIG.index_url + '?ctl=Setting_Rights&met=index&typ=e';
        });
		
		//新增会员
        $("#btn-add").bind('click', function () {
           obj.manage();
        });
		
		$("#rightsGroupForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                rights_group_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("名称不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 50,
                                message: __('名称长度为1~50位')
                            }
                        }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var param = $('#rightsGroupForm').serializeObject();
            param.rights_group_id = obj.rights_group_id;
			
			var met = obj.rights_group_id ? 'edit':'add'; 
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Setting_Rights&met='+met+'&typ=json',
                data: param,
                dataType: "json",
                type: "POST",
                async: true,
                success: function (data) {
                    if (data && data.status == 200) 
					{
                        alertMessage(data.msg);
                        $('#rightsGroupForm').data('bootstrapValidator').resetForm(true);//验证重置
                        obj.refresh();
                        $('#editModel').modal('hide');
                    }
                    else {
                        alertError(data.msg);
                    }
                }
            });
        });
		
		//角色权限修改
        $("#rightsForm").bootstrapValidator({
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var rights_ids = "";
            var zTreeRights = $.fn.zTree.getZTreeObj("zTreeRights");
            var nodes = zTreeRights.getChangeCheckedNodes(true);
            if (nodes.length > 0) {
                for (var i = 0; i < nodes.length; i++) {
                    rights_ids += nodes[i].rights_id; //获取每个节点的id
                    rights_ids += ",";
                }
				
				$.ajax({
					url: SYS.CONFIG.index_url + '?ctl=Setting_Rights&met=editGroupRights&typ=json',
					type: "post",
					async: false,
					data: {rights_ids: rights_ids, rights_group_id: obj.rights_group_id},
					dataType: 'json',
					success: function (data)
					{
						if (data && data.status == 200)
						{
							alertMessage(data.msg);
							$('#rightsModel').modal('hide');
							$('#rightsForm').data('bootstrapValidator').resetForm(true);//验证重置
							$("#rightsForm")[0].reset();
						}
						else {
							alertError(data.msg);
						}
					}
				});
            }
            else {
                $("#btnSave").removeAttr("disabled");
                alertError("请设置权限！");
            }
        });
	},
	//获取数据
	getTableData: function()
	{
		var obj = this;
 
        $("#tableWrapper").bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Setting_Rights&met=lists&typ=json',
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
            uniqueId: "rights_group_id",
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
                field: 'rights_group_name', align: 'left', title: __('角色名称'), halign: 'left', width: "5%"
            },
            {
                field: 'group_add_time', title: __('创建时间'), align: 'left', halign: 'left', width: "5%"
            },
			{
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, rows, index) {
                    var fo = '';
                    fo += '<button type="button" onclick="Rights.rightsGroup(\'' + rows.rights_group_id + '\',\'' + rows.rights_group_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa fa-cog fa-fw"></i> </button>';
                    fo += '<button type="button" onclick="Rights.manage(\'' + rows.rights_group_id + '\',\'' + rows.rights_group_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa-pencil"></i></button>';
                    fo += '<button type="button" onclick="Rights.remove(\'' + rows.rights_group_id + '\',\'' + rows.rights_group_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs"><i class="fa fa-trash-o"></i> </button>';
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
                url: SYS.CONFIG.index_url + '?ctl=Setting_Rights&met=remove&typ=json',
                data: {
                    rights_group_id: id
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
			obj.rights_group_id = id;		
			var row = $("#tableWrapper").bootstrapTable('getRowByUniqueId', id);
			$("#rightsGroupForm").setForm(row);
			
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
    },
	zTreeConfig: function()
	{
		setting = {
            check: {
                enable: true,
                chkboxType: { "Y": "ps", "N": "s" },
                chkStyle: "checkbox",
            },
            view: {
                expandSpeed: 300,
            },
            data: {
                simpleData: {
                    enable: true,
                    idKey: "rights_id",
                    pIdKey: "rights_parent_id",
                    rootPId: ""
                },
                key: {
                    name: "rights_name"
                }
            }
        };
	},
    //当前权限组权限
    rightsGroup: function (rights_group_id) {
        var obj = this;
        obj.rights_group_id = rights_group_id;
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Setting_Rights&met=groupRights&typ=json',
            data: {rights_group_id: rights_group_id},
            type: "get",
            async: false,
			dataType: 'json',
            success: function (data) 
			{
				var data = data.data;
                if (data.length > 0) {
                    var zTreeRights = $.fn.zTree.getZTreeObj("zTreeRights");
                    zTreeRights.checkAllNodes(false);
                    for (var i = 0; i < data.length; i++) {
						if(data[i])
						{
							var node = zTreeRights.getNodeByParam("rights_id", data[i]);
							if (node != null) {
								zTreeRights.checkNode(node, true, false);
							}
						}
                    }
                }
            }
        });
        $('#rightsModel').modal({ backdrop: 'static', keyboard: false });
    },
    //权限列表
    zTreeRightsInit: function () {
		var obj = this;
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Setting_Rights&met=rightsLists&typ=json',
            data: {},
            type: "post",
            async: false,
			dataType: 'json',
            success: function (data) 
			{
				data = data.data;
				var zTreeRightsInit = $.fn.zTree.init($("#zTreeRights"), setting, data.items);
				zTreeRightsInit.expandAll(true); //默认全部展开	 
			}
		})
    }
}