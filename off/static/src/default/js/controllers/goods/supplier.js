jQuery(document).ready(function ($) 
{
    Supplier.init();
});
var Supplier = {
	supplier_id:0,
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
            window.location.href = SYS.CONFIG.index_url + '?ctl=Goods_Supplier&met=index&typ=e';
        });
		
		//新增会员
        $("#btn-add").bind('click', function () {
           obj.manage(0,'');
        });
		
		$("#supplierForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                supplier_name: {
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
                },
				supplier_contactor: {
                    validators:
                        {
                            notEmpty: {
                                message: __("联系人不能为空")
                            }
                        }
                },
				supplier_telephone: {
                    validators:
                        {
                            notEmpty: {
                                message: __("联系电话不能为空")
                            }
                        }
                },
				supplier_address: {
                    validators:
                        {
                            notEmpty: {
                                message: __("联系地址不能为空")
                            }
                        }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var param = $('#supplierForm').serializeObject();
            param.supplier_id = obj.supplier_id;
			var met = obj.supplier_id ? 'edit':'add';
			
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Goods_Supplier&met='+met+'&typ=json',
                data: param,
                dataType: "json",
                type: "POST",
                async: true,
                success: function (data) {
                    if (data && data.status == 200) 
					{
                        alertMessage(data.msg);
                        $('#supplierForm').data('bootstrapValidator').resetForm(true);//验证重置
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
            url: SYS.CONFIG.index_url + '?ctl=Goods_Supplier&met=lists&typ=json',
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
            uniqueId: "supplier_id",
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
                field: 'supplier_code', align: 'left', title: __('供应商编号'), halign: 'left', width: "5%"
            },
            {
                field: 'supplier_name', align: 'left', title: __('供应商名称'), halign: 'left', width: "5%"
            },
            {
                field: 'supplier_contactor', title: __('联系人'), align: 'left', halign: 'left', width: "5%"
            },
            {
                field: 'supplier_telephone', title: __('联系电话'), align: 'left', halign: 'left', width: "5%"
            },
			{
				field: 'supplier_address',title: __('联系地址'),align: 'left',halign: 'left',width: '15%',
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
					return ' <a onmouseover="Supplier.ShowPopover(this,' + fal + ')"  data-toggle="popover" data-trigger="hover" data-placement="bottom"  data-html="true" data-content="<div class=context_main>' + valueStr + '</div>">' + val + '</a>';
				}
			},
            {
                field: 'supplier_add_time', title: __('创建时间'), align: 'left', halign: 'left', width: "5%"
            },
			{
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", formatter: function (value, rows, index) {
                    var fo = '';
                    
                    fo += '<button type="button" onclick="Supplier.manage(\'' + rows.supplier_id + '\',\'' + rows.supplier_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa-pencil"></i></button>';
                    fo += '<button type="button" onclick="Supplier.remove(\'' + rows.supplier_id + '\',\'' + rows.supplier_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs"><i class="fa fa-trash-o"></i> </button>';
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
                url: SYS.CONFIG.index_url + '?ctl=Goods_Supplier&met=remove&typ=json',
                data: {
                    supplier_id: id
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
			obj.supplier_id = id;		
			var row = $("#tableWrapper").bootstrapTable('getRowByUniqueId', id);
			$("#supplierForm").setForm(row);
			
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