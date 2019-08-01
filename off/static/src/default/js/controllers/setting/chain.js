jQuery(document).ready(function ($) 
{
    Chain.init();
});
var Chain = {
	chain_id:0,
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
            window.location.href = SYS.CONFIG.index_url + '?ctl=Setting_Role&met=index&typ=e';
        });
		
		//新增会员
        $("#btn-add").bind('click', function () {
           obj.manage(0,'');
        });
		
		$("#chainForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                user_account: {
                    validators:
                        {
                            notEmpty: {
                                message: __("账号不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 50,
                                message: __('长度为1~50位')
                            },
                            regexp: {/* 只需加此键值对，包含正则表达式，和提示 */
                                regexp: /^[A-Za-z0-9]+$/,
                                message: __("账号只能为数字和字母")
                            }
                        }
                },
                user_password: {
                    validators:
                        {
                            notEmpty: {
                                message: __("密码不能为空")
                            },
                            stringLength: {/*长度提示*/
                                min: 6,
                                max: 20,
                                message: __("密码长度必须在6到20之间")
                            },
							regexp: {/* 只需加此键值对，包含正则表达式，和提示 */
                                regexp: /^[A-Za-z0-9]+$/,
                                message: __("只能为数字和字母")
                            }
                        }						
                },
                repassword: {
                    validators:
                        {
                            notEmpty: {
                                message: __("确认密码不能为空")
                            },
                            stringLength: {/*长度提示*/
                                min: 6,
                                max: 20,
                                message: __("密码长度必须在6到20之间")
                            },
                            identical: {//相同
                                field: 'user_password',
                                message: __("两次密码不一致")
                            }
                        }
                },
                rights_group_id: {
                    validators:
                        {
                            notEmpty: {
                                message: __("请选择角色")
                            }
                        }
                },
				chain_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("名称不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 50,
                                message: __('长度为1~50位')
                            }
                        }
                },
				chain_telephone: {
                    validators:
                        {
                            notEmpty: {
                                message: __("联系电话不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 20,
                                message: __('长度为1~20位')
                            }
                        }
                },
				chain_contacter: {
                    validators:
                        {
                            notEmpty: {
                                message: __("联系人不能为空")
                            },
                            stringLength: {
                                min: 1,
                                max: 50,
                                message: __('长度为1~50位')
                            }
                        }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var param = $('#chainForm').serializeObject();
            param.chain_id = obj.chain_id;
			
			var met = obj.chain_id ? 'edit':'add';
			var staff_gender = 0;			
			if ($('#edt_Male').is(':checked')) {
				var staff_gender = 1;
			}
			
			if ($('#edt_FeMale').is(':checked')) {
				var staff_gender = 2;
			}
			param.staff_gender = staff_gender;
			
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Setting_Chain&met='+met+'&typ=json',
                data: param,
                dataType: "json",
                type: "POST",
                async: true,
                success: function (data) {
                    if (data && data.status == 200) 
					{
                        alertMessage(data.msg);
                        $('#chainForm').data('bootstrapValidator').resetForm(true);//验证重置
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
            url: SYS.CONFIG.index_url + '?ctl=Setting_Chain&met=lists&typ=json',
			method: 'post',
            striped: true, 
            pagination: true,
            singleSelect: false,
            queryParamsType: "undefined",
			queryParams: function queryParams(params) {   
                var param = {
                    page: params.pageNumber,
                    rows: params.pageSize
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "chain_id",
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
                field: 'chain_name', align: 'left', title: __('分店名称'), halign: 'left', width: "5%"
            },
			{
                field: 'chain_contacter', title: __('联系人'), align: 'left', halign: 'left', width: "5%"
            },
            {
                field: 'chain_telephone', title: __('联系电话'), align: 'left', halign: 'left', width: "5%"
            },
            {
                field: 'chain_address', title: __('门店地址'), align: 'left', halign: 'left', width: "5%",
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
					return ' <a onmouseover="Chain.showPopover(this,' + fal + ')"  data-toggle="popover" data-trigger="hover" data-placement="bottom"  data-html="true" data-content="<div class=context_main>' + valueStr + '</div>">' + val + '</a>';
				}
            },
            {
                field: 'chain_time', title: __('创建时间'), align: 'left', halign: 'left', width: "5%"
            },
			{
                field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "5%", formatter: function (value, rows, index) {
                    var fo = '';
                    
                    fo += '<button type="button" onclick="Chain.manage(\'' + rows.chain_id + '\',\'' + rows.user_account + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"><i class="fa fa-pencil"></i></button>';

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
	},
	manage: function(id,state)
	{
		var obj = this;

        if(id) 
		{
			$("#account_info").hide();
			obj.chain_id = id;
			$("#user_account").attr("disabled", true);
			if($("#user_password").val() == '')
			{
				$("#chainForm").bootstrapValidator('removeField','user_password');
				$("#chainForm").bootstrapValidator('removeField','repassword');
			}
			
			var row = $("#tableWrapper").bootstrapTable('getRowByUniqueId', id);
			$("#chainForm").setForm(row);
			
            $("#myModalLabel").html(__("修改门店信息"));
        }
        else {
			$("#account_info").show();
            $("#myModalLabel").html(__("新增"));
            $("form")[0].reset();
        }
        $('#editModel').modal({ backdrop: 'static', keyboard: false });
	},
    showPopover: function (ID, fal) {
        if (fal == 1) {
            $(ID).popover("show");
        }
    }
}