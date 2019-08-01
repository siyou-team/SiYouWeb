jQuery(document).ready(function ($) 
{
    GoodsManager.init();
});

var GoodsManager = 
{
    //初始化
    init: function () 
	{
        var obj = this;
		
		obj.event();        
        obj.initRangDate();
        obj.getTable();
        obj.goodsExcelTemplate();
        obj.topInfo();
    },
    event: function () 
	{
        var obj = this;
 
		//初始化按钮
        $('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-add'>"+__('新增')+" <i class='fa fa-plus'></i></button>&nbsp;&nbsp;");
		$('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-import'>"+__('导入')+"</button>&nbsp;&nbsp;");
		$('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-synchro'>"+__('同步商品')+"</button>&nbsp;&nbsp;");
		$('#form-btn').append("<button class='btn btn-default waves-effect waves-light m-b-15 m-r-10' id='btn-refresh'>"+__('刷新')+" <i class='fa fa-refresh'></i></button>&nbsp;&nbsp;");
		$('#form-btn').append("<button class='btn btn-default waves-effect m-b-15' data-toggle='collapse' href='#ScreenDiv'>"+__('筛选产品')+"</button>&nbsp;&nbsp;");

		//选择输入框
        $("#goodsCode").focus();
		
		//搜索
        $("#btn-query").on('click', function () {
            obj.refresh();
        });
		
		//筛选
		$("#btn-search").on('click', function () {
            obj.refresh();
        });
		
		//刷新
        $("#btn-refresh").on('click', function () {
            obj.refresh();
        });
        
		//新增
        $("#btn-add").on('click', function () 
		{
            window.location.href = SYS.CONFIG.index_url + '?ctl=Goods_Base&met=manage&typ=e';
        });
 
		//导入
        $("#btn-import").on('click', function () {
            obj.importModal();
        });
		
        $("#import-submit").on('click', function () {
            obj.importExcel();
        });
 
        //筛选重置
		$("#btn-reset").on('click', function () {
            $("#searchForm")[0].reset();
            obj.refresh();
        });

		//产品编号筛选
        $("#goodsCode").on('keyup', function () {
            event = arguments.callee.caller.arguments[0] || window.event
            if (event.keyCode == 13) {
                obj.refresh();
            }
        });
 
		//同步商品
		$("#btn-synchro").on('click', function () {
            $('#synchroModal').modal({ backdrop: 'static', keyboard: false });
			$("#synchroHeader").html(__("同步线上商品"));
            $("#synchroModal").show();
        });
		
		$("#synchro-submit").on('click', function () {
            obj.synchroGoods();
        });
		
		$("#goods_total").hide();
		
		//顶部信息
        $("#btn-info").bind('click', function () {
            if ($("#topInfo").is(":hidden")) {
                $("#goods_total").hide();
            } else {
                $("#goods_total").show();
            }
        });
    },
    topInfo: function () {
        var obj = this;
 
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=goodsTopInfo&typ=json',
            data: {},
            type: "post",
            async: true,
			dataType:'json',
            success: function (data) {
                if (data && data.status == 200) {
                    var html = "";
					var data = data.data;

					$("#total").html(data.total);
                    $("#low_num").html(data.low_num); 				
                    $("#stop_num").html(data.stop_num);
					$("#normal").html(data.normal);
                    
                    if (data.warn_num == "" || data.warn_num == null) {
                        $("#warn_num").html(0);
                    } else {
                        $("#warn_num").html(data.warn_num);
                    }
                  
					$("#cost_total").html(returnFloat(data.cost_total));
                    $("#total_num").html(data.total);
					
                    for (var item in data.top3) {
                        html += '<li class="clear list-unstyled"><span class="left text-warning m-r-5">' + "Top" + (parseInt(item) + 1) + '</span>' + '<span class="goodsname" title="'+ data.top3[item].goods_name +'">' + data.top3[item].goods_name + '</span>' + '<span style="float:right" class="text-warning">'+__('￥') + ' ' + returnFloat(data.top3[item].goods_price) + '</span></li>';
                    }
                    $("#top3_html").html(html);
                }
                else {
					$("#total").html("0");    //产品总数
                    $("#low_num").html("0");  //低于10的库存
                    $("#stop_num").html("0"); //停售商品				
					$("#normal").html("0");   //正常销售
					$("#warn_num").html("0"); //库存预警
                    $("#cost_total").html("0.00"); //产品成本
					$("#total_num").html("0"); //产品总数
                    $("#top3_html").empty();   //销售前3
                }
            }
        });
    },
    //加载table数据
    getTable: function () 
	{
        var obj = this;
        var pageSize = 10;
		$('#tableWrapper').bootstrapTable('destroy').bootstrapTable({
			url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=lists&typ=json',
            method: 'get',
            toolbar: "#toolbar",
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize,
                    begin_time: ($("#time").val().split(__(' 至 '))[0] == "" ? "" : $("#time").val().split(__(' 至 '))[0] + " 00:00:00"),
                    end_time: ($("#time").val().split(__(' 至 '))[1] == undefined ? "" : $("#time").val().split(__(' 至 '))[1] + " 23:59:59"),
                    goodsCode: $("#goodsCode").val() == undefined ? "" : $("#goodsCode").val().trim(),
                    goods_status: $("#goods_status").val() == undefined ? "" : $("#goods_status").val(),
                    price: $("#price").val() == undefined ? "" : $("#price").val(),
                    price_end: $("#price_end").val() == undefined ? "" : $("#price_end").val(),
                    discount: $("#discount").val() == undefined ? "" : $("#discount").val(),
                    discount_end: $("#discount_end").val() == undefined ? "" : $("#discount_end").val(),
					goods_source: $("#goods_source").val() == undefined ?"": $("#goods_source").val()
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: pageSize,
            pageList: [10, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "goods_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getColumns(),
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			},
			formatLoadingMessage: function(){return "";}
        });
    },
    //绑定列
    getColumns: function () 
	{
        var obj = this;
        var Columns = [
            {field: 'goods_code', title: __('产品编号'), align: 'left', halign: 'left', width: '10%'},
			{field: 'goods_name', title: __('产品名称'), align: 'left', halign: 'left', width: '13%'},
			{field: 'goods_cost', title: __('成本价'), align: 'left', halign: 'left', width: '5%'},
			{
				field: 'goods_vip_price', title: __('会员价'), align: 'left', halign: 'left', width: '5%', formatter: function (value, row, index) {
					if (row.goods_vip_price == 0) {return __("无");}
					else {return row.goods_vip_price;}
				}
			},
			{field: 'goods_price', title: __('零售价'), align: 'left', halign: 'left', width: '5%'},
			{
				field: 'goods_points_type', title: __('所得积分'), align: 'left', halign: 'left', width: '6%', formatter: function (value, row, index) {
					if (row.goods_is_points == 1 && row.goods_points_type == 0) {
						return __("自动计算");
					}
					else if (row.goods_is_points == 0 && row.goods_points_type == 0) {
						return __("无");
					}
					return value;
				}
			},
			{ field: 'goods_spec', title: __('产品规格'), align: 'left', halign: 'left', width: '6%' },
			{
				field: 'goods_status', title: __('销售状态'), align: 'left', halign: 'left', width: '6%', formatter: function (value, row, index) {
					if (value == 1) {
						return "<p style='color:#40c31b'>"+__('正常')+"</p>";
					} else if (value == 2) {
						return "<p style='color:#ff4400'>"+__('停售')+"</p>";
					}
				}
			},
			{ field: 'goods_stock', title: __('库存'), align: 'right', halign: 'center', width: '5%' },
			{
				field: '', title: __('操作'), align: 'left', halign: 'left', width: '12%', formatter: function (value, row, index)
				{
					var _fm = "";
					 _fm += "<button onclick='GoodsManager.rowEdit(\"" + row.goods_id + "\")' class='btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5'> <i class='fa fa-pencil'></i></button>";
					_fm += '<button onclick="GoodsManager.rowDel(\'' + row.goods_id + '\',\'' + row.goods_name + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5"> <i class="fa fa-trash-o"></i> </button>';
					_fm += "<button onclick='GoodsManager.printCode(\"" + row.goods_code + "\",\""+row.goods_name+"\",\""+row.goods_price+"\")' class='btn b-racius3 btn-default waves-effect btn-xs m-r-5' ><i class='fa fa-print'></i></button>";
					_fm += '<button type="button" onclick="GoodsManager.changeState(\'' + row.goods_id + '\',\'' + row.goods_name + '\',\'' + row.goods_status + '\')" class="btn b-racius3 btn-icon waves-effect waves-light btn-default btn-xs m-r-5" style="padding:2px 5px;"><i class="fa fa fa-cog fa-fw"></i></button>'
					return _fm;
				}
			}
        ]
        return Columns;
    },
    //绑定时间
    initRangDate: function () 
	{
        $('#time').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: __(' 至 '),
            start: "", //开始时间，在这时间之前都不可选
            end: "",//结束时间，在这时间之后都不可选
            showDropdowns: true
        });
    },
    //编辑
    rowEdit: function (id) {
		id = id*1;
        window.location.href = SYS.CONFIG.index_url + '?ctl=Goods_Base&met=manage&typ=e&goods_id='+id;
    },
    //修改销售状态
    changeState: function (id, name, state) {
        var obj = this;
        var goods_status = state == 1 ? 2 : 1;
        var type = goods_status == 1 ? __("正常") : __("停售");
        Layer.confirm({ message: __('是否确定将产品状态改为')+ type +__('？(产品名称：') + name + ')' }).on(function (e) {
            if (!e) {
                return;
            }
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=editStatus&typ=json',
                data: {
                    goods_id: id*1,
                    goods_status: goods_status
                },
                type: "post",
                async: true,
				dataType: 'json',
                success: function (data) 
				{
                    if (data && data.status == 200) {
                        alertMessage(__("修改成功"));
                        obj.refresh();
                    }
                    else {
                        alertError(__("修改失败：") + data.msg);
                    }
                }
            });
        });
    },
    //删除
    rowDel: function (id, name) 
	{
        var obj = this;
		var goods_id = id*1;
        Layer.confirm({ message: __('删除该产品会导致其他引用产品数据不一致,确定删除(产品名称：') + name + ')？' }).on(function (e) {
            if (!e) {
                return;
            }
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=remove&typ=json',
                data: {goods_id:goods_id},
                type: "post",
                async: true,
				dataType: 'json',
                success: function (data) {
                    if (data && data.status == 200) {
                        alertMessage(__("删除成功"));
                        obj.refresh();
                    }
                    else {
                        alertError(__("删除失败：") + data.lastErr);
                    }
                    obj.Id = "";
                }
            });
        });
    },
    //刷新table
    refresh: function () 
	{
        var obj = this;
        obj.getTable();
		obj.topInfo();
    },
    //导入
    importModal: function () 
	{
		var obj = $("#file-upload");
		obj.outerHTML = obj.outerHTML; 
		
        $("#importLabel").html(__("产品批量导入"));
        $('#importModal').modal({ backdrop: 'static', keyboard: false });
    },
    //导入事件
    importExcel: function () 
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
			url: SYS.CONFIG.index_url + '?ctl=Goods_Excel&met=dataImport&typ=json',
			data: formData,
			type: "post",
			processData : false, 
			contentType : false,
			async: false,
			dataType: 'json',
			success:function(e)
			{
				if(e.status == 200)
				{
					alertMessage(__("操作成功"));
					$('#importModal').modal('hide')
					obj.refresh();
				}else{
					alertError(e.msg);//失败
					return false;
				}	
			}
		});		
		return false;
    },
    //下载产品模板
    goodsExcelTemplate: function () 
	{
		$.ajax({
			url: SYS.CONFIG.index_url + '?ctl=Goods_Excel&met=down&typ=json',
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
    //打印条形码
    printCode: function (goods_code,name,price) 
	{
        BarcodePrinting(goods_code,name,price);
    },
	synchroGoods: function()
	{
		if ($('#goods_sales').is(':checked')) {
            var goods_status = 1;
        }else{
			var goods_status = 2;
		}
		var obj = this;
		$.ajax({
			url: SYS.CONFIG.index_url + '?ctl=Goods_Base&met=synchroGoods&typ=json',
			data: {goods_status:goods_status},
			type: 'post',
			async: false,
			dataType:'json',
			success: function (data) 
			{
				if(data && data.status == 200)
				{
					alertMessage(__("操作成功 ")+data.msg);
					$('#synchroModal').modal('hide')
					obj.refresh();
				}
			}
		})
	}
}